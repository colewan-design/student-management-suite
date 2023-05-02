<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('documents')->whereNull('deleted_at')->get();
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
                // Insert a new record into the document table
                $document = new Document();
                columnSetter($document, $request);
                $id = IdGenerator::generate(['table' => 'documents', 'field' => 'document_id', 'length' => 10, 'prefix' => 'B' . date('mdy')]);
                $document->document_id = $id;
                $document->save();
        
                if ($request->hasFile('document_file')) {
                    $file = $request->file('document_file');
                    $filename = date('Ymd', strtotime(now())) . '-' . $file->getClientOriginalName();
                    $file->move(public_path('document_file'), $filename);
                }
        
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
     * @param  \App\Models\document  $document
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\document  $document
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
     * @param  \App\Models\document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $document = document::find($id);
        $document->update($req->all());
        return $document;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = document::find($id);
        $document->delete();
        return $document->Redirect::back();
    }
}
