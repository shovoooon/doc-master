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

        html {
            width: 297mm;
            height: 210mm;
        }

        body {
            width: 297mm;
            height: 210mm;
            background-image: url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path('mc-border.png'))) }}');
            background-repeat: no-repeat;
            background-size: 100% 100%;
            /* Cover entire page */
            background-position: center;
            background-origin: content-box;
        }
    </style>
</head>

<body class="flex items-center justify-center">
    <div class="text-center">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="text-xl font-bold uppercase">Government of the People's Republic of Bangladesh</h1>
            <h2 class="text-lg font-semibold">Office of the Registrar of Muslim Marriage Registrar & Kazi</h2>
            <p class="text-sm">Kazi Office, House #5, Road #9, Sector #3, Uttara Model Town, Dhaka-1230</p>
        </div>

        <!-- Seal (Placeholder) -->
        <div class="flex justify-center mb-3">
            <div class="w-16 h-16 flex items-center justify-center">
                <img src="{{ image_to_base64('prb.png') }}" alt="">
            </div>
        </div>

        <!-- Title -->
        <div class="border-2 border-black inline-block px-6 py-1 mb-4">
            <h3 class="text-lg font-bold uppercase">Marriage Certificate</h3>
        </div>

        <!-- Body Text -->
        <div class="text-justify text-base max-w-4xl mx-auto leading-relaxed">
            <p>
                THIS IS TO CERTIFY THAT <span class="font-bold">MONIR HOSSAIN</span>, S/O- NAZRUL ISLAM & MALEKA BANU,
                VILLAGE: BALLABAZAR,
                POST: BALLABAZAR, P.S: KALIHATL, DISTRICT: TANGAIL, BANGLADESH, BORN ON 02 MAR 1989, IS MARRIED
                TO <span class="font-bold">RIMA AKTER</span>, D/O- <span class="underline">ABU</span> TAHER & SAYERA
                KHATUN, VILLAGE: KANESHTALA,
                POST: SADAR DAKSHIN, P.S: BALURCHAR, DISTRICT: CUMILLA, BANGLADESH, BORN ON 01 JAN 1996.
                THE MARRIAGE WAS SOLEMNIZED ON 15 JUNE 2016 AND REGISTERED IN MY OFFICE ON THE SAME DATE,
                UNDER VOLUME NO. 37/16, PAGE NO. 143, IN THE YEAR 2016.
            </p>

            <p class="mt-4">
                I WISH THEM EVERY SUCCESS IN LIFE.
            </p>

            <p class="mt-4 font-semibold">
                DATE OF ISSUE: 02 FEB 2025
            </p>
        </div>

        <!-- Footer -->
        <div class="text-right text-sm mt-[100px]">
            <p>Office of the Registrar of Muslim Marriage Registrar & Kazi</p>
            <p>Kazi Office, House #5, Road #9, Sector #3</p>
            <p>Uttara Model Town, Dhaka-1230</p>
        </div>
    </div>
</body>

</html>
