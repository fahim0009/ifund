<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @yield('css')
    <!--Select2 [ OPTIONAL ]-->
    <link href="{{ asset('select2/css/select2.min.css')}}" rel="stylesheet">
</head>

<body>

    {{-- @foreach (session('flash_notification', collect())->toArray() as $message)
        <script type="text/javascript">
            $(document).on('nifty.ready', function() {
                showAlert('{{ $message['level'] }}', '{{ $message['message'] }}');
            });
        </script>
    @endforeach --}}

    @if(Session::has('success'))
    <p class="alert alert-info">{{ Session::get('success') }}</p>
    @endif

    <section class='header-main'>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{url('/')}}"><img src="{{ asset('assets/images/logo.png') }}" class="img-fluid d-block"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0"> </ul>
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                @guest
                                    <a class="nav-link btn-theme" aria-current="page" href="{{url('login')}}">Start a Fundraiser</a>
                                @else
                                    <a class="nav-link btn-theme" aria-current="page" href="{{ route('fundraisering') }}">Start a Fundraiser</a>
                                @endguest
                            </li>
                            <li class="nav-item">
                                @if (Auth::check())
                                {{-- newcode --}}
                                <a class="nav-link" aria-current="page" href="{{route('fundraiser.profile')}}"><img src="@if (!empty(Auth::user()->photo)) {{asset('images/profile_pic/'.Auth::user()->photo)}} @else https://learnyzen.com/wp-content/uploads/2017/08/test1-481x385.png @endif" alt="" height="40px" width="40px" style="border-radius: 50%;"></a>
                                {{-- newcode --}}

                                @else
                                    <a class="nav-link btn-theme" aria-current="page" href="{{url('login')}}">Sign in/Up</a>
                                @endif


                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </section>
