<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\exams;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('exams')->whereNull('deleted_at')->get();
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
            // Insert a new record into the exams table
            $exams = new exams();
            columnSetter($exams, $request);
            $id = IdGenerator::generate(['table' => 'exams', 'field' => 'exam_id', 'length' => 10, 'prefix' => 'E' . date('mdy')]);
            $exams->exam_id = $id;
            $exams->save();
    
    
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
     * @param  \App\Models\exams  $exams
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\exams  $exams
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
     * @param  \App\Models\exams  $exams
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $exams = exams::find($id);
        $exams->update($req->all());
        return $exams;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\exams  $exams
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exams = exams::find($id);
        $exams->delete();
        return $exams->Redirect::back();
    }
}
