<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="footer-block">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid d-inline-block"></a>
                    <p>Fund an education
                        Fund a Future</p>

                    <div class="copyright">
                        <span> &copy;</span> 2021 ifundEducation
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4">
                        <ul class="links text-capitalize">
                            <li><a href="{{url('/')}}">terms</a></li>
                            <li><a href="{{url('/about')}}">About</a></li>
                            <li><a href="{{url('/')}}">privacy policy</a></li>
                            <li><a href="{{url('/')}}">Faqs</a></li>
                            <li><a href="{{url('/contact')}}">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <ul class="links">
                            <li> Contact  </li>
                            <li>200/2 location <br> street - 293 <br>NYC, USA</li>
                            <li>phone: 012457896</li>
                            <li>edu.bg.ghj</li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h6>Follow us</h6>
                        <div class="social">
                            <a href="" title='title goes here'>
                                <span class="iconify" data-icon="ic:baseline-facebook" data-inline="false"></span>
                            </a>
                            <a href="" title='title goes here'>
                                <span class="iconify" data-icon="ant-design:instagram-filled"
                                    data-inline="false"></span>
                            </a>
                            <a href="" title='title goes here'>
                                <span class="iconify" data-icon="entypo-social:linkedin-with-circle"
                                    data-inline="false"></span>
                            </a><br>
                            <a href="" title='title goes here'>
                                <span class="iconify" data-icon="entypo-social:twitter-with-circle"
                                    data-inline="false"></span>
                            </a>
                            <a href="" title='title goes here'>
                                <span class="iconify" data-icon="carbon:email" data-inline="false"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="https://code.iconify.design/2/2.0.1/iconify.min.js"></script>
<script src='{{ asset('assets/js/app.js') }}'> </script>

{{-- new script --}}
<script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
{{-- <script src="{{ asset('js/main.js')}}"></script> --}}
<script src="{{ asset('js/plugins/pace.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/chart.js')}}"></script>
{{-- new script --}}


<!--Select2 [ OPTIONAL ]-->
<script src="{{ asset('select2/js/select2.min.js')}}"></script>

<script>
    // page schroll top
    function pagetop() {
        window.scrollTo({
            top: 130,
            behavior: 'smooth',
        });
    }

    function success(msg){
             $.notify({
                     // title: "Update Complete : ",
                     message: msg,
                     // icon: 'fa fa-check'
                 },{
                     type: "info"
                 });

         }
</script>

<script type="text/javascript" src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-notify.min.js') }}"></script>

<script>
    $(document).ready(function(){
        //  header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //
        var url = "{{URL::to('/favourite')}}";
        //console.log(url);

        // favourite part start
        $(".favourite").click(function(e){
            e.preventDefault();
            fundraiserid = $(this).attr('fundr_id');
            // console.log(fundraiserid);
                $.ajax({
                    url:url,
                    method:'POST',
                    data:{
                        fundraiserid:fundraiserid
                    },
                    success:function(response){
                        if(response.success){
                            $(".followmsg").html(response.message);
                            location.reload();
                        }else{
                            // window.setTimeout(function(){location.reload()},2000)

                        }
                    },
                    error:function(error){
                        console.log(error)
                    }
                });
            });
    });
</script>
@yield('script')
</body>

</html>
