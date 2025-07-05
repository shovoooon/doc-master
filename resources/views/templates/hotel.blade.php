@php
    // Assuming $dateInput comes from your form submission
    $checkInDate = \Carbon\Carbon::parse($departure);

    $checkIndayName = $checkInDate->format('l'); // Full day name (e.g., "Monday")
    $checkInDay = $checkInDate->format('d'); // Day of month (01-31)
    $checkInMonth = $checkInDate->format('M'); // Full month name (e.g., "January")
    $checkInYear = $checkInDate->format('Y'); // 4-digit year

    $checkOutDate = \Carbon\Carbon::parse($return);

    $checkOutdayName = $checkOutDate->format('l'); // Full day name (e.g., "Monday")
    $checkOutDay = $checkOutDate->format('d'); // Day of month (01-31)
    $checkOutMonth = $checkOutDate->format('M'); // Full month name (e.g., "January")
    $checkOutYear = $checkOutDate->format('Y'); // 4-digit year

    $days = $checkInDate->diffInDays($checkOutDate);

@endphp

@php
    $part1 = random_int(1000, 9999); // 4 digits (3826)
    $part2 = random_int(100, 999); // 3 digits (549)
    $part3 = random_int(100, 999); // 3 digits (233)
    $confirmationNumber = "$part1.$part2.$part3";
    $pinCode = random_int(1000, 9999);
@endphp

@php
    if (isset($hotel['hotel_name'])) {
        $hotelName = $hotel['hotel_name'];
    } else {
        $hotelName = 'Rose Cottage Hotel';
    }

    if (isset($hotel['address'])) {
        $hotelAddress = $hotel['address'] . ', ' . $hotel['zip'] . ' ' . $hotel['city'] . ', Malaysia';
    } else {
        $hotelAddress = 'No. 40 Jalan Impian Senai Utama, Taman Impian Senai, 81400 Senai, Johor, Malaysia';
    }

    if (isset($hotel['rawData']['photoUrls'])) {
        $hotelImage = $hotel['rawData']['photoUrls'][0];
    } else {
        $hotelImage = 'https://lh3.googleusercontent.com/proxy/W_8ZfpgIqqPx1koY7xvGF-mpjo968Uo5nwRB4n5aw_TJ_g4n7QRDyXg-7G_mWbL0I6A1JqVwi-xzykJ7gHdaj6g29WH-iByFOvH5Owcp3CZ7zKVqljX6zBBzbPkE_YOErGZ2AsBrxaUYHMIDaPPgxZAszZua0Q=w253-h189-k-no';
    }
@endphp

