<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Students;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStudents()
    {
        $students = DB::table('students')->get();
        return response()->json($students);
    }

    public function getAges()
    {
        $ages = DB::table('students')->distinct()->pluck('age');
        return response()->json($ages);
    }
    public function getDropouts()
    {
        $dropouts = DB::table('students')->distinct()->pluck('dropout');
        return response()->json($dropouts);
    }
    public function getGenders()
    {
        $genders = DB::table('students')->distinct()->pluck('gender');
        return response()->json($genders);
    }
    public function getAddresses()
    {
        $addresses = DB::table('students')->distinct()->pluck('address');
        return response()->json($addresses);
    }
    
    
    public function getSections()
        {
            $sections = DB::table('students')->distinct()->pluck('section');
            return response()->json($sections);
        }
    public function index()
    {
        return DB::table('students')->whereNull('deleted_at')->get();
    }
    public function count()
    {
        $count = DB::table('students')->whereNull('deleted_at')->count();
        return response()->json(['count' => $count]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        DB::beginTransaction();
    
        try {
            // Insert a new record into the parents table
            $students = new students();
            columnSetter($students, $request);
            $id = IdGenerator::generate(['table' => 'students', 'field' => 'account_id', 'length' => 10, 'prefix' => 'ST' . date('mdy')]);
            $students->account_id = $id;
            $students->save();

            // Insert a new record into the users table
            $user = new User();
            $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
            $user->email = $request->input('email');
            $user->contact_number = $request->input('contact_number');
            $user->password = bcrypt('password');
            $user->role = 'Student';
            $user->account_id = $students->account_id;
            $user->save();
    
            DB::commit(); // Commit the transaction
            return Redirect::back();
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction if an error occurred
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $students = students::find($id);
        $students->update($req->all());
        return $students;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $students = students::find($id);
        $students->delete();
        return $students->Redirect::back();
    }
}
