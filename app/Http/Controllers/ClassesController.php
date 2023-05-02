<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\classes;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('classes')->whereNull('deleted_at')->get();
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
            // Insert a new record into the classes table
            $classes = new classes();
            columnSetter($classes, $request);
            $id = IdGenerator::generate(['table' => 'classes', 'field' => 'class_id', 'length' => 10, 'prefix' => 'CL' . date('mdy')]);
            $classes->class_id = $id;
            $classes->save();
    
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
     * @param  \App\Models\classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\classes  $classes
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
     * @param  \App\Models\classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $classes = classes::find($id);
        $classes->update($req->all());
        return $classes;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classes = classes::find($id);
        $classes->delete();
        return $classes->Redirect::back();
    }
}
