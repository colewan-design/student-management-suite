<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\buildings;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BuildingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('buildings')->whereNull('deleted_at')->get();
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
            // Insert a new record into the buildings table
            $buildings = new buildings();
            columnSetter($buildings, $request);
            $id = IdGenerator::generate(['table' => 'buildings', 'field' => 'building_id', 'length' => 10, 'prefix' => 'B' . date('mdy')]);
            $buildings->building_id = $id;
            $buildings->save();
    
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
     * @param  \App\Models\buildings  $buildings
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\buildings  $buildings
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
     * @param  \App\Models\buildings  $buildings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $buildings = buildings::find($id);
        $buildings->update($req->all());
        return $buildings;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\buildings  $buildings
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buildings = buildings::find($id);
        $buildings->delete();
        return $buildings->Redirect::back();
    }
}
