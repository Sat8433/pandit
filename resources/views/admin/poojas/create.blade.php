<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Pooja - Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-2xl font-bold text-purple-600">🙏 PoojaBooking</span>
                    </div>
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-900 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        <a href="{{ route('admin.poojas.index') }}" class="text-purple-600 border-b-2 border-purple-600 px-3 py-2 text-sm font-medium">Manage Poojas</a>
                        <a href="{{ route('admin.pandits.index') }}" class="text-gray-900 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Manage Pandits</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-purple-600 font-medium">Admin: {{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" class="text-gray-700 hover:text-purple-600 px-4 py-2 rounded-md text-sm font-medium">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="mb-8">
            <nav class="flex space-x-4 text-sm mb-4">
                <a href="{{ route('admin.poojas.index') }}" class="text-purple-600 hover:text-purple-800">← Back to Poojas</a>
            </nav>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Create New Pooja</h1>
        </div>

        <form action="{{ route('admin.poojas.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-6 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pooja Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category <span class="text-red-500">*</span></label>
                    <select name="category" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        <option value="general">General</option>
                        <option value="ceremony">Ceremony</option>
                        <option value="festival">Festival</option>
                        <option value="vedic">Vedic</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Base Price (₹) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="base_price" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Duration (minutes) <span class="text-red-500">*</span></label>
                    <input type="number" name="duration_minutes" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Required Samagri Items</label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 border rounded-md bg-gray-50">
                    @forelse($samagris as $samagri)
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" name="samagri[]" value="{{ $samagri->id }}" class="rounded text-purple-600 focus:ring-purple-500">
                            <span class="text-sm text-gray-700">{{ $samagri->name }} (₹{{ $samagri->price_per_unit }}/{{ $samagri->unit }})</span>
                        </label>
                    @empty
                        <p class="text-sm text-gray-500 col-span-3">No samagri items available. Please add some first.</p>
                    @endforelse
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t">
                <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-md font-medium hover:bg-purple-700">Save Pooja</button>
            </div>
        </form>
    </div>
</body>
</html>
