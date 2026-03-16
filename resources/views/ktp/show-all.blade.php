@include('layouts/head');

    <!-- Navbar -->
    <nav class="bg-white/10 backdrop-blur-md border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('home') }}" class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-white font-bold text-xl">Sistem KTP</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('home') }}" class="text-gray-300 hover:bg-white/10 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                        <a href="#" class="text-white bg-white/10 px-3 py-2 rounded-md text-sm font-medium">Data KTP</a>
                        <a href="#" class="text-gray-300 hover:bg-white/10 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Tentang</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-white">Semua Data KTP</h1>
                <p class="text-gray-400 mt-1">Menampilkan semua data KTP yang terdaftar dalam sistem</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 items-center">
                <div class="flex-1 max-w-md">
                    <div class="relative">
                        <form id="search-form" method="GET" class="flex">
                            <input id="search-input" type="text" name="name" value="" placeholder="Cari berdasarkan nama..." class="w-full pl-12 pr-12 py-3 bg-white/80 backdrop-blur rounded-xl border border-white/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg shadow-lg transition-all">
                            <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600 transition-colors">
                                <i class="fas fa-search text-xl"></i>
                            </button>
                            <a id="clear-search" href="#" style="display:none;" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg shadow-lg hover:shadow-xl transition-all flex items-center">
                                <i class="fas fa-times text-sm"></i>
                            </a>
                        </form>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button id="import-btn" class="bg-purple-500 hover:bg-purple-600 text-white px-5 py-2.5 rounded-lg font-medium transition flex items-center gap-1">
                        <i class="fas fa-upload"></i>
                        Import
                    </button>
                    <a href="{{ route('ktpCreate') }}" class="bg-white/10 hover:bg-white/20 text-white px-5 py-2.5 rounded-lg font-medium border border-white/30 transition flex items-center gap-1">
                        <i class="fas fa-plus"></i>
                        Tambah
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div id="stats-container" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg p-4 flex items-center">
                <div class="bg-blue-100 rounded-full p-2 mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Total KTP</p>
                    <p class="text-xl font-bold text-gray-800" id="total-ktp">0</p>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4 flex items-center">
                <div class="bg-green-100 rounded-full p-2 mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Laki-Laki</p>
                    <p class="text-xl font-bold text-gray-800" id="male-count">0</p>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4 flex items-center">
                <div class="bg-pink-100 rounded-full p-2 mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Perempuan</p>
                    <p class="text-xl font-bold text-gray-800" id="female-count">0</p>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4 flex items-center">
                <div class="bg-purple-100 rounded-full p-2 mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Kota</p>
                    <p class="text-xl font-bold text-gray-800">3</p>
                </div>
            </div>
        </div>

        <!-- KTP Card Template (hidden) -->
        <div id="ktp-card-template" style="display: none;" class="ktp-card bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-red-600 px-4 py-2 flex items-center justify-between">
                <span class="text-white font-bold text-sm">KARTU TANDA PENDUDUK</span>
                <span class="text-white/80 text-xs">RI</span>
            </div>
            <div class="p-4">
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="foto-container w-20 h-24 bg-gray-200 rounded border-2 border-gray-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="space-y-1">
                            <p class="text-xs text-gray-500">NIK</p>
                            <p class="text-xs font-mono font-semibold text-gray-800 truncate" data-nik></p>
                        </div>
                        <div class="mt-2">
                            <p class="text-sm font-bold text-gray-800 truncate" data-nama></p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-gray-100 space-y-2">
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="text-xs text-gray-600 truncate" data-alamat></p>
                    </div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800" data-jenis_kelamin></span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800" data-pekerjaan></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- All KTP Cards Grid -->
        <div id="ktps-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        </div>

        <!-- Pagination -->
        <div id="pagination-container" class="mt-12 flex flex-col sm:flex-row justify-between items-center">
            <div class="text-sm text-gray-700 mb-4 sm:mb-0" id="pagination-info">
                Menampilkan <strong>0</strong> - <strong>0</strong> dari <strong>0</strong> data
            </div>
            <nav>
                <ul id="pagination-nav" class="inline-flex items-center -space-x-px rounded-md shadow-sm bg-white/80 backdrop-blur">
                </ul>
            </nav>
        </div>
    </div>

@vite(['resources/js/ktp/show-all.js'])

    <!-- Import Modal -->
    <div id="import-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Import Data KTP</h3>
                <p class="text-gray-600">Upload file CSV dengan kolom: nik, nama, alamat, dll.</p>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <input type="file" id="csv-file" accept=".csv" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <div id="file-preview" class="hidden p-4 bg-gray-50 rounded-xl">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-file-csv text-green-500 text-xl"></i>
                            <div>
                                <p class="font-medium text-gray-900" id="file-name"></p>
                                <p class="text-sm text-gray-500" id="file-size"></p>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 text-xs text-gray-500">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check text-green-500"></i>
                            NIK (unique)
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check text-green-500"></i>
                            Update if exists
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6 border-t border-gray-200 bg-gray-50 rounded-b-2xl flex gap-3 justify-end">
                <button id="cancel-import" class="px-6 py-2 text-gray-700 font-medium rounded-xl hover:bg-gray-100 transition">Batal</button>
                <button id="confirm-import" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition disabled:opacity-50" disabled>Import Data</button>
            </div>
        </div>
    </div>

    <!-- Progress Modal -->
    <div id="progress-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Import Berlangsung...</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                        <div>
                            <p class="font-semibold text-gray-900" id="progress-filename"></p>
                            <p class="text-sm text-gray-500" id="progress-status">Memulai import...</p>
                        </div>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div id="progress-bar" class="bg-blue-600 h-3 rounded-full transition-all duration-300" style="width: 0%"></div>
                    </div>
                    <p class="text-sm text-gray-500 text-center" id="progress-percent">0%</p>
                </div>
            </div>
        </div>
    </div>

@include('layouts/foot')
