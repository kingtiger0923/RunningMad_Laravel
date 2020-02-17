@extends('layouts.app')

@section('content')
<!--Begin Banner Section-->
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
                                        <form class="form-horizontal" method="POST" id="updateprofile" enctype="multipart/form-data">
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
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-row">
                                                <div class="col-sm-6">
                                                    <label>Address</label>
                                                    <input id="autocomplete" class="form-control inputBx" name="address" placeholder="Enter your address" value="{{$delivery_address->address}}" onFocus="geolocate()" type="text"/>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>City</label>
                                                    <input type="text" class="form-control inputBx" value="{{$delivery_address->city}}" placeholder="" name="city">
                                                </div>
                                            </div>
                                            <div class="custom-row">
                                                <div class="col-sm-6">
                                                    <label>Post code</label>
                                                    <input type="text" class="form-control inputBx" value="{{$delivery_address->postcode}}" placeholder="" name="postcode">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Country</label>
                                                    <!-- <input type="text" class="inputBx" value="" placeholder="" name="country"> -->
                                                    <div class="selectBx styled-dropdown">
                                                        <select name="country">
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

<script>
// This sample uses the Autocomplete widget to help the user select a
// place, then it retrieves the address components associated with that
// place, and then it populates the form fields with those details.
// This sample requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete;

var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYx_t3sZg0aVL2ZPf_dLZ8j9q6VfIrW9Q&libraries=places&sessiontoken=<?php echo str_random(32); ?>&callback=initAutocomplete"
    async defer></script>

@endsection
