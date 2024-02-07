<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Exception;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::paginate(5);
        return view('branch.index',compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branch.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string'
        ]);

        $name = filter_var($request->name,FILTER_SANITIZE_STRING);
        $address = filter_var($request->address,FILTER_SANITIZE_STRING);

        try{
            Branch::create([
                'name' => $name,
                'address' => $address
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('error','Fail to create branch')->withInput();
        }

        return redirect()->route('branch.index')->with('msg',['type' => 'success','text' => 'Branch Create success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    { 
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('branch.update',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string'
        ]); 

        $name = filter_var($request->name,FILTER_SANITIZE_STRING);
        $address = filter_var($request->address,FILTER_SANITIZE_STRING);

        try{
            Branch::where('id',$id)->update([
                'name' => $name,
                'address' => $address
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('error','Fail to update branch')->withInput();
        }

        return redirect()->route('branch.index')->with('msg',['type' => 'success','text' => 'Branch Update success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            Branch::where('id',$id)->delete();
        }catch(Exception $e){
            return redirect()->back()->with('msg',['type' => 'fail','text' => 'Fail to  delete branch']);
        }

        return redirect()->route('branch.index')->with('msg',['type' => 'success','text' => 'Branch Deleted']);
    }
}
