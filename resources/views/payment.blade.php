@extends('layouts.app') {{-- Changed this to layouts.app to ensure it has the correct header/footer --}}

@section('content')
<div class="container">
    <div class="jumbotron jumbotron-fluid bg-primary text-white mb-4" style="padding: 2rem 1rem;">
        <div class="container text-center">
            <h1 class="display-4">Payment</h1>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body text-center">
            <h4 class="mb-3">Thank you for your order!</h4>
            <p>Your order has been placed successfully.</p>
            <p>Please select your preferred payment method to complete the process.</p>

            <div class="my-4" id="payment-options">
                {{-- eWallet (TNG) Option --}}
                <div class="mb-3">
                    <input type="radio" id="tng" name="payment_method" checked>
                    <label for="tng"><strong>eWallet (TNG)</strong></label>
                    <div class="mt-2" id="tng-info">
                        <div style="display: flex; justify-content: center;">
                            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/a/aa/Touch_%27n_Go_eWallet.svg/1200px-Touch_%27n_Go_eWallet.svg.png" style="height: 50px;" alt="TNG Logo">
                        </div>
                        <div>Scan QR to pay:</div>
                        <div style="display: flex; justify-content: center;">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=maybank1234567890" alt="TNG QR" style="height:120px;">
                        </div>
                        <div class="text-muted text-sm mt-1">TNG eWallet: 012-3456789</div>
                    </div>
                </div>

                {{-- Online Banking (FPX) Option --}}
                <div class="mb-3">
                    <input type="radio" id="fpx" name="payment_method">
                    <label for="fpx"><strong>Online Banking (FPX)</strong></label>
                    <div class="mt-2" id="fpx-info" style="display:none;">
                        <div class="mb-2">
                            <label for="fpx-bank"><strong>Select Bank:</strong></label>
                            <select id="fpx-bank" class="form-control mx-auto" style="max-width:220px;">
                                <option value="maybank">Maybank</option>
                                <option value="muamalat">Bank Muamalat</option>
                                <option value="cimb">CIMB</option>
                            </select>
                        </div>
                        <button id="fpx-pay-button" class="btn btn-success mt-2">Proceed to Payment</button>
                        <div class="text-muted text-sm mt-1">You will be securely redirected to your bank's website to complete the payment.</div>
                    </div>
                </div>

                {{-- Cash on Delivery Option --}}
                <div class="mb-3">
                    <input type="radio" id="cod" name="payment_method">
                    <label for="cod"><strong>Cash on Delivery</strong></label>
                    <div class="mt-2" id="cod-info" style="display:none;">
                        <div>Please prepare the exact amount. Pay with cash when your food is delivered.</div>
                    </div>
                </div>
            </div>

            {{-- Success Message Div (initially hidden) --}}
            <div id="payment-success-message" class="alert alert-success" style="display:none;">
                <strong>Payment Successful!</strong>
                <p>Your transaction has been completed and you will receive a confirmation email shortly.</p>
            </div>

            <p>After payment, a confirmation will be sent to your email.</p>
            <a href="{{ url('/') }}" class="btn btn-primary mt-3">Back to Home</a>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentOptionsDiv = document.getElementById('payment-options');
        const successMessageDiv = document.getElementById('payment-success-message');

        function showInfo(id) {
            document.getElementById('tng-info').style.display = (id === 'tng') ? 'block' : 'none';
            document.getElementById('fpx-info').style.display = (id === 'fpx') ? 'block' : 'none';
            document.getElementById('cod-info').style.display = (id === 'cod') ? 'block' : 'none';
        }

        document.querySelectorAll('input[name="payment_method"]').forEach(function(el) {
            el.addEventListener('change', function() {
                showInfo(this.id);
            });
        });

        // FPX button simulation
        const fpxPayButton = document.getElementById('fpx-pay-button');
        if (fpxPayButton) {
            fpxPayButton.addEventListener('click', function() {
                // Hide payment options and show success message
                paymentOptionsDiv.style.display = 'none';
                successMessageDiv.style.display = 'block';
            });
        }

        // Show initial selected payment method
        showInfo(document.querySelector('input[name="payment_method"]:checked').id);
    });
</script>
@endsection