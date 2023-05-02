<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\staffs;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('staffs')->whereNull('deleted_at')->get();
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
            // Insert a new record into the staffs table
            $staffs = new staffs();
            columnSetter($staffs, $request);
            if ( $staffs -> role == 'Finance Officer' ) {
                $id = IdGenerator::generate(['table' => 'staffs', 'field' => 'account_id', 'length' => 10, 'prefix' => 'FO' . date('mdy')]);
                $staffs->account_id = $id;
            }elseif ( $staffs -> role == 'School Admin' ) {
                $id = IdGenerator::generate(['table' => 'staffs', 'field' => 'account_id', 'length' => 10, 'prefix' => 'SAD' . date('mdy')]);
                $staffs->account_id = $id;
            }elseif ( $staffs -> role == 'Staff' ) {
                $id = IdGenerator::generate(['table' => 'staffs', 'field' => 'account_id', 'length' => 10, 'prefix' => 'S' . date('mdy')]);
                $staffs->account_id = $id;
            }elseif ( $staffs -> role == 'Guard' ) {
                $id = IdGenerator::generate(['table' => 'staffs', 'field' => 'account_id', 'length' => 10, 'prefix' => 'G' . date('mdy')]);
                $staffs->account_id = $id;
            }
            $staffs->save();

            // Insert a new record into the users table
            $user = new User();
            $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
            $user->email = $request->input('email');
            $user->password = bcrypt('password');
            $user->role = $request->input('role');
            $user->contract_type = $request->input('contract_type');
            $user->shift = $request->input('shift');
            $user->location = $request->input('location');
            $user->joining_date = $request->input('joining_date');
            $user->account_id = $staffs->account_id;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $staffs = staffs::find($id);
        $staffs->update($req->all());
        return $staffs;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staffs = staffs::find($id);
        $staffs->delete();
        return $staffs->Redirect::back();
    }
}