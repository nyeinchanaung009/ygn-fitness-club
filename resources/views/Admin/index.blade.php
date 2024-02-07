@extends('layout/master')
@section('content')
    <div class="w-[95%] mx-auto">
        <div class="border border-gray-900 py-3 px-5 rounded bg-black">
            <h2 class="flex-1 text-center font-semibold text-white"><span class="text-slate-400"><i class="bi bi-person-gear me-3 text-lg"></i></span>Admins</h2>
        </div>

        <div class="rounded p-3 mt-5 pb-6">
            {{-- search & create --}}
            <div class="p-3 flex justify-between items-center flex-wrap px-3">
                <h2 class="text-white">Total Admins : <span class="ms-1 font-bold text-white px-2 text-lg rounded-sm bg-slate-600">{{$admins->total()}}</span></h2>
                <a href="{{route('admin.create')}}" class="bg-theme px-3 py-2 text-white rounded hover:bg-orange-600 mt-3 md:mt-0"><i class="bi bi-plus-lg me-2 text-lg"></i>Add Admin</a>
            </div>

            {{-- table --}}
            <div class="relative overflow-x-auto px-3 pb-3 mt-3 mb-8">
                <table class="bg-[#2f3541]/80 w-full text-sm text-left rtl:text-right text-gray-100 border border-gray-700">
                    <thead class="text-xs text-gray-100 uppercase bg-gray-700 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
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
                        @foreach($admins as $admin)
                            <tr class="border-b border-gray-700">
                                <td class="px-6 py-4">
                                    <img class="w-[37px] h-[37px] object-cover rounded-full outline-1 outline outline-slate-500 outline-offset-1" src="{{$admin->image == null ? asset('images/default-profile.jpg') : asset($admin->image)}}" alt="profile" />
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-white">
                                    {{$admin->name}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$admin->phone}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$admin->email}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$admin->branch->name}}
                                </td>
                                <td class="px-6 py-4 flex justify-center items-center">
                                    @if(Auth::user()->id == $admin->id)
                                    <a href="{{route('admin.edit',$admin->id)}}" title="Edit Admin" class="bg-gray-950 hover:bg-gray-600 px-2 py-1 text-white rounded me-3 border border-slate-600"><i class="bi bi-pencil text-sm"></i></a>
                                    <button onclick="confirmDel('admin',{{$admin->id}})" title="Delete Admin" class="bg-red-500 hover:bg-red-900 px-2 py-1 text-white rounded me-3"><i class="bi bi-trash3 text-sm"></i></button>
                                    @else
                                    <p class="text-slate-500">--</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- pagination --}}
            @if($admins->lastPage() != 1)
            <div class="flex justify-center items-center">
                <a href="{{ $admins->previousPageUrl() }}" class="{{$admins->currentPage() == 1 ? 'pointer-events-none opacity-40' : ''}} text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-2 py-1 rounded-sm mx-1"><i class="bi bi-chevron-left"></i></a>
                @for($i=1; $i <= $admins->lastPage(); $i++)
                <a href="{{$admins->url($i)}}" class="{{$i == $admins->currentPage() ? 'active' : ''}} pagination hover:text-white hover:bg-slate-700 bg-slate-200 rounded-sm text-black px-3 py-1 mx-1">{{$i}}</a>
                @endfor
                <a href="{{ $admins->nextPageUrl() }}" class="{{$admins->currentPage() == $admins->lastPage() ? 'pointer-events-none opacity-40' : ''}} text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-2 py-1 rounded-sm mx-1"><i class="bi bi-chevron-right"></i></a>
            </div>
            @endif

            {{-- pagination --}}
            {{-- <div class="flex justify-center items-center">
                <a class="text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-2 py-1 rounded mx-1" href=""><i class="bi bi-arrow-left"></i></a>
                <a href="" class="pagination active text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-3 py-1 rounded mx-1">1</a>
                <a href="" class="pagination text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-3 py-1 rounded mx-1">1</a>
                <a href="" class="pagination text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-3 py-1 rounded mx-1">1</a>
                <a href="" class="pagination text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-3 py-1 rounded mx-1">1</a>
                <a href="" class="pagination text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-3 py-1 rounded mx-1">1</a>
                <a class="text-white bg-slate-700 hover:bg-slate-200 hover:text-black px-2 py-1 rounded mx-1" href=""><i class="bi bi-arrow-right"></i></a>
            </div> --}}

        </div>  
    </div>
@endsection