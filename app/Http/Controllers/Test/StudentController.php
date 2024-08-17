<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    //
    private $db_student;

    public function __construct()
    {
        $this->db_student = "students";
    }

    public function all_student()
    {
        $all_students = DB::table($this->db_student)->get();
        // dd($all_students);
        return response()->json($all_students);
    }

    // create Student create function
    public function Student_Create()
    {
        return view('students.create');
    }

    // Student Store function
    public function Student_Store(Request $request)
    {


        // Validate
        $validate = $request->validate([

            "roll" => "required",
            "name" => "required",
            "email" => "required",
        ]);

        // insert
        $data = array();
        $data['roll'] = $request->roll;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;

        DB::table($this->db_student)->insert($data);
        return response()->json('success', 200);
    }

    // Student Edit Function
    public function Student_Edit($id)
    {
        $student_edit = DB::table($this->db_student)->where('id', $id)->first();
        return response()->json($student_edit);
    }

    // Delete Student 
    public function Student_Delete($id)
    {

        $delete_student = DB::table($this->db_student)->where('id', $id)->delete();
        return response()->json($delete_student);
    }

    // Student Update Function
    public function Student_Update(Request $request, $id)
    {

        // Validate
        $validate = $request->validate([

            "roll" => "required",
            "name" => "required",
            "email" => "required",
        ]);

        // Update Data
        $data = array();
        $data['roll'] = $request->roll;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;

        DB::table($this->db_student)->where('id', $id)->update($data);
        return response()->json($data);
    }
}
