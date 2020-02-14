@extends('layouts.app')

@section('content')
<section class="content-section login-register-section reset-password">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-content">
                    <div class="section-title">
                        <h2>Reset Password</h2>
                    </div>
                    <div class="login-register-content">
                        <div class="login-register-form-wrap">
                            <div class="panel-body">
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                                    {{ csrf_field() }}

                                    <div class="custom-row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email">E-Mail Address</label>
                                        <input id="email" type="email" class="inputBx form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                        
                                    </div>
                                    <div class="btn-wrap-row">
                                        <button type="submit" class="btn-wrap btnslideL"><span>Send Password Reset Link</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
