@extends('layouts.dashboard')

@section('title')
  Dashboard
@endsection

@section('css')
@endsection

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item">Dashboard</div>
        </div>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12 mb-4">
            <div class="hero bg-primary text-white">
              <div class="hero-inner">
                <h2>Welcome, {{ auth()->user()->name }}!</h2>
                <p class="lead">You almost arrived, complete the information about your account to complete registration.</p>
                <div class="mt-4">
                  <a href="#" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Complete Account</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>
@endsection

@push('scripts')
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
