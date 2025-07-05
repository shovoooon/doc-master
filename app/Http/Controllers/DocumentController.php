<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Company;
use App\Models\Hotel;
use App\Models\Image;
use App\Models\Traveller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DocumentController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the inputs (you can customize this further)
        $validated = $request->validate([
            'action' => 'required|string',
        ]);

        // Determine which document to generate
        switch ($request->input('action')) {
            case 'cover':
                return $this->generateCover($request);
            case 'ticket':
                return $this->generateTicket($request);
            case 'hotel':
                return $this->generateHotel($request);
            case 'bank_statement':
                return $this->generateBankStatement($request);
            case 'invitation':
                return $this->generateInvitation($request);
            case 'ssm':
                return $this->generateSSM($request);
            case 'marriage_certificate':
                return $this->generateMarriageCertificate($request);
            case 'nikah_nama':
                return $this->generateNikahNama($request);
            case 'generate_all':
                return $this->generateAllDocuments($request);
            default:
                return redirect()->back()->withErrors(['action' => 'Invalid action']);
        }
    }


    protected function generateCover(Request $request)
    {
        $data = $request->all();
        $traveller = $this->upsertTraveller($request);
        $data['traveller'] = $traveller;
        $data['children'] = $traveller->children ?? [];

        $data['title'] = 'Cover Letter';
        $html = view("templates.cover", $data)->render();
        $file_name = 'Cover' . name_to_filename($data['name']);

        return $this->previewPdf($html, $file_name);
    }

    protected function generateTicket(Request $request)
    {
        $data = $request->all();
        $data['title'] = 'Ticket Booking';
        $html = view("templates.ticket", $data)->render();
        $file_name = 'Ticket' . name_to_filename($data['name']);

        return $this->previewPdf($html, $file_name);
    }

    protected function generateHotel(Request $request)
    {

        $data = $request->all();
        // get hotel info
        $company_city = extract_city_from_address($request->company_address);
        $departure = \Carbon\Carbon::parse($request->departure)->format('Y-m-d');
        $return = \Carbon\Carbon::parse($request->return)->format('Y-m-d');
        $destination_id = get_hotel_destination_id($company_city);

        $data['hotel'] = search_hotel($destination_id, $departure, $return);

        if (isset($data['hotel']['hotel_name'])) {
            $this->upsertHotel($data['hotel']);
        }

        // generate hotel invoice
        $data['title'] = 'Hotel Booking';
        $html = view("templates.hotel", $data)->render();
        $file_name = 'Hotel' . name_to_filename($data['name']);
        return $this->previewPdf($html, $file_name);
    }

    protected function upsertHotel($hotel): Hotel
    {
        $hotelAddress = $hotel['address'] . ', ' . $hotel['zip'] . ' ' . $hotel['city'] . ', Malaysia';

        return Hotel::updateOrCreate(
            ['name' => $hotel['hotel_name']],
            [
                'address' => $hotelAddress ?? null,
                'zip' => $hotel['zip'] ?? null,
                'city' => $hotel['city'] ?? null,
                'country' => $hotel['country'] ?? 'Malaysia',
                'image' => $hotel['rawData']['photoUrls'][0] ?? null,
            ]
        );
    }

    protected function generateBankStatement(Request $request)
    {
        $data = $request->all();
        $data['bank'] = $this->upsertBank($request);

        $data['title'] = 'Bank Statement';
        $html = view("templates.bank_statement", $data)->render();
        $file_name = 'BankStatement' . name_to_filename($data['name']);

        return $this->previewPdf($html, $file_name);
    }

    protected function generateInvitation(Request $request)
    {
        $data = $request->all();
        $data['company'] = $this->upsertCompany($request);
        $traveller = $this->upsertTraveller($request);
        $data['traveller'] = $traveller;
        $data['children'] = $traveller->children ?? [];

        // Check if company has signature, otherwise get random one
        if (empty($data['company']->signature)) {
            $randomCompanyWithSignature = Company::whereNotNull('signature')
                ->inRandomOrder()
                ->first();

            if ($randomCompanyWithSignature) {
                $data['company']->signature = $randomCompanyWithSignature->signature;
            }
        }

        // Check if company has logo, otherwise get random one
        if (empty($data['company']->logo)) {
            $randomCompanyWithLogo = Company::whereNotNull('logo')
                ->inRandomOrder()
                ->first();

            if ($randomCompanyWithLogo) {
                $data['company']->logo = $randomCompanyWithLogo->logo;
            }
        }

        $data['title'] = 'Invitation Letter';
        $html = view("templates.invitation", $data)->render();
        $file_name = 'Invitation ' . $data['name'];

        //return $this->previewPdf($html, $file_name);
        return $this->previewImage($html, $file_name);
    }

    protected function upsertCompany(Request $request): Company
    {
        // Handle file uploads only if present
        // $logoPath = $request->hasFile('logo') ? $request->file('logo')->store('logos', 'public') : null;
        // $signaturePath = $request->hasFile('signature') ? $request->file('signature')->store('signatures', 'public') : null;

        $logoPath = null;
        $signaturePath = null;

        if ($logoImageId = $request['logo_id']) {
            $logoPath = Image::find($logoImageId)->file_path;
        }

        if ($signatureImageId = $request['signature_id']) {
            $signaturePath = Image::find($signatureImageId)->file_path;
        }

        $companyName = sanitize_company_name($request['company_name']);

        // Start building data array
        $data = [
            'address' => $request['company_address'] ?? null,
            'registration_no' => $request['registration_no'] ?? null,
            'registration_code' => $request['registration_code'] ?? null,
        ];

        // Add files only if uploaded
        if ($logoPath) {
            $data['logo'] = $logoPath;
        }

        if ($signaturePath) {
            $data['signature'] = $signaturePath;
        }

        return Company::updateOrCreate(
            ['name' => $companyName],
            $data
        );
    }

    protected function upsertTraveller(Request $request): Traveller
    {
        $traveller = Traveller::updateOrCreate(
            ['passport_no' => $request['passport_no']],
            [
                'name' => $request['name'] ?? null,
                'address' => $request['address'] ?? null,
                'passport_issued' => $request['passport_issued'] ?? null,
                'passport_expiry' => $request['passport_expiry'] ?? null,
                'spouse_name' => $request['husband_name'] ?? null,
                'spouse_passport_no' => $request['husband_passport_no'] ?? null,
            ]
        );

        // Optional: clear existing children if updating
        $traveller->children()->delete();

        if ($request->has('children')) {
            foreach ($request->input('children') as $child) {
                $relationship = strtolower($child['gender']) === 'male' ? 'Son' : 'Daughter';
                $traveller->children()->create([
                    'name' => $child['name'] ?? null,
                    'gender' => $child['gender'] ?? null,
                    'relationship' => $relationship,
                    'passport_no' => $child['passport_no'] ?? null,
                    'passport_issued' => $child['passport_issued'] ?? null,
                    'passport_expiry' => $child['passport_expiry'] ?? null,
                ]);
            }
        }

        return $traveller;
    }

    protected function upsertBank(Request $request): Bank
    {
        return Bank::updateOrCreate(
            [
                'branch_name' => $request['bank_branch'],
                'district' => $request['bank_branch'],
            ],
            [
                'name' => $request['bank_name'] ?? 'City Bank PLC',
                'address' => $request['bank_address'],
                'short_address' => $request['bank_short_address'] ?? null,
                'manager_name' => $request['bank_manager_name'] ?? 'MD ASHRAFUL ISLAM',
            ]
        );
    }

    protected function generateSSM(Request $request)
    {
        $data = $request->all();
        //$data['company'] = $this->upsertCompany($request);
        $data['title'] = 'Company SSM';
        $html = view("templates.ssm", $data)->render();
        $file_name = 'CompanySSM' . name_to_filename($data['company_name']);

        return $this->previewImage($html, $file_name);
    }

    protected function generateAllDocuments($data)
    {
        return back()->with('status', 'All documents generated!');
    }

    protected function generateMarriageCertificate(Request $request)
    {
        $data = $request->all();
        $data['title'] = 'Marriage Certificate';
        //$html = view("templates.marriage_certificate", $data)->render();
        $html = view("templates.marriage.certificate", $data)->render();
        $file_name = 'Marriage Certificate ' . $data['name'];

        return $this->previewPdf($html, $file_name);
    }

    protected function generateNikahNama(Request $request)
    {
        $data = $request->all();
        $data['title'] = 'Nikah Nama';
        $html = view("templates.marriage.nikah_nama", $data)->render();
        $file_name = 'Nikah Nama ' . $data['name'];

        return $this->previewPdf($html, $file_name);
    }

    protected function previewPdf($html, $file_name)
    {
        try {
            $pdf = Browsershot::html($html)
                ->showBackground()
                ->format('A4')
                ->pdf();

            return new Response($pdf, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $file_name . '.pdf"'
            ]);
        } catch (\Exception $e) {
            \Log::error('PDF Generation Error: ' . $e->getMessage());

            return response()->json([
                'error' => 'PDF generation failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    protected function previewImage($html, $file_name)
    {
        try {
            $image = Browsershot::html($html)
                ->showBackground()
                ->format('A4')
                ->fullPage()
                ->deviceScaleFactor(3)
                ->screenshot();

            return new Response($image, 200, [
                'Content-Type' => 'image/png',
                'Content-Disposition' => 'inline; filename="' . $file_name . '.png"'
            ]);
        } catch (\Exception $e) {
            \Log::error('Image Generation Error: ' . $e->getMessage());

            return response()->json([
                'error' => 'Image generation failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    protected function generateFlattenedPdf($html, $file_name)
    {
        try {
            // Generate image from HTML using Browsershot
            $tempDir = storage_path('app/temp');
            if (!File::exists($tempDir)) {
                File::makeDirectory($tempDir, 0755, true);
            }

            $imagePath = "{$tempDir}/{$file_name}.png";
            Browsershot::html($html)
                ->windowSize(1240, 1754) // approx A4 at 150 DPI
                ->showBackground()
                ->setScreenshotType('png')
                ->save($imagePath);

            // Convert image to PDF using Imagick
            $imagick = new \Imagick();
            $imagick->readImage($imagePath);
            $imagick->setImageFormat("pdf");

            $pdfPath = storage_path("app/temp/{$file_name}.pdf");
            $imagick->writeImage($pdfPath);
            $imagick->clear();
            $imagick->destroy();

            // Return the PDF file as response
            return response()->file($pdfPath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $file_name . '.pdf"',
            ]);

        } catch (\Exception $e) {
            \Log::error('PDF Flattening Error: ' . $e->getMessage());

            return response()->json([
                'error' => 'PDF generation failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
