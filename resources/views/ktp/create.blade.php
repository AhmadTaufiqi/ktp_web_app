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
            <div class="flex flex-col md:flex-row items-start justify-between gap-6 mb-12">
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent mb-2">
                        Tambah Data KTP
                    </h1>
                    <p class="text-xl text-gray-600 max-w-md">
                        Isi form di bawah ini untuk menambahkan data KTP baru ke sistem
                    </p>
                </div>
                <a href="{{ route('ktp.showAll') }}" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-8 py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Lihat Data
                </a>
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

            <!-- AJAX Validation Summary -->
            <div id="ajax-errors" class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-xl mb-8 shadow-md hidden">
                <ul id="ajax-error-list" class="list-disc list-inside space-y-1">
                </ul>
            </div>
            @endif

            <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl p-10 border border-white/50">
<form id="ktp-form" class="space-y-8">
                    @csrf

                    <!-- NIK & Nama Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label for="nik" class="block text-sm font-semibold text-gray-700 mb-3">NIK <span class="text-red-500">*</span></label>
<input type="text" name="nik" id="nik" value="{{ old('nik') }}" 
                                class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm @error('nik') border-red-500 ring-1 ring-red-500 @enderror"
                                placeholder="16 digit NIK" maxlength="16">
                            <span id="nik-error" class="text-sm text-red-600 mt-1 hidden"></span>
                        </div>
                        <div>
                            <label for="nama" class="block text-sm font-semibold text-gray-700 mb-3">Nama Lengkap <span class="text-red-500">*</span></label>
<input type="text" name="nama" id="nama" value="{{ old('nama') }}" 
                                class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm @error('nama') border-red-500 ring-1 ring-red-500 @enderror"
                                placeholder="Masukkan nama lengkap">
                            <span id="nama-error" class="text-sm text-red-600 mt-1 hidden"></span>
                        </div>
                    </div>

                    <!-- Tempat/Tanggal Lahir Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-semibold text-gray-700 mb-3">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" 
                                class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm">
                        </div>
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700 mb-3">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" 
                                class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm">
                        </div>
                    </div>

                    <!-- Jenis Kelamin & Agama Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm">
                                <option value="">Pilih jenis kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
<option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Agama</label>
                            <select name="agama" class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm">
                                <option value="">Pilih agama</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }} >Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                        </div>
                    </div>

                    <!-- Alamat & Status Perkawinan Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-3">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" rows="3" class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm resize-vertical">{{ old('alamat') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Status Perkawinan</label>
                            <select name="status_perkawinan" class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm">
                                <option value="">Pilih status</option>
                                <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                        </div>
                    </div>

                    <!-- Pekerjaan & Kewarganegaraan Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label for="pekerjaan" class="block text-sm font-semibold text-gray-700 mb-3">Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}" 
                                class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-lg shadow-sm">
                        </div>
                        <div>
                            <label for="kewarganegaraan" class="block text-sm font-semibold text-gray-700 mb-3">Kewarganegaraan</label>
                            <input type="text" name="kewarganegaraan" id="kewarganegaraan" value="{{ old('kewarganegaraan') }}" 
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-lg font-semibold text-gray-700 mb-1">Pilih Foto KTP</p>
                                <p class="text-sm text-gray-500 mb-4">JPG, PNG (Max 2MB)</p>
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
<button type="button" id="submit-btn" class="flex-1 bg-gradient-to-r from-blue-600 to-emerald-600 hover:from-blue-700 hover:to-emerald-700 text-white py-5 px-8 rounded-xl font-semibold text-xl shadow-lg hover:shadow-xl transition-all duration-300">
                            <span class="flex items-center justify-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Simpan Data KTP
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

    // Client-side validation and AJAX submit
    $('#submit-btn').on('click', function(e) {
        e.preventDefault();
        
        // Clear previous errors
        $('.error-span').addClass('hidden').text('');
        $('#ajax-errors').addClass('hidden');
        $('input, select, textarea').removeClass('border-red-500 ring-1 ring-red-500');

        let isValid = true;
        let errors = [];

        // Validate NIK
        const nik = $('#nik').val().trim();
        if (!nik) {
            $('#nik-error').text('NIK wajib diisi').removeClass('hidden');
            $('#nik').addClass('border-red-500 ring-1 ring-red-500');
            isValid = false;
        } else if (nik.length !== 16 || !/^\d{16}$/.test(nik)) {
            $('#nik-error').text('NIK harus 16 digit angka').removeClass('hidden');
            $('#nik').addClass('border-red-500 ring-1 ring-red-500');
            isValid = false;
        }

        // Validate Nama
        const nama = $('#nama').val().trim();
        if (!nama) {
            $('#nama-error').text('Nama lengkap wajib diisi').removeClass('hidden');
            $('#nama').addClass('border-red-500 ring-1 ring-red-500');
            isValid = false;
        }

        if (!isValid) {
            return;
        }

        // Show loading
        const btn = $(this);
        const originalText = btn.html();
        btn.prop('disabled', true).html('<span class="flex items-center justify-center gap-3"><svg class="animate-spin h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25 cx-12 cy-12 r-10 stroke-current stroke-width-4"></circle><path class="opacity-75 fill-current" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menyimpan...</span>');

        // Prepare FormData
        const formData = new FormData($('#ktp-form')[0]);
        const url = '{{ route("ktp.store") }}';
        const token = $('meta[name="csrf-token"]').attr('content') || formData.get('_token');

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': token
            },
            success: function(response) {
                // Show success message and redirect
                const successDiv = $('<div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-xl mb-8 shadow-md"></div>').html('KTP berhasil ditambahkan!');
                $('.max-w-4xl.mx-auto > div:first').after(successDiv);
                setTimeout(() => {
                    window.location.href = '{{ route("ktp.showAll") }}';
                }, 1500);
            },
            error: function(xhr) {
                btn.prop('disabled', false).html(originalText);

                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorList = '';

                    $.each(errors, function(field, messages) {
                        const fieldId = '#' + field + '-error';
                        if ($(fieldId).length) {
                            $(fieldId).text(messages[0]).removeClass('hidden');
                            $('#' + field).addClass('border-red-500 ring-1 ring-red-500');
                        }
                        errorList += '<li>' + messages[0] + '</li>';
                    });

                    $('#ajax-error-list').html(errorList);
                    $('#ajax-errors').removeClass('hidden');
                } else {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            }
        });
    });
});
</script>

@include('layouts.foot')
