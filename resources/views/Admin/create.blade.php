@extends('layout/master')
@section('content')
    <div class="w-[95%] mx-auto">
        <div class="border border-gray-900 py-3 px-5 rounded bg-black flex">
            <button onclick="history.back()"><i class="bi bi-arrow-left text-lg text-white hover:bg-gray-700 rounded-full px-2 py-1"></i></button>
            <h2 class="flex-1 text-center font-semibold text-white"><span class="text-slate-400"><i class="bi bi-person-gear me-3 text-lg"></i></span>Create new Admin</h2>
        </div>

        <div class="sm:w-10/12 md:w-8/12 lg:w-6/12 mx-auto  border-slate-800 rounded p-3 mt-5 pb-6">
            @if(session('error'))
            <p class="text-white bg-red-600 py-2 rounded-sm text-center max-w-sm mx-auto mb-2"><i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}</p>
            @endif
            <form action="{{ route('admin.store') }}" class="max-w-sm mx-auto" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-white">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2  focus:ring-orange-500" placeholder="name">
                    @error('name')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2  focus:ring-orange-500" placeholder="email">
                    @error('email')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="phone" class="block mb-2 text-sm font-medium text-white">Phone <span class="text-slate-200 font-normal">(optional)</span></label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2  focus:ring-orange-500" placeholder="phone">
                    @error('phone')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
                    <input type="password" id="password" name="password" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2  focus:ring-orange-500" placeholder="password">
                    @error('password')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-7">
                    <label for="branch_id" class="block mb-2 text-sm font-medium text-white">Select Branch</label>
                    <select id="branch_id" name="branch_id" class="bg-gray-100 text-gray-900 text-sm rounded focus:ring-2 accent-orange-500  focus:ring-orange-500 block w-full p-2.5 dark:placeholder-gray-400 dark:text-white">
                        
                    <option selected disabled class="text-center">-- Select Branch --</option>
                    @foreach($branches as $branch)
                    <option value={{$branch->id}} class="py-2 font-semibold">{{ $branch->name }}</option>
                    @endforeach
                    </select>
                    @error('branch_id')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="text-white bg-orange-500 hover:bg-orange-700 focus:ring-4 font-medium rounded text-sm w-full block px-5 py-2.5 text-center ">Create</button>
            </form>
  
        </div>
    </div>
@endsection