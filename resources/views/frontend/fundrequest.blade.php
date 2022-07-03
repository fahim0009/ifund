@extends('frontend.layouts.fundraiser')

@section('content')

<div class="rightBar">

    <div class="d-flex justify-content-end">
      {{-- <a class="btn-form float-right" aria-current="page" href="fundraiser-profile.html">Start a fundraiser</a> --}}
    </div>
      <h4 class="text-left font-weight-bold text-uppercase mt-3 mb-4">My fund raisers </h4>

<div id="editContent">

    <div class="user-form">
        <div class="left">

          <div class="ermsg"></div>

              <div class="row">
                  <div class="col-3">
                  <label for="title">Fundraiser Title</label>
                  </div>
                  <div class="col-9">
                  <input type="text" class="form-control" name="title" id="title" placeholder="Fundraiser Title">
                  </div>
              </div><br>
              <input type="hidden" name="reqid" id="reqid" value="">


              <div class="row">
                  <div class="col-3">
                  <label for="goal">Fundraising Goal</label>
                  </div>
                  <div class="col-9">
                  <input type="text" class="form-control" name="goal" id="goal" placeholder="$">
                  <b>Your total withdrawal amount will be:</b>
                  <p>Total donations - (iFundEducation platform + Payment processing fees).<br>Please set the fundraising amount covering those cost.</p>
                  </div>
              </div><br>

              <div id="forfundraising" class="row">
                  <div class="col-3">
                      <label for=""> Fundraising for: </label>
                  </div>
                  <div class="col-9">
                      <input type="checkbox" id="tuition" name="fundraising_for[]" value="Tuition">
                      <label for="tuition">Tution </label>&nbsp;&nbsp;
                       <input type="checkbox" id="room" name="fundraising_for[]" value="Room & Board">
                       <label for="room"> Room & Board </label>&nbsp;&nbsp;
                      <input type="checkbox" id="book" name="fundraising_for[]" value="Books">
                      <label for="book">Books </label>&nbsp;&nbsp;

                      <label> Other </label>
                       <input type="text" id="others" name="fundraising_for[]" >
                  </div>
              </div><br>

              <div class="row">
                  <div class="col-3">
                  <label for="end_date"> Fundraising End Date </label>
                  </div>
                  <div class="col-9">
                  <input type="date" class="form-control" name="end_date" id="end_date">
                  </div>
              </div><br>

              <div class="row">
                  <div class="col-3">
                  <label for="story"> Story </label>
                  </div>
                  <div class="col-9">
                  <textarea name="story" id="story" class="form-control" cols="30" rows="5"></textarea>
                  </div>
              </div><br>

              <div id="allgivinglevel" class="row">
                  <div class="col-3">
                      <label for=""> Add Giving Levels: </label>
                  </div>
                  <div class="col-9">
                      <input type="radio" id="l25" name="giving_level[]" value="25">
                      <label >$25 </label>&nbsp;&nbsp;
                       <input type="radio" id="l50" name="giving_level[]" value="50">
                       <label> $50 </label>&nbsp;&nbsp;
                      <input type="radio" id="l100" name="giving_level[]" value="100">
                      <label >$100 </label>&nbsp;&nbsp;
                     <input type="radio" id="l500" name="giving_level[]" value="500">
                     <label >$500 </label>&nbsp;&nbsp;
                      <label> Other </label>
                       <input type="text" id="other" name="giving_level[]">
                  </div>
              </div><br>
              <div class="row">
                <div class="col-3">
                <label for="image"> Image </label>
                </div>
                <div class="col-9">
                <input type="file" class="form-control" name="image" id="image">
                </div>
            </div><br>

              <label class="forgot-pass"><input type="checkbox" required> I agree to the iFundEducation's terms and acknowledge receipt of the privacy policy.</label>
                <div class="form-group">
                    <div class="form-item">
                        <button class="btn-form" id="updateBtn">Update</button><button class="btn btn-warning" id="closeBtn">Close</button>
                    </div>
                </div>
        </div>
    </div>
</div>






<section class="funded">
    <div class="container">
        <div class="row fund-items">

            @foreach ($funds as $data)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="box">
                    <div class="header">
                        <div class="photo">
                            <a href="{{route('single-fundraiser', encrypt($data->fid))}}"><img src="{{url('fundraiser/'.$data->image)}}" class="profile"></a>
                        </div>

                        <div class="toper">
                            <input type="hidden" name="fundraiserid" id="fundraiserid" value="{{$data->fid}}">
                            <h5 class="uname">{{$data->title}}</h5>
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
@section('script')

<script src="//cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    $(document).ready(function(){


        $("#editContent").hide();
        $("#closeBtn").click(function(){
            $("#editContent").hide();
                // clearform();
            });

        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //
        var url = "{{URL::to('/user/fundrequest')}}";
        //console.log(url);
        $("#updateBtn").click(function(){
            //  alert('btn work');
             for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
                }

            var file_data = $('#image').prop('files')[0];
                if(typeof file_data === 'undefined'){
                file_data = 'null';
                }
            var form_data = new FormData();

            var givingIDs = $("#allgivinglevel input:radio:checked").map(function(){
            return $(this).val();
            }).get();

            var fundfor = $("#forfundraising input:checkbox:checked").map(function(){
            return $(this).val();
            }).get();


            var others =  $("#others").val();

            if(others){
                fundfor.push(others);
                form_data.append("fundraisingfor", fundfor);
            }else{
                form_data.append("fundraisingfor", fundfor);
            }


            form_data.append("giving_level[]", $("#other").val());
            form_data.append("title", $("#title").val());
            form_data.append("goal", $("#goal").val());
            form_data.append("end_date", $("#end_date").val());
            form_data.append("story", $("#story").val());
            form_data.append('image', file_data);
            form_data.append("givinglvl", givingIDs);

            form_data.append('_method', 'put');

            // console.log(image);
            $.ajax({
                url:url+'/'+$("#reqid").val(),
                type: "POST",
                dataType: 'json',
                contentType: false,
                processData: false,
                data:form_data,
                success: function(d){
                    console.log(d);
                    if (d.status == 303) {
                        $(".ermsg").html(d.message);
                        pagetop();
                    }else if(d.status == 300){
                        pagetop();
                        success("Data Update Successfully!!");
                        window.setTimeout(function(){location.reload()},2000)
                    }
                },
                error:function(d){
                    console.log(d);
                }
            });
        });


        //Edit
        $("#contentContainer").on('click','#EditBtn', function(){

            //  alert('btn work');
            codeid = $(this).attr('rid');
            info_url = url + '/'+codeid+'/edit';
            $.get(info_url,{},function(d){
                console.log(d);
                populateForm(d);
                pagetop();
            });
            });
        //Edit  end

        //Delete
        var deleteurl = "{{URL::to('/user/fundrequest')}}";
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

        function populateForm(data){
            for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
            }
                $("#title").val(data.info.title);
                $("#goal").val(data.info.goal);

                $.each(data.raising_for, function( index2, value2 ){
                    if(value2.name == "Tution" || value2.name == "Room & Board" || value2.name == "Books"){
                        $("input[value='" + value2.name + "']").prop('checked', true);
                        }else{
                            $("#others").val(value2.name);
                        }
                    });


                $("#end_date").val(data.info.end_date);
                $("#story").val(data.info.story);
                CKEDITOR.replace( 'story' );
                $("#reqid").val(data.info.id);
                $("#editContent").show(300);
            }

            // function clearform(){
            //     $('#editContent')[0].reset();
            // }

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#profile").addClass('active');
    });
</script>
@endsection
