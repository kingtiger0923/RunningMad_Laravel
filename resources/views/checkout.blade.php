@extends('layouts.app')

@php 
$countries = array('United Kingdom' =>'United Kingdom' ,'Afganistan' =>'Afganistan','Albania' =>'Albania','Algeria' =>'Algeria','American Samoa' =>'American Samoa','Andorra' =>'Andorra','Angola' =>'Angola' ,'Anguilla' =>'Anguilla','Antigua & Barbuda' =>'Antigua & Barbuda','Argentina' =>'Argentina','Armenia' =>'Armenia','Aruba' =>'Aruba','Australia' =>'Australia','Austria' =>'Austria' ,'Azerbaijan' =>'Azerbaijan','Bahamas' =>'Bahamas','Bahrain' =>'Bahrain','Bangladesh' =>'Bangladesh','Barbados' =>'Barbados','Belarus' =>'Belarus','Belgium' =>'Belgium','Belize' =>'Belize' ,'Benin' =>'Benin','Bermuda' =>'Bermuda','Bhutan' =>'Bhutan','Bolivia' =>'Bolivia','Bonaire' =>'Bonaire','Bosnia & Herzegovina' =>'Bosnia & Herzegovina','Botswana' =>'Botswana','Brazil' =>'Brazil' ,'British Indian Ocean Ter' =>'British Indian Ocean Ter','Brunei' =>'Brunei','Bulgaria' =>'Bulgaria','Burkina Faso' =>'Burkina Faso','Burundi' =>'Burundi','Cambodia' =>'Cambodia','Cameroon' =>'Cameroon' ,'Canada' =>'Canada','Canary Islands' =>'Canary Islands','Cape Verde' =>'Cape Verde','Cayman Islands' =>'Cayman Islands','Central African Republic' =>'Central African Republic','Chad' =>'Chad' ,'Channel Islands' =>'Channel Islands','Chile' =>'Chile','China' =>'China','Christmas Island' =>'Christmas Island','Cocos Island' =>'Cocos Island','Colombia' =>'Colombia','Comoros' =>'Comoros','Congo' =>'Congo' ,'Cook Islands' =>'Cook Islands','Costa Rica' =>'Costa Rica','Croatia' =>'Croatia','Cuba' =>'Cuba','Curacao' =>'Curacao','Cyprus' =>'Cyprus','Czech Republic' =>'Czech Republic' ,'Denmark' =>'Denmark','Djibouti' =>'Djibouti','Dominica' =>'Dominica','Dominican Republic' =>'Dominican Republic','East Timor' =>'East Timor','Ecuador' =>'Ecuador','Egypt' =>'Egypt','El Salvador' =>'El Salvador' ,'Equatorial Guinea' =>'Equatorial Guinea','Eritrea' =>'Eritrea','Estonia' =>'Estonia','Ethiopia' =>'Ethiopia','Falkland Islands' =>'Falkland Islands','Faroe Islands' =>'Faroe Islands','Fiji' =>'Fiji' ,'Finland' =>'Finland','France' =>'France','French Guiana' =>'French Guiana','French Polynesia' =>'French Polynesia','French Southern Ter' =>'French Southern Ter','Gabon' =>'Gabon','Gambia' =>'Gambia','Georgia' =>'Georgia' ,'Germany' =>'Germany','Ghana' =>'Ghana','Gibraltar' =>'Gibraltar','Great Britain' =>'Great Britain','Greece' =>'Greece','Greenland' =>'Greenland','Grenada' =>'Grenada','Guadeloupe' =>'Guadeloupe','Guam' =>'Guam' ,'Guatemala' =>'Guatemala','Guinea' =>'Guinea','Guyana' =>'Guyana','Haiti' =>'Haiti','Hawaii' =>'Hawaii','Honduras' =>'Honduras','Hong Kong' =>'Hong Kong','Hungary' =>'Hungary','Iceland' =>'Iceland','India' =>'India' ,'Indonesia' =>'Indonesia','Iran' =>'Iran','Iraq' =>'Iraq','Ireland' =>'Ireland','Isle of Man' =>'Isle of Man','Israel' =>'Israel','Italy' =>'Italy','Jamaica' =>'Jamaica','Japan' =>'Japan','Jordan' =>'Jordan' ,'Kazakhstan' =>'Kazakhstan','Kenya' =>'Kenya','Kiribati' =>'Kiribati','Korea North' =>'Korea North','Korea South' =>'Korea South','Kuwait' =>'Kuwait','Kyrgyzstan' =>'Kyrgyzstan','Laos' =>'Laos','Latvia' =>'Latvia' ,'Lebanon' =>'Lebanon','Lesotho' =>'Lesotho','Liberia' =>'Liberia','Libya' =>'Libya','Liechtenstein' =>'Liechtenstein','Lithuania' =>'Lithuania','Luxembourg' =>'Luxembourg','Macau' =>'Macau','Macedonia' =>'Macedonia' ,'Madagascar' =>'Madagascar','Malaysia' =>'Malaysia','Malawi' =>'Malawi','Maldives' =>'Maldives','Mali' =>'Mali','Malta' =>'Malta','Marshall Islands' =>'Marshall Islands','Martinique' =>'Martinique','Mauritania' =>'Mauritania' ,'Mauritius' =>'Mauritius','Mayotte' =>'Mayotte','Mexico' =>'Mexico','Midway Islands' =>'Midway Islands','Moldova' =>'Moldova','Monaco' =>'Monaco','Mongolia' =>'Mongolia','Montserrat' =>'Montserrat','Morocco' =>'Morocco' ,'Mozambique' =>'Mozambique','Myanmar' =>'Myanmar','Nambia' =>'Nambia','Nauru' =>'Nauru','Nepal' =>'Nepal','Netherland Antilles' =>'Netherland Antilles','Netherland' =>'Netherlands (Holland, Europe)','Nevis' =>'Nevis' ,'New Caledonia' =>'New Caledonia','New Zealand' =>'New Zealand','Nicaragua' =>'Nicaragua','Niger' =>'Niger','Nigeria' =>'Nigeria','Niue' =>'Niue','Norfolk Island' =>'Norfolk Island','Norway' =>'Norway','Oman' =>'Oman' ,'Pakistan' =>'Pakistan','Palau Island' =>'Palau Island','Palestine' =>'Palestine','Panama' =>'Panama','Papua New Guinea' =>'Papua New Guinea','Paraguay' =>'Paraguay','Peru' =>'Peru','Philippines' =>'Philippines' ,'Pitcairn Island' =>'Pitcairn Island','Poland' =>'Poland','Portugal' =>'Portugal','Puerto Rico' =>'Puerto Rico','Qatar' =>'Qatar','Republic of Montenegro' =>'Republic of Montenegro','Republic of Serbia' =>'Republic of Serbia' ,'Reunion' =>'Reunion','Romania' =>'Romania','Russia' =>'Russia','Rwanda' =>'Rwanda','St Barthelemy' =>'St Barthelemy','St Eustatius' =>'St Eustatius','St Helena' =>'St Helena','St Kitts-Nevis' =>'St Kitts-Nevis' ,'St Lucia' =>'St Lucia','St Maarten' =>'St Maarten','St Pierre & Miquelon' =>'St Pierre & Miquelon','St Vincent & Grenadines' =>'St Vincent & Grenadines','Saipan' =>'Saipan','Samoa' =>'Samoa' ,'Samoa American' =>'Samoa American','San Marino' =>'San Marino','Sao Tome & Principe' =>'Sao Tome & Principe','Saudi Arabia' =>'Saudi Arabia','Senegal' =>'Senegal','Serbia' =>'Serbia','Seychelles' =>'Seychelles' ,'Sierra Leone' =>'Sierra Leone','Singapore' =>'Singapore','Slovakia' =>'Slovakia','Slovenia' =>'Slovenia','Solomon Islands' =>'Solomon Islands','Somalia' =>'Somalia','South Africa' =>'South Africa','Spain' =>'Spain' ,'Sri Lanka' =>'Sri Lanka','Sudan' =>'Sudan','Suriname' =>'Suriname','Swaziland' =>'Swaziland','Sweden' =>'Sweden','Switzerland' =>'Switzerland','Syria' =>'Syria','Tahiti' =>'Tahiti','Taiwan' =>'Taiwan' ,'Tajikistan' =>'Tajikistan','Tanzania' =>'Tanzania','Thailand' =>'Thailand','Togo' =>'Togo','Tokelau' =>'Tokelau','Tonga' =>'Tonga','Trinidad & Tobago' =>'Trinidad & Tobago','Tunisia' =>'Tunisia','Turkey' =>'Turkey' ,'Turkmenistan' =>'Turkmenistan','Turks & Caicos Is' =>'Turks & Caicos Is','Tuvalu' =>'Tuvalu','Uganda' =>'Uganda','Ukraine' =>'Ukraine','United Arab Emirates' =>'United Arab Emirates','United States of America' =>'United States of America' ,'Uruguay' =>'Uruguay','Uzbekistan' =>'Uzbekistan','Vanuatu' =>'Vanuatu','Vatican City State' =>'Vatican City State','Venezuela' =>'Venezuela','Vietnam' =>'Vietnam','irgin Islands (Brit)' =>'irgin Islands (Brit)','Virgin Islands (USA)' =>'Virgin Islands (USA)' ,'Wake Island' =>'Wake Island','Wallis & Futana Is' =>'Wallis & Futana Is','Yemen' =>'Yemen','Zaire' =>'Zaire','Zambia' =>'Zambia','Zimbabwe' =>'Zimbabwe');
@endphp

