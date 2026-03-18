@include('layouts.head')

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
                    <a href="{{ route('ktp.showAll') }}" class="text-white bg-white/10 px-3 py-2 rounded-md text-sm font-medium">Data KTP</a>
                    <a href="#" class="text-gray-300 hover:bg-white/10 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Tentang</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col md:flex-row items-start justify-between gap-1 mb-4">
            <div>
                <h4 class="text-4xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent mb-2">
                    Edit Data KTP
                </h4>
                <p class="text-md text-gray-600">
                    Edit data KTP <strong>{{ $ktp->nama }}</strong> (NIK: {{ $ktp->nik }})
                </p>
            </div>
        </div>

        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-xl mb-8 shadow-md">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-xl mb-8 shadow-md">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- AJAX Validation Summary -->
        <div id="ajax-errors" class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-xl mb-8 shadow-md hidden">
            <ul id="ajax-error-list" class="list-disc list-inside space-y-1">
            </ul>
        </div>

        <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl p-10 border border-white/50">
                <form id="ktp-form" class="space-y-8" method="POST" action="{{ route('ktp.update', $ktp->nik) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                <!-- NIK & Nama Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="nik" class="block text-sm font-semibold text-gray-700 mb-3">NIK <span class="text-red-500">*</span></label>
                        <input type="text" name="nik" id="nik" value="{{ old('nik', $ktp->nik) }}" readonly
                            class="w-full px-5 py-4 border border-gray-400 bg-gray-100 rounded-xl text-lg shadow-sm cursor-not-allowed">
                        <span id="nik-error" class="text-sm text-red-600 mt-1 hidden"></span>
                    </div>
                    <div>
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-3">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $ktp->nama) }}" 
                            class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm @error('nama') border-red-500 ring-1 ring-red-500 @enderror"
                            placeholder="Masukkan nama lengkap">
                        <span id="nama-error" class="text-sm text-red-600 mt-1 hidden"></span>
                    </div>
                </div>

                <!-- Tempat/Tanggal Lahir Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="tempat_lahir" class="block text-sm font-semibold text-gray-700 mb-3">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $ktp->tempat_lahir) }}" 
                            class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm">
                    </div>
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700 mb-3">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $ktp->tanggal_lahir) }}" 
                            class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm">
                    </div>
                </div>

                <!-- Jenis Kelamin & Agama Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="L" {{ old('jenis_kelamin', $ktp->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $ktp->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Agama</label>
                        <select name="agama" class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm">
                            <option value="">Pilih agama</option>
                            <option value="Islam" {{ old('agama', $ktp->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('agama', $ktp->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('agama', $ktp->agama) == 'Katolik' ? 'selected' : '' }} >Katolik</option>
                            <option value="Hindu" {{ old('agama', $ktp->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama', $ktp->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('agama', $ktp->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                    </div>
                </div>

                <!-- Alamat & Status Perkawinan Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-3">Alamat Lengkap</label>
                        <textarea name="alamat" id="alamat" rows="3" class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm resize-vertical">{{ old('alamat', $ktp->alamat) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Status Perkawinan</label>
                        <select name="status_perkawinan" class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm">
                            <option value="">Pilih status</option>
                            <option value="Belum Kawin" {{ old('status_perkawinan', $ktp->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                            <option value="Kawin" {{ old('status_perkawinan', $ktp->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                            <option value="Cerai Hidup" {{ old('status_perkawinan', $ktp->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                            <option value="Cerai Mati" {{ old('status_perkawinan', $ktp->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                        </select>
                    </div>
                </div>

                <!-- Pekerjaan & Kewarganegaraan Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="pekerjaan" class="block text-sm font-semibold text-gray-700 mb-3">Pekerjaan</label>
                        <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan', $ktp->pekerjaan) }}" 
                            class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm">
                    </div>
                    <div>
                        <label for="kewarganegaraan" class="block text-sm font-semibold text-gray-700 mb-3">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" id="kewarganegaraan" value="{{ old('kewarganegaraan', $ktp->kewarganegaraan) }}" 
                            class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm"
                            placeholder="WNI / WNA">
                    </div>
                </div>

                <!-- Foto Upload -->
                <div>
                    <label for="foto" class="block text-sm font-semibold text-gray-700 mb-3">Foto KTP (Opsional)</label>
                    <div class="space-y-3">
                        <input type="file" name="foto" id="foto" accept="image/*" class="hidden">
                        <label for="foto" class="block w-full border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-blue-400 hover:bg-blue-50 transition-all duration-200 cursor-pointer">
                            <div id="foto-preview-placeholder" class="w-20 h-20 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl flex items-center justify-center shadow-lg mx-auto mb-4">
                                @if($ktp->foto)
                                    <img src="{{ asset('storage/' . $ktp->foto) }}" alt="Foto saat ini" class="w-full h-full object-cover rounded-2xl shadow-md">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                @endif
                            </div>
                            <p class="text-lg font-semibold text-gray-700 mb-1">Ganti Foto KTP</p>
                            <p class="text-sm text-gray-500 mb-4">JPG, PNG (Max 2MB) - Kosongkan untuk tetap gunakan foto lama</p>
                            <div id="foto-filename" class="text-sm font-medium text-gray-600 bg-gray-100 px-3 py-1 rounded-lg hidden"></div>
                        </label>
                        <div id="foto-preview" class="hidden mt-4 p-4 bg-gray-50 rounded-xl border">
                            <img id="foto-preview-img" class="max-w-full max-h-64 rounded-lg shadow-md mx-auto block" alt="Preview">
                        </div>
                    </div>
                    @error('foto')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-200">
                    <a href="{{ route('ktp.showAll') }}" class="flex-1 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white py-5 px-8 rounded-xl font-semibold text-xl shadow-lg hover:shadow-xl transition-all duration-300 text-center">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white py-5 px-8 rounded-xl font-semibold text-xl shadow-lg hover:shadow-xl transition-all duration-300">
                        <span class="flex items-center justify-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Update Data KTP
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {

    // Photo preview functionality
    $('#foto').on('change', function(e) {
        const file = e.target.files[0];
        const filenameDiv = $('#foto-filename');
        const previewDiv = $('#foto-preview');
        const previewImg = $('#foto-preview-img');
        const placeholder = $('#foto-preview-placeholder');

        if (file) {
            filenameDiv.text(file.name).removeClass('hidden');
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.attr('src', e.target.result);
                previewDiv.removeClass('hidden');
                placeholder.hide();
            };
            reader.readAsDataURL(file);
            $('#foto').parent().addClass('border-green-400 bg-green-50');
        } else {
            filenameDiv.addClass('hidden');
            previewDiv.addClass('hidden');
            placeholder.show();
            $('#foto').parent().removeClass('border-green-400 bg-green-50');
        }
    });

});
</script>

@include('layouts.foot')
