<!-- resources/views/auth/login.blade.php -->
@extends('layouts.guest')

@vite(['resources/css/tailwind.css', 'resources/js/app.js'])

@section('content')
<div class="relative min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/bg-login.png') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black opacity-50"></div>

    <div class="relative z-10 min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 px-6">

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <div class="sm:mx-auto sm:w-full sm:max-w-md">
                    <img class="mx-auto h-24 w-auto" src="{{ asset('images/arcia.png') }}" alt="Logo">
                    <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
                        Login to your account
                    </h2>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-medium leading-5 text-gray-700">Email address</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input id="email" name="email" type="email" placeholder="user@example.com" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                            
                            @error('email')
                                <span class="text-red-500 text-xs italic mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="password" class="block text-sm font-medium leading-5 text-gray-700">Password</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input id="password" name="password" type="password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-500 @enderror">
                            
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path d="M12 5c-4 0-7 3-7 7s3 7 7 7 7-3 7-7-3-7-7-7zm0 12c-3.3 0-6-2.7-6-6s2.7-6 6-6 6 2.7 6 6-2.7 6-6 6z" />
                                </svg>
                            </button>
                            
                            @error('password')
                                <span class="text-red-500 text-xs italic mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="ml-2 block text-sm leading-5 text-gray-900">Remember me</label>
                        </div>
                        <div class="text-sm leading-5">
                            <a href="{{ route('password.request') }}" class="font-medium text-blue-500 hover:text-blue-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                                Forgot your password?
                            </a>
                        </div>
                    </div>

                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                Login
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.getElementById("togglePassword");
    const passwordField = document.getElementById("password");

    togglePassword.addEventListener("click", function () {
        const type = passwordField.type === "password" ? "text" : "password";
        passwordField.type = type;

        if (type === "password") {
            togglePassword.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 5c-4 0-7 3-7 7s3 7 7 7 7-3 7-7-3-7-7-7zm0 12c-3.3 0-6-2.7-6-6s2.7-6 6-6 6 2.7 6 6-2.7 6-6 6z" /></svg>`;
        } else {
            togglePassword.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 5c-4 0-7 3-7 7s3 7 7 7 7-3 7-7-3-7-7-7zm0 12c-3.3 0-6-2.7-6-6s2.7-6 6-6 6 2.7 6 6-2.7 6-6 6z" /></svg>`;
        }
    });
</script>

@endsection
