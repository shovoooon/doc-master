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
        @page {
            size: A4;
            margin: 0;
        }

    body {
        margin: 0;
            padding: 0;
            width: 210mm;
            height: 297mm;
        background-image: url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path('ssm-template.png'))) }}');
        background-repeat: no-repeat;
        background-size: 100% 100%;
        /* Cover entire page */
        background-position: center;
        background-origin: content-box;
        position: relative;
        font-family: "Times New Roman", serif;
    }

    .content {
        padding-top: 57%;
    }

    .company-name {
        font-weight: bold;
        text-align: center;
        font-size: 16pt;
        margin-bottom: 20px;
    }

    .address {
        padding: 0 100px 0 110px;
        font-size: 14pt;
        line-height: 1.3;
        text-align: justify;
    }

    .highlight {
        font-weight: bold;
    }
</style>
<body>
<div class="content">
    <div class="company-name">
        {{ $company_name }}<br>
        REGISTRATION NO. : {{ $registration_code }} ({{ $registration_no }})
    </div>

    <div class="address">
        has this day been registered until <span class="highlight">15 JULY 2029</span> in accordance with the
        provisions of the Registration of Businesses Act 1956, with its principle place
        of business at <span class="highlight">{{ $company_address }}</span>
    </div>
</div>
</body>