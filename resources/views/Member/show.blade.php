@php
    use Carbon\Carbon;
@endphp
@extends('layout/master')
@section('content')
    <div class="w-[95%] mx-auto">
        <div class="border border-gray-900 py-3 px-5 rounded bg-black flex">
            <button onclick="history.back()"><i class="bi bi-arrow-left text-lg text-white hover:bg-gray-700 rounded-full px-2 py-1"></i></button>
            <h2 class="flex-1 text-center font-semibold text-white"><span class="text-slate-400"><i class="bi bi-people me-3 text-lg"></i></span>Member Profile</h2>
        </div>

        <div class="lg:w-8/12 mx-auto mt-3">
            <h2 class="text-white font-semibold mb-2 text-lg">Member Information</h2>
            <div class=" text-white border border-slate-700 rounded-md border-dashed px-6 pt-4 pb-6 flex justify-center items-start flex-wrap">
                <div class="w-screen md:w-6/12">
                    <div class="mb-4 flex items-start gap-3">
                        <i class="bi bi-person text-slate-500 mt-[2px]"></i>
                        <div>
                            <h2 class="font-semibold">Name</h2>
                            <h2 class="text-gray-400 text-sm">{{$member->name}}</h2>
                        </div>
                    </div>
                    <div class="mb-4 flex items-start gap-3">
                        <i class="bi bi-cake2 text-slate-500 mt-[2px]"></i>
                        <div>
                            <h2 class="font-semibold">Date of birth</h2>
                            <h2 class="text-gray-400 text-sm">{{$member->dob}}</h2>
                        </div>
                    </div>
                    <div class="mb-4 flex items-start gap-3">
                        <i class="bi bi-telephone text-slate-500 mt-[2px]"></i>
                        <div>
                            <h2 class="font-semibold">Phone</h2>
                            <h2 class="text-gray-400 text-sm">{{$member->phone}}</h2>
                        </div>
                    </div>
                    <div class=" flex items-start gap-3">
                        <i class="bi bi-geo-alt text-slate-500 mt-[2px]"></i>
                        <div>
                            <h2 class="font-semibold">Address</h2>
                            <h2 class="text-gray-400 text-sm">{{$member->address}}</h2>
                        </div>
                    </div>
                </div>
                <div class="w-screen md:w-6/12">
                    <div class="mb-4 flex items-start gap-3">
                        <i class="bi bi-gender-ambiguous text-slate-500 mt-[2px]"></i>
                        <div>
                            <h2 class="font-semibold mb-1">Gender</h2>
                            @if($member->gender == 'male')
                                <h2 class="text-cyan-500 text-sm border border-cyan-500 rounded-full px-2 py-[1px]"><i class="bi bi-gender-male text-sm me-1"></i>{{ucfirst($member->gender)}}</h2>
                            @else
                                <h2 class="text-pink-500 text-sm border border-pink-500 rounded-full px-2 py-[1px]"><i class="bi bi-gender-female text-sm me-1"></i>{{ucfirst($member->gender)}}</h2>
                            @endif
                        </div>
                    </div>
                    @php
                        $dob = Carbon::parse($member->dob);
                        $now = Carbon::now();
                        $age = $now->diffInYears($dob);
                    @endphp
                    <div class="mb-4 flex items-start gap-3">
                        <i class="bi bi-activity text-slate-500 mt-[2px]"></i>
                        <div>
                            <h2 class="font-semibold">Age</h2>
                            <h2 class="text-gray-400 text-sm">{{$age}}</h2>
                        </div>
                    </div>
                    <div class="mb-4 flex items-start gap-3">
                        <i class="bi bi-card-text text-slate-500 mt-[2px]"></i>
                        <div>
                            <h2 class="font-semibold">Workout Status</h2>
                            <h2 class="text-gray-400 text-sm">{{$member->status}}</h2>
                        </div>
                    </div>
                    <div class=" flex items-start gap-3">
                        <i class="bi bi-buildings text-slate-500 mt-[2px]"></i>
                        <div>
                            <h2 class="font-semibold">Branch</h2>
                            <h2 class="text-gray-400 text-sm">{{$member->branch->name}}</h2>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end items-center gap-2 sm:w-[62%]">
                    <a title="Edit member" href="{{route('member.edit',$member->id)}}" class="bg-gray-950 hover:bg-gray-600 px-4 py-1 shadow-md text-white rounded-sm me-2 border border-slate-600"><i class="bi bi-pencil text-sm me-1"></i> Update</a>
                    <button title="Delete member" onclick="confirmDel('/member',{{$member->id}})" class="bg-red-500 hover:bg-red-900 px-4 shadow-md py-1 text-white rounded-sm me-2"><i class="bi bi-trash3 text-sm me-1"></i> Delete</button>
                </div>
            </div>
        </div>

        @if($membership)
        <div class="lg:w-8/12 mx-auto mt-4">
            <h2 class="text-white font-semibold mb-2 text-lg">Membership</h2>
            <div class=" text-white border border-slate-700 rounded-md border-dashed pt-6 pb-7">
                <div class="flex justify-around items-center flex-wrap">
                    <div class="">
                        <h2 class="text-gray-200 font-semibold text-sm">Plan Expire Date</h2>
                        <h2 class="text-slate-300/90">{{$membership->plan_expire_date}}</h2>
                    </div>
                    <div class="">
                        <h2 class="text-gray-200 font-semibold text-sm">Current Plan</h2>
                        <span class="px-2 pb-[3px] text-white rounded-3xl bg-slate-600 text-sm shadow-sm border border-slate-500/50">{{$membership->plan->name}}</span>
                    </div>
                    @php
                        $end = Carbon::parse($membership->plan_expire_date);
                        $now = Carbon::now();
                        $isExpired = $now->gt($end);
                        if($isExpired){
                            $remainDay = '--';
                            $isActive = false;
                        }else{
                            $remainDay = Carbon::now()->diffInDays($end) .' day left';
                            $isActive = true;
                        }
                    @endphp
                    <div class="">
                        <h2 class="text-gray-200 font-semibold text-sm">Plan Remaining Day</h2>
                        <h2 class="text-slate-300/90 text-center">{{$remainDay}}</h2>
                    </div>
                    <div class="">
                        <h2 class="text-gray-200 font-semibold text-sm">Plan Status</h2>
                        @if($isActive)
                        <span class="w-[8px] h-[8px] rounded-full inline-block bg-emerald-400 me-1 mb-[1px]"></span><span class="text-emerald-400">Active</span>
                        @else
                        <span class="w-[8px] h-[8px] rounded-full inline-block bg-red-600 me-1 mb-[1px]"></span><span class="text-red-600">Expired</span>
                        @endif
                    </div>
                </div>  

                <div class="w-[93%] mx-auto border-t border-dashed border-slate-800 flex justify-end items-center flex-wrap mt-5 pt-6 gap-2">
                    <a title="Edit membership manually" href="{{route('membership.edit',$membership->id)}}" class="bg-gray-950 hover:bg-gray-600 px-2 py-1 shadow-md text-white -sm me-2 border border-slate-600 rounded-sm"><i class="bi bi-pencil text-sm me-2"></i>Update Membership</a>
                    <a href="{{route('membership.extendform',$membership->member_id)}}" class="text-sm text-white shadow-md bg-blue-600 px-3 py-[6px] hover:bg-blue-800 rounded-sm"><i class="bi bi-plus-lg me-2"></i>Extend plan</a>
                </div>
            </div>
        </div>
        @endif

        @if(count($fdatas) > 0)
        {{-- table --}}
        <div class="relative overflow-x-auto px-3 pb-3 mt-6 mb-5">
            <div class="flex justify-between items-center flex-wrap mb-2">
                <h2 class="text-white font-semibold text-lg">Monthly fitness data of {{$member->name}}</h2>
                <a href="{{url('monthlyfitnessdata/create?id='.$member->id)}}" class="text-sm text-white drop-shadow shadow-md bg-amber-500 px-3 py-[6px] hover:bg-amber-700 rounded-sm">Add monthly fitness data</a>
            </div>

            <table class="bg-[#2f3541]/70 w-full text-sm text-left text-gray-200 rtl:text-right border border-gray-700">
                <thead class="text-xs text-gray-100 uppercase bg-gray-700 ">
                    <tr>
                        <th scope="col" class="ps-3 py-3">
                            Name
                        </th>
                        <th scope="col" class="ps-3 py-3">
                            Weight
                        </th>
                        <th scope="col" class="ps-3 py-3">
                            Height
                        </th>
                        <th scope="col" class="ps-3 py-3">
                            BMI
                        </th>
                        <th scope="col" class="ps-3 py-3">
                            BMI Status
                        </th>
                        <th scope="col" class="ps-3 py-3">
                            Chest
                        </th>
                        <th scope="col" class="ps-3 py-3">
                            Shoulder
                        </th>
                        <th scope="col" class="ps-3 py-3">
                            Waist
                        </th>
                        <th scope="col" class="ps-3 py-3">
                            Hip
                        </th>
                        <th scope="col" class="ps-3 py-3">
                            Date
                        </th>
                        <th scope="col" class="ps-3 py-3 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($fdatas as $fdata)
                        <tr class="border-b border-gray-700">
                            <th class="ps-3 py-4 font-medium">
                                {{$fdata->member->name}}
                            </th>
                            <td class="ps-3 py-4">
                                {{$fdata->weight}}<span class="text-gray-400 text-xs"> lbs</span>
                            </td>
                            <td class="ps-3 py-4">
                                {{$fdata->height}}<span class="text-gray-400 text-xs"> inch</span>
                            </td>
                            <td class="ps-3 py-4 font-bold text-[17px]">
                                {{$fdata->bmi_no}}
                            </td>
                            <td class="py-4 text-center">
                                @php
                                    $color = '';
                                    if($fdata->bmi_status == 'Underweight'){
                                        $color = 'blue-400';
                                    }elseif($fdata->bmi_status == 'Normal weight'){
                                        $color = 'green-400';
                                    }elseif($fdata->bmi_status == 'Overweight'){
                                        $color = 'yellow-400';
                                    }elseif($fdata->bmi_status == 'Obesity'){
                                        $color = 'orange-500';
                                    }
                                @endphp
                                <span class="border border-{{$color}} text-{{$color}} px-2 pt-[1px] pb-[3px] rounded-full text-[12.5px]">{{$fdata->bmi_status}}</span>
                            </td>
                            <td class="ps-3 py-4">
                                {{$fdata->chest_size}}<span class="text-gray-400 text-xs"> inch</span>
                            </td>
                            <td class="ps-3 py-4">
                                {{$fdata->shoulder_size}}<span class="text-gray-400 text-xs"> inch</span>
                            </td>
                            <td class="ps-3 py-4">
                                {{$fdata->waist_size}}<span class="text-gray-400 text-xs"> inch</span>
                            </td>
                            <td class="ps-3 py-4">
                                {{$fdata->hip_size}}<span class="text-gray-400 text-xs"> inch</span>
                            </td>
                            <td class="ps-3 py-4">
                                {{$fdata->date}}
                            </td>
                            <td class="px-3 py-4 flex justify-center border-none">
                                <a title="Edit monthly data" href="{{route('monthlyfitnessdata.edit',$fdata->id)}}" class="bg-gray-950 hover:bg-gray-600 px-2 py-1 shadow-md text-white rounded-sm me-3 border border-slate-600"><i class="bi bi-pencil text-sm"></i></a>
                                <button title="Delete monthly data" onclick="confirmDel('/monthlyfitnessdata',{{$fdata->id}})" class="bg-red-500 hover:bg-red-900 px-2 shadow-md py-1 text-white rounded-sm"><i class="bi bi-trash3 text-sm"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
@endsection

@section('script')

@endsection