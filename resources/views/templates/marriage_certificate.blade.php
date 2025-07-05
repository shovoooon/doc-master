@php
    $husbandAddress = 'VILLAGE: ' . $husband_village . ', ';
    $husbandAddress .= 'POST: ' . $husband_post . ', ';
    $husbandAddress .= 'P.S: ' . $husband_ps . ', ';
    $husbandAddress .= 'DISTRICT: ' . $husband_district . ', ';
    $husbandAddress .= 'BANGLADESH';

    $address = 'VILLAGE: ' . $village . ', ';
    $address .= 'POST: ' . $post . ', ';
    $address .= 'P.S: ' . $ps . ', ';
    $address .= 'DISTRICT: ' . $district . ', ';
    $address .= 'BANGLADESH';

    $dom = \Carbon\Carbon::parse($dom)->format('d F Y');
    $dobWife = \Carbon\Carbon::parse($dob)->format('d F Y');
    $dobHusband = \Carbon\Carbon::parse($husband_dob)->format('d F Y');
    $marriageYear = \Carbon\Carbon::parse($dom)->format('Y');
    $marriageYearShort = \Carbon\Carbon::parse($dom)->format('y');
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Marriage Certificate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            width: 297mm;
            height: 210mm;
            background-image: url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path('mc-bg.png'))) }}');
            background-repeat: no-repeat;
            background-size: 100% 100%;
            /* Cover entire page */
            background-position: center;
            background-origin: content-box;
        }

        .scanned-text {
            color: #333;
            position: relative;
            filter: blur(0.25px) contrast(0.9);
        }

        .notary-sticker {
            height: 45mm;
            width: 45mm;
            position: absolute;
            bottom: 15px;
            left: 35%;
            z-index: 10;
        }
    </style>
</head>

<body class="flex items-center justify-center">
    <!-- Notary Sticket -->
    <img class="notary-sticker" src="{{ image_to_base64('notary-sticker.png') }}" alt="Notary Sticker">
    <div class="text-center">
        <!-- Header -->
        <div class="text-center mb-4 scanned-text">
            <h1 class="text-xl font-bold uppercase">Government of the People's Republic of Bangladesh</h1>
            <h2 class="text-lg font-semibold">Office of the Registrar of Muslim Marriage Registrar & Kazi</h2>
            <p class="text-sm">Kazi Office, House #5, Road #9, Sector #3, Uttara Model Town, Dhaka-1230</p>
        </div>

        <!-- Seal (Placeholder) -->
        <div class="flex justify-center mb-3 scanned-text">
            <div class="w-20 h-20 flex items-center justify-center">
                <img src="{{ image_to_base64('prb.png') }}" alt="">
            </div>
        </div>

        <!-- Title -->
        <div class="border-2 border-black inline-block px-6 py-1 mb-4 scanned-text">
            <h3 class="text-lg font-bold uppercase">Marriage Certificate</h3>
        </div>

        <!-- Body Text -->
        <div class="text-justify text-base max-w-[83%] mx-auto leading-relaxed scanned-text uppercase">
            <p>
                THIS IS TO CERTIFY THAT <span class="font-bold">{{ $husband_name }}</span>, S/O:
                {{ $husband_father_name }} & {{ $husband_mother_name }},
                {{ $husbandAddress }}, BORN ON {{ $dobHusband }}, IS MARRIED
                TO <span class="font-bold">{{ $name }}</span>, D/O: {{ $father_name }} &
                {{ $mother_name }}, {{ $address }}, BORN ON {{ $dobWife }}.
                THE MARRIAGE WAS SOLEMNIZED ON {{ $dom }} AND REGISTERED IN MY OFFICE ON THE SAME DATE,
                UNDER VOLUME NO. 37/{{ $marriageYearShort }}, PAGE NO. 80, IN THE YEAR {{ $marriageYear }}.
            </p>

            <p class="mt-4">
                I WISH THEM EVERY SUCCESS IN LIFE.
            </p>

            <p class="mt-4 font-semibold">
                DATE OF ISSUE: 20 MAY 2025
            </p>

            <!-- Footer -->
            <div class="text-right text-sm mt-[135px] normal-case">
                <p>Office of the Registrar of Muslim Marriage Registrar & Kazi</p>
                <p>Kazi Office, House #5, Road #9, Sector #3</p>
                <p>Uttara Model Town, Dhaka-1230</p>
            </div>
        </div>
    </div>
</body>

</html>
