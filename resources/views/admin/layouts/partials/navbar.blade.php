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
                    <button id="button-notification" type="button" class="text-white bg-transparent border-0 px-0">
                        <i class="fas fa-bell fa-2x nofification-alert"></i>
                    </button>
                    <div id="notification-items" class="notification admin-notification display-none">
                        <ul id="notifiy-list" class="list-unstyled">

                        </ul>
                    </div>
                </div>
            </div>
        </li>
        <li><a href="#"> <img src="/images/login.png" alt="login"></a>
        </li>
    </ul>
</nav>
