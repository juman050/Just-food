<!-- footer -->
<footer>
    <div class="container-fluid">
        
        <div class="logo">
            <a href="{{ url('/') }}"><img class="logo-img" src="{{asset('media/theme/'.$themeDatas->site_main_logo)}}" alt="Logo"></a>
        </div>
        <p class="p-text store_name">{{ $storeDatas->store_name }}</p>
        <p class="p-text copyRight2">{{ $storeDatas->store_address }}</p>
        <p class="p-text copyRight2">{{ $storeDatas->store_state }}, {{ $storeDatas->store_postcode }}, {{ $storeDatas->store_country }}, {{ $storeDatas->store_city }}</p>
        
        <div id="footer-menu-list">
            <ul class="list-unstyled f-menu-list">

                @if($otherDatas->home_page_status == 'enable')
                <li><a href="{{url('/')}}" class="f-menu-item">Home</a></li>
                @endif
                
                @if($otherDatas->menu_page_status == 'enable')
                <li><a href="{{url('/menu')}}" class="f-menu-item">Menu</a></li>
                @endif
                
                @if($otherDatas->gallery_page_status=='enable')
                <li><a href="{{url('/gallery')}}" class="f-menu-item">Gallery</a></li>
                @endif
                
                @if($otherDatas->table_book_status=='enable')
                <li><a href="{{url('/table-reservation')}}" class="f-menu-item">Book Table</a></li>
                @endif
                
                @if($otherDatas->contact_page_status=='enable')
                <li><a href="{{url('/contact')}}" class="f-menu-item">Contact</a></li>
                @endif
                
                @if($otherDatas->terms_page_status=='enable')
                <li><a href="{{url('/terms')}}" class="f-menu-item">Terms & condition</a></li>
                @endif
                
                @if($otherDatas->privacy_page_status=='enable')
                <li><a href="{{url('/privacy')}}" class="f-menu-item">Privacy & policy</a></li>
                @endif
                
                <li><a href="{{url('/faq')}}" class="f-menu-item">Faq</a></li>

            </ul>
        </div>
        
        <ul class="social-icon list-unstyled">
            @if($themeDatas->site_facebook_link)
            <li><a target="_blank" href="{{$themeDatas->site_facebook_link}}" class="social-single"><i class="fa fa-facebook"></i></a></li>
            @endif
            @if($themeDatas->site_twitter_link)
            <li><a target="_blank" href="{{$themeDatas->site_twitter_link}}" class="social-single"><i class="fa fa-twitter"></i></a></li>
            @endif
            @if($themeDatas->site_instagram_link)
            <li><a target="_blank" href="{{$themeDatas->site_instagram_link}}" class="social-single"><i class="fa fa-instagram"></i></a></li>
            @endif
            @if($themeDatas->site_google_plus_link)
            <li><a target="_blank" href="{{$themeDatas->site_google_plus_link}}" class="social-single"><i class="fa fa-google-plus"></i></a></li>
            @endif
            @if($themeDatas->site_linkedin_link)
            <li><a target="_blank" href="{{$themeDatas->site_linkedin_link}}" class="social-single"><i class="fa fa-linkedin"></i></a></li>
            @endif
            @if($themeDatas->site_pinterest_link)
            <li><a target="_blank" href="{{$themeDatas->site_pinterest_link}}" class="social-single"><i class="fa fa-pinterest"></i></a></li>
            @endif
            @if($themeDatas->site_youtube_link)
            <li><a target="_blank" href="{{$themeDatas->site_youtube_link}}" class="social-single"><i class="fa fa-youtube"></i></a></li>
            @endif
        </ul>

        <p class="p-text copyRight">{{$themeDatas->site_copyright}}</p>
    </div>
</footer>

@if(Request::segment(1)!='menu')
<a href="{{url('menu')}}#right-section" class="mb-checkBasket">Total Basket <span class="total-amount">{{Session::get('currency')}} {{Cart::total()}}</span></a>
@endif

</div>

