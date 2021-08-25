<!-- Navbar -->
<nav id="admin-header"
    class="collapse-nav main-header navbar navbar-expand navbar-white navbar-light ml-auto border-0 bg-blue p-0 d-lg-flex justify-content-between main-nav_header align-items-center">
    <!-- Left navbar links -->

    <ul class="d-flex overflow-scroll align-items-center">
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
        <img src="/images/wra_logo.svg" class="site-logo d-lg-none d-block p-1" alt="wra_logo">
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
                @csrf
                <div class="btn-group" role="group">
                    <div class="dropdown dropdown-lg"> 
                        <button type="button" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <form class="form-horizontal" role="form" autocomplete="off" action="{{ route('admin.view.parent') }}">
                              <div class="form-group">
                                <label for="filter">First Name</label>
                                <input class="form-control" type="text" name="first_name" value="{{ Request::get('first_name') ?? ''}}"/>
                              </div>
                              <div class="form-group">
                                <label for="contain">Last Name</label>
                                <input class="form-control" type="text" name="last_name" value="{{ Request::get('last_name') ?? ''}}"/>
                              </div>
                              <div class="form-group">
                                <label for="contain">Enrollment Start Date</label>
                                <input class="form-control datepicker" type="text" id="enroll_date" name="enroll_date" value="{{ Request::get('enroll_date') ?? ''}}"/>
                              </div>
                              <div class="form-group">
                                <label for="contain">Email</label>
                                <input class="form-control" type="email" name="email" value="{{ Request::get('email') ?? ''}}"/>
                              </div>
                              <div class="form-group">
                                <label for="contain">Status</label>
                                <select class="form-controll" name="status">
                                    @php statusDropdown(Request::get('status')) @endphp
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="contain">Country</label>
                                <select class="form-control" id="fill-countries" name="country" value="{{ Request::get('country') ?? ''}}">
                                  <option></option>
                                </select>
                                <div id="suggesstion-box"></div>
                              </div>
                              <div class="form-group">
                                <label for="contain">Student Birth Date</label>
                                <input class="form-control datepicker" type="text" name="dob"  value="{{ Request::get('dob') ?? ''}}"/>
                              </div>
                              <div class="form-group">
                                <label for="contain">Student Grade</label>
                                <select name="grade" class="form-control" id="student_grade">
                                  <option value="">Select Grade</option>
                                  @php studentGradeDropdown(Request::get('grade')) @endphp
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="contain">Referred By</label>
                                <input class="form-control" type="text" name="refered_by" value="{{ Request::get('refered_by') ?? ''}}"/>
                              </div>
                              <div class="form-group pt-3">   
                                <a href="{{ route('admin.view.parent') }} " class="btn" > Clear Filters</a>
                                <button class="btn btn-primary" type="submit"> Search</button>
                              </div>
                            </form>
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
