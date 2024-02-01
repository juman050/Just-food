
<?php $__env->startSection('mainContent'); ?>

<!-- Contact Section -->
<section id="contact-section" class="p_174_100">
    <div class="container">
        <div class="col-md-6">
            <div id="contact">
                <h3>Contact info</h3>
                <h4>Here is our contact information</h4>
                <div class="white-space10"></div>
                <p><i class="fa fa-phone"></i> <?php echo e($storeDatas->store_owner_number); ?></p>
                <p><i class="fa fa-envelope"></i> <?php echo e($storeDatas->store_owner_email); ?></p>

                <div class="white-space30"></div>

                <h3>Store info</h3>
                <h4>Details of store information</h4>
                <div class="white-space10"></div>
                <p><i class="fa fa-home"></i> <?php echo e($storeDatas->store_name); ?></p>
                <p><i class="fa fa-envelope"></i> <?php echo e($storeDatas->store_support_number); ?></p>
                <p><i class="fa fa-phone"></i> <?php echo e($storeDatas->store_support_email); ?></p>
                <p><i class="fa fa-map-marker"></i> <?php echo e($storeDatas->store_address); ?></p>
                <p class="cus_pl15"><?php echo e($storeDatas->store_state); ?>, <?php echo e($storeDatas->store_postcode); ?>, <?php echo e($storeDatas->store_country); ?>, <?php echo e($storeDatas->store_city); ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <?php echo Form::open(['url' => action('PagesController@submitContact'), 'method' => 'POST', 'id' => 'contact', 'class' => 'contactForm', 'role'=>'form']); ?>


            <h3>Get in touch</h3>
            <h4>Contact us and get reply with in 24 hours !</h4>

            <fieldset>
                <?php echo Form::text('name', null, ['placeholder' => 'Your name','tabindex' => '1','required' => 'required']);; ?>

                <?php if($errors->has('name')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('name')); ?></strong>
                </p>
                <?php endif; ?>
            </fieldset>

            <fieldset>
                <?php echo Form::email('email', null, ['placeholder' => 'Email address','tabindex' => '2','required' => 'required']);; ?>

                <?php if($errors->has('email')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                </p>
                <?php endif; ?>
            </fieldset>

            <fieldset>
                <?php echo Form::text('subject', null, ['placeholder' => 'Subject','tabindex' => '3','required' => 'required']);; ?>

                <?php if($errors->has('subject')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('subject')); ?></strong>
                </p>
                <?php endif; ?>
            </fieldset>

            <fieldset>
                <?php echo Form::textarea('message', null, ['placeholder' => 'Type your Message Here....','tabindex' => '4','required' => 'required']);; ?>

                <?php if($errors->has('message')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('message')); ?></strong>
                </p>
                <?php endif; ?>
            </fieldset>

            <fieldset>
                <?php echo e(Form::button('Submit',['type' => 'submit','id' => 'contact-submit','name' => 'submit'])); ?>

            </fieldset>

            <?php echo Form::close(); ?>

        </div>
        <div class="col-md-12">
            <iframe class="cus_iframe" src="<?php echo e($storeDatas->store_map); ?>"></iframe>
        </div>

    </div><!-- End container --> 
</section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script type="text/javascript">
    jQuery(function($){
        $( ".contactForm" ).validate({

            rules: {
                name:  {
                    required: true,
                    maxlength: 100,
                },
                email:  {
                    required: true,
                    email: true,
                },
                subject: {
                    required: true,
                    maxlength: 255,
                },
                message: {
                    required: true,
                    maxlength: 1000,
                }
            },
            messages: {
                name: {
                    required: "Please ener name.",
                    maxlength: "Must contain in 100 letters",
                },
                email: {
                    required: "Please enter email.",
                    email: "Please enter valid email address",
                },
                subject: {
                    required: "Please enter subject.",
                    maxlength: "Must contain in 255 letters",
                },
                message: {
                    required: "Please enter messages.",
                    maxlength: "Must contain in 1000 letters",
                },
            },
            submitHandler: function(form) {

                var data =  new FormData($('.contactForm')[0]);
                $.ajax({
                    type: "POST",
                    url: $('.contactForm').attr("action"),
                    dataType: "json",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        $('.contactForm')[0].reset();
                        toast(response);
                    }

                });
            }

        });
    })
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.imageTheme.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>