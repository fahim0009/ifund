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
        <div id="addThisFormContainer">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Fundraiser details</h3>
                        </div>
                        <div class="card-body">



                            <div class="row">


                                <div class="col-md-6">
                                    {!! Form::open(['url' => 'admin/fundraiser/create','id'=>'createThisForm']) !!}
                                    {!! Form::hidden('fundid','', ['id' => 'fundid']) !!}
                                    @csrf

                                    <div>
                                        <label for="fname">First Name</label>
                                        <input type="text" id="fname" name="fname" class="form-control">
                                    </div>
                                    <div>
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control">
                                    </div>
                                    <div>
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control">
                                    </div>
                                    <div>
                                        <label for="profile_pic">Profile Image</label>
                                        <input class="form-control" id="profile_pic" name="profile_pic" type="file">
                                    </div>
                                    {{-- <div>
                                        <label for="dob">Date of Birth</label>
                                        <textarea class="form-control" id="dob" name="dob" rows="4" placeholder="Enter your details"></textarea>
                                    </div> --}}
                                    <div>
                                        <label for="dob">Date of Birth</label>
                                        <input class="form-control" type="date" name="dob" id="dob" placeholder="Enter Date of Birth">
                                    </div>
                                    <div>
                                        <label for="college" class="awesome">College/University</label>
                                        <select name="college" class="form-control" id="college" required>
                                            <option value=""  >Please Select</option>
                                            <option value="1"  >test1</option>
                                            <option value="2"  >test2</option>
                                            <option value="3"  >test3</option>
                                            <option value="4"  >test4</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="degree" class="awesome">Degree Enrolled in</label>
                                        <select name="degree" class="form-control" id="degree" required>
                                            <option value=""  >Please Select</option>
                                            <option value="1"  >Undergraduate</option>
                                            <option value="2"  >Graduate</option>
                                            <option value="3"  >Doctorate</option>
                                        </select>
                                    </div>

                                    
                                    <div>
                                        <label for="major_sub">Study Major</label>
                                        <input type="text" id="major_sub" name="major_sub" class="form-control">
                                    </div>
                                    
                                    
                                    <div>
                                        <label for="class_schedule">Class Schedule</label>
                                        <input type="text" id="class_schedule" name="class_schedule" class="form-control">
                                    </div>

                                    <!-- Class Schedule File -->
                                    <div class="form-submit">
                                        <label>Class Schedule File</label>
                                        <div class="submit-section">

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="class_schedule_file" title="Upload Images" class="">
                                                    <img style="cursor:pointer" src="{{ asset('images/image-upload24x24.png') }}" alt="" title="Upload Images">
                                                    </label>
                                                    <input id="class_schedule_file" class="d-none" multiple="" accept="image/gif, image/jpeg, image/png" name="class_schedule_file[]" type="file">
                                                </div>
                                            </div>
                        <!--					image preview -->
                                            <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <div class="preview2"></div>
                                                </div>
                                            </div>
                                            </div>
                        <!--					end image preview -->
                                        </div>
                                    </div>
                                    
                                    


                                        
                                </div>
                                <div class="col-md-6">
                                    
                                    <div>
                                        <label for="lname">Last Name</label>
                                        <input type="text" id="lname" name="lname" class="form-control">
                                    </div>

                                    <div>
                                        <label for="classification" class="awesome">Classification</label>
                                        <select name="classification" class="form-control" id="classification" required>
                                            <option value=""  >Select Account Type</option>
                                            <option value="1"  >Freshman</option>
                                            <option value="2"  >Sophomore</option>
                                            <option value="3"  >Junior</option>
                                            <option value="4"  >Senior</option>
                                            <option value="5"  >Other</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="phone">Phone</label>
                                        <input type="text" id="phone" name="phone" class="form-control">
                                    </div>
                                    <div>
                                        <label for="linkedin">LinkedIn</label>
                                        <input type="text" id="linkedin" name="linkedin" class="form-control">
                                    </div>
                                    <div>
                                        <label for="facebook">Facebook</label>
                                        <input type="text" id="facebook" name="facebook" class="form-control">
                                    </div>

                                    <div>
                                        <label for="address">Address</label>
                                        <textarea class="form-control" id="address" name="address" rows="4" placeholder="Enter your address"></textarea>
                                    </div>
                                    <div>
                                        <label for="current_gpa">Current GPA</label>
                                        <input type="number" id="current_gpa" name="current_gpa" class="form-control">
                                    </div>
                                    <div>
                                        <label for="transcript">Transcript</label>
                                        <input type="text" class="form-control" id="transcript" name="transcript">
                                    </div>
                                    <!-- Transcript Image -->
                                    <div class="form-submit">
                                        <label>Transcript Image</label>
                                        <div class="submit-section">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                            <label for="transcript_file" title="Upload Images" class="">
                                                    <img style="cursor:pointer" src="{{ asset('images/image-upload24x24.png') }}" alt="" title="Upload Images">
                                            </label>
                                            <input id="transcript_file" class="d-none" multiple="" accept="image/gif, image/jpeg, image/png" name="transcript_file[]" type="file">
                                                </div>
                                            </div>
                        <!--					image preview -->
                                            <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <div class="preview3"></div>
                                                </div>
                                            </div>
                                            </div>
                        <!--					end image preview -->
                                        </div>
                                    </div>

                                    <hr>
                                    <input type="button" id="addBtn" value="Create" class="btn btn-primary">
                                    <input type="button" id="FormCloseBtn" value="Close" class="btn btn-warning">
                                    {!! Form::close() !!}
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
				
				
				
				
            </div>

        </div>

        <button id="newBtn" type="button" class="btn btn-info">Add New</button>
        <hr>

        <div id="contentContainer">


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3> Master Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">


                                    <table class="table table-bordered table-hover" id="example">
                                        <thead>
                                        <tr>
                                          <th>ID</th>
                                          <th>First Name</th>
                                          <th>Last Name</th>
                                          <th>Email</th>
                                          <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($masters as $master)
                                            <tr>
                                              <td>{{$master->id}}</td>
                                              <td>{{$master->fname}}</td>
                                              <td>{{$master->lname}}</td>
                                              <td>{{$master->email}}</td>
                                              <td>
                                                <a id="EditBtn" rid="{{$master->id}}"><i class="fa fa-edit" style="color: #2196f3;font-size:16px;"></i></a>
                                                <a id="deleteBtn" rid="{{$master->id}}"><i class="fa fa-trash-o" style="color: red;font-size:16px;"></i></a>
                                              </td>
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
        
        var storedFiles2 = [];
        var storedFiles3 = [];
        $(document).ready(function () {

            $("#addThisFormContainer").hide();
            $("#newBtn").click(function(){
                clearform();
                $("#newBtn").hide(100);
                $("#addThisFormContainer").show(300);

            });
            $("#FormCloseBtn").click(function(){
                $("#addThisFormContainer").hide(200);
                $("#newBtn").show(100);
                clearform();
            });


            //header for csrf-token is must in laravel
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //

            var url = "{{URL::to('/admin/fundraiser')}}";
            // console.log(url);
            $("#addBtn").click(function(){
               //alert("btn work");
                if($(this).val() == 'Create') {
                    
                    var file_data = $('#profile_pic').prop('files')[0];
                    var form_data = new FormData();

                    var form_data = new FormData();
                        for(var i=0, len=storedFiles2.length; i<len; i++) {
                            form_data.append('class_schedule_file[]', storedFiles2[i]);
                        }
                        for(var i=0, len=storedFiles3.length; i<len; i++) {
                            form_data.append('transcript_file[]', storedFiles3[i]);
                        }
                    
                    form_data.append("fname", $("#fname").val());
                    form_data.append("lname", $("#lname").val());
                    form_data.append("email", $("#email").val());
                    form_data.append("password", $("#password").val());
                    form_data.append("phone", $("#phone").val());
                    form_data.append("linkedin", $("#linkedin").val());
                    form_data.append("facebook", $("#facebook").val());
                    form_data.append("address", $("#address").val());

                    form_data.append("dob", $("#dob").val());
                    form_data.append("college", $("#college").val());
                    form_data.append("degree", $("#degree").val());
                    form_data.append("major_sub", $("#major_sub").val());
                    form_data.append("class_schedule", $("#class_schedule").val());
                    form_data.append("classification", $("#classification").val());
                    form_data.append("current_gpa", $("#current_gpa").val());
                    form_data.append("transcript", $("#transcript").val());
                    form_data.append("profile_pic", file_data);



                    $.ajax({
                      url: url,
                      method: "POST",
                      contentType: false,
                      processData: false,
                      data:form_data,
                      success: function (d) {
                          if (d.status == 303) {
                              $(".ermsg").html(d.message);
                          }else if(d.status == 300){
                            success(" Data Insert Successfully!!");
                                window.setTimeout(function(){location.reload()},2000)
                          }
                      },
                      error: function (d) {
                          console.log(d);
                      }
                  });
                }
                //create  end
                //Update
                if($(this).val() == 'Update'){
                // alert('update btn work');
                
                  var file_data = $('#image').prop('files')[0];
                  if(typeof file_data === 'undefined'){
                    file_data = 'null';
                  }
                  var form_data = new FormData();
                  form_data.append("softcode", $("#softcode").val());
                  form_data.append("hardcode", $("#hardcode").val());
                  form_data.append('image', file_data);
                  form_data.append("details", $("#details").val());
                  form_data.append("sort_details", $("#sort_details").val());
                  form_data.append('_method', 'put');

                    console.log(image);
                    // alert(name);
                    $.ajax({
                        url:url+'/'+$("#codeid").val(),
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
                                success("Data Update Successfully!!");
                                window.setTimeout(function(){location.reload()},2000)
                            }
                        },
                        error:function(d){
                            console.log(d);
                        }
                    });
                }
                //Update
            });
            //Edit
            $("#contentContainer").on('click','#EditBtn', function(){
                //alert("btn work");
                codeid = $(this).attr('rid');
                //console.log($codeid);
                info_url = url + '/'+codeid+'/edit';
                //console.log($info_url);
                $.get(info_url,{},function(d){
                    populateForm(d);
                    pagetop();
                });
            });
            //Edit  end

            //Delete
            $("#contentContainer").on('click','#deleteBtn', function(){
                if(!confirm('Sure?')) return;
                 masterid = $(this).attr('rid');
                 info_url = url + '/'+masterid;
                console.log(info_url);
                //alert(info_url);
                $.ajax({
                    url:info_url,
                    method: "GET",
                    type: "DELETE",
                    data:{
                    },
                    success: function(d){
                        if(d.success) {
                            alert(d.message);
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
                
                $("#softcode").val(data.softcode);
                $("#hardcode").val(data.hardcode);
                $("#details").val(data.details);
                $("#sort_details").val(data.sort_details);
                $("#codeid").val(data.id);
                $("#addBtn").val('Update');
                $("#addThisFormContainer").show(300);
                $("#newBtn").hide(100);
            }
            function clearform(){
                $('#createThisForm')[0].reset();
                $("#addBtn").val('Create');
            }


            //new code 

            // gallery images 
        /* WHEN YOU UPLOAD ONE OR MULTIPLE FILES */
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

        // transcript photo
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

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#codemaster").addClass('active');
            $("#codemaster").addClass('is-expanded');
            $("#master").addClass('active');
        });
    </script>
   
@endsection
