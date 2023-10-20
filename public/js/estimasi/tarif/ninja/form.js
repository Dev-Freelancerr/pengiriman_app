$(document).ready(function() {
    $("#result_ninja").hide();
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        var formatted = ribuan.join('.').split('').reverse().join('');
        return 'Rp. ' + formatted;
    }
    $("#estimate-form").on("submit", function(e) {
        e.preventDefault(); // Mencegah pengiriman formulir bawaan

        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                if (response.data && response.data.total_fee) {
                    var totalFee = response.data.total_fee;
                    $("#harga-idr-ninja").text(formatRupiah(totalFee));
                    $("#result_ninja").show();
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                $("#harga-idr-ninja").text("Layanan tidak tersedia untuk alamat penjemputan dan pengiriman yang dipilih");
                $("#result_ninja").show();
            }
        });
    });
});

