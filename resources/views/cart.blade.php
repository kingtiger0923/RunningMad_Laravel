@extends('layouts.app')


@section('content')
<!--Begin Banner Section-->
<section class="single-banner small-banner clear" style="background: url({{URL::to('/')}}/storage/app/public/{{setting('general.banner_img')}}) no-repeat center 0; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h1>Cart</h1>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Banner Section -->
<!--Begin Cart Section -->
<section class="content-section cart-content-section cart-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="cart-content">
                    @php foreach(Cart::content() as $row) : @endphp
                    <div class="custom-row cart-content-row">
                        <div class="column thumb-title-wrap cart-page-contribution-wrap">
                            <div class="cart-page-contribution">
                                <?php if($row->options->has('image')) { ?>
                                <div class="col-sm-3 column thumb-column">
                                    <div class="thumb-wrap">
                                       <img src="{{URL::to('/')}}/storage/app/public/<?php echo ($row->options->has('image') ? $row->options->image : ''); ?>" alt="">
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-sm-5 column item-column">
                                    <div class="campaign-title">
                                        <h3>@php echo $row->name; @endphp</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="contribution-empty-space"></div>
                            <!-- Contribution -->
                             <div class="contribution-wrap">  
                                <div class="contribution-content">
                                    <form>
                                    <input type="text" name="" class="contribution{{$row->id}} inputBx" value="" placeholder="Voluntary contribution">
                                    <button class="contributionbtn submit-btn btnslideL" contribution="{{$row->options->contribution}}" id="{{$row->id}}" image="<?php echo ($row->options->has('image') ? $row->options->image : ''); ?>"  crowid="{{ $row->rowId }}">Submit</button>
                                    </form>
                                </div>
                            </div>
                            <!-- Old Coupon or Promo code -->
                            <?php // if($row->options->coupon){ ?>
                            <!-- <div class="coupon-container">
                                <div class="coupon-wrap">
                                    <input type="text" name="coupon" class="coupon{{$row->id}} inputBx" value="" placeholder="Promo code" required>
                                    <button class="couponbtn submit-btn btnslideL" coupon="{{$row->options->coupon}}" id="{{$row->id}}" crowid="{{ $row->rowId }}">Apply</button>
                                </div>
                            </div>  --> 
                            <?php // } ?>

                        </div>
                        <!-- Qty-->
                        <div class="col-sm-2 column qty-column">
                            <div class="qty-wrap">
                                <div class="qty-content">
                                    <span class="hints">Qty:</span>
                                    <span class="qty-input"><input type="number" name="{{ $row->rowId }}" min="1" step="1" value="@php echo $row->qty; @endphp" class="inputBx  @php echo $row->rowId; @endphp"></span>
                                </div>
                                <div class="qty-update-btn">
                                    <div class="submit-btn btnslideL update-item" rowid="{{ $row->rowId }}">update</div>
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-4 column amount-column">
                            <span class="remove-item"  rowid="{{ $row->rowId }}"><i class="fas fa-times"></i> Remove</span>
                            <div class="amount-wrap">
                                <div class="amount-qty-wrap">
                                    <span class="{{ $row->rowId }}"> £@php echo number_format((float)$row->price*$row->qty, 2, '.', '');  @endphp</span>
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
                    <?php 
                    $total_contribution =0; 
                    $total_coupon = 0;
                    foreach(Cart::content() as $row){
                        if($row->options->contribution)
                            $total_contribution += $row->options->contribution;
                        if($row->options->coupon)
                            $total_coupon += $row->options->coupon;
                    } ?>

                    <div class="contribution-result-wrap">
                        <span class="contribution-result"></span>
                    </div>
                    <!-- Coupon or Promo code -->
                    <?php  if(Cart::count()>0){ ?>
                    <div class="coupon-container"> 
                        <!-- <span>Please enter your promo code</span> -->
                        <div class="coupon-wrap">
                            <form>
                            <input type="text" name="coupon" class="coupon inputBx" value="" placeholder="Promo code" required>
                            <button class="couponbtn submit-btn btnslideL" coupon="" id="" crowid="">Apply</button>
                            </form>
                        </div>
                        <div class="coupon-result-wrap">
                            <span class="coupon-result"></span>
                        </div>
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
                                            <span class="total-amount-txt">£{{number_format((float)(Cart::subtotal()+$total_contribution)-$total_coupon, 2, '.', '')}}</span>
                                        </div>
                                    </div>
                                    <div class="column2">Total <span class="total-items-txt">({{Cart::count()}} @if(Cart::count() > 1) items @else item @endif)</span></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-wrap-row">
                        <a href="{{url('/checkout')}}" class="btn-wrap btnslideL"><span>Checkout</span></a>
                        <!-- <button type="submit" class="btn-wrap btnslideL"><span>Checkout</span></button> -->
                    </div> 
                <?php  } else { ?>
                <div class="cart-empty-wrap">Cart is empty</div>
                 <?php  }  ?>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Cart Section -->
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
