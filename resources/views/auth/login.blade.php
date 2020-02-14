@extends('layouts.app')

@section('content')
 <!--Begin Banner Section-->
        <section class="single-banner clear">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title">
                            <h1>Login</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--// End Banner Section -->
        <!--Begin Login Register Section -->
        <section class="content-section login-register-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-content">
                            <div class="login-register-content">
                                <div class="login-register-form-wrap">
                                    <!-- <form action="#" method="post"> -->
                                    <h1> Sign in to Running Mad </h1>
                                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}
                                        <button class="btn btn-primary" style="padding-top:20px; color:white;"><a href="/login/google">Sign in with Google</a></button>
                                        <button class="btn btn-primary"><a href="/login/facebook">Sign in with FaceBook</a></button>
                                        <div class="custom-row form-group{{ $errors->has('email') ? ' has-error' : '' }}">  
                                            <label>Email address</label>
                                            <input type="text" class="inputBx form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="example@example.com"> 
                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                        </div> 
                                        <div class="custom-row form-group{{ $errors->has('password') ? ' has-error' : '' }}">  
                                            <label>Password</label>
                                            <input type="password" class="inputBx form-control" name="password" placeholder="e.g. P@ssword2018" required>
                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                        <div class="btn-wrap-row">
                                            <button type="submit" class="btn-wrap btnslideL"><span>Login</span></button>
                                        </div>
                                        <div class="custom-row">
                                            <label class="register-txt"><a href="{{route('register')}}">Register now</a></label> 
                                        </div>
                                        <div class="custom-row forgot-password">
                                            <label class="forgot-password-txt"><a href="{{ route('password.request') }}">Forgot your password?</a></label> 
                                           <!--  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="checkbox forgot-password-txt">
                                            <span class="remember-txt">Remember me</span -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--// End Login Register Section -->
@endsection
