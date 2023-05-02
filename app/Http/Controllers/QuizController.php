<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\quizzes;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('quizzes')->whereNull('deleted_at')->get();
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
            // Insert a new record into the quizzes table
            $quizzes = new quizzes();
            columnSetter($quizzes, $request);
            $id = IdGenerator::generate(['table' => 'quizzes', 'field' => 'quiz_id', 'length' => 10, 'prefix' => 'P' . date('mdy')]);
            $quizzes->quiz_id = $id;
            $quizzes->save();
    
    
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
     * @param  \App\Models\quizzes  $quizzes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\quizzes  $quizzes
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
     * @param  \App\Models\quizzes  $quizzes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $quizzes = quizzes::find($id);
        $quizzes->update($req->all());
        return $quizzes;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\quizzes  $quizzes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quizzes = quizzes::find($id);
        $quizzes->delete();
        return $quizzes->Redirect::back();
    }
}
