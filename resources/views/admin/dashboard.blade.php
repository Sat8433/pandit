<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Pooja Booking Platform</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom Tailwind -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-shadow {
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.05);
        }
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
                        <a href="{{ route('admin.pandits.index') }}" class="text-gray-900 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Manage Pandits</a>
                        <a href="{{ route('admin.samagri.index') }}" class="text-gray-900 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Manage Samagri</a>
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
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Admin Dashboard</h1>
            <p class="text-gray-600">Welcome to the Pooja Booking Platform admin panel</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="text-3xl mb-2">👥</div>
                    <div>
                        <h3 class="text-lg font-semibold">Total Users</h3>
                        <p class="text-2xl font-bold text-purple-600">{{ $totalUsers ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="text-3xl mb-2">👨‍🦳</div>
                    <div>
                        <h3 class="text-lg font-semibold">Total Pandits</h3>
                        <p class="text-2xl font-bold text-purple-600">{{ $totalPandits ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="text-3xl mb-2">🙏</div>
                    <div>
                        <h3 class="text-lg font-semibold">Total Poojas</h3>
                        <p class="text-2xl font-bold text-purple-600">{{ $totalPoojas ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="text-3xl mb-2">📅</div>
                    <div>
                        <h3 class="text-lg font-semibold">Total Bookings</h3>
                        <p class="text-2xl font-bold text-purple-600">{{ $totalBookings ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.poojas.index') }}" class="block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 text-center">Manage Poojas</a>
                    <a href="{{ route('admin.pandits.index') }}" class="block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 text-center">Manage Pandits</a>
                    <a href="{{ route('admin.samagri.index') }}" class="block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 text-center">Manage Samagri</a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
                <div class="space-y-2">
                    <div class="text-gray-600">No recent activity</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">PoojaBooking</h3>
                    <p class="text-gray-400">Your trusted platform for booking authentic Hindu poojas online.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('poojas.index') }}" class="hover:text-white">Browse Poojas</a></li>
                        <li><a href="{{ route('pandits.index') }}" class="hover:text-white">Find Pandits</a></li>
                        <li><a href="{{ route('bookings.index') }}" class="hover:text-white">My Bookings</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Help Center</a></li>
                        <li><a href="#" class="hover:text-white">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Connect</h4>
                    <p class="text-gray-400 mb-4">Follow us on social media</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">📱</a>
                        <a href="#" class="text-gray-400 hover:text-white">📧</a>
                        <a href="#" class="text-gray-400 hover:text-white">💬</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 PoojaBooking. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
