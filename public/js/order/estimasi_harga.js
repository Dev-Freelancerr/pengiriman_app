$(function () {
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
                        console.log('L1_tier_code alamat jemput: ' + data.L1_tier_code);
                        console.log('L2_tier_code alamat jemput: ' + data.L2_tier_code);
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

                        console.log('L1_tier_code alamat kirim: ' + data.L1_tier_code);
                        console.log('L2_tier_code alamat kirim: ' + data.L2_tier_code);

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

    function kirimPermintaanPOST() {
        // Pastikan keduanya sudah memiliki nilai sebelum mengirim permintaan POST
        if (l1_code_alamat_jemput && l2_code_alamat_jemput && l1_code_alamat_kirim && l2_code_alamat_kirim) {

            var payload = {
                weight: 0,
                service_level: "Standard",
                from: {
                    l1_tier_code: l1_code_alamat_jemput,
                    l2_tier_code: l2_code_alamat_jemput
                },
                to: {
                    l1_tier_code: l1_code_alamat_kirim,
                    l2_tier_code: l2_code_alamat_kirim
                }
            };

            $.ajax({

                url: "https://api.ninjavan.co/id/1.0/public/price",
                method: "POST",
                contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: JSON.stringify(payload),
                success: function (response) {
                    // Handle response from the API
                    console.log(response);
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
