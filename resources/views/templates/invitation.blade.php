@php
$tel = '+603-03' . rand(111111, 999999);
$fax = '+603-03' . rand(111111, 999999);
$hp = '+603-03' . rand(111111, 999999);
$shortCompanyName = preg_replace('/\s*SDN\s*BHD$/i', '', $company->name);
$companyEmail = substr(strtolower(preg_replace('/[^a-zA-Z]/', '', $company_name)), 0, -6) . '@gmail.com';
$issueDate = \Carbon\Carbon::parse($invitation_issued)->format('d M Y');

$logo = $company->logo ? 'storage/' . $company->logo : 'logo.PNG';
$sign = $company->signature ? 'storage/' . $company->signature : '9825147.jpg';

$header = rand(1, 3);

$title_case_address = ucwords(strtolower($company->address));
@endphp


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <title>{{ $title }}</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            width: 210mm;
            height: 297mm;
            position: relative;
        }

        #body {
            font-size: 14px;
            line-height: 1.35;
            margin: 0 auto;
            padding: 40px 60px 0 60px;
            position: relative;
            font-family: "Times New Roman", Times, serif;
        }

        .watermark-logo {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.12;
            z-index: -1;
            pointer-events: none;
            width: 60%;
            max-height: 60%;
        }

        .separator {
            border-top: 2px solid #3B5FAD;
            margin: 10px 0;
        }

        .date {
            text-align: right;
            margin-bottom: 10px;
        }

        .recipient-address {
            margin-bottom: 30px;
        }

        .subject {
            font-weight: bold;
            margin-bottom: 30px;
        }

        .salutation {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
            font-weight: 600;
        }

        table,
        th,
        td {
            border: 2px solid black;
        }

        th,
        td {
            padding: 5px;
        }

        .bold {
            font-weight: bold;
        }

        .signature {
            margin-top: 60px;
        }

        .footer {
            margin-top: 30px;
        }

        #signatureImage {
            height: 65px;
            margin-top: 10px;
            opacity: 0.9;
        }

        .circle-stamp {
            position: absolute;
            bottom: 10px;
            left: 25%;
            opacity: 0.9;
            pointer-events: none;
        }

        svg {
            width: 150px;
            height: 150px;
        }

        .outer-border {
            stroke: #0c51b0;
            stroke-width: 2;
            fill: none;
        }

        .inner-circle {
            stroke: #0c51b0;
            stroke-width: 1;
            fill: none;
        }

        .circle-text {
            font-family: "Roboto", sans-serif;
            fill: #0c51b0;
            font-weight: 700;
            letter-spacing: 3px;
            font-size: 13px;
            text-transform: uppercase;
        }

        .center-text {
            font-family: "Roboto", sans-serif;
            fill: #0c51b0;
            font-size: 10px;
            text-anchor: middle;
            dominant-baseline: middle;
        }

        .bottom {
            position: absolute;
            bottom: 0;
            width: 213mm;
            height: 15px;
            background-color: #0c51b0;
        }

        .scanned-text {
            filter: blur(0.2px) contrast(0.8);
        }
    </style>
</head>

