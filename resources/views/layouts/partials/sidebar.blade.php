<sidebar class="main-sidebar bg-secondary pt-5 fixed-top overflow-auto">
    <ul class="list-unstyled">
    <li>
    <a href="{{ url('/dashboard') }}">Dashboard</a>
      <ul class="list-unstyled">
        <li><a href="{{ url('/enroll') }}">Add student</a></li>
        <li><a href="#">add enrollment</a></li>
      </ul>
    </li>
    <li><a href="#">Cart</a></li>
    <li><a href="#">Fee structure</a></li>
    <li><a href="#">Tutorials</a></li>
    <li><a href="#">My Account</a></li>
    <li><a href="{{ url('/logout') }}">Logout</a></li>
    </ul>
 </sidebar>