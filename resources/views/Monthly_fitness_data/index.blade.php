@php
    use Carbon\Carbon;
@endphp
@extends('layout/master')
@section('style')
    <style>
        td,th{
            border : 1px solid #4a505b7d;
        }   
    </style>

@endsection
@section('content')
    <div class="w-[98%] mx-auto">
        <div class="border border-gray-900 py-3 px-5 rounded bg-black">
            <h2 class="flex-1 text-center font-semibold text-white"><span class="text-slate-400"><i class="bi bi-calendar2-check me-3 text-lg"></i></span>Monthly Fitness Data</h2>
        </div>

        <div class="rounded p-3 mt-5 pb-6">
            {{-- search & create --}}
            <div class="p-3 flex justify-start items-center flex-wrap px-3">
                <form action="{{url('/monthlyfitnessdata')}}" class="" method="">
                    <div class="flex flex-wrap mt-3 md:mt-0">
                        <input type="text" name="search" value="{{request('search')}}" id="email" class="w-[215px] bg-gray-50 text-gray-900 text-sm rounded-s block px-3 focus:ring-2  focus:ring-orange-500" placeholder="Search Member or MemberID" />
                        <button type="submit" class="bg-orange-500 px-3 text-white rounded-e hover:bg-orange-600"><i class="bi bi-search"></i></button>
                    </div>
                </form>
                <form action="{{url('/monthlyfitnessdata')}}" method="" class="flex justify-center items-center gap-3 ms-3">
                    <div class="bg-gray-700 rounded-md ps-4 pe-1 py-[2px] border border-slate-600/70">
                        <span class="text-white me-3">Filter by date </span>
                        <select name="month" class="rounded py-[2px]">
                            <option {{request('month') ? '' : 'selected'}} disabled>Months</option>
                            <option value="">All</option>
                            <option {{request('month') == '01' ? 'selected' : ''}} value="01">January</option>
                            <option {{request('month') == '02' ? 'selected' : ''}} value="02">February</option>
                            <option {{request('month') == '03' ? 'selected' : ''}} value="03">March</option>
                            <option {{request('month') == '04' ? 'selected' : ''}} value="04">April</option>
                            <option {{request('month') == '05' ? 'selected' : ''}} value="05">May</option>
                            <option {{request('month') == '06' ? 'selected' : ''}} value="06">June</option>
                            <option {{request('month') == '07' ? 'selected' : ''}} value="07">July</option>
                            <option {{request('month') == '08' ? 'selected' : ''}} value="08">August</option>
                            <option {{request('month') == '09' ? 'selected' : ''}} value="09">September</option>
                            <option {{request('month') == '10' ? 'selected' : ''}} value="10">October</option>
                            <option {{request('month') == '11' ? 'selected' : ''}} value="11">November</option>
                            <option {{request('month') == '12' ? 'selected' : ''}} value="12">December</option>
                        </select>
                        @php
                            $years = [];
                            $now = Carbon::now()->year;
                            for($i=5; $i >= 1; $i--){
                                $years[] = $now - $i;
                            }
                            $years[] = $now;
                        @endphp
                        <select name="year" class="rounded py-[2px]">
                            <option {{request('year') ? '' : 'selected'}} disabled>Years</option>
                            <option value="">All</option>
                            @foreach($years as $year)
                            <option {{request('year') == $year ? 'selected' : ''}} value="{{$year}}">{{$year}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-blue-500 text-white font-bold px-2 my-[2px] hover:bg-orange-800 rounded"><i class="bi bi-check-lg text-lg"></i></button>
                    </div>
                </form>
            </div>

            @if(count($fitnessDatas) > 0)
            {{-- table --}}
            <div class="relative overflow-x-auto px-3 pb-3 mt-3 mb-5">
                <table class="bg-[#2f3541]/70 w-full text-sm text-left text-gray-200 rtl:text-right border border-gray-700">
                    <thead class="text-xs text-gray-100 uppercase bg-gray-700 ">
                        <tr>
                            <th scope="col" class="ps-3 py-3 text-xs">
                                Member ID
                            </th>
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
                        @foreach($fitnessDatas as $fdata)
                            <tr class="border-b border-gray-700">
                                <th class="ps-6 py-4 font-medium">
                                    {{$fdata->member_id}}
                                </th>
                                <th class="ps-3 py-4 font-medium">
                                    <a href="{{route('member.show',$fdata->member_id)}}" class="hover:underline hover:text-orange-500 px-2 py-3">{{$fdata->member->name}}</a>
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
                                    <button title="Delete monthly data" onclick="confirmDel('monthlyfitnessdata',{{$fdata->id}})" class="bg-red-500 hover:bg-red-900 px-2 shadow-md py-1 text-white rounded-sm"><i class="bi bi-trash3 text-sm"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="mt-24">
                <img class="w-[155px] h-[155px] object-contain mx-auto bg bg-gray-800 rounded-full opacity-80 rotate-12" src="{{asset('images/empty.png')}}" alt="no data" />
                <h2 class="font-bold text-slate-300 text-center mt-3 ms-4">Empty!</h2>
            </div>
            @endif

            {{-- pagination --}}
            @if($fitnessDatas->lastPage() != 1 && count($fitnessDatas) > 0) 
            <div class="flex justify-center items-center">
                <a href="{{ $fitnessDatas->previousPageUrl() }}" class="{{$fitnessDatas->currentPage() == 1 ? 'pointer-events-none opacity-40' : ''}} text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-2 py-1 rounded-sm mx-1" href=""><i class="bi bi-chevron-left"></i></a>
                @for($i=1; $i <= $fitnessDatas->lastPage(); $i++)
                <a href="{{$fitnessDatas->url($i)}}" class="{{$i == $fitnessDatas->currentPage() ? 'active' : ''}} pagination hover:text-white hover:bg-slate-700 bg-slate-200 rounded-sm text-black px-3 py-1 mx-1">{{$i}}</a>
                @endfor
                <a href="{{ $fitnessDatas->nextPageUrl() }}" class="{{$fitnessDatas->currentPage() == $fitnessDatas->lastPage() ? 'pointer-events-none opacity-40' : ''}} text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-2 py-1 rounded-sm mx-1" href=""><i class="bi bi-chevron-right"></i></a>
            </div>
            @endif
        </div>  
    </div>
@endsection