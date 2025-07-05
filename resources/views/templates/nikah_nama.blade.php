@php
    $husbandAddress = 'VILLAGE- ' . $husband_village . ', ';
    $husbandAddress .= 'POST OFFICE- ' . $husband_post . ', ';
    $husbandAddress .= 'UPAZILA- ' . $husband_ps . ', ';
    $husbandAddress .= 'DISTRICT- ' . $husband_district . ', ';
    $husbandAddress .= 'BANGLADESH';

    $address = 'VILLAGE- ' . $village . ', ';
    $address .= 'POST OFFICE- ' . $post . ', ';
    $address .= 'UPAZILA- ' . $ps . ', ';
    $address .= 'DISTRICT- ' . $district . ', ';
    $address .= 'BANGLADESH';

    $dom = \Carbon\Carbon::parse($dom)->format('d-m-Y');
    $dobWife = \Carbon\Carbon::parse($dob)->format('d-m-Y');
    $dobHusband = \Carbon\Carbon::parse($husband_dob)->format('d-m-Y');
    $marriageYear = \Carbon\Carbon::parse($dom)->format('Y');
    $marriageYearShort = \Carbon\Carbon::parse($dom)->format('y');
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .pagebreak {
                page-break-before: always;
            }
        }

        @page {
            size: A4 portrait;
            /* margin: 10mm 16mm; */
            margin: 0;
            padding: 0;
        }

        body {

            font-family: "Times New Roman", Times, serif;
            line-height: 1.25 !important;
            background-color: #7fccf0;
        }

        .page-1 {
            /* background-image: url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path('nikahnama-bg-1.png'))) }}'); */
            background-repeat: no-repeat;
            background-size: 100% 100%;
            /* Cover entire page */
            background-position: center;
            background-origin: content-box;
            width: 210mm;
            height: 297mm;
        }

        .page-content {
            padding: 5mm 14mm;
        }

        .page-2 {
            /* background-image: url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path('nikahnama-bg-2.png'))) }}'); */
            background-repeat: no-repeat;
            background-size: 100% 100%;
            /* Cover entire page */
            background-position: center;
            background-origin: content-box;
            width: 210mm;
            height: 297mm;
            position: relative;
        }

        .page-1>.notary-sticker {
            height: 45mm;
            width: 45mm;
            position: absolute;
            top: 55%;
            left: -8%;
            z-index: 10;
        }

        .page-2>.notary-sticker {
            height: 45mm;
            width: 45mm;
            position: absolute;
            top: 50%;
            left: -15%;
            z-index: 10;
        }

        .page-2>.notary-sticker-2 {
            height: 45mm;
            width: 45mm;
            position: absolute;
            bottom: 0;
            right: 15px;
            z-index: 10;
        }

        .scanned-text {
            color: #001522;
            /* dark gray, not pure black */
            filter: blur(0.25px) contrast(0.9);
            position: relative;
        }
    </style>
</head>

