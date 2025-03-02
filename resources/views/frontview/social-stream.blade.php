<!DOCTYPE html>
<html>

@include('partials._head')

<body>
    @include('partials._navbar')
    <section class="stream-section">
        <div class="container-fluid"><!-- Place <div> tag where you want the feed to appear -->
    <div id="curator-feed-default-layout"><a href="https://curator.io" target="_blank" class="crt-logo crt-tag">Powered by Curator.io</a></div>
    <!-- The Javascript can be moved to the end of the html page before the </body> tag -->
    <script type="text/javascript">
    /* curator-feed-default-layout */
    (function(){
    var i, e, d = document, s = "script";i = d.createElement("script");i.async = 1;
    i.src = "https://cdn.curator.io/published/4bf92a15-f3c4-4c59-8d81-57ab384ab922.js";
    e = d.getElementsByTagName(s)[0];e.parentNode.insertBefore(i, e);
    })();
    </script></div>
    </section><a id="go-back-button" href="#"><i class="fa fa-angle-up"></i></a>
    @include('partials._footer')
    <!-- Load Facebook SDK for JavaScript -->
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