@extends('layout/master')
@section('content')
    <div class="w-[95%] mx-auto">
        <div class="border border-gray-900 py-3 px-5 rounded bg-black flex">
            <button onclick="history.back()"><i class="bi bi-arrow-left text-lg text-white hover:bg-gray-700 rounded-full px-2 py-1"></i></button>
            <h2 class="flex-1 text-center font-semibold text-white"><span class="text-slate-400"><i class="bi bi-person-gear me-3 text-lg"></i></span>Profile</h2>
        </div>

        <div class="mt-6">
            <div class="w-[120px] h-[120px] mx-auto rounded-full overflow-hidden outline outline-2 outline-offset-[3px] outline-slate-600">
                <img class="object-cover w-full" src="{{$admin->image == null ? asset('images/default-profile.jpg') : asset($admin->image) }}" alt="profile" />
            </div>
            <div class="p-4 border border-slate-700 rounded mx-auto max-w-sm pt-20 -mt-14 bg-gray-900">
                <div class="border border-gray-700/70 rounded-sm px-3 py-[6px] mb-3">
                    <h2 class="text-slate-300"><i class="bi bi-person me-3 text-slate-500"></i>{{ $admin->name }}</h2>
                </div>
                <div class="border border-gray-700/70 rounded-sm px-3 py-[6px] mb-3">
                    <h2 class="text-slate-300"><i class="bi bi-telephone me-3 text-slate-500"></i>{{ $admin->phone }}</h2>
                </div>
                <div class="border border-gray-700/70 rounded-sm px-3 py-[6px] mb-3">
                    <h2 class="text-slate-300"><i class="bi bi-envelope me-3 text-slate-500"></i>{{ $admin->email }}</h2>
                </div>
                <div class="border border-gray-700/70 rounded-sm px-3 py-[6px] mb-3">
                    <h2 class="text-slate-300"><i class="bi bi-buildings me-3 text-slate-500"></i>{{ $branch->name }}</h2>
                </div>
                <div class="mt-6">
                    <a href={{ route('admin.edit',$admin->id) }} class="w-full block bg-theme text-white font-semibold text-center py-2 rounded hover:bg-orange-400"><i class="bi bi-pencil me-2"></i>Edit Profile</a>
                    <button onclick="confirmDel('','admin/'+{{$admin->id}})" class="w-full block bg-red-600 text-white font-semibold text-center py-2 mt-3 rounded hover:bg-red-700"><i class="bi bi-trash3 me-2"></i>Delete Profile</button>
                </div>
            </div>
        </div>
    </div>
@endsection