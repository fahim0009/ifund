@extends('frontend.layouts.index')

 
@section('content')
<!-- header section -->

   <section class="authentication">
       <div class="container">
         <div class="authContainer">
             <div class="login">
                 <div class="heading">
                    <h2>welcome back!</h2>
                    <h5>sign in your account</h5>
                 </div>

                <form method="POST" action="{{ route('login') }}" class="form-theme">
                        @csrf
                    <label for="">
                        {{-- new code --}}
                        <input id="logemail" type="email" class="form-theme-control @error('logemail') is-invalid @enderror" name="logemail" value="{{ old('logemail') }}" required autocomplete="logemail" placeholder="Email" autofocus>

                        @if ($errors->has('logemail'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('logemail') }}</strong>
                            </span>
                        @endif
                        {{-- new code --}}
                        {{-- <input type="email" class='form-theme-control' placeholder="Email"> --}}
                        <span class="iconify icon" data-icon="carbon:email" data-inline="false"></span>
                    </label>

                    <label for="">
                        {{-- new code --}}
                        <input id="logpassword" type="password" class="form-theme-control @error('logpassword') is-invalid @enderror" name="logpassword" required autocomplete="current-password" placeholder="Password">

                        @if ($errors->has('logpassword'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('logpassword') }}</strong>
                            </span>
                        @endif
                                
                        {{-- new code --}}
                        {{-- <input type="password" class='form-theme-control' placeholder="Password">  --}}
                        <span class="iconify icon" data-icon="teenyicons:password-outline" data-inline="false"></span>
                    </label>

                    <button class="form-btn">sign in </button>
                    <small class="forgot-pass"><a href=""class="text-center txt-theme mt-1">Forgot password</a></small>

                 </form>
             </div>
             <div class="divider">
                 <hr>
             </div>
             <div class="register">
                <div class="heading">
                    <h2>lets get started</h2>
                    <h5>create  your account</h5>
                 </div>

                <form method="POST" class="form-theme" action="{{ route('register') }}">
                        @csrf
                    <label for="">
                        {{-- newcode --}}
                        <input id="fname" type="text" class="form-theme-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" placeholder="First Name" required autocomplete="fname" autofocus>
                        @error('fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        {{-- newcode --}}
                        {{-- <input type="text" class='form-theme-control' placeholder="First Name"> --}}
                       <span class="iconify icon" data-icon="clarity:user-line" data-inline="false"></span>
                    </label>
                    <label for="">
                        {{-- newcode --}}
                        <input id="lname" type="text" class="form-theme-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" placeholder="Last name" required autocomplete="lname" autofocus>

                        @error('lname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        {{-- newcode --}}
                        {{-- <input type="text" class='form-theme-control' placeholder="Last name"> --}}
                       <span class="iconify icon" data-icon="clarity:user-line" data-inline="false"></span>
                    </label>
                    <label for="">
                        {{-- newcode --}}
                        <input id="email" type="email" class="form-theme-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        {{-- newcode --}}
                        {{-- <input type="text" class='form-theme-control' placeholder="Email"> --}}
                        <span class="iconify icon" data-icon="carbon:email" data-inline="false"></span>
                    </label>

                    <label for="">
                        {{-- newcode --}}
                        <input id="password" type="password" class="form-theme-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        {{-- newcode --}}
                        {{-- <input type="password" class='form-theme-control' placeholder="Password"> --}}
                        <span class="iconify icon" data-icon="teenyicons:password-outline" data-inline="false"></span>

                    </label>

                    <label for="">
                        {{-- newcode --}}
                        <input id="password-confirm" type="password" class="form-theme-control" name="password_confirmation" placeholder="Password" required autocomplete="new-password">
                        {{-- newcode --}}
                        {{-- <input type="password" class='form-theme-control' placeholder="Password"> --}}
                        <span class="iconify icon" data-icon="teenyicons:password-outline" data-inline="false"></span>

                    </label>

                    <small class="forgot-pass"> <input type="checkbox" name="" id="" required> i accept the terms  </small>
                    <button class="form-btn">sign up </button>

                 </form>
             </div>
         </div>
       </div>
   </section>

   @endsection
@section('script')

@endsection
