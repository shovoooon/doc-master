@php
    $issueDate = \Carbon\Carbon::parse($ticket_issued)->format('d F, Y');
    $onwardDate = \Carbon\Carbon::parse($departure)->format('D d M, Y');
    $returnDate = \Carbon\Carbon::parse($return)->format('D d M, Y');
    $passportExpiryDate = \Carbon\Carbon::parse($passport_expiry)->format('d M Y');

    $pnr = generate_airline_pnr();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{$title}}</title>

    <!-- Google Fonts: Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        roboto: ['Roboto', 'sans-serif'],
                    },
                },
            },
        };
    </script>

    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- Leaflet CSS & JS -->
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

        td {
            font-size: 12px !important;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800 text-sm font-normal font-roboto">
    <div class="p-6 relative max-w-5xl mx-auto bg-white">
        <span
            class="font-semibold text-gray-500 text-5xl opacity-20 absolute uppercase 
      transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 -rotate-45">
            Global Air Trip
        </span>

        <div class="flex justify-between">
            <div class="flex flex-col">
                <span class="text-lg text-blue-800 font-semibold">GLOBAL AIR TRIP</span>
                <div class="flex gap-1">
                    <span class="text-sm text-gray-900 font-semibold">Opening Hrs:</span>
                    <span class="text-sm text-gray-700">09 AM - 08 PM</span>
                </div>
                <div class="flex gap-1">
                    <span class="text-sm text-gray-900 font-semibold">Ticket support:</span>
                    <span class="text-sm text-gray-700">601123882104</span>
                </div>
                <div>
                    <span class="text-sm text-gray-900 font-semibold">Address:</span>
                    <span class="text-sm text-gray-700">
                        No 35A 1st Floor, Jalan Wong Ah Fook, 80000,<br>
                        Johor Bahru Johor, Malaysia
                    </span>
                </div>
                <div class="flex gap-1">
                    <span class="text-sm text-gray-900 font-semibold">Email:</span>
                    <span class="text-sm text-gray-700">globalairtrip.gat@gmail.com</span>
                </div>
            </div>
            <div class="flex items-center">
                <img src="{{ image_to_base64('logo.PNG') }}" alt="" class="py-4">
            </div>
        </div>
        <div class="flex justify-end">
            <div class="flex flex-col text-end">
                <span class="text-base font-semibold text-blue-700">Flight Information</span>
                <div class="flex items-center">
                    <img src="{{ image_to_base64('whats.avif') }}" alt="" class="w-7">
                    <span class="text-sm text-blue-700">+601123882104</span>
                </div>
            </div>
        </div>
        <div class="text-center">
            <span class="text-xl text-blue-700 font-bold">E-BOOKING</span>
        </div>
        <div class="flex flex-col">
            <div class="flex items-center gap-1 mb-1">
                <i class="ri-user-line text-xl text-gray-500"></i>
                <span class="text-gray-700 font-semibold text-sm">PASSENGER INFORMATION</span>
            </div>
            <table class="w-full border border-gray-300 border-collapse text-xs">
                <thead>
                    <tr class="bg-blue-700 text-white">
                        <th class="border border-gray-300 text-left px-2 py-1">PASSENGER</th>
                        <th class="border border-gray-300 text-center px-2 py-1">PASSPORT NO</th>
                        <th class="border border-gray-300 text-center px-2 py-1">PASSPORT EXPIRY</th>
                        <th class="border border-gray-300 text-center px-2 py-1">TICKET</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 text-left px-2 py-1">{{ $name }}</td>
                        <td class="border border-gray-300 text-center px-2 py-1">{{ $passport_no }}</td>
                        <td class="border border-gray-300 text-center px-2 py-1 capitalize">{{ $passportExpiryDate }}
                        </td>
                        <td class="border border-gray-300 text-center px-2 py-1">N/A</td>
                    </tr>
                </tbody>
            </table>
            <table class="w-full border border-gray-300 border-collapse text-[11px] mt-2">
                <thead>
                    <tr class="bg-blue-700 text-white">
                        <th class="border border-gray-300 text-left px-2 py-1">AIRLINE PNR</th>
                        <th class="border border-gray-300 text-center px-2 py-1">GDS PNR</th>
                        <th class="border border-gray-300 text-center px-2 py-1">DATE OF ISSUE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 text-left px-2 py-1">{{ $pnr }}</td>
                        <td class="border border-gray-300 text-center px-2 py-1">{{ $pnr }}</td>
                        <td class="border border-gray-300 text-center px-2 py-1">10:05 PM - {{ $issueDate }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex flex-col gap-1 mt-3">
            <div class="flex items-center gap-1">
                <i class="ri-book-read-fill text-xl text-gray-500"></i>
                <span class="text-gray-700 font-semibold text-sm">ITINERARY
                    INFORMATION</span>
            </div>
            <table class="w-full border border-gray-300 border-collapse text-xs">
                <thead>
                    <tr class="bg-blue-700 text-white">
                        <th class="border border-gray-300 text-left px-2 py-1">FLIGHT</th>
                        <th class="border border-gray-300 text-left px-2 py-1">FROM</th>
                        <th class="border border-gray-300 text-center px-2 py-1">DURATION</th>
                        <th class="border border-gray-300 text-left px-2 py-1">TO</th>
                        <th class="border border-gray-300 text-left px-2 py-1">DETAILS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 text-left px-2 py-1">
                            <div class="flex gap-2">
                                <img src="{{ image_to_base64('us-bangla.png') }}" alt="" class="w-10 h-auto">
                                <div class="flex flex-col">
                                    <span class="text-gray-900 font-semibold">US-Bangla</span>
                                    <span class="text-gray-600 font-semibold">BS-315</span>
                                </div>
                            </div>
                        </td>
                        <td class="border border-gray-300 text-left px-2 py-1">
                            <div class="text-gray-900 font-semibold">
                                DAC <br>
                                8:25 AM <br>
                                {{ $onwardDate }} <br>
                                Terminal: 1
                            </div>
                        </td>
                        <td class="border border-gray-300 text-center px-2 py-1">
                            <div class="flex flex-col items-center gap-1">
                                <img src="{{ image_to_base64('airplane-icon.png') }}" alt=""
                                    class="w-7 h-auto">
                                <span>3h 55m</span>
                            </div>
                        </td>
                        <td class="border border-gray-300 text-left px-2 py-1">
                            <div class="text-gray-900 font-semibold">
                                KUL <br>
                                2:20 PM <br>
                                {{ $onwardDate }} <br>
                                Terminal: M
                            </div>
                        </td>
                        <td class="border border-gray-300 text-left px-2 py-1">
                            <div class="flex flex-col gap-1">
                                <div class="flex gap-1">
                                    <span>CLASS:</span>
                                    <span class="text-gray-900 font-semibold">Y</span>
                                </div>
                                <div class="flex gap-1">
                                    <span>DEPARTS:</span>
                                    <span class="text-gray-900 font-semibold">
                                        Hazrat Shahjalal International Airport
                                    </span>
                                </div>
                                <div class="flex gap-1">
                                    <span>LANDS IN:</span>
                                    <span class="text-gray-900 font-semibold">
                                        Kuala Lumpur International Airport
                                    </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 text-left px-2 py-1">
                            <div class="flex gap-2">
                                <img src="{{ image_to_base64('us-bangla.png') }}" alt=""
                                    class="w-10 h-auto">
                                <div class="flex flex-col">
                                    <span class="text-gray-900 font-semibold">US-Bangla</span>
                                    <span class="text-gray-600 font-semibold">BS-316</span>
                                </div>
                            </div>
                        </td>
                        <td class="border border-gray-300 text-left px-2 py-1">
                            <div class="text-gray-900 font-semibold">
                                KUL <br>
                                3:50 PM <br>
                                {{ $returnDate }} <br>
                                Terminal: M
                            </div>
                        </td>
                        <td class="border border-gray-300 text-center px-2 py-1">
                            <div class="flex flex-col items-center gap-1">
                                <img src="{{ image_to_base64('airplane-icon.png') }}" alt=""
                                    class="w-7 h-auto">
                                <span>3h 55m</span>
                            </div>
                        </td>
                        <td class="border border-gray-300 text-left px-2 py-1">
                            <div class="text-gray-900 font-semibold">
                                DAC <br>
                                5:45 PM <br>
                                {{ $returnDate }} <br>
                                Terminal: 1
                            </div>
                        </td>
                        <td class="border border-gray-300 text-left px-2 py-1">
                            <div class="flex flex-col gap-1">
                                <div class="flex gap-1">
                                    <span>CLASS:</span>
                                    <span class="text-gray-900 font-semibold">Y</span>
                                </div>
                                <div class="flex gap-1">
                                    <span>DEPARTS:</span>
                                    <span class="text-gray-900 font-semibold">
                                        Kuala Lumpur International Airport
                                    </span>
                                </div>
                                <div class="flex gap-1">
                                    <span>LANDS IN:</span>
                                    <span class="text-gray-900 font-semibold">
                                        Hazrat Shahjalal International Airport
                                    </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex flex-col mt-3">
            <div class="flex items-center gap-1">
                <i class="ri-briefcase-2-fill text-xl text-gray-500"></i>
                <span class="text-gray-700 font-semibold text-sm">
                    BAGGAGE INFORMATION
                </span>
            </div>
            <div class="flex gap-4">
                <div class="flex flex-col gap-0.5">
                    <span class="font-semibold text-blue-700 text-xs">ONWARD</span>
                    <div class="flex gap-1">
                        <span class="font-semibold text-xs text-gray-900">Sector:</span>
                        <span class="text-gray-700 text-xs">DAC - KUL</span>
                    </div>
                    <div class="flex gap-1">
                        <span class="font-semibold text-xs text-gray-900">Adult Check-in:</span>
                        <span class="text-gray-700 text-xs">30 Kg</span>
                    </div>
                    <div class="flex gap-1">
                        <span class="font-semibold text-xs text-gray-900">In Hand:</span>
                        <span class="text-gray-700 text-xs">Up to 7 KG</span>
                    </div>
                </div>
                <div class="flex flex-col gap-0.5">
                    <span class="font-semibold text-blue-700 text-xs">RETURN</span>
                    <div class="flex gap-1">
                        <span class="font-semibold text-xs text-gray-900">Sector:</span>
                        <span class="text-gray-700 text-xs">KUL - DAC</span>
                    </div>
                    <div class="flex gap-1">
                        <span class="font-semibold text-xs text-gray-900">Adult Check-in:</span>
                        <span class="text-gray-700 text-xs">30 Kg</span>
                    </div>
                    <div class="flex gap-1">
                        <span class="font-semibold text-xs text-gray-900">In Hand:</span>
                        <span class="text-gray-700 text-xs">Up to 7 KG</span>
                    </div>
                </div>
            </div>
            <span class="text-gray-600 text-[11px] mt-1 leading-[normal]">
                *Check-in :Cabin: One hand bag up to 7 kgs and 115 cms (L+W+H), shall be allowed per customer. <br>
                For contactless travel we recommend to place it under the seat in front, on board.
            </span>
        </div>
        <div class="flex flex-col mt-2">
            <div class="flex items-center gap-1">
                <i class="ri-book-read-fill text-xl text-gray-500"></i>
                <span class="text-gray-700 font-semibold text-sm">
                    TERMS AND CONDITIONS
                </span>
            </div>
            <div class="flex flex-col gap-1">
                <div class="flex flex-col">
                    <span class="font-semibold text-xs text-gray-900">E-Booking Notice:</span>
                    <span class="text-gray-700 text-xs italic">
                        The terms of carriage, which are thus incorporated by reference, apply to transport and other
                        services rendered by the carrier. You can get these
                        terms from the issuing airline.
                    </span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-xs text-gray-900">Passport/Visa/Health:</span>
                    <span class="text-gray-700 text-xs italic">
                        Please make sure to carry a valid passport and visa for your trip, as well as any relevant
                        documents as per your location.
                    </span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-xs text-gray-900">Reconfrmation of fights:</span>
                    <span class="text-gray-700 text-xs italic">
                        Please reach out to us for reconfrmation of your fight at least 72 hours in advance. If you do
                        not show up in case of fight changes, your reservation
                        may be canceled or rescheduled and you will be charged.
                    </span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-xs text-gray-900">Insurance:</span>
                    <span class="text-gray-700 text-xs italic">
                        We strongly recommend to avail travel insurance. Please check the country's rules before your
                        trip.
                    </span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-xs text-gray-900">Rescheduling:</span>
                    <span class="text-gray-700 text-xs italic">
                        Applicable charges will be as per the Airline policy including the convenience fee. <br>
                        i.e. (Rescheduling amount = Date change fee + the difference of fare if any)
                    </span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-xs text-gray-900">Cancellation:</span>
                    <span class="text-gray-700 text-xs italic">
                        Applicable charges will be as per the Airline policy including the convenience fee.
                        i.e. (Refund amount = Paid amount - Refund charges)
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
