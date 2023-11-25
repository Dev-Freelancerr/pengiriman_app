$(function () {
    $("#form_address_edit").on("submit", function (event) {
        event.preventDefault(); // Mencegah pengiriman formulir asli

        // Simpan referensi this dalam variabel untuk digunakan dalam callback
        var form = $(this);

        // Tampilkan SweetAlert konfirmasi
        Swal.fire({
            title: 'Konfirmasi Update',
            text: 'Apakah Anda yakin ingin menyimpan data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Mengirim formulir dengan AJAX
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function (response) {
                        if (response.error) {
                            // Tampilkan SweetAlert kesalahan jika validasi gagal
                            setTimeout(function () {
                                Swal.fire({
                                    title: 'Kesalahan!',
                                    text: response.error,
                                    icon: 'error'
                                });
                            }, 2000);
                        } else if (response.success) {
                            // Tampilkan SweetAlert sukses jika operasi berhasil

                            Swal.fire({
                                title: 'Sukses!',
                                text: response.success,
                                icon: 'success'
                            }).then(() => {
                                // Arahkan pengguna ke halaman yang sesuai setelah menutup SweetAlert
                                window.location.href = '/settings/address';
                            });
                        }
                    }
                });
            }
        });
    });


    $("#copy_alamat_edit").change(function () {
        if ($(this).is(":checked")) {
            $("#pengembalian").val($("#penjemputan").val()).focus().prop("readonly", true);
            $("#prov_pengembalian").val($("#prov_penjemputan").val()).focus();
            $("#kota_kab_pengembalian").val($("#kota_kab_penjemputan").val()).focus();
            $("#kec_pengembalian").val($("#kec_penjemputan").val()).focus();
        } else {
            $("#pengembalian").val("").prop("readonly", false);
            $("#prov_pengembalian").val("");
            $("#kota_kab_pengembalian").val("");
            $("#kec_pengembalian").val("");
        }
    });


    $("#penjemputan").autocomplete({

        source: function (request, response) {
            $.ajax({
                url: "/ajax/suggest/address",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 3,
        select: function (event, ui) {
            // Menyimpan L1_TIER_CODE dan L2_TIER_CODE dalam variabel terpisah
            var l1TierCode = ui.item.L1_TIER_CODE;
            var l2TierCode = ui.item.L2_TIER_CODE;

            var my_address = ui.item.value;
            var addressParts = my_address.split(', ');
            var provinsi = addressParts[0];
            var kabupaten = addressParts[1];
            var kecamatan = addressParts[2];

            // Mengisi input dengan suggest yang dipilih
            $("#penjemputan").val(my_address);
            $("#prov_penjemputan").val(provinsi).focus();
            $("#kota_kab_penjemputan").val(kabupaten).focus();
            $("#kec_penjemputan").val(kecamatan).focus();

            // Lakukan sesuatu dengan L1_TIER_CODE dan L2_TIER_CODE sesuai kebutuhan Anda
            // Contoh: Tampilkan dalam elemen lain
            $("#l1-tier-code").text(l1TierCode);
            $("#l2-tier-code").text(l2TierCode);

            return false;
        }
    });

    $("#pengembalian").autocomplete({

        source: function (request, response) {
            $.ajax({
                url: "/ajax/suggest/address",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 3,
        select: function (event, ui) {
            // Menyimpan L1_TIER_CODE dan L2_TIER_CODE dalam variabel terpisah
            var l1TierCode = ui.item.L1_TIER_CODE;
            var l2TierCode = ui.item.L2_TIER_CODE;

            var my_address = ui.item.value;
            var addressParts = my_address.split(', ');
            var provinsi = addressParts[0];
            var kabupaten = addressParts[1];
            var kecamatan = addressParts[2];

            // Mengisi input dengan suggest yang dipilih
            $("#pengembalian").val(my_address);
            $("#prov_pengembalian").val(provinsi).focus();
            $("#kota_kab_pengembalian").val(kabupaten).focus();
            $("#kec_pengembalian").val(kecamatan).focus();

            // Lakukan sesuatu dengan L1_TIER_CODE dan L2_TIER_CODE sesuai kebutuhan Anda
            // Contoh: Tampilkan dalam elemen lain
            $("#l1-tier-code").text(l1TierCode);
            $("#l2-tier-code").text(l2TierCode);

            return false;
        }
    });
});
