@extends('layouts.app')

@section('content')
<!-- <section class="single-banner clear"> -->
<section class="single-banner clear" style="background: url({{URL::to('/')}}/storage/app/public/{{setting('general.banner_img')}}) no-repeat center 0; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h1>About {{setting('general.title')}}</h1>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Banner Section -->
<!--Begin About Us Top Section -->
<section class="content-section about-top-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- <div class="section-title">
                    <h2>About Running mad & virtual races</h2>
                    <h3>My Race creates virtual running races to raise money for charity and rewards runners with awesome medals and goody bags. A virtual race is one that can be completed at any location or time, meaning you do not have to physically turn up to a race start line.</h3>
                </div> -->
                <div class="white-content">
                    <div class="about-page-content">
                        <?php echo setting('about.about'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--// End About Us Top Section -->
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

<!--Begin About Social Media Section -->
<section class="content-section about-social-media-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-title">
                    <h2>Find and connect with us</h2>
                </div>
                <div class="about-social-media">
                    <ul>
                        <li><a href="{{setting('social-media.facebook')}}" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                        <li><a href="{{setting('social-media.instagram')}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="{{setting('social-media.twitter')}}" target="_blank"><i class="fab fa-twitter-square"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section><!--// End About Social Media  Section -->

@endsection
