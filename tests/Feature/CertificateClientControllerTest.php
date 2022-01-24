<?php

namespace Tests\Feature;

use App\CertificateClient;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CertificateClientControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_visit_cert_download_page_by_guest()
    {
        $request = $this->get('/certDownload');

        $request->assertOk();
    }

    /** @test */
    public function can_search_cert_by_guest()
    {
        $request = $this->post('/getSearchedCertificate', []);

        $request->assertOk();
    }

    /** @test */
    public function can_visit_cert_client_list_page()
    {
        $request = $this->get('/certClients');

        $request->assertRedirect();
    }

    /** @test */
    public function can_throw_not_found_exception_if_no_certificate()
    {
        $request = $this->get('/certDownloadActual/1');

        $request->assertNotFound();
    }

    /** @test */
    public function can_add_single_client_cert()
    {
        $this->actingAs(User::create($this->registerUserDetails()));

        $request = $this->post('/certSaveSingle', $this->certificateRequestBody());

        $request->assertRedirect();

        $this->assertDatabaseCount('certificate_clients', 1);
    }

    /** @test */
    public function can_update_selected_client_cert()
    {
        $this->actingAs(User::create($this->registerUserDetails()));

        $postedCert = CertificateClient::create($this->certificateRequestBody());

        $updatedCert = [
            'id'                =>  $postedCert->id,
            'full_name'         =>  'Renz D. Mergenio',
            'email'             =>  'zner.mergenio@gmail.com',
            'school'            =>  'Sample School',
            'cert_created_at'   =>  '2022-01-17',
            'cert_layout_id'    =>  '2'
        ];

        $request = $this->patch('/certUpdateClient', $updatedCert);

        $request->assertRedirect();

        $this->assertDatabaseHas('certificate_clients', $updatedCert);
    }

    /** @test */
    public function can_delete_selected_client_cert()
    {
        $this->actingAs(User::create($this->registerUserDetails()));

        $postedCert = CertificateClient::create($this->certificateRequestBody());

        $request = $this->delete('/certDelete/' . $postedCert->id);

        $request->assertRedirect();

        $this->assertDatabaseCount('certificate_clients', 0);
    }

    /** @test */
    public function can_search_client_cert()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::create($this->registerUserDetails()));

        $request = $this->post('/searchCertificate', []);

        $request->assertOk();
    }

    private function certificateRequestBody()
    {
        return [
            'full_name'         =>  'Renz D. Mergenio',
            'email'             =>  'zner.mergenio@gmail.com',
            'school'            =>  'Sample School',
            'cert_created_at'   =>  '2022-01-17',
            'cert_layout_id'    =>  '1'
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
