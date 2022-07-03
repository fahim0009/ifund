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
                        <label for="college">College/University </label>
                        <select name="college" id="college" class="form-control js-example-basic-single">
                            <option value="@if(!empty($academic->college)) {{$academic->college}} @else  @endif">@if(!empty($academic->college)) {{$academic->college}} @else Please Select @endif</option>
                                @foreach (App\Models\University::all() as $university)
                                    <option value="{{$university->name }}">{{$university->name }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="form-item">
                        <label for="othercollege"> Other College/University </label>
                        <input type="text" name="othercollege" id="othercollege" class="form-control">
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

          {{-- <div class="schedule-ermsg"></div> --}}

          {{-- classe schedule --}}

          <div class="form-group">
              <div class="form-item">
                  <label for="">Class Schedule</label>
                  <input type="text" class="form-control">
              </div>
              <div class="form-item">
                  <label for="">Class Schedule</label>
                  <div class="addFile ">
                      <input type="file" class="profile-upload">
                  </div>

              </div>
          </div>


          <div class="form-group">
              <div class="form-item">
                Schedule text goes Here
              </div>
              <div class="form-item d-flex align-items-center">
                   <img class="img-fluid rounded me-3 " width="100px" src="https://learnyzen.com/wp-content/uploads/2017/08/test1-481x385.png" alt="">
                   <span class="iconify text-danger" data-icon="fluent:delete-28-filled"></span>
              </div>
          </div>


          <div class="form-group">
              <div class="form-item">
                  <label for="class_schedule">Class Schedule </label>
                  <input type="text" name="class_schedule" value="@if(!empty($academic->class_schedule)) {{$academic->class_schedule}} @else  @endif" id="class_schedule" class="form-control">
              </div>
              <div class="form-item">
                  <label for="class_schedule_file"> Class Schedule File <img style="cursor:pointer" src="{{ asset('images/image-upload24x24.png') }}" alt="" title="Upload Images">
                  </label>
                  <input id="class_schedule_file" multiple="" accept="image/gif, image/jpeg, image/png" name="class_schedule_file[]" type="file">
              </div>
          </div>


          <div class="form-group">
              <div class="form-item">
                  <div class="preview2"></div>
              </div>
          </div>




          {{-- image show  --}}
          <div class="photo-gallery">
              <div class="container">
                  <div class="row photos">


                      @foreach (App\Models\ClassSchedule::where('user_id', '=', Auth::user()->id)->get() as $clschedule)

                          <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="@if(!empty($clschedule->name)){{url('/storage/postimages/'.$clschedule->name)}} @else @endif" data-lightbox="photos"><img class="img-fluid" src="@if(!empty($clschedule->name)){{url('/storage/postimages/'.$clschedule->name)}} @else  @endif"></a></div>

                      @endforeach

                  </div>
              </div>
          </div>
          {{-- image show  --}}


              {{-- academic profile  --}}

                <div class="form-group">
                    <div class="form-item">
                        <button class="btn-form" id="update_data">Save</button>
                    </div>
                </div>

        </div>

    </div>
      {{-- section end  --}}


      <h4 class="text-left font-weight-bold text-uppercase mt-3 mb-4">Transcript </h4>

      <div class="user-form">
        <div class="left">

          {{-- <div class="schedule-ermsg"></div> --}}

          {{-- Transcript --}}

          <div class="form-group">
              <div class="form-item">
                  <label for="">Transcript </label>
                  <input type="text" class="form-control">
              </div>
              <div class="form-item">
                  <label for="">Tracscript file</label>
                  <div class="addFile ">
                      <input type="file" class="profile-upload">
                  </div>

              </div>
          </div>
          <div class="form-group">
              <div class="form-item">
                  Tracscript text goes Here
              </div>
              <div class="form-item d-flex align-items-center">
                   <img class="img-fluid rounded me-3 " width="100px" src="https://learnyzen.com/wp-content/uploads/2017/08/test1-481x385.png" alt="">
                   <span class="iconify text-danger" data-icon="fluent:delete-28-filled"></span>
              </div>
          </div>
          <div class="form-group">
              <div class="form-item">
                  <label for="transcript">Transcript </label>
                  <input type="text" name="transcript" id="transcript" value="@if(!empty($academic->transcript)) {{$academic->transcript}} @else  @endif" class="form-control">
              </div>
              <div class="form-item">
                  <label for="transcript_file"> Transcript File <img style="cursor:pointer" src="{{ asset('images/image-upload24x24.png') }}" alt="" title="Upload Images">
                  </label>
                  <input id="transcript_file" multiple="" accept="image/gif, image/jpeg, image/png" name="transcript_file[]" type="file">
              </div>
          </div>
          <div class="form-group">
              <div class="form-item">
                  <div class="preview3"></div>
              </div>
          </div>
          {{-- image show  --}}
          <div class="photo-gallery">
              <div class="container">
                  <div class="row photos">


                      @foreach (App\Models\Transcript::where('user_id', '=', Auth::user()->id)->get() as $transcript)

                          <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="@if(!empty($transcript->name)){{url('/storage/postimages/'.$transcript->name)}} @else @endif" data-lightbox="photos"><img class="img-fluid" src="@if(!empty($transcript->name)){{url('/storage/postimages/'.$transcript->name)}} @else  @endif"></a></div>

                      @endforeach

                  </div>
              </div>
          </div>
          {{-- image show  --}}
          {{-- Transcript --}}

              {{-- academic profile  --}}

                <div class="form-group">
                    <div class="form-item">
                        <button class="btn-form" id="update_data">Save</button>
                    </div>
                </div>

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
        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //
        var url = "{{URL::to('/user/fundraiser-profile')}}";
        //console.log(url);
        $("#update_data").click(function(){
             //alert('btn work');

        var file_data = $('#image').prop('files')[0];
            if(typeof file_data === 'undefined'){
            file_data = 'null';
            }
            var form_data = new FormData();

            for(var i=0, len=storedFiles2.length; i<len; i++) {
                form_data.append('class_schedule_file[]', storedFiles2[i]);
            }
            for(var i=0, len=storedFiles3.length; i<len; i++) {
                form_data.append('transcript_file[]', storedFiles3[i]);
            }

            form_data.append("classification", $("#classification").val());
            form_data.append("college", $("#college").val());
            form_data.append("othercollege", $("#othercollege").val());
            form_data.append("degree", $("#degree").val());
            form_data.append("major_sub", $("#major_sub").val());
            form_data.append("current_gpa", $("#current_gpa").val());
            form_data.append("class_schedule", $("#class_schedule").val());
            form_data.append("transcript", $("#transcript").val());



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

            form_data.append('image', file_data);
            form_data.append('_method', 'put');

            // console.log(image);
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



               // class schedule file view
            $(document).on('change','#class_schedule_file',function(){
                len_files = $("#class_schedule_file").prop("files").length;
                var construc = "<div class='row'>";
                for (var i = 0; i < len_files; i++) {
                    var file_data2 = $("#class_schedule_file").prop("files")[i];
                    storedFiles2.push(file_data2);
                    construc += '<div class="col-3 singleImage my-3"><span data-file="'+file_data2.name+'" class="btn ' +
                        'btn-sm btn-danger imageremove2">&times;</span><img width="120px" height="auto" src="' +  window.URL.createObjectURL(file_data2) + '" alt="'  +  file_data2.name  + '" /></div>';
                }
                construc += "</div>";
                $('.preview2').append(construc);
            });

            $(".preview2").on('click','span.imageremove2',function(){
                var trash = $(this).data("file");
                for(var i=0;i<storedFiles2.length;i++) {
                    if(storedFiles2[i].name === trash) {
                        storedFiles2.splice(i,1);
                        break;
                    }
                }
                $(this).parent().remove();
            });

            // class schedule file view end

            // transcript file view
        $(document).on('change','#transcript_file',function(){
            len_files = $("#transcript_file").prop("files").length;
            var construc = "<div class='row'>";
            for (var i = 0; i < len_files; i++) {
                var file_data3 = $("#transcript_file").prop("files")[i];
                storedFiles3.push(file_data3);
                construc += '<div class="col-3 singleImage my-3"><span data-file="'+file_data3.name+'" class="btn ' +
                    'btn-sm btn-danger imageremove3">&times;</span><img width="120px" height="auto" src="' +  window.URL.createObjectURL(file_data3) + '" alt="'  +  file_data3.name  + '" /></div>';
            }
            construc += "</div>";
            $('.preview3').append(construc);
        });

        $(".preview3").on('click','span.imageremove3',function(){
            var trash = $(this).data("file");
            for(var i=0;i<storedFiles3.length;i++) {
                if(storedFiles3[i].name === trash) {
                    storedFiles3.splice(i,1);
                    break;
                }
            }
            $(this).parent().remove();

        });
        // transcript file view end


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
