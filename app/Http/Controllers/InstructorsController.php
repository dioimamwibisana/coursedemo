<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Instructor;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;

class InstructorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $instructors = Instructor::select(['id', 'name','gender']);
            return Datatables::of($instructors)
            ->addColumn('action', function($instructor){
            return view('datatable._action', [
            'model' => $instructor,
            'form_url' => route('instructors.destroy', $instructor->id),
            'edit_url' => route('instructors.edit', $instructor->id),
            ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
        ->addColumn(['data' => 'gender', 'gender'=>'gender', 'title'=>'Gender'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'Action', 'orderable'=>false, 'searchable'=>false]);
        return view('instructor.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required']);
        $instructor = Instructor::create($request->all());
        flash('Berhasil menyimpan instructor: '.$instructor->name, 'success');  
        return redirect()->route('instructors.index');
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
        $instructor = Instructor::find($id);
        return view('instructor.edit')->with(compact('instructor'));
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
        $this->validate($request, ['name' => 'required', 'gender' => 'required']);
        $instructor = Instructor::find($id);
        $instructor->update($request->all());
        flash('Berhasil update data instructor: '.$instructor->name, 'success');  
        return redirect()->route('instructors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Instructor::destroy($id);
        flash('Instructor berhasil dihapus', 'warning');
        return redirect()->route('instructors.index');
    }
}
