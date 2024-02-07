@extends('layout/master')
@section('content')
    <div class="w-[95%] mx-auto">
        <div class="border border-gray-900 py-3 px-5 rounded bg-black flex">
            <button onclick="history.back()"><i class="bi bi-arrow-left text-lg text-white hover:bg-gray-700 rounded-full px-2 py-1"></i></button>
            <h2 class="flex-1 text-center font-semibold text-white"><span class="text-slate-400"><i class="bi bi-people me-3 text-lg"></i></span>Create new Member</h2>
        </div>

            @if(session('error'))
            <p class="text-white bg-red-600 py-2 rounded-sm text-center w-[100%] sm:w-[80%] mx-auto mb-2 mt-5"><i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}</p>
            @endif
            <form action="{{ route('member.store') }}" class="sm:w-[80%] mx-auto scale-95" method="POST">
                @csrf
                
                <div class=" mt-7 border border-slate-600 p-2 rounded pb-4">
                    <h2 class="text-orange-500 text-xl ps-3 pt-2 font-medium">Personal Data</h2>
                    <div class="flex justify-center items-center flex-wrap">
                        <div class="w-[100%] sm:w-10/12 md:w-8/12 lg:w-6/12 mx-auto rounded p-3">
                            <div class="mb-5">
                                <label for="name" class="block mb-2 text-sm font-medium text-white">Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2  focus:ring-orange-500" placeholder="name" />
                                @error('name')
                                    <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="status" class="block mb-2 text-sm font-medium text-white">Workout Status</label>
                                <select name="status" id="status" class="w-full bg-gray-100 text-gray-900 text-sm font-medium rounded focus:ring-2 accent-orange-500  focus:ring-orange-500">
                                    <option selected disabled class="text-center">-- Select Workout Status --</option>
                                    <option {{old('status') == 'Body Beauty' ? 'selected' : ''}} value="Body Beauty" class="py-2 font-semibold">Body Beauty</option>
                                    <option {{old('status') == 'Weight Gain' ? 'selected' : ''}} value="Weight Gain" class="py-2 font-semibold">Weight Gain</option>
                                    <option {{old('status') == 'Weight Loss' ? 'selected' : ''}} value="Weight Loss" class="py-2 font-semibold">Weight Loss</option>
                                    <option {{old('status') == 'Zomba' ? 'selected' : ''}} value="Zomba" class="py-2 font-semibold">Zomba</option>
                                    <option {{old('status') == 'Yoga' ? 'selected' : ''}} value="Yoga" class="py-2 font-semibold">Yoga</option>
                                    <option {{old('status') == 'Aerobics' ? 'selected' : ''}} value="Aerobics" class="py-2 font-semibold">Aerobics</option>
                                </select>
                                @error('status')
                                    <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-7">
                                <label for="branch_id" class="block mb-2 text-sm font-medium text-white">Select Branch</label>
            
                                <select id="branch_id" name="branch_id" class="bg-gray-100 text-gray-900 font-medium text-sm rounded focus:ring-2 accent-orange-500  focus:ring-orange-500 block w-full p-2.5 dark:placeholder-gray-400 dark:text-white">
                                    <option selected disabled class="text-center">-- Select Branch --</option>
                                    @foreach($branches as $branch)
                                    <option {{old('branch_id') == $branch->id ? 'selected' : ''}} value={{$branch->id}} class="py-2 font-semibold">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
            
                                @error('branch_id')
                                    <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="">
                                <label for="gender" class="block mb-2 text-sm font-medium text-white">Gender</label>
                                <input type="radio" name="gender" {{old('gender') == 'male' ? 'checked' : ''}} value="male" /><span class="text-white text-sm me-2 ms-1">Male</span>
                                <input type="radio" name="gender" {{old('gender') == 'female' ? 'checked' : ''}} value="female" /><span class="text-white text-sm me-2 ms-1">Female</span>
                                <input type="radio" name="gender" {{old('gender') == 'other' ? 'checked' : ''}} value="other" /><span class="text-white text-sm me-2 ms-1">Other</span>
                                @error('gender')
                                    <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        <div class="w-[100%] sm:w-10/12 md:w-8/12 lg:w-6/12 mx-auto border-slate-800 rounded p-3">
                            <div class="mb-5">
                                <label for="dob" class="block mb-2 text-sm font-medium text-white">Date of Birth <span class="text-slate-200 font-normal">(optional)</span></label>
                                <input type="date" id="dob" name="dob" value="{{ old('dob') }}" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2  focus:ring-orange-500"/>
                            </div>
                            <div class="mb-5">
                                <label for="phone" class="block mb-2 text-sm font-medium text-white">Phone <span class="text-slate-200 font-normal">(optional)</span></label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2  focus:ring-orange-500" placeholder="phone" />
                            </div>
                            <div class="">
                                <label for="address" class="block mb-2 text-sm font-medium text-white">Address <span class="text-slate-200 font-normal">(optional)</span></label>
                                <textarea name="address" id="address" class="w-full rounded focus:ring-2 accent-orange-500  focus:ring-orange-500" rows="4" placeholder="Address">{{old('address')}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-start items-center flex-wrap border-t border-slate-700 mt-2 pt-1">
                        <div class="w-[100%] sm:w-10/12 md:w-8/12 lg:w-6/12 rounded p-3">
                            <label for="plan_id" class="block mb-2 text-sm font-medium text-white">Select Plan</label>
        
                            <select id="plan_id" name="plan_id" class="bg-gray-100 text-gray-900 font-medium text-sm rounded focus:ring-2 accent-orange-500  focus:ring-orange-500 block w-full p-2.5 dark:placeholder-gray-400 dark:text-white" />
                                <option selected disabled class="text-center">-- Select Plan --</option>
                                @foreach($plans as $plan)
                                <option {{old('plan_id') == $plan->id ? 'selected' : ''}} value={{$plan->id}} class="py-2 font-semibold">{{ $plan->name }} (--{{$plan->price}}--)</option>
                                @endforeach
                            </select>
        
                            @error('plan_id')
                                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="text-white bg-orange-500 hover:bg-orange-700 focus:ring-4 font-medium rounded text-sm w-full block px-5 py-2.5 text-center ">Create</button>
            </form>
  

    </div>
@endsection