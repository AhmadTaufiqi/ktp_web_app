document.addEventListener("DOMContentLoaded", function() {
    function loadKtpData(page = 1, name = '') {
        $('#ktps-container').html('<div class="col-span-full text-center py-12"><i class="fas fa-spinner fa-spin text-2xl text-blue-500 mb-4"></i><p class="text-gray-500">Memuat data...</p></div>');

        const params = {
            page: page
        };
        if (name) params.name = name;

        $.get('/api/ktp', params)
            .done(function(result) {
                if (result.success) {
                    const data = result.data;
                    const pagination = result.pagination;

                    // Update stats
                    $('#total-ktp').text(pagination.total);
                    const maleCount = data.filter(item => item.jenis_kelamin === 'Laki-Laki').length;
                    const femaleCount = data.filter(item => item.jenis_kelamin === 'Perempuan').length;
                    $('#male-count').text(maleCount);
                    $('#female-count').text(femaleCount);

                    // Render cards
                    $('#ktps-container').empty();
                    data.forEach(function(ktp) {
                        const $card = $('#ktp-card-template').clone().removeAttr('id style');
                        $card.find('[data-nik]').text(ktp.nik || '');
                        $card.find('[data-nama]').text(ktp.nama || '');
                        $card.find('[data-alamat]').text(ktp.alamat || '');
                        $card.find('[data-jenis_kelamin]').text(ktp.jenis_kelamin || '');
                        $card.find('[data-pekerjaan]').text(ktp.pekerjaan || '');
                        $('#ktps-container').append($card);
                    });

                    // Update pagination
                    updatePagination(pagination);

                    // Update current page
                    currentPage = page;
                } else {
                    $('#ktps-container').html('<div class="col-span-full text-center py-12 text-gray-500">Tidak ada data ditemukan</div>');
                }
            })
            .fail(function() {
                $('#ktps-container').html('<div class="col-span-full text-center py-12 text-red-500">Gagal memuat data. Silakan coba lagi.</div>');
            });
    }

            function updatePagination(pagination) {
                const info = $('#pagination-info');
                info.html(`Menampilkan <strong>${pagination.from || 0}</strong> - <strong>${pagination.to || 0}</strong> dari <strong>${pagination.total}</strong> data`);

                const nav = $('#pagination-nav');
                let navHtml = '';

                // First page
                navHtml += `<li><a href="#" data-page="1" class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ${pagination.current_page == 1 ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' : ''}"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a></li>`;

                // Pages around current
                const startPage = Math.max(1, pagination.current_page - 2);
                const endPage = Math.min(pagination.last_page, pagination.current_page + 2);
                for (let i = startPage; i <= endPage; i++) {
                    navHtml += `<li><a href="#" data-page="${i}" class="px-3 py-2 leading-tight ${pagination.current_page == i ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700'} ${i == 1 ? 'rounded-l-md' : ''} ${i == pagination.last_page ? 'rounded-r-md' : ''}">${i}</a></li>`;
                }

                // Last page
                navHtml += `<li><a href="#" data-page="${pagination.last_page}" class="block px-3 py-2 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5"/></svg></a></li>`;

                nav.html(navHtml);

                // Pagination click handlers
                $('#pagination-nav a').off('click').on('click', function(e) {
                    e.preventDefault();
                    const page = $(this).data('page');
                    loadKtpData(page, $('#search-input').val());
                });
            }

            // Search form handler
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                const name = $('#search-input').val().trim();
                loadKtpData(1, name);
            });

// Search input handler to toggle clear button
            $('#search-input').on('input', function() {
                const value = $(this).val().trim();
                $('#clear-search').toggle(value.length > 0);
            });

            // Clear search
            $(document).on('click', '#clear-search', function(e) {
                e.preventDefault();
                $('#search-input').val('');
                $('#clear-search').hide();
                loadKtpData(1, '');
            });

// Initial load
            loadKtpData(1, '');
        });

        // Import functionality
        let currentImportId = null;

        $('#import-btn').on('click', function() {
            $('#import-modal').removeClass('hidden');
        });

        $('#cancel-import').on('click', function() {
            $('#import-modal').addClass('hidden');
            $('#csv-file').val('');
            $('#file-preview').addClass('hidden');
            $('#confirm-import').prop('disabled', true);
        });

        $('#csv-file').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                $('#file-name').text(file.name);
                $('#file-size').text((file.size / 1024 / 1024).toFixed(2) + ' MB');
                $('#file-preview').removeClass('hidden');
                $('#confirm-import').prop('disabled', false);
            }
        });

        $('#confirm-import').on('click', function() {
            const formData = new FormData();
            formData.append('csv_file', $('#csv-file')[0].files[0]);

            $.ajax({
                url: '/api/ktp/import',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.success) {
                        currentImportId = result.import_id;
                        $('#import-modal').addClass('hidden');
                        $('#progress-modal').removeClass('hidden');
                        $('#progress-filename').text($('#csv-file')[0].files[0].name);
                        pollProgress();
                    }
                },
                error: function() {
                    alert('Gagal upload file');
                }
            });
        });

        function pollProgress() {
            if (!currentImportId) return;

            $.get(`/api/ktp/import/${currentImportId}/progress`)
                .done(function(data) {
                    $('#progress-bar').css('width', data.progress + '%');
                    $('#progress-percent').text(Math.round(data.progress) + '%');
                    $('#progress-status').text(data.done ? 'Selesai!' : `Memproses... ${Math.round(data.progress)}%`);

                    if (data.done) {
                        setTimeout(() => {
                            $('#progress-modal').addClass('hidden');
                            if (data.result) {
                                alert(`Import selesai: ${data.result.imported} baris berhasil${data.result.errors.length ? `, ${data.result.errors.length} error` : ''}`);
                            }
                            loadKtpData(1, $('#search-input').val() || '');
                            currentImportId = null;
                        }, 1500);
                    } else {
                        setTimeout(pollProgress, 500);
                    }
                })
                .fail(function() {
                    $('#progress-status').text('Error memeriksa progress');
                });
        }
        // Close modals on backdrop click
        $(document).on('click', function(e) {
            if ($(e.target).hasClass('fixed')) {
                $('#import-modal, #progress-modal').addClass('hidden');
            }
        });
        

