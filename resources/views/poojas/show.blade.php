@extends('layouts.public')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="md:flex">
            <!-- Image Section -->
            <div class="md:w-1/3 bg-gradient-to-r from-purple-400 to-indigo-500 flex items-center justify-center p-8">
                @if($pooja->image)
                    <img src="{{ Storage::url($pooja->image) }}" class="w-full h-auto object-cover rounded shadow" alt="{{ $pooja->name }}">
                @else
                    <div class="text-9xl text-white">🕉️</div>
                @endif
            </div>
            
            <!-- Content Section -->
            <div class="md:w-2/3 p-8">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $pooja->name }}</h1>
                        <span class="inline-block bg-purple-100 text-purple-800 text-xs px-2 rounded-full uppercase font-semibold tracking-wide">{{ $pooja->category }}</span>
                    </div>
                    <div class="text-right">
                        <span class="block text-2xl font-bold text-purple-600">{{ $pooja->formatted_price }}</span>
                        <span class="text-sm text-gray-500">Base Price</span>
                    </div>
                </div>
                
                <div class="mt-6 flex gap-4 text-sm text-gray-600">
                    <div class="flex items-center">
                        <span class="mr-2">⏱️</span> {{ $pooja->formatted_duration }}
                    </div>
                    <div class="flex items-center">
                        <span class="mr-2">📦</span> {{ $pooja->samagriItems->count() }} Samagri Items
                    </div>
                </div>

                <div class="mt-6">
                    <h2 class="text-xl font-semibold mb-2">Description</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $pooja->description }}</p>
                </div>

                @if($pooja->packages->count() > 0)
                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Available Packages</h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach($pooja->packages as $package)
                        <div class="border rounded-lg p-4 {{ $loop->first ? 'border-purple-500 bg-purple-50' : 'border-gray-200' }}">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="font-semibold text-lg">{{ $package->name }}</h3>
                                <span class="font-bold text-purple-600">₹{{ number_format($package->price, 2) }}</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">{{ $package->description }}</p>
                            <div class="text-xs text-gray-500 flex items-center">
                                <span class="mr-1">⏱️</span> {{ floor($package->duration_minutes / 60) }}h {{ $package->duration_minutes % 60 }}m
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                @if($pooja->samagriItems->count() > 0)
                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Required Samagri</h2>
                    <ul class="list-disc list-inside text-gray-700 grid grid-cols-2 gap-2">
                        @foreach($pooja->samagriItems as $item)
                            <li>{{ $item->name }} <span class="text-sm text-gray-500">({{ $item->pivot->quantity }} {{ $item->unit }})</span></li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="mt-8 pt-8 border-t border-gray-200">
                    <a href="{{ route('bookings.create', $pooja->slug ?? $pooja->id) }}" class="w-full md:w-auto inline-block bg-purple-600 text-white text-center font-bold py-3 px-8 rounded-lg hover:bg-purple-700 transition">
                        Proceed to Book »
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
