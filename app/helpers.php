<?php

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

    if (! function_exists('name_to_filename')) {
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
