<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\relationship;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('relationship')->whereNull('deleted_at')->get();
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
            // Insert a new record into the relationship table
            $relationship = new relationship();
            columnSetter($relationship, $request);
            $id = IdGenerator::generate(['table' => 'relationship', 'field' => 'relationship_id', 'length' => 10, 'prefix' => 'AR' . date('mdy')]);
            $relationship->relationship_id = $id;
            $relationship->save();
    
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
     * @param  \App\Models\relationship  $relationship
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\relationship  $relationship
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
     * @param  \App\Models\relationship  $relationship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $relationship = relationship::find($id);
        $relationship->update($req->all());
        return $relationship;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\relationship  $relationship
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $relationship = relationship::find($id);
        $relationship->delete();
        return $relationship->Redirect::back();
    }
}
