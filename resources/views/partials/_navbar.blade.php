<nav class="navbar navbar-light navbar-expand-lg bg-white">
    <div class="container-fluid"><a class="navbar-brand d-block d-lg-none d-xl-none" href="#" style="background-image: url(&quot;assets/img/HIAPh_INC%20LOGO%20HIGHRES-01.png&quot;);width: 60px;height: 60px;background-position: center;background-size: contain;background-repeat: no-repeat;margin: 0;"></a>
        <button
            data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse text-center" id="navcol-1">
                <ul class="nav navbar-nav mx-auto">
                    <li class="nav-item" role="presentation"><a class="{{ Route::current()->uri() == '/' ? 'active' : '' }} nav-link text-center text-lg-center text-xl-center" href="/">HOME</a></li>
                    <li class="nav-item" role="presentation"><a class="{{ Route::current()->uri() == 'about-us' ? 'active' : '' }} nav-link text-center text-lg-center text-xl-center" href="/about-us">ABOUT US</a></li>
                    <li class="nav-item" role="presentation"><a class="{{ Route::current()-> uri() == 'our-services/international-certification' || Route::current()->uri() == 'our-services/specialized-industry-programs' || Route::current()->uri() == '/our-services/micro-credential-certificat' || Route::current()->uri() == 'our-services/tvet-programs' ? 'active' : ''}} nav-link text-center text-lg-center text-xl-center d-none d-sm-none d-md-none d-lg-block d-xl-block" href="#">OUR PROGRAMS</a>
                        <ul class="list-unstyled nav-content">
                            <li><a href="/our-services/international-certification">International Certification</a></li>
                            <li><a href="/our-services/specialized-industry-programs">Specialized-Industry Programs</a></li>
                            <li><a href="/our-services/micro-credential-certificate">Micro-credential Certificate</a></li>
                            <li><a href="/our-services/tvet-programs">TVET Programs</a></li>
                        </ul>
                    </li>
                    <li class="nav-item" role="presentation"><a class="{{ Route::current()->uri() == 'our-facilities' ? 'active' : '' }} nav-link text-center text-lg-center text-xl-center" href="/our-facilities">FACILITIES</a></li>
                </ul>
                <a class="navbar-brand d-none d-lg-block d-xl-block" href="#" style="background-image: url(&quot;assets/img/HIAPh_INC%20LOGO%20HIGHRES-01.png&quot;);width: 100px;height: 100px;background-position: center;background-size: contain;background-repeat: no-repeat;margin: 0;"></a>
                <ul class="nav navbar-nav d-xl-flex mx-auto">
                    <li class="nav-item" role="presentation"><a class="{{ Route::current()->uri() == 'contact-us' ? 'active' : '' }} nav-link text-center text-lg-center text-xl-center" href="/contact-us">CONTACT US</a></li>
                    <li class="nav-item d-block d-sm-block d-md-block d-lg-none d-xl-none" role="presentation"><a class="nav-link text-center text-lg-center text-xl-center" href="blog">blog</a></li>
                    <li class="nav-item d-block d-sm-block d-md-block d-lg-none d-xl-none" role="presentation"><a class="nav-link text-center text-lg-center text-xl-center" href="social-stream">social streams</a></li>
                    <li class="nav-item" role="presentation"><a class="{{ Route::current()->uri() == 'social-stream' ? 'active' : '' }} nav-link text-center text-lg-center text-xl-center d-none d-sm-none d-md-none d-lg-block d-xl-block" href="#">learn more</a>
                        <ul class="list-unstyled nav-content">
                            <!-- <li><a href="blog">blog</a></li> -->
                            <li><a href="/social-stream">social streams</a></li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item" role="presentation"><a class="{{ Route::current()->uri() == 'e-learning' ? 'active' : '' }} nav-link px-2" href="/global-e-learning" style="background: #961a32;color: white !important;border-radius: 10px;">E-LEARNING</a></li> -->
                    <li class="nav-item" role="presentation"><a class="nav-link px-2" href="/login" style="background: #961a32;color: white !important;border-radius: 10px;">{{ Auth::check() ? 'Go To Profile' : 'Enroll Now' }}</a></li>
                </ul>
            </div>
    </div>
</nav>