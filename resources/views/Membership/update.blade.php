@extends('layout/master')
@section('content')
    <div class="w-[95%] mx-auto">
        <div class="border border-gray-900 py-3 px-5 rounded bg-black flex">
            <button onclick="history.back()"><i class="bi bi-arrow-left text-lg text-white hover:bg-gray-700 rounded-full px-2 py-1"></i></button>
            <h2 class="flex-1 text-center font-semibold text-white"><span class="text-slate-400"><i class="bi bi-card-list me-3 text-lg"></i></span>Update Membership</h2>
        </div>

        <div class="w-12/12 sm:w-5/12 mx-auto border border-slate-500 rounded p-4 mt-12">
            @if(session('error'))
            <p class="bg-red-600 text-center rounded-sm py-2 text-white mb-3">{{session('error')}}</p>
            @endif
            <div class="pb-3 mb-4 flex justify-between items-center border-b border-dashed border-slate-600">
                <h2 class="text-white/95">Member ID : {{$membership->member->id}}</h2>
                <h2 class="text-white/95 flex-1 text-center">Name : {{$membership->member->name}}</h2>
            </div>
            <form action="{{route('membership.update',$membership->id)}}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">  
                    <label for="plan_id" class="text-white">Select Plan</label>
                    <select name="plan_id" id="plan_id" class="mt-2 w-full rounded p-2.5 focus:ring-2  focus:ring-orange-500">
                        @foreach($plans as $plan)
                        <option value="{{$plan->id}}" {{$membership->plan_id == $plan->id ? 'selected' : ''}}>{{$plan->name}} ({{$plan->price.' KS'}})</option>
                        @endforeach
                    </select>
                    @error('plan_id')
                        <p class="text-red-600 mt-1">{{$message}}</p>
                    @enderror
                </div>  
                <div class="mb-3">
                    <label for="plan_expire_date" class="text-white">Plan Expire Date</label>
                    <input type="date" name="plan_expire_date" id="plan_expire_date" value="{{$membership->plan_expire_date}}" class="block w-full rounded mt-2" />
                </div>
                @error('plan_expire_date')
                    <p class="text-red-600 mt-1">{{$message}}</p>
                @enderror
                <button type="submit" class="mt-5 block w-full bg-orange-500 hover:bg-orange-700 text-white py-2 rounded">Fix Membership</button>
            </form>
        </div>

    </div>
@endsection