<body class="text-black leading-relaxed text-[14px]">

    <div class="page-1">
        <!-- Notary Sticket -->
        <img class="notary-sticker" src="{{ image_to_base64('notary-sticker.png') }}" alt="Notary Sticker">
        <div class="page-content scanned-text">
            <!-- Header -->
            <div class="text-center mb-2">
                <p class="text-left">
                    Register: <strong>A</strong> <br>
                    Page No: <strong>80</strong> <br>
                    Volume No: <strong>37</strong> <br>
                    Sl. No: <strong>07</strong> <br>
                    Date: <strong>{{ $dom }}</strong> <br>
                    Bangladesh Form No-1601
                </p>

                <h1 class="text-xl font-bold">NIKAH NAMA</h1>
                <div class="font-semibold mt-1 text-[12px]">
                    <div>
                        FORM OF NIKAH NAMA AS PRESCRIBED UNDER SECTION 9 OF THE
                    </div>
                    <div>
                        MUSLIM MARRIAGES AND DIVORCES (REGISTRATION) ACT-1974.
                    </div>
                    <div class="font-medium">(LII OF 1974)</div>
                </div>
            </div>

            <!-- Questions -->
            <ol class="list-decimal pl-4 space-y-3">
                <li>
                    Name of the ward Town, Union, Thana, District, in which the marriage took place:
                    <strong>{{ $address }}</strong>
                </li>
                <li>
                    Names of the bridegroom and his father with their respective Residences:
                    <strong>
                        {{ $husband_name }}, SON OF- {{ $husband_father_name }}, AND MOTHER'S NAME-
                        {{ $husband_mother_name }},
                        {{ $husbandAddress }}
                    </strong>
                </li>
                <li>
                    Age/Date of Birth of the bridegroom: <strong>{{ $dobHusband }}</strong>
                </li>
                <li>
                    The names of the bride and her father, with their respective residences:
                    <strong>
                        {{ $name }}, SON OF- {{ $father_name }}, AND MOTHER'S NAME- {{ $mother_name }},
                        {{ $address }}
                    </strong>
                </li>
                <li>
                    Whether the bride is or maiden, a widow or a divorcee: <strong>MAIDEN.</strong>
                </li>
                <li>
                    Age/Date of Birth of the bride: <strong>{{ $dobWife }}</strong>
                </li>
                <li>
                    Name of the wakil, if any, appointed by the bride, his father's name and his residence:
                    <strong>
                        ABDUL MOTALIB SON OF- MD. SHAFIUDDIN OF {{ $address }}
                    </strong>
                </li>
                <li>
                    Name of the witnesses to the appointment of the bride's wakil with their father's name, their
                    residences
                    and
                    their relationship with the bride:
                    <ol class="list-decimal ml-8 mt-1 space-y-1 font-bold">
                        <li>MD. MAHSIN, SON OF- ZIYAUL HAQUE OF {{ $address }}</li>
                        <li>MD. SHAFIULLAH, SON OF- HAFEJ ABUL HASEM OF {{ $address }}</li>
                    </ol>
                </li>
                <li>
                    Name of the wakil, if any, appointed by the bridegroom, his father's name and his residence:<br />
                    <div class="text-center font-bold">NOT APPLICABLE</div>
                </li>
                <li>
                    The name of the witnesses to the appointment of the bridegroom's wakil with their father's name and
                    their
                    residences:
                    <div class="text-center font-bold">NOT APPLICABLE</div>
                </li>
                <li>
                    Names of the witnesses to the marriage, their father's names and their residences:
                    <ol class="list-decimal ml-8 mt-1 space-y-1 font-bold">
                        <li>ABDUL MOTALIB , SON OF- REJMOT ALI OF {{ $address }}</li>
                        <li>MD. SAYED ALI , SON OF- MD. NASIR UDDIN OF {{ $address }}</li>
                    </ol>
                </li>
                <li>
                    Date on which the marriage was contracted: <strong>{{ $dom }}</strong>
                </li>
                <li>
                    Amount of dower: <span class="font-bold">1,50,000/- (ONE LAKH & FIFTY THOUSAND) TAKA ONLY.</span>
                </li>
                <li>
                    How much of the dower is muajjal (prompt) and how much muwajjal (deferred):
                    <div class="grid grid-cols-2 gap-0 font-bold text-center">
                        <div>.............................. HALF ..............................</div>
                        <div>.............................. HALF ..............................</div>
                    </div>
                </li>
                <li>
                    Whether any portion of the dower was paid at the time of marriage, If so how much?
                    <div class="font-bold">
                        PAID BY ORNAMENT CASH TAKA. 1,10,000/- (ONE LAKH & TEN THOUSAND) TAKA ONLY
                    </div>
                </li>
            </ol>
        </div>
    </div>

    <div class="pagebreak"></div>

    <div class="page-2">
        <!-- Notary Sticket -->
        <img class="notary-sticker" src="{{ image_to_base64('notary-sticker.png') }}" alt="Notary Sticker">
        <img class="notary-sticker-2" src="{{ image_to_base64('notary-sticker.png') }}" alt="Notary Sticker">

        <div class="page-content scanned-text">
            <div class="text-center mt-[5mm]">(2)</div>

            <ol class="list-decimal pl-4 space-y-3">
                <li value="16">
                    Whether any property was given in lieu of the whole or any portion of the dower, with
                    Specification of the sake and it valuation agreed to between parties:
                    <div class="text-center font-bold">NO</div>
                </li>
                <li>
                    Special condition, if any:
                    <strong>
                        THE HUSBAND WILL PROVIDE MONTHLY EXPENDITURE PROPERLY. AS PREVALING GENTLEMENTLY STATUS.
                    </strong>
                </li>
                <li>
                    Whether the husband has delegated the power of divorce to the wife. If so, under what condition:
                    <strong>
                        YES, THE WIFE HAS GIVEN PERMISSION TO DIVORCE HER HUSBAND; IF THE HUSBAND IS OUTSIDE THE HOUSE
                        FOR A LONG TIME, IF THERE IS NO ADJUSTMENT AND HE DOES NOT GIVE MAINTENANCE TO WIFE.
                    </strong>
                </li>
                <li>
                    Whether the husband'S right of divorce is in any way curtailed:
                    <div class="text-center font-bold">NO</div>
                </li>
                <li>
                    Whether any document was drawn up at the time of marriage relating to dower. Maintenance, etc, if
                    so,
                    contents thereof in brief:
                    <div class="text-center font-bold">NO</div>
                </li>
                <li>
                    Whether the bridegroom has any existing wife and if so whether he has secured the permission of the
                    Arbitration Council under the Muslim family Laws Ordinance, 1961, to contract another.
                    <div class="text-center font-bold">NO</div>

                </li>
                <li>
                    Number and date of the communication convoying to the bridegroom the permission of the arbitration
                    Council
                    to contract another marriage.
                    <div class="text-center font-bold">NOT APPLICABLE</div>

                </li>
                <li>
                    Name and addresses of the person by whom the marriage was solemnized and his father:
                    <strong>
                        RAHMAT ULLAH, SON OF- FAZLUR RAHMAN OF {{ $address }}
                    </strong>
                </li>
                <li>
                    Date of registration of marriage: <strong>{{ $dom }}</strong>
                </li>
                <li>
                    Registration fee: <strong>2,100/- (TWO THOUSANDS AND ONE HUNDRED) TAKA ONLY</strong>
                </li>
            </ol>

            <div class="grid grid-cols-3 gap-x-8 gap-y-12 mt-14">
                <div class="divide-y-[1px] divide-black">
                    <div class="font-bold">SD/. {{ $husband_name }}</div>
                    <div class="text-center">Signature of the groom</div>
                </div>

                <div class="divide-y-[1px] divide-black">
                    <div class="font-bold">SD/.</div>
                    <div class="text-center">Signature of the groom wakil</div>
                </div>

                <div class="divide-y-[1px] divide-black">
                    <div class="font-bold">SD/.</div>
                    <div class="text-center">Signature of the witness to the appointment of bridegroom's wakil
                    </div>
                </div>

                <div class="divide-y-[1px] divide-black">
                    <div class="font-bold">SD/. {{ $name }}</div>
                    <div class="text-center">Signature of the bride</div>
                </div>

                <div class="divide-y-[1px] divide-black">
                    <div class="font-bold">SD/. MD RAFIQ</div>
                    <div class="text-center">Signature of wakil of the bride</div>
                </div>

                <div class="divide-y-[1px] divide-black">
                    <div class="font-bold">
                        1. SD/. MD. MOHSIN MIAH <br>
                        2. SD/ MD. SHAFI ULLAH
                    </div>
                    <div class="text-center">Signature of the witness to the
                        Appointment of bride's wakil.
                    </div>
                </div>

                <div class="divide-y-[1px] divide-black">
                    <div class="text-center">Signature of the witness to the marriage.</div>
                    <div class="font-bold">
                        1. SD/. ABDUL MOTALIB <br>
                        2. SD/. MD. SAYED ALI
                    </div>
                </div>

                <div class="divide-y-[1px] divide-black">
                    <div class="font-bold">SD/. ABDULLAH AL MAMUN</div>
                    <div class="text-center">Signature and seal of the Nikah Registrar</div>
                </div>

                <div class="divide-y-[1px] divide-black">
                    <div class="font-bold">SD/. RAHMAT ULLAH</div>
                    <div class="text-center">Signature of the person who
                        Solemnized the marriage.
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
