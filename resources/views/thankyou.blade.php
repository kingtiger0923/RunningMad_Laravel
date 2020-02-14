@extends('layouts.app')
@section('content')
    <!-- SEO -->
    @section('title', 'Thankyou')
    @section('description', '')
    @section('keywords', '')
    @section('image', '')
    <!-- END SEO -->
    <!--Begin Banner Section-->
    <section class="single-banner clear" style="background: url({{URL::to('/')}}/storage/app/public/{{setting('general.banner_img')}}) no-repeat center 0; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title">
                        <h1>Thank You</h1>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Banner Section -->
    <!--Begin Thank You Section -->
    <section class="content-section thankyou-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-content">
                        <div class="thankyou-content">
                            <h2>Thank You for the order</h2>
                           <!--  <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</h3> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Thank You Section -->
@endsection
