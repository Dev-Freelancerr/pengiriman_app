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
    $('#alamat_edit').hide();
    $('#edit_alamat').change(function() {
        if (this.checked) {
            // Cekbox diperiksa (checked)
            $('#alamat_current').hide(); // Sembunyikan div alamat_current
            $('#alamat_current input, #alamat_current select').prop('disabled', true); // Nonaktifkan elemen-elemen dalam div
            $('#alamat_edit').show();
        } else {
            // Cekbox tidak diperiksa (unchecked)
            $('#alamat_edit').hide();
            $('#alamat_current').show(); // Tampilkan kembali div alamat_current
            $('#alamat_current input, #alamat_current select').prop('disabled', false); // Aktifkan kembali elemen-elemen dalam div
        }
    });

    $('.card-pengembalian-copy2').hide();

    // Mendeteksi perubahan pada kotak centang dengan ID "fcustomCheck1"
    $('#fcustomCheck2').on('change', function () {
        if ($(this).is(':checked')) {
            // Jika kotak centang dicentang, sembunyikan div card-pengembalian
            $('.card-pengembalian2').hide();
            // Tampilkan div card-pengembalian-copy
            $('.card-pengembalian-copy2').show();

            // Salin nilai dari elemen input sumber ke elemen input pengembalian
            $('#pengembalian-choices-button-copy2').val($('#choices-button2 :selected').text());
            $('#pengembalian-choices-city-copy2').val($('#choices-city2 :selected').text());
            $('#pengembalian-choices-district-copy2').val($('#choices-district2 :selected').text());
            $('#pengembalian-choices-subdistrict-copy2').val($('#choices-subdistrict2 :selected').text());
            $('#pengembalian-choices-postalcode-copy2').val($('#choices-postalcode2 :selected').text());
        } else {
            // Jika kotak centang tidak dicentang, sembunyikan div card-pengembalian-copy
            $('.card-pengembalian-copy2').hide();
            // Tampilkan div card-pengembalian
            $('.card-pengembalian2').show();

            // Kosongkan nilai elemen input pengembalian
            $('#pengembalian-choices-button-copy2').val('');
            $('#pengembalian-choices-city-copy2').val('');
            $('#pengembalian-choices-district-copy2').val('');
            $('#pengembalian-choices-subdistrict-copy2').val('');
            $('#pengembalian-choices-postalcode-copy2').val('');
        }
    });
});
