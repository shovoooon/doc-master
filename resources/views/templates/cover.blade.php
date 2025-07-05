    {{-- <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            @page {
                size: A4;
                margin: 0;
            }

            @media print {
                body {
                    width: 210mm;
                    height: 297mm;
                    margin: 0;
                    padding: 20mm;
                }

                .page-break {
                    page-break-after: always;
                }
            }
        </style>
    </head>

    <body class="bg-white font-sans text-gray-800 max-w-4xl mx-auto" style="height: 297mm; width: 210mm;">

        <!-- Date and Address -->
        <div class="mb-8">
            <div>
                <p>Date: <span class="">{{ \Carbon\Carbon::parse($cover_issued)->format('d F, Y') }}</span></p>
            </div>
            <div class="">
                <p>To</p>
                <p>The Visa Officer</p>
                <p>High Commission of Malaysia</p>
                <p>House No. 19, Road No. 6, Dhaka 1230</p>
                <p>Bangladesh</p>
            </div>
        </div>

        <!-- Subject Line -->
        <div class="mb-6">
            <p class="font-semibold">Subject: Application for Tourist Visa to visit my husband in Malaysia</p>
        </div>

        <!-- Salutation -->
        <div class="mb-4">
            <p>Dear Sir/Madam,</p>
        </div>

        <!-- Letter Body -->
        <div class="mb-6 space-y-4">
            <p>I, <span class=" font-semibold">{{ $name }}</span>, holder of Bangladeshi passport no. <span
                    class=" font-semibold">{{ $passport_no }}</span>, would like to apply for a tourist visa to visit
                my husband in Malaysia.</p>

            <p>My husband, <span class=" font-semibold">{{ $husband_name }}</span>, is currently residing in Malaysia
                and works at <span class=" font-semibold">{{ $company_name }}</span> in Malaysia.</p>

            <p>I wish to visit him from <span
                    class="font-semibold">{{ \Carbon\Carbon::parse($departure)->format('d F, Y') }}</span> to
                <span class="font-semibold">{{ \Carbon\Carbon::parse($return)->format('d F, Y') }}</span>. During my
                stay, I will be accommodated at my husband's
                residence at <span class="font-semibold capitalize">{{ $company_address }}</span>
            </p>

            <p>I have attached all required documents including:</p>
            <ul class="list-disc ml-8">
                <li>My husband's passport and visa copies</li>
                <li>Marriage certificate</li>
                <li>Invitation letter</li>
                <li>Proof of accommodation</li>
                <li>Bank statement and solvency</li>
                <li>Return flight booking</li>
            </ul>

            <p>I assure you that I will abide by all Malaysian laws and regulations during my stay and will return to
                Bangladesh before my visa expires. My husband will bear all expenses during my visit.</p>
        </div>

        <!-- Closing -->
        <div class="mb-12 space-y-4">
            <p>I would be grateful for your favorable consideration of my application.</p>
            <p>Thank you for your time and consideration.</p>
            <p>Yours sincerely,</p>
            <p>{{ $name }}</p>
        </div>

    </body>

    </html> --}}



    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            @page {
                size: A4;
                margin: 0;
            }
    
            @media print {
                body {
                    width: 210mm;
                    height: 297mm;
                    margin: 0;
                    padding: 20mm;
                }
    
                .page-break {
                    page-break-after: always;
                }
            }

            body {
                line-height: 1.1;
            }
        </style>
    </head>
    
    <body class="bg-white text-black max-w-4xl leading-[1.3] text-[12pt]" style="height: 297mm; width: 210mm;">
    
        <!-- Date and Address -->
        <div class="mb-4">
            <div class="mb-2">
                <p>Date: <span>{{ \Carbon\Carbon::parse($cover_issued)->format('d F, Y') }}</span></p>
            </div>
            <div class="">
                <p>To</p>
                <p>The Visa Officer</p>
                <p>High Commission of Malaysia</p>
                <p>House No. 19, Road No. 6, Dhaka 1230</p>
                <p>Bangladesh</p>
            </div>
        </div>
    
        <!-- Subject Line -->
        <div class="mb-4">
            <p class="font-semibold">Subject: Application for Tourist Visa to visit my husband in Malaysia</p>
        </div>
    
        <!-- Salutation -->
        <div class="mb-4">
            <p>Dear Sir/Madam,</p>
        </div>
    
        <!-- Letter Body -->
        <div class="mb-4 space-y-4">
            <p>I, <span class=" font-semibold">{{ $name }}</span>, holder of Bangladeshi passport no. <span
                    class=" font-semibold">{{ $passport_no }}</span>, would like to apply for a tourist visa to visit
                my husband in Malaysia.</p>
        
            <p>My husband, <span class=" font-semibold">{{ $husband_name }}</span>, is currently residing in Malaysia
                and works at <span class=" font-semibold">{{ $company_name }}</span> in Malaysia.</p>
        
            {{-- Show this section only if traveller has children --}}
            @if(isset($children) && count($children) > 0)
                <p>
                    I will be traveling with my
                    {{ collect($children)->pluck('relationship')->map(fn($r) => strtolower($r))->implode(', ') }}
                    @if(count($children) === 1)
                        named <span class="font-semibold">
                            {{ $children[0]['name'] }} ({{ $children[0]['passport_no'] }})
                        </span>
                    @else
                        including
                        @foreach($children as $index => $child)
                            <span class="font-semibold">
                                {{ $child['name'] }} ({{ $child['passport_no'] }})
                            </span>{{ $loop->last ? '' : ', ' }}
                        @endforeach
                    @endif
                    who will accompany me during the visit.
                </p>
            @endif

        
            <p>I wish to visit him from <span
                    class="font-semibold">{{ \Carbon\Carbon::parse($departure)->format('d F, Y') }}</span> to
                <span class="font-semibold">{{ \Carbon\Carbon::parse($return)->format('d F, Y') }}</span>. During my
                stay, I will be accommodated at my husband's
                residence at <span class="font-semibold capitalize">{{ $company_address }}</span>
            </p>
        
            <p>I have attached all required documents including:</p>
            <ul class="list-disc ml-8">
                <li>My husband's passport and visa copies</li>
                <li>Marriage certificate</li>
                <li>Invitation letter</li>
                <li>Proof of accommodation</li>
                <li>Bank statement and solvency</li>
                <li>Return flight booking</li>
        
                @if(isset($children) && count($children) > 0)
                    <li>Birth certificate(s) of my child(ren)</li>
                    <li>Passport copies of my child(ren)</li>
                @endif
            </ul>
        
            <p>I assure you that I will abide by all Malaysian laws and regulations during my stay and will return to
                Bangladesh before my visa expires. My husband will bear all expenses during my visit.</p>
        </div>

    
        <!-- Closing -->
        <div class="space-y-4">
            <p>I would be grateful for your favorable consideration of my application.</p>
            <p>Thank you for your time and consideration.</p>
        </div>

        <div class="mt-8">
            <p class="mb-12">Yours sincerely,</p>
            <p class="font-bold">{{ $name }}</p>
        </div>
    
    </body>
    
    </html>