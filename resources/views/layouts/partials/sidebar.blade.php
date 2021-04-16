<sidebar class="main-sidebar bg-secondary pt-5 fixed-top">
    <ul class="list-unstyled">
        <li>
            <a href="{{ url('/dashboard') }}"><span>Dashboard </span><i class="fas fa-2x fa-tachometer-alt"></i></a>
            <ul class="list-unstyled">
                <li><a href="{{ url('/enroll-student') }}"><span>Enroll</span><i class="fas fa-2x fa-edit"></i></a></li>
                <li><a href="{{ url('/reviewstudents') }}"><span>View Students</span><i class="fas fa-2x fa-user-graduate"></i></a></li>
                <li><a href="{{route('transferSchoolRecord')}}"><span>Record Transfer</span><i class="fas fa-2x fa-user-graduate"></i></a></li>
            </ul>
        </li>
        <li><a href="{{ url('/cart') }}"><span>Cart</span><i class="fas fa-2x fa-shopping-cart"></i></a></li>
        <li><a href="{{route('all.students')}}"><span>Transcript Wizard</span><i class="fas fa-2x fa-shopping-cart"></i></a></li>
        <li><a href="{{url('/fees')}}"><span>Fees & Services</span><i class="fas fa-2x fa-dollar-sign"></i></a></li>
        <li><a href="{{route('video.tutorials')}}"><span>Our Library</span><i class="fas fa-2x fa-book-open"></i></a></li>
        <li><a href="#"><span>Join our Community</span><i class="fas fa-2x fa-book-open"></i></a></li>
        <li><a href="{{route('mysetting')}}"><span>My Account</span> <i class="fas fa-2x fa-user-circle"></i></a></li>
        <li><a href="{{ url('/logout') }}"><span>Log Out</span><i class="fas fa-2x fa-sign-out-alt"></i></a></li>
    </ul>
</sidebar>
