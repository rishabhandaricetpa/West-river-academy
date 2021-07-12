<sidebar class="main-sidebar bg-secondary pt-5 fixed-top">
    <ul class="list-unstyled">
        <li>
            <a href="{{ url('/dashboard') }}"><span>Dashboard </span><i class="fas fa-2x fa-tachometer-alt"></i></a>
            <ul class="list-unstyled">
                <li><a href="{{ url('/enroll-student') }}"><span>Enroll</span><i class="fas fa-2x fa-edit"></i></a></li>
                <li><a href="{{ url('/reviewstudents') }}"><span>View Students</span><i class="fa-2x fas fa-eye"></i></a></li>
                <li><a href="{{route('transferSchoolRecord')}}"><span>Record Transfer</span><i class="fa-2x nav-icon fas fa-exchange-alt"></i></a></li>
            </ul>
        </li>
        @if(getcartval()>0)
            <li><a href="{{ url('/cart') }}"><span> Cart {{getcartval()}}</span><i class="fas fa-2x fa-shopping-cart"></i></a></li>
        @else
            <li><a href="{{ url('/cart') }}"><span>Cart</span><i class="fas fa-2x fa-shopping-cart"></i></a></li>
        @endif
        <li><a href="{{ route('enrolled.students') }}"><span>Transcript Wizard</span><i class="fa-2x nav-icon fas fa-scroll"></i></a></li>
        <li><a href="{{url('/fees')}}"><span>Fees & Services</span><i class="fa-2x nav-icon fas fa-dollar-sign"></i></a></li>
        <li><a href="{{route('video.tutorials')}}"><span>Our Library</span><i class="fa-2x fas fa-book-reader"></i></a></li>
        <li><a href="{{url('social/media')}}"><span>Join our Community</span><i class="fa-2x fas fa-users"></i></a></li>
        <li><a href="{{route('mysetting')}}"><span>My Account</span> <i class="fas fa-2x fa-user-circle"></i></a></li>
        <li><a href="{{ url('/logout') }}"><span>Log Out</span><i class="fas fa-2x fa-sign-out-alt"></i></a></li>
    </ul>
</sidebar>
