@extends('layouts.app')

@section('content')
<!--Begin Banner Section-->
<section class="banner-section-wrap clear">
    <!--Begin Slider Wrap-->
    <div class="container-fluid">
        <div class="row">
            <div class="slider-container flexslider" id="homeSlider">
                <ul class="slides">
                    <li class="slideOne">
                        <div class="banner-caption-wrap">
                            <h1>Stay fit, win medals & make a difference!</h1>
                            <a href="{{url('/races')}}" class="btn-wrap btnslideL"><span>Find Races</span></a>
                        </div>
                    </li>
                    <li class="slideTwo">
                        <div class="banner-caption-wrap">
                            <h1>Stay fit, win medals & make a difference!</h1>
                            <a href="{{url('/races')}}" class="btn-wrap btnslideL"><span>Find Races</span></a>
                        </div>
                    </li>
                </ul>        
            </div>
        </div>
    </div>
    <!--// End Slider-->
</section><!--// End Banner Section -->

<!--Begin About Us Section -->
<section class="content-section bg-opacity">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="featured-container about-featured-container">
                    <div class="featured-column big-column">
                       <div class="home-featured-video-wrap">
                            <div class="video-wrap"> 
                               <iframe src="https://www.youtube.com/embed/4ETy-xjqPIY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                           </div> 
                       </div> 
                    </div>
                    <div class="featured-column small-column">
                        <div class="section-title">
                            <h2>What is Virtual Run?</h2>
                            <p>At Running Mad we host virtual races, meaning you can run anytime, anywhere and with anyone or alone. Simply register for a virtual race <a href="{{url('races')}}">here</a>. Record your distance while you run or walk and then upload your results to your account.</p>
                            <p>Signing up to Running Mad is a great way to stay fit, make a difference and earn some real cool exclusive medals for your achievement.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--// End About Us Section -->

<!--Begin How It Works Section -->
<section class="content-section about-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="about-step-wrap">
                    <div class="steps-container">
                        <div class="step">
                            <div class="step-lines-wrap">
                                <div class="step-line"></div>
                                <div class="step-line step-line-border"></div>
                                <div class="step-circle">1</div>
                            </div>
                            <div class="step-details">
                                <h4>Find your race</h4>
                                <p>Sign up to a race with a distance that challenges you.</p>
                            </div>
                        </div>
                        <div class="step">
                            <div class="step-lines-wrap">
                                <div class="step-line step-line-border"></div>
                                <div class="step-line step-line-border"></div>
                                <div class="step-circle">2</div>
                            </div>
                            <div class="step-details">
                                <h4>Run the race</h4>
                                <p>Run anywhere, with anyone or no one!</p>
                            </div>
                        </div>
                        <div class="step">
                            <div class="step-lines-wrap">
                                <div class="step-line step-line-border"></div>
                                <div class="step-line step-line-border"></div>
                                <div class="step-circle">3</div>
                            </div>
                            <div class="step-details">
                                <h4>Submit your evidence</h4>
                                <p>Login and upload your race records for our verification</p>
                            </div>
                        </div>
                        <div class="step">
                            <div class="step-lines-wrap">
                                <div class="step-line step-line-border"></div>
                                <div class="step-line"></div>
                                <div class="step-circle">4</div>
                            </div>
                            <div class="step-details">
                                <h4>Receive your medal</h4>
                                <p>Your medal will be sent out to you!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--// End How It Works Section -->

<!--Begin Campaign Featured Section -->
<section class="content-section campaign-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-title featured-campaign-section-title">
                    <h2>Featured race</h2>
                </div>
            </div>
            <div class="col-sm-12">

                @if($races)
                @php $count = 0; @endphp
                @foreach($races as $row)
                @if($count < 1)
                @php $coupon = array(); @endphp
                <!-- Total raised for each campaign -->
                @php $race_raised_total = 0 ; @endphp
                @if($row->orders)
                    @foreach($row->orders as $value)
                        @php $race_raised_total += $value->amount; @endphp
                    @endforeach
                @endif
                <div class="featured-container">
                    <div class="featured-column small-column">
                        <div class="featured-item-info">
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
                                            <!-- <span class="info">£{{$race_raised_total}}</span> -->
                                        </li>
                                    </ul>
                                </div>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar">
                                        <div data-size="{{($row->bought/$row->total_medals)*100}}" class="progress"></div>
                                    </div>
                                    <div class="campaign-duration">
                                        <!-- <span class="campaign-spaces">100/1,000 Spaces booked</span>
                                        <span class="left-days">15 Days left</span> -->
                                        <!-- <span class="campaign-spaces">{{$row->bought}}/{{$row->total_medals}} Spaces booked</span> -->
                                        @if($row->bought <= $row->total_medals)
                                        <!-- <span class="campaign-spaces">{{$row->total_medals-$row->bought }} Entry Spaces Left</span> -->
                                        <span class="campaign-spaces">{{$row->total_medals}} Entry Spaces Left</span>
                                        @else 
                                        <span class="campaign-spaces">0 Entry Spaces Left</span>
                                        @endif
                                        
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
                                        <!-- <span class="campaign-spaces">{{$row->total_medals }} Entry Spaces Left</span>
                                        <span class="left-days">{{$row->days_left}} Days left</span> -->
                                    </div>
                                </div>
                                <div class="race-quantity" style="display: none;">
                                <span class="hints">Quantity:</span>
                                <span class="info"><input type="number" name="" min="1" step="1" value="1" class="inputBx qty"></span>
                                </div>
                                @foreach ($row->coupons as $key => $value)
                                   @php array_push($coupon,$value->id); @endphp
                                @endforeach
                            </div>
