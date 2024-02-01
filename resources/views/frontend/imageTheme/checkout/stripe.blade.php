@extends('frontend.imageTheme.layout.master')

@section('css')
<style type="text/css">
    .error{width: 100%;}
</style>
@endsection

@section('mainContent')

<section id="gallery" class="p_174_100">
    <div class="container">

        <div class="col-md-6 col-xs-12 col-md-offset-3">

            <div id="cart-checkout" class="cus_str">

                <h3 class="text-center">Payment through stripe</h3>

                <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ config('app.STRIPE_KEY') }}" id="contact">

                    {{ csrf_field() }}

                    <input hidden="hidden" type="hidden" name="amount" value="{{$total}}">
                    <input hidden="hidden" type="hidden" name="order_id" value="{{$insertedOrderId}}">

                    <div class="form-group col-sm-12">
                        <label class="customLabel">Card name</label>
                        <input type="text" class="card_name" name="card_name" size='4'>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group col-sm-12">
                        <label class="customLabel">Card number</label>
                        <input type="text" autocomplete='off' class='card_no card-number' size='20' name="card_no">
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group col-sm-4">
                        <label class="customLabel">CVC</label>
                        <input type="text" placeholder='ex. 311' size='3' class="card_cvc card-cvc" name="card_cvc">
                    </div>

                    <div class="form-group col-sm-4">
                        <label class="customLabel">Expiration month</label>
                        <input type="text" placeholder='MM' size='2' class="card_month card-expiry-month" name="card_month" class="card_month">
                    </div>

                    <div class="form-group col-sm-4">
                        <label class="customLabel">Expiration year</label>
                        <input type="text" placeholder='YYYY' size='4' class="card_year card-expiry-year" name="card_year">
                    </div>
                    <div class="clearfix"></div>

                    <div class="clearfix"></div>
                    <div class="form-group col-sm-12">
                        {{ Form::button('Pay now '.\Session::get('currency').' '.$total,['type' => 'submit','id' => 'table-submit','name' => 'Pay now','class' => 'or_btn']) }}

                        <button class="or_btn2 cus_dn" disabled type="submit" id="table-submit">
                            <span class="spinner-grow spinner-grow-sm"></span>
                            Loading..
                        </button>

                    </div>


                </form>

            </div>

        </div>

    </div>
</section>

@endsection


@section('js')

<script type="text/javascript">

    $('.card-stripe').click(function(e){
        $('#cardModal').modal('show');
    });

    $( "#contact" ).validate({

        rules: {
            card_name:  {
                required: true,
            },
            card_no:  {
                required: true,
            },
            card_cvc:  {
                minlength: 3,
                maxlength: 3,
                required: true,
                digits: true,
            },
            card_month:  {
                minlength: 2,
                maxlength: 2,
                required: true,
                digits: true,
                min: 0,
                max: 12,
            },
            card_year:  {
                minlength: 4,
                maxlength: 4,
                required: true,
                digits: true,
                min: 2020,
            }
            },
        messages: {
            card_name: {
                required: "Please enter name.",
            },
            card_no: {
                required: "Please enter card number.",
                digits: "Enter digits",
            },
            card_cvc: {
                required: "Required !",
                minlength: "Min 3 digits",
                maxlength: "Max 3 digits",
                digits: "Enter digits",
            },
            card_month: {
                required: "Required !",
                minlength: "Min 2 digits",
                maxlength: "Max 2 digits",
                digits: "Enter digits",
                max : "Invalid month",
            },
            card_year: {
                required: "Required !",
                minlength: "Min 4 digits",
                maxlength: "Max 4 digits",
                digits: "Enter digits",
                min: "Enter valid year"
            },
        },

    });

</script>

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
                $('.or_btn').hide();
                $('.or_btn2').show();
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

                iziToast.error({
                    title: 'error',
                    message: response.error.message,
                    position: 'topRight',
                    timeout: 3000,
                    transitionIn: 'fadeInDown',
                    transitionOut: 'fadeOut',
                    transitionInMobile: 'fadeInUp',
                    transitionOutMobile: 'fadeOutDown',
                });

                $('.or_btn').show();
                $('.or_btn2').hide();

            } else {

                $('.or_btn').hide();
                $('.or_btn2').show();

                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });
</script>


@endsection
