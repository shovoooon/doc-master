@php
    $opening = 48410; // Opening balance
    $length = rand(50, max: 62);
    $transactions = generate_bank_transactions($length, $opening);
    $deposit = 0;
    $withdrawal = 0;

    $bank_acc = generate_bank_account();
    $branch_name = $bank->branch_name ?? 'Rajshahi Branch';
    $bank_address =
        $bank->address ??
        'ZERO POINT COMPLEX, HOUSE # 5716/5719,W # 12, RAJSHAHI CITY CORPORATION, PS # BOALIA RAJSHAHI';
    $bank_short_address = $bank->short_address ?? 'Zero Point, Rajshahi';

    $lastDayOfLastMonth = new DateTime('last day of last month');
    $statementTo = new DateTime('last day of last month');
    $statementFrom = $lastDayOfLastMonth->modify('-6 months');

    $bankManager = generate_random_name();
    $signatureName = ucwords(strtolower(implode(' ', array_slice(explode(' ', $bankManager), 1))));

@endphp

<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-size: 10pt;
            line-height: 1rem;
            padding: 0 50px 50px 50px;
        }

        .header {
            margin-top: 50px;
        }

        .divider {
            border: 2px solid black;
            margin: 2px 0;
        }

        #tableAccount {
            margin-left: auto;
            margin-right: 0;
            font-size: 13px;
            border-spacing: 0;
            padding: 0;
            font-family: 'Courier New', monospace;
        }

        #tableAccount tr {
            padding: 0;
            margin: 0;
        }

        #tableAccount td {
            padding: 0 2px;
            margin: 0;
        }

        #transactionTable {
            margin-top: 20px;
            width: 100%;
        }

        #transactionTable tbody:before {
            content: "@";
            display: block;
            line-height: 10px;
            text-indent: -99999px;
        }

        #transactionTable th {
            border: 0.5px solid;
            padding: 5px;
        }

        #transactionTable td {
            font-family: 'Courier New', monospace;
            padding: 3px;
        }

        @media print {
            .pagebreak {
                page-break-before: always;
            }

            /* page-break-after works, as well */
        }

        /* .stamp {
            position: relative;
            bottom: 10px;
            left: 75%;
            opacity: 0.9;
            pointer-events: none;
        }

        svg {
            width: 120px;
            height: 120px;
        } */

        .stamp-wrapper {
        display: none;
            position: relative;
            width: 120px;
            height: 120px;
        }

        .stamp-wrapper svg {
            width: 100%;
            height: 100%;
        }

        .signature-overlay {
            position: absolute;
            top: 1%;
            /* Adjust this value as needed */
            left: 35%;
            /* Adjust this value as needed */
            width: 100px;
            /* Resize the signature image */
            opacity: 0.8;
            /* Slight transparency for realism */
            pointer-events: none;
        }
    </style>
    @php
$fontPath = public_path('Autography.otf');
$autographyBase64 = base64_encode(file_get_contents($fontPath));
    @endphp
    <style>
        @font-face {
            font-family: 'Autography';
            src: url('data:font/opentype;base64,{{ $autographyBase64 }}') format('opentype');
            font-weight: normal;
            font-style: normal;
        }
    
        .signature-text {
            font-family: 'Autography', cursive;
        }
        </style>
</head>

