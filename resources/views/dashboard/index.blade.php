@extends('layouts.dashboard')

@section('title')
  Dashboard
@endsection

@section('css')
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('assets/modules/jqvmap/dist/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">
@endsection

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
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
  <!-- JS Libraies -->
  <script src="{{ asset('assets/modules/jquery.sparkline.min.js') }}"></script>
  <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
  <script src="{{ asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
  <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/index.js') }}"></script>
  @if (session()->has('Success'))
    <script>
      iziToast.info({
        title: 'Success',
        message: "{{ session('Success') }} Welcome {{ auth()->user()->name }}",
        position: 'topRight'
      });
      console.log(true);
    </script>
  @endif
@endpush
