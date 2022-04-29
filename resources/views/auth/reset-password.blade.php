@extends('layouts.auth')

@section('title')
  Register
@endsection

@section('css')
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection

@section('content')
  <section class="section">
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">

          <div class="login-brand">
            <img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
          </div>
          <div class="card card-primary">
            <div class="card-header"><h4>Register</h4></div>

            <div class="card-body">
              <form method="POST" action="/reset-password">
                @csrf
                <div class="form-group">
                  <label for="token">Token</label>
                  <input
                    class="form-control @error('token') is-invalid @enderror"
                    value="{{ $token }}"
                    type="text"
                    name="token"
                    id="token"
                    autofocus
                    required>
                  @error('token')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="row">
                  <div class="form-group col-6">
                    <label for="password" class="d-block">Password</label>
                    <input
                      class="form-control pwstrength @error('password') is-invalid @enderror"
                      data-indicator="pwindicator"
                      type="password"
                      name="password"
                      id="password"
                      required>
                    <div id="pwindicator" class="pwindicator">
                      <div class="bar"></div>
                      <div class="label"></div>
                    </div>
                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group col-6">
                    <label for="password_confirmation" class="d-block">Password Confirmation</label>
                    <input
                    class="form-control @error('password') is-invalid @enderror"
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required>
                  </div>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Reset Password
                  </button>
                </div>
              </form>
              <div class="mt-5 text-center">
                Already have an account?
                <a href="/login">Log in now</a>
              </div>
            </div>
          </div>
          <div class="simple-footer">
            Copyright &copy; {{ date('Y') }}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <!-- JS Libraies -->
  <script src="{{ asset('assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
  <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
  <script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
  <script>
    $('.pwstrength').pwstrength();
  </script>
  @if (session()->has('Success'))
    <script>
      iziToast.info({
        title: 'Success',
        message: "{{ session('Success') }}",
        position: 'topRight'
      });
    </script>
  @elseif (session()->has('Error'))
    <script>
      iziToast.warning({
        title: 'Error',
        message: "{{ session('Error') }}",
        position: 'topRight'
      });
    </script>
  @endif
@endpush