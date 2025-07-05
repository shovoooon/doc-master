<div class="flex items-start justify-between border-b border-gray-700 pb-3 mb-3">
    {{-- Left: Logo + Company Name --}}
    <div class="flex items-start gap-3">
        {{-- Logo --}}
        <img src="{{ image_to_base64($logo) }}" alt="Company Logo" class="w-20 h-auto">

        {{-- Company Name --}}
        <div class="flex flex-col justify-center leading-tight text-[#3B5FAD]">
            <h1 class="text-lg font-extrabold text-[#3B5FAD] uppercase leading-none">
                {{$shortCompanyName}}
            </h1>
            <p class="text-sm text-gray-600 font-semibold text-[#3B5FAD]">{{ $company->registration_no }}</p>
        </div>
    </div>

    {{-- Right: Address + Contact --}}
    <div class="text-right text-sm text-gray-700 leading-tight text-[#3B5FAD]">
        <p class="text-[11px] max-w-[70%] ml-auto">{{ $title_case_address }}</p>
        <p class="text-[11px]">{{ $hp }}</p>
        <p class="text-[11px]">{{ $companyEmail }}</p>
    </div>
</div>