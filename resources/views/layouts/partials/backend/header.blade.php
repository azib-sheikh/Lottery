<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

        </ul>


        {{-- <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul> --}}
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="" class="brand-link ">
            <img src="{{ asset('images/website_logo.png') }}" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Admin Panel</span>
        </a>


        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                <div class="info">
                    <span class="d-block text-white">{{ Auth::user()->name . ' (' . Auth::user()->getRoleNames()[0] . ')' }}</span>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                            {{-- <i class="nav icon fab fa-duotone fa-grid-horizontal"></i> --}}
                            <i class="nav-icon fa-sharp fa-solid fa-chart-line"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="{{ route('admin.users.index') }}" class="nav-link text-white {{-- Route::is('user.index') ? 'active' : '' --}}">
                            <i class="nav-icon fa-regular fa-user"></i>
                            <p>User</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fas fa-dice-d20"></i>
                            <p>Lottery Management</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.lotteryMaster.index') }}" class="nav-link">Lottery Master</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link">Lotteries creation record</a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.lottery.index') }}" class="nav-link">Create Lottery</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item ">
                        <a href="{{ route('admin.transaction.index') }}" class="nav-link text-white {{-- Route::is('admin.transaction.index') ? 'active' : '' --}}">
                            <i class="nav-icon fa-regular fa-user"></i>
                            <p>Transaction</p>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="{{ route('admin.logout') }}" class="nav-link text-white">
                            <i class="nav-icon fa-regular fa-user"></i>
                            <p>Logout</p>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>