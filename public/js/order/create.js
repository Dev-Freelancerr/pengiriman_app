$(function () {
    $("#alamat_kirim").autocomplete({
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

            // Mengisi input dengan suggest yang dipilih
            $("#alamat_kirim").val(ui.item.value);

            // Lakukan sesuatu dengan L1_TIER_CODE dan L2_TIER_CODE sesuai kebutuhan Anda
            // Contoh: Tampilkan dalam elemen lain
            $("#l1-tier-code").text(l1TierCode);
            $("#l2-tier-code").text(l2TierCode);

            return false;
        }
    });
});
