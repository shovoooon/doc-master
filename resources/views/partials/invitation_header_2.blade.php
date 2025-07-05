<div class="text-gray-800 font-sans">
    <!-- Letterhead Container -->
    <div class="max-w-4xl mx-auto">

        <!-- Header Section -->
        <div class="flex items-center justify-between border-b border-gray-700 pb-3 mb-3 text-[#3B5FAD]">
            <!-- Company Logo -->
            <div>
                <img src="{{ image_to_base64($logo) }}"
                    class="w-24 h-24 object-contain">
            </div>
            <!-- Company Info -->
            <div class="text-right text-[#3B5FAD]">
                <h1 class="text-2xl font-bold uppercase">{{$shortCompanyName}}</h1>
                <p class="text-sm font-semibold">{{ $company->registration_no }}</p>
                <p class="text-[11px] max-w-[70%] ml-auto">{{ $company->address }}</p>
                <p class="text-[11px]">{{ $hp }}</p>
                <p class="text-[11px]">{{ $companyEmail }}</p>
            </div>
        </div>

    </div>
</div>