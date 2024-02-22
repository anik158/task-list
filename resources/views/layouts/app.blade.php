<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Lists</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>


    {{-- blade-formatter-disable--}}
    <style type="text/tailwindcss">
        .btn{
            @apply  rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/10 bg-yellow-50  hover:bg-slate-50 text-slate-700
        }

        .link{
            @apply font-medium text-gray-700  decoration-pink-500 border-y-4
        }

        label{
            @apply block uppercase text-slate-700 mb-2
        }

        input, textarea{
            @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none
        }

        .error{
            @apply text-red-500 text-sm
        }
    </style>

    {{-- blade-formatter-enable --}}
    @yield('styles')
</head>
<body class="container mx-auto mt-10 mb-1- max-w-lg">

    <h1 class="text-2xl mb-4 font-bold"> @yield('title')</h1>

    <div x-data="{flash:true}">
        @if(session()->has('success'))

            <div x-show="flash" class="mb-10 relative rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700" role="alert">
                <strong class="font-bold">Success!</strong>
                <div>
                    {{session('success')}}
                </div>

                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                   <svg @click="flash = false" width="20px" height="20px" viewBox="0 0 0.45 0.45" version="1.1" id="cross" fill="#008000" xmlns="http://www.w3.org/2000/svg"><path d="M0.079 0.038 0.225 0.184l0.145 -0.145A0.028 0.028 0 0 1 0.39 0.03a0.03 0.03 0 0 1 0.03 0.03 0.027 0.027 0 0 1 -0.008 0.02L0.265 0.225l0.147 0.147A0.027 0.027 0 0 1 0.42 0.39a0.03 0.03 0 0 1 -0.03 0.03 0.028 0.028 0 0 1 -0.021 -0.008L0.225 0.266l-0.145 0.145A0.028 0.028 0 0 1 0.06 0.42a0.03 0.03 0 0 1 -0.03 -0.03 0.027 0.027 0 0 1 0.008 -0.02L0.185 0.225 0.038 0.078A0.027 0.027 0 0 1 0.03 0.06a0.03 0.03 0 0 1 0.03 -0.03c0.007 0 0.014 0.003 0.019 0.008"/></svg>
                </span>
            </div>
        @endif
        @yield('content')
    </div>
</body>
</html>
