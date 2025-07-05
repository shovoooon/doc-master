<div class="flex justify-center mb-1 text-[#3B5FAD]">
    <div>
        <img src="{{ image_to_base64($logo) }}" class="max-h-[80px] w-auto max-w-[100px]">
    </div>

    <div class="max-w-[80%]">
        <div class="text-center">
            @if (strlen($company->name) > 29)
                <div class="text-base font-bold">{{ $shortCompanyName }}</div>
            @elseif(strlen($company->name) > 19)
                <div class="text-lg font-bold">{{ $company->name }}</div>
            @else
                <div class="text-xl font-bold">{{ $company->name }}</div>
            @endif
            <div class="font-bold">({{ $company->registration_no }})</div>
            <div class="font-bold">(Incorporated in Malaysia)</div>
            <div class="mb-0 font-bold px-4 text-[10px]">{{ $company->address }}</div>
        </div>

        <div class="flex flex-wrap justify-center gap-2 text-[10px]">
            <div>
                <span class="font-bold">Tel No:</span>
                <span>(<span class="font-bold">Off</span>) {{ $tel }}</span>
            </div>
            <div>
                <span>(<span class="font-bold">Fax</span>) {{ $fax }}</span>
            </div>
            <div>
                <span>(<span class="font-bold">H/P</span>) {{ $hp }}</span>
            </div>
        </div>

        <div class="text-center text-[10px]">
            <span><span class="font-bold">Email:</span> {{ $companyEmail }}</span>
        </div>
    </div>
</div>

<div class="separator"></div>

{{-- <div class="d-flex justify-content-center mb-1" style="color: #3B5FAD">
    <div class="">
        <img src="{{ image_to_base64($logo) }}" style="max-height: 80px; width: auto; max-width: 100px;">
    </div>

    <div class="" style="max-width: 80%">
        <div class="text-center">
            @if (strlen($company->name) > 29)
                <div class="h5 fw-bold">{{ $company->name }}</div>
            @elseif(strlen($company->name) > 19)
                <div class="h4 fw-bold">{{ $company->name }}</div>
            @else
                <div class="h3 fw-bold">{{ $company->name }}</div>
            @endif
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
        <div class="text-center" style="font-size: 10px">
            <span><span class="fw-bold">Email:</span> {{ $companyEmail }}</span>
        </div>
    </div>

</div>

<div class="separator"></div> --}}