<body>
    
    @include('partials.bank_header')
    
    <div class="content">
        <div class="row">
            <table id="transactionTable">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>DESCRIPTION</th>
                        <th>CHQ.NO. </th>
                        <th class="text-end">WITHDRAWAL</th>
                        <th class="text-end">DEPOSIT</th>
                        <th class="text-end">BALANCE [BDT]</th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($transactions as $key => $transaction)
                        @if ($key > 33)
                            @break
                        @endif

                        @php
    $deposit += $transaction['deposit'] ?? 0;
    $withdrawal += $transaction['withdrawal'] ?? 0;
    $balance = $opening + $deposit - $withdrawal;
                        @endphp

                        <tr>
                            <td>{{ $transaction['date'] }}</td>
                            <td>{{ $transaction['description'] }}</td>
                            <td>{{ $transaction['cheque_no'] ?? '—' }}</td>
                            <td class="text-end">{{ $transaction['withdrawal'] ?? '—' }}</td>
                            <td class="text-end">{{ $transaction['deposit'] ?? '—' }}</td>
                            <td class="text-end">{{ number_format($balance, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        <div class="pagebreak"> </div>
    
        @include('partials.bank_header')
    
        <div class="row">
            <table id="transactionTable">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>DESCRIPTION</th>
                        <th>CHQ.NO. </th>
                        <th class="text-end">WITHDRAWAL</th>
                        <th class="text-end">DEPOSIT</th>
                        <th class="text-end">BALANCE [BDT]</th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($transactions as $key => $transaction)
                        @if ($key <= 33)
                            @continue
                        @endif

                        @php
    $deposit += $transaction['deposit'] ?? 0;
    $withdrawal += $transaction['withdrawal'] ?? 0;
    $balance = $opening + $deposit - $withdrawal;
                        @endphp

                        <tr>
                            <td>{{ $transaction['date'] }}</td>
                            <td>{{ $transaction['description'] }}</td>
                            <td>{{ $transaction['cheque_no'] ?? '—' }}</td>
                            <td class="text-end">{{ $transaction['withdrawal'] ?? '—' }}</td>
                            <td class="text-end">{{ $transaction['deposit'] ?? '—' }}</td>
                            <td class="text-end">{{ number_format($balance, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        <hr class="ms-5 me-5">
    
        <div class="row fw-bold">
            <div class="col-md-4">
                Total Withdrawal in BDT:
                <br>
                Total Deposit in BDT:
            </div>
            <div class="col-md-2 text-end">
                {{ number_format($withdrawal, 2) }}
                <br>
                {{ number_format($deposit, 2) }}
            </div>
    
            <div class="col-md-4">
                Opening Balance in BDT:
                <br>
                Available Balance in BDT:
            </div>
    
            <div class="col-md-2 text-end">
                {{ number_format($opening, 2) }}
                <br>
                {{ number_format($balance, 2) }}
            </div>
        </div>
    
        <p class="text-center m-3">--------------------------------------------End of
            Statement----------------------------------------------</p>
    
        <div class="stamp-wrapper">
            @include('partials.bank_round_seal')
            {{-- <img src="{{ image_to_base64('sign-3.png') }}" alt="Signature" class="signature-overlay" /> --}}
        </div>
    
        <div class="pagebreak"> </div>
    
        <!-- SOLVENCY PAGE -->
        <section class="lh-lg" style="font-size: 1rem;">
            <div style="padding-top:50px;">
                <img src="{{ image_to_base64('city-bank-logo.png') }}" alt="City Bank Logo" style="height: 100px;">
                <p class="mt-2">
                    Sequence No.CBL/HO/RETAIL BANKING/2025/{{ rand(100000, 999999) }}
                    <br>
                    Date: {{ now()->format('d M, Y') }}
                </p>
    
                <div class="text-center p-5">
                    <u class="fw-bold fs-4">To whom it may concern</u>
                </div>
    
                <p>
                    This is to certify that, {{ sentence_case($name) }} having communication address {{ sentence_case($address) }}, has
                    been maintaining an account with City Bank PLC, {{$branch_name}} bearing account no. {{ $bank_acc }}
                    since 10 Aug, 2022. The balance standing to the credit of this account as at the close of business on
                    {{ now()->subMonth()->endOfMonth()->format('d M, Y') }} was BDT. {{ number_format($balance, 2) }}
                </p>
    
                <div class="row" style="margin-top: 100px;">
                    <div class="col" style="padding-top: 20px;">
                        <div class="stamp-wrapper">
                            @include('partials.bank_round_seal')
                            {{-- <img src="{{ image_to_base64('sign-3.png') }}" class="signature-overlay" /> --}}
                        </div>
                    </div>
                    <div class="col text-end" style="line-height: 0; padding-top: 80px;">

                        {{-- <div style="margin-right: 30px; filter: blur(0.3px); contrast(0.9); color: #1C1C1C;">
                            <p class="signature-text" style="font-size: 26px;">{{$signatureName}}</p>
                            <p class="signature-text" style="font-size: 18px;">{{ date('d/m/Y') }}</p>
                        </div> --}}

                        {{-- <img src="{{ image_to_base64('sign-4.png') }}"
                            style="width: 40mm; height: auto; margin-right: 10px;"> --}}
                        <div
                            style="line-height: 0; font-size: 12px; color: #470077;text-align: center; margin-left: auto; margin-right: 0;width: max-content; filter: blur(0.3px) contrast(0.9);">
                            {{-- <p style="font-size: 16px; font-weight: 700;">{{$bankManager}}</p>
                            <p>Senior Assistant Vice President</p>
                            <p>City Bank PLC, {{$branch_name}}</p> --}}
                        </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col fw-bold">
                        <u>Authorized Signatures</u>
                    </div>
                    <div class="col text-end fw-bold">
                        <u>Authorized Signatures</u>
                    </div>
                </div>
            </div>
        </section>
    </div>

</body>

</html>
