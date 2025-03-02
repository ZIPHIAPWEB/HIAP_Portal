<!DOCTYPE html>
<html>

@include('partials._head')

<body>
    @include('partials._navbar')
    <section class="page-header"><img src="{{ asset('assets/images_v2/MICRO_CREDENTIAL.png') }}" style="background-image: url(&quot;assets/img/ELEARNING%20-%20HEADER.jpg&quot;);background-repeat: no-repeat;background-size: cover;background-position: center;"></section>
    <section class="page-description">
        <div class="container-fluid">
            <div>
                <h1 class="text-center">MICRO-CREDENTIALS PROGRAMS</h1>
                <p class="text-center mb-4">
                    Flexible and industry-recognized training program that equip students and trainees with necessary skills and knowledge to excel in their hospitality career.
                    <br><br>
                    HIAP Inc.'s micro-credentials program offers tailored, compact learning opportunities strategically crafted to equip individuals with targeted skills and knowledge within a specific area. These programs aim at enhancing or updating their skills in response to the dynamic demands of the rapidly evolving job market.
                    <br><br>
                    Students receive a certificate of completion from partner industries upon completion of their courses.

                </p>
            </div>
        </div>
    </section>
    <section class="courses-offered">
        <div class="container-fluid">
            <div class="row no-gutters row-cols-1 row-cols-lg-4 row-cols-xl-4 justify-content-center">
                <div class="col">
                    <div class="d-flex justify-content-center align-items-end course-item" style="background-image: url({{ asset('assets/images_v2/mc_hospitality_management.png') }});background-position: top;background-size: cover;background-repeat: no-repeat;height: 250px;" data-toggle="modal" 
                        data-target="#hospitality-management-modal">
                        <div class="course-name" style="font-family: montserrat;color: white;background: #031430;"><span style="font-size: 15px;">Hospitality Management<br></span></div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-center align-items-end course-item" style="height: 250px;background: url({{ asset('assets/images_v2/mc_information_security.png') }}) top / cover no-repeat;" data-toggle="modal" data-target="#information-security-modal">
                        <div class="course-name" style="font-family: montserrat;color: white;background: #031430;"><span style="font-size: 15px;">Information Security Training<br></span></div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-center align-items-end course-item" style="height: 250px;background: url({{ asset('assets/images_v2/mc_sustainability.png') }}) top / cover no-repeat;" data-toggle="modal" data-target="#sustainability-modal">
                        <div class="course-name" style="font-family: montserrat;color: white;background: #031430;"><span style="font-size: 15px;">Sustainability<br></span></div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-center align-items-end course-item" style="background-image: url({{ asset('assets/images_v2/mc_food_and_beverage_service.png') }});background-position: top;background-size: cover;background-repeat: no-repeat;height: 250px;" data-toggle="modal"
                        data-target="#food-and-beverage-service-modal">
                        <div class="course-name" style="font-family: montserrat;color: white;background: #031430;"><span style="font-size: 15px;">Food and Beverage Service<br></span></div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-center align-items-end course-item" style="background-image: url({{ asset('assets/images_v2/mc_bar_and_beverage.png') }});background-position: top;background-size: cover;background-repeat: no-repeat;height: 250px;" data-toggle="modal"
                        data-target="#bar-and-beverage-management-modal">
                        <div class="course-name" style="font-family: montserrat;color: white;background: #031430;"><span style="font-size: 15px;">Bar and Beverage Management<br></span></div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-center align-items-end course-item" style="background-image: url({{ asset('assets/images_v2/mc_housekeeping.png') }});background-position: top;background-size: cover;background-repeat: no-repeat;height: 250px;" data-toggle="modal"
                        data-target="#housekeeping-service-modal">
                        <div class="course-name" style="font-family: montserrat;color: white;background: #031430;"><span style="font-size: 15px;">Housekeeping Service<br></span></div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-center align-items-end course-item" style="height: 250px;background: url({{ asset('assets/images_v2/mc_front_office.png') }}) top / cover no-repeat;" data-toggle="modal" data-target="#front-office-management-modal">
                        <div class="course-name" style="font-family: montserrat;color: white;background: #031430;"><span style="font-size: 15px;">Front Office Management<br></span></div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-center align-items-end course-item" style="height: 250px;background: url({{ asset('assets/images_v2/mc_events.png') }}) top / cover no-repeat;" data-toggle="modal" data-target="#events-management-modal">
                        <div class="course-name" style="font-family: montserrat;color: white;background: #031430;"><span style="font-size: 15px;">Events Management<br></span></div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-center align-items-end course-item" style="height: 250px;background: url({{ asset('assets/images_v2/mc_food_safety.png') }}) top / cover no-repeat;" data-toggle="modal" data-target="#food-safety-training-modal">
                        <div class="course-name" style="font-family: montserrat;background: #031430;color: white;"><span style="font-size: 15px;">Food Safety Training<br></span></div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-center align-items-end course-item" style="height: 250px;background: url({{ asset('assets/images_v2/mc_hotel_operations.png') }}) center / cover no-repeat;" data-toggle="modal" data-target="#hotel-operations-modal">
                        <div class="course-name" style="font-family: montserrat;color: white;background: #031430;"><span style="font-size: 15px;">Hotel Operations<br></span></div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-center align-items-end course-item" style="height: 250px;background: url({{ asset('assets/images_v2/mc_hotel_curated.png') }}) center / cover no-repeat;" data-toggle="modal" data-target="#hotel-operations-curated-modal">
                        <div class="course-name" style="font-family: montserrat;color: white;background: #031430;"><span style="font-size: 15px;">Hotel Operations (Curated)<br></span></div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-center align-items-end course-item" style="height: 250px;background: url({{ asset('assets/images_v2/mc_resto_curated.png') }}) center / cover no-repeat;" data-toggle="modal" data-target="#restaurant-operations-curated-modal">
                        <div class="course-name" style="font-family: montserrat;color: white;background: #031430;"><span style="font-size: 15px;">Restaurant Operations (Curated)<br></span></div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-center align-items-end course-item" style="height: 250px;background: url({{ asset('assets/images_v2/mc_food_curated.png') }}) center / cover no-repeat;" data-toggle="modal" data-target="#food-service-program-curated-modal">
                        <div class="course-name" style="font-family: montserrat;color: white;background: #031430;"><span style="font-size: 15px;">Food Service Program (Curated)    <br></span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('partials._footer')
    <a id="go-back-button" href="#"><i class="fa fa-angle-up"></i></a>
    
    <div class="modal fade" role="dialog" tabindex="-1" id="hospitality-management-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-xl-center">
                    <h2 class="modal-title">Hospitality Management</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Montserrat';font-size: 15px;">
                    <p class="text-justify">
                        Develop top-notch hospitality managers! Dive into the nitty-gritty of managing in today’s competitive job market with time-efficient courses that cover the essential skills needed for success.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="information-security-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-xl-center">
                    <h2 class="modal-title">Information Security Training</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Montserrat';font-size: 15px;">
                    <p class="text-justify">
                    Information is your most valuable asset. Gain the practical knowledge and processes to mitigate the risks of a cyber attack and understand the responsibility of handling information.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="sustainability-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-xl-center">
                    <h2 class="modal-title">Sustainability</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Montserrat';font-size: 15px;">
                    <p class="text-justify">
                        Acting sustainably is crucial. Learn to reduce waste and energy consumption, save water, and communicate sustainability efforts to guests. Work with your manager to implement sustainable practices and contribute to a better future for our planet.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="food-and-beverage-service-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-xl-center">
                    <h2 class="modal-title">Food and Beverage Service</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Montserrat';font-size: 15px;">
                    <p class="text-justify">
                        Ensure complete guest satisfaction through the Food and Beverage Service learning path that delves deeper into service traditions, the different styles of service, and types of menus to deliver consistently excellent service to ensure returning guests.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="bar-and-beverage-management-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-xl-center">
                    <h2 class="modal-title">Bar and Beverage Management</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Montserrat';font-size: 15px;">
                    <p class="text-justify">
                    Become a master behind the bar and know the ins and outs of top-notch service, upselling and crafting crowd-pleasing drinks whilst flaunting the ultimate product know-how.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="housekeeping-service-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-xl-center">
                    <h2 class="modal-title">Housekeeping Service</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Montserrat';font-size: 15px;">
                    <p class="text-justify">
                    Acquire practical skills and knowledge to become a housekeeping professional. Understand best practices in hygiene, health and safety standards, housekeeping procedures, documentation, and emergency handling.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="front-office-management-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-xl-center">
                    <h2 class="modal-title">Front Office Management</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Montserrat';font-size: 15px;">
                    <p class="text-justify">
                    Become acquainted with the finer details of a front-office professional’s skill set and gain a deeper understanding of a veteran's roles, responsibilities, and standard operating procedures.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="events-management-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-xl-center">
                    <h2 class="modal-title">Events Management</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Montserrat';font-size: 15px;">
                    <p class="text-justify">
                    In partnership with industry experts, the courses cover the secret to any successful event: planning: everything from equipment and safety and how to set meeting rooms, to the order of banquet service, and the basic principles of buffet design.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="food-safety-training-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-xl-center">
                    <h2 class="modal-title">Food Safety Training</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Montserrat';font-size: 15px;">
                    <p class="text-justify">
                    Cover topics such as proper handwashing procedures, personal hygiene, temperature control, and an introduction to food allergens. Gain a foundation in maintaining food safety best practices at work while promoting a positive food safety culture.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="hotel-operations-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-xl-center">
                    <h2 class="modal-title">Hotel Operations</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Montserrat';font-size: 15px;">
                    <p class="text-justify">
                    Know the best way to engage with guests from pre-arrival, check-in, occupancy, to departure/ Learn from expert insights and guidelines that will give you a good understanding of the inner workings of today’s hotels.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="hotel-operations-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-xl-center">
                    <h2 class="modal-title">Hotel Operations</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Montserrat';font-size: 15px;">
                    <p class="text-justify">
                    Cover topics such as proper handwashing procedures, personal hygiene, temperature control, and an introduction to food allergens. Gain a foundation in maintaining food safety best practices at work while promoting a positive food safety culture.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="hotel-operations-curated-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-xl-center">
                    <h2 class="modal-title">Hotel Operations (Curated)</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Montserrat';font-size: 15px;">
                    <p class="text-justify">
                    Understand the daily operations that keep a hotel running, including preparing for guests, providing service, and managing hotel processes and finances.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="restaurant-operations-curated-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-xl-center">
                    <h2 class="modal-title">Restaurant Operations (Curated)</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Montserrat';font-size: 15px;">
                    <p class="text-justify">
                    Learn the essential skills and knowledge requires to effectively manage and operate a restaurant. This program covers the day-to-day operations, from front-of-house to service and kitchen management.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="food-service-program-curated-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-xl-center">
                    <h2 class="modal-title">Food Service Program (Curated)</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family: 'Montserrat';font-size: 15px;">
                    <p class="text-justify">
                    Learn the essential skills for success in the hospitality industry. In these courses, you will master how to prepare the dining area, greet, and seat guests, present the menu, take orders, serve food and beverages, present the bill, and say goodbye to guests.
                    </p>
                </div>
            </div>
        </div>
    </div>
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

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/script.min.js') }}"></script>
</body>

</html>