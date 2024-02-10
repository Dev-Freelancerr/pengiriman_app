$(document).ready(function () {
    $('.delete_data').on('click', function () {
        const id = $(this).data('id');

        // Tampilkan konfirmasi SweetAlert
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Anda yakin ingin menghapus alamat ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Mengarahkan ke URL penghapusan alamat
                const deleteUrl = `/settings/address/destroy/${id}`;
                $.ajax({
                    type: 'DELETE',
                    url: deleteUrl,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function (data) {
                        if (data.success) {
                            // Tampilkan pesan berhasil
                            Swal.fire('Berhasil', data.success, 'success');
                            location.reload();
                            // Tambahkan kode lain yang diperlukan setelah penghapusan berhasil
                        } else if (data.error) {
                            // Tampilkan pesan error
                            Swal.fire('Error', data.error, 'error');
                        }
                    },
                    error: function (error) {
                        // Tangani kesalahan saat permintaan HTTP
                        console.error('Kesalahan:', error);
                    }
                });
            }
        });
    });
});
