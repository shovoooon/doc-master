<?php

use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\returnArgument;

if (!function_exists('generate_random_name')) {
    function generate_random_name(): string
    {
        $names = [
            'MD ANARUL ISLAM',
            'MD AMZAAD UDDIN',
            'MD ASHRAFUL ISLAM',
            'MD ANOWAR HOSSAIN',
            'MD SAIFUL ISLAM',
            'MD SIQUEDAR ALI',
            'MD MOJAMMEL HAQUE',
            'MD SADMAN HOSSAIN',
            'MD SHAJIB HOSSAIN',
            'AB SIDDIQUR RAHMAN',
        ];

        return $names[array_rand($names)];
    }
}


if (!function_exists('generate_airline_pnr')) {
    function generate_airline_pnr(): string
    {
        $characters = '0123456789ABCDEFGHJKLMNPQRSTUVWXYZ';
        $pnr = '';

        for ($i = 0; $i < 6; $i++) {
            $pnr .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $pnr;
    }

    if (!function_exists('name_to_filename')) {
        function name_to_filename(string $name): string
        {
            $name = strtolower(trim($name));
            $name = preg_replace('/[^a-z\s]/', '', $name);
            $name = str_replace(' ', '', ucwords($name));

            return $name;
        }
    }

    if (!function_exists('image_to_base64')) {
        function image_to_base64(string $path): string
        {
            try {
                // Check if path is already a full URL
                if (filter_var($path, FILTER_VALIDATE_URL)) {
                    return $path;
                }

                // Check if path is in storage
                if (str_starts_with($path, 'storage/')) {
                    $fullPath = storage_path('app/public/' . substr($path, 8));
                } else {
                    $fullPath = public_path($path);
                }

                if (!file_exists($fullPath)) {
                    throw new Exception("Image file not found: {$fullPath}");
                }

                // Get image content and encode
                $imageData = file_get_contents($fullPath);
                $mimeType = mime_content_type($fullPath);

                return 'data:' . $mimeType . ';base64,' . base64_encode($imageData);
            } catch (Exception $e) {
                \Log::error('Image to base64 conversion failed: ' . $e->getMessage());
                return ''; // Return empty string or placeholder image
            }
        }
    }
}

if (!function_exists('generate_bank_account')) {
    function generate_bank_account(): string
    {
        return '280310021' . rand(1001, 9999);
    }
}

if (!function_exists('sanitize_company_name')) {
    function sanitize_company_name(string $name): string
    {
        return \Str::of($name)
            ->replace('.', '')
            ->trim()
            ->value();
    }
}

if (!function_exists('get_rapiadpi_key')) {
    function get_rapiadpi_key(): string
    {
        return '1193d880a5msh44af990975c5cebp16c58cjsn511906cf898c';
        return 'e5660f1e27msh43eb5907d84a445p11c17ajsnfd22a88e141c';
        return '2bc87d3091msh03c505bd12fd338p10291cjsnb3801cd96f10';
        return 'c552953007msh4e951fdfe4232e0p153a20jsn5a697b8287f9';
        return 'fb58cfdc50msh9f126ac3600132cp112723jsn5afb48577ec9';
        return '90cb2b91a5mshb1b737acff77a8dp12662djsnb338992116fa';
    }
}


if (!function_exists('get_hotel_destination_id')) {
    function get_hotel_destination_id(string $city)
    {
        $apiKey = get_rapiadpi_key();

        try {
            $response = Http::withHeaders([
                'X-RapidAPI-Host' => 'booking-com15.p.rapidapi.com',
                'X-RapidAPI-Key' => $apiKey,
            ])->get('https://booking-com15.p.rapidapi.com/api/v1/hotels/searchDestination', [
                        'query' => $city,
                    ]);

            $data = $response->json();

            if (empty($data['data'][0])) {
                return ['error' => 'No destination found'];
            }

            return $data['data'][0]['dest_id'];
        } catch (\Exception $e) {
            return ['error' => 'Failed to fetch hotels: ' . $e->getMessage()];
        }
    }
}


if (!function_exists('search_hotel')) {
    function search_hotel($destination_id, $arrival_date, $departure_date)
    {
        $apiKey = get_rapiadpi_key();

        try {
            $response = Http::withHeaders([
                'X-RapidAPI-Host' => 'booking-com15.p.rapidapi.com',
                'X-RapidAPI-Key' => $apiKey,
            ])->get('https://booking-com15.p.rapidapi.com/api/v1/hotels/searchHotels', [
                        'dest_id' => $destination_id,
                        'search_type' => 'CITY',
                        'arrival_date' => $arrival_date,
                        'departure_date' => $departure_date,
                        'adults' => 1,
                        'children_age' => '0,17',
                        'room_qty' => 1,
                        'page_number' => 1,
                        'languagecode' => 'en-us',
                        'currency_code' => 'MYR',
                    ]);

            $data = $response->json();

            if (empty($data['data']['hotels'])) {
                return ['error' => 'No hotels found'];
            }


            $firstHotel = $data['data']['hotels'][rand(1, 5)];

            $hotel_id = $firstHotel['hotel_id'];

            return hotel_details($hotel_id, $arrival_date, $departure_date);

        } catch (\Exception $e) {
            return ['error' => 'Failed to fetch hotels: ' . $e->getMessage()];
        }
    }
}

if (!function_exists('hotel_details')) {
    function hotel_details($hotel_id, $arrival_date, $departure_date): array
    {
        $apiKey = get_rapiadpi_key();

        try {
            $response = Http::withHeaders([
                'X-RapidAPI-Host' => 'booking-com15.p.rapidapi.com',
                'X-RapidAPI-Key' => $apiKey,
            ])->get('https://booking-com15.p.rapidapi.com/api/v1/hotels/getHotelDetails', [
                        'hotel_id' => $hotel_id,
                        'arrival_date' => $arrival_date,
                        'departure_date' => $departure_date,
                        'adults' => 1,
                        'children_age' => '0,17',
                        'room_qty' => 1,
                        'page_number' => 1,
                        'languagecode' => 'en-us',
                        'currency_code' => 'MYR',
                    ]);

            $data = $response->json();

            if (empty($data['data'])) {
                return ['error' => 'No hotel details found'];
            }
            return $data['data'];

        } catch (\Exception $e) {
            return ['error' => 'Failed to fetch hotels: ' . $e->getMessage()];
        }
    }
}


if (!function_exists('extract_city_from_address')) {
    function extract_city_from_address(string $address): string
    {
        $parts = array_filter(array_map('trim', explode(',', $address)));

        if (count($parts) >= 2) {
            $city = $parts[count($parts) - 2];

            $city = preg_replace('/^\d+\s*/', '', $city);

            return match (strtoupper($city)) {
                'PETALING JAYA' => 'Petaling Jaya',
                'WP KUALA LUMPUR', 'KUALA LUMPUR' => 'Kuala Lumpur',
                'BATU CAVES' => 'Batu Caves',
                'BATU PAНАТ', 'BATU PAHAT' => 'Batu Pahat',
                'CHERAS' => 'Cheras',
                'SRI PERMAISURI' => 'Sri Permaisuri',
                default => ucwords(strtolower($city)),
            };
        }

        return 'Kuala Lumpur';
    }
}

if (!function_exists('generate_bank_transactions')) {
    function generate_bank_transactions(int $length, float $starting_balance): array
    {
        $deposit_descriptions = [
            'CASH DEPOSITE 130',
            'CASH RECEIVED',
            'CITYTOUCH/NPSB',
            'bKash_Inc//017424342854',
            'SALARY CREDIT',
            'FUND TRANSFER',
            'INTEREST CREDIT',
            'MOBILE BANKING DEPOSIT',
        ];

        $withdrawal_descriptions = [
            'TRANSFER CHEQUE BOOK',
            'CASH WITHDRAWAL FROM ATM',
            'CITYTOUCH/NPSB',
            'Utility Bill Payment',
            'ATM WITHDRAWAL',
            'FUND TRANSFER',
            'LOAN EMI',
            'CREDIT CARD PAYMENT',
        ];

        $charge_descriptions = [
            'SMS CHARGE',
            'CARD FEE',
            'MAINTENANCE FEE',
            'EXCISE DUTY',
            'SERVICE CHARGE',
            'ATM USAGE FEE',
            'ACCOUNT FEE',
        ];

        $transactions = [];
        $current_balance = $starting_balance;
        $date = new DateTime('last day of last month');
        $date->modify('-6 months');

        $transactions[] = [
            'date' => $date->format('d-m-Y'),
            'description' => 'BALANCE FORWARD',
            'balance_bdt' => round($current_balance, 2),
        ];

        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(1, 100);

            if ($rand <= 40) {
                // Deposit
                $description = $deposit_descriptions[array_rand($deposit_descriptions)];
                $deposit = round(mt_rand(1000, 25000) / 100) * 100;
                $withdrawal = null;
                $cheque_no = null;
                $current_balance += $deposit;
            } elseif ($rand <= 90) {
                // Withdrawal
                $description = $withdrawal_descriptions[array_rand($withdrawal_descriptions)];
                $max_withdrawal = min(10000, $current_balance);
                if ($max_withdrawal >= 3000) {
                    $withdrawal = round(mt_rand(3000, $max_withdrawal) / 100) * 100;
                } else {
                    $withdrawal = null;
                    continue; // skip this iteration to avoid broken entry
                }
                $deposit = null;
                $cheque_no = strpos($description, 'CHEQUE') !== false ? 'CHQ' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT) : null;
                $current_balance -= $withdrawal;
            } else {
                // Charge
                $description = $charge_descriptions[array_rand($charge_descriptions)];
                $withdrawal = min($current_balance, round(mt_rand(100, 1000) / 100, 2));
                $deposit = null;
                $cheque_no = null;
                $current_balance -= $withdrawal;
            }

            // Prevent balance from going negative
            $current_balance = max(0, $current_balance);

            // Advance date randomly by 1–5 days
            $date->modify('+' . mt_rand(1, 5) . ' days');
            if ($date > new DateTime('last day of last month')) {
                $date = new DateTime('last day of last month');
            }

            $transactions[] = [
                'date' => $date->format('d-m-Y'),
                'description' => $description,
                'cheque_no' => $cheque_no,
                'withdrawal' => $withdrawal,
                'deposit' => $deposit,
                'balance_bdt' => round($current_balance, 2),
            ];
        }

        return $transactions;
    }



}

if (!function_exists('sentence_case')) {
    function sentence_case($text)
    {
        return ucwords(strtolower($text));
    }
}
