@extends('layouts.dashboard')

@section('title')
  All Users
@endsection

@section('css')
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>DataTables</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
          <div class="breadcrumb-item">All Users</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">All Users</h2>
        <p class="section-lead">
          Manage all users information here.
        </p>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>User</h4>
                <div class="card-header-action">
                  <button class="btn btn-primary btn-icon icon-left" id="addUserModal">
                    <i class="fa fa-plus"></i> Add new user
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="usersTable">
                    <thead>                                 
                      <tr>
                        <th class="text-center">
                          #
                        </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      {{-- display data through loop --}}
                      {{-- @foreach ($users as $user)
                        <tr>
                          <td>
                            {{ $loop->index }}
                          </td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ date('m/d/Y H:i:s', strtotime($user->created_at)) }}</td>
                          <td><div class="badge badge-success">Completed</div></td>
                          <td><a href="/dashboard/admin/users/{{ encrypt($user->id) }}" class="btn btn-secondary">Detail</a></td>
                        </tr>
                      @endforeach --}}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <form class="modal-part" id="modal-form-part" method="POST" action="/dashboard/admin/users">
    @method('patch')
    @csrf
    <p>Add new user.</p>
    <div class="form-group">
      <label for="name">Name</label>
      <input
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name') }}"
        type="text"
        name="name"
        id="name"
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
    <div class="form-group">
      <label for="password">Password</label>
      <input
        class="form-control @error('password') is-invalid @enderror"
        type="password"
        name="password"
        id="password"
        required>
      @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label for="password_confirmation">Password Confirmation</label>
      <input
        class="form-control @error('password') is-invalid @enderror"
        type="password"
        name="password_confirmation"
        id="password_confirmation"
        required>
    </div>
  </form>
@endsection

@push('scripts')
  <!-- JS Libraies -->
  <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
  {{-- display data through datatables --}}
  <script>
    $("#addUserModal").fireModal({
      center: true,
      title: 'Add',
      body: $("#modal-form-part"),
      footerClass: 'bg-whitesmoke',
      autoFocus: false,
      buttons: [
        {
          text: 'Login',
          submit: true,
          class: 'btn btn-primary btn-shadow',
          handler: function(modal) {
          }
        }
      ]
    });
    $('#usersTable').dataTable({
      data: {{ Js::from($users) }},
      columnDefs: [
        { sortable: false, targets: [4, 5] }
      ],
      columns: [
        { data: 'id' },
        { data: 'name' },
        { data: 'email' },
        {
          data: 'created_at',
          render: function (data, type, row) {
            const date = new Date(data);
            return date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
          }
        },
        {
          data: 'email',
          render: function (data, type, row) {
            const isComplete = '<div class="badge badge-success my-1">Completed</div>';
            const isVerified = row['email_verified_at']
              ? '<div class="badge badge-primary my-1">Verified</div>'
              : '<div class="badge badge-warning my-1">Unverified</div>';
            const isAdmin = '<div class="badge badge-danger my-1">Admin</div>'
            return isVerified + isComplete + isAdmin;
          }
        },
        {
          data: 'encrypted_id',
          render: function (data, type, row) {
            return `<a class="btn btn-secondary buttons" href="/dashboard/admin/users/${data}">Detail</a>`;
          }
        },
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
  @if ($errors->any())
    <script>
      $("#addUserModal").click();  
    </script>      
  @endif
@endpush
