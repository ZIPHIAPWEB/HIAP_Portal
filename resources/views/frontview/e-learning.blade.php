<!DOCTYPE html>
<html>

@include('partials._head')

<body>
    @include('partials._navbar')
    <section class="d-flex flex-column justify-content-center align-items-center elearning" style="background-image: url(&quot;assets/img/ELEARNING%20-%20HEADER.jpg&quot;);">
        <div class="container d-xl-flex flex-column justify-content-xl-center align-items-xl-center">
            <h1 class="text-center d-block d-sm-none d-md-none d-lg-none d-xl-none">An innovative<br>learning experience.</h1>
            <h1 class="text-center d-none d-sm-block d-md-block d-lg-block d-xl-block">An innovative learning experience.</h1>
            <h2 class="text-center mb-3">a great platform for learning that's within your reach.</h2>
            <h4 class="text-center">Our e-learning will be available soon.</h4>
        </div>
    </section>
    @include('partials._footer')
    <a id="go-back-button" href="#"><i class="fa fa-angle-up"></i></a><!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v7.0'
    });
  };

  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="733393866846945"
theme_color="#031430">
</div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>
