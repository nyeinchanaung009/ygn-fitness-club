@php
    use Carbon\Carbon;
@endphp
@extends('layout/master')
@section('content')
    <div class="w-[98%] mx-auto">
        <div class="border border-gray-900 py-3 px-5 rounded bg-black">
            <h2 class="flex-1 text-center font-semibold text-white"><span class="text-slate-400"><i class="bi bi-card-list me-3 text-lg"></i></span>Membership</h2>
        </div>

        <div class="rounded p-3 mt-5 pb-6">
            {{-- search & create --}}
            <div class="p-3 flex justify-start items-center flex-wrap px-3">
                <form action="{{url('/membership')}}" method="GET" class="me-3">
                    <div class="flex flex-wrap mt-3 md:mt-0">
                        <input type="text" name="search" value="{{request('search')}}" class="w-[210px] bg-gray-50 text-gray-900 text-sm rounded-s block px-3 focus:ring-2  focus:ring-orange-500" placeholder="Search Member or MemberID" required>
                        <button type="submit" class="bg-orange-500 px-3 text-white rounded-e hover:bg-orange-600"><i class="bi bi-search"></i></button>
                    </div>
                </form>
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="w-fit text-black bg-white hover:bg-orange-800 hover:text-white focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded text-sm px-5 py-2 text-center flex items-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800" type="button">{{request('type') ? request('type') : 'Filter by Plan status '}}<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                
                <!-- Dropdown menu -->
                <div id="dropdown" class="w-[200px] z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
                    <ul class="w-full py-2 bg-gray-900 border border-gray-700 text-sm text-gray-700 dark:text-gray-200 text-center rounded" aria-labelledby="dropdownDefaultButton">
                        <li class="w-full">
                            <a href="{{route('membership.index')}}" class="w-full block px-4 py-2 text-bold text-white hover:bg-gray-600">All</a>
                        </li>
                        <li class="w-full">
                            <a href="{{url('/membership?type=active')}}" class="w-full block px-4 py-2 text-bold text-green-500 hover:bg-gray-600"><span class="w-[7px] h-[7px] rounded-full bg-green-500 inline-block me-2"></span>Active</a>
                        </li>
                        <li class="w-full">
                            <a href="{{url('/membership?type=expired')}}" class="w-full block px-4 py-2 text-bold text-red-500 hover:bg-gray-600"><span class="w-[7px] h-[7px] rounded-full bg-red-500 inline-block me-2"></span>Expired</a>
                        </li>
                    </ul>
                </div>
            </div>

            @if(count($datas) > 0)
            {{-- table --}}
            <div class="relative overflow-x-auto px-3 pb-3 mt-3 mb-5">
                <table class="w-full mx-auto bg-[#2f3541]/70 text-sm text-gray-200 text-center border border-gray-700">
                    <thead class="text-xs text-gray-100 uppercase bg-gray-700 ">
                        <tr>
                            <th scope="col" class="px-1 py-3">
                                Member ID
                            </th>
                            <th scope="col" class="px-1 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-1 py-3">
                                Plan
                            </th>
                            <th scope="col" class="px-1 py-3">
                                Plan Expire Date
                            </th>
                            <th scope="col" class="px-1 py-3">
                                Plan Remaining
                            </th>
                            <th scope="col" class="px-1 py-3">
                                Plan Status
                            </th>
                            <th scope="col" class="px-1 py-3 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($datas as $data)
                            <tr class="border-b border-gray-700">
                                <th class="px-1 py-4 font-medium">
                                    {{$data->member_id}}
                                </th>
                                <th class="px-1 py-4 font-medium">
                                    <a href="{{route('member.show',$data->member_id)}}" class="hover:underline hover:text-orange-500 p-2">{{$data->member->name}}</a>
                                </th>
                                <td class="px-1 py-4">
                                    <span class="px-2 pb-[3px] rounded-3xl bg-slate-600 shadow-sm border border-slate-500/50">{{$data->plan->name}}</span>
                                </td>
                                <td class="px-1 py-4">
                                    {{$data->plan_expire_date}}
                                </td>
                                <td class="px-1 py-4">
                                    @php
                                        $end = Carbon::parse($data->plan_expire_date);
                                        $now = Carbon::now();
                                        $isExpired = $now->gt($end);
                                        if($isExpired){
                                            $remainDay = '--';
                                            $isActive = false;
                                        }else{
                                            $remainDay = Carbon::now()->diffInDays($end) .' day left';
                                            $isActive = true;
                                        }
                                        echo $remainDay;
                                    @endphp
                                </td>
                                <td class="px-1 py-4">
                                    @if($isActive)
                                    <span class="w-[8px] h-[8px] rounded-full inline-block bg-emerald-400 me-2 mb-[1px]"></span><span class="text-emerald-400">Active</span>
                                    @else
                                    <span class="w-[8px] h-[8px] rounded-full inline-block bg-red-600 me-1 mb-[1px]"></span><span class="text-red-600"> Expired</span>
                                    @endif
                                </td>
                                <td class="px-1 py-2 flex justify-center items-center">
                                    <a title="View member detail" href="{{route('member.show',$data->member_id)}}" class="bg-gray-200 hover:bg-gray-400 px-2 py-1 shadow-md text-gray-700 rounded-sm me-2"><i class="bi bi-eye-fill text-sm"></i></a>
                                    <a title="Edit membership manually" href="{{route('membership.edit',$data->id)}}" class="bg-gray-950 hover:bg-gray-600 px-2 py-1 shadow-md text-white -sm me-2 border border-slate-600"><i class="bi bi-pencil text-sm"></i></a>
                                    <a href="{{route('membership.extendform',$data->member_id)}}" class="text-xs text-white shadow-md bg-blue-600 px-2 py-[6px] hover:bg-blue-800 rounded-sm"><i class="bi bi-plus-lg me-1"></i>Extend plan</a>
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
            @if($datas->lastPage() != 1 && count($datas) > 0)
            <div class="flex justify-center items-center">
                <a href="{{ $datas->previousPageUrl() }}" class="{{$datas->currentPage() == 1 ? 'pointer-events-none opacity-40' : ''}} text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-2 py-1 rounded-sm mx-1" href=""><i class="bi bi-chevron-left"></i></a>
                @for($i=1; $i <= $datas->lastPage(); $i++)
                <a href="{{$datas->url($i)}}" class="{{$i == $datas->currentPage() ? 'active' : ''}} pagination hover:text-white hover:bg-slate-700 bg-slate-200 rounded-sm text-black px-3 py-1 mx-1">{{$i}}</a>
                @endfor
                <a href="{{ $datas->nextPageUrl() }}" class="{{$datas->currentPage() == $datas->lastPage() ? 'pointer-events-none opacity-40' : ''}} text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-2 py-1 rounded-sm mx-1" href=""><i class="bi bi-chevron-right"></i></a>
            </div>
            @endif
        </div>  
    </div>
@endsection