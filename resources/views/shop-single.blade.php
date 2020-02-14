@extends('layouts.app')

@section('content')
<!--Begin Banner Section-->
<section class="single-banner clear" style="background-image: url({{URL::to('/')}}/storage/app/public/{{$product->thumbnail}});">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h1>{{$product->title}}</h1>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Banner Section -->
<!--Begin Shop Single Section -->
<section class="content-section race-single-section shop-single-section">
    <!--Begin Shop Single Gellary Section -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="popup-gallery-wrap">
                    <ul>
                        @if(isset($product->gallery))
                        @foreach(json_decode($product->gallery) as $image)
                        <li>
                            <div class="gallery-item">
                                <a href="{{URL::to('/')}}/storage/app/public/{{$image}}" class="popupimage">
                                    <img src="{{URL::to('/')}}/storage/app/public/{{$image}}" alt="{{$product->title}}">
                                    <div class="gallery-icon zoom-icon">
                                        <span class="gallery-icon-inner"><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                                    </div>
                                </a>
                            </div>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div><!--// End Shop Single Gellary Section -->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 left-column">
                <div class="white-content">
                    <div class="race-single-content">
                         {{$product->description}}
                    </div>
                </div>
            </div>
            <div class="col-sm-4 right-column">
                <div class="campaign-content">
                    <ul>
                        <li>
                            <div class="campaign-item-wrap">
                                <div class="campaign-item-content">
                                    <div class="campaign-title">
                                        <h3>
                                            {{$product->title}}
                                        </h3>
                                    </div>
                                    <div class="campaign-info-wrap">
                                        <ul>
                                            <li>
                                                <span class="hints">Price:</span>
                                                <span class="info">£{{$product->price}}</span>
                                            </li>
                                            <li>
                                                <span class="hints">In stock:</span>
                                                <span class="info">{{$product->in_stock}}</span>
                                            </li>
                                            <li class="shop-quantity">
                                                <span class="hints">Quantity:</span>
                                                <span class="info"><input type="number" name="" min="1" step="1" value="1" class="inputBx"></span>
                                            </li>
                                            <li class="product-option-wrap">
                                                <span class="hints">Size:</span>
                                                <span class="info productOption">
                                                    <div class="selectBx styled-dropdown">
                                                        <select>
                                                            @if($product->sizes)
                                                            @foreach($product->sizes as $row)
                                                            <option value="{{$row->value}}">{{$row->title}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        <div class="dropdown-styler"><div></div></div>
                                                    </div>
                                                </span>
                                            </li>
                                            <li class="product-option-wrap">
                                                <span class="hints">Color:</span>
                                                <span class="info productOption">
                                                    <div class="selectBx styled-dropdown">
                                                        <select>
                                                            @if($product->colors)
                                                            @foreach($product->colors as $row)
                                                            <option value="{{$row->value}}">{{$row->title}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        <div class="dropdown-styler"><div></div></div>
                                                    </div>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bottom-content">
                                    <div class="column">
                                        <!-- <a href="#" class="cart-btn btnslideL">Add to cart</a> -->
                                        <a class="shopaddtocart cart-btn btnslideL" id="{{$product->id}}" image="{{$product->thumbnail}}" amount="{{$product->price}}" product-title="{{$product->title}}" flag="shop">Add to cart
                                            </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Shop Single Section -->
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
