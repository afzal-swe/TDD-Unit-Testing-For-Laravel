<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Factories\StudentFactory;
use Database\Factories\UserFactory;
use App\Models\User;

class StudentTest extends TestCase
{
    // use RefreshDatabase;
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

        $user = User::factory()->create(); // Using for Auth


        // A = Act
        $response = $this->actingAs($user)->get(route('student_list'));
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
        $user = User::factory()->create(); // Using for Auth

        // A = Act
        $response = $this->actingAs($user)->get(route('student_create'));

        // A = Assert
        $response->assertStatus(200)->assertSeeText("");
    }

    // Student Data Store
    public function test_student_store()
    {

        $user = User::factory()->create(); // Using for Auth

        // Arrange
        $data = [

            "roll" => 6,
            "name" => "afzal",
            "email" => "afzal@gmail.com",
            "phone" => "01811178307",
        ];

        // Act
        $this->withoutExceptionHandling(); // Validator Data error show message (302)
        $response = $this->actingAs($user)->post(route('student.store', $data));

        // A = Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('students', $data); // Has = Chacking Data
    }

    // Student Edit Test Function
    public function test_student_edit()
    {

        $user = User::factory()->create(); // Using for Auth

        // Arrange
        $data = StudentFactory::new()->create(); //Darta create korba

        // Act
        $this->withoutExceptionHandling(); // Validator Data error show message (302)
        $response = $this->actingAs($user)->get(route('student.edit', ['id' => $data->id]));

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


        $user = User::factory()->create(); // Using for Auth
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
        $response = $this->actingAs($user)->put(route('student.update', ['id' => $data->id]), $update);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('students', $update); // Check Data
        $this->assertDatabaseMissing('students', $data->toArray());
    }


    // Student Delete Test Function
    public function test_student_delete()
    {

        $user = User::factory()->create(); // Using for Auth
        // Arrange
        $data = StudentFactory::new()->create();

        // Act
        $response = $this->actingAs($user)->delete(route('student.delete', ['id' => $data->id]));

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseMissing('students', ['id' => $data->id]); // Missing =  Missing Data

    }
}
