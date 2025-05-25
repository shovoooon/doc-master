<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;

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
            case 'generate_all':
                return $this->generateAllDocuments($request);
            default:
                return redirect()->back()->withErrors(['action' => 'Invalid action']);
        }
    }


    protected function generateCover(Request $request)
    {
        $data = $request->all();
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
        $data['title'] = 'Hotel Booking';
        $html = view("templates.hotel", $data)->render();
        $file_name = 'Hotel' . name_to_filename($data['name']);

        return $this->previewPdf($html, $file_name);
    }

    protected function generateBankStatement(Request $request)
    {
        $data = $request->all();
        $data['title'] = 'Bank Statement';
        $html = view("templates.bank_statement", $data)->render();
        $file_name = 'BankStatement' . name_to_filename($data['name']);

        return $this->previewPdf($html, $file_name);
    }

    protected function generateInvitation(Request $request)
    {
        $data = $request->all();
        $data['company'] = $this->upsertCompany($request);
        $data['title'] = 'Invitation Letter';
        $html = view("templates.invitation", $data)->render();
        $file_name = 'Invitation' . name_to_filename($data['name']);

        return $this->previewImage($html, $file_name);
    }

    protected function upsertCompany(Request $request): Company
    {
        // Handle file uploads
        $logoPath = $request->hasFile('logo') ? $request->file('logo')->store('logos', 'public') : null;
        $signaturePath = $request->hasFile('signature') ? $request->file('signature')->store('signatures', 'public') : null;

        $companyName = sanitize_company_name($request['company_name']);

        return Company::updateOrCreate(
            ['name' => $companyName],
            [
                'address' => $request['company_address'] ?? null,
                'registration_no' => $request['registration_no'] ?? null,
                'registration_code' => $request['registration_code'] ?? null,
                'logo' => $logoPath ?? null,
                'signature' => $signaturePath ?? null
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
                ->fullPage() // Capture entire page
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
}
