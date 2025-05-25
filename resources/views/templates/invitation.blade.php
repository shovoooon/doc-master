{{-- @dd($company) --}}
@php
$tel = '+603-03' . rand(111111, 999999);
$fax = '+603-03' . rand(111111, 999999);
$hp = '+603-03' . rand(111111, 999999);
$companyEmail = preg_replace('/[^a-zA-Z]/', '', $company_name) . '@gmail.com';
$issueDate = \Carbon\Carbon::parse($invitation_issued)->format('d M Y');

$logo = $company->logo ? 'storage/'.$company->logo : 'logo.PNG';
$sign = $company->signature ? 'storage/'.$company->signature : '9825147.jpg';
@endphp


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>{{$title}}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

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
            font-family: 'Inter', sans-serif;
            font-size: 10pt;
            line-height: 1.4;
            margin: 0 auto;
            padding: 40px 50px 0 50px;
            position: relative;
        }

        .watermark-logo {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            z-index: -1;
            pointer-events: none;
            width: 60%;
            max-height: 60%;
            filter: grayscale(100%);
        }

        .company-header {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 24px;
            text-align: center;
            margin-bottom: 1px;
        }

        .header-logo {
            height: auto;
            width: 100px;
            margin-right: 5px;
        }

        .company-details {
            text-align: center;
            font-size: 11px;
        }

        .company-reg {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            margin: 0;
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
            margin: 0 0 20px 0;
            font-size: 10pt;
        }

        table,
        th,
        td {
            border: 2px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .signature {
            margin-top: 50px;
        }

        .footer {
            margin-top: 30px;
        }

        #signatureImage {
            height: 65px;
            margin-top: 10px;
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
            stroke-width: 3;
            fill: none;
        }

        .inner-circle {
            stroke: #0c51b0;
            stroke-width: 2;
            fill: none;
        }

        .circle-text {
            font-family: "Roboto", sans-serif;
            fill: #0c51b0;
            font-weight: bolder;
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
    </style>
</head>

<body>
    <div id="body">

        <img src="{{ image_to_base64($logo) }}" class="watermark-logo" alt="Company Watermark">

        <div class="d-flex justify-content-center mb-1" style="color: #3B5FAD">
            <div class="">
                <img src="{{ image_to_base64($logo) }}" style="height: 80px; width: auto;">
            </div>

            <div class="" style="max-width: 80%">
                <div class="text-center">
                    <div class="h4 fw-bold">{{ $company->name }}</div>
                    <div class="fw-bold">({{ $company->registration_no }})</div>
                    <div class="fw-bold">(Incorporated in Malaysia)</div>
                    <address class="mb-0 fw-bold ps-4 pe-4" style="font-size: 10px">{{ $company->address }}</address>
                </div>

                <div class="d-flex flex-wrap justify-content-center gap-2" style="font-size: 10px">
                    <div>
                        <span class="fw-bold">Tel No:</span>
                        <span>(<span class="fw-bold">Off</span>) {{ $tel }}</span>
                    </div>
                    <div>
                        <span>(<span class="fw-bold">Fax</span>) {{ $fax }}</span>
                    </div>
                    <div>
                        <span>(<span class="fw-bold">H/P</span>) {{ $hp }}</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="separator"></div>

        <div class="date">{{ $issueDate }}</div>

        <div class="recipient-address">
            To<br>
            The Visa Officer<br>
            High Commission of Malaysia<br>
            House No. 19, Road No. 6<br>
            Dhaka 1230, Bangladesh
        </div>

        <div class="subject">
            Subject: Application for a Tourist Visa for {{ $name }}, Passport No: {{ $passport_no }},
            to
            Visit Her
            Husband in Malaysia
        </div>

        <div class="salutation">Dear Sir/Madam,</div>

        <p>I am writing to submit an application for a Malaysian Visitor visa for my employee, <span
                class="bold">{{ $husband_name }}</span>, Passport no - <span
                class="bold">{{ $husband_passport_no }}</span>. We
            would
            like to invite his family members
            from Bangladesh to visit him in Malaysia for a short holiday.</p>

        <p>Family Members Details:</p>

        <table>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Passport No</th>
                <th>Relationship</th>
                <th>Country</th>
            </tr>
            <tr>
                <td>01</td>
                <td>{{ $name }}</td>
                <td>{{ $passport_no }}</td>
                <td>SPOUSE</td>
                <td>BANGLADESH</td>
            </tr>
        </table>

        <p>We wish to invite the above-listed individual to visit Malaysia for a short holiday from
            <strong>{{ \Carbon\Carbon::parse(time: $departure)->format('d M Y') }}</strong> to
            <strong>{{ \Carbon\Carbon::parse(time: $return)->format('d M Y') }}</strong>. The purpose of
            her
            visit
            is to meet our employee <span class="bold">{{ $husband_name }}</span> and explore some of Malaysia's
            famous
            tourist destinations.
        </p>

        <p>We kindly request your favourable consideration and approval of her Tourist Visa applications at your
            earliest
            convenience.
            <br>
            For any clarification, please do not hesitate to contact us.
        </p>

        <p>Thank you for you time and consideration.</p>

        <div class="signature">
            <div class="d-flex flex-row">
                <div>
                    Yours faithfully,
                    <br>
                    <img id="signatureImage" src="{{ image_to_base64($sign) }}" alt="Signature">
                    <div class="mt-2 mb-1" style="width: 120px; margin-left: 0;border-top: 1px solid black"></div>
                    <div>
                        Director<br>
                        H/P: {{ $hp }}<br>
                        <span class="fw-bold">{{ $company_name }}</span>
                    </div>
                </div>
                <!-- Circle Stamp -->
                <div class="circle-stamp" style="height: 40mm; width: 40mm;">
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
                            <text x="75" y="60" class="center-text">CO. NO.</text>
                            <text x="75" y="75" class="center-text">{{ $company->registration_code }}</text>
                            <text x="75" y="90" class="center-text fw-bold"
                                style="font-size: 10px;">({{ $company->registration_no }})</text>
                        </g>

                        <text id="fixed-star" fill="#0c51b0" font-size="14" font-family="'Roboto', Arial, sans-serif"
                            text-anchor="middle" dominant-baseline="middle" pointer-events="none" x="85"
                            y="125">★</text>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textPath = document.getElementById('circularText');
            const textContent = textPath.textContent.trim();
            const textLength = textContent.length;
            const wordCount = textContent.split(/\s+/).length; // Count words

            // Base values (adjust as needed)
            const maxLetterSpacing = 4; // Maximum letter spacing (short text)
            const minLetterSpacing = 0.2; // Minimum letter spacing (long text)
            const maxWordSpacing = 20; // Maximum word spacing (few words)
            const minWordSpacing = 3; // Minimum word spacing (many words)
            const maxLengthForSpacing = 26; // Text length where spacing becomes minimal

            // Calculate letter spacing (inversely proportional to length)
            const letterSpacing = Math.max(
                minLetterSpacing,
                maxLetterSpacing - (textLength / maxLengthForSpacing) * maxLetterSpacing
            );

            // Calculate word spacing (inversely proportional to word count)
            const wordSpacing = Math.max(
                minWordSpacing,
                maxWordSpacing - (wordCount / 5) *
                maxWordSpacing // Adjust divisor (5) based on expected max words
            );

            // Apply spacing
            textPath.style.letterSpacing = `${letterSpacing}px`;
            textPath.style.wordSpacing = `${wordSpacing}px`;
        });
    </script>
</body>

</html>