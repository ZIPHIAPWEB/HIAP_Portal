<!DOCTYPE html>
<html>

@include('partials._head')

<body>
    @include('partials._navbar')
    <div class="carousel slide" data-ride="carousel" id="carousel-1">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <div class="d-flex justify-content-center align-items-center header-content">
                    <img src="{{ asset('assets/images_v2/HEADER_1.png') }}">
                    <div class="header-title">
                        <h1 class="text-center">INTERNATIONALLY RECOGNIZED PROGRAMS AND CERTIFICATION</h1>
                        <h2 class="text-center" style="font-size: 27px; padding-top: 3px;">Globally recognized certifications that enhance employability and credibility in the hospitality industry.</h2>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="header-content">
                    <img src="{{ asset('assets/images_v2/HEADER_2.png') }}">
                    <div class="header-title">
                        <h1>CUSTOMIZED TRAINING PROGRAMS</h1>
                        <h2 class="text-center" style="font-size: 27px; padding-top: 3px;">Curated programs designed to meet specific needs and improve employee performance and guest satisfaction, in line with academic and industry standards.<br></h2>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="header-content">
                    <img src="{{ asset('assets/images_v2/HEADER_3.png') }}">
                    <div class="header-title">
                        <h1>COST-EFFECTIVE AND ACCESSIBLE</h1>
                        <h2 class="text-center" style="font-size: 27px; padding-top: 3px;">Affordable fees make programs accessible to students, working professionals, and career switchers, offering excellent value for high-quality training.</h2>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="header-content">
                    <img src="{{ asset('assets/images_v2/HEADER_4.png') }}">
                    <div class="header-title">
                        <h1>INDUSTRY-RELEVANT AND EXPERT-LED TRAINING</h1>
                        <h2 class="text-center" style="font-size: 27px; padding-top: 3px;">Programs designed to meet the demands of the global hospitality industry, delivered by certified trainers and experienced professionals.</h2>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="header-content">
                    <img src="{{ asset('assets/images_v2/HEADER_5.png') }}">
                    <div class="header-title">
                        <h1><strong>FLEXIBLE LEARNING OPTIONS</strong><br></h1>
                        <h2 class="text-center" style="font-size: 27px; padding-top: 3px;">Offering face-to-face, blended, and online delivery to accommodate diverse schedules, meet credit requirements, and support learners' goals.</h2>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="header-content">
                    <img src="{{ asset('assets/images_v2/HEADER_6.png') }}">
                    <div class="header-title">
                        <h1><strong>CAREER LINKAGES AND OPPORTUNITIES</strong><br></h1>
                        <h2 class="text-center" style="font-size: 27px; padding-top: 3px;">Empowering learners by connecting them to valuable industry partnerships and exciting global career pathways.</h2>
                    </div>
                </div>
            </div>
        </div>
        <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
        <ol
            class="carousel-indicators">
            <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-1" data-slide-to="1"></li>
            <li data-target="#carousel-1" data-slide-to="2"></li>
            <li data-target="#carousel-1" data-slide-to="3"></li>
            <li data-target="#carousel-1" data-slide-to="4"></li>
            <li data-target="#carousel-1" data-slide-to="5"></li>
            </ol>
    </div>
    <section class="page-description">
        <div class="container-fluid">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1>ABOUT US</h1>
                <p class="text-center">Hospitality Institute of America-Philippines Inc. (HIAP Inc.) was established in October 2015 as the first international training center along the University Belt. HIAP provides hybrid programs, short course training, seminars, and workshops for senior high students, college students, and professionals with the help of industry leaders and career experts.&nbsp;<br></p><a href="/about-us">Find out more</a></div>
        </div>
    </section>
    <section class="home-services" style="background-image: url(&quot;assets/img/SERVICES%20-%20HOME%20PAGE.jpg&quot;);">
        <div class="container-fluid">
            <h1 class="text-center">services</h1>
            <div class="row">
                <div class="col-12 col-lg-12 col-xl-6 d-flex justify-content-center align-items-center justify-content-xl-end">
                    <div class="d-flex flex-column justify-content-center align-items-center flex-lg-row flex-xl-row justify-content-xl-start service-item"><img src="assets/img/feedback.png"><span class="text-center text-lg-left text-xl-left">TESDA Assessment Programs</span></div>
                </div>
                <div class="col-12 col-lg-12 col-xl-6 d-flex justify-content-center align-items-center justify-content-xl-start">
                    <div class="d-flex flex-column justify-content-center align-items-center flex-lg-row flex-xl-row justify-content-xl-start service-item"><img src="assets/img/academic%20-%202.png"><span class="text-center text-lg-left text-xl-left">TWSP - TESDA Scholarship Programs<br><small>(Training for Work Scholarship Program)</small></span></div>
                </div>
                <div class="col-12 col-lg-12 col-xl-6 d-flex justify-content-center align-items-center justify-content-xl-end">
                    <div class="d-flex flex-column justify-content-start align-items-center flex-lg-row flex-xl-row justify-content-xl-start service-item"><img src="assets/img/class.png"><span class="text-center text-lg-left text-xl-left">TESDA Training Programs</span></div>
                </div>
                <div class="col-12 col-lg-12 col-xl-6 d-flex justify-content-center align-items-center justify-content-xl-start">
                    <div class="d-flex flex-column justify-content-start align-items-center flex-lg-row flex-xl-row justify-content-xl-start service-item"><img src="assets/img/graduation-cap.png"><span class="text-center text-lg-left text-xl-left">SESP - OWWA Scholarship Programs<br><small>(Skills for Employment Scholarship Program)</small></span></div>
                </div>
                <div class="col-12 col-lg-12 col-xl-6 d-flex justify-content-center align-items-center justify-content-xl-end">
                    <div class="d-flex flex-column justify-content-start align-items-center flex-lg-row flex-xl-row justify-content-xl-start service-item"><img src="assets/img/customer%20(3).png"><span class="text-center text-lg-left text-xl-left">Customized Programs</span></div>
                </div>
                <div class="col-12 col-lg-12 col-xl-6 d-flex justify-content-center align-items-center justify-content-xl-start">
                    <div class="d-flex flex-column justify-content-start align-items-center flex-lg-row flex-xl-row justify-content-xl-start service-item"><img src="assets/img/graduation-diploma.png"><span class="text-center text-lg-left text-xl-left">Senior High Scholarship Programs</span></div>
                </div>
            </div>
        </div>
    </section>
    <section class="home-facilities">
        <div class="container-fluid">
            <h1 class="text-center">state-of-the-art facilities</h1>
            <div class="row no-gutters justify-content-center">
                <div class="col-12 col-lg-4 col-xl-2">
                    <div class="d-flex justify-content-center align-items-end justify-content-xl-center align-items-xl-end facilities-item" style="border-radius: 15px;background-image: url(&quot;assets/img/INFORMATION%20AREA.jpg&quot;);background-position: center;background-size: cover;">
                        <div class="item-name"><span>information areas</span></div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-2">
                    <div class="d-flex justify-content-center align-items-end justify-content-xl-center align-items-xl-end facilities-item" style="border-radius: 15px;background-image: url(&quot;assets/img/HOUSEKEEPING_A.jpg&quot;);background-position: center;background-size: cover;">
                        <div class="item-name"><span>HOUSEKEEPING area</span></div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-2">
                    <div class="d-flex justify-content-center align-items-end justify-content-xl-center align-items-xl-end facilities-item" style="border-radius: 15px;background-image: url(&quot;assets/img/KITCHEN.JPG&quot;);background-position: center;background-size: cover;">
                        <div class="item-name"><span>KITCHEN areas</span></div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-2">
                    <div class="d-flex justify-content-center align-items-end justify-content-xl-center align-items-xl-end facilities-item" style="border-radius: 15px;background-image: url(&quot;assets/img/FBS.JPG&quot;);background-position: center;background-size: cover;">
                        <div class="item-name"><span>bar &amp; cafe</span></div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-2">
                    <div class="d-flex justify-content-center align-items-end justify-content-xl-center align-items-xl-end facilities-item" style="border-radius: 15px;background-image: url(&quot;assets/img/clr.jpg&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;">
                        <div class="item-name"><span>TRAINING / CLASSROOMS</span></div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-2">
                    <div class="d-flex justify-content-center align-items-end justify-content-xl-center align-items-xl-end facilities-item" style="border-radius: 15px;background-image: url(&quot;assets/img/LEARNING%20CENTER.JPG&quot;);background-position: center;background-size: cover;">
                        <div class="item-name"><span>LEARNING CENTER</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="tagline" style="background-image: url(&quot;assets/img/footer_image.jpg&quot;);background-position: center;background-size: cover;">
        <div class="container-fluid d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center h-100">
            <h1 class="text-center d-none d-sm-none d-md-block d-lg-block d-xl-block">Study today, excel tomorrow.</h1>
            <h1 class="text-center d-block d-sm-block d-md-none d-lg-none d-xl-none">Study today,<br>excel tomorrow.</h1>
        </div>
    </section>
    @include('partials._footer')
    <a id="go-back-button" href="#"><i class="fa fa-angle-up"></i></a>
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