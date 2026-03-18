@include('layouts/head')

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="mx-auto h-20 w-20 flex items-center justify-center rounded-full bg-white/10">
                <i class="fas fa-user-shield text-3xl text-white"></i>
            </div>
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-white">Sign in to your account</h2>
            <p class="mt-2 text-center text-sm text-gray-300">
                Masuk sebagai Admin atau User
            </p>
        </div>
        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-600 placeholder-gray-400 text-white rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm bg-white/5 backdrop-blur-md @error('email') border-red-500 @enderror" 
                           placeholder="Email address" value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                           class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-600 placeholder-gray-400 text-white rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm bg-white/5 backdrop-blur-md @error('password') border-red-500 @enderror" 
                           placeholder="Password">
                    @error('password')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-300">Remember me</label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-blue-400 hover:text-blue-300">Forgot your password?</a>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-sign-in-alt"></i>
                    </span>
                    Sign in
                </button>
            </div>
        </form>

        <div class="text-center">
            <p class="text-sm text-gray-400">
                Test accounts:<br>
                <strong>admin@example.com</strong> / <strong>password</strong> (Admin)<br>
                <strong>user@example.com</strong> / <strong>password</strong> (User)
            </p>
        </div>
    </div>
</div>

@include('layouts.foot')
