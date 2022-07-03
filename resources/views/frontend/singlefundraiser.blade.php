@extends('frontend.layouts.index')
 
@section('content')
 <!-- header section -->


 <section class="funded-profile">
    <div class="container">
        <div class="col-lg-10 mx-auto my-4">



            <div class="box">
                <div class="photo">
                        <img src="@if (!empty($fundraisers->image)) {{asset('fundraiser/'.$fundraisers->image)}} @else https://freepngdownload.com/image/thumb/business-man-png-free-image-download-27.png @endif" class="profile">

                        {{-- <img src="@if (!empty($fundraisers->photo)) {{asset('images/profile_pic/'.$fundraisers->photo)}} @else https://learnyzen.com/wp-content/uploads/2017/08/test1-481x385.png @endif" alt=""> --}}
                    
                </div>
                <div class="info">
                     
                    <h5 class="uname">{{$fundraisers->title}}</h5>
                    <h6 class="user-with-versity">
                        <span>{{$fundraisers->fname}} {{$fundraisers->lname}}</span> | <span>university name</span>
                    </h6>
                    <div class="tag">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--cil" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512" data-icon="cil:tag" data-inline="false"><path fill="currentColor" d="M485.887 263.261L248 25.373A31.791 31.791 0 0 0 225.373 16H64a48.055 48.055 0 0 0-48 48v161.078A32.115 32.115 0 0 0 26.091 248.4l253.061 237.725a23.815 23.815 0 0 0 16.41 6.51q.447 0 .9-.017a23.828 23.828 0 0 0 16.79-7.734l173.329-188.405a23.941 23.941 0 0 0-.694-33.218zM295.171 457.269L48 225.078V64a16.019 16.019 0 0 1 16-16h161.373l232.461 232.462z"></path><path fill="currentColor" d="M148 96a52 52 0 1 0 52 52a52.059 52.059 0 0 0-52-52zm0 72a20 20 0 1 1 20-20a20.023 20.023 0 0 1-20 20z"></path></svg> @foreach (App\Models\RaisingFor::where('fundraiser_id', '=', $fundraisers->fid)->get() as $raisingdata)
                        {{$raisingdata->name}},
                        @endforeach
                    </div>
                    <p class="desc">
                        <span data-toggle="collapse" data-parent="#accordion">
                            @php
                            $string = strip_tags($fundraisers->story);
                            if (strlen($string) > 200) {
                                // truncate string
                                $stringCut = substr($string, 0, 200);
                                $endPoint = strrpos($stringCut, ' ');
                                //if the string doesn't contain any space then it will cut without word basis.
                                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                $string .= "....";
                            }
                            echo $string;
                            @endphp
                          </span>
                          {{-- <a href='{{route('single-fundraiser', $fundraisers->fid)}}'>Read More</a> --}}
                        {{-- {!!$fundraisers->story!!} --}}
                    </p>


                    @php
                        $fundcollect = App\Models\Donation::where('project_id', '=', $fundraisers->fid)->sum('amount');
                        $d = ($fundcollect/$fundraisers->goal)*100;
                    @endphp

                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ number_format((float)$d, 2, '.', '')}}%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{ number_format((float)$d, 2, '.', '')}}%</div>
                        </div>


                    <div class="fund-details">
                        <div class="items">
                            <h4>${{$fundcollect}}</h4>
                            <h5>funded</h5>
                        </div>
                        <div class="items">
                            <h4>${{$fundraisers->goal}}</h4>
                            <h5>Target</h5>
                        </div>
                        <div class="items">
                            <h4>{{ Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($fundraisers->end_date))}}</h4>
                            <h5>Days to go </h5>
                        </div>
                        <div class="items">
                            <h4>123</h4>
                            <h5>Donors </h5>
                        </div>
                    </div>
                    <div class="donate-social">
                        <div class="item">
                            <div class="followmsg"></div>
                            
                            <h2>
                            <a href="{{route('donation', encrypt($fundraisers->fid))}}" class="btn-theme ms-0 mt-3 text-uppercase">Donate!</a></h2>

                            @if (Auth::user())
                                @if ((!empty($disable_follow->id)))
                                
                                <a href="" class="btn-theme ms-0 mt-3 text-uppercase" id="unfollowBtn">Unfollow</a>
                                @else
                                <a href="" class="btn-theme ms-0 mt-3 text-uppercase" id="followBtn">Follow</a>
                                @endif
                            @else
                                
                            @endif


                            


                            <input type="hidden" name="fundraiserid" id="fundraiserid" value="{{$fundraisers->fid}}">
                            {{-- <li @if (!empty($disable_save->id)) class="disabled" @else class="dis" @endif><a @if (!empty(Auth::user()->id)) href="JavaScript:Void(0);" class="btn btn-likes saveBtn" @else href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#login" class="btn btn-likes" @endif data-toggle="tooltip" data-original-title="Save"><i class="fas fa-heart"></i>Save</a></li> --}}

                        </div>
                        <div class="item">
                            <div class="social">
                                <a href="{{$fundraisers->facebook}}" title="title goes here">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--ic" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" data-icon="ic:baseline-facebook" data-inline="false"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z" fill="currentColor"></path></svg>
                                </a>
                                <a href="{{$fundraisers->linkedin}}" title="title goes here">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--entypo-social" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20" data-icon="entypo-social:linkedin-with-circle" data-inline="false"><path d="M10 .4C4.698.4.4 4.698.4 10s4.298 9.6 9.6 9.6s9.6-4.298 9.6-9.6S15.302.4 10 .4zM7.65 13.979H5.706V7.723H7.65v6.256zm-.984-7.024c-.614 0-1.011-.435-1.011-.973c0-.549.409-.971 1.036-.971s1.011.422 1.023.971c0 .538-.396.973-1.048.973zm8.084 7.024h-1.944v-3.467c0-.807-.282-1.355-.985-1.355c-.537 0-.856.371-.997.728c-.052.127-.065.307-.065.486v3.607H8.814v-4.26c0-.781-.025-1.434-.051-1.996h1.689l.089.869h.039c.256-.408.883-1.01 1.932-1.01c1.279 0 2.238.857 2.238 2.699v3.699z" fill="currentColor"></path></svg>
                                </a>
                                <a href="{{$fundraisers->twitter}}" title="title goes here">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--entypo-social" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20" data-icon="entypo-social:twitter-with-circle" data-inline="false"><path d="M10 .4C4.698.4.4 4.698.4 10s4.298 9.6 9.6 9.6s9.6-4.298 9.6-9.6S15.302.4 10 .4zm3.905 7.864c.004.082.005.164.005.244c0 2.5-1.901 5.381-5.379 5.381a5.335 5.335 0 0 1-2.898-.85c.147.018.298.025.451.025c.886 0 1.701-.301 2.348-.809a1.895 1.895 0 0 1-1.766-1.312a1.9 1.9 0 0 0 .853-.033a1.892 1.892 0 0 1-1.517-1.854v-.023c.255.141.547.227.857.237a1.89 1.89 0 0 1-.585-2.526a5.376 5.376 0 0 0 3.897 1.977a1.891 1.891 0 0 1 3.222-1.725a3.797 3.797 0 0 0 1.2-.459a1.9 1.9 0 0 1-.831 1.047a3.799 3.799 0 0 0 1.086-.299a3.834 3.834 0 0 1-.943.979z" fill="currentColor"></path></svg>
                                </a>
                                <a href="{{$fundraisers->google}}" title="title goes here">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--carbon" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32" data-icon="carbon:email" data-inline="false"><path d="M28 6H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2zm-2.2 2L16 14.78L6.2 8zM4 24V8.91l11.43 7.91a1 1 0 0 0 1.14 0L28 8.91V24z" fill="currentColor"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row px-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#story" type="button" role="tab" aria-controls="home" aria-selected="true"><strong>Story</strong>  </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#Update" type="button" role="tab" aria-controls="profile" aria-selected="false"><strong>Update</strong> </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#Comment" type="button" role="tab" aria-controls="contact" aria-selected="false"><strong>Comment</strong></button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#donor" type="button" role="tab" aria-controls="contact" aria-selected="false"><strong>Donor</strong></button>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="story" role="tabpanel" aria-labelledby="home-tab"><br>{!!$fundraisers->story!!}</div>
                    <div class="tab-pane fade" id="Update" role="tabpanel" aria-labelledby="profile-tab"><br>
                        2
                    </div>


                    <div class="tab-pane fade" id="Comment" role="tabpanel" aria-labelledby="contact-tab"><br>
                        <h3>All comment</h3>
                        {{-- comment show --}}
                        @foreach ($comments as $cmnt)
                            <div class="box">
                                <div class="info">
                                    <h6 class="uname">{{$cmnt->lname}}</h6>
                                    <p class="desc">{{$cmnt->comment}}</p>
                                </div>
                            </div>
                        @endforeach
                        <p style="text-align: center">{{ $comments->links() }}</p>
                        
                        {{-- comment show end --}}
                        
                        <div class="user-form">
                            <div class="left">
                  
                              <div class="ermsg"></div>
                                    @if (!empty(Auth::user()->id))
                                        
                              <h3>Make a comment</h3>
                                    <div class="form-group">
                                        <div class="form-item">
                                            <label for="comment"> Comment </label>
                                            <textarea name="comment" id="comment" cols="30" rows="5"  class="form-control"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="form-item">
                                            @if (!empty(Auth::user()->id))
                                                <button class="btn-form" id="saveBtn">Save</button>
                                            @else
                                                <button class="btn-form"><a href="{{route('login')}}" style="color: white; text-decoration:none">Go to Login</a></button>
                                            @endif
                                        </div>
                                    </div>

                                    @else
                                        {{-- <p style="color: #ff4343">To make a comment you should log in first.</p> --}}

                                    @endif
                  
                               
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="donor" role="tabpanel" aria-labelledby="donor-tab"><br> 4</div>
                  </div>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
</section>

    
@endsection
@section('script')
<script>
    $(document).ready(function(){
        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //
        var url = "{{URL::to('/comment')}}";
        //console.log(url);
        $("#saveBtn").click(function(){
            //   alert('btn work');
             var form_data = new FormData();
                  
            form_data.append("title", $("#title").val());
            form_data.append("fundraiserid", $("#fundraiserid").val());
            form_data.append("comment", $("#comment").val());
            

            // console.log(fundraising_for);
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
                        success("Message Send Successfully!!");
                        // $(".ermsg").html(d.message);
                        window.setTimeout(function(){location.reload()},2000)
                    }
                },
                error:function(d){
                    console.log(d);
                    $(".ermsg").html(d.message);
                }
            });
        });


        // Follow part start
        $("#followBtn").click(function(e){
            e.preventDefault();
            // alert('follow btn work');
            var  fundraiserid= $("#fundraiserid").val();
            //alert(fundraiserid);
            var followurl = "{{URL::to('/follow')}}";
            //console.log(url);
                $.ajax({
                    url:followurl,
                    method:'POST',
                    data:{
                        fundraiserid:fundraiserid
                    },
                    success:function(response){
                        if(response.success){
                            //alert(response.message) //Message come from controller
                            $(".followmsg").html(response.message);
                            location.reload();
                        }else{
                            //alert("Error")
                            // $(".followmsg").html(response.message);
                            // success("Following...");
                            window.setTimeout(function(){location.reload()},2000)
                            // $(".dis").addClass("disabled", true);
                            // return true;

                        }
                    },
                    error:function(error){
                        console.log(error)
                    }
                });
            });


         //Delete
         var unfollowurl = "{{URL::to('/follow')}}";
         $("#unfollowBtn").click(function(e){
            e.preventDefault();
            // alert('unfollow btn work');
                // if(!confirm('Sure?')) return;
                // codeid = $(this).attr('rid');
                fundid= $("#fundraiserid").val();
                console.log(fundid);
                info_url = unfollowurl + '/'+fundid;
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
                            // success("Unfollow...");
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
@endsection