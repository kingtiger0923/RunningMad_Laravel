@extends('layouts.app')

@section('content')
    <!--Begin Banner Section-->
    <section class="single-banner clear">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title">
                        <h1>Shop</h1>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Banner Section -->
    <!--Begin Shop Section -->
    <section class="content-section campaign-section shop-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="campaign-content">
                        <ul>
                            @if($products)
                            @foreach($products as $product)
                            <li class="col-sm-4 campaign-wrap">
                                <div class="campaign-item-wrap campaignequalheight">
                                    <div class="thumb-wrap">
                                        <a href="{{url('/shop-single')}}/{{$product->slug}}"><img src="{{URL::to('/')}}/storage/app/public/{{$product->thumbnail}}" alt="{{$product->title}}"></a>
                                    </div>
                                    <div class="campaign-item-content">
                                        <div class="campaign-title">
                                            <h3>
                                                <a href="{{url('shop-single')}}">{{$product->title}}</a>
                                            </h3>
                                            <?php echo  str_limit($product->description, $limit = 100, $end = '...'); ?>
                                        </div>
                                        <div class="campaign-info-wrap">
                                            <ul>
                                                <li>
                                                    <span class="hints">Price:</span>
                                                    <span class="info">£{{$product->price}}</span>
                                                </li>
                                                <!-- <li class="old-price">
                                                    <span class="hints">Old Price:</span>
                                                    <span class="info oldprice">£16</span>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="column">
                                            <a href="{{url('shop-single')}}" class="info-btn btnslideL">More info</a>
                                        </div>
                                        <div class="column">
                                            <!-- <a href="#" class="cart-btn btnslideL">Add to cart</a> -->
                                            <a class="shopaddtocart cart-btn btnslideL" id="{{$product->id}}" image="{{$product->thumbnail}}" amount="{{$product->price}}" product-title="{{$product->title}}" flag="shop">Add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="btn-wrap-row">
                        <a href="#" class="btn-wrap btnslideL" id="showMoreCampaigns"><span>Show More</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Shop Section -->

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
