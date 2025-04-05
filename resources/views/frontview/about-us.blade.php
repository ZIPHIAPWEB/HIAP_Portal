<!DOCTYPE html>
<html>

@include('partials._head')

<body>
    @include('partials._navbar')
    <section class="page-header"><img src="{{ asset('assets/images_v2/ABOUT_US_1.png') }}"></section>
    <section class="page-description">
        <div class="container-fluid">
            <div>
                <h1 class="text-center">about us</h1>
                <p class="text-center mb-4">Join us in our mission to raise the bar in professional training through global standards! At the Hospitality Institute of America-Philippines Inc. (HIAP), we are passionate about equipping the Filipino workforce with the skills and knowledge needed to thrive in competitive global industries. Our dynamic learning platform and hands-on programs are designed to enhance your capabilities and pave the way for your future success.
                    <br><br>
Founded in the United States in 2014 and registered with the SEC in the Philippines in 2015, HIAP has established itself as a leading institution for hospitality training. It is recognized for providing industry-acclaimed international certifications, equipping individuals with the skills to excel in various industries and careers. Guided by seasoned academic consultants, HIAP is committed to excellence by cultivating a new generation of highly competent and globally competitive professionals.
<br><br>
Our training institute is a TESDA-accredited TVET institution offering National Certificate II qualifications in the hospitality and tourism sector.
                <div class="d-none row">
                    <div class="col-12 col-lg-3 col-xl-3 d-flex flex-column justify-content-center align-items-center about-item"><img src="assets/img/global.png">
                        <p class="text-center" style="margin: 0;">supplement training based on acceptable global standards<br></p>
                    </div>
                    <div class="col-12 col-lg-3 col-xl-3 d-flex flex-column justify-content-center align-items-center about-item"><img src="assets/img/global-user.png">
                        <p class="text-center" style="margin: 0;">provide programs that promote employability in a global setting<br></p>
                    </div>
                    <div class="col-12 col-lg-3 col-xl-3 d-flex flex-column justify-content-center align-items-center about-item"><img src="assets/img/business.png">
                        <p class="text-center" style="margin: 0;">prepare the Filipino workforce for the challenges they may face in various industries and careers<br></p>
                    </div>
                    <div class="col-12 col-lg-3 col-xl-3 d-flex flex-column justify-content-center align-items-center about-item"><img src="assets/img/search.png">
                        <p class="text-center" style="margin: 0;">&nbsp; &nbsp; &nbsp; &nbsp;<br>provide e-learning programs and hands-on training that helps enhance skills and competency<br></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="about-vision-mission" style="background-image: url({{ asset('assets/images_v2/ABOUT_US_2.png')}});">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-6">
                    <div class="about-item">
                        <h1 class="text-center">Vision</h1>
                        <p class="text-center"><br>
                        We are catalysts for success, empowering students and professionals through world-class training programs. By fostering excellence in local and global job markets, we inspire individuals to make impactful contributions to an ever-evolving employment landscape.
                        <br><br></p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-6">
                    <div class="about-item">
                        <h1 class="text-center">Mission</h1>
                        <p class="text-center"><br>
                        We aspire to be a globally recognized center of excellence, setting the benchmark for professional training. Our goal is to develop individuals who excel in their chosen fields and contribute significantly to industry advancement and innovation locally and internationally.
    <br><br>
                        Let HIAP be your partner in building a brighter, more successful future!
                        <br></p>
                    </div>
                </div>
            </div>
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