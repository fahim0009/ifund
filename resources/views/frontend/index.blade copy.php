@extends('frontend.layouts.index')
@section('content')
 <!-- header section -->
    <section class='header-main'>
        <div class="container">
            <div class="slider">
                <div class="slideInfo">
                    <h1 style="font-size: 60px">Fund an education</h1>
                    <h1 style="font-size: 60px">Fund a Future</h1>
                    <p class="mb-4">Dedicated fundraising platform <br> for education</p>
                    <a href="{{route('all-fundraiser')}}" class='btn-theme ms-0 mt-3 text-uppercase'>Donate Now</a>
                </div>
            </div>
        </div>
    </section>

    <section class="funded">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h3 class='sectitle my-2'>Latest fundraisers</h3>
                </div>
                <div class="col-lg-4">
                    <form action="{{route('fundraiser.search')}}" method ="GET">
                       <label class='search-panel my-2'>
                           <input type="search" name="search" class="form-control user-search"
                        placeholder='Find fundraisers by name, college or university '>
                       </label>
                    </form>
                </div>
                <div class="col-lg-4 text-right my-2">
                    <h3 class='d-flex justify-content-center'><a href="{{route('all-fundraiser')}}" class='all-fund'>View all fundraisers</a></h3>
                </div>
            </div>
            <div class="row fund-items">

                @foreach ($fundraisers as $data)

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="box">
                        <div class="photo">
                            <a href="{{route('single-fundraiser', encrypt($data->fid))}}"><img src="{{url('fundraiser/'.$data->image)}}" class="profile"></a>
                        </div>
                        <div class="info">

                            <div class="impression" >
                                @auth

                                    @if (App\Models\Favourite::where('fundraiser_id', '=', $data->fid)->first())

                                        <span class="iconify heart favourite" fundr_id="{{$data->fid}}" onclick="activeImpression(event)" data-icon="el:heart" data-inline="true"></span>

                                    @endif

                                        <span class="iconify heart favourite" fundr_id="{{$data->fid}}" onclick="activeImpression(event)" data-icon="el:heart" data-inline="false"></span>


                                @endauth


                            </div>

                            <input type="hidden" name="fundraiserid" id="fundraiserid" value="{{$data->fid}}">
                            <h5 class="uname">need money for {{$data->title}}</h5>
                            <h6 class='user-with-versity'>
                                <span><strong>{{$data->fname}} {{$data->lname}}</strong></span> | 
                                @foreach (App\Models\Profile::where('user_id', '=', $data->id)->orderBy('id','DESC')->limit(1)->get() as $clz)
                                <span>{{$clz->college}}</span>
                                @endforeach
                            </h6>
                            <div class="tag">

                                <span class="iconify"  data-icon="cil:tag" data-inline="false"></span>
                                @foreach (App\Models\RaisingFor::where('fundraiser_id', '=', $data->fid)->get() as $raisingdata)
                                {{$raisingdata->name}},
                                @endforeach
                            </div>
                            <p class="desc">

                                <a style="text-decoration: none; color:black" href='{{route('single-fundraiser', encrypt($data->fid))}}'>
                                    @php
                                    $string = strip_tags($data->story);
                                    if (strlen($string) > 80) {
                                        // truncate string
                                        $stringCut = substr($string, 0, 80);
                                        $endPoint = strrpos($stringCut, ' ');
                                        //if the string doesn't contain any space then it will cut without word basis.
                                        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string .= " ...";
                                    }
                                    echo $string;
                                    @endphp
                                  </a>
                                  {{-- <a href='{{route('single-fundraiser', encrypt($data->fid))}}'>Read More</a> --}}

                                {{-- {!!$data->story!!} --}}
                            </p>

                            @php
                                $fundcollect = App\Models\Donation::where('project_id', '=', $data->fid)->sum('amount');
                                $d = ($fundcollect/$data->goal)*100;
                            @endphp



                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ number_format((float)$d, 2, '.', '')}}%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{ number_format((float)$d, 2, '.', '')}}%</div>
                                  </div>
                            <div class="fund-details">
                                <div class="items">
                                    <h4>${{$fundcollect}}</h4>
                                    <h5>funded</h5>
                                </div>
                                <div class="items">
                                    <h4>${{$data->goal}}</h4>
                                    <h5>Target</h5>
                                </div>
                                <div class="items">
                                    <h4>{{ Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($data->end_date))}}</h4>
                                    <h5>Days to go </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </section>


@endsection
