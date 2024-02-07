@php
    use Carbon\Carbon;
@endphp
@extends('layout/master')
@section('content')
    <div class="w-[95%] mx-auto">
        <div class="border border-gray-900 py-3 px-5 rounded bg-black flex">
            <button onclick="history.back()"><i class="bi bi-arrow-left text-lg text-white hover:bg-gray-700 rounded-full px-2 py-1"></i></button>
            <h2 class="flex-1 text-center font-semibold text-white"><span class="text-slate-400"><i class="bi bi-card-list me-3 text-lg"></i></span>Extend Membership</h2>
        </div>

        <div class="mt-9 bg-gray-900 border border-dashed border-slate-700/95 rounded sm:w-9/12 md:w-5/12 mx-auto px-5 py-4">
            <div class="border-b border-dashed pb-5 pt-1 border-slate-700/95 flex justify-between items-center">
                <div class="">
                    <h2 class="text-gray-200 font-semibold text-sm">Member ID</h2>
                    <h2 class="text-slate-300/90">{{$membership->member_id}}</h2>
                </div>
                <div class="">
                    <h2 class="text-gray-200 font-semibold text-sm">Name</h2>
                    <h2 class="text-slate-300/90">{{$membership->member->name}}</h2>
                </div>
                <div class="">
                    <h2 class="text-gray-200 font-semibold text-sm">Current Plan</h2>
                    <span class="px-2 pb-[3px] text-white rounded-3xl bg-slate-600 text-sm shadow-sm border border-slate-500/50">{{$membership->plan->name}}</span>
                </div>
            </div>
            <div class="flex justify-between items-center pt-5 pb-1">
                <div class="">
                    <h2 class="text-gray-200 font-semibold text-sm">Plan Expire Date</h2>
                    <h2 class="text-slate-300/90">{{$membership->plan_expire_date}}</h2>
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
        </div>

        <div class="sm:w-9/12 md:w-5/12 mx-auto mt-8 pt-5 border-t border-slate-900">
            @if(session('error'))
            <p class="bg-red-600 text-center rounded-sm py-2 text-white mb-3">{{session('error')}}</p>
            @endif
            <form action="{{route('membership.extendplan',$membership->id)}}" method="POST">
                @csrf
                <label for="plan_id" class="text-white">Select Plan</label>
                <select name="plan_id" id="plan_id" class="mt-2 w-full rounded p-2.5 focus:ring-2  focus:ring-orange-500">
                    <option selected disabled class="text-center">--Select Plan--</option>
                    @foreach($plans as $plan)
                    <option value="{{$plan->id}}">{{$plan->name}} ({{$plan->price.' KS'}})</option>
                    @endforeach
                </select>
                @error('plan_id')
                    <p class="text-red-600 mt-1">{{$message}}</p>
                @enderror
                <button type="submit" class="mt-5 block w-full bg-orange-500 hover:bg-orange-700 text-white py-[6px] rounded">Extend Plan</button>
            </form>
        </div>

    </div>
@endsection