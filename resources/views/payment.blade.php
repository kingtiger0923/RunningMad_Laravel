@extends('layouts.app')

@section('content')

<!--Begin Banner Section-->
<section class="single-banner clear" style="background: url({{URL::to('/')}}/storage/app/public/{{setting('general.banner_img')}}) no-repeat center 0; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h1>Checkout</h1>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Banner Section -->


<?php 
    $total_contribution = 0;
    $total_coupon = 0;  
    foreach(Cart::content() as $row){
        if($row->options->contribution)
            $total_contribution += $row->options->contribution;
        if($row->options->coupon)
            $total_coupon += $row->options->coupon;
} ?>
<!--Begin Checkout Cart Section -->
<section class="content-section checkout-payment-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="back-btn-wrap">
                    <a href="{{url('/checkout')}}"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>
            <div class="col-sm-8 left-column">
               <!--  <form method="POST" action="#" id="chkprocess" name="chkprocess"> -->
                    <div class="checkout-payment-content">
                        <ul class="checkout-steps-custom">
                            <li class="active">
                                <span>Personal details</span>
                            </li>
                            <li class="active">
                                <span>Payment setup</span>
                            </li>
                        </ul>
                         
                        <div class="checkout-white-content">
                            <div class="inner-content">
                                <div class="custom-row">
                                    <div class="col-sm-6">
                                        <!-- <label>Card Holder Name</label> -->
                                        <input id="cardholder-name" class="inputBx" type="text" placeholder="Card Holder Name">
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <!-- placeholder for Elements -->
                                <div class="custom-row">
                                    <div class="col-sm-12">
                                        <div id="card-element"></div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                        <div class="checkout-white-content order-now-wrap">
                            <div class="inner-content">
                                <div class="custom-row">
                                    <div class="col-sm-12">
                                        <span class="big-txt">Your payment card will be charged a total of <span class="bold-txt">£{{number_format((float)(Cart::subtotal()+$total_contribution)-$total_coupon, 2, '.', '')}}</span></span>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="btn-wrap-row">
                                        <button id="card-button" class="btn-wrap btnslideL" data-secret="{{$client_secret}}">
                                            <span>Submit Payment</span>
                                            <dfn class="loading-img payment-loading-img"></dfn>
                                        </button>
                                        </div>
                                    </div>
                                    <div class="checkout-process-result" style="color:red"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </form> -->
            </div>
            <div class="col-sm-4 right-column">
                <div class="cart-content">
                    @php foreach(Cart::content() as $row) : @endphp
                    <div class="custom-row checkout-cart-content payment-page-cart">
                        <div class="payment-page-item-wrap">
                            <?php if($row->options->has('image')) { ?>
                            <div class="col-sm-3 column thumb-column">
                                <div class="thumb-wrap">
                                   <img src="{{URL::to('/')}}/storage/app/public/<?php echo ($row->options->has('image') ? $row->options->image : ''); ?>" alt="@php echo $row->name; @endphp">
                                </div>
                            </div>
                            <?php } ?>
                            <div class="col-sm-5 column item-column">
                                <div class="campaign-title">
                                    <h3>@php echo $row->name; @endphp</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 column amount-column">
                            <!-- <span class="remove-item" rowid="{{ $row->rowId }}"><i class="fas fa-times"></i> Remove</span> -->
                            <div class="amount-wrap">
                                <div class="amount-qty-wrap">
                                    <span class="qty">{{$row->qty}} x</span>
                                    <span>£@php echo number_format((float)$row->price, 2, '.', ''); @endphp</span>
                                    <span class="discount-amount">Discount <span>-£{{number_format((float)$row->options->coupon, 2, '.', '')}}</span></span>
                                    <span class="voluntary-ammount">Voluntary <span>£{{number_format((float)$row->options->contribution, 2, '.', '')}}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php endforeach; @endphp
                    <div class="removed-loading-wrap remove-loading-img">
                        <span class="loading-img"></span>
                    </div>
                    <div class="order-amount-wrap">
                        <div class="cart-total-row">
                            <div class="cart-total-wrap">
                                <div class="custom-row">
                                    <div class="column1">£{{Cart::subtotal()}}</div>
                                    <div class="column2">Subtotal</div>
                                </div>
                                <div class="custom-row">
                                    <div class="column1 promocolor-txt">-£{{number_format((float)$total_coupon, 2, '.', '')}}</div>
                                    <div class="column2">Promo discount</div>
                                </div>
                                <div class="custom-row">
                                    <div class="column1">£{{number_format((float)$total_contribution, 2, '.', '')}}</div>
                                    <div class="column2">Voluntary contribution</div>
                                </div>
                                <div class="custom-row order-total-amount">
                                    <div class="column1">
                                        <div class="total-amount">
                                            <span class="total-amount-txt">
                                            £{{number_format((float)(Cart::subtotal()+$total_contribution)-$total_coupon, 2, '.', '')}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="column2">Total <span class="total-items-txt">({{Cart::count()}} @if(Cart::count() > 1) items @else item @endif)</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Checkout Cart Section -->
<!--Begin Total Fundraised Container -->
<section class="content-section total-fundraised-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-title">
                    <!-- <h2>Charity fundraising total fundraised</h2> -->
                    <h2>Total Raised & Donated To Worthy Charities Causes So Far</h2>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="info-block clear">
                    <div class="description">
                        <div class="total-fundraised-amount">
                            <h2>£{{setting('general.total_raised')}}</h2>
                        </div>
                        <div class="total-pence-txt-wrap">
                            <h3>and {{setting('general.pence')}} pence.</h3>
                        </div>
                    </div>
                    <div class="right-content">
                        <a href="{{url('about')}}">
                            Click here to find out where donations have been sent.
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Total Fundraised  Container -->

@endsection
