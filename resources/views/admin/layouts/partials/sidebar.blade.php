<!-- Main Sidebar Container -->
<aside class="main-sidebar  admin-sidebar">
  <!-- Brand Logo -->

  <img src="/images/wra_logo.svg" alt="wra_logo">
  </a>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      <li class="nav-item menu">
      <li class="nav-item">
        <a href="{{route('admin.dashboard.notification')}}" class="nav-link">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <a href="" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Parent Profile
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url('admin/view')}}" class="nav-link">
            <i class="nav-icon fas fa-eye"></i>
            <p>View Parents </p>
          </a>
        </li>

        </li>

      </ul>
      </li>
      <li class="nav-item menu">
        <a href="" class="nav-link ">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Students
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('admin/view-student')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                View Students
              </p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item menu">
        <a href="" class="nav-link ">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Payments
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('admin.payments')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                View Payments
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.custom.payments')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Custom
              </p>
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
      <li class="nav-item menu">
        <a href="" class="nav-link ">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Transcripts
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('admin/view/transcript') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                View Transcript
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/manage-courses')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Manage Course</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.view.coupon') }}" class="nav-link">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            Coupons
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.view.graduation') }}" class="nav-link">
          <i class="nav-icon fas fa-user-graduate"></i>
          <p>
            Graduations
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/countryenrollments')}}" class="nav-link">
          <i class="nav-icon fas fa-database"></i>
          <p>
            Country Data
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('admin/fees-services')}}" class="nav-link">
          <i class="nav-icon fas fa-dollar-sign"></i>
          <p>
            Fees
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.record.request') }}" class="nav-link">
          <i class="nav-icon fas fa-exchange-alt"></i>
          <p>
            Record Transfer
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.logout')}}" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>
            Logout
          </p>
        </a>
      </li>
  </nav>
  <!-- /.sidebar-menu -->
  </ul>
  </li>
  </div>
</aside>