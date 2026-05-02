@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <nav class="flex space-x-4 text-sm">
            <a href="{{ route('bookings.index') }}" class="text-purple-600 hover:text-purple-800">← Back to Bookings</a>
        </nav>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="md:flex">
            <!-- Booking Details -->
            <div class="md:w-2/3 p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Booking Details</h2>
                
                <div class="space-y-4">
                    <div>
                        <span class="text-gray-600">Booking ID:</span>
                        <span class="font-semibold">#{{ $booking->id }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Pooja:</span>
                        <span class="font-semibold">{{ $booking->pooja->name }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Package:</span>
                        <span class="font-semibold">{{ $booking->package->name ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Date & Time:</span>
                        <span class="font-semibold">{{ \Carbon\Carbon::parse($booking->booking_date . ' ' . $booking->start_time)->format('M d, Y \a\t h:i A') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Status:</span>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($booking->status === 'confirmed') bg-green-100 text-green-800
                            @elseif($booking->status === 'completed') bg-blue-100 text-blue-800
                            @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                            @endif
                        ">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                    <div>
                        <span class="text-gray-600">Total Amount:</span>
                        <span class="font-semibold text-purple-600">₹{{ number_format($booking->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Address & Pandit Info -->
            <div class="md:w-1/3 p-6 bg-gray-50">
                <h3 class="text-lg font-semibold mb-4">Venue & Pandit</h3>
                
                <div class="space-y-4">
                    <div>
                        <h4 class="font-medium text-gray-900">Address</h4>
                        <p class="text-gray-700">{{ $booking->address }}, {{ $booking->city }}, {{ $booking->state }} - {{ $booking->pincode }}</p>
                    </div>
                    
                    @if($booking->pandit)
                        <div>
                            <h4 class="font-medium text-gray-900">Pandit</h4>
                            <div class="flex items-center space-x-4">
                                <div>
                                    <p class="font-semibold">{{ $booking->pandit->user->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $booking->pandit->experience }} years experience</p>
                                    <p class="text-sm text-yellow-500">⭐⭐⭐⭐ ({{ $booking->pandit->average_rating ?? 'N/A' }})</p>
                                </div>
                                <div class="text-sm text-gray-600">
                                    <p>📞 {{ $booking->pandit->mobile ?? 'N/A' }}</p>
                                    <p>📧 {{ $booking->pandit->email ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if($booking->special_instructions)
                        <div>
                            <h4 class="font-medium text-gray-900">Special Instructions</h4>
                            <p class="text-gray-700">{{ $booking->special_instructions }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Samagri Items -->
        @if($booking->samagriItems->count() > 0)
            <div class="border-t mt-6 pt-6">
                <h3 class="text-lg font-semibold mb-4">Samagri Items</h3>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($booking->samagriItems as $item)
                        <div class="bg-white border rounded-lg p-4">
                            <h4 class="font-medium text-gray-900">{{ $item->name }}</h4>
                            <p class="text-sm text-gray-600 mb-2">{{ $item->description }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-purple-600 font-bold">₹{{ number_format($item->price, 2) }}</span>
                                <span class="text-gray-600">× {{ $item->pivot->quantity }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="border-t mt-6 pt-6">
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    @if($booking->status === 'pending')
                        <p>⏰ Your booking is pending confirmation. You will be notified once confirmed.</p>
                    @elseif($booking->status === 'confirmed')
                        <p>✅ Your booking has been confirmed! Prepare for the pooja ceremony.</p>
                    @elseif($booking->status === 'completed')
                        <p>🎉 The pooja ceremony has been completed successfully!</p>
                    @elseif($booking->status === 'cancelled')
                        <p>❌ This booking has been cancelled.</p>
                    @endif
                </div>
                
                <div class="space-x-4">
                    @if($booking->status === 'pending')
                        <button class="bg-red-600 text-white px-4 py-2 rounded-md font-medium hover:bg-red-700">
                            Cancel Booking
                        </button>
                    @endif
                    
                    @if($booking->status === 'confirmed' && $booking->payment_status === 'pending')
                        <button class="bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700">
                            Proceed to Payment
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
