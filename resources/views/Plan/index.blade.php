@extends('layout/master')
@section('content')
    <div class="w-[95%] mx-auto">
        <div class="border border-gray-900 py-3 px-5 rounded bg-black">
            <h2 class="flex-1 text-center font-semibold text-white"><span class="text-slate-400"><i class="bi bi-list-task me-3 text-lg"></i></span>Plan</h2>
        </div>

        <div class=" p-3 mt-5 pb-6">
            {{-- search & create --}}
            <div class="py-3 flex justify-between items-center flex-wrap w-[85%] mx-auto">
                <h2 class="text-white">Total Plans : <span class="ms-1 font-bold text-white px-2 text-lg rounded-sm bg-slate-600">{{$plans->total()}}</span></h2>
                <a href="{{route('plan.create')}}" class="bg-theme px-3 py-2 text-white rounded hover:bg-orange-600 mt-3 md:mt-0"><i class="bi bi-plus-lg me-2 text-lg"></i>Add Plan</a>
            </div>

            <div class="w-[85%] mx-auto mt-4 pb-2">
                @foreach($plans as $plan)
                <div class="bg-[#2f3541] rounded border-l-4 py-2 border-orange-500 px-4 mb-5 flex justify-between items-center">
                    <div>
                        <h2 class="text-slate-100 font-semibold text-lg">{{ $plan->name }}</h2>
                        <p class="text-slate-300 mt-1 text-sm">
                            -- {{ $plan->price }} KS --
                        </p>                        
                    </div>
                    <div class="flex justify-center items-center">
                        <a href="{{route('plan.edit',$plan->id)}}" title="Edit Plan" class="bg-gray-950 hover:bg-gray-600 px-2 py-[3px] text-white rounded me-3 border border-slate-600"><i class="bi bi-pencil text-sm"></i></a>
                        <button onclick="confirmDel('plan',{{$plan->id}})" title="Delete Plan" class="bg-red-500 hover:bg-red-900 px-2 py-[3px] text-white rounded me-3"><i class="bi bi-trash3 text-sm"></i></button>
                    </div>
                </div>
                @endforeach
            </div>
            {{-- pagination --}}
            @if($plans->lastPage() != 1)
            <div class="flex justify-center items-center">
                <a href="{{ $plans->previousPageUrl() }}" class="{{$plans->currentPage() == 1 ? 'pointer-events-none opacity-40' : ''}} text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-2 py-1 rounded-sm mx-1"><i class="bi bi-chevron-left"></i></a>
                @for($i=1; $i <= $plans->lastPage(); $i++)
                <a href="{{$plans->url($i)}}" class="{{$i == $plans->currentPage() ? 'active' : ''}} pagination hover:text-white hover:bg-slate-700 bg-slate-200 rounded-sm text-black px-3 py-1 mx-1">{{$i}}</a>
                @endfor
                <a href="{{ $plans->nextPageUrl() }}" class="{{$plans->currentPage() == $plans->lastPage() ? 'pointer-events-none opacity-40' : ''}} text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-2 py-1 rounded-sm mx-1"><i class="bi bi-chevron-right"></i></a>
            </div>
            @endif
        </div>  
    </div>
@endsection