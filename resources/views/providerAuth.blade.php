<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
     @if (session('failed'))
            <div class="alert alert-danger">
                {{ session('failed') }}
            </div>
        @endif
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Welcome</h1>
            <p class="text-gray-600 mt-2">Sign in to your account or create a new one</p>
        </div>

        <!-- Toggle Buttons -->
        <div class="flex mb-6 bg-gray-200 rounded-lg p-1">
            <button id="loginTab"
                class="flex-1 py-2 px-4 rounded-md text-sm font-medium transition-colors duration-200 bg-white text-gray-800 shadow-sm">
                Login
            </button>
            <button id="signupTab"
                class="flex-1 py-2 px-4 rounded-md text-sm font-medium transition-colors duration-200 text-gray-600 hover:text-gray-800">
                Sign Up
            </button>
        </div>
       
        <!-- Login Form -->
        <form id="loginForm" method="POST" action="{{ '/provider/auth' }}" class="space-y-6">

            @csrf
            <div>
                <label for="login_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" id="login_email" name="email" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Enter your email" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>



            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                Sign In
            </button>
        </form>


    </div>

    <script>


    </script>
</body>

</html>