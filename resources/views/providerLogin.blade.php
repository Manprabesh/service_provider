<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
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
                
                <a href="/provider/create/account">Create account</a>
            </button>
        </div>
        @if (session('response'))
            <div>
                {{session('response') }}
            </div>
        @endif

        <!-- Login Form -->
        <form id="loginForm" method="POST" action="{{ route('provider-login') }}" class="space-y-6">
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

            

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                </div>

            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                Sign In
            </button> 
        </form>
 <button class="w-full bg-green-600 mt-3 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
    <a href="/provider/login">Login as a provider</a>
                
            </button>
        <!-- Sign Up Form -->
       


       
    </div>

    <script>
        // Tab switching functionality
        const loginTab = document.getElementById('loginTab');
        const signupTab = document.getElementById('signupTab');
        const loginForm = document.getElementById('loginForm');
        const signupForm = document.getElementById('signupForm');
        const signupPassword = document.getElementById('signup_password');
        const password_confirmation = document.getElementById('password_confirmation');
        const butn = document.getElementById('create_button');


        loginTab.addEventListener('click', () => {
            loginTab.classList.add('bg-white', 'text-gray-800', 'shadow-sm');
            loginTab.classList.remove('text-gray-600');
            signupTab.classList.remove('bg-white', 'text-gray-800', 'shadow-sm');
            signupTab.classList.add('text-gray-600');

            loginForm.classList.remove('hidden');
            signupForm.classList.add('hidden');
        });
        
        signupTab.addEventListener('click', () => {
            signupTab.classList.add('bg-white', 'text-gray-800', 'shadow-sm');
            signupTab.classList.remove('text-gray-600');
            loginTab.classList.remove('bg-white', 'text-gray-800', 'shadow-sm');
            loginTab.classList.add('text-gray-600');

            signupForm.classList.remove('hidden');
            loginForm.classList.add('hidden');
        });
        document.getElementById('signupForm').addEventListener('submit', function (e) {
            const password = document.getElementById('signup_password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password !== confirmPassword) {
                e.preventDefault(); // stop form submission
                alert('Passwords do not match.');
            }
        });

    </script>
</body>

</html>