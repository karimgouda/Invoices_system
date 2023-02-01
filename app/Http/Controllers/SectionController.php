<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = section::all();
        return view('sections.section',['sections'=>$sections]);
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

        $request->validate([
            'section_name'=>'required|unique:sections|max:255',
            'description'=>'required'
        ],[
            'section_name.required'=>'يرجي ادخال اسم القسم',
            'section_name.unique'=>'عذرآ اسم القسم مسجل مسبقآ',
            'description.required'=>'يرجي ادخال الوصف'

        ]);

      
            section::create([
                'section_name'=>$request->section_name,
                'description'=>$request->description,
                'created_by'=>(Auth::user()->name)
            ]);
            session()->flash('add','تم اضافه القسم بنجاح');
            return redirect('/sections');
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
          $data = $request->validate([
            'section_name'=>'required|max:255'.$id,
            'description'=>'required'
        ],[
            'section_name.required'=>'يرجي ادخال اسم القسم',
            // 'section_name.unique'=>'عذرآ اسم القسم مسجل مسبقآ',
            'description.required'=>'يرجي ادخال الوصف'

        ]);

        $sections = section::find($id);
        $sections->update($data);
        session()->flash('edit','نم تعديل القسم بنجاح');
        return redirect("/sections");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
       section::find($id)->delete();
       session()->flash('delete','تم حذف القسم بنجاح');
       return redirect("/sections");
        
    }
}
