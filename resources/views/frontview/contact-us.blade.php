<!DOCTYPE html>
<html>

@include('partials._head')

<body>
    @include('partials._navbar')
    <section class="page-header"><img src="assets/img/CONTACT%20-%20HEADER%202.jpg"></section>
    <section class="page-description">
        <div class="container">
            <div>
                <h1 class="text-center">hospitality institute of america-philippines inc.</h1>
                <p class="text-center" style="font-size: 25px;"><strong>BE OUR LEARNER TODAY. GET IN TOUCH WITH US.</strong></p>
                <ul class="list-unstyled text-center text-lg-left text-xl-left contact-list">
                    <li><i class="fa fa-clock-o"></i><span>Monday to Friday | 8:00 AM - 5:00 PM</span></li>
                    <li><i class="fa fa-map-o"></i><span>2/F University Center Bldg., 1985 C.M. Recto Avenue Zone 041 Brgy. 395 Sampaloc Manila</span></li>
                    <li><i class="fa fa-phone"></i><span>02 83679392 | 0939 201 9198 | 0917 522 8213</span></li>
                    <li><i class="fa fa-envelope-o"></i><span>info@hospitalityinstituteofamerica.com.ph</span></li>
                    <li><i class="fa fa-facebook-official"></i><span>Hospitality Insitute of America - Philippines Inc.</span></li>
                    <li><i class="fa fa-instagram"></i><span>Hiap Inc.</span></li>
                    <li><i class="fa fa-linkedin"></i><span>Hospitality Institute of America-Philippines Inc.</span></li>

                </ul>
            </div>
        </div>
    </section>
    <section><div id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
    <div id="map-9cd199b9cc5410cd3b1ad21cab2e54d3"></div><script>(function () {
    var setting = {"height":700,"width":1920,"zoom":18,"queryString":"Hospitality Institute of America, Recto Avenue, Sampaloc, Quezon City, Metro Manila, Philippines","place_id":"ChIJ6TUsffjJlzMRPUidtLDLqGw","satellite":false,"centerCoord":[14.60197080413708,120.9879121],"cid":"0x6ca8cbb0b49d483d","lang":"en","cityUrl":"/philippines/manila","cityAnchorText":"Map of Manila, Luzon, Philippines","id":"map-9cd199b9cc5410cd3b1ad21cab2e54d3","embed_id":"200658"};
    var d = document;
    var s = d.createElement('script');
    s.src = 'https://embedgooglemap.1map.com/js/script-for-user.js?embed_id=200658';
    s.async = true;
    s.onload = function (e) {
      window.OneMap.initMap(setting)
    };
    var to = d.getElementsByTagName('script')[0];
    to.parentNode.insertBefore(s, to);
  })();</script><a href="https://embedgooglemap.1map.com">1 Map</a></div></section>
    <section class="contact-form">
        <div class="container-fluid">
            <h1 class="text-center">For inquiries, reach us through this form:</h1>
            <form id="contact-form">
                <div class="form-row">
                    @csrf()
                    <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group"><label>Name (required):</label><input id="full-name" name="full_name" class="form-control form-control" type="text" required></div>
                    </div>
                    <div class="col-lg-4 col-xl-4">
                        <div class="form-group"><label>Mobile Number (required):</label><input id="mobile-number" name="mobile_number" class="form-control form-control" type="text" required></div>
                    </div>
                    <div class="col-12 col-lg-4 col-xl-4">
                        <div class="form-group"><label>E-mail (required):</label><input id="email" name="email" class="form-control form-control" type="text" required></div>
                    </div>
                    <div class="col-12">
                        <div class="form-group"><label>Message (required):</label><textarea id="message" name="message" class="form-control form-control" rows="10" required></textarea></div>
                    </div>
                    <div class="col-12 col-lg-2 col-xl-2">
                        <button class="btn btn-primary btn-block" type="submit" style="border: 0;">
                            Send
                            <br>
                            <small style="display: none;" id="button-message"><i>We’ll get to you as soon as we can</i></small>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="tagline" style="background-image: url(&quot;assets/img/footer_image.jpg&quot;);background-position: center;background-size: cover;">
        <div class="container-fluid d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center h-100">
            <h1 class="text-center d-none d-sm-none d-md-block d-lg-block d-xl-block">
                Study today, excel tomorrow. <br>
                Do it the HIAP way.
            </h1>
            <h1 class="text-center d-block d-sm-block d-md-none d-lg-none d-xl-none">
                Study today,<br>excel tomorrow. <br>
                Do it the HIAP way.
            </h1>
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
    <script>
        $('#contact-form').submit(function (e) {
            e.preventDefault();
            var data = new FormData();
        
            let csrfs = document.querySelectorAll('input[name=_token]');
            data.append(csrfs[0].name, csrfs[0].value);

            data.append('full_name', $('#full-name').val())
            data.append('mobile_number', $('#mobile-number').val())
            data.append('email', $('#email').val())
            data.append('message', $('#message').val())
            
            fetch('/sendInquiry', { method: 'post', body: data})
                .then(function (response) {
                    // The API call was successful!
                    alert('Thank you for your  inquiry. We’ll get to you as soon as we can.');
                    console.log('success!', response);
                }).catch(function (err) {
                    // There was an error
                    console.warn('Something went wrong.', err);
                });
        });
    </script>
</body>
</html>