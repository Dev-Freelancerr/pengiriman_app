@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @if(Auth::user()->is_completed == 'pending')
            @include('auth.waiting_room')
        @elseif(Auth::user()->is_completed == 'false')
            <div class="container-fluid py-4">
                <div class="row min-vh-80">
                    <div class="col-lg-8 col-md-10 col-12 m-auto">
                        <h3 class="mt-3 mb-0 text-center">Add Personal Info</h3>
                        <p class="lead font-weight-normal opacity-8 mb-7 text-center">This information will let us know
                            more about you.</p>
                        <div class="card">
                            <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <div class="multisteps-form__progress">
                                        <button class="multisteps-form__progress-btn js-active" type="button"
                                                title="Product Info">
                                            <span>1. Personal Info</span>
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Media">2.
                                            Attach ID Card (KTP)
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="multisteps-form__form" action="{{url('store_register')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!--single form panel-->
                                    <div class="multisteps-form__panel pt-3 border-radius-xl bg-white js-active"
                                         data-animation="FadeIn">
                                        <h5 class="font-weight-bolder">Personal Info</h5>
                                        <div class="multisteps-form__content">
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label for="exampleFormControlInput1" class="form-label">Fullname</label>
                                                        <input class="multisteps-form__input form-control" type="text"
                                                               name="fullname" required/>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label for="exampleFormControlInput1" class="form-label">Handphone
                                                            Number</label>
                                                        <input class="multisteps-form__input form-control" type="text"
                                                               name="hp_number"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="mt-4">Address</label>

                                                    <textarea class="form-control" rows="5" spellcheck="false"
                                                              name="address"></textarea>
                                                </div>
                                                <div class="col-sm-6 mt-sm-3 mt-5">
                                                    <label class="form-control ms-0">Gender</label>
                                                    <select class="form-control" name="gender" id="choices-category"
                                                            required>
                                                        <option value="male" selected="">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                        type="button" title="Next">Next
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single form panel-->
                                    <div class="multisteps-form__panel pt-3 border-radius-xl bg-white"
                                         data-animation="FadeIn">
                                        <h5 class="font-weight-bolder">ID Card (KTP)</h5>
                                        <div class="multisteps-form__content">
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <div class="fallback">
                                                        <input name="ktp" type="file" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                        title="Prev">Prev
                                                </button>
                                                <button style="color:white; font-weight:bold;" type="submit"
                                                        class="btn bg-success ms-auto mb-0" type="button" title="Next">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p>asas</p>
        @endif
    </main>

@endsection
