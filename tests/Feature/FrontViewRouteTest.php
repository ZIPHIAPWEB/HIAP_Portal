<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FrontViewRouteTest extends TestCase
{
    /** @test */
    public function can_visit_home_page()
    {
        $response = $this->get('/');

        $response->assertOk();
    }

    /** @test */
    public function can_visit_about_us_page()
    {
        $response = $this->get('/about-us');
        
        $response->assertOk();
    }

     /** @test */
     public function can_visit_assessment_page()
     {
         $response = $this->get('/about-us');
         
         $response->assertOk();
     }

     /** @test */
     public function can_visit_contact_us_page()
     {
         $response = $this->get('/assessment');

         $response->assertOk();
     }

     /** @test */
     public function can_visit_customized_senior_25_page()
     {
         $response = $this->get('/customized-senior-25');

         $response->assertOk();
     }

     /** @test */
     public function can_visit_customized_prof_page()
     {
         $response = $this->get('/customized-college');

         $response->assertOk();
     }
    
     /** @test */
     public function can_visit_customized_college_page()
     {
         $response = $this->get('/customized-senior');

         $response->assertOK();
     }

     /** @test */
     public function can_visit_e_learning_page()
     {
         $response = $this->get('/e-learning');

         $response->assertOk();
     }

     /** @test */
     public function can_visit_enroll_now_page()
     {
         $response = $this->get('/enroll-now');

         $response->assertOk();
     }

     /** @test */
     public function can_visit_faqs_page()
     {
         $response = $this->get('/faqs');

         $response->assertOk();
     }

     /** @test */
     public function can_visit_our_services_page()
     {
         $response = $this->get('/our-services');

         $response->assertOk();
     }

     /** @test */
     public function can_visit_our_facilities_page()
     {
         $response = $this->get('/our-facilities');

         $response->assertOk();
     }

     /** @test */
     public function can_visit_owwa_page()
     {
         $response = $this->get('/owwa');

         $response->assertOk();
     }

     /** @test */
     public function can_visit_senior_scholarship_page()
     {
         $response = $this->get('/senior-scholarship');

         $response->assertOk();
     }

     /** @test */
     public function can_visit_social_stream_page()
     {
         $response = $this->get('/social-stream');

         $response->assertOk();
     }

     /** @test */
     public function can_visit_tesda_training_page()
     {
         $response = $this->get('/tesda-training');

         $response->assertOk();
     }
     
     /** @test */
     public function can_visit_twsp_page()
     {
         $response = $this->get('/twsp');

         $response->assertOk();
     }

     /** @test */
     public function can_visit_global_e_learning_page()
     {
         $response = $this->get('/global-e-learning');

         $response->assertOk();
     }

     /** @test */
     public function can_visit_e_learning_hub_page()
     {
         $response = $this->get('/e-learning-hub');

         $response->assertOk();
     }

     /** @test */
     public function can_visit_tesda_online_page()
     {
         $response = $this->get('/tesda-online');

         $response->assertOk();
     }

     /** @test */
     public function can_visit_blog_page()
     {
         $this->withoutExceptionHandling();
         
         $response = $this->get('/blog');

         $response->assertOk();
     }
}
