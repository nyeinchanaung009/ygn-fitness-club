<?php

namespace App\Http\Controllers\Monthlyfitnessdata;

use App\Http\Controllers\Controller;
use App\Models\MonthlyFitnessData;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use App\Helpers\BMIHelper;

class MonthlyfitnessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fitnessDatas = MonthlyFitnessData::filter(request(['month','year','search']))->with('member')->latest()->paginate(10)->withQueryString();
        return view('monthly_fitness_data.index',compact('fitnessDatas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $member_id = $request->id;
        return view('monthly_fitness_data.create',compact('member_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric',
            'height' => 'required|numeric'
        ]);
        
        $member_id = $request->member_id;
        $weight = $request->weight;
        $height = $request->height;
        $chest_size = filter_var($request->chest_size,FILTER_SANITIZE_NUMBER_INT);
        $shoulder_size = filter_var($request->shoulder_size,FILTER_SANITIZE_NUMBER_INT);
        $waist_size = filter_var($request->waist_size,FILTER_SANITIZE_NUMBER_INT);
        $hip_size = filter_var($request->hip_size,FILTER_SANITIZE_NUMBER_INT);

        //calculate bmi
        $bmi = BMIHelper::calculateBMI($weight,$height);

        try{
            MonthlyFitnessData::create([
                'member_id' => $member_id,
                'weight' => $weight,
                'height' => $height,
                'chest_size' => $chest_size,
                'shoulder_size' => $shoulder_size,
                'waist_size' => $waist_size,
                'hip_size' => $hip_size,
                'bmi_no' => $bmi['number'],
                'bmi_status' => $bmi['status'],
                'date' => Carbon::now()->format('Y-m-d')
            ]);
        }catch(Exception $e){
            return back()->with('error','Fail to create new monthly data')->withInput();
        }

        return redirect()->route('monthlyfitnessdata.index')->with('msg',['type' => 'success','text' => 'Monthly fitness data create success']);
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
    public function edit(string $id)
    {
        $fdata = MonthlyFitnessData::find($id);
        // dd($fdata);
        return view('monthly_fitness_data.update',compact('fdata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'date' => 'required|string'
        ]);

        $member_id = $request->member_id;
        $weight = $request->weight;
        $height = $request->height;
        $chest_size = filter_var($request->chest_size,FILTER_SANITIZE_NUMBER_INT);
        $shoulder_size = filter_var($request->shoulder_size,FILTER_SANITIZE_NUMBER_INT);
        $waist_size = filter_var($request->waist_size,FILTER_SANITIZE_NUMBER_INT);
        $hip_size = filter_var($request->hip_size,FILTER_SANITIZE_NUMBER_INT);
        $date = filter_var($request->date,FILTER_SANITIZE_STRING);

        //calculate bmi
        $bmi = BMIHelper::calculateBMI($weight,$height);

        try{
            MonthlyFitnessData::create([
                'member_id' => $member_id,
                'weight' => $weight,
                'height' => $height,
                'chest_size' => $chest_size,
                'shoulder_size' => $shoulder_size,
                'waist_size' => $waist_size,
                'hip_size' => $hip_size,
                'bmi_no' => $bmi['number'],
                'bmi_status' => $bmi['status'],
                'date' => $date
            ]);
        }catch(Exception $e){
            return back()->with('error','Fail to update monthly data')->withInput();
        }

        return redirect()->route('monthlyfitnessdata.index')->with('msg',['type' => 'success','text' => 'Monthly fitness data update success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            MonthlyFitnessData::find($id)->delete();
        }catch(Exception $e){
            return back()->with('msg',['type' => 'fail','text' => 'Fail to delete']);
        }
        return redirect()->route('monthlyfitnessdata.index')->with('msg',['type' => 'success','text' => 'Data deleted']);
    }
}
