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
        <h1>Export/Import</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
          <div class="breadcrumb-item">Export/Import</div>
        </div>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12 col-md-6 col-lg-6">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Export</h4>
              </div>
              <div class="card-body">
                <div class="dropdown d-inline d-flex justify-content-between align-items-center mb-2">
                  <h6>Users</h6>
                  <div>
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Export
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">XLSX</a>
                      <a class="dropdown-item" href="#">CSV</a>
                    </div>
                  </div>
                </div>
                <div class="dropdown d-inline d-flex justify-content-between align-items-center mb-2">
                  <h6>Loans</h6>
                  <div>
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Export
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">XLSX</a>
                      <a class="dropdown-item" href="#">CSV</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-6">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Import</h4>
              </div>
              <div class="card-body">
                <div class="section-title">Users</div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="usersFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel">
                  <label class="custom-file-label" for="usersFile">Choose file</label>
                </div>
                <div class="section-title">Loans</div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="loansFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel">
                  <label class="custom-file-label" for="loansFile">Choose file</label>
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
