@extends('layouts.auth')

@section('title')
  Register
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
              <form method="POST" action="/register">
                @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    type="text"
                    name="name"
                    id="name"
                    autofocus
                    required>
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    type="email"
                    name="email"
                    id="email"
                    required>
                  @error('email')
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
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="agree" class="custom-control-input @error('agree') is-invalid @enderror" id="agree">
                    <label class="custom-control-label" for="agree">
                      I agree with the terms and conditions
                      @error('agree')
                        <div>{{ $message }}</div>
                      @enderror
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Register
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