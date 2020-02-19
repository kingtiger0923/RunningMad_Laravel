@extends('layouts.app')

@section('content')
<!--Begin Banner Section-->

<link rel="stylesheet" type="text/css" href="https://api.addressnow.co.uk/css/addressnow-2.20.min.css?key=xt34-xr77-xm66-jz59" />
<section class="single-banner small-banner clear">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Banner Section -->
<!--Begin Dashboard Section -->
<section class="content-section dashboard-section">
    <div class="container">
        <div class="row">
            <!-- Password reset alert -->
            <div class="col-sm-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <!-- Password reset alert -->
            <div class="dashboard-content-wrap">
                <div class="col-sm-3 left-column">
                    <div class="white-content">
                        <ul class="dashboard-menu-wrap nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#orders" role="tab" data-toggle="tab"><span><i class="far fa-heart"></i></span> Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#profile" role="tab" data-toggle="tab"><span><i class="far fa-user"></i></span> Profile</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-9 right-column">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="orders">
                            <div class="white-content">
                                <!-- Begin Table Content -->
                                <div class="table-wrap">
                                    <table class="table data-table">
                                        <thead>
                                            <tr>
                                                <th>Order id</th>
                                                <th>Product name</th>
                                                <th>Purchase date</th>
                                                <th>Status</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($orders)
                                            @foreach($orders as $order)
                                            @if(isset($order->raceId->title))
                                            <tr>
                                                <td>{{$order->id}}</td>
                                                <td>
                                                    <a href="{{url('order')}}/{{$order->id}}">{{$order->raceId->title}}</a>
                                                </td>
                                                <td>
                                                 <!--   {{ Carbon\Carbon::parse($order->date_created)->format('j F Y ') }} -->
                                                   {{ Carbon\Carbon::parse($order->created_at)->format('j F Y ') }}
                                                </td>
                                                <td>
                                                    {{$order->status}}
                                                </td>
                                                <td>
                                                    <!-- <div class="order-evidence-btn-wrap">
                                                        <a href="{{url('order')}}/{{$order->id}}" class="info-btn btnslideL">Submit evidence</a>
                                                    </div> -->
                                                    @if($order->status == "Evidence Submitted")
                                                    <div class="order-evidence-btn-wrap blue-btn">
                                                        <a href="{{url('order')}}/{{$order->id}}" class="info-btn btnslideL">Submit evidence</a>
                                                    </div>
                                                     @elseif($order->status == "Race Complete")
                                                    <div class="order-evidence-btn-wrap green-btn">
                                                        <a href="{{url('order')}}/{{$order->id}}" class="info-btn btnslideL">Submit evidence</a>
                                                    </div>
                                                    @else
                                                    <div class="order-evidence-btn-wrap">
                                                        <a href="{{url('order')}}/{{$order->id}}" class="info-btn btnslideL">Submit evidence</a>
                                                    </div>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div><!--// End Table Content -->
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <div class="white-content">
                                <div class="profile-update-title-wrap">
                                    <div class="section-title">
                                        <h2>Update Profile</h2>
                                    </div>
                                </div>
                                <div class="login-register-content dashboard-profile-update">
                                    <div class="login-register-form-wrap">
                                        <form class="form-horizontal" method="POST" id="updateprofile" action="updateprofile">
                                        {{ csrf_field() }}
                                            <div class="custom-row">
                                                <div class="col-sm-6">
                                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">  
                                                        <label>Name</label>
                                                        <input id="name" type="text" class="form-control inputBx" name="name" value="{{ auth()->user()->name  }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">  
                                                        <label>Email address</label>
                                                        <input id="email" type="email" class="form-control inputBx disabled-field" name="email" value="{{ auth()->user()->email }}" required readonly>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="custom-row">
                                                <div class="col-sm-6">
                                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">  
                                                        <label>Password</label>
                                                        <input id="password" type="password" class="form-control inputBx" value="" name="password">
                                                    </div>
                                                    <span class="label-info">Leave empty to keep the same</span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Confirm password</label>
                                                    <input id="password-confirm" type="password" class="form-control inputBx" name="password_confirmation">
                                                </div>
                                            </div>
                                            <div class="custom-row">
                                                <div class="col-sm-6">
                                                    <label>Mobile Number</label>
                                                    <input type="text" class="form-control inputBx" value="{{ $delivery_address->phone}}" placeholder="" name="phone">
                                                </div>
                                            </div>
                                            <div class="custom-row">
                                                <div class="col-sm-12">
                                                    <div class="title-row">
                                                        <h2>Your Address</h2>
                                                        <input id="autocomplete" autocomplete="true" class="form-control inputBx" name="autocomplete" placeholder="Search your address" type="text"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-row">
                                                <div class="col-sm-6">
                                                    <label>Address</label>
                                                    <input id="address" class="form-control inputBx" name="address" value="{{$delivery_address->address}}" placeholder="Enter your address" type="text"/>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>City</label>
                                                    <input type="text" id="city" name="city" class="form-control inputBx" value="{{$delivery_address->city}}" placeholder="">
                                                </div>
                                            </div>
                                            <div class="custom-row">
                                                <div class="col-sm-6">
                                                    <label>PostalCode</label>
                                                    <input id="postalcode" name="postalcode" type="text" class="form-control inputBx" value="{{$delivery_address->postcode}}" placeholder="">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>CountryName</label>
                                                    <!-- <input type="text" class="inputBx" value="" placeholder="" name="country"> -->
                                                    <div class="selectBx styled-dropdown">
                                                        <select name="country" id="countryName">
                                                            <!-- <option selected disabled></option> -->
                                                            @if($countries)
                                                            @foreach($countries as $country)
                                                            <option value="{{$country}}" @php if($country == $delivery_address->country) echo "selected"; @endphp>{{$country}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        <div class="dropdown-styler"><div></div></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-wrap-row">
                                                <button type="submit" class="btn-wrap btnslideL">
                                                    <span>Update</span>
                                                     <dfn class="loading-img"></dfn>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="update-message"></div>
                                    <div class="up-print-error-msg"><ul></ul></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Dashboard Section -->
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

<script type="text/javascript" src="https://api.addressnow.co.uk/js/addressnow-2.20.min.js?key=xt34-xr77-xm66-jz59"></script>
<script>
    addressNow.listen('load', function(control) {
        control.listen("populate", function(address) {
            console.log(address.CountryName);
            document.getElementById('address').value = (address.Line1 + ' ' + address.Line2);
            document.getElementById('postalcode').value = address.PostalCode;
            document.getElementById('city').value = address.City;

            var select = document.getElementById('countryName');

            for ( var i = 0, l = select.options.length, o; i < l; i++ )
            {
                o = select.options[i];
                if ( address.CountryName == o.text )
                {
                    o.selected = true;
                }
            }
        });
    });
</script>
@endsection
