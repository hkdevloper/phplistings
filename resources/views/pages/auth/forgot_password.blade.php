<!DOCTYPE html>
<html lang="en">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Forgot Password - {{config('app.name')}}te</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{url('/')}}/dist/css/app.css"/>
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->
<body class="login">
<div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Login Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
            <a href="" class="-intro-x flex items-center pt-5">
                <img alt="" class="w-6" src="{{url('/')}}/dist/images/logo.svg">
                <span class="text-white text-lg ml-3"> {{config('app.name')}} </span>
            </a>
            <div class="my-auto">
                <img alt="{{config('app.name')}}" class="-intro-x w-1/3 -mt-16"
                     src="{{url('/')}}/assets/icons/forgot-password.png">
                <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                    A few more clicks to
                    <br>
                    reset your account.
                </div>
                <div class="-intro-x mt-5 text-lg text-white">Rediscover Your Password: Reset Now</div>
            </div>
        </div>
        <!-- END: Login Info -->
        <!-- BEGIN: Login Form -->
        <form action="{{route('forgot.password')}}" method="post"
              class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
            @csrf
            <div
                class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                    Reset Password
                </h2>
                <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to reset your
                    password.
                </div>
                <div class="intro-x mt-8">
                    <input name="email" type="text"
                           class="intro-x login__input input input--lg border border-gray-300 block"
                           placeholder="Email">
                </div>
                <div class="intro-x mt-4 text-gray-500">We'll send you instructions in email.</div>
                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                    <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Send
                        Mail
                    </button>
                </div>
            </div>
        </form>
        <!-- END: Login Form -->
    </div>
</div>
<!-- BEGIN: JS Assets-->
<script src="{{url('/')}}/dist/js/app.js"></script>
<script src="{{url('/')}}/dist/js/main.js"></script>
<script>
    @if(session()->has('msg'))
    showToast('{{ session()->get('types', 'info') }}', '{{ session()->get('msg') }}');
    @endif

    @if($errors->any())
    @foreach ($errors->all() as $error)
    showToast('error', '{{ $error }}');
    @endforeach
    @endif
</script>
<!-- END: JS Assets-->
</body>
</html>
