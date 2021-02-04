<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('admin.admindashboard')}}" class="brand-link">
    <span class="brand-text font-weight-light"> Welcome Admin</span>
  </a>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      <li class="nav-item menu-open">
        <a href="" {{ url('/dashboard') }}"" class="nav-link active">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Parent Profile
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('admin/view')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>View Parent</p>
            </a>
          </li>

      </li>
      <li class="nav-item menu-open">
        <a href="" {{ url('/dashboard') }}"" class="nav-link ">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Payments
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('admin/view-student')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>View Payment</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/payment-address')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Change Address</p>
            </a>
          </li>

            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/countryenrollments')}}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Country Enrollments
              </p>
            </a>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
        </ul>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/view-student')}}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>View Student</p>
        </a>
      </li>

    </ul>
    </li>
    <li class="nav-item">
      <a href="{{route('admin.payments')}}" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Student Payment
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
          Fee Structure
        </p>
      </a>

    </li>
    <li class="nav-item">
      <a href="{{route('admin.logout')}}" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
          Logout
        </p>
      </a>
    </li>
  </nav>
  <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>