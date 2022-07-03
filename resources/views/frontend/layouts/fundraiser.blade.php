
    @include('frontend.inc.header')


    <section class='dashboard'>
        <div class="leftBar" id="sidebar">
            <div class="slide" onclick="slide()">  <span class="iconify" data-icon="ion:log-in-outline" data-inline="false"></span>  </div>
            <div class="sideMenu">

                {{-- <div class="profile w-100 d-flex justify-content-center mb-4">

                    <img src="@if (!empty(Auth::user()->photo)) {{asset('images/profile_pic/'.Auth::user()->photo)}} @else https://learnyzen.com/wp-content/uploads/2017/08/test1-481x385.png @endif" style="border-radius: 50%; width:120px; height:120px;" >
                </div> --}}

                <div class="profile w-100 d-flex justify-content-center mb-4">
                    <img src="@if (!empty(Auth::user()->photo)) {{asset('images/profile_pic/'.Auth::user()->photo)}} @else https://learnyzen.com/wp-content/uploads/2017/08/test1-481x385.png @endif"
                        style="border-radius: 50%; width:90px; height:90px;">
                    <input type="file" class="profile-upload">
                </div>



                <p>general</p>
                <ul class="menu-items">
                    <li><a href="{{ route('user.dashboard') }}"><span class="iconify icon" data-icon="ant-design:dashboard-filled" data-inline="false"></span></span> dashboard</a></li>
                    <li><a href="{{ route('fundraisering') }}"><span class="iconify icon" data-icon="ant-design:heart-filled" data-inline="false"></span> Start Fundraising </a></li>
                    <li><a href="{{ route('fundrequest') }}"><span class="iconify icon" data-icon="ant-design:heart-filled" data-inline="false"></span> My Fund Raisers </a></li>
                    <li><a href="{{ route('mydonation') }}"><span class="iconify icon" data-icon="ant-design:heart-filled" data-inline="false"></span> donations i made</a></li>
                    <li><a href="{{ route('favourite.show') }}"><span class="iconify icon" data-icon="ant-design:heart-filled" data-inline="false"></span> Saved fundraiser </a></li>
                    {{-- <li><a href=""><span class="iconify icon" data-icon="entypo:leaf" data-inline="false"></span>Mint</a></li> --}}
                </ul>
                {{-- <p>Charities</p>
                <ul class="menu-items">
                    <li><a href=""><span class="iconify icon" data-icon="whh:managedhosting" data-inline="false"></span>
                            Mange Charities</a></li>
                </ul> --}}
                <p>Account</p>
                <ul class="menu-items">
                    <li><a href="{{ route('fundraiser.withdraw') }}" id="withdraw"><span class="iconify icon" data-icon="ant-design:dashboard-filled" data-inline="false"></span>Withdrawals</a></li>

                    

                    <li><a href="{{ route('fundraiser.profile') }}" id="profile"><span class="iconify icon" data-icon="ant-design:dashboard-filled" data-inline="false"></span>Fundraiser Profile</a></li>
                    <li><a href="{{ route('donor.profile') }}" id="profile"><span class="iconify icon" data-icon="ant-design:dashboard-filled" data-inline="false"></span>Donor Profile</a></li>
                    <li><a href="{{ route('fundraiser.account') }}"><span class="iconify icon" data-icon="ant-design:setting-filled"
                                data-inline="false"></span>Account Settings</a></li>

                    {{-- <li><a href="{{ route('fundraiser.academic-profile') }}" id="profile"><span class="iconify icon" data-icon="ant-design:dashboard-filled" data-inline="false"></span>Academic profile</a></li> --}}

                    <li><a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="iconify icon" data-icon="fa:sign-out" data-inline="false"></span> sign out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>


        @yield('content')

    </section>

    @include('frontend.inc.footer')
