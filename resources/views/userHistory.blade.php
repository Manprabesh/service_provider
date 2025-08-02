<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Dashboard - ServiceHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#1E40AF',
                        accent: '#F59E0B',
                        success: '#10B981',
                        danger: '#EF4444',
                        warning: '#F59E0B'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold text-gray-900">ServiceHub</h1>
                    <span class="hidden md:block text-sm text-gray-500">Provider Dashboard</span>
                </div>
                <nav class="flex items-center space-x-6">
                    <a href="#" class="text-gray-600 hover:text-primary transition-colors">Dashboard</a>
                    <a href="#" class="text-gray-600 hover:text-primary transition-colors">Services</a>
                    <a href="#" class="text-gray-600 hover:text-primary transition-colors">Analytics</a>
                    <div class="relative">
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-primary transition-colors">
                            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-sm font-medium">
                                SP
                            </div>
                            <span class="hidden lg:block">Service Provider</span>
                        </button>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Dashboard Header -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-primary to-secondary rounded-xl text-white p-8">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-6 md:mb-0">
                        <h2 class="text-3xl font-bold mb-2">Service Provider Dashboard</h2>
                        <p class="text-blue-100 text-lg">Track your bookings, reviews, and earnings</p>
                    </div>
                </div>
            </div>
        </div>

        @if (session('user_history'))
        @php
        $user = session('user_history');
        @endphp

        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Task History & Management</h3>
                <p class="text-gray-600 text-sm">Manage your service bookings and customer reviews</p>
            </div>

            <div class="overflow-x-auto">
                @foreach ($user as $user)
                <div class="border-b border-gray-200 last:border-b-0">
                    <div class="p-6">
                        <!-- Task Header -->
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
                            <div class="flex items-center space-x-4 mb-4 lg:mb-0">
                                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900">Task #{{ $user['user_id'] }}</h4>
                                    <p class="text-gray-600 text-sm">Provider ID: {{ $user['provider_id'] }}</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                @if($user['status'] == 'success')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                    </svg>
                                    Completed
                                </span>
                                @elseif($user['status'] == 'failed')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"></path>
                                    </svg>
                                    Failed
                                </span>
                                @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"></path>
                                    </svg>
                                    Pending
                                </span>
                                @endif

                                <span class="text-lg font-bold text-gray-900">₹{{ $user['amount'] }}</span>
                            </div>
                        </div>

                        <!-- Task Details Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="text-sm text-gray-600 mb-1">User ID</div>
                                <div class="font-semibold text-gray-900">{{ $user['user_id'] }}</div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="text-sm text-gray-600 mb-1">Provider ID</div>
                                <div class="font-semibold text-gray-900">{{ $user['provider_id'] }}</div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="text-sm text-gray-600 mb-1">Status</div>
                                <div class="font-semibold text-gray-900">{{ ucfirst($user['status']) }}</div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="text-sm text-gray-600 mb-1">Amount</div>
                                <div class="font-semibold text-gray-900">₹{{ $user['amount'] }}</div>
                            </div>
                        </div>

                        <!-- Review Section -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Customer Review -->
                            <div class="bg-blue-50 rounded-lg p-6">
                                <h5 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 text-primary mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"></path>
                                    </svg>
                                    Customer Review
                                </h5>

                                <div class="space-y-3">
                                    <div>
                                        <div class="text-sm text-gray-600 mb-1">Review Status</div>
                                        <div class="font-medium">
                                            @if($user['review_data'] == "")
                                            <span class="text-yellow-600">Pending</span>

                                            @endif
                                        </div>
                                    </div>

                                    @if($user['review_data'])
                                    <div>
                                        <div class="text-sm text-gray-600 mb-2">Customer Feedback</div>
                                        <div class="bg-white rounded-lg p-3 border">    
                                            <p class="text-gray-800">{{ $user['review_data'] }}</p>
                                        </div>
                                    </div>
                                    @else
                                    <div class="mt-4">
                                        <form action="/upload/review?provider={{ $user['provider_id'] }}&user={{ $user['user_id'] }}&review_id={{ $user['review_id'] }}" method="POST" enctype="application/json">
                                            @csrf
                                            <div class="space-y-3">
                                                <div>
                                                    <label for="comments" class="block text-sm font-medium text-gray-700 mb-2">Your Comments:</label>
                                                    <textarea id="comments"
                                                        name="user_review"
                                                        rows="4"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent resize-none"
                                                        placeholder="Enter your feedback here...">This is some pre-filled text.</textarea>
                                                </div>
                                                <button type="submit"
                                                    class="w-full bg-primary text-white py-2 px-4 rounded-lg font-medium hover:bg-secondary transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2">
                                                    Submit Review
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                </div>


                            </div>

                            <!-- Task Actions -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h5 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 text-accent mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"></path>
                                    </svg>
                                    Task Management
                                </h5>

                                @if($user['status'] == "success")
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-green-600 font-medium">Task Completed Successfully</p>
                                </div>
                                @elseif($user['status'] == "failed")
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-red-600 font-medium">Task Failed</p>
                                </div>
                                @else
                                <div class="space-y-3">
                                    <p class="text-gray-600 text-sm mb-4">Update the status of this task:</p>

                                    <form action="/task/success" class="mb-3" method='post'>
                                        @csrf
                                        <input type="number" name="pv_id" value="{{ $user['task_id'] }}" style="display:none">
                                        <button id='success'
                                            type="submit"
                                            class="w-full bg-green-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-green-700 transition-colors focus:ring-2 focus:ring-green-500 focus:ring-offset-2 flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                            </svg>
                                            Mark as Complete
                                        </button>
                                    </form>

                                    <form action="/task/failed" method='post'>
                                        @csrf

                                        <input type="number" name="pv_id" value="{{ $user['task_id'] }}" style="display:none">
                                        <button type="submit"
                                            class="w-full bg-red-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-red-700 transition-colors focus:ring-2 focus:ring-red-500 focus:ring-offset-2 flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"></path>
                                            </svg>
                                            Mark as Failed
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        @else
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Tasks Available</h3>
            <p class="text-gray-600 mb-6">You don't have any service bookings yet. Tasks will appear here once customers book your services.</p>
            <a href="#" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg font-medium hover:bg-secondary transition-colors">
                View Available Services
            </a>
        </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h4 class="text-lg font-semibold mb-2 text-gray-900">ServiceHub Provider</h4>
                <p class="text-gray-600">Manage your services professionally</p>
            </div>
        </div>
    </footer>

    <script>
        document.querySelector('#success').addEventListener('click', function() {
            document.querySelector('#success').style.display = "none";
        });

        
    </script>
</body>

</html>