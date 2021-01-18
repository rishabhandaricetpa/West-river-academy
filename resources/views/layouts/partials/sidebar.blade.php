<sidebar class="main-sidebar bg-secondary pt-5 fixed-top overflow-auto">
    <ul class="list-unstyled">
    <li>
    <a href="{{ url('/dashboard') }}">Dashboard</a>
      <ul class="list-unstyled">
        <li><a href="{{ url('/enroll-student') }}">Enroll Student</a></li>
        <li><a href="{{ url('/reviewstudents') }}">Review Students</a></li>
      </ul>
    </li>
    <li><a href="{{ url('/cart') }}">Cart</a></li>
    <li><a href="#">Fees And Services</a></li>
    <li><a href="#">Support Videos</a></li>
    <li><a href="{{ url('/mysettings', Auth::user()->id)}}">My Account</a></li>
    <li><a href="{{ url('/logout') }}">Logout</a></li>
    </ul>
 </sidebar>
