@extends('frontend.layouts.fundraiser')

@section('content')

<div class="rightBar">


      <h4 class="text-left font-weight-bold text-uppercase mt-3 mb-4">My Donation </h4>


      <div class="user-form">
          <div class="left">


            <div id="contentContainer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="container">

                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Title</th>
                                                <th>Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($funds as $data)
                                                <tr>
                                                    <td>{{ Carbon\Carbon::parse($data->created_at)->format('Y-m-d') }}</td>
                                                    <td><a href="{{route('single-fundraiser', encrypt($data->fid))}}" target="_blank" style="text-decoration: none">{{$data->title}}</a></td>
                                                    <td>${{ number_format($data->amount, 2) }}</td>

                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




          </div>
      </div>

  </div>

@endsection
@section('script')


<script type="text/javascript">
    $(document).ready(function() {
        $("#profile").addClass('active');
    });
</script>
@endsection
