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
      <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
          <i class="fas fa-fire"></i><span>Dashboard</span>
        </a>
      </li>

      @cannot('admin')
        <li class="menu-header">Feature</li>
        <li class="dropdown {{ Request::is('dashboard/loan', 'dashboard/loan/*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-hand-holding-usd"></i><span>Loan</span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="nav-link" href="/dashboard/loan">Request Loan</a>
            </li>
            <li>
              <a class="nav-link" href="/dashboard/loan/all">Loan Data</a>
            </li>
          </ul>
        </li>
      @endcannot

      <li class="menu-header">User's Panel</li>
      <li class="dropdown {{ Request::is('dashboard/user/*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown">
          <i class="fas fa-user"></i><span>User</span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="nav-link" href="/dashboard/user/{{ encrypt($user->id) }}">User Profile</a>
          </li>
          <li>
            <a class="nav-link" href="/dashboard/user/private">Personal Data</a>
          </li>
          <li>
            <a class="nav-link" href="/dashboard/user/private">Fiancial Data</a>
          </li>
        </ul>
      </li>
      @can('admin')
        <li class="dropdown {{ Request::is('dashboard/admin', 'dashboard/admin/*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-user-cog"></i><span>Admin</span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="nav-link" href="/dashboard/admin/users">All User List</a>
            </li>
            <li>
              <a class="nav-link" href="/dashboard/admin/loans">All Loan List</a>
            </li>
          </ul>
        </li>
      @endcan

      @can('admin')
        <li class="menu-header">Tools</li>
        <li class="{{ Request::is('dashboard/export-import') ? 'active' : '' }}">
          <a class="nav-link" href="/dashboard/export-import">
            <i class="fas fa-file-alt"></i><span>Export/Import</span>
          </a>
        </li>
      @endcan
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <form action="/logout" method="post">
        @csrf
        <button type="submit" class="btn btn-primary btn-lg btn-block btn-icon-split">
          <i class="fas fa-sign-out-alt"></i>Logout
        </button>
      </form>
    </div>
  </aside>
</div>