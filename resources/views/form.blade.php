@php
$today = \Carbon\Carbon::today();
$cover_issued = $today->copy()->format('Y-m-d'); // Keep as string
$ticket_issued = $today->copy()->subDay()->format('Y-m-d'); // Note: subDay() for 1 day
$invitation_issued = $today->copy()->subDays(rand(7, 10))->format('Y-m-d');

$departureDate = $today->copy()->addDays(rand(20, 30));
$returnDate = $departureDate->copy()->addDays(rand(14, 21));

$departure = $departureDate->format('Y-m-d');
$return = $returnDate->format('Y-m-d');

$marriageIssued = $today->copy()->subDays(rand(7, 14))->format('Y-m-d');
@endphp

@extends('layouts.app')

@section('title', 'Generate PDF')

@section('content')
                                    <div class="max-w-4xl mx-auto">
                                        <div class="bg-white rounded-lg shadow-md p-6">
                                            <form target="_blank" action="{{ route('documents.submit') }}" method="POST" enctype="multipart/form-data"
                                                class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
                                                @csrf

                                                <input type="hidden" name="form_data" id="formData">

                                                <!-- Personal Information -->
                                                <h2 class="text-center text-base/7 font-semibold text-gray-900">Dates</h2>

                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Cover Issued</label>
                                                        <input type="date" name="cover_issued" class="w-full border border-gray-300 rounded px-2 py-1.5"
                                                            value="{{ $cover_issued }}">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Ticket Issued</label>
                                                        <input type="date" name="ticket_issued" class="w-full border border-gray-300 rounded px-2 py-1.5"
                                                            value="{{ $ticket_issued }}">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Invitation Issued</label>
                                                        <input type="date" name="invitation_issued"
                                                            class="w-full border border-gray-300 rounded px-2 py-1.5" value="{{ $invitation_issued }}">
                                                    </div>

                                                    <div class="col-start-1 col-end-4 grid grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="block text-sm/6 font-medium text-gray-700">Departure</label>
                                                            <input type="date" name="departure" class="w-full border border-gray-300 rounded px-2 py-1.5"
                                                                value="{{ $departure }}">
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm/6 font-medium text-gray-700">Return</label>
                                                            <input type="date" name="return" class="w-full border border-gray-300 rounded px-2 py-1.5"
                                                                value="{{ $return }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Personal Information -->
                                                <h2 class="text-center text-base/7 font-semibold text-gray-900">Personal Information</h2>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Name</label>
                                                        <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-2 py-1.5"
                                                        oninput="this.value = this.value.trim().replace(/\s{2,}/g, ' ').toUpperCase()"
                                                            required>
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Address</label>
                                                        <input type="text" name="address" id="address" class="w-full border border-gray-300 rounded px-2 py-1.5"
                                                        oninput="this.value = this.value.trim().replace(/\s{2,}/g, ' ').toUpperCase()">
                                                    </div>

                                                    <div class="col-start-1 col-end-3 grid grid-cols-3 gap-4">
                                                        <div class="relative">
                                                            <label class="block text-sm/6 font-medium text-gray-700">Passport No</label>
                                                            <input type="text" name="passport_no" id="passport_no"
                                                                class="w-full border border-gray-300 rounded px-2 py-1.5"
                                                                oninput="this.value = this.value.toUpperCase().replace(/\s+/g, '')"
                                                                autocomplete="off">

                                                                <ul id="passport_suggestions" class="hidden absolute border border-gray-300 bg-white z-50 w-full list-none p-0 mt-1 rounded shadow-md max-h-60 overflow-auto">
                                                                </ul>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm/6 font-medium text-gray-700">Passport Issued</label>
                                                            <input type="date" name="passport_issued" id="passport_issued"
                                                                class="w-full border border-gray-300 rounded px-2 py-1.5">
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm/6 font-medium text-gray-700">Passport Expiry</label>
                                                            <input type="date" name="passport_expiry" id="passport_expiry"
                                                                class="w-full border border-gray-300 rounded px-2 py-1.5">
                                                        </div>
                                                    </div>
                                                </div>

                                                <h2 class="text-center text-base font-semibold text-gray-900 mt-6">Children Information</h2>

                                                <div id="children-wrapper" class="space-y-4 mt-2">
                                                    <!-- Dynamic children will be inserted here -->
                                                </div>

                                                <button type="button" onclick="addChild()" class="mt-3 px-4 py-2 bg-green-600 text-white rounded">
                                                    + Add Child
                                                </button>

                                                <template id="child-template">
                                                    <div
                                                        class="child-form border border-gray-300 p-4 rounded-md grid grid-cols-1 md:grid-cols-3 gap-4 relative bg-gray-50">
                                                        <button type="button" onclick="this.closest('.child-form').remove()"
                                                            class="absolute top-1 right-1 text-red-500 text-xl leading-none font-bold">
                                                            ✕
                                                        </button>
                                                        <input type="text" name="children[__index__][name]" class="border px-2 py-1.5 rounded w-full"
                                                        oninput="this.value = this.value.trim().replace(/\s{2,}/g, ' ').toUpperCase()"
                                                            placeholder="Child Name">

                                                        <select name="children[__index__][gender]" class="border px-2 py-1.5 rounded w-full">
                                                            <option value="">Select Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>

                                                        <input type="text" name="children[__index__][passport_no]" placeholder="Passport No"
                                                            class="border px-2 py-1.5 rounded w-full"
                                                            oninput="this.value = this.value.toUpperCase().replace(/\s+/g, '')">

                                                        <input type="date" name="children[__index__][passport_issued]" class="border px-2 py-1.5 rounded w-full">
                                                        <input type="date" name="children[__index__][passport_expiry]" class="border px-2 py-1.5 rounded w-full">
                                                    </div>
                                                </template>


                                                <!-- Husband Information -->
                                                <h2 class="text-center text-base/7 font-semibold text-gray-900">Husband Information</h2>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Husband Name</label>
                                                        <input type="text" name="husband_name" id="husband_name" class="w-full border border-gray-300 rounded px-2 py-1.5"
                                                        oninput="this.value = this.value.trim().replace(/\s{2,}/g, ' ').toUpperCase()">
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Husband Passport No</label>
                                                        <input type="text" name="husband_passport_no" id="husband_passport_no"
                                                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                                                    </div>
                                                </div>

                                                <!-- Company Information -->
                                                <h2 class="text-center text-base/7 font-semibold text-gray-900">Company Information</h2>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div class="relative">
                                                        <label class="block text-sm/6 font-medium text-gray-700">Company Name</label>
                                                        <input type="text" id="company_name" name="company_name" autocomplete="off"
                                                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                                                        <ul id="company_suggestions"
                                                            class="hidden absolute border border-gray-300 bg-white z-50 w-full list-none p-0 mt-1 
                                                            rounded shadow-md max-h-60 overflow-auto">
                                                        </ul>

                                                    </div>

                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Company Address</label>
                                                        <input type="text" id="company_address" name="company_address"
                                                            class="w-full border border-gray-300 rounded px-2 py-1.5"
                                                            oninput="this.value = this.value.trim().replace(/\s{2,}/g, ' ').toUpperCase()">
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Registration No</label>
                                                        <input type="text" id="registration_no" name="registration_no"
                                                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Registration Code</label>
                                                        <input type="text" id="registration_code" name="registration_code"
                                                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Company Logo</label>

                                                        <!-- Hidden input to store the selected image ID -->
                                                        <input type="hidden" name="logo_id" id="logo_id">

                                                        <div onclick="openGallery('logo')">
                                                            <img id="logo_preview" src="/default-logo.png" class="h-20 w-auto cursor-pointer border" alt="Logo Preview">                                              </div>

                                                    </div>


                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Signature</label>

                                                        <!-- Hidden input to store the selected image ID -->
                                                        <input type="hidden" name="signature_id" id="signature_id">

                                                        <div onclick="openGallery('signature')">
                                                            <img id="signature_preview" src="/default-signature.png" class="h-20 w-auto cursor-pointer border">
                                                        </div>
                                                    </div>

                                                </div>

                                                <h2 class="text-center text-base/7 font-semibold text-gray-900">Bank Information</h2>
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                    <div class="relative">
                                                        <label class="block text-sm/6 font-medium text-gray-700">Branch</label>
                                                        <input type="text" name="bank_branch" id="bank_branch" autocomplete="off"
                                                            class="w-full border border-gray-300 rounded px-2 py-1.5">

                                                            <ul id="branch_suggestions" class="hidden absolute border border-gray-300 bg-white z-50 w-full list-none p-0 mt-1 rounded shadow-md max-h-60 overflow-auto">
                                                            </ul>
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Bank Address</label>
                                                        <input type="text" name="bank_address" id="bank_address"
                                                            class="w-full border border-gray-300 rounded px-2 py-1.5"
                                                            oninput="this.value = this.value.trim().replace(/\s{2,}/g, ' ').toUpperCase()">
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Bank Short Address</label>
                                                        <input type="text" name="bank_short_address" id="bank_short_address" class="w-full border border-gray-300 rounded px-2 py-1.5">
                                                    </div>
                                                </div>

                                                <!-- Generate Documents Buttons -->
                                                <div class="flex flex-wrap gap-3 mt-3">
                                                    <button type="submit" name="action" value="cover"
                                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cover</button>
                                                    <button type="submit" name="action" value="ticket"
                                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ticket</button>
                                                    <button type="submit" name="action" value="hotel"
                                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Hotel</button>
                                                    <button type="submit" name="action" value="bank_statement"
                                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Bank Statement</button>
                                                    <button type="submit" name="action" value="invitation"
                                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Invitation</button>
                                                    <button type="submit" name="action" value="ssm"
                                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">SSM</button>
                                                    <button type="submit" name="action" value="generate_all"
                                                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Generate All</button>
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
                                                            value="{{ rand(1, 10) }}">
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
                                                        <input type="date" name="dom" class="w-full border border-gray-300 rounded px-2 py-1.5">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Wife Father Name</label>
                                                        <input type="text" name="father_name"
                                                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm/6 font-medium text-gray-700">Wife Mother Name</label>
                                                        <input type="text" name="mother_name"
                                                            class="w-full border border-gray-300 rounded px-2 py-1.5">
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
                                                        <input type="date" name="dob" class="w-full border border-gray-300 rounded px-2 py-1.5">
                                                    </div>


                                                    <div class="col-span-2">
                                                        <label class="inline-flex items-center">
                                                            <input type="checkbox" id="sameAddressCheckbox" class="form-checkbox h-4 w-4 text-blue-600">
                                                            <span class="ml-2 text-sm text-gray-700">Husband's address same as Wife's address</span>
                                                        </label>
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
                                                        <input type="date" name="husband_dob"
                                                            class="w-full border border-gray-300 rounded px-2 py-1.5">
                                                    </div>
                                                    <div></div>

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

                                    <!-- Modal -->
                                    <div id="expiryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
                                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                            <!-- Modal backdrop -->
                                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                            </div>

                                            <!-- Modal content -->
                                            <div
                                                class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                                                <div>
                                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Select Passport Validity</h3>
                                                    <div class="mt-4 space-y-3">
                                                        <button type="button" onclick="setExpiry(5)"
                                                            class="w-full flex justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                                            5 Years (Expires: <span id="fiveYears" class="ml-1"></span>)
                                                        </button>
                                                        <button type="button" onclick="setExpiry(10)"
                                                            class="w-full flex justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                                                            10 Years (Expires: <span id="tenYears" class="ml-1"></span>)
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Image Picker Modal -->
                                    <div id="gallery-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 items-center justify-center">
                                        <div class="bg-white p-4 rounded-lg w-11/12 max-w-2xl overflow-auto max-h-[90vh]">
                                            <div class="flex justify-between items-center mb-4">
                                                <h2 class="text-lg font-semibold">Select Image</h2>
                                                <button onclick="closeImagePicker()" class="text-red-600 font-bold text-xl">&times;</button>
                                            </div>

                                            <div id="image-gallery" class="grid grid-cols-4 gap-4"></div>

                                            <div class="mt-4">
                                                <label class="block text-sm font-medium">Upload New Image</label>
                                                <input type="file" id="new_image_upload" class="mt-1">
                                            </div>
                                        </div>                      
                                    </div>


                                    <script>
                                        document.getElementById('passport_issued').addEventListener('change', function() {
                                            const issuedDate = new Date(this.value);
                                            if (!isNaN(issuedDate.getTime())) {
                                                // Calculate dates (1 day before anniversary)
                                                const fiveYears = new Date(issuedDate);
                                                fiveYears.setFullYear(fiveYears.getFullYear() + 5);
                                                fiveYears.setDate(fiveYears.getDate() - 1); // Subtract 1 day
                                                document.getElementById('fiveYears').textContent = formatDate(fiveYears);

                                                const tenYears = new Date(issuedDate);
                                                tenYears.setFullYear(tenYears.getFullYear() + 10);
                                                tenYears.setDate(tenYears.getDate() - 1); // Subtract 1 day
                                                document.getElementById('tenYears').textContent = formatDate(tenYears);

                                                // Show modal
                                                document.getElementById('expiryModal').classList.remove('hidden');
                                            }
                                        });

                                        function setExpiry(years) {
                                            const issuedDate = new Date(document.getElementById('passport_issued').value);
                                            const expiryDate = new Date(issuedDate);
                                            expiryDate.setFullYear(expiryDate.getFullYear() + years);
                                            expiryDate.setDate(expiryDate.getDate() - 1); // Subtract 1 day

                                            document.getElementById('passport_expiry').value = formatDateForInput(expiryDate);
                                            document.getElementById('expiryModal').classList.add('hidden');
                                        }

                                        // Rest of the functions remain the same
                                        function formatDate(date) {
                                            return date.toLocaleDateString('en-US', {
                                                year: 'numeric',
                                                month: 'short',
                                                day: 'numeric'
                                            });
                                        }

                                        function formatDateForInput(date) {
                                            const year = date.getFullYear();
                                            const month = String(date.getMonth() + 1).padStart(2, '0');
                                            const day = String(date.getDate()).padStart(2, '0');
                                            return `${year}-${month}-${day}`;
                                        }
                                    </script>

                                    <script>
                                        document.getElementById('sameAddressCheckbox').addEventListener('change', function() {
                                            const isChecked = this.checked;

                                            if (isChecked) {
                                                document.getElementById('husband_village').value = document.getElementById('wife_village').value;
                                                document.getElementById('husband_post').value = document.getElementById('wife_post').value;
                                                document.getElementById('husband_ps').value = document.getElementById('wife_ps').value;
                                                document.getElementById('husband_district').value = document.getElementById('wife_district').value;
                                            } else {
                                                document.getElementById('husband_village').value = '';
                                                document.getElementById('husband_post').value = '';
                                                document.getElementById('husband_ps').value = '';
                                                document.getElementById('husband_district').value = '';
                                            }
                                        });
                                    </script>

                                    <script>
                                        const input = document.getElementById("company_name");
                                        const suggestionBox = document.getElementById("company_suggestions");

                                        input.addEventListener("input", function() {
                                            const query = input.value.trim();

                                            if (query.length < 2) {
                                                suggestionBox.classList.add("hidden");
                                                suggestionBox.innerHTML = "";
                                                return;
                                            }

                                            fetch(`/api/company-search?q=${encodeURIComponent(query)}`)
                                                .then(response => response.json())
                                                .then(data => {
                                                    suggestionBox.innerHTML = "";
                                                    if (data.length > 0) {
                                                        data.forEach(company => {
                                                            const li = document.createElement("li");
                                                            li.textContent = company.name;
                                                            li.className = "px-4 py-2 hover:bg-gray-100 cursor-pointer";
                                                            li.addEventListener("click", () => {
                                                                input.value = company.name;
                                                                document.getElementById('company_address').value = company
                                                                    .address || '';
                                                                document.getElementById('registration_no').value = company
                                                                    .registration_no || '';
                                                                document.getElementById('registration_code').value = company
                                                                    .registration_code || '';
                                                                suggestionBox.classList.add("hidden");
                                                                suggestionBox.innerHTML = "";
                                                            });
                                                            suggestionBox.appendChild(li);
                                                        });
                                                        suggestionBox.classList.remove("hidden");
                                                    } else {
                                                        suggestionBox.classList.add("hidden");
                                                    }
                                                });
                                        });

                                        // Hide suggestions if clicked outside
                                        document.addEventListener("click", function(e) {
                                            if (!e.target.closest("#company_name") && !e.target.closest("#company_suggestions")) {
                                                suggestionBox.classList.add("hidden");
                                            }
                                        });
                                    </script>

                                    <script>
                                        // Set bank Information
                                        const bank_branch_input = document.getElementById("bank_branch");
                                            const bankSuggestionBox = document.getElementById("branch_suggestions");

                                            bank_branch_input.addEventListener("input", function () {
                                                const query = bank_branch_input.value.trim();

                                                if (query.length < 2) {
                                                    bankSuggestionBox.classList.add("hidden");
                                                    bankSuggestionBox.innerHTML = "";
                                                    return;
                                                }

                                                fetch(`/api/bank-search?q=${encodeURIComponent(query)}`)
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        bankSuggestionBox.innerHTML = "";
                                                        if (data.length > 0) {
                                                            data.forEach(bank => {
                                                                const li = document.createElement("li");
                                                                li.textContent = bank.branch_name;
                                                                li.className = "px-4 py-2 hover:bg-gray-100 cursor-pointer";
                                                                li.addEventListener("click", () => {
                                                                    bank_branch_input.value = bank.branch_name;
                                                                    document.getElementById('bank_address').value = bank
                                                                        .address || '';
                                                                    document.getElementById('bank_short_address').value = bank
                                                                        .short_address || '';
                                                                    bankSuggestionBox.classList.add("hidden");
                                                                    bankSuggestionBox.innerHTML = "";
                                                                });
                                                                bankSuggestionBox.appendChild(li);
                                                            });
                                                            bankSuggestionBox.classList.remove("hidden");
                                                        } else {
                                                            bankSuggestionBox.classList.add("hidden");
                                                        }
                                                    });
                                            });

                                            // Hide suggestions if clicked outside
                                            document.addEventListener("click", function (e) {
                                                if (!e.target.closest("#bank_branch") && !e.target.closest("#branch_suggestions")) {
                                                    bankSuggestionBox.classList.add("hidden");
                                                }
                                            });
                                    </script>

                            <script>
                                // Store the form ID after first save
                                let formEntryId = null;

                                // Function to collect all form data
                                function collectFormData() {
                                    const form = document.querySelector('form');
                                    const formData = new FormData(form);
                                    const data = {};

                                    // Convert FormData to object
                                    for (let [key, value] of formData.entries()) {
                                        // Skip the CSRF token and action buttons
                                        if (key === '_token' || key === 'action') continue;

                                        // Handle file inputs - we'll just store the filename for autosave
                                        if (value instanceof File) {
                                            data[key] = value.name;
                                        } else {
                                            data[key] = value;
                                        }
                                    }

                                    return data;
                                }

                                // Auto-save function
                                function autoSaveForm() {
                                    const formData = collectFormData();

                                    const payload = {
                                        name: document.querySelector('[name="name"]').value || "Untitled",
                                        template_type: "passport",
                                        form_data: formData,
                                    };

                                    const url = formEntryId
                                        ? `/form-entries/${formEntryId}`
                                        : `/form-entries`;

                                    const method = formEntryId ? 'PUT' : 'POST';

                                    fetch(url, {
                                        method: method,
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                            'Accept': 'application/json'
                                        },
                                        body: JSON.stringify(payload),
                                    })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (!formEntryId && data.id) {
                                                formEntryId = data.id;
                                                // Add hidden input to form for future updates
                                                const idInput = document.createElement('input');
                                                idInput.type = 'hidden';
                                                idInput.name = 'form_entry_id';
                                                idInput.value = data.id;
                                                form.appendChild(idInput);
                                            }
                                            console.log("Auto-saved at", new Date().toLocaleTimeString());
                                        })
                                        .catch(error => {
                                            console.error('Auto-save error:', error);
                                        });
                                }

                                // Set up auto-save on input changes with debounce
                                let saveTimeout;
                                function setupAutoSave() {
                                    const form = document.querySelector('form');

                                    // Auto-save when fields change (with debounce)
                                    form.addEventListener('input', function () {
                                        clearTimeout(saveTimeout);
                                        saveTimeout = setTimeout(autoSaveForm, 3000); // 3 seconds after last input
                                    });

                                    // Also save when the window is about to unload
                                    window.addEventListener('beforeunload', function () {
                                        if (document.querySelector('[name="name"]').value) {
                                            autoSaveForm();
                                        }
                                    });

                                    // Auto-save every 30 seconds regardless of changes
                                    setInterval(autoSaveForm, 30000);
                                }

                                // Load saved data if editing an existing form
                                function loadSavedData() {
                                    const formEntryId = new URLSearchParams(window.location.search).get('entry');
                                    if (formEntryId) {
                                        fetch(`/form-entries/${formEntryId}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.form_data) {
                                                    // Populate form fields
                                                    Object.entries(data.form_data).forEach(([name, value]) => {
                                                        const input = document.querySelector(`[name="${name}"]`);
                                                        if (input) {
                                                            if (input.type === 'checkbox' || input.type === 'radio') {
                                                                input.checked = value;
                                                            } else if (input.type === 'file') {
                                                                // For file inputs, we can't set the value, but we can show the filename
                                                                const fileInfo = input.nextElementSibling.querySelector('.file-info');
                                                                if (fileInfo && value) {
                                                                    fileInfo.textContent = `Previously uploaded: ${value}`;
                                                                }
                                                            } else {
                                                                input.value = value;
                                                            }
                                                        }
                                                    });

                                                    // Update the formEntryId for future saves
                                                    formEntryId = data.id;
                                                }
                                            })
                                            .catch(error => console.error('Error loading saved data:', error));
                                    }
                                }

                                // Initialize when DOM is loaded
                                document.addEventListener('DOMContentLoaded', function () {
                                    setupAutoSave();
                                    loadSavedData();

                                    // Also save when form is submitted (in case auto-save missed recent changes)
                                    document.querySelector('form').addEventListener('submit', function () {
                                        autoSaveForm();
                                    });
                                });
                            </script>


                        <script>
                            const inputPassport = document.getElementById("passport_no");
                            const suggestionBoxPassport = document.getElementById("passport_suggestions");

                            inputPassport.addEventListener("input", function () {
                                const query = inputPassport.value.trim();

                                if (query.length < 2) {
                                    suggestionBoxPassport.classList.add("hidden");
                                    suggestionBoxPassport.innerHTML = "";
                                    return;
                                }

                                fetch(`/api/traveller-search?q=${encodeURIComponent(query)}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        suggestionBoxPassport.innerHTML = "";
                                        if (data.length > 0) {
                                            data.forEach(traveller => {
                                                const li = document.createElement("li");
                                                li.textContent = traveller.name+"("+traveller.passport_no+")";
                                                li.className = "px-4 py-2 hover:bg-gray-100 cursor-pointer text-xs";
                                                li.addEventListener("click", () => {
                                                    inputPassport.value = traveller.passport_no;
                                                    const issued = formatDateForInput(traveller.passport_issued);
                                                    const expiry = formatDateForInput(traveller.passport_expiry);

                                                    document.getElementById('passport_issued').value = issued;
                                                    document.getElementById('passport_expiry').value = expiry;

                                                    document.getElementById('name').value = traveller
                                                        .name || '';
                                                    document.getElementById('address').value = traveller
                                                        .address || '';
                                                    document.getElementById('husband_name').value = traveller
                                                    .spouse_name || '';
                                                    document.getElementById('husband_passport_no').value = traveller
                                                        .spouse_passport_no || '';

                                                    suggestionBoxPassport.classList.add("hidden");
                                                    suggestionBoxPassport.innerHTML = "";
                                                });
                                                suggestionBoxPassport.appendChild(li);
                                            });
                                            suggestionBoxPassport.classList.remove("hidden");
                                        } else {
                                            suggestionBoxPassport.classList.add("hidden");
                                        }
                                    });

                                    function formatDateForInput(dateString) {
                                        if (!dateString) return '';
                                        const date = new Date(dateString);
                                        return date.toISOString().split('T')[0];
                                }
                            });

                            // Hide suggestions if clicked outside
                            document.addEventListener("click", function (e) {
                                if (!e.target.closest("#passport_no") && !e.target.closest("#company_suggestions")) {
                                    suggestionBoxPassport.classList.add("hidden");
                                }
                            });
                        </script>

                <script>
                    let childIndex = 0;

                    function addChild() {
                        const template = document.getElementById('child-template').innerHTML;
                        const rendered = template.replaceAll('__index__', childIndex);
                        const wrapper = document.getElementById('children-wrapper');
                        wrapper.insertAdjacentHTML('beforeend', rendered);
                        childIndex++;
                    }
                </script>


    <script>
        let currentImageTarget = ''; // will be 'logo' or 'signature'

        function openGallery(field) {
            currentImageTarget = field;
            document.getElementById('gallery-modal').classList.remove('hidden');
            loadGalleryFromDB();
        }

        function closeGallery() {
            document.getElementById('gallery-modal').classList.add('hidden');
        }

        function selectImageFromGallery(imageId, imageUrl) {
            const input = document.getElementById(currentImageTarget + '_id');
            const preview = document.getElementById(currentImageTarget + '_preview');

            if (input && preview) {
                input.value = imageId;
                preview.src = imageUrl;
                preview.classList.remove('hidden');
                closeGallery();
            } else {
                console.error('Input or preview not found for:', currentImageTarget);
            }
        }

        function loadGalleryFromDB() {
            const gallery = document.getElementById('image-gallery');
            gallery.innerHTML = '<p class="col-span-4 text-center">Loading images...</p>';

            axios.get('/api/gallery-images')
                .then(response => {
                    gallery.innerHTML = '';
                    const images = response.data;

                    if (images.length === 0) {
                        gallery.innerHTML = '<p class="col-span-4 text-center text-gray-500">No images found.</p>';
                        return;
                    }

                    images.forEach(image => {
                        const img = document.createElement('img');
                        img.src = `/storage/${image.file_path}`; // Adjust if needed
                        img.className = 'cursor-pointer border border-gray-300 rounded h-24 w-full object-cover';
                        img.onclick = () => selectImageFromGallery(image.id, img.src);
                        gallery.appendChild(img);
                    });
                })
                .catch(error => {
                    gallery.innerHTML = '<p class="col-span-4 text-center text-red-500">Failed to load images.</p>';
                    console.error(error);
                });
        }

        document.getElementById('new_image_upload').addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('image', file);

            fetch("{{ route('images.store') }}", {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        loadGalleryFromDB(); // Reload gallery with new image
                    } else {
                        alert('Image upload failed.');
                    }
                })
                .catch(() => alert('Error uploading image'));
        });
    </script>



@endsection
