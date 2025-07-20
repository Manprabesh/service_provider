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
    <div class="bg-white p-8 rounded-lg shadow-md ">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Welcome</h1>
            <p class="text-gray-600 mt-2">Create account to be a provider</p>
        </div>

       
        <form id="userForm" class=" w-screen" action="{{ route('create_account') }}" method="POST" enctype="multipart/form-data">
            <!-- Personal Information Section -->
            @csrf

            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="dob" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth *</label>
                        <input type="date" id="dob" name="dob" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="nationality" class="block text-sm font-medium text-gray-700 mb-2">Nationality
                            *</label>
                        <input type="text" id="nationality" name="nationality" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                   
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Contact Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="md:col-span-2">
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location/Address
                            *</label>
                        <!-- <textarea id="location" name="location" rows="3" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div> -->
                    <div>
                        <label for="town">Town</label>
                        <input type="text" name="town" id="" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div> <div>
                        <label for="pincode">pincode</label>
                        <input type="text" name="pincode" id="" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div> <div>
                        <label for="pincode">Distric</label>
                        <input type="text" name="distric" id="" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                </div>
            </div>

            <!-- Identity Documents Section -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Identity Documents</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="adhar_no" class="block text-sm font-medium text-gray-700 mb-2">Aadhar Number</label>
                        <input type="text" id="adhar_no" name="adhar_no" placeholder="XXXX XXXX XXXX" maxlength="14"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="pan_no" class="block text-sm font-medium text-gray-700 mb-2">PAN Number</label>
                        <input type="text" id="pan_no" name="pan_no" placeholder="ABCDE1234F" maxlength="10"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Professional Information Section -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Professional Information</h2>
                <div class="space-y-6">
                    <div>
                        <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">Experience (Years)
                            *</label>
                        <input type="number" id="experience" name="experience" min="0" max="50" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="about" class="block text-sm font-medium text-gray-700 mb-2">About Yourself *</label>
                        <textarea id="about" name="about" rows="4" required
                            placeholder="Tell us about yourself, your skills, and background..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>
                </div>
            </div>

            <!-- Service Information Section -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Service Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="service_type" class="block text-sm font-medium text-gray-700 mb-2">Service Type
                            *</label>
                        <select id="service_type" name="service_type" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select service type</option>
                            <option value="web_development">Web Development</option>
                            <option value="mobile_development">Cleaner</option>
                            <option value="ai_ml">Driver</option>
                            <option value="cybersecurity">Lawyer</option>
                            <option value="consulting">Consulting</option>
                            <option value="other">Plumber</option>
                        </select>
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price (₹) *</label>
                        <input type="number" id="price" name="price" min="0" step="0.01" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Additional Information Section -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Additional Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Profile Photo</label>
                        <input type="file" id="photo" name="photo" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                   

                    <div class="md:col-span-2">
                        <label for="review" class="block text-sm font-medium text-gray-700 mb-2">Review/Comments</label>
                        <textarea id="review" name="review" rows="3" placeholder="Any additional comments or reviews..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center pt-6">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Submit Information
                </button>
            </div>
        </form>

    </div>

    <script>


    </script>
</body>

</html>