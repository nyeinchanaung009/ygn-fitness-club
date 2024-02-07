@php
    use Carbon\Carbon;
@endphp
@extends('layout/master')
@section('content')
    <div class="w-[95%] mx-auto">
        <div class="border border-gray-900 py-3 px-5 rounded bg-black flex">
            <button onclick="history.back()"><i class="bi bi-arrow-left text-lg text-white hover:bg-gray-700 rounded-full px-2 py-1"></i></button>
            <h2 class="flex-1 text-center font-semibold text-white"><span class="text-slate-400"><i class="bi bi-calendar2-check me-3 text-lg"></i></span>Add New Monthly Fitness Data</h2>
        </div>


            @if(session('error'))
            <p class="text-white bg-red-600 py-2 rounded-sm text-center w-[100%] sm:w-[80%] mx-auto mb-2 mt-5"><i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}</p>
            @endif
            <form action="{{ route('monthlyfitnessdata.store') }}" class="sm:w-[80%] mx-auto scale-95" method="POST">
                @csrf
                <h2 class="text-white mt-6">Monthly Data for {{ Carbon::now()->englishMonth }}</h2>
                
                <div class="flex justify-center items-center flex-wrap mt-4 border border-slate-600 p-2 rounded">
                    <input type="integer" name="member_id" value="{{$member_id}}" class="hidden" />
                    <div class="w-[100%] sm:w-10/12 md:w-8/12 lg:w-6/12 mx-auto rounded p-3">
                        <div class="mb-5">
                            <label for="weight" class="block mb-2 text-sm font-medium text-white">Weight (pounds , lb)<span class="text-red-500 ms-2 text-lg inline-block translate-y-1">*</span></label>
                            <input type="number" step="any" id="weight" name="weight" value="{{ old('weight') }}" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2  focus:ring-orange-500" placeholder="weight">
                            @error('weight')
                                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="height" class="block mb-2 text-sm font-medium text-white">Height (inches)<span class="text-red-500 ms-2 text-lg inline-block translate-y-1">*</span></label>
                            <input type="number" step="any" id="height" name="height" value="{{ old('height') }}" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2  focus:ring-orange-500" placeholder="height">
                            @error('height')
                                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="chest_size" class="block mb-2 text-sm font-medium text-white">Chest Size (inches) <span class="text-gray-300 font-normal">(optional)</span></label>
                            <input type="number" step="any" id="chest_size" name="chest_size" value="{{ old('chest_size') }}" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2  focus:ring-orange-500" placeholder="Chest Size">
                        </div>
                    </div>
                    <div class="w-[100%] sm:w-10/12 md:w-8/12 lg:w-6/12 mx-auto rounded p-3">
                        <div class="mb-5">
                            <label for="shoulder_size" class="block mb-2 text-sm font-medium text-white">Shoulder Size (inches) <span class="text-gray-300 font-normal">(optional)</span></label>
                            <input type="number" step="any" id="shoulder_size" name="shoulder_size" value="{{ old('shoulder_size') }}" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2  focus:ring-orange-500" placeholder="Shoulder Size">
                        </div>
                        <div class="mb-5">
                            <label for="waist_size" class="block mb-2 text-sm font-medium text-white">Waist Size (inches) <span class="text-gray-300 font-normal">(optional)</span></label>
                            <input type="number" step="any" id="name" name="waist_size" value="{{ old('waist_size') }}" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2  focus:ring-orange-500" placeholder="Waist Size">
                        </div>
                        <div class="mb-5">
                            <label for="hip_size" class="block mb-2 text-sm font-medium text-white">Hip Size (inches) <span class="text-gray-300 font-normal">(optional)</span></label>
                            <input type="number" step="any" id="hip_size" name="hip_size" value="{{ old('hip_size') }}" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2  focus:ring-orange-500" placeholder="Hip Size">
                        </div>
                    </div>
                </div>
                    
                <button type="submit" class="text-white bg-orange-500 hover:bg-orange-700 focus:ring-4 font-medium rounded text-sm w-full block px-5 py-2.5 text-center ">Create</button>
            </form>
  

    </div>
@endsection