<body>
    <div id="body">

        <img src="{{ image_to_base64($logo) }}" class="watermark-logo" alt="Company Watermark">

        @include('partials.invitation_header_' . $header)

        <div class="mb-4">
            Date: {{ $issueDate }} <br><br>
            To<br>
            The Visa Officer<br>
            High Commission of Malaysia<br>
            House No. 19, Road No. 6<br>
            Dhaka 1230, Bangladesh
        </div>

        <div class="mb-4 font-bold">
            Subject: Invitation Letter for Mrs. {{ $name }} - Tourist Visa Application
        </div>
        
        <div class="mb-4">Dear Sir/Madam,</div>
        
        {{-- <p>
            I am writing to submit an application for a Malaysian Visitor visa for my employee,
            <span class="bold">{{ $husband_name }}</span>, Passport no - <span class="bold">{{ $husband_passport_no }}</span>.
            We would like to invite his family members from Bangladesh to visit him in Malaysia for a short holiday.
        </p> --}}

        <p class="mb-2">
            We, <span class="bold">{{ $company->name }}</span>, located at <span class="bold">{{$title_case_address}}</span>, Malaysia, would like to formally invite Mrs. <span class="bold">{{ $name }}</span>,
            holder of Bangladeshi Passport No. <span class="bold">{{ $passport_no }}</span>, to visit Malaysia on a
            short-term tourist visa.
        </p>
        
        <p>
            Her husband, Mr. <span class="bold">{{ $husband_name }}</span>, holder of Passport No. <span
                class="bold">{{ $husband_passport_no }}</span>, is currently employed with our company. He wishes to spend
            personal time with his wife in Malaysia during her visit. Mrs. <span class="bold">{{ $name }}</span> will
            reside with him during her stay and will return to Bangladesh before the expiry of her visa.
        </p>
        
        
        <br>
        
        <p class="mb-2 font-bold">Family Members Details:</p>
        
        <table class="mb-4">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Passport No</th>
                <th>Relationship</th>
                <th>Country</th>
            </tr>
        
            {{-- Spouse --}}
            <tr>
                <td>01</td>
                <td>{{ $name }}</td>
                <td>{{ $passport_no }}</td>
                <td>SPOUSE</td>
                <td>BANGLADESH</td>
            </tr>
        
            {{-- Children --}}
            @if(isset($children) && count($children) > 0)
                @foreach($children as $index => $child)
                    <tr>
                        <td>{{ str_pad($index + 2, 2, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $child['name'] }}</td>
                        <td>{{ $child['passport_no'] }}</td>
                        <td>{{ strtoupper($child['relationship']) }}</td>
                        <td>BANGLADESH</td>
                    </tr>
                @endforeach
            @endif
        </table>
        
        {{-- <p class="mb-4">
            We wish to invite the above-listed
            @if(isset($children) && count($children) > 0)
                individuals
            @else
                individual
            @endif
            to visit Malaysia for a short holiday from
            <strong>{{ \Carbon\Carbon::parse($departure)->format('d M Y') }}</strong> to
            <strong>{{ \Carbon\Carbon::parse($return)->format('d M Y') }}</strong>. The purpose of
            @if(isset($children) && count($children) > 0)
                their
            @else
                her
            @endif
            visit is to meet our employee <span class="bold">{{ $husband_name }}</span> and explore some of Malaysia's famous
            tourist destinations.
        </p>
        
        <p>
            We kindly request your favourable consideration and approval of
            @if(isset($children) && count($children) > 0)
                their
            @else
                her
            @endif
            Tourist Visa applications at your earliest convenience. For any clarification, please do not hesitate to contact us.
        </p>


        <p>Thank you for you time and consideration.</p> --}}

        <p class="mb-2">We assure you that all necessary arrangements for her accommodation and expenses will be taken care of during her stay
        in Malaysia. She has no intention to overstay or engage in any employment during her visit.</p>
        
        <p class="mb-2">We kindly request you to consider her application for a tourist visa favorably.</p>
        
        <p>Thank you for your kind attention and cooperation.</p>

        <div class="signature">
            <div class="flex flex-row">
                <div>
                    Yours faithfully,
                    <br>
                    <img id="signatureImage" src="{{ image_to_base64($sign) }}">
                    <div class="mt-2 mb-1" style="width: 120px; margin-left: 0;border-top: 1px solid black"></div>
                    <div>
                        Director<br>
                        H/P: {{ $hp }}<br>
                        <span class="font-bold">{{ $company_name }}</span>
                    </div>
                </div>
                <!-- Circle Stamp -->
                <!-- Container for layering -->
                <div class="relative w-[38mm] h-[38mm]">
                    <!-- SVG Seal (Below, scaled down slightly) -->
                    <div class="circle-stamp scanned-text absolute top-1 left-1 w-[34mm] h-[34mm]">
                        <svg width="100%" height="100%" viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg">
                            <!-- Outer Border -->
                            <circle cx="75" cy="75" r="62" class="outer-border" />
                
                            <!-- Inner Circle -->
                            <circle cx="75" cy="75" r="39" class="inner-circle" />
                
                            <!-- Text around circle -->
                            <defs>
                                <path id="circlePath" d="M75,75 m-45,0 a45,45 0 1,1 90,0 a45,45 0 1,1 -90,0" />
                            </defs>
                
                            <text class="circle-text" transform="rotate(-100 75 75)">
                                <textPath href="#circlePath" startOffset="50%" text-anchor="middle">
                                    @if (strlen($company->name) > 24)
                                        {{ $shortCompanyName }}
                                    @else
                                        {{ $company->name }}
                                    @endif
                                </textPath>
                            </text>
                
                            <!-- Center Texts -->
                            <g transform="rotate(-10, 75, 75)">
                                <text x="75" y="60" class="center-text"></text>
                                <text x="75" y="75" class="center-text font-bold"
                                    style="font-size: 12px;">{{ $company->registration_no }}</text>
                            </g>
                
                            <!-- Star -->
                            <text id="fixed-star" fill="#0c51b0" font-size="12" font-family="'Roboto', Arial, sans-serif"
                                text-anchor="middle" dominant-baseline="middle" pointer-events="none" x="85" y="125">★</text>
                        </svg>
                    </div>
                
                    <!-- PNG overlay (Above) -->
                    <img src="{{ image_to_base64('se.png') }}"
                        class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-50">
                </div>
                


                {{-- <div class="circle-stamp scanned-text" style="height: 40mm; width: 40mm;">
                    <svg width="40mm" height="40mm" viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg">
                        <!-- Outer Border -->
                        <circle cx="75" cy="75" r="62" class="outer-border" />

                        <!-- Inner Circle -->
                        <circle cx="75" cy="75" r="39" class="inner-circle" />

                        <!-- Text around circle -->
                        <defs>
                            <path id="circlePath" d="M75,75 m-45,0 a45,45 0 1,1 90,0 a45,45 0 1,1 -90,0" />
                        </defs>

                        <text class="circle-text" transform="rotate(-100 75 75)">
                            <textPath id="circularText" href="#circlePath" startOffset="50%" text-anchor="middle">
                                {{ $company_name }}
                            </textPath>
                        </text>

                        <!-- Grouped and rotated center texts -->
                        <g transform="rotate(-10, 75, 75)">
                            <text x="75" y="60" class="center-text"></text>
                            <text x="75" y="75" class="center-text">{{ $company->registration_code }}</text>
                            <text x="75" y="90" class="center-text font-bold"
                                style="font-size: 10px;">({{ $company->registration_no }})</text>
                        </g>

                        <text id="fixed-star" fill="#0c51b0" font-size="14" font-family="'Roboto', Arial, sans-serif"
                            text-anchor="middle" dominant-baseline="middle" pointer-events="none" x="85"
                            y="125">★</text>
                    </svg>
                </div> --}}
            </div>
        </div>

    </div>

    <div class="bottom">
        <div style="height: 5px; width: 100%; background-color: #6aa8ff;">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const textPath = document.getElementById('circularText');
            const textContent = textPath.textContent.trim();
            const textLength = textContent.length;
            const wordCount = textContent.split(/\s+/).length;

            const maxLetterSpacing = 4;
            const minLetterSpacing = 0.2;
            const maxWordSpacing = 20;
            const minWordSpacing = 3;
            const maxLengthForSpacing = 26;

            let letterSpacing = Math.max(
                minLetterSpacing,
                maxLetterSpacing - (textLength / maxLengthForSpacing) * maxLetterSpacing
            );

            let wordSpacing = Math.max(
                minWordSpacing,
                maxWordSpacing - (wordCount / 5) * maxWordSpacing
            );

            if (textLength > 26) {
                letterSpacing = 0.05;
                wordSpacing = 0.5;
            }

            textPath.style.letterSpacing = `${letterSpacing}px`;
            textPath.style.wordSpacing = `${wordSpacing}px`;
        });
    </script>
</body>

</html>