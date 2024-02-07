@extends('layout/master')
@section('content')
    <div class="w-[95%] mx-auto">
        <div class="border border-gray-900 py-3 px-5 rounded bg-black flex">
            <button onclick="history.back()"><i class="bi bi-arrow-left text-lg text-white hover:bg-gray-700 rounded-full px-2 py-1"></i></button>
            <h2 class="flex-1 text-center font-semibold text-white"><span class="text-slate-400"><i class="bi bi-buildings me-3 text-lg"></i></span>Create new Branch</h2>
        </div>

        <div class="sm:w-10/12 md:w-8/12 lg:w-6/12 mx-auto  border-slate-800 rounded p-3 mt-5 pb-6">
            
            <form action="{{route('branch.store')}}" class="max-w-sm mx-auto" method="POST">
                @csrf
                @if(session('error'))
                    <p class="text-white text-center bg-red-500 py-2 mb-4 rounded"><i class="bi bi-exclamation-circle-fill me-2 text-white"></i>{{ session('error') }}</p>
                @endif
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-white">Branch Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2 focus:ring-orange-500" placeholder="branch name">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="address" class="block mb-2 text-sm font-medium text-white">Address</label>
                    <textarea name="address" id="address" value="{{ old('address') }}" class="w-full rounded block bg-gray-100 text-gray-900 text-sm mb-2 font-medium  focus:ring-2 focus:ring-orange-500 p-2.5" placeholder="Address" rows="7"></textarea>
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="text-white bg-orange-500 hover:bg-orange-700 focus:ring-4 font-medium rounded text-sm w-full block px-5 py-2.5 text-center ">Create</button>
            </form>
  
        </div>
    </div>
@endsection