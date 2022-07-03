@extends('frontend.layouts.fundraiser')

@section('content')

<div class="rightBar">

    <div class="d-flex justify-content-end">
      {{-- <a class="btn-form float-right" aria-current="page" href="fundraiser-profile.html">Start a fundraiser</a> --}}
    </div>
      <h4 class="text-center font-weight-bold text-uppercase mt-3 mb-4">Fundraiser Academic Profile </h4>

      <div class="ermsg"></div>
      <div class="user-form">
          <div class="left">
            <div class="ermsg"></div>
            <input type="hidden" id="profile_id" value="{{$profile_data->id}}" class="form-control">

                  <div class="form-group">
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
                        <label for="college">College/University </label>
                        <select name="college" id="college" class="form-control">
                            <option value="@if(!empty($academic->college)) {{$academic->college}} @else  @endif">@if(!empty($academic->college)) {{$academic->college}} @else Please Select @endif</option>
                            <option value="University 1">University 1</option>
                            <option value="University 2">University 2</option>
                            <option value="University 3">University 3</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="degree"> Degree Enrolled in </label>
                       <select name="degree" id="degree" class="form-control">
                        <option value="@if(!empty($academic->degree)) {{$academic->degree}} @else  @endif">@if(!empty($academic->degree)) {{$academic->degree}} @else Please Select @endif</option>
                           <option value="Undergraduate">Undergraduate</option>
                           <option value="Graduate">Graduate</option>
                           <option value="Doctorate">Doctorate</option>
                       </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-item">
                        <label for="major_sub"> Study Major </label>
                        <input type="text" name="major_sub" id="major_sub" value="@if(!empty($academic->major_sub)) {{$academic->major_sub}} @else  @endif" class="form-control">
                    </div>
                    <div class="form-item">
                        <label for="current_gpa"> Current GPA </label>
                        <input type="text" name="current_gpa" id="current_gpa" value="@if(!empty($academic->current_gpa)) {{$academic->current_gpa}} @else  @endif" class="form-control">
                    </div>
                </div>
                {{-- classe schedule --}}
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
                {{-- classe schedule --}}
                
                {{-- Transcript --}}
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
                {{-- Transcript --}}
                
                  <div class="form-group">
                      <div class="form-item">
                          <button class="btn-form" id="update_data">Save</button>
                      </div>
                  </div>
             
          </div>
          
          
      </div>

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
        var url = "{{URL::to('/user/fundraiser-academic-profile')}}";
        //console.log(url);
        $("#update_data").click(function(){
             //alert('btn work');

             var form_data = new FormData();
            for(var i=0, len=storedFiles2.length; i<len; i++) {
                form_data.append('class_schedule_file[]', storedFiles2[i]);
            }
            for(var i=0, len=storedFiles3.length; i<len; i++) {
                form_data.append('transcript_file[]', storedFiles3[i]);
            }

            // var form_data = new FormData();
            form_data.append("classification", $("#classification").val());
            form_data.append("college", $("#college").val());
            form_data.append("degree", $("#degree").val());
            form_data.append("major_sub", $("#major_sub").val());
            form_data.append("current_gpa", $("#current_gpa").val());
            form_data.append("class_schedule", $("#class_schedule").val());
            form_data.append("transcript", $("#transcript").val());
            
            
            // form_data.append('_method', 'put');

            // console.log(image);
            // alert(name);
            $.ajax({
                url:url,
                type: "POST",
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
                        success("Data Insert Successfully!!");
                        $(".ermsg").html(d.message);
                        window.setTimeout(function(){location.reload()},2000)
                    }
                },
                error:function(d){
                    console.log(d);
                    $(".ermsg").html(d.message);
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
        $("#profile").addClass('active');
    });
</script>
@endsection