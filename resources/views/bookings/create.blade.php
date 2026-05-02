@extends('layouts.public')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Book {{ $pooja->name }}</h1>
                <p class="text-gray-600">Please provide booking details to proceed.</p>
            </div>
            <div class="hidden md:block">
                <span class="bg-purple-100 text-purple-800 text-sm px-3 py-1 rounded-full font-semibold">100% Secure</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <form action="{{ route('bookings.store') }}" method="POST" id="booking-form">
                @csrf
                <input type="hidden" name="pooja_id" value="{{ $pooja->id }}">

                <div class="grid md:grid-cols-2 gap-0">
                    <!-- Left Column - Details -->
                    <div class="p-8 border-r border-gray-200">
                        <!-- Packages Selection -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-4 text-gray-800">1. Select Package</h2>
                            <div class="space-y-3">
                                @forelse($pooja->packages as $package)
                                <label class="border rounded-lg p-4 cursor-pointer block hover:border-purple-400 transition-colors {{ $loop->first ? 'border-purple-500 bg-purple-50' : 'border-gray-200' }}">
                                    <div class="flex items-center">
                                        <input type="radio" name="pooja_package_id" value="{{ $package->id }}" class="text-purple-600 focus:ring-purple-500 h-4 w-4" {{ old('pooja_package_id') == $package->id || $loop->first ? 'checked' : '' }} data-price="{{ $package->price }}" data-name="{{ $package->name }}">
                                        <div class="ml-3 flex-1 flex justify-between">
                                            <div>
                                                <span class="block font-semibold text-gray-900">{{ $package->name }}</span>
                                                <span class="block text-sm text-gray-500">{{ $package->description }}</span>
                                            </div>
                                            <span class="font-bold text-purple-600">₹{{ number_format($package->price, 2) }}</span>
                                        </div>
                                    </div>
                                </label>
                                @empty
                                <div class="text-gray-500 text-sm">No packages available.</div>
                                <!-- Provide a default if no packages exist to satisfy validation? Wait, validation requires pooja_package_id... -->
                                @endforelse
                                @error('pooja_package_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Date & Time -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-4 text-gray-800">2. When you need it?</h2>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                    <input type="date" name="booking_date" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500" min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('booking_date') }}" required>
                                    @error('booking_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                                    <input type="time" name="booking_time" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500" value="{{ old('booking_time', '09:00') }}" required>
                                    @error('booking_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Samagri Options -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-4 text-gray-800">3. Pooja Samagri</h2>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <p class="text-sm text-gray-600 mb-3">Do you want us to bring the required samagri?</p>
                                
                                @if($pooja->samagriItems->count() > 0)
                                    <div class="space-y-2 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                                        @foreach($pooja->samagriItems as $index => $item)
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <input type="checkbox" name="samagri_items[{{ $index }}][id]" value="{{ $item->id }}" class="samagri-checkbox text-purple-600 focus:ring-purple-500 h-4 w-4 rounded border-gray-300" data-price="{{ $item->price }}" checked>
                                                <input type="hidden" name="samagri_items[{{ $index }}][quantity]" value="{{ $item->pivot->quantity }}">
                                                <span class="ml-2 text-sm text-gray-700">{{ $item->name }} ({{ $item->pivot->quantity }} {{ $item->unit }})</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900">₹{{ number_format($item->price * $item->pivot->quantity, 2) }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-sm text-gray-500">No specific samagri defined for this pooja.</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Address & Summary -->
                    <div class="p-8 bg-gray-50">
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-4 text-gray-800">4. Location Details</h2>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address</label>
                                    <textarea name="address" rows="2" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500" required placeholder="House No, Building, Street Area">{{ old('address') ?? auth()->user()->address }}</textarea>
                                    @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                        <input type="text" name="city" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500" required value="{{ old('city') ?? auth()->user()->city }}">
                                        @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                        <input type="text" name="state" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500" required value="{{ old('state') ?? auth()->user()->state }}">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Pincode</label>
                                    <input type="text" name="pincode" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500" required value="{{ old('pincode') ?? auth()->user()->pincode }}">
                                </div>
                                
                                <div class="pt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Pandit Preference (Optional)</label>
                                    <select name="pandit_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                                        <option value="">Auto-assign nearest available pandit</option>
                                        @foreach($pandits as $pandit)
                                            <option value="{{ $pandit->id }}" {{ old('pandit_id') == $pandit->id ? 'selected' : '' }}>{{ $pandit->user->name }} (★ {{ $pandit->rating }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Bill Details -->
                        <div class="bg-white rounded border border-gray-200 p-4 shadow-sm mb-6">
                            <h3 class="font-semibold text-gray-800 mb-3">Bill Details</h3>
                            <div class="flex justify-between items-center mb-2 text-sm">
                                <span class="text-gray-600" id="summary-package-name">Package Fee</span>
                                <span class="text-gray-900 font-medium" id="summary-package-price">₹0.00</span>
                            </div>
                            <div class="flex justify-between items-center mb-3 text-sm">
                                <span class="text-gray-600">Samagri Charges</span>
                                <span class="text-gray-900 font-medium" id="summary-samagri-price">₹0.00</span>
                            </div>
                            <!-- Platform fee might go here -->
                            <div class="flex justify-between items-center py-3 border-t border-dashed border-gray-300 mt-2">
                                <span class="font-bold text-gray-900">Total Amount Payable</span>
                                <span class="font-bold text-purple-700 text-lg" id="summary-total">₹0.00</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-purple-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors shadow-lg flex items-center justify-center">
                            <span class="mr-2">Confirm & Proceed to Pay</span>
                            <svg class="w-5 h-5 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                        
                        <p class="text-xs text-center text-gray-500 mt-4">By proceeding, you agree to our Terms & Conditions and Cancellation Policy.</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const packageRadios = document.querySelectorAll('input[name="pooja_package_id"]');
        const samagriCheckboxes = document.querySelectorAll('.samagri-checkbox');
        
        const packagePriceEl = document.getElementById('summary-package-price');
        const packageNameEl = document.getElementById('summary-package-name');
        const samagriPriceEl = document.getElementById('summary-samagri-price');
        const totalEl = document.getElementById('summary-total');

        function calculateTotal() {
            let packagePrice = 0;
            let packageName = 'Package Fee';
            
            const selectedPackage = document.querySelector('input[name="pooja_package_id"]:checked');
            if (selectedPackage) {
                packagePrice = parseFloat(selectedPackage.dataset.price);
                packageName = selectedPackage.dataset.name + ' Package';
                
                // Highlight the selected radio block
                packageRadios.forEach(radio => {
                    const parent = radio.closest('label');
                    if (radio.checked) {
                        parent.classList.add('border-purple-500', 'bg-purple-50');
                        parent.classList.remove('border-gray-200');
                    } else {
                        parent.classList.remove('border-purple-500', 'bg-purple-50');
                        parent.classList.add('border-gray-200');
                    }
                });
            }

            let samagriTotal = 0;
            samagriCheckboxes.forEach(checkbox => {
                if(checkbox.checked) {
                    const price = parseFloat(checkbox.dataset.price);
                    // The hidden input next to checkbox stores quantity
                    const qtyInput = checkbox.nextElementSibling;
                    const qty = parseInt(qtyInput.value) || 1;
                    samagriTotal += (price * qty);
                }
            });

            const total = packagePrice + samagriTotal;

            packageNameEl.textContent = packageName;
            packagePriceEl.textContent = '₹' + packagePrice.toFixed(2);
            samagriPriceEl.textContent = '₹' + samagriTotal.toFixed(2);
            totalEl.textContent = '₹' + total.toFixed(2);
        }

        packageRadios.forEach(radio => {
            radio.addEventListener('change', calculateTotal);
        });

        samagriCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', calculateTotal);
        });

        // Initial calc
        calculateTotal();
    });
</script>
<style>
    /* Styling scrollbar for samagri list */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1; 
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #d8b4fe; 
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #a855f7; 
    }
</style>
@endsection
