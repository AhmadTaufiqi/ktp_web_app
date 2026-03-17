@extends('layouts.head')

<div class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-900/20 to-slate-900 p-8">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <div class="mx-auto h-28 w-28 flex items-center justify-center rounded-full bg-orange-500/20 border-4 border-orange-500/30 mb-6">
                <i class="fas fa-user-crown text-5xl text-orange-400"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-4">Welcome, Admin {{ Auth::user()->name }}!</h1>
            <p class="text-xl text-gray-300 mb-8">Full access granted - Manage KTP system</p>
            <div class="inline-flex items-center px-6 py-2 bg-green-500/20 text-green-400 border border-green-500/30 rounded-full font-semibold">
                <i class="fas fa-crown mr-2"></i> Administrator Role
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-300">
                <div class="flex items-center mb-6">
                    <div class="h-12 w-12 bg-blue-500/20 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-id-card text-2xl text-blue-400"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">All KTP Data</h3>
                        <p class="text-gray-400">View complete records</p>
                    </div>
                </div>
                <a href="{{ route('ktp.showAll') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-eye mr-2"></i>
                    View All
                </a>
            </div>

            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-300 lg:col-span-2">
                <div class="flex items-center mb-6">
                    <div class="h-12 w-12 bg-green-500/20 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-plus text-2xl text-green-400"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Add New KTP</h3>
                        <p class="text-gray-400">Create new KTP records</p>
                    </div>
                </div>
                <a href="{{ route('ktpCreate') }}" class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-medium rounded-xl hover:bg-green-700 transition duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Add KTP
                </a>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-300">
                <h3 class="text-xl font-bold text-white mb-4">Quick Stats</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-300">Admin:</span>
                        <span class="font-bold text-orange-400">{{ Auth::user()->role === 'admin' ? 'You' : 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-300">Role:</span>
                        <span class="font-bold text-green-400">Administrator</span>
                    </div>
                </div>
            </div>

            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-300">
                <div class="flex items-center mb-6">
                    <div class="h-12 w-12 bg-red-500/20 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-sign-out-alt text-2xl text-red-400"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Logout</h3>
                        <p class="text-gray-400">Sign out securely</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-6 py-3 bg-red-600 text-white font-medium rounded-xl hover:bg-red-700 transition duration-200">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layouts.foot')
