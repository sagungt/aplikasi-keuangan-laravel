@extends('layouts.dashboard')

@section('title')
  Export/Import
@endsection

@section('css')
@endsection

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Blank Page</h1>
      </div>

      <div class="section-body">
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
  @elseif (session()->has('Error'))
    <script>
      iziToast.error({
        title: 'Error',
        message: "{{ session('Error') }}",
        position: 'topRight'
      });
    </script>
  @endif
@endpush
