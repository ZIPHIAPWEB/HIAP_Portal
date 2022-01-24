<?php

namespace Tests\Feature;

use App\Certificate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CertificateControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_visit_lobster_ink_grade_search_page()
    {
        $response = $this->get('/cert/search');

        $response->assertOk();
    }

    /** @test */
    public function can_add_single_certificate()
    {
        $this->actingAs(User::create($this->registerUserDetails()));

        $response = $this->post('/addCertificate', $this->request_body());

        $response->assertRedirect();

        $this->assertDatabaseCount('certificates', 1);
    }

    /** @test */
    public function can_validate_request_of_add_single_certificate()
    {
        $this->actingAs(User::create($this->registerUserDetails()));

        $response = $this->post('/addCertificate', []);
        
        $response->assertInvalid();
    }

    /** @test */
    public function can_add_bulk_certificate()
    {
        $this->actingAs(User::create($this->registerUserDetails()));

        $header = 'Header 1;Header 2;Header 3;Header 3;Header 3;Header 3;Header 3;Header 3;Header 3';
        $row1 = 'value 1;value 2;value 3;value 3;value 3;value 3;value 3;value 3;value 3;value 3';
        $row2 = 'value 1;value 2;value 3;value 2;value 2;value 2;value 2;value 2;value 2;value 2';

        $content = implode('\n', [$header, $row1, $row2]);
        
        $csvFileToBeUploaded = [
            'file'  =>  UploadedFile::fake()->createWithContent('test.csv', $content)
        ];

        $response = $this->post('/uploadCertificate', $csvFileToBeUploaded);

        $response->assertRedirect();
    }

    /** @test */
    public function can_search_certificate()
    {        
        Certificate::create($this->request_body());

        $response = $this->get('/cert/cert_1');

        $response->assertOk();
    }

    /** @test */
    public function can_update_certificate()
    {
        $this->actingAs(User::create($this->registerUserDetails()));

        $selectedCert = Certificate::create($this->request_body());
        
        $data = [
            'id'        =>  $selectedCert->id,
            'cert_no'   =>  'cert_2',
            'name'      =>  'cert',
            'school'    =>  'fjdsfd',
            'program'   =>  'fjsdklfdjs',
            'total_grade'   =>  1,
            'gold_medal'    =>  1,
            'silver_medal'  =>  1,
            'bronze_medal'  =>  1,
            'total_medal'   =>  1,
            'proficiency'   =>  1
        ];

        $response = $this->patch('/updateCertificate', $data);

        $updatedData = Certificate::where('id', $selectedCert->id)->first();

        $this->assertEquals($updatedData->cert_no, $data['cert_no']);

        $response->assertRedirect();
    }
    /** @test */
    public function can_validate_request_of_update_certificate()
    {
        $this->actingAs(User::create($this->registerUserDetails()));

        $response = $this->patch('/updateCertificate', []);
        
        $response->assertInvalid();
    }

    /** @test */
    public function can_delete_selected_certificate()
    {
        $this->withoutExceptionHandling();
        
        $this->actingAs(User::create($this->registerUserDetails()));

        $createdCert = Certificate::create($this->request_body());

        $response = $this->delete('/deleteCertificate/'. $createdCert->id);

        $response->assertRedirect();

        $this->assertDatabaseCount('certificates', 0);
    }

    /** @test */
    public function no_record_found()
    {
        $response = $this->get('/cert/999');

        $response->assertNotFound();
    }

    private function request_body()
    {
        return [
            'cert_no'   =>  'cert_1',
            'name'      =>  'cert',
            'school'    =>  'fjdsfd',
            'program'   =>  'fjsdklfdjs',
            'total_grade'   =>  1,
            'gold_medal'    =>  1,
            'silver_medal'  =>  1,
            'bronze_medal'  =>  1,
            'total_medal'   =>  1,
            'proficiency'   =>  1
        ];
    }

    private function registerUserDetails()
    {
        return [
            'email'     =>  'test@app.com',
            'password'  =>  'password',
            'role'      =>  'client',
            'isFilled'  =>  false,
            'isActive'  =>  true,
            'program_id'=>  1
        ];
    }
}
