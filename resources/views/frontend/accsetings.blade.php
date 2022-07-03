@extends('frontend.layouts.fundraiser')

@section('content')

<div class="rightBar">

    <div class="d-flex justify-content-end">
      {{-- <a class="btn-form float-right" aria-current="page" href="fundraiser-profile.html">Start a fundraiser</a> --}}
    </div>
      <h4 class="text-center font-weight-bold text-uppercase mt-3 mb-4">fundraiser profile </h4>


      <div class="user-form">
          <div class="left">

            <div class="ermsg"></div>

                  
                <div class="form-group">
                    <div class="form-item">
                        <label for="old_password">Current Password </label>
                        <input type="password" name="old_password" id="old_password" class="form-control">
                        <input type="hidden" name="profileid" id="profileid" value="{{Auth::user()->id}}">
                    </div>
                </div>
                
                
                  <div class="form-group">
                      <div class="form-item">
                          <label for="new_password"> Password </label>
                          <input type="password" name="new_password" id="new_password" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="form-item">
                        <label for="confirmpassword">Confirm Password </label>
                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control">
                    </div>
                </div>
                 
                  
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
        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //
        var url = "{{URL::to('/user/account-setting')}}";
        //console.log(url);
        $("#update_data").click(function(){
            //  alert('btn work');
            var password= $("#new_password").val();
            var confirmpassword= $("#confirmpassword").val();
            var opassword= $("#old_password").val();
            var profileid= $("#profileid").val();
  
            // console.log(name +','+ email +','+ mobile+','+ address+','+ city+','+ postal_code+','+ profileid);
  
            $.ajax({
                    url:url,
                    method: "POST",
                    data:{
                        password:password,confirmpassword:confirmpassword,opassword:opassword
                    },
                    success: function(d){
                        if (d.status == 303) {
                            $(".ermsg").html(d.message);
                        }else if(d.status == 300){
                            $(".ermsg").html(d.message);
                                //   success("Data Updated Successfully!!");
                            window.setTimeout(function(){location.reload()},2000)
                        }
                    },
                    error:function(d){
                        console.log(d);
                    }
                });
        });
  

  
    });
  </script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#profile").addClass('active');
    });
</script>
@endsection