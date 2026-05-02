<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Pandits - Admin Dashboard</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom Tailwind -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-2xl font-bold text-purple-600">🙏 PoojaBooking</span>
                    </div>
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-900 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        <a href="{{ route('admin.poojas.index') }}" class="text-gray-900 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Manage Poojas</a>
                        <a href="{{ route('admin.pandits.index') }}" class="text-purple-600 border-b-2 border-purple-600 px-3 py-2 text-sm font-medium">Manage Pandits</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-purple-600 font-medium">Admin: {{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" class="text-gray-700 hover:text-purple-600 px-4 py-2 rounded-md text-sm font-medium">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Manage Pandits</h1>
                <p class="text-gray-600">Overview of all Pandits registered in the platform.</p>
            </div>
            <a href="#" class="bg-gray-400 text-white px-4 py-2 rounded-md cursor-not-allowed font-medium">+ Add New Pandit (coming soon)</a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pandit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Experience</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Verification</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Available</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pandits as $pandit)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $pandit->user->name ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500">{{ $pandit->user->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pandit->experience_years }} Years</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($pandit->verification_status === 'approved')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                            @elseif($pandit->verification_status === 'pending')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($pandit->is_available)
                                <span class="text-green-600">● Yes</span>
                            @else
                                <span class="text-red-600">● No</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{ route('admin.pandits.verify', $pandit->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="{{ $pandit->verification_status === 'approved' ? 'text-yellow-600 hover:text-yellow-900' : 'text-green-600 hover:text-green-900' }} mr-3">
                                    {{ $pandit->verification_status === 'approved' ? 'Suspend' : 'Verify' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.pandits.destroy', $pandit->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to completely delete this Pandit Profile?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No pandits found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $pandits->links() }}
            </div>
        </div>
    </div>
</body>
</html>
