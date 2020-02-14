@extends('layouts.app')

@section('content')
<!--Begin Banner Section-->
<section class="single-banner clear" style="background: url({{URL::to('/')}}/storage/app/public/{{setting('general.banner_img')}}) no-repeat center 0; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h1>Races</h1>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Banner Section -->
 <!--Begin Race Section -->
<section class="content-section campaign-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="campaign-content">
                    <ul>
                        @if($races)
                        @foreach($races as $row)
                        @php $coupon = array(); @endphp
                        <!-- Total raised for each campaign -->
                        @php $race_raised_total = 0 ; @endphp
                        @if($row->orders)
                            @foreach($row->orders as $value)
                                @php $race_raised_total += $value->amount; @endphp
                            @endforeach
                        @endif
                        <!-- Percentage of total raised for each campaign -->
                       <!--  @php 
                        $race_percentage_raised = ($race_raised_total/1000)*100;
                        @endphp -->
                        <li class="col-sm-4">
                    <div class="campaign-item-wrap campaignequalheight">
                        <div class="thumb-wrap">
                            <a href="{{url('/race')}}/{{$row->slug}}"><img src="{{URL::to('/')}}/storage/app/public/{{$row->image}}" alt="{{$row->title}}"></a>
                        </div>
                        <div class="campaign-item-content">
                            <div class="campaign-title">
                                <h3>
                                    <a href="{{url('/race')}}/{{$row->slug}}">{{$row->title}}</a>
                                </h3>
                                <?php echo str_limit($row->description, $limit = 100, $end = '...'); ?>
                            </div>
                            <div class="campaign-info-wrap">
                                <ul>
                                    <li>
                                        <span class="hints">Entry cost:</span>
                                        <span class="info">£{{$row->entry_cost}}</span>
                                    </li>
                                    <!-- <li>
                                        <span class="hints">Race:</span>
                                        <span class="info race">{{$row->race}}</span>
                                    </li> -->
                                    <li>
                                        <span class="hints">Distance:</span>
                                        <span class="info distance">{{$row->distance}}</span>
                                    </li>
                                    <li>
                                        <span class="hints">Charity:</span>
                                        <span class="info charity">{{$row->charity}}</span>
                                    </li>
                                    <li>
                                        <span class="hints">Donating:</span>
                                        <span class="info">{{$row->supporting}}</span>
                                    </li>
                                </ul>
                            </div>
                             <div class="progress-bar-wrap">
                                <div class="progress-bar">
                                    <div data-size="{{($row->bought/$row->total_medals)*100}}" class="progress"></div>
                                </div>
                                <div class="campaign-duration">
                                    @if($row->bought <= $row->total_medals)
                                    <span class="campaign-spaces">{{$row->total_medals}} Entry Spaces Left</span>
                                    <!-- <span class="campaign-spaces">{{$row->total_medals-$row->bought }} Entry Spaces Left</span> -->
                                    @else 
                                    <span class="campaign-spaces">0 Entry Spaces Left</span>
                                    @endif
                                    <!-- <span class="campaign-spaces">{{$row->bought}}/{{$row->total_medals}} Spaces booked</span> -->
                                            
                                    @php 
                                    $daysleft = 0;
                                    if($row->days_left && $row->days_left > date('Y-m-d')){
                                    $daysleft_obj = date_diff(date_create(date('Y-m-d')), date_create($row->days_left));
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
                        <div class="race-quantity" style="display: none;">
                            <span class="hints">Quantity:</span>
                            <span class="info"><input type="number" name="" min="1" step="1" value="1" class="inputBx qty"></span>
                        </div>
                        @foreach ($row->coupons as $key => $value)
                           @php array_push($coupon,$value->id); @endphp
                        @endforeach
                        <div class="bottom-content">
                            <div class="column">
                                <a href="{{url('/race')}}/{{$row->slug}}" class="info-btn btnslideL">More info</a>
                            </div>
                            <div class="column">
                                <a class="addtocart cart-btn btnslideL" id="{{$row->id}}" image="{{$row->image}}" amount="{{$row->entry_cost}}" race-title="{{$row->title}}" coupon="<?php echo implode(",",array_unique($coupon)); ?>" contribution ="0"  flag="race" charity="{{$row->charity}}">Add to cart
                                </a>
                                <!-- <a class="addtocart cart-btn btnslideL" id="{{$row->id}}" image="{{$row->image}}" race-title="{{$row->title}}" >Add to cart</a> -->
                            </div>
                        </div>
                    </div>
                </li>
                        @endforeach
                        @endif                        
                    </ul>
                </div>
                @if(count($races) > 6)
                <div class="btn-wrap-row">
                    <a href="#" class="btn-wrap btnslideL" id="showMoreCampaigns"><span>More races</span></a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section><!--// End Race Section -->
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
