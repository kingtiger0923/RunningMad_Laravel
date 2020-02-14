@extends('layouts.app')

@section('content')
 <!--Begin Banner Section-->
<section class="single-banner clear" style="background: url({{URL::to('/')}}/storage/app/public/{{setting('general.banner_img')}}) no-repeat center 0; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h1>Contact</h1>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Banner Section -->
<!--Begin Contact Top Section -->
<!-- <section class="content-section contact-top-section"> -->
<section class="content-section contact-top-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-title">
                    <h2>Contact us</h2>
                    <h3>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-content">
                    <div class="contact-form-content">
                        <!--Begin Cotact Info Wrap -->
                        <div class="col-sm-4">
                            <div class="contact-info-wrap">
                                <div class="contact-info-content">
                                    <!-- <address>
                                        <h4>Visit us</h4>
                                        {{setting('general.address')}}
                                    </address> -->
                                    <address>
                                        <h4>Contact</h4>
                                        <!-- <span>Call</span>
                                        <a href="tel:{{setting('general.contact')}}">{{setting('general.contact')}}</a>
                                        <span>Email</span> -->
                                        <a href="mailto:{{setting('general.email')}}">{{setting('general.email')}}</a>
                                    </address>
                                </div>
                            </div>
                            <div class="contact-social-media">
                                <ul>
                                    <li><a href="{{setting('social-media.facebook')}}" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                                    <li><a href="{{setting('social-media.instagram')}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="{{setting('social-media.twitter')}}" target="_blank"><i class="fab fa-twitter-square"></i></a></li>
                                </ul>
                            </div>
                        </div><!--// End Cotact Info Wrap -->
                        <!--Begin Cotact Form Wrap -->
                        <div class="col-sm-8">
                             <div class="contact-form-wrap">
                                <div class="col-sm-12"><h3>Enquiry form</h3></div>
                                <form action="#" method="post" id="contactpageprocess" name="contactpageprocess">
                                    <div class="custom-row">
                                        <div class="col-sm-6">
                                            <label>First Name</label>
                                            <input type="text" class="inputBx" placeholder="First name" name="firstname" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Last name</label>
                                           <input type="text" class="inputBx" placeholder="Last name" name="lastname" required>
                                        </div>
                                    </div>
                                    <div class="custom-row">
                                        <div class="col-sm-6">
                                            <label>Email address</label>
                                            <input type="text" class="inputBx" placeholder="Email address" name="email" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Contact</label>
                                             <input type="text" class="inputBx" placeholder="Phone" name="phone">
                                        </div>
                                    </div>
                                    <div class="custom-row">
                                        <div class="col-sm-12">
                                            <label>Your message</label>
                                            <textarea class="textArea" name="message">Your message</textarea>
                                        </div>
                                    </div>
                                    <div class="btn-wrap-row">
                                        <button class="btn-wrap btnslideL"><span>Submit</span>
                                            <dfn class="loading-img contact-page-loading-img"></dfn>
                                        </button>
                                        <div class="contact-page-process-result"></div>
                                    </div>
                                </form>
                            </div>
                        </div><!--// End Cotact Form Wrap -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Contact Top Section -->
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
