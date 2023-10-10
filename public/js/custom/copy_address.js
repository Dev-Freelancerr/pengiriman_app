$(document).ready(function () {
    // Sembunyikan div card-pengembalian-copy secara default
    $('.card-pengembalian-copy').hide();

    // Mendeteksi perubahan pada kotak centang dengan ID "fcustomCheck1"
    $('#fcustomCheck1').on('change', function () {
        if ($(this).is(':checked')) {
            // Jika kotak centang dicentang, sembunyikan div card-pengembalian
            $('.card-pengembalian').hide();
            // Tampilkan div card-pengembalian-copy
            $('.card-pengembalian-copy').show();

            // Salin nilai dari elemen input sumber ke elemen input pengembalian
            $('#pengembalian-choices-button-copy').val($('#choices-button :selected').text());
            $('#pengembalian-choices-city-copy').val($('#choices-city :selected').text());
            $('#pengembalian-choices-district-copy').val($('#choices-district :selected').text());
            $('#pengembalian-choices-subdistrict-copy').val($('#choices-subdistrict :selected').text());
            $('#pengembalian-choices-postalcode-copy').val($('#choices-postalcode :selected').text());
        } else {
            // Jika kotak centang tidak dicentang, sembunyikan div card-pengembalian-copy
            $('.card-pengembalian-copy').hide();
            // Tampilkan div card-pengembalian
            $('.card-pengembalian').show();

            // Kosongkan nilai elemen input pengembalian
            $('#pengembalian-choices-button-copy').val('');
            $('#pengembalian-choices-city-copy').val('');
            $('#pengembalian-choices-district-copy').val('');
            $('#pengembalian-choices-subdistrict-copy').val('');
            $('#pengembalian-choices-postalcode-copy').val('');
        }
    });
});
