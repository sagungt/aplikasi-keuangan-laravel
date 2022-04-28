<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="/dashboard">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="/dashboard">St</a>
    </div>

    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="active">
        <a class="nav-link" href="#">
          <i class="fas fa-fire"></i><span>Dashboard</span>
        </a>
      </li>

      <li class="menu-header">Fitur</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
          <i class="fas fa-hand-holding-usd"></i><span>Pinjaman</span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="nav-link" href="#">Pengajuan Pinjaman</a>
          </li>
          <li>
            <a class="nav-link" href="#">Data Pinjaman</a>
          </li>
        </ul>
      </li>

      <li class="menu-header">User's Panel</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown">
          <i class="fas fa-user"></i><span>User</span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="nav-link" href="#">User Profile</a>
          </li>
          <li>
            <a class="nav-link" href="#">Data Pribadi</a>
          </li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown">
          <i class="fas fa-user-cog"></i><span>Admin</span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="nav-link" href="#">User Profile</a>
          </li>
          <li>
            <a class="nav-link" href="#">Data Pribadi</a>
          </li>
        </ul>
      </li>

      <li class="menu-header">Tools</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown">
          <i class="far fa-file-alt"></i> <span>Export/Import</span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="nav-link" href="#">Export</a>
          </li>
          <li>
            <a class="nav-link" href="#">Import</a>
          </li>
        </ul>
      </li>
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <form action="/logout" method="post">
        @csrf
        <button type="submit" class="btn btn-primary btn-lg btn-block btn-icon-split">
          <i class="fas fa-sign-out-alt"></i> Logout
        </button>
      </form>
    </div>
  </aside>
</div>