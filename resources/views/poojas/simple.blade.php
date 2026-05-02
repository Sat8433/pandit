<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poojas - Pooja Booking Platform</title>
    
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
                        <a href="{{ route('home') }}" class="text-gray-900 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                        <a href="{{ route('poojas.index') }}" class="text-purple-600 border-b-2 border-purple-600 px-3 py-2 rounded-md text-sm font-medium">Poojas</a>
                        <a href="{{ route('pandits.index') }}" class="text-gray-900 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Pandits</a>
                        <a href="{{ route('bookings.index') }}" class="text-gray-900 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Bookings</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-purple-600 px-4 py-2 rounded-md text-sm font-medium">Login</a>
                    <a href="{{ route('register') }}" class="bg-purple-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-purple-700">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Browse Poojas</h1>
            <p class="text-gray-600">Discover traditional Hindu poojas for every occasion</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-48 bg-gradient-to-r from-orange-400 to-red-500 flex items-center justify-center">
                    <div class="text-6xl">🌙</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Satyanarayan Pooja</h3>
                    <p class="text-gray-600 mb-4">For prosperity and well-being</p>
                    <div class="flex justify-between items-center">
                        <span class="text-purple-600 font-bold">₹2,500</span>
                        <a href="#" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-48 bg-gradient-to-r from-yellow-400 to-orange-500 flex items-center justify-center">
                    <div class="text-6xl">🏠</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Griha Pravesh</h3>
                    <p class="text-gray-600 mb-4">House warming ceremony</p>
                    <div class="flex justify-between items-center">
                        <span class="text-purple-600 font-bold">₹3,500</span>
                        <a href="#" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-48 bg-gradient-to-r from-green-400 to-blue-500 flex items-center justify-center">
                    <div class="text-6xl">💍</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Marriage Pooja</h3>
                    <p class="text-gray-600 mb-4">Wedding ceremony rituals</p>
                    <div class="flex justify-between items-center">
                        <span class="text-purple-600 font-bold">₹5,000</span>
                        <a href="#" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Book Now</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 text-center">
            <p class="text-gray-600">More poojas coming soon...</p>
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
