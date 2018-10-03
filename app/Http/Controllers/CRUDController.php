<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crud;

class CRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cruds = Crud::all()->toArray();
        
        return view('changerequest.index', compact('cruds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('changerequest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $crud = new Crud([
            '' => $request->get(''),
            '' => $request->get(''),
            '' => $request->get(''),
            '' => $request->get(''),
            '' => $request->get(''),
            '' => $request->get(''),
            '' => $request->get(''),
            '' => $request->get(''),
            '' => $request->get(''),
            '' => $request->get(''),
            '' => $request->get(''),
            '' => $request->get(''),
            '' => $request->get(''),
            '' => $request->get(''),
            '' => $request->get(''),
            '' => $request->get(''),
          ]);
  
          $crud->save();
          return redirect('/changerequest');
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
        $crud = Crud::find($id);
        
        return view('changerequest.edit', compact('crud','id'));
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
        $crud = Crud::find($id);
        $crud->title = $request->get('something');
        $crud->something = $request->get('something');
        $crud->something = $request->get('something');
        $crud->something = $request->get('something');
        $crud->something = $request->get('something');
        $crud->something = $request->get('something');
        $crud->something = $request->get('something');
        $crud->something = $request->get('something');
        $crud->something = $request->get('something');
        $crud->save();
        return redirect('/changerequest');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crud = Crud::find($id);
      $crud->delete();

      return redirect('/changerequest');
    }
}
