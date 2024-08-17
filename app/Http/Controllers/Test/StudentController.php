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
        // return redirect()->json($all_students);
        return response()->json($all_students);
    }
}
