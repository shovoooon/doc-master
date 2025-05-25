<div class="header">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ image_to_base64('city-bank-logo.png') }}" alt="City Bank Logo" style="height: 100px;">
        </div>
        <div class="col-md-6 text-end">
            <p class="fw-bold fs-4 mb-2">Statement of Account</p>
            <p class="fw-bold m-0">RAJSHAHI BRANCH</p>
            <small>
                ZERO POINT COMPLEX, HOUSE # 5716/5719,W # 12,
                RAJSHAHI CITY CORPORATION, PS # BOALIA
                RAJSHAHI
            </small>
        </div>
    </div>

    <div class="border-top border-1.5 border-dark mt-1 mb-2"></div>

    <div class="user-section">
        <div class="row">
            <div class="col">
                <p class="customername text-uppercase fw-bold mb-1">
                    {{ $name }}
                </p>
                <p class="customeraddress">
                    {{ $address }}
                    <br>
                    BANGLADESH
                </p>
            </div>

            <div class="col">
                <table id="tableAccount">
                    <tr>
                        <td>Period From</td>
                        <td>:</td>
                        <td>01-11-2024 To 30-04-2025</td>
                    </tr>
                    <tr>
                        <td>Account Number </td>
                        <td>:</td>
                        <td>{{ $bank_acc }}</td>
                    </tr>
                    <tr>
                        <td>Customer ID</td>
                        <td>:</td>
                        <td>CB3100212</td>
                    </tr>
                    <tr>
                        <td>Account Type</td>
                        <td>:</td>
                        <td>HIGH VALUE SAVINGS A/C</td>
                    </tr>
                    <tr>
                        <td>Currency</td>
                        <td>:</td>
                        <td>BDT</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
