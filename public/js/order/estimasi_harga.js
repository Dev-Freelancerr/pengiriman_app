$(function () {
    $("#box_estimasi").hide();
    var l1_code_alamat_jemput, l2_code_alamat_jemput, l1_code_alamat_kirim, l2_code_alamat_kirim;

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('#selectAlamatJemput').on('change', function () {
        var selectedValue = $(this).val();
        var splitValues = selectedValue.split('-');

        if (splitValues.length === 3) {
            var provinsi = splitValues[0];
            var kota = splitValues[1];
            var kecamatan = splitValues[2];

            $.ajax({
                url: '/ajax/cari-alamat',
                method: 'GET',
                data: {
                    provinsi: provinsi,
                    kota: kota,
                    kecamatan: kecamatan
                },
                success: function (data) {
                    if (data.error) {
                        console.error(data.error);
                    } else {
                        l1_code_alamat_jemput = data.L1_tier_code;
                        l2_code_alamat_jemput = data.L2_tier_code;
                        if (l1_code_alamat_jemput && l2_code_alamat_jemput) {
                            kirimPermintaanPOST();
                        }
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });

    $('#alamat_kirim').on('change', function () {
        var idAlamatKirim = $('#alamat_kirim').val(); // Ganti dengan cara sesuai kebutuhan Anda

        var splitValuesAlamatKirim = idAlamatKirim.split(',');

        if (splitValuesAlamatKirim.length === 3) {
            var provinsi = splitValuesAlamatKirim[0];
            var kota = splitValuesAlamatKirim[1];
            var kecamatan = splitValuesAlamatKirim[2];

            $.ajax({
                url: '/ajax/cari-alamat',
                method: 'GET',
                data: {
                    provinsi: provinsi,
                    kota: kota,
                    kecamatan: kecamatan
                },
                success: function (data) {
                    if (data.error) {
                        console.error(data.error);
                    } else {
                        l1_code_alamat_kirim = data.L1_tier_code;
                        l2_code_alamat_kirim = data.L2_tier_code;


                        if (l1_code_alamat_kirim && l2_code_alamat_kirim) {
                            kirimPermintaanPOST();
                        }
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });

    $("#weight").on('keyup', function () {
        weight = $(this).val();
        if (weight === "") {
            weight = 0;
        }
        kirimPermintaanPOST(weight);
    });


    function kirimPermintaanPOST(weight = 0) {
        // Pastikan keduanya sudah memiliki nilai sebelum mengirim permintaan POST
        if (l1_code_alamat_jemput && l2_code_alamat_jemput && l1_code_alamat_kirim && l2_code_alamat_kirim) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var url = '/ajax/estimate/rate/shipping/' + l1_code_alamat_jemput + '/' + l2_code_alamat_jemput + '/' + l1_code_alamat_kirim + '/' + l2_code_alamat_kirim + '/' + weight;

            // Mengirim permintaan AJAX ke URL dengan parameter dan token CSRF
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: csrfToken, // Menambahkan token CSRF ke data permintaan
                    // Data lain yang ingin Anda kirim
                },
                success: function (response) {
                    var fee = response.data.total_fee;
                    var formattedFee = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(fee);
                    var message = 'Estimasi Biaya Pengiriman Standard: ' + formattedFee;
                    $("#box_estimasi").show();
                    $('#estimasi_harga_standard').text(message);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });

        } else {
            console.error("Belum ada data alamat jemput dan kirim yang lengkap.");
        }
    }

});
