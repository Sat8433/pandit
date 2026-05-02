<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pooja Booking Platform - Book Hindu Poojas Online</title>
    
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
                        <a href="{{ route('poojas.index') }}" class="text-gray-900 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Poojas</a>
                        <a href="{{ route('pandits.index') }}" class="text-gray-900 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Pandits</a>
                        <a href="{{ route('bookings.index') }}" class="text-gray-900 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Bookings</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-purple-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-purple-700">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-purple-600 px-4 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-purple-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-purple-700">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-bg text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="lg:w-1/2">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">
                        Book Authentic Hindu Poojas Online
                    </h1>
                    <p class="text-xl mb-8 text-purple-100">
                        Connect with verified pandits, book traditional poojas, and receive divine blessings at your convenience. Simple, reliable, and spiritually enriching.
                    </p>
                    <div class="flex space-x-4">
                        <a href="{{ route('poojas.index') }}" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                            Browse Poojas
                        </a>
                        <a href="{{ route('register') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition">
                            Get Started
                        </a>
                    </div>
                </div>
                <div class="lg:w-1/2 mt-10 lg:mt-0">
                    <div class="text-center">
                        <div class="text-8xl mb-4">🕉️</div>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="bg-white/20 backdrop-blur rounded-lg p-4">
                                <div class="text-3xl mb-2">📿</div>
                                <div class="text-sm">Traditional</div>
                            </div>
                            <div class="bg-white/20 backdrop-blur rounded-lg p-4">
                                <div class="text-3xl mb-2">👨‍🦳</div>
                                <div class="text-sm">Verified Pandits</div>
                            </div>
                            <div class="bg-white/20 backdrop-blur rounded-lg p-4">
                                <div class="text-3xl mb-2">🏠</div>
                                <div class="text-sm">At Your Home</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose PoojaBooking?</h2>
                <p class="text-lg text-gray-600">Experience seamless spiritual services with modern convenience</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center card-shadow rounded-lg p-6 hover-scale">
                    <div class="text-4xl mb-4">✨</div>
                    <h3 class="text-xl font-semibold mb-2">Verified Pandits</h3>
                    <p class="text-gray-600">All pandits are background verified and experienced in traditional rituals</p>
                </div>
                <div class="text-center card-shadow rounded-lg p-6 hover-scale">
                    <div class="text-4xl mb-4">📅</div>
                    <h3 class="text-xl font-semibold mb-2">Flexible Booking</h3>
                    <p class="text-gray-600">Choose your preferred date, time, and location for the pooja</p>
                </div>
                <div class="text-center card-shadow rounded-lg p-6 hover-scale">
                    <div class="text-4xl mb-4">🛡️</div>
                    <h3 class="text-xl font-semibold mb-2">Secure Payments</h3>
                    <p class="text-gray-600">Safe and secure online payment options with instant confirmation</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Poojas Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Popular Poojas</h2>
                <p class="text-lg text-gray-600">Book traditional poojas for various occasions</p>
            </div>
            <div class="grid md:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale">
                    <div class="h-32 bg-gradient-to-r from-orange-400 to-red-500 flex items-center justify-center">
                        <div class="text-4xl">🌙</div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold mb-2">Satyanarayan Pooja</h3>
                        <p class="text-gray-600 text-sm mb-2">For prosperity and well-being</p>
                        <div class="text-purple-600 font-bold">₹2,500 onwards</div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale">
                    <div class="h-32 bg-gradient-to-r from-yellow-400 to-orange-500 flex items-center justify-center">
                        <div class="text-4xl">🏠</div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold mb-2">Griha Pravesh</h3>
                        <p class="text-gray-600 text-sm mb-2">House warming ceremony</p>
                        <div class="text-purple-600 font-bold">₹3,500 onwards</div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale">
                    <div class="h-32 bg-gradient-to-r from-green-400 to-blue-500 flex items-center justify-center">
                        <div class="text-4xl">💍</div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold mb-2">Marriage Pooja</h3>
                        <p class="text-gray-600 text-sm mb-2">Wedding ceremony rituals</p>
                        <div class="text-purple-600 font-bold">₹5,000 onwards</div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale">
                    <div class="h-32 bg-gradient-to-r from-purple-400 to-pink-500 flex items-center justify-center">
                        <div class="text-4xl">👶</div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold mb-2">Naming Ceremony</h3>
                        <p class="text-gray-600 text-sm mb-2">Baby naming rituals</p>
                        <div class="text-purple-600 font-bold">₹1,500 onwards</div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('poojas.index') }}" class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition">
                    View All Poojas
                </a>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">How It Works</h2>
                <p class="text-lg text-gray-600">Book your pooja in 4 simple steps</p>
            </div>
            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-purple-600">1</span>
                    </div>
                    <h3 class="font-semibold mb-2">Choose Pooja</h3>
                    <p class="text-gray-600 text-sm">Browse and select the pooja you need</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-purple-600">2</span>
                    </div>
                    <h3 class="font-semibold mb-2">Select Pandit</h3>
                    <p class="text-gray-600 text-sm">Choose from verified pandits or auto-assign</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-purple-600">3</span>
                    </div>
                    <h3 class="font-semibold mb-2">Book Slot</h3>
                    <p class="text-gray-600 text-sm">Select date, time and location</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-purple-600">4</span>
                    </div>
                    <h3 class="font-semibold mb-2">Pay & Relax</h3>
                    <p class="text-gray-600 text-sm">Secure payment and enjoy the pooja</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 gradient-bg text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold mb-2">500+</div>
                    <div class="text-purple-100">Verified Pandits</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">10,000+</div>
                    <div class="text-purple-100">Poojas Completed</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">50+</div>
                    <div class="text-purple-100">Pooja Types</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">4.9★</div>
                    <div class="text-purple-100">Customer Rating</div>
                </div>
            </div>
        </div>
    </section>

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
