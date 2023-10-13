$(document).ready(function () {

    $('button[data-bs-target="#modal-form-edit"]').click(function () {
        var id = $(this).data('id');
        var route = $(this).data('route');

        // Lakukan permintaan Ajax untuk mengambil data berdasarkan ID
        $.ajax({
            url: route,
            method: 'GET',
            success: function (data) {

                $('#nama_penjual').val(data.penjemputan['nama_toko']);
                $('#pic_penjemputan').val(data.penjemputan['nama_pic_penjemputan']);
                $('#alamat_penjemputan').val(data.penjemputan['alamat']);
                $('#telp_pic_penjemputan').val(data.penjemputan['no_telp_pic']);
                $('#provinsi1').val(data.penjemputan['provinsi']);
                $('#kota1').val(data.penjemputan['kota']);
                $('#kec1').val(data.penjemputan['kecamatan']);
                $('#kel1').val(data.penjemputan['kelurahan']);
                $('#pos1').val(data.penjemputan['postal_code']);


                $('#pic_pengembalian').val(data.pengembalian['nama_pic_pengembalian']);
                $('#alamat_pengembalian').val(data.pengembalian['alamat']);
                $('#telp_pic_pengembalian').val(data.pengembalian['no_telp_pic']);

                  $("#pic_pengembalian,#alamat_pengembalian,#telp_pic_pengembalian,#provinsi1,#kota1,#kel1,#kec1,#pos1,#nama_penjual, #pic_penjemputan, #alamat_penjemputan, #telp_pic_penjemputan ").focus();

            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});
