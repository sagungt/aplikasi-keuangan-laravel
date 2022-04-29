@extends('layouts.auth')

@section('title')
  Verify Email
@endsection

@section('css')
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
            <div class="card-header"><h3>{{ __('Verify Your Email Address') }}</h3></div>

            <div class="card-body">
              @if (session('resent'))
                <div class="alert alert-success" role="alert">
                  {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
              @endif
              {{ __('Before proceeding, please check your email for a verification link.') }}
              {{ __('If you did not receive the email') }},
              <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                  @csrf
                  <button type="submit" class="btn btn-primary btn-lg btn-block mt-3">{{ __('Click here to request another') }}</button>.
              </form>
              <div class="mt-3 text-center">
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
  <script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
  @if (session()->has('Success'))
    <script>
      iziToast.info({
        title: 'Success',
        message: "{{ session('Success') }}",
        position: 'topRight'
      });
    </script>
  @endif
@endpush