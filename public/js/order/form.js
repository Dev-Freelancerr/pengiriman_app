$(document).ready(function () {
    $("#save_order").click(function (e) {
        e.preventDefault(); // Menghentikan aksi default dari tombol submit

        // Menampilkan konfirmasi SweetAlert
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin mengirim formulir ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Kirim',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, lanjutkan dengan pengiriman formulir
                $("#createOrder").submit(); // Kirim formulir
            }
        });
    });

    // Menghindari tombol lain yang tidak ingin memicu SweetAlert
    $("button:not(#save_order)").click(function (e) {

    });
});
