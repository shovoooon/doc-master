@php
    $today = \Carbon\Carbon::today();
    $cover_issued = $today->copy()->format('Y-m-d'); // Keep as string
    $ticket_issued = $today->copy()->subDay()->format('Y-m-d'); // Note: subDay() for 1 day
    $invitation_issued = $today->copy()->subDays(rand(7, 10))->format('Y-m-d');

    $departureDate = $today->copy()->addDays(rand(20, 30));
    $returnDate = $departureDate->copy()->addDays(rand(14, 21));

    $departure = $departureDate->format('Y-m-d');
    $return = $returnDate->format('Y-m-d');

    $marriageIssued = $today->copy()->subDays(rand(2, 5))->format('Y-m-d');
@endphp

@extends('layouts.app')

@section('title', 'Generate Marriage Docs')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <form target="_blank" action="{{ route('documents.submit') }}" method="POST" enctype="multipart/form-data"
                class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
                @csrf

                <!-- Husband Information -->
                <h2 class="text-center text-base/7 font-semibold text-gray-900">Husband Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Husband Name</label>
                        <input type="text" name="husband_name" class="w-full border border-gray-300 rounded px-2 py-1.5"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Husband Father Name</label>
                        <input type="text" name="husband_father_name"
                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                    </div>
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Husband Mother Name</label>
                        <input type="text" name="husband_mother_name"
                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                    </div>
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Village</label>
                        <input type="text" id="husband_village" name="husband_village"
                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                    </div>

                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Post Office</label>
                        <input type="text" id="husband_post" name="husband_post"
                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                    </div>

                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Police Station</label>
                        <input type="text" id="husband_ps" name="husband_ps"
                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                    </div>

                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">District</label>
                        <input type="text" id="husband_district" name="husband_district"
                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                    </div>
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Date of birth</label>
                        <input type="date" name="husband_dob" class="w-full border border-gray-300 rounded px-2 py-1.5">
                    </div>
                    <div></div>
                </div>

                <div class="col-span-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" id="sameAddressCheckbox" class="form-checkbox h-4 w-4 text-blue-600">
                        <span class="ml-2 text-sm text-gray-700">Wife's address same as Husband's address</span>
                    </label>
                </div>

                <!-- Wife Information -->
                <h2 class="text-center text-base/7 font-semibold text-gray-900">Wife Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Name</label>
                        <input type="text" name="name" class="w-full border border-gray-300 rounded px-2 py-1.5"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Wife Father Name</label>
                        <input type="text" name="father_name" class="w-full border border-gray-300 rounded px-2 py-1.5">
                    </div>
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Wife Mother Name</label>
                        <input type="text" name="mother_name" class="w-full border border-gray-300 rounded px-2 py-1.5">
                    </div>
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Village</label>
                        <input type="text" id="wife_village" name="village"
                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                    </div>

                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Post Office</label>
                        <input type="text" id="wife_post" name="post"
                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                    </div>

                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Police Station</label>
                        <input type="text" id="wife_ps" name="ps"
                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                    </div>

                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">District</label>
                        <input type="text" id="wife_district" name="district"
                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                    </div>
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Date of birth</label>
                        <input type="date" name="dob" class="w-full border border-gray-300 rounded px-2 py-1.5"
                            required>
                    </div>
                </div>



                <!-- Marriage Information -->
                <h2 class="text-center text-base/7 font-semibold text-gray-900">Marriage Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Volume No</label>
                        <input type="text" name="volume_no" class="w-full border border-gray-300 rounded px-2 py-1.5"
                            value="{{ rand(1, 99) }}">
                    </div>
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Page No</label>
                        <input type="text" name="page_no" class="w-full border border-gray-300 rounded px-2 py-1.5"
                            value="{{ rand(1, 99) }}">
                    </div>
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Serial No</label>
                        <input type="text" name="serial_no" class="w-full border border-gray-300 rounded px-2 py-1.5"
                            value="{{ rand(1, 99) }}">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Date of Issued</label>
                        <input type="date" name="doi" class="w-full border border-gray-300 rounded px-2 py-1.5"
                            value="{{ $marriageIssued }}">
                    </div>
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Date of marriage</label>
                        <input type="date" name="dom" class="w-full border border-gray-300 rounded px-2 py-1.5"
                            required>
                    </div>

                    <div class="flex flex-wrap gap-3 mt-3">
                        <button type="submit" name="action" value="marriage_certificate"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Marriage
                            Certificate</button>
                        <button type="submit" name="action" value="nikah_nama"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Nikah Nama</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('sameAddressCheckbox').addEventListener('change', function() {
            const isChecked = this.checked;

            if (isChecked) {
                document.getElementById('wife_village').value = document.getElementById('husband_village').value;
                document.getElementById('wife_post').value = document.getElementById('husband_post').value;
                document.getElementById('wife_ps').value = document.getElementById('husband_ps').value;
                document.getElementById('wife_district').value = document.getElementById('husband_district').value;
            } else {
                document.getElementById('wife_village').value = '';
                document.getElementById('wife_post').value = '';
                document.getElementById('wife_ps').value = '';
                document.getElementById('wife_district').value = '';
            }
        });
    </script>
@endsection
