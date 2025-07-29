<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Services - Find & Book Quality Services</title>
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
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">ServiceHub</h1>
                </div>
                <nav class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-600 hover:text-primary transition-colors">Home</a>
                    <a href="/profile" class="text-gray-600 hover:text-primary transition-colors">Profile</a>
                    <a href="#" class="text-gray-600 hover:text-primary transition-colors">About</a>
                    <a href="#" class="text-gray-600 hover:text-primary transition-colors">Contact</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search Section -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Find Professional Services</h2>
                <p class="text-gray-600">Search and book quality services from verified professionals</p>
            </div>
            
            <form id="frm" method="post" action="/search/service" class="max-w-2xl mx-auto">
                @csrf
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1">
                        <input type="text" 
                               name="service_name" 
                               id="service_name" 
                               value="{{ old('service_name') }}"
                               placeholder="Enter service name (e.g., plumber, cleaner, driver)"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all">
                    </div>
                        <button type="submit" 
                                id="create_button"
                               
                                class="px-8 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-secondary transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2 shadow-sm">
                            Search Services
                        </button>
                </div>
            </form>
        </div>

        <!-- Alert Messages -->
        @session('null')
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                    </svg>
                    {{ $value }}
                </div>
            </div>
        @endsession

        <!-- Search Results -->
        @if(session('myData'))
            <div class="mb-6">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Search Results</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach(session('myData') as $item)
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden border">
                            <div class="aspect-w-16 aspect-h-12">
                                @if($item['photo'])
                                    <img class="w-full h-48 object-cover" src="{{ $item['photo'] }}" alt="{{ $item['service_type'] }}">
                                @else
                                    <img class="w-full h-48 object-cover" src="https://i.pinimg.com/736x/56/67/93/5667936906181a6fbe0501b471e2b5bd.jpg" alt="Service provider">
                                @endif
                            </div>
                            
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $item['service_type'] }}</h4>
                                    <span class="bg-primary text-white px-3 py-1 rounded-full text-sm font-medium">₹{{ $item['price'] }}</span>
                                </div>
                                
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                        </svg>
                                        <span class="text-sm">{{ $item['name'] }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                        </svg>
                                        <span class="text-sm">{{ $item['email'] }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                        </svg>
                                        <span class="text-sm">{{ $item['phone'] }}</span>
                                    </div>
                                </div>

                                <form method="POST" action="{{ '/book/service' }}" id="booking-form" class="w-full">
                                    @csrf
                                    <input type="hidden" name="service_email" value="{{ $item['email'] }}" id="email"> 
                                    <input type="hidden" name="price" value="{{ $item['price'] }}">
                                    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">

                                    <button type="submit" class="w-full bg-primary text-white py-3 px-4 rounded-lg font-semibold hover:bg-secondary transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2 shadow-sm">
                                        Book Service - ₹{{ $item['price'] }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Service Categories -->
            <div class="mb-6">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Popular Service Categories</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="group">
                        <a href="{{ '/service/cybersecurity' }}" class="block bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border group-hover:border-primary">
                            <div class="aspect-w-4 aspect-h-3">
                                <img src="https://i.pinimg.com/736x/ea/06/8a/ea068a2fb7720f1ffcfe86bf7fcdcd3a.jpg" 
                                     alt="Cybersecurity Services"
                                     class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-gray-900 group-hover:text-primary transition-colors">Cyber Security</h4>
                                <p class="text-gray-600 text-sm mt-1">Professional cybersecurity services and consultation</p>
                            </div>
                        </a>
                    </div>

                    <div class="group">
                        <a href="/service/cleaner" class="block bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border group-hover:border-primary">
                            <div class="aspect-w-4 aspect-h-3">
                                <img src="https://i.pinimg.com/736x/1e/b8/07/1eb807c0307acd9e098a5b56b7c21182.jpg" 
                                     alt="Cleaning Services"
                                     class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-gray-900 group-hover:text-primary transition-colors">Cleaner</h4>
                                <p class="text-gray-600 text-sm mt-1">Professional cleaning services for homes and offices</p>
                            </div>
                        </a>
                    </div>

                    <div class="group">
                        <a href="#" class="block bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border group-hover:border-primary">
                            <div class="aspect-w-4 aspect-h-3">
                                <img src="https://i.pinimg.com/736x/a8/f9/9d/a8f99dfd7631fbd123cdc567a7c63c39.jpg" 
                                     alt="Driver Services"
                                     class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-gray-900 group-hover:text-primary transition-colors">Driver</h4>
                                <p class="text-gray-600 text-sm mt-1">Professional driving services and transportation</p>
                            </div>
                        </a>
                    </div>

                    <div class="group">
                        <a href="#" class="block bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border group-hover:border-primary">
                            <div class="aspect-w-4 aspect-h-3">
                                <img src="https://i.pinimg.com/736x/5b/79/11/5b7911765a2ad889debb658c04759c98.jpg" 
                                     alt="Plumber Services"
                                     class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-gray-900 group-hover:text-primary transition-colors">Plumber</h4>
                                <p class="text-gray-600 text-sm mt-1">Expert plumbing services and repairs</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Features Section -->
        <div class="bg-white rounded-xl shadow-sm p-8 mt-12">
            <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Why Choose ServiceHub?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-primary/10 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Verified Professionals</h4>
                    <p class="text-gray-600">All service providers are thoroughly vetted and verified</p>
                </div>
                <div class="text-center">
                    <div class="bg-primary/10 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Quality Guaranteed</h4>
                    <p class="text-gray-600">100% satisfaction guarantee on all services</p>
                </div>
                <div class="text-center">
                    <div class="bg-primary/10 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Quick Booking</h4>
                    <p class="text-gray-600">Book services instantly with secure online payment</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h4 class="text-lg font-semibold mb-2">ServiceHub</h4>
                <p class="text-gray-400">Your trusted platform for professional services</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>

        const inputValue = document.querySelector('#service_name');
        let inputBtn = document.querySelector('#create_button');
        console
        console.log("input value", inputValue.value)
        if(inputValue.value.trim() === ""){
            inputBtn.classList.add('disable')
        }


        const orderId = "{{ session('order_id') }}";
        const email = "{{ session('service_email') }}";
        console.log("Order ID:", orderId);
        if (orderId && email) {
            pay()
        }

        function pay() {
            const amountInRupees = 1500;
            const amountInPaise = amountInRupees * 1000;
            let callback_url = "http://127.0.0.1:8000/done";

            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}",
                "amount": amountInPaise,
                "currency": "INR",
                "name": "Service Provider",
                "order_id": orderId,
                "description": "Test Transaction",
                "image": "https://www.itsolutionstuff.com/frontTheme/images/logo.png",
                "callback_url": callback_url,
                "prefill": {
                    "email": email
                },
                "theme": {
                    "color": "#3B82F6"
                },
            };

            var rzp = new Razorpay(options);
            rzp.open();
            console.log("Rzpppp", rzp)
        }
    </script>
</body>

</html>