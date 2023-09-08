@extends('client.index')
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">Checkout</h1>
                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li class="active">checkout</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="page-wrapper">
        <div class="checkout shopping">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="block billing-details">
                            <h4 class="widget-title">Billing Details</h4>
                            <form class="checkout-form">
                                <div class="checkout-country-code clearfix">
                                    <div class="form-group">
                                        <label for="full_name">Full Name</label>
                                        <input type="text" class="form-control" id="full_name" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="user_phone">Number phone</label>
                                        <input type="number" class="form-control" id="user_phone" placeholder="">
                                    </div>
                                </div>
                                <div class="checkout-country-code clearfix">
                                    <div class="form-group" >
                                        <label for="user_city">City</label>
                                        <select class="form-control" id="user_city" name="city" onchange="changeCity()">
                                            <option></option>
                                            @foreach($data['city'] as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="district">District</label>
                                        <select class="form-control" id="district" name="district" value=""></select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="user_address">Address</label>
                                    <input type="text" class="form-control" id="user_address" placeholder="">
                                </div>
                            </form>
                        </div>
{{--                        <div class="block">--}}
{{--                            <h4 class="widget-title">Payment Method</h4>--}}
{{--                            <p>Credit Cart Details (Secure payment)</p>--}}
{{--                            <div class="checkout-product-details">--}}
{{--                                <div class="payment">--}}
{{--                                    <div class="card-details">--}}
{{--                                        <form  class="checkout-form">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="card-number">Card Number <span class="required">*</span></label>--}}
{{--                                                <input  id="card-number" class="form-control"   type="tel" placeholder="•••• •••• •••• ••••">--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group half-width padding-right">--}}
{{--                                                <label for="card-expiry">Expiry (MM/YY) <span class="required">*</span></label>--}}
{{--                                                <input id="card-expiry" class="form-control" type="tel" placeholder="MM / YY">--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group half-width padding-left">--}}
{{--                                                <label for="card-cvc">Card Code <span class="required">*</span></label>--}}
{{--                                                <input id="card-cvc" class="form-control"  type="tel" maxlength="4" placeholder="CVC" >--}}
{{--                                            </div>--}}
{{--                                            <a href="confirmation.html" class="btn btn-main mt-20">Place Order</a >--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="col-md-4">
                        <div class="product-checkout-details">
                            <div class="block">
                                <h4 class="widget-title">Order Summary</h4>
                                @foreach($data['cart'] as $value)
                                    @php
                                        $price = (!empty($value['price_sale'])) ? $value['price_sale'] : $value['price'];
                                        $images = explode(',', $value['image']);
                                    @endphp
                                    <div class="media product-card">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="{{ asset('assets/uploads/product/'. $images[0])}}" alt="Image" />
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="detail-product/{{$value['id']}}">{{$value['name']}}</a></h4>
                                            <p class="price">{{$value['quantity']}} x {{number_format($price)}}</p>
                                            <span class="remove" >Size: {{$value['size']}}</span>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="discount-code">
                                    <p>Have a discount ? <a data-toggle="modal" data-target="#coupon-modal" href="#!">enter it here</a></p>
                                </div>
                                <ul class="summary-prices">
                                    <li>
                                        <span>Subtotal:</span>
                                        <span class="price">{{$data['total_price']}}</span>
                                    </li>
                                    <li>
                                        <span>Shipping:</span>
                                        <span>Free</span>
                                    </li>
                                </ul>
                                <div class="summary-total">
                                    <span>Total</span>
                                    <span>{{$data['total_price']}}</span>
                                </div>
                                <div class="verified-icon">
                                    <img src="">
                                </div>
                                <a id="place-order" href="#" class="btn btn-main mt-20">Place Order</a >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="coupon-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Coupon Code">
                        </div>
                        <button type="submit" class="btn btn-main">Apply Coupon</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script src="{{ asset('assets/client/js/constant.js?v='.time()) }}"></script>
        <script src="{{ asset('assets/client/js/client-bill.js?v='.time()) }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endsection
@endsection
