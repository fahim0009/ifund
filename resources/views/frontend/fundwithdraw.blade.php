
@extends('frontend.layouts.fundraiser')

@section('content')

<div class="rightBar">

    <div class="d-flex justify-content-end">
      {{-- <a class="btn-form float-right" aria-current="page"  onclick="show_withdraw_modal()" href="#">Withdraw</a> --}}
      <button class="btn-form float-right" aria-current="page" onclick="show_withdraw_modal()">Withdraw</button>
    </div>
    

    <div class="left">
      <p class="text-left font-weight-bold text-uppercase mt-3 mb-4">Total Withdraw:  $ {{$totalwithdraw}}<br>
      Balance:  $ {{$balance}}</p>
    </div>


    {{-- modal show --}}
    <div class="modal fade" id="withdraw_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">Withdraw</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                </div>
                <form action="{{ route('withdraw.cashout') }}" method="post">
                    @csrf
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Amount <span class="required-star">*</span></label>
                            </div>
                            <div class="col-md-10">
                                <input type="number" class="form-control mb-3" name="amount" placeholder="Amount" required>
                                <input type="hidden" name="fundid" id="fundid" value="{{$funds->fid}}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> --}}
                        <button type="submit" class="btn-form">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal end --}}


    <div id="contentContainer">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="container">

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdraw as $data)
                                        <tr>
                                            <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                            <td><a href="{{route('single-fundraiser', encrypt($data->fid))}}" target="_blank" style="text-decoration: none">{{$data->title}}</a></td>
                                            <td>{{$data->status}}</td>
                                            <td>{{$data->amount}}</td>
                                            
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







@endsection
@section('script')
<script type="text/javascript">
    function show_withdraw_modal(){
        $('#withdraw_modal').modal('show');
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#profile").addClass('active');
    });
</script>
@endsection