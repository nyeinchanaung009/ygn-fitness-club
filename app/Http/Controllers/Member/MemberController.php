<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Member;
use App\Models\Membership;
use App\Models\MonthlyFitnessData;
use App\Models\Plan;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $members = Member::filter(request(['branch','search']))->with('branch')->latest()->paginate(10)->withQueryString();
        $branches = Branch::get();
        return view('member.index',compact('members','branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::get();
        $plans = Plan::get();
        return view('member.create',compact('branches','plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string',
            'gender' => 'required|string',
            'status' => 'required|string',
            'branch_id' => 'required|integer',
            'plan_id' => 'required|integer',
        ]);

        $name = filter_var($request->name,FILTER_SANITIZE_STRING);
        $dob = filter_var($request->dob,FILTER_SANITIZE_NUMBER_INT);
        $phone = filter_var($request->phone,FILTER_SANITIZE_STRING);
        $address = filter_var($request->address,FILTER_SANITIZE_STRING);
        $status = filter_var($request->status,FILTER_SANITIZE_STRING);
        $branch_id = filter_var($request->branch_id,FILTER_SANITIZE_NUMBER_INT);
        $gender = filter_var($request->gender,FILTER_SANITIZE_STRING);
        $plan_id = filter_var($request->plan_id,FILTER_SANITIZE_NUMBER_INT);

        // calculate expired date
        $date = Carbon::now();
        $getPlan = Plan::find($plan_id);

        if($getPlan->type == 'Month'){
            $plan_expire_date = $date->addMonth($getPlan->period);
        }
        if($getPlan->type == 'Year'){
            $plan_expire_date =  $date->addYear($getPlan->period);
        }

        $plan_expire_date->format('Y-m-d');
        
        try{
            $member = Member::create([
                'name' => $name,
                'dob' => $dob,
                'phone' => $phone,
                'address' => $address,
                'gender' => $gender,
                'status' => $status,
                'branch_id' => $branch_id
            ]);

            Membership::create([
                'member_id' => $member->id,
                'plan_id' => $plan_id,
                'plan_start_date' => Carbon::now()->format('Y-m-d'),
                'plan_expire_date' => $plan_expire_date
            ]);

        }catch(Exception $e){
            return back()->with('error','Fail to create new member')->withInput();
        }
        
        return redirect()->route('member.index')->with('msg',['type' => 'success','text' => 'Member create success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        $member = $member->load('branch');
        $membership = Membership::where('member_id',$member->id)->first();
        $fdatas = MonthlyFitnessData::where('member_id',$member->id)->paginate(10);
        return view('member.show',compact('member','membership','fdatas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        $branches = Branch::get();
        return view('member.update',compact('member','branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'gender' => 'required|string',
            'status' => 'required|string',
            'branch_id' => 'required|integer'
        ]);

        $name = filter_var($request->name,FILTER_SANITIZE_STRING);
        $dob = filter_var($request->dob,FILTER_SANITIZE_NUMBER_INT);
        $phone = filter_var($request->phone,FILTER_SANITIZE_STRING);
        $address = filter_var($request->address,FILTER_SANITIZE_STRING);
        $status = filter_var($request->status,FILTER_SANITIZE_STRING);
        $branch_id = filter_var($request->branch_id,FILTER_SANITIZE_NUMBER_INT);
        $gender = filter_var($request->gender,FILTER_SANITIZE_STRING);

        try{
            Member::where('id',$id)->update([
                'name' => $name,
                'dob' => $dob,
                'phone' => $phone,
                'address' => $address,
                'gender' => $gender,
                'status' => $status,
                'branch_id' => $branch_id
            ]);
            
        }catch(Exception $e){
            return back()->with('error','Fail to update member')->withInput();
        }
        
        return redirect()->route('member.index')->with('msg',['type' => 'success','text' => 'Member update success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            Member::find($id)->delete();
        }
        catch(Exception $e){
            return back()->with('msg',['type' => 'fail','text' => 'Fail to delete member']);
        }
        return redirect()->route('member.index')->with('msg',['type' => 'success','text' => 'Member deleted']);
    }
}
