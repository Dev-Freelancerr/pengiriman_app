$(function() {
    if (document.getElementById('choices-layanan')) {
        var language = document.getElementById('choices-layanan');
        const example = new Choices(language);
    }
    // Inisialisasi autocomplete
    $("#pengiriman, #penjemputan").autocomplete({
        source: function(request, response) {
            // Buat permintaan AJAX ke server untuk mencari hasil saran
            $.ajax({
                url: "/ajax/suggest/address", // Ganti dengan URL Anda
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    // Hasil saran akan ditampilkan dalam dropdown
                    response(data);
                }
            });
        },
        minLength: 3 // Jumlah karakter yang harus dimasukkan sebelum autocomplete mulai bekerja
    });
});