@section('content')

<link rel="stylesheet" type="text/css" href="https://api.addressnow.co.uk/css/addressnow-2.20.min.css?key=nn43-tk88-pr87-jd69" />
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
<!--Begin Checkout Cart Section -->
<section class="content-section checkout-payment-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 left-column">
                <form method="POST" action="{{action('RaceController@pd_process')}}" class="">
                   {{csrf_field()}}
                    <div class="checkout-payment-content">
                        <ul class="checkout-steps-custom">
                            <li class="active">
                                <span>Personal details</span>
                            </li>
                            <li>
                                <span>Payment details</span>
                            </li>
                        </ul>
                        @if (Auth::guest())
                        <div class="existing-account-txt">
                            <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="custom-row error-message">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        <div class="up-print-error-msg paypal-error-message" id="payPalErrorMessage">
                            <ul></ul>
                        </div>
                        <div class="checkout-white-content">
                            <div class="inner-content">
                                <div class="col-sm-12">
                                    <div class="title-row">
                                        <h2>Customer Details</h2>
                                    </div>
                                </div>
                                @if (Auth::guest())
                                <div class="custom-row">
                                    <div class="col-sm-6">
                                        <label>First Name</label>
                                        <input type="text" class="inputBx" value="" placeholder="" name="firstname" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Last Name</label>
                                        <input type="text" class="inputBx" value="" placeholder="" name="lastname" required>
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-sm-6">
                                        <label>E-mail</label>
                                        <input type="text" class="inputBx" value="" placeholder="" name="email" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Mobile Number</label>
                                        <input type="text" class="inputBx" value="" placeholder="" name="phone">
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-sm-6">
                                        <label>Password</label>
                                        <input type="password" class="inputBx" value="" placeholder="" name="password" required>
                                    </div>
                                     <div class="col-sm-6">
                                        <label>Confirm Password</label>
                                        <input id="password-confirm" type="password" class="inputBx" name="password_confirmation" required>
                                    </div>
                                </div>
                                @else
                                @if(isset($billing_address)) 
                                @foreach($billing_address as $key => $value)
                                <div class="custom-row">
                                    <div class="col-sm-6">
                                        <label>Mobile Number</label>
                                        <input type="text" class="inputBx" value="{{$value->phone}}" placeholder="" name="phone">
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                @endif
                                 <input type="hidden" class="inputBx hiddencart" value="@if(Cart::count()>=1) {{Cart::subtotal()}} @endif" placeholder="" name="cart">
                                
                            </div>
                        </div> 
                      
                        <div class="checkout-white-content">
                            <div class="inner-content">
                                <div class="col-sm-12">
                                    <div class="title-row">
                                        <h2>Billing address</h2>
                                    </div>
                                </div>
                               
                                @if(isset($billing_address)) 
                                @foreach($billing_address as $key => $value)
                                <div class="custom-row">
                                    <div class="col-sm-12">
                                        <div class="title-row">
                                            <h2>Your Address</h2>
                                            <input id="autocomplete" autocomplete="off" class="form-control inputBx billing" name="autocomplete" placeholder="Search your address" type="text"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-sm-12">
                                        <label>Street address </label>
                                        <input id="billing_address" type="text" class="inputBx" placeholder="" name="address" value="{{$value->address}}" required>
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-sm-6">
                                        <label>County</label>
                                        <input id="billing_county" type="text" class="inputBx" placeholder="" name="county" value="" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>City</label>
                                        <input id="billing_city" type="text" class="inputBx" placeholder="" name="city" value="{{$value->city}}" required>
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-sm-6">
                                        <label>Post code</label>
                                        <input id="billing_postalcode" type="text" class="inputBx" placeholder="" name="postcode" value="{{$value->postcode}}" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Country</label>
                                        <!-- <input type="text" class="inputBx" value="" placeholder="" name="country"> -->
                                        <div class="selectBx styled-dropdown">
                                            <select name="country" id="billing_countryName">
                                                @if($countries)
                                                @foreach($countries as $country)
                                                <option value="{{$country}}" @php if($country == $value->country) echo "selected"; @endphp>{{$country}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <div class="dropdown-styler"><div></div></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else 
                                <div class="custom-row">
                                    <div class="col-sm-12">
                                        <div class="title-row">
                                            <h2>Your Address</h2>
                                            <input id="autocomplete" autocomplete="off" class="form-control inputBx billing" name="autocomplete" placeholder="Search your address" type="text"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-sm-12">
                                        <label>Delivery address</label>
                                        <input id="billing_address" type="text" class="inputBx" placeholder="" name="address" value="{{$value->address}}" required>
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-sm-6">
                                        <label>County</label>
                                        <input id="billing_county" type="text" class="inputBx" value="" placeholder="" name="county" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>City</label>
                                        <input id="billing_city" type="text" class="inputBx" value="" placeholder="" name="city" required>
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-sm-6">
                                        <label>Post code</label>
                                        <input id="billing_postalcode" type="text" class="inputBx" value="" placeholder="" name="postcode" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Country</label>
                                        <!-- <input type="text" class="inputBx" value="" placeholder="" name="country"> -->
                                        <div class="selectBx styled-dropdown">
                                            <select name="country" id="billing_countryName">
                                                <!-- <option selected disabled></option> -->
                                                @if($countries)
                                                @foreach($countries as $country)
                                                <option value="{{$country}}">{{$country}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <div class="dropdown-styler"><div></div></div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div> 
                       
                        <!-- Delivery address-->
                        <div class="checkout-white-content">
                            <div class="inner-content">
                                <div class="col-sm-12">
                                    <div class="title-row">
                                        <h2>Delivery address</h2>
                                    </div>
                                </div>
                                <div class="delivery-address-wrap">
                                    <div class="custom-row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="checkbx-wrap">
                                                 @if (Auth::guest())
                                                <span class="filter-label-txt">Same as above address</span>
                                                @else
                                                <span class="filter-label-txt">Same as registered address</span>
                                                @endif
                                                <span class="checkbx-btn"><input type="checkbox" name="sameasbilling" id="deliveryBtn" checked></span> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="delivery-address-content">
                                        <div class="custom-row">
                                            <div class="col-sm-12">
                                                <div class="title-row">
                                                    <h2>Your Address</h2>
                                                    <input id="autocomplete" autocomplete="off" class="form-control inputBx delivery" name="autocomplete" placeholder="Search your address" type="text"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-row">
                                            <div class="col-sm-12">
                                                <label>Shipping address</label>
                                                <input id="shipping_address" type="text" class="inputBx" value="" placeholder="" name="shipping_address">
                                            </div>
                                        </div>
                                        <div class="custom-row">
                                            <div class="col-sm-6">
                                                <label>County</label>
                                                <input id="shipping_county" type="text" class="inputBx" value="" placeholder="" name="shipping_county">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>City</label>
                                                <input id="shipping_city" type="text" class="inputBx" value="" placeholder="" name="shipping_city">
                                            </div>
                                        </div>
                                        <div class="custom-row">
                                            <div class="col-sm-6">
                                                <label>Post code</label>
                                                <input id="shipping_postcode" type="text" class="inputBx" value="" placeholder="" name="shipping_postcode">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Country</label>
                                                <div class="selectBx styled-dropdown">
                                                    <select name="shipping_country" id="shipping_country">
                                                        @if($countries)
                                                        @foreach($countries as $country)
                                                        <option value="{{$country}}">{{$country}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="dropdown-styler"><div></div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <!-- // End delivery address html -->

                         <!-- Payment method -->
                        <div class="checkout-white-content">
                            <div class="inner-content">
                                <div class="col-sm-12">
                                    <div class="title-row">
                                        <h2>Choose payment method</h2>
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="payment-method-btn-container">
                                        <div class="col-sm-12">
                                            <div class="payment-method-btn">
                                                <label><input type="radio" class="radio-btn" name="paymentoption" value="stripepay" checked><span>Credit / Debit Card</span></label>
                                            </div>
                                            <div class="payment-method-btn">
                                                <label><input type="radio" class="radio-btn" name="paymentoption" value="paypal"><span>PayPal</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- // End payment method -->
                        <div class="payment-box stripepay">
                            <div class="checkout-white-content order-now-wrap">
                                <div class="inner-content">
                                    <div class="custom-row">
                                        <div class="col-sm-12">
                                            <span class="small-txt big-txt">By submitting this form you agree to our <a href="{{ url('page/terms-conditions') }}"> Terms and Conditions</a> and <a href="{{ url('page/privacy-policy') }}">  Privacy Policy.</a></span> 
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="btn-wrap-row">
                                                <button type="submit" class="btn-wrap btnslideL"><span>Continue</span>
                                                    <dfn class="loading-img check-page-loading-img"></dfn>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="checkout-process-result"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-4 right-column">
                <div class="cart-content">
                    @php foreach(Cart::content() as $row) : @endphp
                    <div class="custom-row checkout-cart-content">
                        <div class="column thumb-title-wrap checkout-page-contribution-wrap">
                            <div class="checkout-page-contribution">
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
                            <!-- Voluntary contribution -->
                            <div class="contribution-wrap">  
                                <div class="contribution-content">
                                    <form>
                                    <input type="text" name="" class="contribution{{$row->id}} inputBx" value="" placeholder="Voluntary contribution">
                                    <button class="contributionbtn submit-btn btnslideL" contribution="{{$row->options->contribution}}" id="{{$row->id}}" image="<?php echo ($row->options->has('image') ? $row->options->image : ''); ?>" crowid="{{ $row->rowId }}">Submit</button>
                                    </form>
                                </div>
                            </div> 
                           
                        </div>
                         <div class="col-sm-4 column amount-column">
                            <span class="remove-item" rowid="{{ $row->rowId }}"><i class="fas fa-times"></i> Remove</span>
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
                    <!-- Promo or Coupon code -->
                    <?php  if(Cart::count()>0){ ?>
                    <div class="coupon-container">
                        <!-- <span>Please enter your promo code</span>   -->
                        <div class="coupon-column1">
                            <div class="coupon-wrap">
                                <form>
                                <input type="text" name="coupon" class="coupon inputBx" value="" placeholder="Promo code" required>
                                <button class="couponbtn submit-btn btnslideL" coupon="" id="" crowid="">Apply</button>
                                </form>
                            </div>
                        </div>
                        <div class="coupon-column2">
                            &nbsp;
                        </div>
                        <div class="coupon-result-wrap">
                            <span class="coupon-result"></span>
                        </div>
                    </div>  
                    <?php //} ?>
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
                    
                <?php  } else { ?>
                <div class="cart-empty-wrap">Cart is empty</div>
                 <?php  }  ?>
                </div>
            </div>
        </div>
        <!-- For paypal payment -->
        <div class="row">
            <div class="col-sm-8 left-column">
                <div class="payment-box paypal">
                    <div class="checkout-white-content order-now-wrap">
                        <div class="inner-content">
                            <div class="custom-row">
                                <div class="col-sm-12">
                                    <span class="small-txt big-txt">By submitting this form you agree to our <a href="{{ url('page/terms-conditions') }}"> Terms and Conditions</a> and <a href="{{ url('page/privacy-policy') }}">  Privacy Policy.</a></span> 
                                </div>
                                <div class="col-sm-12">
                                    <div class="paypal-btn-img">
                                        <!-- <input type="image" src="images/paypalcheckout.png" name="" alt="Make payments with PayPal - it's fast, free and secure!"> -->
                                                <!-- <form  class="" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"> -->
                                        <form  class="" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                                            <input type="hidden" name="cmd" value="_cart">
                                            <input type="hidden" name="upload" value="1">
                                            <input type="hidden" name="business" value="hello@runningmad.co.uk">
                                            <!-- <input type="hidden" name="business" value="mamunur002.play@gmail.com"> -->
                                            <input type="hidden" name="currency_code" value="GBP">
                                            @if(Cart::count() >= 1)
                                            @php $item_count = 1; @endphp
                                            @php foreach(Cart::content() as $row) : 
                                            $price = (($row->price*$row->qty)- $row->options->coupon) + $row->options->contribution;
                                            @endphp

                                            <input type="hidden" name="item_name_{{ $item_count}}" value="{{ $row->name }}">
                                            <input type="hidden" name="amount_{{ $item_count}}" value="{{ number_format((float)$price, 2, '.', '') }}">
                                            @php $item_count++; @endphp
                                            @endforeach
                                            @endif

                                            <input type="hidden" name="cancel_return" value="{{ url('/') }}/payment-cancel">
                                            <input type="hidden" name="return" value="{{ url('/') }}/payment-status">
                                            <input type="image" src="{{ url('/') }}/images/paypalcheckout.png" name="submit" class="pp"  alt="Make payments with PayPal - it's fast, free and secure!">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="col-sm-4 right-column hide-mobile">
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

<script>
    var addressNow_Billing = 0, addressNow_Delivery = 0;

    $(".billing").on('focus', function() { addressNow_Billing = 1; addressNow_Delivery = 0;});
    $(".delivery").on('focus', function() { addressNow_Billing = 0; addressNow_Delivery = 1;});

    document.getElementsByClassName('billing')[0].id = 'autocomplete';
    document.getElementsByClassName('delivery')[0].id = 'autocomplete1';

    jQuery.loadScript = function (url, callback) {
        jQuery.ajax({
            url: url,
            dataType: 'script',
            success: callback,
            async: true
        });
    }

    $.loadScript('https://api.addressnow.co.uk/js/addressnow-2.20.min.js?key=gn51-ap37-ru58-ta87', function(){
        addressNow.listen('load', function(control) {
            control.listen("populate", function(address) {
            });
        });
    });
</script>

<script>
    document.getElementsByClassName('billing')[0].id = 'autocomplete1';
    document.getElementsByClassName('delivery')[0].id = 'autocomplete';

    $.loadScript('https://api.addressnow.co.uk/js/addressnow-2.20.min.js?key=nn43-tk88-pr87-jd69', function(){

        addressNow.listen('load', function(control) {
            control.listen("populate", function(address) {
                if( addressNow_Delivery === 1 ) {
                    document.getElementById('shipping_address').value = '';
                    if( address.Company != '' ) document.getElementById('shipping_address').value += (address.Company);
                    if( address.Line1   != '' && address.Company == '' ) document.getElementById('shipping_address').value += (address.Line1);
                    if( address.Line1   != '' && address.Company != '' ) document.getElementById('shipping_address').value += (' ' + address.Line1);
                    if( address.Line2   != '' ) document.getElementById('shipping_address').value += (' ' + address.Line2);
                    if( address.Line3   != '' ) document.getElementById('shipping_address').value += (' ' + address.Line3);
                    if( address.Line4   != '' ) document.getElementById('shipping_address').value += (' ' + address.Line4);
                    if( address.Line5   != '' ) document.getElementById('shipping_address').value += (' ' + address.Line5);
                    document.getElementById('shipping_county').value = address.ProvinceName;
                    document.getElementById('shipping_postcode').value = address.PostalCode;
                    document.getElementById('shipping_city').value = address.City;
                    var select = document.getElementById('shipping_country');
                    for ( var i = 0, l = select.options.length, o; i < l; i++ )
                    {
                        o = select.options[i];
                        if ( address.CountryName == o.text )
                        {
                            o.selected = true;
                        }
                    }
                    
                } else {
                    document.getElementById('billing_address').value = '';
                    if( address.Company != '' ) document.getElementById('billing_address').value += (address.Company);
                    if( address.Line1   != '' && address.Company == '' ) document.getElementById('billing_address').value += (address.Line1);
                    if( address.Line1   != '' && address.Company != '' ) document.getElementById('billing_address').value += (' ' + address.Line1);
                    if( address.Line2   != '' ) document.getElementById('billing_address').value += (' ' + address.Line2);
                    if( address.Line3   != '' ) document.getElementById('billing_address').value += (' ' + address.Line3);
                    if( address.Line4   != '' ) document.getElementById('billing_address').value += (' ' + address.Line4);
                    if( address.Line5   != '' ) document.getElementById('billing_address').value += (' ' + address.Line5);
                    document.getElementById('billing_county').value = address.ProvinceName;
                    document.getElementById('billing_postalcode').value = address.PostalCode;
                    document.getElementById('billing_city').value = address.City;
                    var select = document.getElementById('billing_countryName');
                    for ( var i = 0, l = select.options.length, o; i < l; i++ )
                    {
                        o = select.options[i];
                        if ( address.CountryName == o.text )
                        {
                            o.selected = true;
                        }
                    }
                }
            });
        });
    });

</script>

@endsection
