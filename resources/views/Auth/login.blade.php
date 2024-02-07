<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    {{-- favicon --}}
    <link rel="icon" type="image" href="{{asset('/images/logo.jpg')}}" />
    <title>Yangon Fitness Club</title>
</head>
<body>
    
    <div class="w-full h-screen bg-gray-950 flex justify-center items-center">
        <div class="w-[95%] sm:w-[500px] border border-slate-700 rounded py-10">
            <div class="mb-7">
                <img class="w-[70px] mx-auto rounded-full border border-slate-800" src="{{asset('/images/logo.jpg')}}" alt="logo" />
                <h2 class="text-slate-300 font-bold text-center mt-1">Yangon Fitness <span class="text-orange-500">CLub</span></h2>
                <h2 class="text-white font-bold text-center text-2xl mt-8">Login</h2>
                @if(session('error'))
                    <p class="w-[80%] mt-3 py-1 mx-auto text-white text-center bg-red-500">{{session('error')}}</p>
                @endif
            </div>
            <form action="{{route('login')}}" class="max-w-sm mx-auto" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-white">Your Email</label>
                    <input name="email" type="email" id="email" value="{{ old('email') }}" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2 focus:ring-orange-500" placeholder="Email"  />
                    @error('email')
                        <p class="text-red-500 font-light">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-7">
                    <label for="password" class="block mb-2 text-sm font-medium text-white">Your Name</label>
                    <input name="password" type="password" id="password" class="bg-gray-100 text-gray-900 text-sm rounded blcok w-full p-2.5 focus:ring-2 focus:ring-orange-500" placeholder="password"  />
                    @error('password')
                        <p class="text-red-500 font-light">{{$message}}</p>
                    @enderror
                    {{-- <button class="text-xs text-slate-500 hover:text-slate-400">Forget Password ?</button> --}}
                </div>
                <div class="flex items-start mb-5">
                    <div class="flex items-center h-5">
                      <input name="remember" id="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" />
                    </div>
                    <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                  </div>
                <button type="submit" class="text-white bg-orange-500 hover:bg-orange-700 focus:ring-4 font-medium rounded text-sm w-full block px-5 py-2.5 text-center ">Login</button>
            </form>
        </div>
    </div>

</body>
</html>