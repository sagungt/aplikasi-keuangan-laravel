<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      <img alt="image" src="{{ asset('assets/img/avatar/avatar-'. (int) $user->id % 5 + 1 .'.png') }}" class="rounded-circle mr-1">
      <div class="d-sm-none d-lg-inline-block">Hi, {{ $user->name }}</div></a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-title d-lg-none">Hi, {{ $user->name }}</div>
        <a href="/dashboard/user/{{ encrypt($user->id) }}" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profile
        </a>
        <a href="#" class="dropdown-item has-icon">
          <i class="fas fa-user-shield"></i> Private Information
        </a>
        <div class="dropdown-divider"></div>
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="dropdown-item has-icon text-danger">
            <div style="cursor: pointer;"><i style="margin: 7px 7px 7px 0;" class="fas fa-sign-out-alt"></i> Logout</div>
          </button>
        </form>
      </div>
    </li>
  </ul>
</nav>