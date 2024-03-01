<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="/">
            <img src="{{asset('img/logo-ct.png')}}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Pengiriman Dashboard</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
<li class="nav-item">
    <a href="{{ url('ninja/create/order') }}" class="nav-link text-white {{ Request::is('ninja/create/order') ? 'active' : '' }}" aria-controls="pagesExamples" role="button" aria-expanded="false"
       style="{{ Request::is('ninja/create/order') ? 'background-color: #E91E63; color: #fff;' : '' }}">
        <i class="material-icons-round">image</i>
        <span class="nav-link-text ms-2 ps-1">Create Order</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('ninja/order/history') }}" class="nav-link text-white {{ Request::is('ninja/order/history') ? 'active' : '' }}" aria-controls="pagesExamples" role="button" aria-expanded="false"
       style="{{ Request::is('ninja/order/history') ? 'background-color: #E91E63; color: #fff;' : '' }}">
        <i class="material-icons-round">image</i>
        <span class="nav-link-text ms-2 ps-1">Order History</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('ninja/tracking/order') }}" class="nav-link text-white {{ Request::is('ninja/tracking/order') ? 'active' : '' }}" aria-controls="pagesExamples" role="button" aria-expanded="false"
       style="{{ Request::is('ninja/tracking/order') ? 'background-color: #E91E63; color: #fff;' : '' }}">
        <i class="material-icons-round">image</i>
        <span class="nav-link-text ms-2 ps-1">Tracking Order</span>
    </a>
</li>


            <hr class="horizontal light mt-0">

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#settingmenu" class="nav-link active text-white" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                    <i class="material-icons-round opacity-10">dashboard</i>
                    <span class="nav-link-text ms-2 ps-1">Setting</span>
                </a>
                <div class="collapse" id="settingmenu">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link text-white {{ Request::is('settings/address') ? 'active' : '' }}" href="{{ url('settings/address') }}"
                            style="{{ Request::is('settings/address') ? 'background-color: #E91E63; color: #fff;' : '' }}">
                                <span class="sidenav-mini-icon">A</span>
                                <span class="sidenav-normal ms-2 ps-1">My Address</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <hr class="horizontal light mt-0">

            <li class="nav-item mt-3">
                <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder text-white">PAGES</h6>
            </li>
            <li class="nav-item">
                <a href="{{ url('estimate/tarif') }}" class="nav-link text-white {{ Request::is('estimate/tarif') ? 'active' : '' }}"
                aria-controls="pagesExamples" role="button" aria-expanded="false"
                style="{{ Request::is('estimate/tarif') ? 'background-color: #E91E63; color: #fff;' : '' }}">
                    <i class="material-icons-round">image</i>
                    <span class="nav-link-text ms-2 ps-1">Estimasi Tarif</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="material-icons-round">exit_to_app</i>
                    <span class="nav-link-text ms-2 ps-1">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>


        </ul>
    </div>
</aside>
