<?php

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Exception;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::paginate(6);
        return view('plan.index',compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'period' => 'required|integer',
            'type' => 'required|string'
        ]);

        $name = filter_var($request->name,FILTER_SANITIZE_STRING);
        $price = filter_var($request->price,FILTER_SANITIZE_NUMBER_INT);
        $period = filter_var($request->period,FILTER_SANITIZE_NUMBER_INT);
        $type = filter_var($request->type,FILTER_SANITIZE_STRING);

        try{
            Plan::create([
                'name' => $name,
                'price' => $price,
                'period' => $period,
                'type' => $type
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('error','Fail to create plan')->withInput();
        }

        return redirect()->route('plan.index')->with('msg',['type' => 'success','text' => 'Plan Create success']);
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
    public function edit(Plan $plan)
    {
        return view('plan.update',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'period' => 'required|integer',
            'type' => 'required|string'
        ]); 

        $name = filter_var($request->name,FILTER_SANITIZE_STRING);
        $price = filter_var($request->price,FILTER_SANITIZE_NUMBER_INT);
        $period = filter_var($request->period,FILTER_SANITIZE_NUMBER_INT);
        $type = filter_var($request->type,FILTER_SANITIZE_STRING);

        try{
            Plan::where('id',$id)->update([
                'name' => $name,
                'price' => $price,
                'period' => $period,
                'type' => $type
            ]);
        }catch(Exception $e){
            return redirect()->back()->with('error','Fail to update Plan')->withInput();
        }

        return redirect()->route('plan.index')->with('msg',['type' => 'success','text' => 'Plan Update success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            Plan::where('id',$id)->delete();
        }catch(Exception $e){
            return redirect()->back()->with('msg',['type' => 'fail','text' => 'Fail to  delete plan']);
        }

        return redirect()->route('plan.index')->with('msg',['type' => 'success','text' => 'Plan Deleted']);
    }
}
