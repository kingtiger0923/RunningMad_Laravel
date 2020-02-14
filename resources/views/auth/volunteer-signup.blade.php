@extends('layouts.app')

@section('content')
    <!--Begin Volunteers Sign Up -->
    <section class="section-wrap login-register-section">
        <div class="container form-container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Volunteers Sign Up</h2>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="login-register-container">
                        <div class="contact-form-wrap">
                           <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}
                                <div class="custom-row">
                                    <div class="col-sm-6">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label>Full Name</label>
                                            <input id="name" type="text" class="form-control inputBx" name="name" value="{{ old('name') }}" required autofocus>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label>Email Address</label>
                                            <input id="email" type="email" class="form-control inputBx" name="email" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-sm-6">
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label>Password</label>
                                            <input id="password" type="password" class="form-control inputBx" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password-confirm" class="control-label">Confirm Password</label>
                                            <input id="password-confirm" type="password" class="form-control inputBx" name="password_confirmation" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-row">
                                     <div class="col-sm-6">
                                        <label>Location  (City, Country)</label>
                                        <input type="text" class="inputBx" placeholder="" name="location">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Contact Number</label>
                                        <input type="text" class="inputBx" placeholder="" name="contact">
                                        <input type="hidden" class="inputBx" placeholder="" name="role_id" value="3">
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="view-more-wrap">
                                        <!-- <input type="submit" class="btn-wrap small-btn" value="Sign Up"> -->
                                       <!--  <a href="dashboard.html" class="btn-wrap small-btn">Sign Up</a> -->
                                        <button type="submit" class="btn-wrap small-btn">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Volunteers Sign Up -->
@endsection
