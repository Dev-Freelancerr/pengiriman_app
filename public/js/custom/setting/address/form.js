$(function () {

    $("#copy_alamat").change(function() {
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
