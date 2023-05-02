<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\student_grades;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class StudentGradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStudentGrades()
    {
        $StudentGrades = DB::table('student_grades')->get();
        return response()->json($StudentGrades);
    }
    public function index(Request $request)
    {
        $account_id = $request->input('account_id');
        return DB::table('student_grades')->where('student_id', $account_id)->get();
    }
    
    public function getGrades()
    {
        return DB::table('student_grades')
         ->select('student_id', 'subject_id', 'first_grading', 'second_grading', 'third_grading', 'fourth_grading')
         ->get();

    }
    public function store(Request $request)
    {
        $data = $request->only(['student_id', 'subject_id', 'first_grading', 'second_grading', 'third_grading', 'fourth_grading']);
    
        $id = IdGenerator::generate(['table' => 'student_grades', 'length' => 10, 'prefix' => date('Ymd')]);
    
        $studentGrade = new student_grades();
        $studentGrade->id = $id;
        $studentGrade->student_id = $data['student_id'];
        $studentGrade->subject_id = $data['subject_id'];
        $studentGrade->first_grading = $data['first_grading'];
        $studentGrade->second_grading = $data['second_grading'];
        $studentGrade->third_grading = $data['third_grading'];
        $studentGrade->fourth_grading = $data['fourth_grading'];
    
        $studentGrade->save();
    
        return response()->json(['message' => 'Student grade record saved successfully']);
    }
    public function update(Request $request)
    {
        $studentId = $request->input('student_id');
        $subjectId = $request->input('subject_id');
        $firstGrading = $request->input('first_grading');
        $secondGrading = $request->input('second_grading');
        $thirdGrading = $request->input('third_grading');
        $fourthGrading = $request->input('fourth_grading');

        $studentGrade = student_grades::where('student_id', $studentId)
                                    ->where('subject_id', $subjectId)
                                    ->first();

        if ($studentGrade) {
            $studentGrade->first_grading = $firstGrading;
            $studentGrade->second_grading = $secondGrading;
            $studentGrade->third_grading = $thirdGrading;
            $studentGrade->fourth_grading = $fourthGrading;
            $studentGrade->save();

            return response()->json(['message' => 'Record updated successfully']);
        }

        return response()->json(['message' => 'Record not found'], 404);
    }


    public function checkStudentGrades($student_id, $subject_id) {
        $exists = student_grades::where('student_id', $student_id)->where('subject_id', $subject_id)->exists();
        return response()->json(['exists' => $exists]);
      }
      

    

    
    
    
}