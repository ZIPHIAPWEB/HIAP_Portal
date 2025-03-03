<!DOCTYPE html>
<html>

@include('partials._head')

<body>
    @include('partials._navbar')
    <section class="page-header"><img src="{{ asset('assets/images_v2/INTERNATIONAL_CERTIFICATION.png') }}" style="background-image: url(&quot;assets/img/ELEARNING%20-%20HEADER.jpg&quot;);background-repeat: no-repeat;background-size: cover;background-position: center;"></section>
    <section class="page-description">
        <div class="container-fluid">
            <div>
                <h1 class="text-center">INTERNATIONAL CERTIFICATION PROGRAMS</h1>
                <p class="text-center mb-4">
                    Enroll in our international certification programs to advance your career and specialize in your field. <br>
                    Enhance your skills, expand your knowledge, and stand out.
                </p>
            </div>
        </div>
    </section>
    <section class="page-description" style="color: white !important; background-image: url(&quot;{{ asset('assets/img/ONLINE%20PIC%201.jpg') }}&quot;);background-repeat: no-repeat;background-size: cover;background-position: center;">
        <div class="container-fluid">
            <div>
                <h1 class="text-center" style="color: white !important;">ABOUT SERVSAFE</h1>
                <p class="text-center mb-4">
                The National Restaurant Association (NRA), the largest foodservice trade association in the world, developed ServSafe in 1919 to provide educational resources that help build a strong workforce in the restaurant industry. ServSafe programs are designed to deliver comprehensive knowledge of food safety and hygiene practices for food service professionals, including chefs, managers, and servers.

The certification shows a professional's expertise in food safety. It is necessary for career progression in the food service and hospitality industries, emphasizing their commitment to high hygiene and safety standards in food handling.
                </p>
            </div>
        </div>
    </section>
    <section class="page-description">
        <div class="container-fluid">
            <div>
                <h1 class="text-center">SERVSAFE FOOD HANDLER CERTIFICATION</h1>
                <p class="text-center mb-4">
                The ServSafe® Food Handler Certification is most appropriate for food handlers such as waitstaff, cooks, and dishwashers. However, anyone handling food in an establishment can take the course. 
This certification proves you have the knowledge and skills to handle food safely and prevent foodborne illnesses in the workplace. To receive this certification, you must pass a test that covers basic food safety concepts.
                </p>
            </div>
        </div>
    </section>
    <section class="page-description" style="color: white !important; background-image: url(&quot;{{ asset('assets/img/ONLINE%20PIC%201.jpg') }}&quot;);background-repeat: no-repeat;background-size: cover;background-position: center;">
        <div class="container-fluid">
            <div>
                <h1 class="text-center" style="color: white !important;">PROGRAM FEATURES: </h1>
                <p class="text-center mb-4">
                    
                </p>
                <div class="d-flex flex-col justify-content-center">
                    <ul class="text-center" style="list-style: none;">
                        <li>&bull; Comprehensive food safety training</li>
                        <li>&bull; Multi-language support</li>
                        <li>&bull; Updated with the latest food safety standards</li>
                        <li>&bull; Engaging learning materials</li>
                        <li>&bull; Flexible learning options</li>
                        <li>&bull; Proctored certification exam</li>
                        <li>&bull; Certification recognized by regulatory authorities</li>
                        <li>&bull; Re-certification and renewal options</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="page-description">
        <div class="container-fluid">
            <div>
                <h1 class="text-center">DURATION</h1>
                <p class="text-center">
                    1 day (course & exam)
                    <br>
                    The ServSafe® Food Handler Certification is most appropriate for food handlers such as waitstaff, cooks, and dishwashers. However, anyone handling food in an establishment can take the course. 
                </p>
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