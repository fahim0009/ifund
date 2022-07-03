@extends('frontend.layouts.fundraiser')
@section('css')
<style>

    .photo-gallery {
      color:#313437;
      background-color:#fff;
    }

    .photo-gallery p {
      color:#7d8285;
    }

    .photo-gallery h2 {
      font-weight:bold;
      margin-bottom:40px;
      padding-top:40px;
      color:inherit;
    }

    @media (max-width:767px) {
      .photo-gallery h2 {
        margin-bottom:25px;
        padding-top:25px;
        font-size:24px;
      }
    }

    .photo-gallery .intro {
      font-size:16px;
      max-width:500px;
      margin:0 auto 40px;
    }

    .photo-gallery .intro p {
      margin-bottom:0;
    }

    .photo-gallery .photos {
      padding-bottom:20px;
    }

    .photo-gallery .item {
      padding-bottom:30px;
    }

    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
@endsection


@section('content')

<div class="rightBar">

    <div class="d-flex justify-content-end">
      {{-- <a class="btn-form float-right" aria-current="page" href="fundraiser-profile.html">Start a fundraiser</a> --}}
    </div>
      <h4 class="text-left font-weight-bold text-uppercase mt-3 mb-4">fundraiser profile </h4>


      <div class="user-form">
          <div class="left">

            <div class="ermsg"></div>

                  <div class="form-group">
                      <div class="form-item">
                          <label for="fname"> First Name </label>
                          <input type="text" name="fname" id="fname" value="{{$profile_data->fname}}" class="form-control">
                          <input type="hidden" id="profile_id" value="{{$profile_data->id}}" class="form-control">
                      </div>
                      <div class="form-item">
                          <label for="lname"> Last Name </label>
                          <input type="text" name="lname" id="lname" value="{{$profile_data->lname}}" class="form-control">
                      </div>
                  </div>

                <div class="form-group">
                    <div class="form-item">
                        <label for="email"> Email </label>
                        <input type="email" name="email" id="email" value="{{$profile_data->email}}" class="form-control">
                    </div>
                    <div class="form-item">
                        <label for="phone"> Phone </label>
                        <input type="number" name="phone" id="phone" value="{{$profile_data->phone}}" class="form-control">
                    </div>
                    <div class="form-item">
                        <label for="dob"> Date of Birth </label>
                        <input type="date" name="dob" id="dob"  value="{{$profile_data->dob}}" class="form-control">
                    </div>
                </div>

                  <div class="form-group">
                      <div class="form-item">
                          <label for="address"> Address </label>
                          <input type="text" name="address" id="address" value="{{$profile_data->address}}" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="form-item">
                          <label for="city">City </label>
                          <input type="text" name="city" id="city" value="{{$profile_data->city}}" class="form-control">
                      </div>
                      <div class="form-item">
                        <label for="state"> State </label>
                       <select name="state" id="state" class="form-control">
                           <option value="{{$profile_data->state}}">{{$profile_data->state}}</option>

                          @foreach (App\Models\State::all() as $states)
                                  <option value="{{$states->name}}">{{$states->name}}</option>
                          @endforeach

                       </select>
                    </div>
                  </div>
                  <div class="form-group">
                      <div class="form-item">
                          <label for="postal_code">Zip code </label>
                          <input type="number" name="postal_code" id="postal_code" value="{{$profile_data->postal_code}}" class="form-control">
                      </div>
                      <div class="form-item">
                          <label for="country"> Country </label>
                         <select name="country" id="country" class="form-control">
                             <option value="{{$profile_data->country}}">{{$profile_data->country}}</option>

                            @foreach (App\Models\Country::all() as $countries)
                                    <option value="{{$countries->name}}">{{$countries->name}}</option>
                            @endforeach

                         </select>
                      </div>
                  </div>



                <div class="form-group">
                    <div class="form-item">
                        <label for="linkedin">LinkedIn </label>
                        <input type="text" name="linkedin" id="linkedin"  value="{{$profile_data->linkedin}}" class="form-control">
                    </div>
                    <div class="form-item">
                        <label for="facebook"> Facebook </label>
                        <input type="text" name="facebook" id="facebook" value="{{$profile_data->facebook}}" class="form-control">
                    </div>
                </div>



                <div class="form-group">
                    <div class="form-item">
                        <label for=""> College/University </label>
                        <select name="college" id="college" class="form-control js-example-basic-single">
                            <option value="@if(!empty($academic->college)) {{$academic->college}} @else  @endif">@if(!empty($academic->college)) {{$academic->college}} @else Please Select @endif</option>
                                @foreach (App\Models\University::all() as $university)
                                    <option value="{{$university->name }}">{{$university->name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-item d-flex flex-column">
                      <label for="others">  College/University (If not listed)  </label>
                        <div class="d-flex">
                            <input type="checkbox" id="others">
                        <label for="othercollege" class="othersCollaps w-100 ">
                             <input type="text" class="form-control" name="othercollege" id="othercollege" >
                        </label>
                        </div>

                    </div>
                </div>

              <div class="form-group">

                <div class="form-item">
                    <label for="major_sub"> Study Major </label>
                    <input type="text" name="major_sub" id="major_sub" value="@if(!empty($academic->major_sub)) {{$academic->major_sub}} @else  @endif" class="form-control">
                </div>

                <div class="form-item">
                    <label for="classification"> Classification </label>
                    <select name="classification" id="classification" class="form-control">
                        <option value="@if(!empty($academic->classification)) {{$academic->classification}} @else  @endif">@if(!empty($academic->classification)) {{$academic->classification}} @else Please Select @endif</option>
                        <option value="Freshman">Freshman</option>
                        <option value="Sophomore">Sophomore</option>
                        <option value="Junior">Junior</option>
                        <option value="Senior">Senior</option>
                        <option value="Other">Other</option>
                    </select>
                </div>


            </div>
            <div class="form-group">
                <div class="form-item">
                    <label for="current_gpa"> Current GPA </label>
                    <input type="text" name="current_gpa" id="current_gpa" value="@if(!empty($academic->current_gpa)) {{$academic->current_gpa}} @else  @endif" class="form-control">
                </div>

                <div class="form-item">
                    <label for="degree"> Degree Enrolled in </label>
                   <select name="degree" id="degree" class="form-control">
                    <option value="@if(!empty($academic->degree)) {{$academic->degree}} @else  @endif">@if(!empty($academic->degree)) {{$academic->degree}} @else Please Select @endif</option>
                       <option value="Undergraduate">Undergraduate</option>
                       <option value="Graduate">Graduate</option>
                       <option value="Doctorate">Doctorate</option>
                       <option value="Associate">Associate</option>
                   </select>
                </div>
            </div>


                {{-- academic profile  --}}

                  <div class="form-group">
                      <div class="form-item">
                          <button class="btn-form" id="update_data">Save</button>
                      </div>
                  </div>

          </div>

      </div>

      {{-- new section start  --}}

      <h4 class="text-left font-weight-bold text-uppercase mt-3 mb-4">Class Schedule </h4>

      <div class="user-form">
        <div class="left">
          <div class="scheduleermsg"></div>
          {{-- classe schedule --}}
          <div class="form-group">
              <div class="form-item">
                  <label for="">Class Schedule</label>
                  <input type="text" class="form-control" id="clschedule" name="clschedule" required>
              </div>
              <div class="form-item">
                  <label for="">Class Schedule</label>
                  <div class="addFile ">
                      <input type="file" class="profile-upload" id="scheduleimg" name="scheduleimg" required>
                  </div>
              </div>
          </div>
          <div class="form-group">
            <button class="btn-form" id="create_schedule">Save</button>
        </div>


          <div class="form-group">
              <table class="table table-borderless">
                <tbody>



                    @foreach (App\Models\ClassSchedule::where('user_id','=', Auth::user()->id)->get() as $schedule )



                    <tr>
                      <td>
                          <div class="form-item">
                          {{ $schedule->desc }}
                        </div>
                      </td>

                      <td>
                          <div class="form-item d-flex align-items-center">
                              <img class="img-fluid rounded me-3 " width="100px" src="{{url('/images/class_schedule/'.$schedule->name)}}" alt="">
                         </div>
                      </td>
                      <td> <div class="form-item"><a id="viewBtn" href="@if(!empty($schedule->name)){{url('/images/class_schedule/'.$schedule->name)}} @else https://via.placeholder.com/1200x800 @endif"  rid="{{$schedule->id}}"><i class="fa fa-eye" style="color: rgb(13, 95, 44);font-size:16px;"></i></a></div></td>
                  <td> <div class="form-item"><a id="scheduledeleteBtn" class="scheduledeleteBtn" rid="{{$schedule->id}}"><i class="fa fa-trash" style="color: red;font-size:16px;"></i></a></div> </td>
                    </tr>
                    @endforeach



                </tbody>
              </table>
          </div>



        </div>



    </div>
      {{-- section end  --}}


      <h4 class="text-left font-weight-bold text-uppercase mt-3 mb-4">Transcript </h4>

      <div class="user-form">
        <div class="left">

          <div class="transcriptermsg"></div>

          {{-- Transcript --}}

          <div class="form-group">
              <div class="form-item">
                  <label for="">Transcript </label>
                  <input type="text" class="form-control" id="transcript" name="transcript" required>
              </div>
              <div class="form-item">
                  <label for="">Tracscript file</label>
                  <div class="addFile ">
                      <input type="file" class="profile-upload" id="tranimg" name="tranimg" required>
                  </div>
              </div>
          </div>
          <div class="form-group">
            <button class="btn-form" id="create_transcript">Save</button>
        </div>


          <div class="form-group">
            <table class="table table-borderless">
              <tbody>
                @foreach (App\Models\Transcript::where('user_id','=', Auth::user()->id)->get() as $transcript )
                <tr>
                  <td>
                      <div class="form-item">
                      {{ $transcript->desc }}
                    </div>
                  </td>
                  <td>
                      <div class="form-item d-flex align-items-center">
                          <img class="img-fluid rounded me-3 " width="100px" src="{{url('/images/tranimg/'.$transcript->name)}}" alt="">
                     </div>
                  </td>
                  <td> <div class="form-item"><a id="viewBtn"  href="@if(!empty($transcript->name)){{url('/images/tranimg/'.$transcript->name)}} @else https://via.placeholder.com/1200x800 @endif" rid="{{$transcript->id}}"><i class="fa fa-eye" style="color: rgb(13, 95, 44);font-size:16px;"></i></a></div></td>
                  <td> <div class="form-item"><a id="deleteBtn" class="deleteBtn" rid="{{$transcript->id}}"><i class="fa fa-trash" style="color: red;font-size:16px;"></i></a></div> </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
          {{-- Transcript --}}
        </div>
    </div>
      {{-- section end  --}}

  </div>

@endsection
@section('script')
<script>
    $(document).ready(function(){

        var storedFiles2 = [];
        var storedFiles3 = [];
        // header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //
        var url = "{{URL::to('/user/fundraiser-profile')}}";
        //console.log(url);
        $("#update_data").click(function(){
             //alert('btn work');


            var form_data = new FormData();


            form_data.append("classification", $("#classification").val());
            form_data.append("college", $("#college").val());
            form_data.append("othercollege", $("#othercollege").val());
            form_data.append("degree", $("#degree").val());
            form_data.append("major_sub", $("#major_sub").val());
            form_data.append("current_gpa", $("#current_gpa").val());


            form_data.append("fname", $("#fname").val());
            form_data.append("lname", $("#lname").val());
            form_data.append("email", $("#email").val());
            form_data.append("phone", $("#phone").val());
            form_data.append("address", $("#address").val());
            form_data.append("city", $("#city").val());
            form_data.append("postal_code", $("#postal_code").val());
            form_data.append("state", $("#state").val());
            form_data.append("country", $("#country").val());
            form_data.append("dob", $("#dob").val());
            form_data.append("linkedin", $("#linkedin").val());
            form_data.append("facebook", $("#facebook").val());

            form_data.append('_method', 'put');

            // alert(name);
            $.ajax({
                url:url+'/'+$("#profile_id").val(),
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
                        success("Profile Update Successfully!!");
                        window.setTimeout(function(){location.reload()},2000)
                    }
                },
                error:function(d){
                    console.log(d);
                }
            });
        });
        // class schedule add start

        var scheduleurl = "{{URL::to('/user/class-schedule')}}";
        //console.log(url);
        $("#create_schedule").click(function(){
            //  alert('btn work2');

            var file_data = $('#scheduleimg').prop('files')[0];
            if(typeof file_data === 'undefined'){
            file_data = 'null';
            $(".scheduleermsg").html("<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Class Schedule Image\" field..!</b></div>");
            }
            var form_data = new FormData();
            form_data.append("clschedule", $("#clschedule").val());
            form_data.append('scheduleimg', file_data);
            // form_data.append('_method', 'put');

            // console.log(scheduleimg);
            // alert(name);
            $.ajax({
                url:scheduleurl,
                type: "POST",
                dataType: 'json',
                contentType: false,
                processData: false,
                data:form_data,
                success: function(d){
                    console.log(d);
                    if (d.status == 303) {
                        $(".scheduleermsg").html(d.message);
                    }else if(d.status == 300){
                        $(".scheduleermsg").html(d.message);
                        // success("Class schedule Update Successfully!!");
                        window.setTimeout(function(){location.reload()},2000)
                    }
                },
                error:function(d){
                    console.log(d);
                }
            });
        });
        // class schedule end

        // Transcript add start
        var transcripturl = "{{URL::to('/user/transcript')}}";
        //console.log(url);
        $("#create_transcript").click(function(){
            //  alert('btn work2');

            var file_data = $('#tranimg').prop('files')[0];
            if(typeof file_data === 'undefined'){
            file_data = 'null';
            $(".transcriptermsg").html("<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Transcript Image\" field..!</b></div>");
            }
            var form_data = new FormData();
            form_data.append("transcript", $("#transcript").val());
            form_data.append('tranimg', file_data);
            // form_data.append('_method', 'put');
            $.ajax({
                url:transcripturl,
                type: "POST",
                dataType: 'json',
                contentType: false,
                processData: false,
                data:form_data,
                success: function(d){
                    console.log(d);
                    if (d.status == 303) {
                        $(".transcriptermsg").html(d.message);
                    }else if(d.status == 300){
                        $(".transcriptermsg").html(d.message);
                        window.setTimeout(function(){location.reload()},2000)
                    }
                },
                error:function(d){
                    console.log(d);
                }
            });
        });
        // Transcript end


    });
</script>
<script>
    $(document).ready(function(){

        //Delete
        var deleteurl = "{{URL::to('/user/transcript')}}";
        $(".deleteBtn").click(function(){
            // alert('btn');
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
                        $(".transcriptermsg").html(d.message);
                        window.setTimeout(function(){location.reload()},2000)

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

<script>
    $(document).ready(function(){

        //Delete
        var scheduleurl = "{{URL::to('/user/class-schedule')}}";
        $(".scheduledeleteBtn").click(function(){
            // alert('btn');
                if(!confirm('Sure?')) return;
                codeid = $(this).attr('rid');
                console.log(codeid);
                info_url = scheduleurl + '/'+codeid;
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
                        $(".scheduleermsg").html(d.message);
                            // success("Deleted Successfully!!");
                            window.setTimeout(function(){location.reload()},2000)
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
        $('select').select2();
    });
  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
{{-- <script type="text/javascript" src="{{ asset('assets/js/select2.min.js') }}"></script> --}}

@endsection
