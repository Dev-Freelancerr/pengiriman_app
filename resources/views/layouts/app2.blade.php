
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ csrf_token() }}</title>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/core/jquery-ui.min.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="{{asset('css/jquery-ui.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.1/dist/cdn.min.js"></script>

    <style type="text/css">
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap");

        .custom-card {
            background-color: #f0f0f0;
        }
        .custom-card .card-body {
            padding: 20px; /* Menambahkan padding ke dalam card-body */
        }
        .custom-card .card-text {
            margin: 10px 0; /* Menambahkan margin di atas dan di bawah setiap paragraf card-text */
        }

        .cc-selector input {
            margin: 0;
            padding: 0;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .cc-selector-kendaraan input {
            margin: 0;
            padding: 0;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .visa {
            background-image: url("{{ asset("img/penjemputan_terjadwal.png") }}");
        }

        .mastercard {
            background-image: url("{{ asset("img/drop_off.jpg") }}");
        }

        .truck {
            background-image: url("{{ asset("img/truck.jpg") }}");
        }

        .van {
            background-image: url("{{ asset("img/van.png") }}");
        }

        .motor {
            background-image: url("{{ asset("img/motor.jpg") }}");
        }

        .cc-selector input:active + .drinkcard-cc {
            opacity: 0.5;
        }

        .cc-selector input:checked + .drinkcard-cc {
            -webkit-filter: none;
            -moz-filter: none;
            filter: none;
        }

        .cc-selector-kendaraan input:active + .drinkcard-kendaraan {
            opacity: 0.5;
        }

        .cc-selector-kendaraan input:checked + .drinkcard-kendaraan {
            -webkit-filter: none;
            -moz-filter: none;
            filter: none;
        }

        .drinkcard-cc {
            cursor: pointer;
            background-size: contain;
            background-repeat: no-repeat;
            display: inline-block;
            width: 140px;
            height: 100px;
            -webkit-transition: all 100ms ease-in;
            -moz-transition: all 100ms ease-in;
            transition: all 100ms ease-in;
            -webkit-filter: brightness(1.8) grayscale(1) opacity(0.7);
            -moz-filter: brightness(1.8) grayscale(1) opacity(0.7);
            filter: brightness(1.8) grayscale(1) opacity(0.7);
        }

        .drinkcard-cc:hover {
            -webkit-filter: brightness(1.2) grayscale(0.5) opacity(0.9);
            -moz-filter: brightness(1.2) grayscale(0.5) opacity(0.9);
            filter: brightness(1.2) grayscale(0.5) opacity(0.9);
        }

        .drinkcard-kendaraan {
            cursor: pointer;
            background-size: contain;
            background-repeat: no-repeat;
            display: inline-block;
            width: 140px;
            height: 100px;
            -webkit-transition: all 100ms ease-in;
            -moz-transition: all 100ms ease-in;
            transition: all 100ms ease-in;
            -webkit-filter: brightness(1.8) grayscale(1) opacity(0.7);
            -moz-filter: brightness(1.8) grayscale(1) opacity(0.7);
            filter: brightness(1.8) grayscale(1) opacity(0.7);
        }

        .drinkcard-kendaraan:hover {
            -webkit-filter: brightness(1.2) grayscale(0.5) opacity(0.9);
            -moz-filter: brightness(1.2) grayscale(0.5) opacity(0.9);
            filter: brightness(1.2) grayscale(0.5) opacity(0.9);
        }

        /* Extras */
        a:visited {
            color: #888;
        }

        a {
            color: #999;
            text-decoration: none;
        }

        p {
            margin-bottom: 0.3em;
        }

        * {
            padding: 0;
            margin: 0;
        }

        .container .card {
            height: auto;
            width: 900px;
            background-color: #fff;
            position: relative;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            font-family: "Poppins", sans-serif;
            display: flex;
        }

        .container .card .form {
            width: 100%;
            height: 100%;
            display: flex;
        }

        .container .card .left-side {
            width: 35%;
            background-color: #304767;
            height: auto;
            border-top-left-radius: 20px;

            padding: 20px 30px;
            box-sizing: border-box;
        }

        /*left-side-start*/
        .left-heading {
            color: #fff;
        }

        .steps-content {
            margin-top: 30px;
            color: #fff;
        }

        .steps-content p {
            font-size: 12px;
            margin-top: 15px;
        }

        .progress-bar {
            list-style: none;
            /*color:#fff;*/
            margin-top: 30px;
            font-size: 13px;
            font-weight: 700;
            counter-reset: container 0;
        }

        .progress-bar li {
            position: relative;
            margin-left: 40px;
            margin-top: 50px;
            counter-increment: container 1;
            color: #4f6581;
        }

        .progress-bar li::before {
            content: counter(container);
            line-height: 25px;
            text-align: center;
            position: absolute;
            height: 25px;
            width: 25px;
            border: 1px solid #4f6581;
            border-radius: 50%;
            left: -40px;
            top: -5px;
            z-index: 10;
            background-color: #304767;
        }

        .progress-bar li::after {
            content: "";
            position: absolute;
            height: 90px;
            width: 2px;
            background-color: #4f6581;
            z-index: 1;
            left: -27px;
            top: -70px;
        }

        .progress-bar li.active::after {
            background-color: #fff;
        }

        .progress-bar li:first-child:after {
            display: none;
        }

        /*.progress-bar li:last-child:after{*/
        /*  display:none;  */
        /*}*/
        .progress-bar li.active::before {
            color: #fff;
            border: 1px solid #fff;
        }

        .progress-bar li.active {
            color: #fff;
        }

        .d-none {
            display: none;
        }

        /*left-side-end*/
        .container .card .right-side {
            width: 65%;
            background-color: #fff;
            height: 100%;
        }

        /*right-side-start*/
        .main {
            display: none;
        }

        .active {
            display: block;
        }

        .main {
            padding: 40px;
        }

        .main small {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2px;
            height: 30px;
            width: 30px;
            background-color: #ccc;
            border-radius: 50%;
            color: yellow;
            font-size: 19px;
        }

        .text {
            margin-top: 20px;
        }

        .congrats {
            text-align: center;
        }

        .text p {
            margin-top: 10px;
            font-size: 13px;
            font-weight: 700;
            color: #cbced4;
        }

        .input-text {
            margin: 30px 0;
            display: flex;
            gap: 20px;
        }

        .input-text .input-div {
            width: 100%;
            position: relative;
        }

        input[type="text"] {
            width: 100%;
            height: 40px;
            border: none;
            outline: 0;
            border-radius: 5px;
            border: 1px solid #cbced4;
            gap: 20px;
            box-sizing: border-box;
            padding: 0px 10px;
        }

        input[type="number"] {
            width: 100%;
            height: 40px;
            border: none;
            outline: 0;
            border-radius: 5px;
            border: 1px solid #cbced4;
            gap: 20px;
            box-sizing: border-box;
            padding: 0px 10px;
        }

        textarea {
            width: 100%;
            height: 60px;
            border: none;
            outline: 0;
            border-radius: 5px;
            border: 1px solid #cbced4;
            gap: 20px;
            box-sizing: border-box;
            padding: 0px 10px;
        }

        select {
            width: 100%;
            height: 40px;
            border: none;
            outline: 0;
            border-radius: 5px;
            border: 1px solid #cbced4;
            gap: 20px;
            box-sizing: border-box;
            padding: 0px 10px;
        }

        .input-text .input-div span {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 14px;
            transition: all 0.5s;
        }

        .input-div input:focus ~ span,
        .input-div input:valid ~ span {
            top: -15px;
            left: 6px;
            font-size: 10px;
            font-weight: 600;
        }

        .input-div span {
            top: -15px;
            left: 6px;
            font-size: 10px;
        }

        .buttons button {
            height: 40px;
            width: 100px;
            border: none;
            border-radius: 5px;
            background-color: #0075ff;
            font-size: 12px;
            color: #fff;
            cursor: pointer;
        }

        .button_space {
            display: flex;
            gap: 20px;
        }

        .button_space button:nth-child(1) {
            background-color: #fff;
            color: #000;
            border: 1px solid #000;
        }

        .user_card {
            margin-top: 20px;
            margin-bottom: 40px;
            height: 200px;
            width: 100%;
            border: 1px solid #c7d3d9;
            border-radius: 10px;
            display: flex;
            overflow: hidden;
            position: relative;
            box-sizing: border-box;
        }

        .user_card span {
            height: 80px;
            width: 100%;
            background-color: #dfeeff;
        }

        .circle {
            position: absolute;
            top: 40px;
            left: 60px;
        }

        .circle span {
            height: 70px;
            width: 70px;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #fff;
            border-radius: 50%;
        }

        .circle span img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .social {
            display: flex;
            position: absolute;
            top: 100px;
            right: 10px;
        }

        .social span {
            height: 30px;
            width: 30px;
            border-radius: 7px;
            background-color: #fff;
            border: 1px solid #cbd6dc;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 10px;
            color: #cbd6dc;
        }

        .social span i {
            cursor: pointer;
        }

        .heart {
            color: red !important;
        }

        .share {
            color: red !important;
        }

        .user_name {
            position: absolute;
            top: 110px;
            margin: 10px;
            padding: 0 30px;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .user_name h3 {
            color: #4c5b68;
        }

        .detail {
            /*margin-top:10px;*/
            display: flex;
            justify-content: space-between;
            margin-right: 50px;
        }

        .detail p {
            font-size: 12px;
            font-weight: 700;
        }

        .detail p a {
            text-decoration: none;
            color: blue;
        }

        .checkmark__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #7ac142;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #fff;
            stroke-miterlimit: 10;
            margin: 10% auto;
            box-shadow: inset 0px 0px 0px #7ac142;
            animation: fill 0.4s ease-in-out 0.4s forwards,
            scale 0.3s ease-in-out 0.9s both;
        }

        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes scale {
            0%,
            100% {
                transform: none;
            }
            50% {
                transform: scale3d(1.1, 1.1, 1);
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 30px #7ac142;
            }
        }

        .warning {
            border: 1px solid red !important;
        }

        /*right-side-end*/
        @media (max-width: 750px) {
            .container {
                height: scroll;
            }

            .container .card {
                max-width: 350px;
                height: auto !important;
                margin: 30px 0;
            }

            .container .card .right-side {
                width: 100%;
            }

            .input-text {
                display: block;
            }

            .input-text .input-div {
                margin-top: 20px;
            }

            .container .card .left-side {
                display: none;
            }
        }

    </style>
</head>


<body className='snippet-body'>

@yield('content')

<script type='text/javascript'>var next_click = document.querySelectorAll(".next_button");
    var main_form = document.querySelectorAll(".main");
    var step_list = document.querySelectorAll(".progress-bar li");
    var num = document.querySelector(".step-number");
    let formnumber = 0;

    next_click.forEach(function (next_click_form) {
        next_click_form.addEventListener('click', function () {
            if (!validateform()) {
                return false
            }
            formnumber++;
            updateform();
            progress_forward();
            contentchange();
        });
    });

    var back_click = document.querySelectorAll(".back_button");
    back_click.forEach(function (back_click_form) {
        back_click_form.addEventListener('click', function () {
            formnumber--;
            updateform();
            progress_backward();
            contentchange();
        });
    });

    var username = document.querySelector("#user_name");
    var shownname = document.querySelector(".shown_name");


    var submit_click = document.querySelectorAll(".submit_button");
    submit_click.forEach(function (submit_click_form) {
        submit_click_form.addEventListener('click', function () {
            shownname.innerHTML = username.value;
            formnumber++;
            updateform();
        });
    });

    var heart = document.querySelector(".fa-heart");
    heart.addEventListener('click', function () {
        heart.classList.toggle('heart');
    });


    var share = document.querySelector(".fa-share-alt");
    share.addEventListener('click', function () {
        share.classList.toggle('share');
    });


    function updateform() {
        main_form.forEach(function (mainform_number) {
            mainform_number.classList.remove('active');
        })
        main_form[formnumber].classList.add('active');
    }

    function progress_forward() {
        // step_list.forEach(list => {

        //     list.classList.remove('active');

        // });


        num.innerHTML = formnumber + 1;
        step_list[formnumber].classList.add('active');
    }

    function progress_backward() {
        var form_num = formnumber + 1;
        step_list[form_num].classList.remove('active');
        num.innerHTML = form_num;
    }

    var step_num_content = document.querySelectorAll(".step-number-content");

    function contentchange() {
        step_num_content.forEach(function (content) {
            content.classList.remove('active');
            content.classList.add('d-none');
        });
        step_num_content[formnumber].classList.add('active');
    }


    function validateform() {
        validate = true;
        var validate_inputs = document.querySelectorAll(".main.active input");
        validate_inputs.forEach(function (vaildate_input) {
            vaildate_input.classList.remove('warning');
            if (vaildate_input.hasAttribute('require')) {
                if (vaildate_input.value.length == 0) {
                    validate = false;
                    vaildate_input.classList.add('warning');
                }
            }
        });
        return validate;

    }</script>
<script src="{{asset('js/plugins/flatpickr.min.js')}}"></script>
<script type='text/javascript'>
    $(document).ready(function () {
        $('#jadwalLabel').text($('input[name="jadwal_jemput"]:checked').val());


        $('input[name="jadwal_jemput"]').change(function () {
            var selectedValue = $('input[name="jadwal_jemput"]:checked').val();
            if(selectedValue == "drop-sendiri") {
                $('#jadwalLabel').text("Drop sendiri di outlet");
            }else {
                $('#jadwalLabel').text("Penjemputan Terjadwal");
            }
        });

        $('#kendaraanLabel').text($('input[name="kendaraan_jemput"]:checked').val());


        $('input[name="kendaraan_jemput"]').change(function () {
            var selectedValue = $('input[name="kendaraan_jemput"]:checked').val();
            if(selectedValue == "motor") {
                $('#kendaraanLabel').text("Parcel dapat diangkut dengan motor");
            }
            else if(selectedValue == "van") {
                $('#kendaraanLabel').text("Parcel dapat diangkut dengan mobil");
            }
            else {
                $('#kendaraanLabel').text("Parcel dapat diangkut dengan truck");
            }
        });

        $("#via_upload_content").hide();

        // Tambahkan event listener untuk tombol "Input Via Keyboard"
        $("#choose_via_keyboard").click(function() {
            $("#via_keyboard").show(); // Tampilkan konten "Input Via Keyboard"
            $("#via_upload_content").hide();  // Sembunyikan konten "Upload File"
        });

        // Tambahkan event listener untuk tombol "Upload File"
        $("#choose_via_upload").click(function() {
            $("#via_keyboard").hide();  // Sembunyikan konten "Input Via Keyboard"
            $("#via_upload_content").show();   // Tampilkan konten "Upload File"
        });


        $(".tanggal").flatpickr({
            minDate: "today"
        });

        flatpickr(".jam", {
            enableTime: true,       // Aktifkan pilihan waktu
            noCalendar: true,       // Sembunyikan kalender
            minDate: "today",       // Tanggal minimal adalah hari ini
            minTime: "09:00",       // Jam minimal (09:00)
            maxTime: "18:00",       // Jam maksimal (18:00)
            time_24hr: true         // Format waktu 24 jam
        });

        $('#visa, #mastercard').change(function () {
            if ($('input[name="jadwal_jemput"]:checked').val() === "drop-sendiri") {
                $('.penjemputan_terjadwal').hide();
            } else {
                $('.penjemputan_terjadwal').show();
            }
        });

        // Inisialisasi tampilan berdasarkan nilai radio yang dipilih saat halaman dimuat
        if ($('input[name="jadwal_jemput"]:checked').val() === "drop-sendiri") {
            $('.penjemputan_terjadwal').hide();
        }

    });
    var myLink = document.querySelector('a[href="#"]');
    myLink.addEventListener('click', function (e) {
        e.preventDefault();
    });
</script>
<script src="{{asset('js/order/create.js')}}"></script>
<script src="{{asset('js/order/estimasi_harga.js')}}"></script>
</body>
</html>
