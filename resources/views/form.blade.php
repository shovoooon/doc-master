@php
$today = \Carbon\Carbon::today();
$cover_issued = $today->copy()->format('Y-m-d'); // Keep as string
$ticket_issued = $today->copy()->subDay()->format('Y-m-d'); // Note: subDay() for 1 day
$invitation_issued = $today->copy()->subDays(rand(7, 10))->format('Y-m-d');

// For departure and return, we need to keep working with Carbon objects
$departureDate = $today->copy()->addDays(rand(20, 30));
$returnDate = $departureDate->copy()->addDays(rand(14, 21));

// Now format them when needed
$departure = $departureDate->format('Y-m-d');
$return = $returnDate->format('Y-m-d');
@endphp

<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div>
        <form target="_blank" action="{{ route('documents.submit') }}" method="POST" enctype="multipart/form-data"
            class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
            @csrf

            <!-- Personal Information -->
            <h2 class="text-base/7 font-semibold text-gray-900">Dates</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm/6 font-medium text-gray-700">Cover Issued</label>
                    <input type="date" name="cover_issued"
                        class="w-full border border-gray-300 rounded px-2 py-1.5"
                        value="{{$cover_issued}}">
                </div>
                <div>
                    <label class="block text-sm/6 font-medium text-gray-700">Ticket Issued</label>
                    <input type="date" name="ticket_issued"
                        class="w-full border border-gray-300 rounded px-2 py-1.5"
                        value="{{$ticket_issued}}">
                </div>
                <div>
                    <label class="block text-sm/6 font-medium text-gray-700">Invitation Issued</label>
                    <input type="date" name="invitation_issued"
                        class="w-full border border-gray-300 rounded px-2 py-1.5"
                        value="{{$invitation_issued}}">
                </div>

                <div class="col-start-1 col-end-4 grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Departure</label>
                        <input type="date" name="departure"
                            class="w-full border border-gray-300 rounded px-2 py-1.5"
                            value="{{$departure}}">
                    </div>
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Return</label>
                        <input type="date" name="return"
                            class="w-full border border-gray-300 rounded px-2 py-1.5"
                            value="{{$return}}">
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm/6 font-medium text-gray-700">Name</label>
                    <input type="text" name="name" class="w-full border border-gray-300 rounded px-2 py-1.5"
                        required>
                </div>

                <div>
                    <label class="block text-sm/6 font-medium text-gray-700">Address</label>
                    <input type="text" name="address" class="w-full border border-gray-300 rounded px-2 py-1.5">
                </div>

                <div class="col-start-1 col-end-3 grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm/6 font-medium text-gray-700">Passport No</label>
                        <input type="text" name="passport_no" class="w-full border border-gray-300 rounded px-2 py-1.5">
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

            <!-- Husband Information -->
            <h2 class="text-base/7 font-semibold text-gray-900">Husband Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm/6 font-medium text-gray-700">Husband Name</label>
                    <input type="text" name="husband_name" class="w-full border border-gray-300 rounded px-2 py-1.5">
                </div>

                <div>
                    <label class="block text-sm/6 font-medium text-gray-700">Husband Passport No</label>
                    <input type="text" name="husband_passport_no"
                        class="w-full border border-gray-300 rounded px-2 py-1.5">
                </div>
            </div>

            <!-- Company Information -->
            <h2 class="text-base/7 font-semibold text-gray-900">Company Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm/6 font-medium text-gray-700">Company Name</label>
                    <input type="text" name="company_name" class="w-full border border-gray-300 rounded px-2 py-1.5">
                </div>

                <div>
                    <label class="block text-sm/6 font-medium text-gray-700">Company Address</label>
                    <input type="text" name="company_address"
                        class="w-full border border-gray-300 rounded px-2 py-1.5">
                </div>

                <div>
                    <label class="block text-sm/6 font-medium text-gray-700">Registration No</label>
                    <input type="text" name="registration_no"
                        class="w-full border border-gray-300 rounded px-2 py-1.5">
                </div>

                <div>
                    <label class="block text-sm/6 font-medium text-gray-700">Registration Code</label>
                    <input type="text" name="registration_code"
                        class="w-full border border-gray-300 rounded px-2 py-1.5">
                </div>

                <div>
                    <label class="block text-sm/6 font-medium text-gray-700">Company Logo</label>
                    <input type="file" name="logo" accept="image/*"
                        class="w-full border border-gray-300 rounded px-2 py-1.5">
                </div>

                <div>
                    <label class="block text-sm/6 font-medium text-gray-700">Signature</label>
                    <input type="file" name="signature" accept="image/*"
                        class="w-full border border-gray-300 rounded px-2 py-1.5">
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
        </form>

    </div>


    <!-- Modal -->
    <div id="expiryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!-- Modal backdrop -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal content -->
            <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
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

</body>

</html>