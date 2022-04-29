@extends('layouts.auth')

@section('title')
  Forgot Password
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection

@section('content')
  <section class="section">
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
          <div class="login-brand">
            <img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
          </div>

          <div class="card card-primary">
            <div class="card-header"><h4>Forgot Password</h4></div>

            <div class="card-body">
              <p class="text-muted">We will send a link to reset your password</p>
              <form method="POST" action="/forgot-password">
                @csrf
                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="2">
                    Forgot Password
                  </button>
                </div>
              </form>
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
  <script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
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