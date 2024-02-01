<!-- footer -->
<footer>
    <div class="container-fluid">
        
        <div class="logo">
            <a href="<?php echo e(url('/')); ?>"><img class="logo-img" src="<?php echo e(asset('media/theme/'.$themeDatas->site_main_logo)); ?>" alt="Logo"></a>
        </div>
        <p class="p-text store_name"><?php echo e($storeDatas->store_name); ?></p>
        <p class="p-text copyRight2"><?php echo e($storeDatas->store_address); ?></p>
        <p class="p-text copyRight2"><?php echo e($storeDatas->store_state); ?>, <?php echo e($storeDatas->store_postcode); ?>, <?php echo e($storeDatas->store_country); ?>, <?php echo e($storeDatas->store_city); ?></p>
        
        <div id="footer-menu-list">
            <ul class="list-unstyled f-menu-list">

                <?php if($otherDatas->home_page_status == 'enable'): ?>
                <li><a href="<?php echo e(url('/')); ?>" class="f-menu-item">Home</a></li>
                <?php endif; ?>
                
                <?php if($otherDatas->menu_page_status == 'enable'): ?>
                <li><a href="<?php echo e(url('/menu')); ?>" class="f-menu-item">Menu</a></li>
                <?php endif; ?>
                
                <?php if($otherDatas->gallery_page_status=='enable'): ?>
                <li><a href="<?php echo e(url('/gallery')); ?>" class="f-menu-item">Gallery</a></li>
                <?php endif; ?>
                
                <?php if($otherDatas->table_book_status=='enable'): ?>
                <li><a href="<?php echo e(url('/table-reservation')); ?>" class="f-menu-item">Book Table</a></li>
                <?php endif; ?>
                
                <?php if($otherDatas->contact_page_status=='enable'): ?>
                <li><a href="<?php echo e(url('/contact')); ?>" class="f-menu-item">Contact</a></li>
                <?php endif; ?>
                
                <?php if($otherDatas->terms_page_status=='enable'): ?>
                <li><a href="<?php echo e(url('/terms')); ?>" class="f-menu-item">Terms & condition</a></li>
                <?php endif; ?>
                
                <?php if($otherDatas->privacy_page_status=='enable'): ?>
                <li><a href="<?php echo e(url('/privacy')); ?>" class="f-menu-item">Privacy & policy</a></li>
                <?php endif; ?>
                
                <li><a href="<?php echo e(url('/faq')); ?>" class="f-menu-item">Faq</a></li>

            </ul>
        </div>
        
        <ul class="social-icon list-unstyled">
            <?php if($themeDatas->site_facebook_link): ?>
            <li><a target="_blank" href="<?php echo e($themeDatas->site_facebook_link); ?>" class="social-single"><i class="fa fa-facebook"></i></a></li>
            <?php endif; ?>
            <?php if($themeDatas->site_twitter_link): ?>
            <li><a target="_blank" href="<?php echo e($themeDatas->site_twitter_link); ?>" class="social-single"><i class="fa fa-twitter"></i></a></li>
            <?php endif; ?>
            <?php if($themeDatas->site_instagram_link): ?>
            <li><a target="_blank" href="<?php echo e($themeDatas->site_instagram_link); ?>" class="social-single"><i class="fa fa-instagram"></i></a></li>
            <?php endif; ?>
            <?php if($themeDatas->site_google_plus_link): ?>
            <li><a target="_blank" href="<?php echo e($themeDatas->site_google_plus_link); ?>" class="social-single"><i class="fa fa-google-plus"></i></a></li>
            <?php endif; ?>
            <?php if($themeDatas->site_linkedin_link): ?>
            <li><a target="_blank" href="<?php echo e($themeDatas->site_linkedin_link); ?>" class="social-single"><i class="fa fa-linkedin"></i></a></li>
            <?php endif; ?>
            <?php if($themeDatas->site_pinterest_link): ?>
            <li><a target="_blank" href="<?php echo e($themeDatas->site_pinterest_link); ?>" class="social-single"><i class="fa fa-pinterest"></i></a></li>
            <?php endif; ?>
            <?php if($themeDatas->site_youtube_link): ?>
            <li><a target="_blank" href="<?php echo e($themeDatas->site_youtube_link); ?>" class="social-single"><i class="fa fa-youtube"></i></a></li>
            <?php endif; ?>
        </ul>

        <p class="p-text copyRight"><?php echo e($themeDatas->site_copyright); ?></p>
    </div>
</footer>

