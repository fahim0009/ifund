@extends('frontend.layouts.index')
 
@section('content')

<div class="container">
    <div class="row">
      <div class="col">
        <div class="rightBar">
            <div class="d-flex justify-content-end">
            </div>
              <h4 class="text-center font-weight-bold text-uppercase mt-3 mb-4">Contact Us </h4>
              <div class="user-form">
                  <div class="left">
                    <form method="post" action="{{url('/contact')}}" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="form-group">
                            <div class="form-item">
                                <label for="name"> Name </label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-item">
                                <label for="email"> Email </label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-item">
                                <label for="phone"> Phone </label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-item">
                                <label for="subject"> Subject </label>
                                <input type="text" name="subject" id="subject" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-item">
                                <label for="message"> Message </label>
                                <textarea name="message" id="message" class="form-control" cols="30" rows="5" required></textarea>
                            </div>
                        </div>    
                        <div class="form-group">
                            <div class="form-item">
                                <button class="btn-form" id="saveBtn">Send</button>
                            </div>
                        </div>

                    </form>

                  </div>
              </div>
          </div>
      </div>
      <div class="col">
        


      </div>
    </div>
</div>

@endsection
@section('script')

@endsection