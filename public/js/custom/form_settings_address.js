$(document).ready(function () {
    $('#deleteButton1, #deleteButton2').on('click', function () {
        const dataId = $(this).data('id');

        // Dapatkan token CSRF dari tag meta di halaman
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda tidak dapat mengembalikan data ini!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna menekan "Yes", kirim permintaan DELETE dengan AJAX
                $.ajax({
                    url: '/settings/address/destroy/' + dataId,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (response) {
                        // Handle the success response here
                        if (response.success) {
                            Swal.fire('Berhasil', 'Data berhasil dihapus', 'success');
                            if (result.isConfirmed) {
                                setTimeout(function () {
                                    window.location.href = '/settings/address';
                                }, 2000);
                            }
                        } else {
                            Swal.fire('Gagal', response.error, 'error');
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle any errors here
                        Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data', 'error');
                        if (result.isConfirmed) {
                            // Redirect ke URL tertentu setelah error
                            setTimeout(function () {
                                window.location.href = '/settings/address';
                            }, 2000);
                        }
                    }
                });
            }
        });
    });
});
