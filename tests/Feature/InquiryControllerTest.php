<?php

namespace Tests\Feature;

use App\Mail\SendInquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class InquiryControllerTest extends TestCase
{
    /** @test */
    public function can_send_inquiry_email()
    {
        $this->withoutExceptionHandling();
        Mail::fake();

        $request_body = [
            'full_name'     =>  'Test',
            'email'         =>  'test@app.com',
            'mobile_number' =>  '09123456789',
            'message'       =>  'Testing testing'
        ];

        $response = $this->post('/sendInquiry', $request_body);

        Mail::assertSent(SendInquiry::class);

        $response->assertRedirect();
    }
}
