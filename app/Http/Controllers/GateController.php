<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Gate;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class GateController extends Controller
{
    public function index()
    {
        return DB::table('gates')->get();
    }
    public function saveLog(Request $request)
        {
            $validatedData = $request->validate([
                'student_id' => 'required|string',
                'status' => 'required|string',
                'dateTime' => 'required|date_format:Y-m-d H:i:s',
            ]);

            $gate = new Gate();
            $gate->student_id = $validatedData['student_id'];
            $gate->status = $validatedData['status'];
            $gate->dateTime = $validatedData['dateTime'];
            $gate->save();

            return response()->json([
                'message' => 'Data saved successfully'
            ]);
        }

}
