<?php

namespace App\Http\Controllers\Membership;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Plan;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Membership::filter(request(['search','type']))->with('member','plan')->latest()->paginate(10)->withQueryString();  
        return view('membership.index',compact('datas'));
    } 

    public function extendform(string $id){
        $membership = Membership::where('member_id',$id)->with('member','plan')->first();
        if(!$membership){
            return back();
        }
        $plans = Plan::get();
        return view('membership.extend',compact('membership','plans'));
    }

    public function extendPlan(Request $request){
        
        $request->validate([
            'plan_id' => 'required|string'
        ]);

        $id = $request->id;
        $plan_id = filter_var($request->plan_id,FILTER_SANITIZE_NUMBER_INT);
        
        //get remaining date
        $membership = Membership::find($id);

        // $start = Carbon::parse($membership->plan_start_date);
        $end = Carbon::parse($membership->plan_expire_date);

        $now = Carbon::now();
        $isExpired = $now->gt($end);

        $remainDay = 0;

        if(!$isExpired){
            $remainDay = Carbon::now()->diffInDays($end);
        }

        //get expire date
        $date = Carbon::now();
        $getPlan = Plan::find($plan_id);

        if($getPlan->type == 'Month'){
            $plan_expire_date = $date->addMonth($getPlan->period);
            $plan_expire_date->addDays($remainDay);
        }
        if($getPlan->type == 'Year'){
            $plan_expire_date =  $date->addYear($getPlan->period);
            $plan_expire_date->addDays($remainDay);
        }

        $plan_expire_date->format('Y-m-d');

        try{
            Membership::where('id',$id)->update([
                'member_id' => $membership->member_id,
                'plan_id' => $plan_id,
                'plan_start_date' => Carbon::now()->format('Y-m-d'),
                'plan_expire_date' => $plan_expire_date
            ]);
        }catch(Exception $e){
            return back()->with('error',['type' => 'fail','text' => 'Fail to extend membership']);
        }

        return redirect()->route('membership.index')->with('msg',['type' => 'success','text' => 'Membership successfully extended']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Membership $membership)
    {
        $plans = Plan::get();
        return view('membership.update',compact('membership','plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'plan_id' => 'required|integer',
            'plan_expire_date' => 'required|string'
        ]);

        $plan_id = filter_var($request->plan_id,FILTER_SANITIZE_NUMBER_INT);
        $plan_expire_date = filter_var($request->plan_expire_date,FILTER_SANITIZE_NUMBER_INT);
        
        try{
            Membership::where('id',$id)->update([
                'plan_id' => $plan_id,
                'plan_expire_date' => $plan_expire_date
            ]);
        }catch(Exception $e){
            return back()->with('error',['type' => 'fail','text' => 'Fail to update membership']);
        }

        return redirect()->route('membership.index')->with('msg',['type' => 'success','text' => 'Membership update success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
