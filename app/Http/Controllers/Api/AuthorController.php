<?php

namespace emutoday\Http\Controllers\Api;

use emutoday\Author;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input as Input;

use emutoday\Emutoday\Transformers\FractalBugzTransformerModel;
use League\Fractal\Manager;
use League\Fractal;

class AuthorController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

            $author = new Author;
            $author->last_name       	=  $request->get('last_name');
            $author->first_name       	=  $request->get('first_name');
            $author->email       	      =  $request->get('email');
            $author->phone           	= $request->get('phone');

            if($author->save()) {
                 return response()->json([
                         'success' => true,
                         'author' => $author
                     ], 201);
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
    public function update(Request $request, $id)
    {
            $author = Author::findOrFail($id);
            $author->last_name       	=  $request->get('last_name');
            $author->first_name       	=  $request->get('first_name');
            $author->email       	      =  $request->get('email');
            $author->phone           	= $request->get('phone');
            if($author->save()) {
                return response()->json([
                        'success' => true,
                        'author' => $author
                    ], 201);
                }
        }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    
}
