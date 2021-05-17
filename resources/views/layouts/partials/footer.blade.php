</body>
@routes
@include('layouts.partials.scripts')
@yield('manualscript')
<footer class="bg-dark position-relative text-center main-footer">
    <div class="container">
        <ul class="social-icons list-unstyled d-flex justify-content-center">
            <li><a href="https://www.facebook.com/WestRiverAcademy" target="_blank" class="mx-2"> <img src="/images/Facebook.png" class="o-contain" alt="facebook" /> </a></li>
            <li><a href="https://www.westriveracademy.com/blog/" target="_blank" class="mx-2"><img src="/images/Blog.png" class="o-contain" alt="blog" /></a></li>
            <li><a href="https://www.instagram.com/west.river.academy/" target="_blank" class="mx-2"><img src="/images/Instagram.png" class="o-contain" alt="Instagram" /></a></li>
            <li><a href="https://mewe.com/i/westriveracademy" target="_blank" class="mx-2"><img src="/images/MeWe.png" class="o-contain" alt="MeWe" /></a></li>
            <li><a href="https://www.pinterest.com/west_river/" target="_blank" class="mx-2"><img src="/images/Pinterest.png" class="o-contain" alt="Pinterest" /></a></li>
        </ul>
        <a href="#" role="button" class="btn btn-secondary text-uppercase mt-4 mb-3">contact us</a>
        <ul class="list-unstyled">
            <li><a href="tel:9494568753" class="contact-phone"><i class="fas fa-phone-alt mr-2"></i>949-456-8753</a></li>
            <li><a href="#"><i class="fas fa-envelope mr-2"></i>contact@westriveracademy.com</a></li>
        </ul>
        <div class="copyright">
            Copyright © {{ now()->year }} West River Academy.
            <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.
            <a href="https://www.ithands.com" target="_blank" class="d-block">Website design, development and maintenance by IT Hands</a>
        </div>
    </div>
</footer>
</div>
</html>
<!-- Footer scripts -->
