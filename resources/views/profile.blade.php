<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ServiceHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#1E40AF',
                        accent: '#F59E0B'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen">
    @php
    $user = session('user');
    @endphp

    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">ServiceHub</h1>
                </div>
                <nav class="hidden md:flex items-center space-x-6">
                    <a href="#" class="text-gray-600 hover:text-primary transition-colors">Dashboard</a>
                    <a href="#" class="text-gray-600 hover:text-primary transition-colors">Services</a>
                    <a href="#" class="text-gray-600 hover:text-primary transition-colors">Help</a>
                    <div class="relative">
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-primary transition-colors">
                            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-sm font-medium">
                                {{ strtoupper(substr($user['email'], 0, 1)) }}
                            </div>
                            <span class="hidden lg:block">{{ explode('@', $user['email'])[0] }}</span>
                        </button>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-primary to-secondary rounded-xl text-white p-8">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-6 md:mb-0">
                        <h2 class="text-3xl font-bold mb-2">Welcome back!</h2>
                        <p class="text-blue-100 text-lg">{{ $user['email'] }}</p>
                        <p class="text-blue-200 mt-2">Manage your services and track your bookings</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-white/10 backdrop-blur rounded-lg p-4">
                            <div class="text-2xl font-bold">Dashboard</div>
                            <div class="text-blue-200">User Panel</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Section -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6 border">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6 text-center">Profile Picture</h3>
                    
                    <!-- Profile Image Display -->
                    <div class="flex justify-center mb-6">
                        <div class="relative group">
                            @if (session('profile'))
                                <img src="{{ session('profile') }}" 
                                     class="w-40 h-40 rounded-full object-cover border-4 border-gray-200 shadow-lg group-hover:shadow-xl transition-shadow" 
                                     alt="Profile Image">
                            @else
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLat8bZvhXD3ChSXyzGsFVh6qgplm1KhYPKA&s" 
                                     class="w-40 h-40 rounded-full object-cover border-4 border-gray-200 shadow-lg group-hover:shadow-xl transition-shadow" 
                                     alt="Default Profile">
                            @endif
                            <div class="absolute inset-0 rounded-full bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all flex items-center justify-center">
                                <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Form -->
                    <form action="/user/profile-photo" method="POST" id="form" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="profile" id="profile_input" style="display:none">
                        
                        <div class="space-y-4">
                            <div>
                                <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                                    Choose New Profile Picture
                                </label>
                                <input type="file" 
                                       id="photo" 
                                       name="profile" 
                                       accept="image/*"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-secondary">
                            </div>
                            
                            <button type="submit" 
                                    class="w-full bg-primary text-white py-3 px-4 rounded-lg font-semibold hover:bg-secondary transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2 shadow-sm">
                                <div class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"></path>
                                    </svg>
                                    Upload Photo
                                </div>
                            </button>
                        </div>
                    </form>

                    <!-- Profile Info -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="text-center">
                            <h4 class="font-semibold text-gray-900">{{ explode('@', $user['email'])[0] }}</h4>
                            <p class="text-gray-600 text-sm mt-1">{{ $user['email'] }}</p>
                            <div class="mt-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active User
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="lg:col-span-2">
                <div class="space-y-6">
                    <!-- Quick Actions Cards -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border">
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">Quick Actions</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Search Services Button -->
                            <div class="group">
                                <a href="/service" class="block">
                                    <div class="bg-gradient-to-r from-primary to-secondary p-6 rounded-xl text-white hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h4 class="text-lg font-semibold mb-2">Search Services</h4>
                                                <p class="text-blue-100 text-sm">Find and book professional services</p>
                                            </div>
                                            <div class="bg-white/20 rounded-full p-3">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- My Tasks Button -->
                            <div class="group">
                                <a href="/user/data/history" class="block">
                                    <div class="bg-gradient-to-r from-accent to-orange-500 p-6 rounded-xl text-white hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h4 class="text-lg font-semibold mb-2">My Tasks</h4>
                                                <p class="text-orange-100 text-sm">View your booking history and status</p>
                                            </div>
                                            <div class="bg-white/20 rounded-full p-3">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Stats/Info Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white rounded-xl shadow-sm p-6 border text-center">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-900">Profile</h4>
                            <p class="text-gray-600 text-sm mt-1">Manage your account</p>
                        </div>

                        <div class="bg-white rounded-xl shadow-sm p-6 border text-center">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-900">Services</h4>
                            <p class="text-gray-600 text-sm mt-1">Browse available services</p>
                        </div>

                        <div class="bg-white rounded-xl shadow-sm p-6 border text-center">
                            <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-accent" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-900">Support</h4>
                            <p class="text-gray-600 text-sm mt-1">Get help when needed</p>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Getting Started</h3>
                        <div class="space-y-3">
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <div class="w-2 h-2 bg-primary rounded-full mr-3"></div>
                                <span class="text-gray-700">Complete your profile setup</span>
                            </div>
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <div class="w-2 h-2 bg-accent rounded-full mr-3"></div>
                                <span class="text-gray-700">Browse available services</span>
                            </div>
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                <span class="text-gray-700">Book your first service</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h4 class="text-lg font-semibold mb-2 text-gray-900">ServiceHub</h4>
                <p class="text-gray-600">Your trusted platform for professional services</p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('profile_input').addEventListener('change', function () {
            document.getElementById('form').submit();
        });
    </script>
</body>
</html>