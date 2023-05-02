<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AttendanceController extends Controller
{
    public function saveAttendance(Request $request)
    {
        $date = $request->input('date');
        $students = $request->input('students');

        foreach ($students as $student) {
            $attendance = [
                'date' => $date,
                'student_id' => $student['id'],
                'status' => $student['present'] ? 'present' : 'absent'
            ];
            DB::table('attendances')->insert($attendance);
        }

        return response()->json(['message' => 'Attendance saved successfully.']);
    }
    public function getAttendance(Request $request)
    {
        $account_id = $request->input('account_id');

        $attendances = DB::table('attendances')
            ->where('student_id', '=', $account_id)
            ->get();

        return response()->json(['attendances' => $attendances]);
    }


}
