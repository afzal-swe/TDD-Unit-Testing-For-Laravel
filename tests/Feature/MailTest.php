<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class MailTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_mail()
    {
        Mail::fake();

        $data = [

            'title' => 'example title',
            'body' => 'testing check ',
        ];

        Mail::to('afzal.swe@gmail.com')->send(new TestMail($data));

        // Arrange
        Mail::assertSent(TestMail::class, function ($mail) use ($data) {
            return $mail->hasTo('afzal.swe@gmail.com') &&
                $mail->data['title'] === $data['title'] &&
                $mail->data['body'] == $data['body'];
        });

        // Act

        // Assert
    }
}
