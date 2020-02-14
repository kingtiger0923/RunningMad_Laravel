@extends('layouts.app')

@section('content')
<!--Begin Banner Section-->
<section class="single-banner clear" style="background-image: url({{URL::to('/')}}/storage/app/public/{{$race->image}});">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h1>{{$race->title}}</h1>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Banner Section -->
<!--Begin Race Single Section -->
<section class="content-section race-single-section">
    <!--Begin Race Single Gellary Section -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="popup-gallery-wrap">
                    <ul>
                        @if(isset($race->gallery))
                        @foreach(json_decode($race->gallery) as $image)
                        <li>
                            <div class="gallery-item">
                                <a href="{{URL::to('/')}}/storage/app/public/{{$image}}" class="popupimage">
                                    <img src="{{URL::to('/')}}/storage/app/public/{{$image}}" alt="{{$race->title}}">
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
    </div><!--// End Race Single Gellary Section -->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 left-column">
                <div class="white-content">
                    <div class="race-single-content">
                        <!-- <div class="single-featured-img"> 
                            <img src="{{URL::to('/')}}/storage/app/public/{{$race->image}}" alt="">
                        </div> -->
                        <?php echo $race->description; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 right-column">
                <div class="campaign-content">

                    <!-- Total raised for each campaign -->
                    @php $race_raised_total = 0 ; @endphp
                    @php $coupon = array(); @endphp
                    @if($race->orders)
                        @foreach($race->orders as $value)
                            @php $race_raised_total += $value->amount; @endphp
                        @endforeach
                    @endif
                    <!-- Percentage of total raised for each campaign -->
                   <!--  @php 
                    $race_percentage_raised = ($race_raised_total/1000)*100;
                    @endphp -->
                    <ul>
                        <li>
                            <div class="campaign-item-wrap">
                                <div class="campaign-item-content">
                                    <div class="campaign-title">
                                        <h3>
                                            {{$race->title}}
                                        </h3>
                                    </div>
                                    <div class="campaign-info-wrap">
                                        <ul>
                                            <li>
                                                <span class="hints">Entry cost:</span>
                                                <span class="info">£ {{$race->entry_cost}}</span>
                                            </li>
                                            <!-- <li>
                                                <span class="hints">Race:</span>
                                                <span class="info"> {{$race->race}}</span>
                                            </li> -->
                                            <li>
                                                <span class="hints">Distance:</span>
                                                <span class="info"> {{$race->distance}}</span>
                                            </li>
                                            <li>
                                                <span class="hints">Charity:</span>
                                                <span class="info"> {{$race->charity}}</span>
                                            </li>
                                            <li>
                                                <span class="hints">Donating:</span>
                                                <span class="info">{{$race->supporting}}</span>
                                            </li>
                                            <!-- Qty-->
                                            <li class="race-quantity">
                                                <span class="hints">Quantity:</span>
                                                <span class="info"><input type="number" name="" min="1" step="1" value="1" class="inputBx qty"></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="progress-bar-wrap">
                                        <div class="progress-bar">
                                            <div data-size="{{($race->bought/$race->total_medals)*100}}" class="progress"></div>
                                        </div>
                                        <div class="campaign-duration">
                                            <!-- <span class="campaign-spaces">{{$race->bought}}/{{$race->total_medals}} Spaces booked</span> -->
                                            @if($race->bought <= $race->total_medals)
                                           <!--  <span class="campaign-spaces">{{$race->total_medals-$race->bought }} Entry Spaces Left</span> -->
                                           <span class="campaign-spaces">{{$race->total_medals }} Entry Spaces Left</span>
                                            @else 
                                            <span class="campaign-spaces">0 Entry Spaces Left</span>
                                            @endif
                                        
                                            @php 
                                            $daysleft = 0;
                                            if($race->days_left && $race->days_left > date('Y-m-d')){
                                            $daysleft_obj = date_diff(date_create(date('Y-m-d')), date_create($race->days_left));
                                            $daysleft = $daysleft_obj->days;
                                            }
                                            @endphp
                                            @if($daysleft>0)
                                            @if($daysleft == 1)
                                            <span class="left-days">{{$daysleft}} Day left</span>
                                            @else
                                            <span class="left-days">{{$daysleft}} Days left</span>
                                            @endif
                                            @else 
                                            <span class="left-days">0 Days left</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @foreach ($race->coupons as $key => $value)
                                   @php array_push($coupon,$value->id); @endphp
                                @endforeach
                                <div class="bottom-content">
                                    <div class="column">
                                        <a class="addtocart cart-btn btnslideL" id="{{$race->id}}" image="{{$race->image}}" amount="{{$race->entry_cost}}" race-title="{{$race->title}}" coupon="<?php echo implode(",",array_unique($coupon)); ?>" contribution ="0"  flag="race" charity="{{$race->charity}}">Add to cart
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
</section><!--// End Race Single Section -->
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
