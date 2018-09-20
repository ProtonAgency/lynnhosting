@extends ('layouts.app')
@section ('content')
<div class="inner-hero-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-hero-content">
                    <h1>Billing Settngs</h1>
                    <p>Enter your billing information below, we'll automatically charge you for your containers.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="faq-area">
    <div class="faq--menu-area">
        <div class="faq-tab-menu">
            <ul>
                <li class="menu1 active">
                    <a data-toggle="tab" id="cc-btn" href="#credit-card">Credit Card </a>
                </li>
                <li class="menu2">
                    <a data-toggle="tab" id="pp-btn" href="#paypal">PayPal </a>
                </li>
                <li class="menu3">
                    <a data-toggle="tab" id="vm-btn" href="#venmo" style="pointer-events: none; cursor: default; text-decoration: none;">Venmo </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="tab-content">
            <div id="credit-card" class="faq-tab-content tab-pane fade in active">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="credit-card-form" action="{{ route('settings.billing.save') }}" method="post">
                            @csrf
                            @if (session('error') !== null)
                                <center>
                                    <p style="color: red;">{{ session('error') }}</p>
                                </center>
                            @endif
                            @if (session('success') !== null)
                                <center>
                                    <p style="color: green;">{{ session('success') }}</p>
                                </center>
                            @endif
                            <div id="dropin-container"></div>
                            <div class="center-btn text-center" style="padding-top: 1em;">
                                <a href="#" id="pay" style="width: 100%; display: none;">Verify Information</a>
                                <a href="#" id="confirm" style="width: 100%; display: none;"><i class="fa fa-lock"></i> Confirm Information</a>
                            </div>
                            <small>All payment information is securely transmitted to a third party payment provider and stored with an encryption per pci-dss requirements on a secure server. Learn more about how we handle your payment information <a href="/legal">here.</a></small>
                        </form>
                    </div>
                </div>
            </div>
            <div id="paypal" class="faq-tab-content tab-pane fade in active">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="paypal-form" action="{{ route('settings.billing.save') }}" method="post">
                            @csrf
                            <div id="paypal-button"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section ('js')
<script src="https://js.braintreegateway.com/web/dropin/1.12.0/js/dropin.min.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js" data-version-4></script>
<script src="https://js.braintreegateway.com/web/3.34.0/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.34.0/js/paypal-checkout.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var submitButton = document.querySelector('#pay');
        var confirmButton = document.querySelector('#confirm');
        document.getElementById('pay').style.display = 'block';
        braintree.dropin.create( {
            authorization: '{{ Braintree_ClientToken::generate() }}',
            selector: '#dropin-container'
        }, function ( err, dropinInstance ) {
            if ( err ) {
                console.error( err );
                return false;
            }
            submitButton.addEventListener( 'click', function ( event ) {
                dropinInstance.requestPaymentMethod( function ( err, payload ) {
                    if ( err ) {
                        event.preventDefault();
                        return;
                    }
                    $( '#credit-card-form' ).append( '<input type="hidden" name="payment_method_nonce" value="' + payload.nonce + '" />' );

                    document.getElementById('pay').style.display = 'none';
                    document.getElementById('confirm').style.display = 'block';
                } );
            } );
            confirmButton.addEventListener( 'click', function ( event ) {
                $( '#credit-card-form' ).submit();
            } );
        } );
        braintree.client.create( {
            authorization: '{{ Braintree_ClientToken::generate() }}'
        }, function ( err, clientInstance ) {
            braintree.paypalCheckout.create( {
                client: clientInstance
            } );
        }, function ( err, paypalCheckoutInstance ) {
            paypal.Button.render( {
                env: 'production',
                style: {
                    label: 'checkout',
                    size: 'responsive',
                    shape: 'rect',
                    color: 'blue'
                },
                payment: function ( ) {
                    return paypalCheckoutInstance.createPayment( {
                        flow: 'vault',
                        billingAgreementDescription: 'Your agreement description',
                        enableShippingAddress: false
                    } );
                },
                onAuthorize: function ( data, actions ) {
                    return paypalCheckoutInstance.tokenizePayment( data, function ( err, payload ) {
                        $( '#paypal-form' ).append( '<input type="hidden" name="payment_method_nonce" value="' + payload.nonce + '" />' );
                        $( '#paypal' ).submit( );
                    } );
                },
            }, '#paypal-button' );
        } );

        $('#pp-btn').trigger('click');
        $('#cc-btn').trigger('click');
    });
</script>
@endsection