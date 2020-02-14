@extends('layouts.app')

@section('content')
    <!--Begin Charities Sign Up -->
    <section class="section-wrap login-register-section">
        <div class="container form-container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Charities Sign Up</h2>
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
                                        <label>Job Title / Position</label>
                                        <input type="text" class="inputBx" placeholder="" name="job_title">
                                    </div>
                                    <div class="col-sm-6">
                                         <label>Organisation Name</label>
                                        <input type="text" class="inputBx" placeholder="" name="organisation_name">
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-sm-6">
                                        <label>Registered Charity Number (if applicable)</label>
                                        <input type="text" class="inputBx" placeholder="" name="registered_charity_number">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Area of Work</label>
                                        <div class="selectBx styled-dropdown custom-wdt">
                                            <select name="area_of_work">
                                                <optgroup label="ENGLAND">
                                                    <option value="east of england">East of England</option>
                                                    <option value="east midlands">East Midlands</option>
                                                    <option value="london">London</option>
                                                    <option value="north east">North East</option>
                                                    <option value="north west">North West</option>
                                                    <option value="south east">South East</option>
                                                    <option value="south west">South West</option>
                                                    <option value="west midlands">West Midlands</option>
                                                    <option value="yorkshire-humber">Yorkshire & Humber</option>
                                                </optgroup>
                                                <option value="northern ireland">NORTHERN IRELAND</option>
                                                <option value="scotland">SCOTLAND</option>
                                                <option value="wales">WALES</option>
                                                <option value="nationwide">Nationwide</option>
                                                <option value="international">International</option>
                                            </select>
                                            <div class="dropdown-styler"><div></div></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-sm-6">
                                        <label>Contact Number (office)</label>
                                        <input type="text" class="inputBx" placeholder="" name="labelled_office_contact">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Contact Number (mobile)</label>
                                        <input type="text" class="inputBx" placeholder="" name="contact_number">
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-sm-6">
                                        <label>Number of paid employees</label>
                                        <div class="selectBx styled-dropdown custom-wdt">
                                            <select name="number_of_employee">
                                                <option value="1-9">1-9</option>
                                                <option value="10-24">10-24</option>
                                                <option value="25-49">25-49</option>
                                                <option value="50-99">50-99</option>
                                                <option value="100+">100+</option>
                                            </select>
                                            <div class="dropdown-styler"><div></div></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Number of current active volunteers</label>
                                        <div class="selectBx styled-dropdown custom-wdt">
                                            <select name="number_of_volunteer">
                                                <option value="1-9">1-9</option>
                                                <option value="10-24">10-24</option>
                                                <option value="25-49">25-49</option>
                                                <option value="50-99">50-99</option>
                                                <option value="100+">100+</option>
                                            </select>
                                            <div class="dropdown-styler"><div></div></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-sm-6">
                                        <div class="custom-radio-container">
                                            <label>Do you have public liability insurance?</label>
                                            <label class="radiolabel"><input type="radio" name="liability" value="yes" class="radioBtn" checked>Yes</label>
                                            <label class="radiolabel"><input type="radio" name="liability" value="no" class="radioBtn">No</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">  
                                    </div>
                                </div>
                                <input type="hidden" class="inputBx" placeholder="" name="role_id" value="4">
                                <div class="custom-row">
                                    <div class="view-more-wrap">
                                        <!-- <input type="submit" class="btn-wrap small-btn" value="Sign Up"> -->
                                        <!-- <a href="dashboard.html" class="btn-wrap small-btn">Sign Up</a> -->
                                        <button type="submit" class="btn-wrap small-btn">
                                            Sign Up
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Charities Sign Up -->
@endsection
