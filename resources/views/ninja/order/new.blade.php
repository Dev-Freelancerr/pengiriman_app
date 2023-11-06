@extends('layouts.app2')
@section('content')
    <div class="container">
        <div class="card">
            <div class="form">

                <div class="left-side" style="border-radius: 0px;">
                    <div class="left-heading">
                        <h3>Create new order</h3>
                    </div>
                    <div class="steps-content">
                        <h3>Step <span class="step-number">1</span></h3>
                        <p class="step-number-content active">Enter your pickup information</p>
                        <p class="step-number-content d-none">Get to know better by adding your diploma,certificate and
                            education life.</p>
                        <p class="step-number-content d-none">Help companies get to know you better by telling then
                            about
                            your past experiences.</p>
                        <p class="step-number-content d-none">Add your profile piccture and let companies find youy
                            fast.</p>
                    </div>
                    <ul class="progress-bar">
                        <li class="active">Pickup</li>
                        <li>Orders</li>
                    </ul>
                </div>

                <div class="right-side">
                    <form action="{{url('/ninja/create/order/store')}}" method="POST" id="createOrder">
                        @csrf
                        <div class="main active">
                            <div class="input-text">
                                <div class="input-div">
                                    <label style="font-weight: bold; font-size: small;" for="firstname"
                                           title="Customer's First name">Pilih Tipe Penjemputan</label><br/>
                                    <div class="form-group">
                                        <div class="cc-selector">
                                            <input id="visa" type="radio" name="jadwal_jemput"
                                                   value="penjemputan-terjadwal"/>
                                            <label class="drinkcard-cc visa" for="visa"></label>
                                            <input id="mastercard" type="radio" name="jadwal_jemput"
                                                   value="drop-sendiri"/>
                                            <label class="drinkcard-cc mastercard" for="mastercard">
                                            </label>
                                        </div>
                                    </div>
                                    <label style="font-weight: bold; font-size: small;">Tipe Jadwal : </label> <label
                                        style="font-weight: bold; font-size: small;" id="jadwalLabel"></label><br/>
                                </div>
                            </div>

                            <div class="input-text">
                                <div class="input-div">
                                    <select name="alamat_jemput" id="selectAlamatJemput">
                                        <option>Alamat</option>
                                        @foreach($penjemputan as $data)
                                            <option
                                                value="{{$data->provinsi}}-{{$data->kota}}-{{$data->kecamatan}}-{{$data->id}}">{{$data->nama_toko}}
                                                ({{$data->alamat}})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="text" id="id_alamat_jemput" name="alamat_jemput_id" hidden>

                            <div class="input-text penjemputan_terjadwal">
                                <div class="input-div">
                                    <input class="flatpickr flatpickr-input tanggal" type="text"
                                           placeholder="Select Date.."
                                           readonly="readonly" name="tgl_jemput">
                                </div>

                                <div class="input-div">
                                    <select name="jam_jemput">
                                        <option value="09:00 - 12:00">09:00 - 12:00</option>
                                        <option value="12:00 - 15:00">12:00 - 15:00</option>
                                        <option value="15:00 - 18:00">15:00 - 18:00</option>
                                        <option value="18:00 - 22:00">18:00 - 22:00</option>
                                        <option value="09:00 - 18:00">09:00 - 18:00</option>
                                        <option value="09:00 - 22:00">09:00 - 22:00</option>
                                    </select>
                                </div>
                            </div>

                            <div class="input-text penjemputan_terjadwal">
                                <div class="input-div">
                                    <label style="font-weight: bold; font-size: small;" for="firstname"
                                           title="Customer's First name">Instruksi ke pengemudi (Optional)</label><br/>

                                    <textarea name="instruksi_driver"> </textarea>
                                </div>
                            </div>

                            <div class="input-text penjemputan_terjadwal">

                                <div class="input-div">
                                    <label style="font-weight: bold; font-size: small;" for="firstname"
                                           title="Customer's First name">Pilih kendaraan yang muat dengan semua
                                        parcelmu</label><br/>

                                    <div class="form-group">
                                        <div class="cc-selector-kendaraan">
                                            <input id="motor" type="radio" name="kendaraan_jemput" value="motor"/>
                                            <label class="drinkcard-kendaraan motor" for="motor"></label>
                                            <input id="van" type="radio" name="kendaraan_jemput" value="van"/>
                                            <label class="drinkcard-kendaraan van" for="van"> </label>
                                            <input id="truck" type="radio" name="kendaraan_jemput" value="truck"/>
                                            <label class="drinkcard-kendaraan truck" for="truck"> </label>
                                        </div>
                                    </div>
                                    <label style="font-weight: bold; font-size: small;">Kendaraan : </label> <label
                                        style="font-weight: bold; font-size: small;" id="kendaraanLabel"></label><br/>
                                </div>
                            </div>


                            <div class="buttons">
                                <a class="next_button">Next Step</a>
                            </div>
                        </div>
                        <div class="main">
                            <div class="buttons button_space">
                                <button class="" id="choose_via_keyboard">Input Via Keyboard</button>
                                <button class="" id="choose_via_upload">Upload File</button>
                            </div>

                            <div id="via_keyboard">
                                <div class="input-text">
                                    <div class="input-div">
                                        <input type="text" name="cust_name">
                                        <span>Customer Name</span>
                                    </div>
                                    <div class="input-div">
                                        <input type="text" name="cust_contact">
                                        <span>Customer Contact</span>
                                    </div>
                                </div>

                                <div class="input-text">
                                    <div class="input-div">
                                        <input type="text" name="cust_email">
                                        <span>Customer Email (Optional)</span>
                                    </div>
                                    <div class="input-div">
                                        <select disabled name="layanan">
                                            <option value="standard">Standard</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-text">
                                    <div class="input-div">
                                        <input class="flatpickr flatpickr-input tanggal" type="text"
                                               placeholder="Select Date.."
                                               readonly="readonly" name="tgl_kirim">
                                    </div>
                                    <div class="input-div">
                                        <select name="jam_kirim">
                                            <option value="09:00 - 12:00">09:00 - 12:00</option>
                                            <option value="12:00 - 15:00">12:00 - 15:00</option>
                                            <option value="15:00 - 18:00">15:00 - 18:00</option>
                                            <option value="18:00 - 22:00">18:00 - 22:00</option>
                                            <option value="09:00 - 18:00">09:00 - 18:00</option>
                                            <option value="09:00 - 22:00">09:00 - 22:00</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div>
                                    <div class="input-text">
                                        <div class="input-div">
                                            <input type="text" name="address">
                                            <span>Address</span>
                                        </div>
                                    </div>

                                    <div class="input-text">
                                        <div class="input-div">
                                            <input name="alamat_kirim" type="text" class="form-control"
                                                   autocomplete="false"
                                                   id="alamat_kirim" required>

                                            <span>Provinsi/Kota/Kecamatan</span>
                                        </div>
                                    </div>

                                    <div class="input-text">
                                        <div class="input-div">
                                            <input type="text" name="kelurahan">
                                            <span>Kelurahan</span>
                                        </div>
                                        <div class="input-div">
                                            <input type="text" name="postalcode">
                                            <span>Postal Code</span>
                                        </div>
                                    </div>

                                    <div class="input-text">
                                        <div class="input-div">
                                            <input type="text" name="address2">
                                            <span>Address Line 2</span>
                                        </div>
                                    </div>


                                    <div class="input-text">
                                        <div class="input-div">
                                            <input type="text" name="qty">
                                            <span>Quantity (isi dengan 1 jika jumlah tidak terhitung)</span>
                                        </div>
                                        <div class="input-div">
                                            <input type="number" id="weight" name="berat">
                                            <span>Weight (kg)</span>
                                        </div>
                                    </div>

                                    <div class="input-text">
                                        <div class="input-div">
                                            <input type="text" name="product_name">
                                            <span>Isi Parcel / Nama Produk</span>
                                        </div>
                                    </div>

                                    <div class="input-text">
                                        <div class="input-div">
                                            <input type="text" name="delivery_instruction">
                                            <span>Delivery Instruction</span>
                                        </div>
                                    </div>

                                    <div class="input-text">
                                        <div class="input-div">
                                            <input type="text" name="remark1">
                                            <span>Remark 1</span>
                                        </div>
                                        <div class="input-div">
                                            <input type="text" name="remark2">
                                            <span>Remark 2</span>
                                        </div>
                                    </div>

                                    <div class="input-text">
                                        <div class="input-div">
                                            <select name="tipe_bayar">
                                                <option>COD</option>
                                                <option>Non - COD</option>
                                            </select>
                                        </div>
                                        <div class="input-div">
                                            <input type="text" name="harga">
                                            <span>Nilai</span>
                                        </div>
                                    </div>

                                    <div class="input-text">
                                        <span>Is dangerous good</span>

                                        <div class="input-div">
                                            <select name="barang_berbahaya">
                                                <option value="Y">Yes</option>
                                                <option value="N">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="input-text" id="box_estimasi">
                                        <div class="card custom-card">
                                            <div class="card-body">
                                                <h5 class="card-title">Breakdown Price</h5>
                                                <p class="card-text" id="estimasi_harga_standard"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="buttons button_space">
                                <a class="back_button">Back</a>
                                <button type="submit" id="save_order">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
