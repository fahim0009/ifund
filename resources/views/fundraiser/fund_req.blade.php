@extends('layouts.admin')



@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
                <p>A free and open source Bootstrap 4 admin template</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ul>
        </div>

        <hr>

        <div id="contentContainer">


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3> All Request From Fundraiser</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">
                                    <table class="table table-bordered table-hover" id="example">
                                        <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Title</th>
                                            <th>Story</th>
                                            <th>Goal</th>
                                            <th>Last Date</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $n = 1;
                                            ?>
                                            @foreach ($funds as $fund)
                                            <tr>
                                                <td>{{$n++}}</td>
                                                
                                                <td><a href="{{route('single-fundraiser', encrypt($fund->id))}}" target="_blank">{{$fund->title}}</a></td>
                                                <td>{!!$fund->story!!}</td>
                                                <td>${{$fund->goal}}</td>
                                                <td>{{$fund->end_date}}</td>
                                                <td>
                                                    <div class="toggle-flip">
                                                    <label>
                                                        <input type="checkbox" class="toggle-class" data-id="{{$fund->id}}" {{ $fund->status ? 'checked' : '' }}><span class="flip-indecator" data-toggle-on="Active" data-toggle-off="Inactive"></span>
                                                    </label>
                                                    </div>
                                                </td>
                                                <td><a id="deleteBtn" rid="{{$fund->id}}"><i class="fa fa-trash" style="color: red;font-size:16px;"></i></a></td>
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


    </main>

@endsection
@section('script')

<script>
    $(document).ready(function(){

        //Delete
        var deleteurl = "{{URL::to('/admin/fundrequest')}}";
        $("#contentContainer").on('click','#deleteBtn', function(){
                if(!confirm('Sure?')) return;
                codeid = $(this).attr('rid');
                console.log(codeid);
                info_url = deleteurl + '/'+codeid;
                console.log(info_url);
                $.ajax({
                    url:info_url,
                    method: "GET",
                    type: "DELETE",
                    data:{
                    },
                    success: function(d){
                        console.log(d);
                        if(d.success) {
                            success("Deleted Successfully!!");
                            //alert(d.message);
                            location.reload();
                        }
                    },
                    error:function(d){
                        console.log(d);
                    }
                });
            });
        //Delete
        
    });
</script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $("#fundreq").addClass('active');
        });
    </script>

<script>
    $(function() {
      $('.toggle-class').change(function() {
        var url = "{{URL::to('/admin/fundrequest-status')}}";
          var status = $(this).prop('checked') == true ? 1 : 0;
          var id = $(this).data('id');
           console.log(status);
          $.ajax({
              type: "GET",
              dataType: "json",
              url: url,
              data: {'status': status, 'id': id},
              success: function(d){
                // console.log(data.success)
                if (d.status == 303) {
                                $(".ermsg").html(d.message);
                            }else if(d.status == 300){
                                $(".ermsg").html(d.message);
                                // window.setTimeout(function(){location.reload()},2000)
                            }
                        },
                        error: function (d) {
                            console.log(d);
                        }
          });
      })
    })
  </script>
 
@endsection
