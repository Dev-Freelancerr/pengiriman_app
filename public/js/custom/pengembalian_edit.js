$(document).ready(function () {

    if ($('#choices-button-pengembalian2').length > 0) {
        var element = $('#choices-button-pengembalian2');
        var cityDropdown = $('#choices-city-pengembalian2');
        var districtDropdown = $('#choices-district-pengembalian2');
        var subdistrictDropdown = $('#choices-subdistrict-pengembalian2');
        var postalcodeDropdown = $('#choices-postalcode-pengembalian2');

        // Lakukan permintaan AJAX ke route Laravel untuk mengisi dropdown provinsi menggunakan jQuery
        $.ajax({
            url: '/ajax/address/province',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Loop melalui data dan tambahkan pilihan ke dropdown provinsi
                $.each(data, function (index, province) {
                    var option = $('<option>', {
                        value: province.prov_id,
                        text: province.prov_name
                    });

                    element.append(option);
                });

                // Inisialisasi Choices.js pada elemen dropdown provinsi

                // Tambahkan event listener ke dropdown provinsi untuk menangani perubahan
                element.on('change', function () {
                    var selectedProvinceId = $(this).val();

                    // Lakukan permintaan AJAX ke route Laravel untuk mengisi dropdown kota berdasarkan ID provinsi
                    $.ajax({
                        url: '/ajax/address/city/' + selectedProvinceId,
                        method: 'GET',
                        dataType: 'json',
                        success: function (cityData) {
                            cityDropdown.empty();

                            $.each(cityData, function (index, city) {
                                var option = $('<option>', {
                                    value: city.city_id,
                                    text: city.city_name
                                });

                                cityDropdown.append(option);
                            });

                            // Inisialisasi Choices.js pada elemen dropdown kota

                            // Bersihkan dropdown distrik, subdistrik, dan kode pos ketika kota berubah
                            districtDropdown.empty();
                            subdistrictDropdown.empty();
                            postalcodeDropdown.empty();
                        },
                        error: function (error) {
                            console.error('Error fetching city data:', error);
                        }
                    });
                });
            },
            error: function (error) {
                console.error('Error fetching province data:', error);
            }
        });

        // Tambahkan event listener ke dropdown kota untuk menangani perubahan
        cityDropdown.on('change', function () {
            var selectedCityId = $(this).val();

            // Lakukan permintaan AJAX ke route Laravel untuk mengisi dropdown distrik berdasarkan ID kota
            $.ajax({
                url: '/ajax/address/district/' + selectedCityId,
                method: 'GET',
                dataType: 'json',
                success: function (districtData) {
                    districtDropdown.empty();

                    $.each(districtData, function (index, district) {
                        var option = $('<option>', {
                            value: district.dis_id,
                            text: district.dis_name
                        });

                        districtDropdown.append(option);
                    });

                    // Inisialisasi Choices.js pada elemen dropdown distrik

                    // Bersihkan dropdown subdistrik dan kode pos ketika distrik berubah
                    subdistrictDropdown.empty();
                    postalcodeDropdown.empty();
                },
                error: function (error) {
                    console.error('Error fetching district data:', error);
                }
            });
        });

        // Tambahkan event listener ke dropdown distrik untuk menangani perubahan
        districtDropdown.on('change', function () {
            var selectedDistrictId = $(this).val();

            // Lakukan permintaan AJAX ke route Laravel untuk mengisi dropdown subdistrik berdasarkan ID distrik
            $.ajax({
                url: '/ajax/address/subdistrict/' + selectedDistrictId,
                method: 'GET',
                dataType: 'json',
                success: function (subdistrictData) {
                    subdistrictDropdown.empty();

                    $.each(subdistrictData, function (index, subdistrict) {
                        var option = $('<option>', {
                            value: subdistrict.subdis_id,
                            text: subdistrict.subdis_name
                        });

                        subdistrictDropdown.append(option);
                    });

                    // Inisialisasi Choices.js pada elemen dropdown subdistrik

                    // Bersihkan dropdown kode pos ketika subdistrik berubah
                    postalcodeDropdown.empty();
                },
                error: function (error) {
                    console.error('Error fetching subdistrict data:', error);
                }
            });
        });

        // Tambahkan event listener ke dropdown subdistrik untuk menangani perubahan
        subdistrictDropdown.on('change', function () {
            var selectedSubdistrictId = $(this).val();

            // Lakukan permintaan AJAX ke route Laravel untuk mengisi dropdown kode pos berdasarkan ID subdistrik
            $.ajax({
                url: '/ajax/address/postalcode/' + selectedSubdistrictId,
                method: 'GET',
                dataType: 'json',
                success: function (postalcodeData) {
                    postalcodeDropdown.empty();

                    $.each(postalcodeData, function (index, postalcode) {
                        var option = $('<option>', {
                            value: postalcode.postal_id,
                            text: postalcode.postal_code
                        });

                        postalcodeDropdown.append(option);
                    });

                    // Inisialisasi Choices.js pada elemen dropdown kode pos
                },
                error: function (error) {
                    console.error('Error fetching postal code data:', error);
                }
            });
        });
    }
});
