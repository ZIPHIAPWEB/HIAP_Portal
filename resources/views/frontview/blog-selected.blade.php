<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <title>{{ $blog->title }}</title>
    <meta name="description" content="{{ $blog->initial_content }}">
    
    <meta name="twitter:description" content="{{ $blog->initial_content }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:image" content="/assets/img/HIAPh_INC%20LOGO%20HIGHRES-01.png">
    <meta name="twitter:title" content="{{ $blog->title }}">

    <meta property="og:site_name" content="HIAP Inc.">
    <meta property="og:title" content="{{ $blog->title }}">
    <meta property="og:description" content="{{ $blog->initial_content }}">
    <meta property="og:image" content="/assets/img/HIAPh_INC%20LOGO%20HIGHRES-01.png">
    <meta property="og:url" content="{{ URL::current() }}">
    <meta property="og:type" content="website" />
    
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/logo_small.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/logo_large.png">
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/styles.min.css">
    <style>
        h1, h2, h3 {
            font-family: 'Bebas Kai Regular';
            font-size: 50px;
        }

        .blog-content {
            margin-top: 3.5em;
            margin-bottom: 3.5em;
        }

        blockquote {
            background: #f9f9f9;
            border-left: 10px solid #ccc;
            margin: 1.5em 10px;
            padding: 0.5em 10px;
            quotes: "\201C""\201D""\2018""\2019";
        }

        blockquote:before {
            color: #ccc;
            content: open-quote;
            font-size: 4em;
            line-height: 0.1em;
            margin-right: 0.25em;
            vertical-align: -0.4em;
        }
     
        blockquote p {
            display: inline;
            font-style: italic;
        }
     
        .image-style-side {
            float: right;
        }

        .image-style-side img {
            width: 250px;
        }

        img {
            width: 100%;
        }

        .media div {
            width: 100%;
        }

        p {
            font-family: 'Montserrat';
            text-align: justify;
            text-indent: 50px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg bg-white">
        <div class="container-fluid"><a class="navbar-brand d-block d-lg-none d-xl-none" href="#" style="background-image: url(&quot;assets/img/HIAPh_INC%20LOGO%20HIGHRES-01.png&quot;);width: 60px;height: 60px;background-position: center;background-size: contain;background-repeat: no-repeat;margin: 0;"></a>
            <button
                data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse text-center" id="navcol-1">
                    <ul class="nav navbar-nav mx-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link text-center text-lg-center text-xl-center" href="/">HOME</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link text-center text-lg-center text-xl-center" href="/about-us">ABOUT US</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link text-center text-lg-center text-xl-center" href="/our-services">services</a>
                            <ul class="list-unstyled nav-content">
                                <li><a href="#">gov't training &amp; assessment</a>
                                    <ul class="list-unstyled">
                                        <li><a href="/assessment">tesda assessment programS</a></li>
                                        <li><a href="/tesda-training">Tesda training programS</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">scholarship Programs</a>
                                    <ul class="list-unstyled">
                                        <li><a href="/twsp">twsp - tesda programs</a></li>
                                        <li><a href="/owwa">sesp - owwa programs</a></li>
                                        <li><a href="/senior-scholarship">SHS Scholarship programs</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">customized programs</a>
                                    <ul class="list-unstyled">
                                        <li><a href="/customized-senior-25">senior high (25 hours)</a></li>
                                        <li><a href="/customized-senior">senior high (whole day)</a></li>
                                        <li><a href="/customized-college">College (whole day)</a></li>
                                        <li><a href="/customized-prof">young professionals</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item" role="presentation"><a class="nav-link text-center text-lg-center text-xl-center d-none d-sm-none d-md-none d-lg-block d-xl-block" href="#">Online programs</a>
                            <ul class="list-unstyled nav-content">
                                <li><a href="/global-e-learning">World-class Training Programs</a></li>
                                <li><a href="/e-learning-hub">e-learning hub</a></li>
                                <li><a href="/tesda-online">Tesda online programs</a></li>
                            </ul>
                        </li>
                    </ul><a class="navbar-brand d-none d-lg-block d-xl-block" href="#" style="background-image: url(&quot;/assets/img/HIAPh_INC%20LOGO%20HIGHRES-01.png&quot;);width: 100px;height: 100px;background-position: center;background-size: contain;background-repeat: no-repeat;margin: 0;"></a>
                    <ul
                        class="nav navbar-nav d-xl-flex mx-auto">
                        <li class="nav-item d-block d-sm-block d-md-block d-lg-none d-xl-none" role="presentation"><a class="nav-link text-center text-lg-center text-xl-center" href="global-e-learning">Global e-learning</a></li>
                        <li class="nav-item d-block d-sm-block d-md-block d-lg-none d-xl-none" role="presentation"><a class="nav-link text-center text-lg-center text-xl-center" href="e-learning-hub">E-learning hub</a></li>
                        <li class="nav-item d-block d-sm-block d-md-block d-lg-none d-xl-none" role="presentation"><a class="nav-link text-center text-lg-center text-xl-center" href="tesda-online">Tesda online programs</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link text-center text-lg-center text-xl-center" href="/our-facilities">facilities</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link text-center text-lg-center text-xl-center" href="/contact-us">CONTACT US</a></li>
                        <li class="nav-item d-block d-sm-block d-md-block d-lg-none d-xl-none" role="presentation"><a class="nav-link text-center text-lg-center text-xl-center" href="/blog">blog</a></li>
                        <li class="nav-item d-block d-sm-block d-md-block d-lg-none d-xl-none" role="presentation"><a class="nav-link text-center text-lg-center text-xl-center" href="/social-stream">social streams</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active text-center text-lg-center text-xl-center d-none d-sm-none d-md-none d-lg-block d-xl-block" href="#">learn more</a>
                            <ul class="list-unstyled nav-content">
                                <!-- <li><a href="/blog">blog</a></li> -->
                                <li><a href="/social-stream">social streams</a></li>
                            </ul>
                        </li>
                        <li class="nav-item" role="presentation"><a class="nav-link px-4" href="/login" style="background: #961a32;color: white !important;border-radius: 10px;">{{ Auth::check() ? 'Go To Profile' : 'Enroll Now' }}</a></li>
                        </ul>
                </div>
        </div>
    </nav>
    <section class="blog-content container">
        {!! $blog->content !!}
    </section>
    <footer class="footer-wrapper">
        <div class="container">
            <div class="row mb-3">
                <div class="col">
                    <p class="text-center m-0 p-3">2F University Center Building, 1985 C.M. Recto Avenue Sampaloc, Manila, 1008<br>(02) 88064355 | 09175228213 | 09228768213 |&nbsp;09175228213 | 09178988213 | 09084698962</p>
                </div>
            </div>
            <div class="row no-gutters justify-content-center mb-3">
                <div class="col-12 col-xl-auto d-flex justify-content-center align-items-center"><a class="text-center flex-fill" href="https://www.facebook.com/HospitalityInstituteofAmericaPhilippines" style="width: 315px;" target="_blank"><i class="fa fa-facebook mr-1"></i>Hospitality Institute of America Philippines Inc.</a></div>
                <div
                    class="col-12 col-xl-auto d-flex justify-content-center align-items-center"><a class="text-center flex-fill" href="https://www.facebook.com/HIAPLearningCenter" style="width: 173px;" target="_blank"><i class="fa fa-facebook mr-1"></i>HIAP - Learning Center</a></div>
            <div class="col-12 col-xl-auto d-flex justify-content-center align-items-center"><a class="text-center flex-fill" href="https://www.ziptravel.com.ph/" target="_blank"><i class="fa fa-globe mr-1"></i>Zip Travel</a></div>
            <div class="col-12 col-xl-auto d-flex justify-content-center align-items-center"><a class="text-center flex-fill" href="https://www.tesda.gov.ph/" target="_blank"><i class="fa fa-globe mr-1"></i>TESDA</a></div>
            <div class="col-12 col-xl-auto d-flex justify-content-center align-items-center"><a class="text-center flex-fill" href="http://owwa.gov.ph/" target="_blank"><i class="fa fa-globe mr-1"></i>OWWA</a></div>
        </div>
        <div class="row">
            <div class="col d-flex flex-column justify-content-center align-items-center flex-md-row flex-lg-row">
                <p class="text-center m-0 p-1">Copyright 2020&nbsp;</p>
                <p class="text-center m-0 p-1">Hospitality Institute of America-Philippines Inc.</p>
            </div>
        </div>
        </div>
    </footer><a id="go-back-button" href="#"><i class="fa fa-angle-up"></i></a><!-- Load Facebook SDK for JavaScript -->
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
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/js/script.min.js"></script>
</body>

</html>