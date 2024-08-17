<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Factories\StudentFactory;

class StudentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_student_list()
    {

        // AAA
        // A = Arrange
        StudentFactory::new()->count(5)->create();


        // A = Act
        $response = $this->get(route('student_list'));
        // $response = $this->json('get', route('student_list'));


        // A = Assert
        // $response->assertStatus(200)->assertJsonCount(5);
        $response->assertStatus(status: 200);


        /// =========== Method ================== ///
        // $response->assertSee(__(key: 'Not Products Found'));
        // $response->assertDontSee(value: 'Product Name');
    }


    // Student Create Test Function
    public function test_student_create()
    {

        $response = $this->json('get', route('student_create'));
        $response->assertStatus(200)->assertSeeText("");
    }
}
