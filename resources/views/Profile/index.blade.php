@extends('layout/master')
@section('content')
    <div class="w-[95%] mx-auto">
        <div class="border border-gray-900 py-3 px-5 rounded bg-black flex">
            <h2><i class="bi bi-arrow-left text-lg text-white hover:bg-gray-700 rounded-full px-2 py-1"></i></h2>
            <h2 class="flex-1 text-center font-semibold text-white"><span class="text-slate-400"><i class="bi bi-person-gear me-3 text-lg"></i></span>Admin Profile</h2>
        </div>

        <div class="sm:w-10/12 md:w-8/12 lg:w-6/12 mx-auto  border-slate-800 rounded p-3 mt-5 pb-6">
            <div class="mb-5 flex justify-end items-center">
                <a href="" class="px-3 py-2 text-white bg-theme rounded"><i class="bi bi-pencil-square me-2"></i>Edit Profile</a>
            </div>
            <div class="mb-5">
                <h2 class="text-white mb-2">Name</h2>
                <div class="text-white px-3 py-1 bg-slate-800 rounded">Yua Mikami</div>
            </div>
            <div class="mb-5">
                <h2 class="text-white mb-2">Name</h2>
                <div class="text-white px-3 py-1 bg-slate-800 rounded">Yua Mikami</div>
            </div>
            <div class="mb-5">
                <h2 class="text-white mb-2">Name</h2>
                <div class="text-white px-3 py-1 bg-slate-800 rounded">Yua Mikami</div>
            </div>
  
        </div>
    </div>
@endsection