<!--                        <div class="bottom-content">
                                <div class="column">
                                    <a href="{{url('/races')}}" class="info-btn btnslideL">More info</a>
                                </div>
                                <div class="column">
                                    <a href="cart.html" class="cart-btn btnslideL">Add to cart</a>
                                </div>
                            </div> -->
                            <div class="bottom-content">
                                <div class="column">
                                    <a href="{{url('/race')}}/{{$row->slug}}" class="info-btn btnslideL">More info</a>
                                </div>
                                <div class="column">
                                    <a class="addtocart cart-btn btnslideL" id="{{$row->id}}" image="{{$row->image}}" amount="{{$row->entry_cost}}" race-title="{{$row->title}}" coupon="<?php echo implode(",",array_unique($coupon)); ?>" contribution ="0"  flag="race" charity="{{$row->charity}}">Add to cart
                                    </a>
                                    <!-- <a class="addtocart cart-btn btnslideL" id="{{$row->id}}" image="{{$row->image}}" race-title="{{$row->title}}"  >Add to cart</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="featured-column big-column">
                        <a href="{{url('/race')}}/{{$row->slug}}">
                            <div class="featured-thumb-wrap">
                               <img src="{{URL::to('/')}}/storage/app/public/{{$row->image}}" alt="{{$row->title}}" alt=""> 
                            </div> 
                        </a>
                    </div>
                </div>
                @endif
                @php $count++; @endphp
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if($races)
                <div class="btn-wrap-row">
                    <a href="{{url('/races')}}" class="btn-wrap btnslideL"><span>More races</span></a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section><!--// End Campaign Featured Section -->

<!--Begin Campaign Section -->
<section class="content-section campaign-section" style="display: none;">
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
                                        <p>{{ str_limit($row->description, $limit = 100, $end = '...') }}</p>
                                    </div>
                                    <div class="campaign-info-wrap">
                                        <ul>
                                            <li>
                                                <span class="hints">Entry cost:</span>
                                                <span class="info">£{{$row->entry_cost}}</span>
                                            </li>
                                            <li>
                                                <span class="hints">Race:</span>
                                                <span class="info race">{{$row->race}}</span>
                                            </li>
                                            <li>
                                                <span class="hints">Distance:</span>
                                                <span class="info distance">{{$row->distance}} Miles</span>
                                            </li>
                                            <li>
                                                <span class="hints">Charity:</span>
                                                <span class="info charity">{{$row->charity}}</span>
                                            </li>
                                            <li>
                                                <span class="hints">Donation:</span>
                                                <span class="info">£{{$race_raised_total}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="progress-bar-wrap">
                                        <div class="progress-bar">
                                            <div data-size="{{$row->bought}}" class="progress"></div>
                                        </div>
                                        <div class="campaign-duration">
                                            <span class="campaign-spaces">{{$row->bought}}/{{$row->total_medals}} Spaces booked</span>
                                            <span class="left-days">{{$row->days_left}} Days left</span>
                                        </div>
                                    </div>
                                    <div class="race-quantity" style="display: none;">
                                    <span class="hints">Quantity:</span>
                                    <span class="info"><input type="number" name="" min="1" step="1" value="1" class="inputBx qty"></span>
                                    </div>
                                    @foreach ($row->coupons as $key => $value)
                                       @php array_push($coupon,$value->id); @endphp
                                    @endforeach
                                </div>
                                <div class="bottom-content">
                                    <div class="column">
                                        <a href="{{url('/race')}}/{{$row->slug}}" class="info-btn btnslideL">More info</a>
                                    </div>
                                    <div class="column">
                                        <a class="addtocart cart-btn btnslideL" id="{{$row->id}}" image="{{$row->image}}" amount="{{$row->entry_cost}}" race-title="{{$row->title}}" coupon="<?php echo implode(",",array_unique($coupon)); ?>" >Add to cart
                                        </a>
                                        <!-- <a class="addtocart cart-btn btnslideL" id="{{$row->id}}" image="{{$row->image}}" race-title="{{$row->title}}"  >Add to cart</a> -->
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
                 @if($races)
                <div class="btn-wrap-row">
                    <a href="{{url('/races')}}" class="btn-wrap btnslideL"><span>More races</span></a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section><!--// End Campaign Section -->

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
