<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\teacher;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('teachers')->whereNull('deleted_at')->get();
    }

    public function account()
    {
        $user = auth()->user();
        return $user;
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
            $teachers = new teacher();
            columnSetter($teachers, $request);
            $id = IdGenerator::generate(['table' => 'teachers', 'field' => 'account_id', 'length' => 10, 'prefix' => 'T' . date('mdy')]);
            $teachers -> account_id = $id;
            $teachers->save();
    
            // Insert a new record into the users table
            $user = new User();
            $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
            $user->email = $request->input('email');
            $user->password = bcrypt('password');
            $user->role = 'Teacher'; 
            $user->contact_number = $request->input('contact_number');
            $user->account_id = $teachers->account_id;
            $user->save();
    
            DB::commit(); // Commit the transaction
            return Redirect::back()->with('success', 'Teacher added successfully. Name: ' . $request->input('first_name') . ', User: ' . $request->input('user_name'));
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction if an error occurred
            throw $e;
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DB::table('teachers')->select('position')->where('account_id', $id)->whereNull('deleted_at')->first();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $teachers = teacher::find($id);
        $teachers->update($req->all());
        return $teachers;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teachers = teacher::find($id);
        $teachers->delete();
        return $teachers->Redirect::back();
    }
}
?>