<?php if(Request::segment(1)!='menu'): ?>
<a href="<?php echo e(url('menu')); ?>#right-section" class="mb-checkBasket">Total Basket <span class="total-amount"><?php echo e(Session::get('currency')); ?> <?php echo e(Cart::total()); ?></span></a>
<?php endif; ?>

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
    
                    <?php echo Form::open(['url' => action('CustomerController@login'), 'method' => 'POST','id' => 'user-login-form', 'class' => 'email-login','role'=>'form']); ?>

    
                      <br>
                      <div class="u-form-group">
                        <?php echo Form::email('lo_email', null , ['placeholder' => 'Email','required' => 'required']);; ?>

                        <?php if($errors->has('lo_email')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('lo_email')); ?></strong>
                            </p>
                        <?php endif; ?>
                      </div>
                      <div class="u-form-group">
                        <!--<?php echo Form::password('lo_pass_word', null , ['placeholder' => 'Password','required' => 'required']);; ?>-->
                        <input type="password" name="lo_pass_word" placeholder="Password" required="required"/>
                        <?php if($errors->has('lo_pass_word')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('lo_pass_word')); ?></strong>
                            </p>
                        <?php endif; ?>
                      </div>
                      <div class="u-form-group">
                        <?php echo e(Form::button('Log in',['type' => 'submit','id' => 'cus-log-submit','name' => 'cus-log-submit'])); ?>

                      </div>
                    <?php echo Form::close(); ?>

    
    
    
                    <?php echo Form::open(['url' => action('CustomerController@store'), 'method' => 'POST','id' => 'user-register-form', 'class' => 'email-signup','role'=>'form']); ?>

                      <br>
                      <div class="u-form-group">
                        <?php echo Form::text('c_name', null , ['placeholder' => 'Name','required' => 'required']);; ?>

                        <?php if($errors->has('c_name')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('c_name')); ?></strong>
                            </p>
                        <?php endif; ?>
                      </div>
                      <div class="u-form-group">
                        <?php echo Form::email('c_email', null , ['placeholder' => 'Email','required' => 'required']);; ?>

                        <?php if($errors->has('c_email')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('c_email')); ?></strong>
                            </p>
                        <?php endif; ?>
                      </div>
                      <div class="u-form-group">
                        <!--<?php echo Form::password('c_pass_word', null , ['required' => 'required','placeholder' => 'Password']);; ?>-->
                        <input type="password" name="c_pass_word" placeholder="Password" required="required"/>
                        <?php if($errors->has('c_pass_word')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('c_pass_word')); ?></strong>
                            </p>
                        <?php endif; ?>
                      </div>
                      <div class="u-form-group">
                        <!-- <button >Sign Up</button> -->
                        <?php echo e(Form::button('Register now',['type' => 'submit','id' => 'cus-reg-submit','name' => 'cus-reg-submit'])); ?>

                      </div>
                    <?php echo Form::close(); ?>

                    
                    <?php if(Request::segment(1)=='checkout'): ?>
                    <p class="guest_p"  data-dismiss="modal">Or Continue With Guest</p>
                    <?php endif; ?>
    
                    <i class="fa fa-times-circle close_btn_mdl"  data-dismiss="modal"></i>
                </div>
            </div>
    
        </div>
    </div>
</div>

<!--=== JS ===-->
<script type="text/javascript" src="<?php echo e(asset('frontend/js/jquery-ui.js')); ?>"></script> <!-- Jquery UI -->
<script type="text/javascript" src="<?php echo e(asset('frontend/js/owl.carousel.min.js')); ?>"></script> <!-- Carousel -->
<script src="<?php echo e(asset('common/toast/iziToast.min.js')); ?>"></script>  <!-- Toast -->
<script src="<?php echo e(asset('common/bootstrap-fileinput/fileinput.min.js')); ?>"></script>  <!-- Fileinput -->
<script src="<?php echo e(asset('common/select2/dist/js/select2.full.min.js')); ?>"></script>  <!-- Select2 -->

<script type="text/javascript" src="<?php echo e(asset('frontend/plugins/thea/dist/ResizeSensor.js')); ?>"></script>  <!-- ResizeSensor for Sticky -->
<script type="text/javascript" src="<?php echo e(asset('frontend/plugins/thea/dist/theia-sticky-sidebar.js')); ?>"></script>  <!-- Sticky JS -->
<script type="text/javascript" src="<?php echo e(asset('frontend/js/functions.js')); ?>"></script>  <!-- Custom Functions JS -->

<?php echo $__env->yieldContent('js'); ?>

<script type="text/javascript">

<?php if(Session::has('sess_alert')): ?>
    <?php
        $alertData = session::get('sess_alert');
    ?>
    iziToast.success({
        title: '<?php echo $alertData['status']; ?>',
        message: '<?php echo $alertData['message']; ?>',
        position: 'topRight',
        timeout: 3000,
        transitionIn: 'fadeInDown',
        transitionOut: 'fadeOut',
        transitionInMobile: 'fadeInUp',
        transitionOutMobile: 'fadeOutDown',
    });
<?php endif; ?>

</script>

</body>
</html>