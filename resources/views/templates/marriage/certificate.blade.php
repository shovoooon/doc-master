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

    $doi = \Carbon\Carbon::parse($doi)->format('d M Y');
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
            background-image: url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path('mc-bg-2.png'))) }}');
            background-repeat: no-repeat;
            background-size: 100% 100%;
            /* Cover entire page */
            background-position: center;
            background-origin: content-box;
            font-family: "Times New Roman", Times, serif;
            line-height: 1.9 !important;
        }

        .scanned-text {
            color: #000000;
            position: relative;
            filter: blur(0.2px) contrast(0.9);
        }

        .notary-sticker {
            height: 45mm;
            width: 45mm;
            position: absolute;
            bottom: 10px;
            left: 35%;
            z-index: 10;
        }

        .kazi-office-round-seal {
            height: 42mm;
            width: 42mm;
            position: absolute;
            top: 60px;
            left: 90px;
            z-index: 10;
        }

        .notary-round-seal {
            height: 40mm;
            width: 40mm;
            position: absolute;
            top: 160px;
            right: 85px;
            z-index: 10;
        }

        .kazi-seal {
            height: auto;
            width: 55mm;
            position: absolute;
            bottom: 95px;
            right: 130px;
            z-index: 10;
        }

        .authenticated-seal {
            height: auto;
            width: 55mm;
            position: absolute;
            bottom: 42px;
            left: 140px;
            z-index: 10;
        }

        .date-seal {
            filter: blur(0.3px) contrast(0.8);
        }

        .footer {
            position: absolute;
            bottom: 45px;
            right: 100px;
        }
    </style>
</head>

<body class="">
    <!-- Notary Sticket -->
    <img class="notary-sticker" src="{{ image_to_base64('notary-sticker.png') }}">
    <!-- Kazi Office Round Seal -->
    <img class="kazi-office-round-seal" src="{{ image_to_base64('kazi-office-round-seal.png') }}">
    <!-- Notary Round Seal -->
    <img class="notary-round-seal" src="{{ image_to_base64('notary-round-seal.png') }}">
    <!-- Kazi Seal -->
    <img class="kazi-seal" src="{{ image_to_base64('kazi-seal.png') }}">
    {{-- <!-- Authenticated Seal -->
    <img class="authenticated-seal" src="{{ image_to_base64('authenticated-seal.png') }}"> --}}

    <div class="text-center pt-[72mm]">
        <!-- Title -->
        <div class="border-2 border-black inline-block px-6 py-1 mb-4 scanned-text">
            <h3 class="text-lg font-bold uppercase">Marriage Certificate</h3>
        </div>

        <!-- Body Text -->
        <div class="text-justify leading-relaxed max-w-[83%] mx-auto scanned-text uppercase text-[17px]">
            <p>
                THIS IS TO CERTIFY THAT <span class="font-bold">{{ $husband_name }}</span>, S/O:
                {{ $husband_father_name }} & {{ $husband_mother_name }},
                {{ $husbandAddress }}, BORN ON {{ $dobHusband }}, IS MARRIED
                TO <span class="font-bold">{{ $name }}</span>, D/O: {{ $father_name }} &
                {{ $mother_name }}, {{ $address }}, BORN ON {{ $dobWife }}.
                THE MARRIAGE WAS SOLEMNIZED ON {{ $dom }} AND REGISTERED IN MY OFFICE ON THE SAME DATE,
                UNDER VOLUME NO. {{ $volume_no ?? '37' }}/{{ $marriageYearShort }}, PAGE NO. {{ $page_no ?? '80' }},
                IN THE YEAR {{ $marriageYear }}.
            </p>

            <p class="mt-4">
                I WISH THEM EVERY SUCCESS IN LIFE.
            </p>
        </div>
    </div>

    <div class="authenticated-seal">
        <!-- Authenticated Seal -->
        <img class="h-25" src="{{ image_to_base64('authenticated-seal.png') }}">
        <div class="date-seal text-purple-700 text-lg text-center font-mono tracking-widest uppercase">
            {{ $doi ?? '25 MAY 2025' }}
        </div>
    </div>

    <!-- Footer -->
    <div class="footer text-right text-sm mt-[135px] normal-case">
        <p>Office of the Registrar of Muslim Marriage Registrar & Kazi</p>
        <p>Kazi Office, House #5, Road #9, Sector #3</p>
        <p>Uttara Model Town, Dhaka-1230</p>
    </div>
</body>

</html>
