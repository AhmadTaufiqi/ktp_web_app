document.addEventListener("DOMContentLoaded", function() {
    function loadKtpData(page = 1, name = '') {
        const $loading = $('<div class="col-span-full text-center py-12"><i class="fas fa-spinner fa-spin text-2xl text-blue-500 mb-4"></i><p class="text-gray-500">Memuat data...</p></div>');
        
        if (isTableView()) {
            $('#ktps-table').removeClass('hidden').prepend($loading);
        } else {
            $('#ktps-cards').html($loading);
        }

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

                    // Clear loading
                    $loading.remove();

                    // Render based on view
                    if (isTableView()) {
                        renderTable(data);
                    } else {
                        renderCards(data);
                    }

                    // Update pagination
                    updatePagination(pagination);
                } else {
                    if (isTableView()) {
                        $('#ktps-tbody').html('<tr><td colspan="6" class="px-6 py-12 text-center text-gray-500">Tidak ada data ditemukan</td></tr>');
                    } else {
                        $('#ktps-cards').html('<div class="col-span-full text-center py-12 text-gray-500">Tidak ada data ditemukan</div>');
                    }
                }
            })
            .fail(function() {
                if (isTableView()) {
                    $('#ktps-tbody').html('<tr><td colspan="6" class="px-6 py-12 text-center text-red-500">Gagal memuat data. Silakan coba lagi.</td></tr>');
                } else {
                    $('#ktps-cards').html('<div class="col-span-full text-center py-12 text-red-500">Gagal memuat data. Silakan coba lagi.</div>');
                }
            });
    }

    function renderCards(data) {
        $('#ktps-cards').empty();
        data.forEach(function(ktp) {
            const $card = $('#ktp-card-template').clone().removeAttr('id style');
            $card.find('[data-nik]').text(ktp.nik || '');
            $card.find('[data-nama]').text(ktp.nama || '');
            $card.find('[data-alamat]').text(ktp.alamat || '');
            $card.find('[data-jenis_kelamin]').text(ktp.jenis_kelamin || '');
            $card.find('[data-pekerjaan]').text(ktp.pekerjaan || '');
            
            // Handle foto
            const fotoContainer = $card.find('.foto-container');
            if (ktp.foto) {
                const fotoUrl = `/storage/${ktp.foto}`;
                fotoContainer.html(`<img src="${fotoUrl}" alt="Foto KTP" class="w-full h-full object-cover rounded border-2 border-gray-300">`);
            } else {
                fotoContainer.html(`
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                `);
            }
            
            $('#ktps-cards').append($card);
        });
    }

    function renderTable(data) {
        let tableHtml = '';
        data.forEach(function(ktp) {
            const fotoHtml = ktp.foto ? 
                `<img src="/storage/${ktp.foto}" alt="Foto" class="w-12 h-16 object-cover rounded">` :
                '<i class="fas fa-user text-gray-400 text-xl"></i>';
            tableHtml += `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${fotoHtml}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono">${ktp.nik || ''}</td>
                    <td class="px-6 py-4 text-sm font-medium">${ktp.nama || ''}</td>
                    <td class="px-6 py-4 text-sm">${ktp.alamat || ''}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">${ktp.jenis_kelamin || ''}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">${ktp.pekerjaan || ''}</td>
                </tr>
            `;
        });
        $('#ktps-tbody').html(tableHtml);
    }

    function isTableView() {
        return localStorage.getItem('ktpViewMode') === 'table';
    }

    function setTableView(value) {
        localStorage.setItem('ktpViewMode', value ? 'table' : 'cards');
        $('#ktps-table').toggleClass('hidden', !value);
        $('#ktps-cards').toggleClass('hidden', value);
        $('#view-table-btn').toggleClass('bg-blue-500 text-white', value);
        $('#view-card-btn').toggleClass('bg-blue-500 text-white', !value);
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

            // View toggle handlers
            $(document).on('click', '#view-card-btn', function() {
                setTableView(false);
                loadKtpData($('#pagination-nav a.active')?.data('page') || 1, $('#search-input').val());
            });

            $(document).on('click', '#view-table-btn', function() {
                setTableView(true);
                loadKtpData($('#pagination-nav a.active')?.data('page') || 1, $('#search-input').val());
            });

// Export filtered data CSV
            $(document).on('click', '#export-filtered-csv', function(e) {
                e.preventDefault();
                const nameFilter = $('#search-input').val().trim();
                const url = new URL(window.location.origin + '/ktp/export');
                if (nameFilter) {
                    url.searchParams.append('name', nameFilter);
                }
                window.location.href = url.toString();
            });

            // Export filtered data PDF
            $(document).on('click', '#export-filtered-pdf', function(e) {
                e.preventDefault();
                const nameFilter = $('#search-input').val().trim();
                const url = new URL(window.location.origin + '/ktp/export-pdf');
                if (nameFilter) {
                    url.searchParams.append('name', nameFilter);
                }
                window.location.href = url.toString();
            });

// Initial load with view mode
            const initialViewTable = isTableView();
            setTableView(initialViewTable);
            loadKtpData(1, $('#search-input').val() || ''); // Preserve search on load
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

                    if (data.done || data.progress >= 100) {
                        setTimeout(() => {
                            $('#progress-modal').addClass('hidden');
                            if (data.result) {
                                alert(`Import selesai: ${data.result.imported || 0} baris berhasil${data.result?.errors?.length ? `, ${data.result.errors.length} error` : ''}`);
                            } else {
                                alert('Import selesai!');
                            }
                            loadKtpData(1, $('#search-input').val() || '');
                            currentImportId = null;
                        }, 1000);
                    } else {
                        setTimeout(pollProgress, 300);
                    }
                })
                .fail(function() {
                    console.error('Progress poll failed:', arguments);
                    $('#progress-status').text('Error - coba refresh');
                    setTimeout(pollProgress, 1000);
                });
        }
        // Close modals on backdrop click
        $(document).on('click', function(e) {
            if ($(e.target).hasClass('fixed')) {
                $('#import-modal, #progress-modal').addClass('hidden');
            }
        });
        

