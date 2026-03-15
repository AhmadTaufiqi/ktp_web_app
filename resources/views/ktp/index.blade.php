@include('layouts/head');

    <!-- Navbar -->
    <nav class="bg-white/10 backdrop-blur-md border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-white font-bold text-xl">Sistem KTP</span>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="#" class="text-white hover:bg-white/10 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                        <a href="#" class="text-gray-300 hover:bg-white/10 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Data KTP</a>
                        <a href="#" class="text-gray-300 hover:bg-white/10 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Tentang</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    Sistem Informasi <span class="text-blue-400">KTP Indonesia</span>
                </h1>
                <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                    Kelola dan lihat data Kartu Tanda Penduduk dengan mudah dan cepat
                </p>
                <div class="flex justify-center gap-4">
                    <a href="#data-ktp" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                        Lihat Data
                    </a>
                    <a href="#" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-lg font-semibold border border-white/30 transition">
                        Tambah Data
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6 flex items-center">
                <div class="bg-blue-100 rounded-full p-4 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Penduduk</p>
<p class="text-2xl font-bold text-gray-800 stats-total"></p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 flex items-center">
                <div class="bg-green-100 rounded-full p-4 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">KTP Aktif</p>
                    <p class="text-2xl font-bold text-gray-800"></p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 flex items-center">
                <div class="bg-purple-100 rounded-full p-4 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kabupaten/Kota</p>
                    <p class="text-2xl font-bold text-gray-800">3</p>
                </div>
            </div>
        </div>
    </div>

    <!-- KTP Data Section -->
    <div id="data-ktp" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-white">Data KTP</h2>
                <p class="text-gray-400 mt-1">Berikut adalah data KTP yang tersimpan dalam sistem</p>
            </div>
            <a href="{{ route('ktp.showAll') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                Show All
            </a>
        </div>

        <!-- KTP Preview Template (hidden) -->
        <div id="ktp-preview-template" style="display: none;" class="ktp-card bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- KTP Header -->
            <div class="bg-red-600 px-4 py-2 flex items-center justify-between">
                <span class="text-white font-bold text-sm">KARTU TANDA PENDUDUK</span>
                <span class="text-white/80 text-xs">RI</span>
            </div>
            
            <!-- KTP Content -->
            <div class="p-4">
                <div class="flex gap-4">
                    <!-- Photo Placeholder -->
                    <div class="flex-shrink-0">
                        <div class="w-20 h-24 bg-gray-200 rounded border-2 border-gray-300 flex items-center justify-center photo-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Data -->
                    <div class="flex-1 min-w-0">
                        <div class="space-y-1">
                            <p class="text-xs text-gray-500">NIK</p>
                            <p class="text-sm font-mono font-semibold text-gray-800 truncate" data-nik></p>
                        </div>
                        <div class="mt-2">
                            <p class="text-lg font-bold text-gray-800 truncate" data-nama></p>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Info -->
                <div class="mt-4 pt-3 border-t border-gray-100">
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="text-xs text-gray-600 truncate" data-alamat></p>
                    </div>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800" data-jenis_kelamin></span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800" data-pekerjaan></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- KTP Cards Grid Container -->
        <div id="ktp-preview-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="col-span-full text-center py-12 text-gray-400">
                <i class="fas fa-spinner fa-spin text-2xl text-blue-400 mb-4 block mx-auto"></i>
                <p>Memuat preview data KTP...</p>
            </div>
        </div>

        <!-- Show All Button (Mobile) -->
        <div class="mt-8 text-center md:hidden">
            <a href="{{ route('ktp.showAll') }}" class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                Tampilkan Semua
            </a>
        </div>
        <!-- Preview KTP Data Loader Script -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                loadPreviewKTPData();
            });

            function loadPreviewKTPData() {
                $('#ktp-preview-container').html('<div class="col-span-full text-center py-12"><i class="fas fa-spinner fa-spin text-2xl text-blue-400 mb-4 block mx-auto"></i><p class="text-gray-400">Memuat data...</p></div>');

                $.get('/api/ktp?per_page=4')
                    .done(function(result) {
                        if (result.success && result.data.length > 0) {
                            // Update stats
                            $('.stats-total').text(result.pagination.total);
                            // Update KTP Aktif (same as total)
                            $('.stats-total').closest('.bg-white').next('.bg-white').find('p.text-2xl').text(result.pagination.total);

                            // Render first 4 cards
                            $('#ktp-preview-container').empty();
                            result.data.slice(0, 4).forEach(function(ktp) {
                                const $card = $('#ktp-preview-template').clone().removeAttr('id style').removeClass('hidden');
                                
                                // Populate data
                                $card.find('[data-nik]').text(ktp.nik || 'N/A');
                                $card.find('[data-nama]').text(ktp.nama || 'N/A');
                                $card.find('[data-alamat]').text(ktp.alamat || 'N/A');
                                $card.find('[data-jenis_kelamin]').text(ktp.jenis_kelamin || 'N/A');
                                $card.find('[data-pekerjaan]').text(ktp.pekerjaan || 'N/A');
                                
                                // Photo if available
                                if (ktp.foto_url) {
                                    $card.find('.photo-placeholder').html(`<img src="${ktp.foto_url}" alt="Foto KTP" class="w-full h-full object-cover rounded">`);
                                } else {
                                    // Keep SVG icon for no photo (already in template)
                                }
                                
                                $('#ktp-preview-container').append($card);
                            });
                        } else {
                            $('#ktp-preview-container').html('<div class="col-span-full text-center py-12 text-gray-400">Belum ada data KTP. <a href="{{ route("ktpCreate") }}" class="text-blue-400 hover:underline font-medium">Tambah data pertama</a></div>');
                        }
                    })
                    .fail(function() {
                        $('#ktp-preview-container').html('<div class="col-span-full text-center py-12 text-red-400">Gagal memuat data. Silakan coba muat ulang halaman.</div>');
                    });
            }
        </script>
    </div>

    @include('layouts/foot')

