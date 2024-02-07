@extends('layout/master')
@section('content')
    <div class="w-[95%] mx-auto">
        <div class="border border-gray-900 py-3 px-5 rounded bg-black">
            <h2 class="flex-1 text-center font-semibold text-white"><span class="text-slate-400"><i class="bi bi-people me-3 text-lg"></i></span>Members</h2>
        </div>
    
        <div class="rounded p-3 pb-6 mt-2">
            {{-- search & create --}}
            <div class="p-3 flex justify-between items-center flex-wrap px-3">
                <div class="flex gap-3">
                    <form action="{{url('/member')}}" method="GET" class="">
                        <div class="flex flex-wrap mt-3 md:mt-0">
                            <input name="search" type="text" id="search" value="{{request('search') ? request('search') : ''}}" class="bg-gray-50 text-gray-900 text-sm rounded-s block px-2 focus:ring-2  focus:ring-orange-500 w-[230px]" placeholder="Search Member or MemberID" />
                            <button class="bg-theme px-3 text-white rounded-e hover:bg-orange-600"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                    
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="w-fit text-black bg-white hover:bg-orange-800 hover:text-white focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded text-sm px-5 py-2 text-center flex items-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800" type="button">{{request('branch') ? $branches[request('branch')-1]->name : 'Filter by Branch '}}<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    
                    <!-- Dropdown menu -->
                    <div id="dropdown" class="w-fit z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
                        <ul class="py-2 text-sm text-white bg-gray-900 border border-slate-700 rounded" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="{{route('member.index')}}" class="block px-4 py-2 hover:bg-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">All</a>
                            </li>
                            @foreach($branches as $branch)
                            <li>
                                <a href="{{url('/member?branch='.$branch->id)}}" class="block px-4 py-2 hover:bg-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">{{$branch->name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
    
                </div>
                <a href="{{route('member.create')}}" class="bg-theme px-3 py-2 text-white rounded hover:bg-orange-600 mt-3 md:mt-0"><i class="bi bi-plus-lg me-2 text-lg"></i>Add Member</a>
            </div>

            @if(count($members) > 0)
            {{-- table --}}
            <div class="relative overflow-x-auto px-3 pb-3 mt-3 mb-5">
                <table class="bg-[#2f3541]/70 w-full text-sm text-left text-gray-200 rtl:text-right border border-gray-700">
                    <thead class="text-xs text-gray-100 uppercase bg-gray-700 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Member ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Workout Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Gender
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Branch
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($members as $member)
                            <tr class="border-b border-gray-700">
                                <th class="px-6 py-4 font-medium">
                                    {{$member->id}}
                                </th>
                                <th class="px-6 py-4 font-medium">
                                    <a href="{{route('member.show',$member->id)}}" class="hover:underline hover:text-orange-500 px-2 py-3">{{$member->name}}</a>
                                </th>
                                <td class="px-6 py-4">
                                    {{$member->status}}
                                </td>
                                <td class="px-6 py-4">
                                    {{ucfirst($member->gender)}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$member->branch->name}}
                                </td>
                                <td class="px-6 py-2 flex justify-center items-center">
                                    <a title="View member detail" href="{{route('member.show',$member->id)}}" class="bg-gray-200 hover:bg-gray-400 px-2 py-1 shadow-md text-gray-700 rounded-sm me-2"><i class="bi bi-eye-fill text-sm"></i></a>
                                    <a title="Edit member" href="{{route('member.edit',$member->id)}}" class="bg-gray-950 hover:bg-gray-600 px-2 py-1 shadow-md text-white rounded-sm me-2 border border-slate-600"><i class="bi bi-pencil text-sm"></i></a>
                                    <button title="Delete member" onclick="confirmDel('member',{{$member->id}})" class="bg-red-500 hover:bg-red-900 px-2 shadow-md py-1 text-white rounded-sm me-2"><i class="bi bi-trash3 text-sm"></i></button>
                                    <div class="flex flex-col ms-3 justify-center text-center">
                                        <a href="{{route('membership.extendform',$member->id)}}" class="text-xs text-white shadow-md bg-blue-500 px-2 py-[5px] hover:bg-blue-700 rounded-sm mb-[7px]"><i class="bi bi-plus-lg me-1"></i>Extend plan</a>
                                        <a href="{{url('monthlyfitnessdata/create?id='.$member->id)}}" class="text-xs text-white drop-shadow shadow-md bg-amber-500 px-2 py-[5px] hover:bg-amber-700 rounded-sm">Add monthly fitness data</a>
                                    </div>
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
            @if($members->lastPage() != 1 && count($members) > 0)
            <div class="flex justify-center items-center">
                <a href="{{ $members->previousPageUrl() }}" class="{{$members->currentPage() == 1 ? 'pointer-events-none opacity-40' : ''}} text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-2 py-1 rounded-sm mx-1" href=""><i class="bi bi-chevron-left"></i></a>
                @for($i=1; $i <= $members->lastPage(); $i++)
                <a href="{{$members->url($i)}}" class="{{$i == $members->currentPage() ? 'active' : ''}} pagination hover:text-white hover:bg-slate-700 bg-slate-200 rounded-sm text-black px-3 py-1 mx-1">{{$i}}</a>
                @endfor
                <a href="{{ $members->nextPageUrl() }}" class="{{$members->currentPage() == $members->lastPage() ? 'pointer-events-none opacity-40' : ''}} text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-2 py-1 rounded-sm mx-1" href=""><i class="bi bi-chevron-right"></i></a>
            </div>
            @endif
            {{-- {{$members->links()}} --}}
            
        </div>  
    </div>
@endsection