<!-- Modal -->
<div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-body">
                <div class="login-box">
                    <div class="lb-header">
                      <a href="javascript:void(0)" class="active" id="login-box-link">Login</a>
                      <a href="javascript:void(0)" id="signup-box-link">Sign Up</a>
                    </div>
    
                    {!! Form::open(['url' => action('CustomerController@login'), 'method' => 'POST','id' => 'user-login-form', 'class' => 'email-login','role'=>'form']) !!}
    
                      <br>
                      <div class="u-form-group">
                        {!! Form::email('lo_email', null , ['placeholder' => 'Email','required' => 'required']); !!}
                        @if ($errors->has('lo_email'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('lo_email') }}</strong>
                            </p>
                        @endif
                      </div>
                      <div class="u-form-group">
                        <!--{!! Form::password('lo_pass_word', null , ['placeholder' => 'Password','required' => 'required']); !!}-->
                        <input type="password" name="lo_pass_word" placeholder="Password" required="required"/>
                        @if ($errors->has('lo_pass_word'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('lo_pass_word') }}</strong>
                            </p>
                        @endif
                      </div>
                      <div class="u-form-group">
                        {{ Form::button('Log in',['type' => 'submit','id' => 'cus-log-submit','name' => 'cus-log-submit']) }}
                      </div>
                    {!! Form::close() !!}
    
    
    
                    {!! Form::open(['url' => action('CustomerController@store'), 'method' => 'POST','id' => 'user-register-form', 'class' => 'email-signup','role'=>'form']) !!}
                      <br>
                      <div class="u-form-group">
                        {!! Form::text('c_name', null , ['placeholder' => 'Name','required' => 'required']); !!}
                        @if ($errors->has('c_name'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('c_name') }}</strong>
                            </p>
                        @endif
                      </div>
                      <div class="u-form-group">
                        {!! Form::email('c_email', null , ['placeholder' => 'Email','required' => 'required']); !!}
                        @if ($errors->has('c_email'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('c_email') }}</strong>
                            </p>
                        @endif
                      </div>
                      <div class="u-form-group">
                        <!--{!! Form::password('c_pass_word', null , ['required' => 'required','placeholder' => 'Password']); !!}-->
                        <input type="password" name="c_pass_word" placeholder="Password" required="required"/>
                        @if ($errors->has('c_pass_word'))
                            <p class="help-block error_login">
                                <strong>{{ $errors->first('c_pass_word') }}</strong>
                            </p>
                        @endif
                      </div>
                      <div class="u-form-group">
                        <!-- <button >Sign Up</button> -->
                        {{ Form::button('Register now',['type' => 'submit','id' => 'cus-reg-submit','name' => 'cus-reg-submit']) }}
                      </div>
                    {!! Form::close() !!}
                    
                    @if(Request::segment(1)=='checkout')
                    <p class="guest_p"  data-dismiss="modal">Or Continue With Guest</p>
                    @endif
    
                    <i class="fa fa-times-circle close_btn_mdl"  data-dismiss="modal"></i>
                </div>
            </div>
    
        </div>
    </div>
</div>

<!--=== JS ===-->
<script type="text/javascript" src="{{ asset('frontend/js/jquery-ui.js') }}"></script> <!-- Jquery UI -->
<script type="text/javascript" src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script> <!-- Carousel -->
<script src="{{ asset('common/toast/iziToast.min.js') }}"></script>  <!-- Toast -->
<script src="{{ asset('common/bootstrap-fileinput/fileinput.min.js') }}"></script>  <!-- Fileinput -->
<script src="{{ asset('common/select2/dist/js/select2.full.min.js') }}"></script>  <!-- Select2 -->

<script type="text/javascript" src="{{ asset('frontend/plugins/thea/dist/ResizeSensor.js') }}"></script>  <!-- ResizeSensor for Sticky -->
<script type="text/javascript" src="{{ asset('frontend/plugins/thea/dist/theia-sticky-sidebar.js') }}"></script>  <!-- Sticky JS -->
<script type="text/javascript" src="{{ asset('frontend/js/functions.js') }}"></script>  <!-- Custom Functions JS -->

@yield('js')

<script type="text/javascript">

@if (Session::has('sess_alert'))
    @php
        $alertData = session::get('sess_alert');
    @endphp
    iziToast.success({
        title: '{!!$alertData['status']!!}',
        message: '{!!$alertData['message']!!}',
        position: 'topRight',
        timeout: 3000,
        transitionIn: 'fadeInDown',
        transitionOut: 'fadeOut',
        transitionInMobile: 'fadeInUp',
        transitionOutMobile: 'fadeOutDown',
    });
@endif

</script>

</body>
</html>