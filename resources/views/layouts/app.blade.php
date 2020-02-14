<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" media="all" href="{{URL::to('/')}}/storage/app/public/{{setting('general.favicon')}}">
    <link rel="apple-touch-icon" href="{{URL::to('/')}}/storage/app/public/{{setting('general.favicon')}}"/>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->

    <title>{{ setting('general.title') }}</title>
    <!-- Styles --> 
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700,700i,800i,900|Oswald:400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/bootstrap-grid.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/flexslider.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/sweetalert2.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/responsive.css') }}">
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body> 
<!--Begin Main Wrap -->
<div class="main-wrap clear">
    <!-- Begin Main Wrap Inner-->
    <div class="main-wrap-inner clear">
        <!--Begin Header-->
        <header class="header">
            <div class="header-container">
                <div class="container clear ">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="logo-wrap">
                                <!-- <a href="{{ url('/') }}"><img src="{{URL::to('/')}}/storage/app/public/{{setting('general.logo')}}" alt="Running Mad"> </a> -->
                                <a href="{{ url('/') }}"><img src="{{URL::to('/')}}/images/running-mad.svg" alt="Running Mad"> </a>
                            </div>
                            <div class="header-right">
                                <div class="phone-nav">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <!--Begin Header Cart -->
                               
                                <div class="cart-btn-wrap">
                                    <span class="header-cart-btn" id="headerCartBtn"><i class="fas fa-shopping-cart"></i> ({{Cart::content()->count()}})</span>
                                    @if(Cart::content()->count() > 0) 
                                    <div class="mini-cart-wrap" id="headerCart">
                                        <div class="cart-content">
                                            <?php foreach(Cart::content() as $row) :?>
                                            <div class="custom-row">
                                                <div class="col-sm-5 column item-column">
                                                    <div class="campaign-title">
                                                        <h3>{{ $row->name }}</h3>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 column item-remove-column">
                                                    <!-- <span class="remove-item"><i class="fas fa-times"></i></span> -->
                                                    <span class="header-item-remove" rowid="{{ $row->rowId }}"><i class="fas fa-times"></i>
                                                    <!-- <input type="hidden" value="{{ $row->rowId }}" class="rowid"> -->
                                                    </span>
                                                </div>
                                                 <div class="col-sm-2 column amount-column">
                                                    <div class="amount-wrap">
                                                       <div class="amount-qty-wrap">
                                                            <span class="qty">{{ $row->qty }} x</span>
                                                            <span>£{{ $row->price }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="custom-row  mini-cart-bottom">
                                            <div class="col-sm-6">
                                                <a href="{{ url('cart') }}" class="btn-wrap btnslideL pull-left"><span>View Cart</span></a>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="{{ url('checkout') }}" class="btn-wrap btnslideL pull-right"><span>Checkout</span></a>
                                            </div>
                                        </div>
                                        <div class="removed-loading-wrap header-remove-loading-img">
                                            <span class="loading-img"></span>
                                        </div>
                                        <!-- If cat is empty -->
                                        <!-- <div class="custom-row header-empty-cart">
                                            <p class="align-center">Your Cart is empty</p>
                                        </div> -->
                                    </div>
                                    @endif              
                                </div><!--// End Header Cart --> 
                               

                                <div class="main-nav-wrap">
                                    <nav class="nav-container clear">
                                         <!-- {{menu('Frontend')}} -->
                                        <ul class="main-menu">
                                            <li><a href="{{url('/')}}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                                            <li><a href="{{url('about')}}" class="{{ (last(request()->segments()) == 'about') ? 'active' : '' }}">About us</a></li>
                                            <li><a href="{{url('races')}}" class="{{ (last(request()->segments()) == 'races') ? 'active' : '' }}">Races</a></li>
                                            <li><a href="{{url('shop')}}" class="{{ (last(request()->segments()) == 'shop') ? 'active' : '' }}">Shop</a></li>
                                            <li><a href="{{url('contact')}}" class="{{ (last(request()->segments()) == 'contact') ? 'active' : '' }}">Contact</a></li>
                                            @if($user = Auth::user())
                                            <li class="dropdown submenu login">
                                                <a href="#" class="color-text dropdown-toggle"  data-toggle="dropdown">
                                                    {{ Auth::user()->name }}
                                                    <span class="glyphicon glyphicon-chevron-down for-mobile"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                       <a href="{{url('dashboard')}}">Dashboard</a>
                                                    </li>
                                                    <li>
                                                       <!-- <a href="{{ url('/auth/logout') }}">Logout</a> -->
                                                        <a href="{{ url('/logout') }}"
                                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                            Logout
                                                        </a>
                                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                            {{ csrf_field() }}
                                                        </form>
                                                    </li>
                                                </ul>
                                            </li>
                                            @else
                                            <li><a href="{{ route('login') }}">Login</a></li>@endif
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header><!--// End Header -->
        
         <!-- BODY START -->
        @yield('content')
        <!-- BODY END -->
    </div><!--// End Main Wrap Inner--> 
    <!--Begin Footer-->
    <footer class="footer">
        <div class="footer-section">
            <div class="container">
               <div class="row">
                    <div class="col-sm-4">
                        <div class="copyright">
                           © <script>document.write(new Date().getFullYear())</script> Copyright Running Mad. Designed by <a href="https://theplaystudio.com/" target="_blank">Play</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="footer-logo">
                            <a href="{{url('/')}}"><img src="{{URL::to('/')}}/images/running-mad-full.svg" alt="Running Mad"></a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="footer-social-media">
                            <ul>
                                <li><a href="{{setting('social-media.facebook')}}" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                                <li><a href="{{setting('social-media.instagram')}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="{{setting('social-media.twitter')}}" target="_blank"><i class="fab fa-twitter-square"></i></a></li>
                            </ul>
                        </div>
                    </div>
               </div>
           </div> 
        </div>
    </footer> <!--// End Footer-->
</div> <!--// End Main Wrap-->

<!-- JQuery -->
<!-- <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.js') }}"></script> -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.bundle.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.flexslider.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/sweetalert2.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/multiplefileupload.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/common-scripts.js') }}"></script>
</body>
</html>
