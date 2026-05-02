@extends('layouts.public')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Browse Poojas</h1>
        <p class="text-gray-600">Discover traditional Hindu poojas for every occasion</p>
    </div>

    @if($poojas->count() > 0)
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($poojas as $index => $pooja)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="h-48 flex items-center justify-center
                        {{ $index % 3 == 0 ? 'bg-gradient-to-r from-orange-400 to-red-500' : 
                           ($index % 3 == 1 ? 'bg-gradient-to-r from-yellow-400 to-orange-500' : 'bg-gradient-to-r from-green-400 to-blue-500') }}">
                        @if($pooja->image)
                            <img src="{{ Storage::url($pooja->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-6xl">{{ ['🌙', '🏠', '💍', '👶', '✨'][$index % 5] }}</div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $pooja->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($pooja->description, 60) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-purple-600 font-bold">{{ $pooja->formatted_price }} onwards</span>
                            <a href="{{ route('poojas.show', $pooja->slug ?? $pooja->id) }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $poojas->links() }}
        </div>
    @else
        <div class="bg-white p-8 rounded-lg shadow text-center">
            <p class="text-gray-600 text-lg">No poojas found. Please check back later.</p>
        </div>
    @endif
</div>
@endsection
