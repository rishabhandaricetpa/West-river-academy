<sidebar class="main-sidebar bg-secondary pt-5 fixed-top">
    <ul class="list-unstyled">
    <li>
    <a href="{{ url('/dashboard') }}"><span>Dashboard </span><i class="fas fa-2x fa-tachometer-alt"></i></a>
      <ul class="list-unstyled">
        <li><a href="#"><span>Add student</span><i class="fas fa-2x fa-user-graduate"></i></a></li>
        <li><a href="{{ url('/enroll-student') }}"><span>add enrollment</span><i class="fas fa-2x fa-edit"></i></a></li>
        <li><a href="{{ url('/reviewstudents') }}"><span>View Students</span><i class="fas fa-2x fa-user-graduate"></i></a></li>
      </ul>
    </li>
    <li><a href="{{ url('/cart') }}"><span>Cart</span><i class="fas fa-2x fa-shopping-cart"></i></a></li>
    <li><a href="#"><span>Fee structure</span><i class="fas fa-2x fa-dollar-sign"></i></a></li>
    <li><a href="#"><span>Tutorials</span><i class="fas fa-2x fa-book-open"></i></a></li>
    <li><a href="{{ url('/mysettings') }}"><span>My Account</span> <i class="fas fa-2x fa-user-circle"></i></a></li>
    <li><a href="{{ url('/logout') }}"><span>Logout</span><i class="fas fa-2x fa-sign-out-alt"></i></a></li>
    </ul>
 </sidebar>
