@extends('frontend.layouts.fundraiser')

@section('content')

@php
    $fundrequest = DB::table('users')
                    ->leftJoin('fundraisers', 'users.id', '=', 'fundraisers.user_id')
                    ->select('fundraisers.id as fid','fundraisers.title','fundraisers.goal','fundraisers.image','fundraisers.end_date','fundraisers.story','fundraisers.giving_level','fundraisers.status','users.*')
                    ->where([
                        ['users.is_type', '=', 'user'],
                        ['fundraisers.user_id', '=', Auth::user()->id],
                    ])->count();
@endphp

<div class="rightBar">

    <div class="d-flex justify-content-end">
      {{-- <a class="btn-form float-right" aria-current="page" href="fundraiser-profile.html">Start a fundraiser</a> --}}
    </div>

    <section class="funded">
        <div class="container">

            <div class="row fund-items">




              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box">
                    <div class="info">
                       <div class="px-4 py-2">
                        <h2>MY FUND RAISERS </h2>
                       </div>
                        <div class="fund-details">
                            <div class="items">
                                <h4> {{ $fundrequest }} </h4>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box">
                    <div class="info">
                       <div class="px-4 py-2">
                        <h2>TOTAL FUND RECEIVED </h2>
                       </div>
                        <div class="fund-details">
                            <div class="items">
                                <h4>{{ App\Models\Donation::where('user_id', '=', Auth::user()->id)->sum('amount') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box">
                    <div class="info">
                       <div class="px-4 py-2">
                        <h2>MY DONATION </h2>
                       </div>
                        <div class="fund-details">
                            <div class="items">
                                <h4>{{ App\Models\Donation::where('user_id', '=', Auth::user()->id)->sum('total_amount') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box">
                    <div class="info">
                       <div class="px-4 py-2">
                        <h2>TOTAL WITHDRAW </h2>
                       </div>
                        <div class="fund-details">
                            <div class="items">
                                <h4>74%</h4>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box">
                    <div class="info">
                       <div class="px-4 py-2">
                        <h2>TOTAL AVAILABLE BALANNCE </h2>
                       </div>
                        <div class="fund-details">
                            <div class="items">
                                <h4>74%</h4>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              


            </div>
        </div>
    </section>


@endsection
@section('script')

{{-- <script src="//cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script> --}}
<script>

</script>
<script type="text/javascript">
    $(document).ready(function() {
        // $("#profile").addClass('active');
    });
</script>
@endsection
