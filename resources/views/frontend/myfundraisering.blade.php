@extends('frontend.layouts.fundraiser')
@section('css')
{{-- <style>
.input-symbol-dollar {
    position: relative;
    display: block;
  }
  .input-symbol-dollar:after {
      color: #37424a !important;
      content: "$";
      font-size: 16px !important;
      font-weight: 400;
      position: absolute;

      display: block;
      height: 100%;
      top: 0;
      left: 10px;
      line-height: 46px; // height of input + 4px for input border
  }


</style> --}}
@endsection

@section('content')

<div class="rightBar">

    <div class="d-flex justify-content-end">
      {{-- <a class="btn-form float-right" aria-current="page" href="fundraiser-profile.html">Start a fundraiser</a> --}}
    </div>
      <h4 class="text-left font-weight-bold text-uppercase mt-3 mb-4">Start Fundraising </h4>


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

                <div class="row">
                    <div class="col-3">
                    <label for="goal">Fundraising Goal</label>
                    </div>
                    <div class="col-9">

                        <input type="number" class="form-control" name="goal" id="goal" placeholder="$">
                        {{-- <span class="input-symbol-dollar">
                            <input type="number" class="form-control" name="goal" id="goal">
                        </span> --}}
                    <b>Your total withdrawal amount will be:</b>
                    <p style="color: gray">Total donations - (iFundEducation platform + payment processing fees).<br>Please set the fundraising amount covering those cost.</p>
                    </div>
                </div><br>

                <div id="forfundraising" class="row">
                    <div class="col-3">
                        <label for=""> Fundraising for: </label>
                    </div>
                    <div class="col-9">
                        <input type="checkbox" id="tuition" name="fundraising_for[]" value="Tuition">
                        <label for="tuition">Tuition </label>&nbsp;&nbsp;
                         <input type="checkbox" id="room" name="fundraising_for[]" value="Room & Board">
                         <label for="room"> Room & Board </label>&nbsp;
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
                    <label for="story">Tell your Story </label>
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
                    <label for="image">Add Image </label>
                    </div>
                    <div class="col-9">
                    <input type="file" class="form-control" name="image" id="image">
                    </div>
                </div><br>

                <label class="forgot-pass"><input type="checkbox" required> I agree to the iFundEducation's terms and acknowledge receipt of the privacy policy.</label>
                  <div class="form-group">
                      <div class="form-item">
                          <button class="btn-form" id="saveBtn">Save</button>
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
        var url = "{{URL::to('/user/fundraisering')}}";
        //console.log(url);
        $("#saveBtn").click(function(){
            //  alert('btn work');
             for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
                    }

            var file_data = $('#image').prop('files')[0];
            var form_data = new FormData();

            var givingIDs = $("#allgivinglevel input:radio:checked").map(function(){
            // form_data.append("giving_level", $(this).val());
            return $(this).val();
            }).get();

            var fundfor = $("#forfundraising input:checkbox:checked").map(function(){
            // form_data.append("fundraising_for", $(this).val());
            return $(this).val();
            }).get();

            var others =  $("#others").val();

            if(others){
                fundfor.push(others);
                form_data.append("fundraisingfor", fundfor);
            }else{
                form_data.append("fundraisingfor", fundfor);
            }

            form_data.append("giving_level", $("#other").val());
            form_data.append("title", $("#title").val());
            form_data.append("goal", $("#goal").val());
            form_data.append("end_date", $("#end_date").val());
            form_data.append("story", $("#story").val());
            form_data.append('image', file_data);
            form_data.append("givinglvl", givingIDs);


            console.log(fundfor);


            $.ajax({
                url:url,
                type: "POST",
                contentType: false,
                processData: false,
                data:form_data,
                success: function(d){
                    if (d.status == 303) {
                        $(".ermsg").html(d.message);
                        pagetop();
                    }else if(d.status == 300){
                        pagetop();
                        success("Data Insert Successfully!!");
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
    });
</script>
<script src="//cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
 CKEDITOR.replace( 'story' );
 </script>
<script type="text/javascript">
    $(document).ready(function() {
        // $("#profile").addClass('active');
    });
</script>
@endsection
