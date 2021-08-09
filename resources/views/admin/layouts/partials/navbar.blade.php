<!-- Navbar -->

<nav id="admin-header"
    class="collapse-nav main-header navbar navbar-expand navbar-white navbar-light ml-auto border-0 bg-blue p-0 d-flex justify-content-between main-nav_header align-items-center">
    <!-- Left navbar links -->

    <ul class="d-flex overflow-scroll">
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                        class="fas fa-bars text-white"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link"></a>
            </li>

        </ul>
        <img src="/images/wra_logo.svg" class="site-logo d-lg-none d-block" alt="wra_logo">
        <li class="menu-item"><a href="{{ route('admin.dashboard.notification') }}">Dashboard</a></li>
        <li class="menu-item"><a href="{{ route('admin.view.parent') }}">Family</a></li>
        <li class="menu-item"><a href="{{ url('admin/view-student') }}">Student</a></li>
        <li class="menu-item"><a href="{{ route('admin.replist') }}">Representative</a></li>
        <li class="menu-item"><a href="#">Groups</a></li>
    </ul>
    <ul class="d-flex">
        <li><img src="/images/search.png" alt="login"></li>
        <li>

            <div id="notification-container" class="admin-notification-container">
                <div class="notification-wrap position-relative">
                    <button type="button" class="text-white bg-transparent border-0 px-0">
                        <i class="fas fa-bell fa-2x nofification-alert"></i>
                    </button>
                    <div class="notification admin-notification d-block">
                        <ul class="list-unstyled">
                            <li class="border-bottom mb-3 pb-3">
                                <span class="remove  place-top">
                                    <i class="fas fa-times"></i>
                                </span>
                                <p>Pay Amount : 375</p>
                                <p>Pay Amount 12: 375</p>
                                <a href="http://127.0.0.1:8000/cart" class="btn btn-primary">Go To Cart</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </li>
        <li><a href="#"> <img src="/images/login.png" alt="login"></a>
        </li>
    </ul>

    <!-- SEARCH FORM -->

    <!-- Right navbar links -->
    {{-- <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->

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
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul> --}}
</nav>
<!-- /.navbar -->
