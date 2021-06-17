<div class="d-flex justify-content-between main-nav_header align-items-center">
    <ul class="d-flex overflow-scroll">
      <li class="menu-item"><a href="{{ route('admin.dashboard.notification') }}">Dashboard</a></li>
      <li class="menu-item"><a class="active" href="{{ url('admin/view') }}">Family</a></li>
      <li class="menu-item"><a href="{{ url('admin/view-student') }}">Student</a></li>
      <li class="menu-item"><a href="#">Representative</a></li>
      <li class="menu-item"><a href="#">Groups</a></li>
      <li class="menu-item"><a href="#" data-toggle="modal"
        data-target="#studentsDetailsModal" data-whatever="@getbootstrap"><img src="/images/add.png" alt=""></a></li>
    </ul>
    <ul class="d-flex">
      <li><img src="/images/search.png" alt="login"></li>
      <li><img src="/images/bell.png" alt="login"></li>
      <li><a onclick="goBack()"> <img src="/images/login.png" alt="login"></a>
      </li>
    </ul>
  </div>

  