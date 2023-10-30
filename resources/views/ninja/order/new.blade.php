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
                        <li>Review</li>

                    </ul>
                </div>
                <div class="right-side">
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
                                        <input id="mastercard" type="radio" name="jadwal_jemput" value="drop-sendiri"/>
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
                                <select>
                                    <option>Alamat</option>
                                    @foreach($penjemputan as $data)
                                        <option>{{$data->nama_toko}} ({{$data->alamat}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="input-text penjemputan_terjadwal">
                            <div class="input-div">
                                <input class="flatpickr flatpickr-input tanggal" type="text" placeholder="Select Date.."
                                       readonly="readonly">
                            </div>

                            <div class="input-div">
                                <input class="flatpickr flatpickr-input jam" type="text" placeholder="Select Time.."
                                       readonly="readonly">
                            </div>
                        </div>

                      <div class="input-text penjemputan_terjadwal">

                            <div class="input-div">
                                <label style="font-weight: bold; font-size: small;" for="firstname"
                                       title="Customer's First name">Pilih kendaraan yang muat dengan semua parcelmu</label><br/>

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
                            <button class="next_button">Next Step</button>
                        </div>
                    </div>
                    <div class="main">

                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" required require>
                                <span>School Name</span>
                            </div>
                            <div class="input-div">
                                <input type="text" required>
                                <span>Board Name</span>
                            </div>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" required require>
                                <span>College/University name</span>
                            </div>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <select>
                                    <option>Select Course</option>
                                    <option>BCA</option>
                                    <option>B-TECH</option>
                                    <option>BA</option>
                                    <option>B-COM</option>
                                    <option>B-SC</option>
                                    <option>MBA</option>
                                    <option>MCA</option>
                                    <option>M-COM</option>
                                    <option>M-TECH</option>
                                </select>
                            </div>
                        </div>
                        <div class="buttons button_space">
                            <button class="back_button">Back</button>
                            <button class="next_button">Next Step</button>
                        </div>
                    </div>
                    <div class="main">
                        <small><i class="fa fa-smile-o"></i></small>
                        <div class="text">
                            <h2>Work Experiences</h2>
                            <p>Can you talk about your past work experience?</p>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" required require>
                                <span>Experience 1</span>
                            </div>
                            <div class="input-div">
                                <input type="text" required require>
                                <span>Position</span>
                            </div>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" required>
                                <span>Experience 2</span>
                            </div>
                            <div class="input-div">
                                <input type="text" required>
                                <span>Position</span>
                            </div>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" required>
                                <span>Experience 3</span>
                            </div>
                            <div class="input-div">
                                <input type="text" required>
                                <span>Position</span>
                            </div>
                        </div>
                        <div class="buttons button_space">
                            <button class="back_button">Back</button>
                            <button class="next_button">Next Step</button>
                        </div>
                    </div>


                    <div class="main">
                        <small><i class="fa fa-smile-o"></i></small>
                        <div class="text">
                            <h2>User Photo</h2>
                            <p>Upload your profile picture and share yourself.</p>
                        </div>
                        <div class="user_card">
                            <span></span>

                            <div class="social">
                                <span><i class="fa fa-share-alt"></i></span>
                                <span><i class="fa fa-heart"></i></span>

                            </div>
                            <div class="user_name">
                                <h3>Peter Hawkins</h3>
                                <div class="detail">
                                    <p><a href="#">Izmar,Turkey</a>Hiring</p>
                                    <p>17 last day . 94Apply</p>
                                </div>
                            </div>
                        </div>
                        <div class="buttons button_space">
                            <button class="back_button">Back</button>
                            <button class="submit_button">Submit</button>
                        </div>
                    </div>
                    <div class="main">
                        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                            <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                            <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                        </svg>

                        <div class="text congrats">
                            <h2>Congratulations!</h2>
                            <p>Thanks Mr./Mrs. <span class="shown_name"></span> your information have been submitted
                                successfully for the future reference we will contact you soon.</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection