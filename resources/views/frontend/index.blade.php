@extends('frontend.layouts.index')
@section('content')
 <!-- header section -->


    <section class='header-main'>
        <div class="slider">
                <div class="container">
                    <div class="slideInfo">
                        <h1>Fund an Education</h1>
                        <h1>Fund a Future</h1>
                        <p class="mb-4">Dedicated fundraising platform <br> for education</p>
                        <a href="{{route('all-fundraiser')}}" class='btn-theme ms-0 mt-3 text-uppercase'>Donate Now</a>
                    </div>

                </div>
           </div>
        </section>



    <section class="funded">
        <div class="container">
            <div class="row py-4">
                <div class="col-lg-8">
                    <h3 class='sectitle my-3 mb-4 text-capitalize'>Fundraisers</h3>
                    <a href="{{route('all-fundraiser')}}" class="btn-theme ">View All</a>
                </div>
                <div class="col-lg-4">
                    <form action="{{route('fundraiser.search')}}" method ="GET">
                        @csrf
                        <label class='search-panel my-2'>
                            <input type="search" class="form-control user-search"
                                placeholder='Find fundraisers by name or versity ' name="search" id="search">
                                <button  class="btn-theme border-0 px-5">
                                    <span class="iconify" data-icon="bi:search"></span>
                                </button>
                        </label>
                    </form>
                </div>

            </div>
            <div class="row fund-items">

                @foreach ($fundraisers as $data)
                <div class="col-lg-4 col-md-6 col-sm-12 px-4">
                    <div class="box">
                        <div class="header">
                            <div class="photo">
                                <a href="{{route('single-fundraiser', encrypt($data->fid))}}"><img src="{{url('fundraiser/'.$data->image)}}" class="profile"></a>
                            </div>

                            <div class="toper">
                                <input type="hidden" name="fundraiserid" id="fundraiserid" value="{{$data->fid}}">
                                <a style="text-decoration: none" href="{{route('single-fundraiser', encrypt($data->fid))}}"><h4 class="uname">{{$data->title}}</h4></a>
                                <h6 class='user-with-versity'>
                                    <span>{{$data->fname}} {{$data->lname}}</span> | <span>@foreach (App\Models\Profile::where('user_id', '=', $data->id)->orderBy('id','DESC')->limit(1)->get() as $clz)
                                        <span>{{$clz->college}}</span>
                                        @endforeach</span>
                                </h6>
                                <div class="tag">
                                    <span class="iconify" data-icon="cil:tag" data-inline="false"></span> @foreach (App\Models\RaisingFor::where('fundraiser_id', '=', $data->fid)->get() as $raisingdata)
                                    {{$raisingdata->name}},
                                    @endforeach
                                </div>
                                <div class="impression">
                                    <span class="iconify heart" onclick="activeImpression(event)" id='impression'
                                        data-icon="el:heart" data-inline="false"></span>

                                </div>
                            </div>
                        </div>
                        <div class="info">

                           <div class="px-4 py-2">
                            <p class="desc">

                                <a style="text-decoration: none; color:black" href='{{route('single-fundraiser', encrypt($data->fid))}}'>
                                    @php
                                    $string = strip_tags($data->story);
                                    if (strlen($string) > 80) {
                                        // truncate string
                                        $stringCut = substr($string, 0, 80);
                                        $endPoint = strrpos($stringCut, ' ');
                                        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                        $string .= " ...";
                                    }
                                    echo $string;
                                    @endphp
                                  </a>
                            </p>
                            @php
                                $fundcollect = App\Models\Donation::where('project_id', '=', $data->fid)->sum('amount');
                                $d = ($fundcollect/$data->goal)*100;
                            @endphp
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ number_format((float)$d, 2, '.', '')}}%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{ number_format((float)$d, 2, '.', '')}}%</div>
                                  </div>

                           </div>

                            <div class="fund-details">
                                <div class="items">
                                    <h4>${{$fundcollect}}</h4>
                                    <h5>Funded</h5>
                                </div>
                                <div class="items">
                                    <h4>${{ number_format($data->goal, 2) }}</h4>
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
