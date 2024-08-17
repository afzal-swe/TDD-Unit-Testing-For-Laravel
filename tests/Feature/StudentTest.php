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

        // A = Act
        $response = $this->json('get', route('student_create'));

        // A = Assert
        $response->assertStatus(200)->assertSeeText("");
    }

    // Student Data Store
    public function test_student_store()
    {

        // Arrange
        $data = [

            "roll" => 6,
            "name" => "afzal",
            "email" => "afzal@gmail.com",
            "phone" => "01811178307",
        ];

        // Act
        $this->withoutExceptionHandling(); // Validator Data error show message (302)
        $response = $this->post(route('student.store', $data));

        // A = Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('students', $data); // Has = Chacking Data
    }

    // Student Edit Test Function
    public function test_student_edit()
    {

        // Arrange
        $data = StudentFactory::new()->create(); //Darta create korba

        // Act
        $this->withoutExceptionHandling(); // Validator Data error show message (302)
        $response = $this->get(route('student.edit', ['id' => $data->id]));

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'roll' => $data->roll,
                'name' => $data->name,
                'email' => $data->email,
                'phone' => $data->phone,
            ]);
    }

    // Student Update Test Function
    public function test_student_update()
    {


        // Arrange
        $data = StudentFactory::new()->create(); //Darta create korba
        $update = [
            'roll' => 20,
            'name' => 'afzal',
            'email' => 'afzal@gmail.com',
            'phone' => '01511178307',
        ];

        // Act
        $this->withoutExceptionHandling(); // Error View Function
        $response = $this->put(route('student.update', ['id' => $data->id]), $update);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('students', $update); // Check Data
        $this->assertDatabaseMissing('students', $data->toArray());
    }


    // Student Delete Test Function
    public function test_student_delete()
    {

        // Arrange
        $data = StudentFactory::new()->create();

        // Act
        $response = $this->delete(route('student.delete', ['id' => $data->id]));

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseMissing('students', ['id' => $data->id]); // Missing =  Missing Data

    }
}
