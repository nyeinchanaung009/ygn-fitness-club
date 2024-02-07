@php
    use Carbon\Carbon;
@endphp

@extends('./layout/master')
@section('style')
    <style>
        .text_shadow{
            text-shadow: 1px 2px 5px rgba(0,0,0,0.3);
        }
    </style>
@endsection
@section('content')
    <div class=" w-[95%] mx-auto ">
        <div class="text-white border border-gray-800 flex justify-center bg-black">
            <img class="w-[90px] h-[70px] object-cover" src="{{asset('/images/logo.jpg')}}" />
        </div>

        {{-- hero seciton --}}
        <section class="min-h-[280px] pt-8">
            <div class="pb-8 px-4 mx-auto max-w-screen-xl text-center lg:pb-14 mt-16">
                <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl text-white">Yangon Fitness <span class="text-theme">Club</span></h1>
                <p class="mb-8 text-lg font-semibold lg:text-xl sm:px-16 lg:px-48 text-gray-400 italic"> Level Up Your Health & Fitness </p>
                
                {{-- quick search --}}
                <form method="GET" action="{{url('/')}}" class="relative z-10">
                    <div class="md:w-7/12 mx-auto mt-12">
                        <div class="relative w-full">
                            <input type="text" id="search-dropdown" value="{{request('qsearch') ? request('qsearch') : ''}}" name="qsearch" class="block border-none bg-gray-100 px-4 py-3 w-full z-20 text-sm text-gray-900 rounded-full focus:ring-orange-500 focus:border-orange-500  dark:placeholder-gray-500 dark:text-white" placeholder="Quick Search Members or MemberID" />
                            <button type="submit" class="absolute top-0 end-0 px-4 text-sm font-medium h-full text-white bg-orange-500 rounded-e-full border border-orange-500 hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 dark:bg-orange-600 ">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>
                </form>

                {{-- member result --}}
                @if(count($members) > 0)
                <div class="md:w-7/12 mx-auto border pb-2 bg-white rounded-b-3xl pt-8 -translate-y-6 px-2">
                    @foreach ($members as $member)
                    <a href="{{route('member.show',$member->id)}}" class="flex gap-6 ps-3 hover:bg-gray-200/60 duration-100 rounded-2xl">
                        <h2 class="py-[6px] text-gray-500 font-semibold">{{$member->id}}</h2>
                        <h2 class="py-[6px] font-semibold">{{$member->name}}</h2>
                        <h2 class="py-[6px] text-gray-500 font-semibold">{{$member->phone}}</h2>
                        <h2 class="py-[6px] text-gray-500 font-semibold">{{$member->branch->name}}</h2>  
                    </a> 
                    @endforeach
                </div>
                @endif

                {{-- not found --}}
                @if($members && count($members) == 0)
                <div class="mt-24">
                    <img class="w-[155px] h-[155px] object-contain mx-auto bg bg-gray-800 rounded-full opacity-80 rotate-12" src="{{asset('images/empty.png')}}" alt="no data" />
                    <h2 class="font-bold text-slate-300 text-center mt-3 ms-4">Empty!</h2>
                </div>  
                @endif

                
            </div>
        </section>

        
        {{-- nearly expire members --}}
        <div class="lg:w-9/12 mx-auto mt-12">
            <h2 class="text-white mb-2 font-semibold text-lg">Nearly expire members within 7 days</h2>
            <table class="bg-[#2f3541]/70 w-full text-sm text-gray-200 text-center border border-gray-700">
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

        {{-- pagination --}}
        @if($datas->lastPage() != 1 && count($datas) > 0)
        <div class="flex justify-center items-center mt-4">
            <a href="{{ $datas->previousPageUrl() }}" class="{{$datas->currentPage() == 1 ? 'pointer-events-none opacity-40' : ''}} text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-2 py-1 rounded-sm mx-1" href=""><i class="bi bi-chevron-left"></i></a>
            @for($i=1; $i <= $datas->lastPage(); $i++)
            <a href="{{$datas->url($i)}}" class="{{$i == $datas->currentPage() ? 'active' : ''}} pagination hover:text-white hover:bg-slate-700 bg-slate-200 rounded-sm text-black px-3 py-1 mx-1">{{$i}}</a>
            @endfor
            <a href="{{ $datas->nextPageUrl() }}" class="{{$datas->currentPage() == $datas->lastPage() ? 'pointer-events-none opacity-40' : ''}} text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-2 py-1 rounded-sm mx-1" href=""><i class="bi bi-chevron-right"></i></a>
        </div>
        @endif


        {{-- //total card --}}
        <div class="md:w-7/12 mx-auto p-3 rounded-xl bg-gradient-to-br from-orange-500 to-gray-900 flex justify-evenly border-b border-slate-800 items-center mt-20">
            <div class="w-4/12 border-r text-center py-3">
                <h2 class="text-2xl text-white"><i class="bi bi-buildings-fill text_shadow"></i><span class="font-bold ms-2 text-4xl text_shadow">{{$branchCount}}</span></h2>
                <h2 class="font-semibold text-white">Total Branch</h2>
            </div>
            <div class="w-4/12 border-r text-center py-3">
                <h2 class="text-2xl text-white"><i class="bi bi-people-fill text_shadow"></i><span class="font-bold ms-2 text-4xl text_shadow">{{$memberCount}}</span></h2>
                <h2 class="font-semibold text-white">Total Members</h2>
            </div>
            <div class="w-4/12 text-center py-3 flex justify-evenly">
                <div>
                    <span class="text-green-400 text-3xl font-bold text_shadow">{{$activeCount}}</span>
                    <h2 class="text-white font-semibold text-lg">Active</h2>
                </div>
                <div>
                    <span class="text-red-600 stroke-slate-50 text-3xl font-bold text_shadow">{{$expireCount}}</span>
                    <h2 class="text-white font-semibold text-lg">Expired</h2>
                </div>
            </div>
        </div>


        {{-- images --}}
        <div class="flex justify-center items-center mt-16 py-8 scale-[0.9]">
            <div class="w-[120px] sm:w-[140px] md:w-[270px]" style="transform: rotateY(180deg)">
                <img class="w-full" src="{{asset('images/img3.png')}}" alt="img1" />
            </div>
            <div class="w-[150px] sm:w-[170px] md:w-[300px]">
                <img class="w-full" src="{{asset('images/img1.png')}}" alt="img1" />
            </div>
            <div class="w-[150px] sm:w-[170px] md:w-[300px]">
                <img class="w-full" src="{{asset('images/img2.png')}}" alt="img1" />
            </div>
        </div>

    </div>
@endsection