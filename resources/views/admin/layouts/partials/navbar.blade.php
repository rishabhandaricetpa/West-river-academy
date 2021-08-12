<!-- Navbar -->

<nav id="admin-header"
    class="collapse-nav main-header navbar navbar-expand navbar-white navbar-light ml-auto border-0 bg-blue p-0 d-lg-flex justify-content-between main-nav_header align-items-center">
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
        <li class="mr-3">
          <div class="input-group search-form position-relative" id="adv-search">
            <button type="button" class="btn search-icon p-0 bg-white position-absolute">
              <i class="fas fa-search"></i>
            </button>
            <input type="text" class="form-control pl-4" placeholder="Search" />
            <div class="input-group-btn position-absolute">
                <div class="btn-group" role="group">
                    <div class="dropdown dropdown-lg"> 
                        <button type="button" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <form class="form-horizontal" role="form">
                              <div class="form-group">
                                <label for="filter">First Name</label>
                                <input class="form-control" type="text" />
                              </div>
                              <div class="form-group">
                                <label for="contain">Last Name</label>
                                <input class="form-control" type="text" />
                              </div>
                              <div class="form-group">
                                <label for="contain">Enrollment start date</label>
                                <input class="form-control" type="text" />
                              </div>
                              <div class="form-group">
                                <label for="contain">Email</label>
                                <input class="form-control" type="email" />
                              </div>
                              <div class="form-group">
                                <label for="contain">Status</label>
                                <input class="form-control" type="text" />
                              </div>
                              <div class="form-group">
                                <label for="contain">Country</label>
                                <input class="form-control" type="text" />
                              </div>
                              <div class="form-group">
                                <label for="contain">Student Birth Date</label>
                                <input class="form-control" type="text" />
                              </div>
                              <div class="form-group">
                                <label for="contain">Student Grade</label>
                                <input class="form-control" type="text" />
                              </div>
                              <div class="form-group">
                                <label for="contain">Referred By</label>
                                <input class="form-control" type="text" />
                              </div>
                              <div class="form-group pt-3">   
                                <button class="btn" type="submit"> Clear Filters</button>
                                <button class="btn btn-primary" type="submit"> Search</button>
                              </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
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
