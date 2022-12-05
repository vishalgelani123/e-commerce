@extends('layouts.app')
@section('content')
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <div class="login-logo">
        </div>
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1" style="margin-top:150px;">
        <form action="{{ route('login') }}" method="POST">
            
        @csrf
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input id="email" type="email"
                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required
                   autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" name="email"
                   value="{{ old('email', null) }}">

            <label class="form-label" for="form3Example3">Email address</label>
            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <input id="password" type="password"
                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                   required placeholder="{{ trans('global.login_password') }}">
            <label class="form-label" for="form3Example4">Password</label>
                @if ($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errrs->first('password') }}
                    </div>
                @endif
            </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" name="remember" id="remember">
              <label class="form-check-label" for=for="remember">{{ trans('global.remember_me') }}</label>
            </div>

            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
               {{ trans('global.forgot_password') }}</a>
            @endif
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">{{ trans('global.login') }}</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>
@endsection