@extends('frontend.layouts.index')

@section('content')
<style>
    <style type="text/css">
        .panel-title {
        display: inline;
        font-weight: bold;
        }
        .display-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }

</style>

<section class="funded-profile">
    <div class="container">
        <div class="row col-lg-10 mx-auto">

            <div class="col-lg-8 my-4">
                <div class="donation">
                    <a href="{{ url()->previous() }}"class='hrt-styled-button py-2 text-decoradion-none'> Return to fundraiser</a>
                    <hr class="mt-4">
                    <div class="card-with-text">
                        <div class='item'>
                            <img src="@if (!empty($fundraisers->photo)) {{asset('fundraiser/'.$fundraisers->image)}} @else https://images.gofundme.com/7F0JZLd2_gnUuepCmIZrKcWffk8=/640x480/https://d2g8igdw686xgo.cloudfront.net/57792243_1623692156971137_r.jpeg @endif" alt="" style="width: 80%">
                        </div>
                        <div class='item'>
                            <small>
                                You're supporting <b>Tribute To {{$fundraisers->fname}} {{$fundraisers->lname}}</b> <br>
                                Your donation will benefit {{$fundraisers->fname}} {{$fundraisers->lname}}
                            </small>
                        </div>
                    </div>
                    <h6 class="mt-4">Enter your donation</h6>
                    <div class="donateAmmount">
                        <div class='first'><span>$</span>
                            <span>USD</span>
                        </div>
                        <input type="number" autocomplete="off" id="amount" inputmode="numeric" maxlength="5"
                            name="donationAmount" value="" oninput="myFunction()">
                        <div class='last'>
                            <div>.00</div>
                        </div>
                    </div>
                    <hr>
                    <div class="py-4">
                        <h6>Tip GoFundMe Services</h6>
                        <small class="text-muted">GoFundMe has a 0% platform fee for organizers. GoFundMe will
                            continue offering its
                            services thanks to donors who will leave an optional amount here:</small>
                    </div>
                    <div id="demo"></div>
                    <div class='d-flex'>
                        <span> 0% &nbsp; </span> <input type="range" min="1" max="25" value="10" class="rangeslider"
                            id="myRange"> &nbsp; <span> 25%</span>
                    </div>
                    <button onclick="donate();" class='btn btn-theme' id='continue'>Continue</button> <br>
                    <div class="donatearea p-3 border rounded my-4" id="donation">
                            <div class="d-flex align-items-center flex-wrap justify-content-between">
                                <div class='paymentLabel'>Use credit or debit card</div>
                                <div class="payment">
                                    <span class="iconify" data-icon="bx:bxl-visa" data-inline="false"></span>
                                    <span class="iconify" data-icon="fa:cc-discover" data-inline="false"></span>
                                    <span class="iconify" data-icon="bx:bxl-mastercard" data-inline="false"></span>
                                    <span class="iconify" data-icon="cib:american-express" data-inline="false"></span>
                                </div>
                            </div>

                            @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                            <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                @csrf

                                <div class="form-group">
                                    <div class="form-item">
                                        <label for=""> Email </label>
                                        <input type="email" name="email" class="form-control" placeholder="@if(Auth::user()) {{ Auth::user()->email}} @else  @endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-item">
                                        <label for="">First name </label>
                                        <input type="text" name="fname" class="form-control" placeholder=" @if(Auth::user()) {{ Auth::user()->fname}} @else  @endif">
                                    </div>
                                    <div class="form-item">
                                        <label for=""> Last name </label>
                                        <input type="text" name="lname" class="form-control" placeholder=" @if(Auth::user()) {{ Auth::user()->lname}} @else  @endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-item">
                                        <input type="checkbox" id="bill" class="form-control">
                                        <label for="bill">Use  billing name </label>
                                    </div>
                                </div>
                                <div class="form-group col-gap-adjust" >
                                    <div class="col-sm-9 card required">
                                        <input type="text" name="cnumber" placeholder="Card number" autocomplete='off' class='form-control card-number' size='20'>
                                    </div>

                                    <div class="col-sm-3 cvc required">
                                        <input type="text" name="cvv" placeholder="CVV" size='4' class="form-control card-cvc" autocomplete='off'>
                                    </div>
                                </div>
                                <div class="form-group col-gap-adjust" >
                                    <div class="form-item expiration required" >
                                        <input type="text" name="mm" placeholder="MM" class="form-control card-expiry-month" size='2'>
                                    </div>

                                    <div class="form-item expiration required">
                                        <input type="text" name="yy" placeholder="YYYY" class="form-control card-expiry-year" size='4'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-item">
                                        <label for=""> Name on card </label>
                                        <input type="text" name="cname" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-item">
                                        <label for="">Country</label>
                                        <select name="country" id="" class="form-control">
                                            <option value="">country 1</option>
                                            <option value="">country 1</option>
                                            <option value="">country 1</option>
                                        </select>
                                    </div>
                                    <div class="form-item">
                                        <label for=""> Postal code</label>
                                        <input type="number" name="postcode" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-item">
                                        <label class=""><b>Donation Details </b></label> <br>
                                        <input type="checkbox" class="font-weight-bold" class="form-control">
                                        <small>  Don't display my name publicly on the campaign.</small>  <br>
                                        <input type="checkbox" class="font-weight-bold" class="form-control">
                                        <small>  Get occasional marketing updates from GoFundMe. You may unsubscribe at any time.</small>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-md-12 error form-group hide'>
                                        <div class='alert-danger alert'>Please correct the errors and try
                                            again.</div>
                                    </div>
                                </div>

                                <input type="text" name="tdonation" id="tdonation" required>
                                <input type="text" name="fundcommission" id="fundcommission" required>
                                <input type="text" name="fid" required value="{{$fundraisers->id}}">
                                <input type="text" name="typeof" value="fundraiser">
                                <hr>
                                <input type="text" name="userid" required value="{{$fundraisers->user_id}}">
                                <input type="text" name="projectid" required value="{{$fundraisers->fid}}">
                                
                                <hr>
                                <button class="btn btn-theme" type="submit">Donate Now</button>
                             </form>
                    </div>
                    <small class="text-muted mt-4">This site is protected by reCAPTCHA and the Google privacy policy and
                        Terms of
                        Service apply.
                    </small>
                    <hr>
                    <section class="m-value-prop">
                        <div class="m-value-prop-content">
                            <h6>GoFundMe Guarantee</h6>
                            <small class="text-muted">In the rare case something isn't right, we will
                                work with you to determine if misuse has occurred.
                                <a href="" target="_blank">Learn more.</a>
                            </small>
                        </div>
                    </section>
                </div>
            </div>
            <div class="col-lg-4 my-4">
                <div class="p-checkout-summary ">
                    <h4 class="heading-3 mb-3">Your donation</h4>
                    <p class='items'>
                        <span>Your donation </span>
                        <span id="mydonation">$0</span>
                    </p>
                    <p class='items'>
                        <span>Your tip </span>
                        <span id="commission"> $0 </span>
                    </p>
                    <hr>
                    <p class='items'>
                        <span><b>Total due today
                            </b>
                        </span>
                        <span id="totaldonation"> <b>$0 </b></span>
                    </p>
                    <div class="hide-for-large mb0 a-rule a-rule--horizontal"></div>
                </div>
            </div>


        </div>

    </div>
</section>


@endsection
@section('script')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
$(function() {

    var $form         = $(".require-validation");

    $('form.require-validation').bind('submit', function(e) {
        var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });

        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }

  });

  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];

            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>

<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
  num = Number(this.value);
  var damount = document.getElementById("amount").value;
  var damount2 = Number(damount);
  var prsntamt = Number((damount2*num)/100);

  var total = prsntamt+damount2;

  document.getElementById("commission").innerHTML = "$ " + prsntamt;
  document.getElementById("totaldonation").innerHTML = "$ " + total;
  $("#tdonation").val(total);
  $("#fundcommission").val(prsntamt);
}


function myFunction() {
    var damount = document.getElementById("amount").value;
    document.getElementById("mydonation").innerHTML = "$ " + damount;

  var num = $("#myRange").val();
  var damount2 = Number(damount);
  var prsntamt = Number((damount2*num)/100);

  var total = prsntamt+damount2;

  document.getElementById("commission").innerHTML = "$ " + prsntamt;
  document.getElementById("totaldonation").innerHTML = "$ " + total;
  $("#tdonation").val(total);
  $("#fundcommission").val(prsntamt);

    }


</script>

@endsection
