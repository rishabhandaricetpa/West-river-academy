<footer class="bg-dark position-relative text-center main-footer">
  <div class="container">
    <ul class="social-icons list-unstyled d-flex justify-content-center">
      <li><a href="#" class="mx-2"><i class="fab fa-facebook"></i></a></li>
      <li><a href="#" class="mx-2"><i class="fab fa-twitter"></i></a></li>
      <li><a href="#" class="mx-2"><i class="fab fa-pinterest"></i></a></li>
      <li><a href="#" class="mx-2"><i class="fab fa-linkedin"></i></a></li>
      <li><a href="#" class="mx-2"><i class="fab fa-instagram-square"></i></a></li>
    </ul>
    <a href="#" role="button" class="btn btn-secondary text-uppercase mt-4 mb-3">contact us</a>
    <ul class="list-unstyled">
      <li><a href=""><i class="fas fa-phone-alt mr-2"></i>949 - 492 - 5240</a></li>
      <li><a href="#"><i class="fas fa-envelope mr-2"></i>contact@westriveracademy.com</a></li>
    </ul>
    <div class="copyright">
      Copyright © 2020 West River Academy.
      <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.
      <a href="#" class="d-block">Website design, development and maintenance by eXcelisys, Inc.</a>
    </div>
  </div>
</footer>
</div>

<!-- Footer scripts -->

@stack('select2_script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/app.js" async></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() { 
		$("#country").select2({
			
		}); 
	});
  </script>
@stack('before_vendor_scripts')
<!-- <script defer src="{{ mix('js/manifest.js') }}"></script> -->
@stack('after_vendor_scripts')
@stack('before_app_scripts')
<!-- <script defer async src="{{ mix('js/app.js') }}"></script> -->
@stack('after_app_scripts')