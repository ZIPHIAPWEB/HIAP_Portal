<!DOCTYPE html>
<html>

@include('partials._head')

<body>
    @include('partials._navbar')
    <section class="page-header"><img src="{{ asset('assets/images_v2/SPECIALIZED_INDUSTRY.png') }}" style="background-image: url(&quot;assets/img/ELEARNING%20-%20HEADER.jpg&quot;);background-repeat: no-repeat;background-size: cover;background-position: center;"></section>
    <section class="page-description">
        <div class="container-fluid">
            <div>
                <h1 class="text-center">SPECIALIZED-INDUSTRY PROGRAMS</h1>
                <p class="text-center mb-4">
                    These specialized industry programs are advanced training initiatives designed to enhance specific skills and knowledge in the hospitality sector. Their primary goal is to address global industry needs and equip participants with unique skills that help them stand out in competitive markets while aligning with industry standards.
                    <br>
                    <br>
                    Targeted at hospitality staff at all levels, these programs focus on developing practical skills and theoretical knowledge. Participants learn to deliver exceptional customer service, which not only advances their careers but also enhances the reputation of their establishments in the hospitality industry.
                </p>
            </div>
        </div>
    </section>
    <section class="page-description" style="color: white !important; background-image: url(&quot;{{ asset('assets/img/ONLINE%20PIC%201.jpg') }}&quot;);background-repeat: no-repeat;background-size: cover;background-position: center;">
        <div class="container-fluid">
            <div>
                <h1 class="text-center" style="color: white !important;">LUXURY SERVICE STANDARDS</h1>
                <p class="text-center mb-4">
                    This program covers 80% of the luxury service benchmarks set by LQA, AAA, and Forbes Travel Guide, <br>ensuring thorough training across all major rating authorities.
                </p>
                <ul class="text-center" style="list-style: none;">
                    <li>&bull; Essential management skills and knowledge</li>
                    <li>&bull; Insights and practical experiences shared by industry experts</li>
                    <li>&bull; Cost-saving strategies</li>
                    <li>&bull; Techniques for upselling</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="page-description">
        <div class="container-fluid">
            <div>
                <h1 class="text-center">JOB-ROLE TRAINING</h1>
                <p class="text-center mb-4">
                    A comprehensive training solution for every department and role in the hotel, designed to onboard, upskill
                    <br>
                    and inspired associates, while driving performance throughout your operation.
                </p>
                <ul class="text-center" style="list-style: none;">
                    <li>&bull; High Standards of Excellence</li>
                    <li>&bull; Guest-Centric Approach</li>
                    <li>&bull; Emotional Intelligence and Soft Skills</li>
                    <li>&bull; Focus on Attention to Detail</li>
                    <li>&bull; Continuous Assessment and Improvement</li>
                    <li>&bull; Commitment to Service Excellence</li>
                    <li>&bull; Certification & Practical Role-Playing Analysis</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="page-description" style="color: white !important; background-image: url(&quot;{{ asset('assets/img/ONLINE%20PIC%201.jpg') }}&quot;);background-repeat: no-repeat;background-size: cover;background-position: center;">
        <div class="container-fluid">
        <div>
                <h1 class="text-center" style="color: white !important">PROCHEF AND PLANT-FORWARD KITCHEN</h1>
                <p class="text-center">
                    This program is joint effort between our organization and Culinary Institute of America (CIA) aimed
                    <br>
                    at enhancing culinary skills and expertise among aspiring chefs.
                    <br><br>
                    Focus on innovative techniques to create delicious plant-based dishes, which aligns with the current
                    <br>
                    trend of plant-forward dining. Receive a comprehensive learning experience to enable chefs to excel in
                    <br>
                    the culinary field.
                </p>
                <ul class="text-center" style="list-style: none;">
                    <li>&bull; Expert Instruction/Chef-Driven Curriculum</li>
                    <li>&bull; Interactive Learning Experience</li>
                    <li>&bull; Emphasis on Plant-Based Cuisine</li>
                    <li>&bull; Sustainable Kitchen Practices</li>
                    <li>&bull; Plant-Forward Culinary Trends</li>
                    <li>&bull; Hands-on Cooking Sessions</li>
                    <li>&bull; Certification of Culinary Skills</li>
                </ul>
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