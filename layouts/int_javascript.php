<script type="text/javascript">
		window.onload = function () {
			document.getElementById("password1").onchange = validatePassword;
			document.getElementById("password2").onchange = validatePassword;
		}
		function validatePassword(){
			var pass2=document.getElementById("password2").value;
			var pass1=document.getElementById("password1").value;
			if(pass1!=pass2)
				document.getElementById("password2").setCustomValidity("Passwords Don't Match");
			else
				document.getElementById("password2").setCustomValidity('');
		}
	</script>
<script type="text/javascript" src="public/site/js/jquery-2.1.4.min.js"></script>
<script src="public/site/js/waypoints.min.js"></script> 
<script src="public/site/js/counterup.min.js"></script> 
<script>
	jQuery(document).ready(function( $ ) {
		$('.counter').counterUp({
			delay: 10,
			time: 1000 
		});
	});
</script>
<link rel="stylesheet" href="public/site/css/jquery-ui.css" />
	<script src="public/site/js/jquery-ui.js"></script>
	<script>
		$(function() {
			$( "#datepicker,#datepicker1" ).datepicker();
		});
	</script>
<script src="public/site/js/poposlides.js"></script>
	<script>
		$(".slides").poposlides();
	</script>
		<script src="public/site/js/jquery.magnific-popup.js" type="text/javascript"></script>
		<script>
			$(document).ready(function() {
				$('.popup-with-zoom-anim').magnificPopup({
					type: 'inline',
					fixedContentPos: false,
					fixedBgPos: true,
					overflowY: 'auto',
					closeBtnInside: true,
					preloader: false,
					midClick: true,
					removalDelay: 300,
					mainClass: 'my-mfp-zoom-in'
				});														
			});
		</script>
	<script src="public/site/js/owl.carousel.js"></script>
	<script>
		$(document).ready(function () {
			$("#owl-demo2").owlCarousel({
				items: 1,
				lazyLoad: false,
				autoPlay: true,
				navigation: false,
				navigationText: false,
				pagination: true,
			});
		});
	</script>
<script src="public/site/js/SmoothScroll.min.js"></script>
<script type="text/javascript" src="public/site/js/move-top.js"></script>
	<script type="text/javascript" src="public/site/js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			});
	</script>
	<script src="public/site/js/bootstrap.js"></script>