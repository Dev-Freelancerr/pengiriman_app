document.addEventListener("DOMContentLoaded", function() {
    // Mengambil elemen-elemen yang diperlukan
    var genderSelect = document.getElementById("choices-category");
    var addressInput = document.getElementById("address_regist");
    var hpInput = document.getElementById("hp_regist");
    var fullnameInput = document.getElementById("fullname_regist");
    var nextButton = document.getElementById("next_1");

    // Menyembunyikan tombol "Next" secara default
    nextButton.style.display = "none";

    // Membuat fungsi untuk memeriksa apakah semua input telah diisi
    function checkInputs() {
        if (genderSelect.value && addressInput.value && hpInput.value && fullnameInput.value) {
            nextButton.style.display = "block"; // Menampilkan tombol "Next"
        } else {
            nextButton.style.display = "none"; // Menyembunyikan tombol "Next"
        }
    }

    // Memanggil fungsi checkInputs() ketika terjadi perubahan pada inputan
    genderSelect.addEventListener("change", checkInputs);
    addressInput.addEventListener("input", checkInputs);
    hpInput.addEventListener("input", checkInputs);
    fullnameInput.addEventListener("input", checkInputs);


    //  STEP 2

    var bankSelect = document.getElementById("choices-category");
    var norekInput = document.getElementById("norek");
    var atasnamaInput = document.getElementById("atasnama");
    var nextButton2 = document.getElementById("next_2");

    // Menyembunyikan tombol "Next" secara default
    nextButton2.style.display = "none";

    // Membuat fungsi untuk memeriksa apakah semua input telah diisi
    function checkInputs2() {
        if (bankSelect.value && norekInput.value && atasnamaInput.value) {
            nextButton2.style.display = "block"; // Menampilkan tombol "Next"
        } else {
            nextButton2.style.display = "none"; // Menyembunyikan tombol "Next"
        }
    }

    // Memanggil fungsi checkInputs() ketika terjadi perubahan pada inputan
    bankSelect.addEventListener("change", checkInputs2);
    norekInput.addEventListener("input", checkInputs2);
    atasnamaInput.addEventListener("input", checkInputs2);
  });
