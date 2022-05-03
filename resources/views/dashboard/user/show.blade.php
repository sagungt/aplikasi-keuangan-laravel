@extends('layouts.dashboard')

@section('title')
  User Profile
@endsection

@section('css')
@endsection

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>User Profile</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
          <div class="breadcrumb-item">Profile</div>
        </div>
      </div>
      <div class="section-body">
        <h2 class="section-title">Hi, {{ $user->name }}!</h2>
        <p class="section-lead">
          Change information about yourself on this page.
        </p>

        <div class="row mt-sm-4">
          <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
              <div class="profile-widget-header">                     
                <img alt="image" src="{{ asset('assets/img/avatar/avatar-'. (int) $user->id % 5 + 1 .'.png') }}" class="rounded-circle profile-widget-picture">
              </div>
              <div class="profile-widget-description">
                <div class="empty-state" data-height="300">
                  <div class="empty-state-icon">
                    <i class="fas fa-question"></i>
                  </div>
                  <h2>We couldn't find any data</h2>
                  <p class="lead">
                    Please complete your information first
                  </p>
                  <a href="#" class="btn btn-primary mt-4">Complete Account</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
              <form method="post" action="/dashboard/user/{{ encrypt($user->id) }}">
                @method('patch')
                @csrf
                <div class="card-header">
                  <h4>Edit Profile</h4>
                  <div class="card-header-action">
                    <button type="button" class="btn btn-danger btn-icon icon-left" id="deleteUserButton">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                    <button type="button" class="btn btn-secondary btn-icon icon-left" id="makeAsAdminButton">
                      <i class="fa fa-star"></i> Admin
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">                               
                    <div class="form-group col-md-12 col-12">
                      <label>Name</label>
                      <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                      <div class="invalid-feedback">
                        Please fill in the first name
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12 col-12">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" value="{{ old('name', $user->email) }}" required disabled>
                      <div class="invalid-feedback">
                        Please fill in the email
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12 col-12">
                      <label>Current Password</label>
                      <input type="password" name="current_password" class="form-control" required>
                      <div class="invalid-feedback">
                        Please fill
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6 col-12">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>Password Confirmation</label>
                      <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <form action="/dashboard/admin/users/{{ encrypt($user->id) }}/privilege" method="POST" id="make-admin-form">
    @method('patch')
    @csrf
    <p>Make this user as admin.</p>
  </form>
  <form action="/dashboard/admin/users/{{ encrypt($user->id) }}" method="POST" id="delete-form">
    @method('delete')
    @csrf
    <p>Delete this user.</p>
  </form>
@endsection

@push('scripts')
  <script>
  $("#makeAsAdminButton").fireModal({
    center: true,
    title: 'Are you sure ?',
    body: $("#make-admin-form"),
    footerClass: 'bg-whitesmoke',
    autoFocus: false,
    buttons: [
      {
        text: 'Confirm',
        submit: true,
        class: 'btn btn-primary btn-shadow',
        handler: function(modal) {
        }
      }
    ]
  });
  $("#deleteUserButton").fireModal({
    center: true,
    title: 'Are you sure ?',
    body: $("#delete-form"),
    footerClass: 'bg-whitesmoke',
    autoFocus: false,
    buttons: [
      {
        text: 'Confirm',
        submit: true,
        class: 'btn btn-danger btn-shadow',
        handler: function(modal) {
        }
      }
    ]
  });
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
      iziToast.error({
        title: 'Error',
        message: "{{ session('Error') }}",
        position: 'topRight'
      });
    </script>
  @endif
@endpush
