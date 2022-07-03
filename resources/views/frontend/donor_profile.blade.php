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
    </div>
      <h4 class="text-left font-weight-bold text-uppercase mt-3 mb-4">Donor profile </h4>


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

        // header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //
        var url = "{{URL::to('/user/donor-profile')}}";
        //console.log(url);
        $("#update_data").click(function(){
             //alert('btn work');


            var form_data = new FormData();


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
