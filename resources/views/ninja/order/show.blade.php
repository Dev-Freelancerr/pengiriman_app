@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="card mb-4">
          <div class="card-header p-3 pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <div class="w-50">
                <h6>Order Details</h6>
                <p class="text-sm">
                  Order no. <b>241342</b>
                </p>
                <p class="text-sm">
                  Tracking No. <b>{{$order->tracking_number}}</b>
                </p>
                <p class="text-sm">
                    Pickup Status <span class="badge badge-sm bg-gradient-success">Delivered</span>
                </p>
                <p class="text-sm">
                    Order Status <span class="badge badge-sm bg-gradient-success">Delivered</span>
                </p>
              </div>
            </div>
          </div>
          <div class="card-body p-3 pt-0">
            <hr class="horizontal dark mt-0 mb-4">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-12">
                <div class="d-flex">
                  <div>
                    <img src="{{asset('img/product-12.jpg')}}" class="avatar avatar-xxl me-3" alt="product image">
                  </div>
                  <div>
                    <h6 class="text-lg mb-0 mt-2">{{$order->item_description}}</h6>
                    <p class="text-sm mb-3">{{$order->pickup_approximate_volume}}</p>
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                          <div class="d-flex flex-column">

                            <span class="mb-2 text-xs">Quantity: <span class="text-dark font-weight-bold ms-2">{{$order->quantity == null ? "-" : $order->quantity}}</span></span>
                            <span class="mb-2 text-xs">Size: <span class="text-dark ms-2 font-weight-bold">{{$order->size == null ? "-" : $order->size}}</span></span>
                            <span class="text-xs">Berat: <span class="text-dark ms-2 font-weight-bold">{{$order->weight."kg"}}</span></span>
                            <span class="mb-2 text-xs">Tinggi: <span class="text-dark ms-2 font-weight-bold">{{$order->tinggi == null ? "-" : $order->tinggi."cm"}}</span></span>
                            <span class="mb-2 text-xs">Panjang: <span class="text-dark ms-2 font-weight-bold">{{$order->panjang == null ? "-" : $order->panjang."cm"}}</span></span>
                            <span class="mb-2 text-xs">Lebar: <span class="text-dark ms-2 font-weight-bold">{{$order->lebar == null ? "-" : $order->lebar."cm"}}</span></span>
                          </div>
                        </li>
                      </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12 my-auto text-end">
                <a href="javascript:;" class="btn bg-gradient-dark btn-sm mb-0">Contact Us</a>
                <p class="text-sm mt-2 mb-0">Do you like the product? Leave us a review <a href="javascript:;">here</a>.</p>
              </div>
            </div>
            <hr class="horizontal dark mt-4 mb-4">
            <div class="row">
              <div class="col-lg-3 col-md-6 col-12">
                <h6 class="mb-3">Track order</h6>
                <div class="timeline timeline-one-side">
                  <div class="timeline-block mb-3">
                    <span class="timeline-step">
                      <i class="material-icons text-secondary text-lg">notifications</i>
                    </span>
                    <div class="timeline-content">
                      <h6 class="text-dark text-sm font-weight-bold mb-0">Order received</h6>
                      <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">22 DEC 7:20 AM</p>
                    </div>
                  </div>
                  <div class="timeline-block mb-3">
                    <span class="timeline-step">
                      <i class="material-icons text-secondary text-lg">code</i>
                    </span>
                    <div class="timeline-content">
                      <h6 class="text-dark text-sm font-weight-bold mb-0">Generate order id #1832412</h6>
                      <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">22 DEC 7:21 AM</p>
                    </div>
                  </div>
                  <div class="timeline-block mb-3">
                    <span class="timeline-step">
                      <i class="material-icons text-secondary text-lg">shopping_cart</i>
                    </span>
                    <div class="timeline-content">
                      <h6 class="text-dark text-sm font-weight-bold mb-0">Order transmited to courier</h6>
                      <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">22 DEC 8:10 AM</p>
                    </div>
                  </div>
                  <div class="timeline-block mb-3">
                    <span class="timeline-step">
                      <i class="material-icons text-success text-gradient text-lg">done</i>
                    </span>
                    <div class="timeline-content">
                      <h6 class="text-dark text-sm font-weight-bold mb-0">Order delivered</h6>
                      <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">22 DEC 4:54 PM</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-6 col-12">
                <h6 class="mb-3">Payment details</h6>
                <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                  <img class="w-10 me-3 mb-0" src="../../../assets/img/logos/mastercard.png" alt="logo">
                  <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;7852</h6>
                  <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="We do not store card details">
                    <i class="material-icons text-sm" aria-hidden="true">priority_high</i>
                  </button>
                </div>
                <h6 class="mb-3 mt-4">Billing Information</h6>
                <ul class="list-group">
                  <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                      <h6 class="mb-3 text-sm">Oliver Liam</h6>
                      <span class="mb-2 text-xs">Company Name: <span class="text-dark font-weight-bold ms-2">Viking Burrito</span></span>
                      <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-2 font-weight-bold">oliver@burrito.com</span></span>
                      <span class="text-xs">VAT Number: <span class="text-dark ms-2 font-weight-bold">FRB1235476</span></span>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="col-lg-3 col-12 ms-auto">
                <h6 class="mb-3">Order Summary</h6>
                <div class="d-flex justify-content-between">
                  <span class="mb-2 text-sm">
                    Product Price:
                  </span>
                  <span class="text-dark font-weight-bold ms-2">$90</span>
                </div>
                <div class="d-flex justify-content-between">
                  <span class="mb-2 text-sm">
                    Delivery:
                  </span>
                  <span class="text-dark ms-2 font-weight-bold">$14</span>
                </div>
                <div class="d-flex justify-content-between">
                  <span class="text-sm">
                    Taxes:
                  </span>
                  <span class="text-dark ms-2 font-weight-bold">$1.95</span>
                </div>
                <div class="d-flex justify-content-between mt-4">
                  <span class="mb-2 text-lg">
                    Total:
                  </span>
                  <span class="text-dark text-lg ms-2 font-weight-bold">$105.95</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer py-4  ">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="copyright text-center text-sm text-muted text-lg-start">
              © <script>
                document.write(new Date().getFullYear())
              </script>,
              made with <i class="fa fa-heart"></i> by
              <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
              for a better web.
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>

@endsection
