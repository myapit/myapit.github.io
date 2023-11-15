<?php

namespace App\Http\Controllers;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    // begin

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $staffs = Staff::orderBy('id','desc')->paginate(5);
        return view('staffs.index', compact('staffs'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('staffs.create');
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
            'name' => 'required',
            'email' => 'required',
            'position' => 'required',
            'address' => 'required',
        ]);
        
        Staff::create($request->post());

        return redirect()->route('staffs.index')->with('success','Staff has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Staff  $Staff
    * @return \Illuminate\Http\Response
    */
    public function show(Staff $Staff)
    {
        return view('staffs.show',compact('Staff'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Staff  $Staff
    * @return \Illuminate\Http\Response
    */
    public function edit(Staff $Staff)
    {
        return view('staffs.edit',compact('Staff'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Staff  $Staff
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Staff $Staff)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'position' => 'required',
            'address' => 'required',
        ]);
        
        $Staff->fill($request->post())->save();

        return redirect()->route('staffs.index')->with('success','Staff Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Staff  $Staff
    * @return \Illuminate\Http\Response
    */
    public function destroy(Staff $Staff)
    {
        $Staff->delete();
        return redirect()->route('staffs.index')->with('success','Staff has been deleted successfully');
    }

    //end
}
