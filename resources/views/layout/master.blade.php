<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- favicon --}}
    <link rel="icon" type="image" href="https://scontent.frgn9-1.fna.fbcdn.net/v/t39.30808-6/399820849_714462594048463_4011476873918160664_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=efb6e6&_nc_ohc=yApWuRLf-9gAX-3nR-b&_nc_ht=scontent.frgn9-1.fna&oh=00_AfCb1nNGD75XvWVLk1M4M1RswdOJkrUbpUWvZl78SeiaqQ&oe=65B23454" />
    @vite('resources/css/app.css')
    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- flow bite --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <title>Yangon Fitness Club</title>
    {{-- custom yield style --}}
    @yield('style')
</head>
<body>

    {{-- toast messaege --}}
    @if(session('msg'))
    <div id="toast" class="absolute top-10 left-0 w-full z-[99] text-center">
        <span class="{{session('msg')['type'] == 'success' ? 'bg-emerald-500' : 'bg-red-500'}}  text-white px-5 py-3 rounded-sm"><i class="bi {{session('msg')['type'] == 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill'}} me-2"></i>{{ session('msg')['text'] }}</span>
    </div>
    @endif


    {{-- nav bar --}}
    <nav class="fixed top-0 z-50 w-full  border-b bg-gray-950 border-gray-800">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
            </button>
            <a href="http://localhost:8000" class="flex ms-2 md:me-24">
                <img class="rounded-full w-[50px] me-3" src="{{asset('/images/logo.jpg')}}" class="h-8 me-3" alt="FlowBite Logo" />
                <span class="hidden sm:block self-center text-xl font-bold sm:text-2xl whitespace-nowrap text-theme italic">YGN Fitness Club</span>
            </a>
            </div>
            <a href="{{ route('admin.show',Auth::user()->id) }}" class="flex items-center justify-center bg-slate-700 border border-slate-600/60 ps-2 pe-3 py-[6px] rounded-full hover:bg-slate-900">
                <img class="w-8 h-8 rounded-full outline-1 outline outline-slate-500 outline-offset-1" src="{{Auth::user()->image == null ? asset('images/default-profile.jpg') : asset(Auth::user()->image) }}" alt="user photo">
                <span class="text-slate-300 me-3 font-semibold text-xs ms-3">{{ Auth::user()->name }}</span>
            </a>
        </div>
        </div>
    </nav>

    {{-- side bar --}}
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full border-r sm:translate-x-0 bg-gray-950 border-gray-800" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto dark:bg-gray-950">
            {{-- <h4 class="space-y-2 font-bold ps-4 py-2 text-slate-300 text-lg">Dashboard</h4> --}}
            <ul class="space-y-2 font-medium mt-8">
                <li>
                    <a id="home" href="/" class="nav-item flex items-center ps-4 p-2 rounded text-white hover:text-white dark:hover:bg-orange-500 group">
                        <i class="bi bi-house-door text-xl text-slate-400 group-hover:text-white"></i>
                        <span class="ms-3">Home</span>
                    </a>
                </li>
                <li>
                    <a id="admin" href="/admin" class="nav-item flex items-center ps-4 p-2 rounded text-white hover:text-white dark:hover:bg-orange-500 group">
                        <i class="bi bi-person-gear text-xl text-slate-400 group-hover:text-white"></i>
                        <span class="ms-3">Admins</span>
                    </a>
                </li>
                <li>
                    <a id="plan" href="/plan" class="nav-item flex items-center ps-4 p-2 rounded text-white hover:text-white dark:hover:bg-orange-500 group">
                        <i class="bi bi-list-task text-xl text-slate-400 group-hover:text-white"></i>
                        <span class="ms-3">Plans</span>
                    </a>
                </li>
                <li class="pb-4 border-b border-slate-800">
                    <a id="branch" href="/branch" class="nav-item flex items-center ps-4 p-2 rounded text-white hover:text-white dark:hover:bg-orange-500 group">
                        <i class="bi bi-buildings text-xl text-slate-400 group-hover:text-white"></i>
                        <span class="ms-3">Branches</span>
                    </a>
                </li>
                <li class="pt-2">
                    <a id="member" href="/member" class="nav-item flex items-center ps-4 p-2 rounded text-white hover:text-white dark:hover:bg-orange-500 group">
                        <i class="bi bi-people text-xl text-slate-400 group-hover:text-white"></i>
                        <span class="ms-3">Members</span>
                    </a>
                </li>
                <li>
                    <a id="monthlyfitnessdata" href="/monthlyfitnessdata" class="nav-item flex items-center ps-4 p-2 rounded text-white hover:text-white dark:hover:bg-orange-500 group">
                        <i class="bi bi-calendar2-check text-lg text-slate-400 group-hover:text-white"></i>
                        <span class="ms-3">Monthly Fitness Data</span>
                    </a>
                </li>
                <li class="pb-5">
                    <a id="membership" href="/membership" class="nav-item flex items-center ps-4 p-2 rounded text-white hover:text-white dark:hover:bg-orange-500 group">
                        <i class="bi bi-card-heading text-xl text-slate-400 group-hover:text-white"></i>
                        <span class="ms-3">Membership</span>
                    </a>
                </li>
                <li class="pt-4 border-t border-gray-800">
                    <a href="{{route('logout')}}" class="flex items-center ps-4 p-2 rounded text-white hover:text-white dark:hover:bg-orange-500 group">
                        <i class="bi bi-box-arrow-right text-xl text-slate-400 group-hover:text-white"></i>
                        <span class="ms-3">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    
    {{-- content --}}
    <div class="bg-gray-950 mt-[75px] min-h-[90vh] sm:ms-[256px] py-5">
        @yield('content')
    </div>

    {{-- footer --}}
    <footer>
        <div class="border-t border-slate-900 bg-slate-950 text-center text-sm text-slate-400 py-2 sm:ms-[256px]">
            YFC Copyright &copy; 2023, All right reserve. Developed by <a target="_blank" href="https://nyeinchanaung009.pages.dev" class="hover:text-white underline underline-offset-2">Nyein Chan Aung</a>
        </div>
    </footer>

    {{-- delete comfirmation model --}}
    <div id="confirmModel" class="hidden fixed z-[90] left-0 top-0 w-full h-screen bg-slate-950/90 backdrop-blur-[1px] justify-center items-center">
        <div id="modelBox" class="rounded p-5 border border-slate-600 bg-slate-800 w-[285px] sm:w-[320px]">
            <h2 class="text-center"><i class="bi bi-trash3 text-5xl text-red-500"></i></h2>
            <h2 class="mt-3 text-center text-white text-lg font-semibold">Confirm Delete</h2>
            <h2 class="text-center text-slate-400 text-sm">Are you sure to delete?</h2>
            
            <form id="deleteForm" action="" method="POST">
                @csrf @method('delete')
                <div class="flex justify-evenly items-center mt-7">
                    <button onclick="closeModel()" type="button" class="text-slate-200 hover:text-slate-500">Cancel</button>
                    <button type="submit" class="bg-orange-500 hover:bg-orange-700 text-white rounded px-5 py-2">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="{{asset('main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    
    <script type="text/javascript">
        @yield('script')
    </script>

</body>
</html>