{{-- @dd($hotel) --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .pagebreak {
            page-break-before: always;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900">
    <div class="p-6 max-w-5xl mx-auto">
        <div class="flex justify-between items-start mb-1">
            <div class="font-bold text-3xl flex">
                <span class="text-blue-900 ">Booking</span>
                <span class="text-sky-500">.com</span>
            </div>
            <div class="flex flex-col">
                <p class="text-gray-900 text-base">Booking Confirmation</p>
                <div class="flex flex-col">
                    <p class="text-gray-800 text-xs">CONFIRMATION NUMBER: <span class="text-sky-500 font-bold">
                            {{ $confirmationNumber }}
                        </span>
                    </p>
                    <p class="text-gray-800 text-xs">PIN CODE: <span class="text-sky-500 font-bold">
                            {{ $pinCode }}</span></p>
                </div>
            </div>
        </div>
        <div class="border border-gray-500 border-2 bg-gray-100 px-3 py-2">
            <div class="border-b border-gray-500 flex flex-row gap-2 pb-2">
                <div class="flex-1 flex flex-row gap-2 items-center">
                    <img src="{{ image_to_base64($hotelImage) }}" class="w-24 h-24"
                        alt="{{ $hotel['hotel_name'] ?? 'Hotel image' }}">
                    <div class="flex flex-col gap-1 text-xs">
                        <span class="text-gray-900 font-bold text-base">{{ $hotelName }}</span>
                        <span class="text-gray-900 font-bold">Address: <span class="text-xs text-gray-900 font-normal">
                                {{ $hotelAddress }}
                            </span>
                        </span>
                        <span class="text-gray-900 font-bold">Phone: <span class="text-xs text-gray-900 font-normal">
                                +60 11 5621 5392
                            </span>
                        </span>
                        <span class="text-gray-900 font-bold">GPS Coordinates: <span
                                class="text-xs text-gray-900 font-normal">N 003° 4.304, E 101° 42.580</span>
                        </span>
                    </div>
                </div>
                <div class="w-28 border-x border-gray-500 flex flex-col justify-between items-center">
                    <span class="text-gray-900 text-[10px]">CHECK-IN</span>
                    <span class="font-bold text-2xl text-gray-900">{{ $checkInDay }}</span>
                    <span class="font-bold text-sm text-gray-900 uppercase">{{ $checkInMonth }}</span>
                    <span class="text-xs text-gray-800 italic">{{ $checkIndayName }}</span>
                    <div class="flex flex-row items-center text-xs text-gray-900">
                        <i class="ri-timer-line"></i>
                        <span>14:00 - 23:00</span>
                    </div>
                </div>
                <div class="w-28 border-r border-gray-500 flex flex-col justify-between items-center">
                    <span class="text-gray-900 text-[10px]">CHECK-OUT</span>
                    <span class="font-bold text-2xl text-gray-900">{{ $checkOutDay }}</span>
                    <span class="font-bold text-sm text-gray-900 uppercase">{{ $checkOutMonth }}</span>
                    <span class="text-xs text-gray-800 italic">{{ $checkOutdayName }}</span>
                    <div class="flex flex-row items-center text-xs text-gray-900">
                        <i class="ri-timer-line"></i>
                        <span>06:00 - 12:00</span>
                    </div>
                </div>
                <div class="w-20 flex flex-col items-center gap-1">
                    <div class="w-full flex flex-row justify-around">
                        <span class="text-gray-900 text-[10px]">ROOMS</span>
                        <span class="text-gray-900 text-[10px]">NIGHTS</span>
                    </div>
                    <div class="w-full flex flex-row justify-evenly">
                        <span class="text-gray-900 text-2xl font-bold">1</span>
                        <span class="text-xl text-gray-800">/</span>
                        <span class="text-gray-900 text-2xl font-bold">{{ $days }}</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col py-2">
                <span class="text-gray-950 text-md font-bold">PRICE</span>
                <div class="flex flex-col">
                    <div class="flex justify-between text-xs text-gray-900">
                        <span>1 room</span>
                        <span>BDT 63,931</span>
                    </div>
                    <div class="flex justify-between text-gray-900">
                        <span class="text-xl">Subtotal</span>
                        <span class="text-base">approx. <span class="text-xl">BDT 63,931</span>
                        </span>
                    </div>
                    <div class="flex justify-between text-xs text-gray-900">
                        <span>(for 1 guest)</span>
                        <span>MYR 2,261</span>
                    </div>
                    <div class="flex text-xs text-gray-900">
                        <span>Additional charges</span>
                    </div>
                    <div class="flex text-xs text-gray-900">
                        <span>The price you see below is an approximate that may include fees based on the maximum
                            occupancy. This can include taxes set by local governments or
                            charges set by the property.
                        </span>
                    </div>
                    <div class="flex justify-between text-xs text-gray-900">
                        <span>Tax (8.0000%)</span>
                        <span>BDT 5,114</span>
                    </div>
                    <div class="flex justify-between text-xs text-gray-900">
                        <span>Tourism fee (BDT 282.76 × nights)</span>
                        <span>BDT 7,069</span>
                    </div>
                    <div class="flex justify-between text-xs text-gray-900">
                        <span>Price</span>
                        <span class="text-xs">approx. <span class="text-xs"> BDT 76,114*</span>
                        </span>
                    </div>
                    <div class="flex justify-end text-gray-900">
                        <span class="text-base"> You'll pay 2,691.88 in MYR.</span>
                    </div>
                    <span class="text-xs text-blue-800">* Tourism Fee (if applicable) refers to the Malaysian Tourism
                        Tax</span>
                </div>

                <!--Letter-->

                <div class="flex flex-col mt-1 border-b pb-1 border-gray-500">
                    <span class="font-bold text-sm text-gray-950">
                        The final price shown is the amount you'll pay to the property.
                    </span>
                    <span class="text-xs text-gray-800">
                        Booking.com doesn't charge guests any reservation, administration, or other fees. <br>
                        Your card issuer may charge you a foreign transaction fee.
                    </span>
                </div>
                <div class="flex flex-col border-b pb-1 border-gray-500">
                    <span class="font-bold text-sm text-gray-950">
                        Payment information
                    </span>
                    <span class="text-xs text-gray-800">
                        {{ $hotelName }} handles all payments. <br>
                        This property accepts the following forms of payment: Cash only
                    </span>
                </div>
                <div class="flex flex-col border-b pb-1 border-gray-500">
                    <span class="font-bold text-sm text-gray-950">
                        Currency and exchange rate information
                    </span>
                    <span class="text-xs text-gray-800">
                        You'll pay {{ $hotelName }} in MYR according to the
                        exchange rate on the day of
                        payment.
                        <br>
                        The amount displayed in BDT is just an estimate based on <strong>today's</strong> exchange rate
                        for MYR.
                    </span>
                </div>
                <div class="flex flex-col border-gray-500">
                    <span class="font-bold text-sm text-gray-950">
                        Additional information
                    </span>
                    <span class="text-xs text-gray-800">
                        Please note that additional supplements (e.g. extra bed) are not added in this total. <br>
                        If you cancel, applicable taxes may still be charged by the property. <br>
                        If you don’t show up at this booking, and you don’t cancel beforehand, the property is liable to
                        charge you the full reservation amount. <br>
                        Please remember to read the <strong>Important information</strong> below, as this may contain
                        important details not mentioned here.
                    </span>
                </div>
            </div>
        </div>
        {{-- <div id="map" style="height: 250px;">
        </div> --}}
        <div class="border border-gray-500 border-2 bg-gray-100 px-3 py-2">
            <div class="grid grid-cols-6">
                <div class="col-span-4 border-r border-gray-500 pr-2">
                    <div class="flex flex-col gap-2">
                        <div class="flex flex-col gap-1">
                            <span class="text-sm text-gray-950 font-bold">
                                Deluxe Single Room <span>🚭</span>
                            </span>
                            <span class="text-gray-950 text-[10px] font-bold">Guest name:
                                <span class="font-normal text-gray-900">
                                    {{ $name }} /for max 1 person.
                                </span>
                            </span>
                            <span class="text-gray-950 text-[10px] font-bold">
                                Meal Plan:
                                <span class="font-normal text-gray-900">
                                    There is no meal option with this room.
                                </span>
                            </span>
                        </div>
                        <div class="flex flex-col gap-2">
                            <span class="font-normal text-gray-900 text-[10px] leading-3">
                                Private bathroom • View • Free toiletries • Shower • Air conditioning • Toilet • Towels
                                • Linen • Socket near the bed •
                                Desk • TV • Ironing facilities • Coffee machine • Tea/Coffee maker • Flat-screen TV •
                                Hairdryer • Carpeted • Clothes
                                rack • Toilet paper • Carbon monoxide detector
                            </span>
                            <span class="font-normal text-gray-900 text-[10px]"><strong>Bed Size(s):</strong>
                                1 double bed (130-145 cm wide)
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 flex justify-center px-2 text-[10px] leading-none">
                    <div class="flex flex-col gap-2 flex justify-center">
                        <span class="text-gray-950 font-bold">Prepayment: <span class="font-normal text-gray-900">No
                                prepayment is
                                needed.
                            </span>
                        </span>
                        <div class="flex flex-col gap-1">
                            <span class="text-gray-950 font-bold">Cancellation cost:</span>
                            <div class="flex flex-col gap-1">
                                <span class="font-normal text-gray-900 text-[10px]">
                                    until {{ \Carbon\Carbon::parse($departure)->format('j F Y') }} 18:00 [+08]:
                                    MYR 0
                                </span>
                                <span class="font-normal text-gray-900 text-[10px]">
                                    from {{ \Carbon\Carbon::parse($return)->format('j F Y') }} 18:00 [+08]:
                                    <span class="text-red-700">MYR 110.16 –</span>
                                </span>
                                <span class="font-normal text-red-700 text-[10px]">
                                    Changing the dates of your stay is not possible.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pagebreak"></div>

        {{-- info and policies --}}
        <section class="px-3 py-6">
            <div class="border-b pb-3 border-gray-300">
                <div class="grid grid-cols-6">
                    <div class="col-span-3">
                        <div class="flex items-center">
                            <!-- Info icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                            <span class="ml-1 text-sm font-bold">Important information</span>
                        </div>
                        <div class="px-8">
                            <div class="text-[9px] mb-1">This property will not accommodate hen, stag or similar parties.
                            </div>

                            @isset($hotel['hotel_important_information_with_codes'])
                                @foreach ($hotel['hotel_important_information_with_codes'] as $hotel_info)
                                    <div class="text-[9px] mb-1">
                                        {{ $hotel_info['phrase'] }}
                                    </div>
                                @endforeach

                            @endisset
                        </div>
                    </div>

                    <div class="col-span-3">
                        <div class="flex items-center">
                            <!-- Info icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span class="ml-1 text-sm font-bold">Hotel Policies</span>
                        </div>
                        <div class="px-8 text-[9px]">
                            <span class="font-bold">Guest parking</span> <br>
                            <ul class="list-disc">
                                <li>No parking available.</li>
                                <li>WiFi is available in all areas and is free of charge.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="grid grid-cols-6 mt-3">
                <div class="col-span-3">
                    <div class="flex gap-2">
                        <!-- Gear Icon -->
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"
                                class="w-7 h-7">
                                <path
                                    d="M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434zM8 12.997a4.998 4.998 0 1 1 0-9.995 4.998 4.998 0 0 1 0 9.996z" />
                            </svg>
                        </div>

                        <div class="text-[9px]">
                            <div class="mb-2 text-[9px] leading-none">
                                <span>
                                    Need help?
                                    <br>
                                    <span class="font-bold">You can always view, change or cancel your booking online
                                        at:
                                    </span>
                                    <br>
                                    <u>your.booking.com</u>
                                </span>
                            </div>

                            <div class="mb-2 text-[9px] leading-none">
                                <span>For any questions related to the property, you can contact The Concept
                                    {{ $hotelName }} directly on: +60 11 5621
                                    5392</span>
                            </div>

                            <div class="mb-1 text-[9px] leading-none border-b pb-1 border-gray-300">
                                <span class="font-bold">
                                    Or contact us by phone - we're available 24 hours a day:
                                </span>
                                <br>
                                <span>
                                    When abroad or from Malaysia: +44 20 3320 2609
                                </span>
                            </div>
                            <div class="mb-1 text-[9px] leading-none border-b pb-1 border-gray-300">
                                <span>
                                    Travel with peace of mind <br>
                                    Looking for information about travelling safely? The Safety resource
                                    centre can help you prepare for your trip and enjoy a safe, relaxing stay.
                                </span>

                                <div class="font-bold text-blue-500 pt-1 pb-1">
                                    <u>See Safety resource centre</u>
                                </div>

                                <span>
                                    We’ve gathered the most important local phone numbers to help give
                                    you complete peace of mind during your stay in Malaysia.
                                </span>
                                <div class="font-bold text-blue-500 pt-1 pb-1">
                                    <u>See local emergency services</u>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-span-3">

                </div>
            </div>
        </section>

    </div>

    <script>
        var map = L.map('map').setView([3.071963078719531, 101.71043137339306], 18); // Vancouver coordinates

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([49.278983, -123.123233]).addTo(map)
            .bindPopup('Hotel 101 Ulu Tiram')
            .openPopup();
    </script>
</body>

</html>
