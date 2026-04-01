
<div class="row">
    <!-- Razorpay -->
   <div class="col-lg-6">
    <div class="card">
        <form class="form-horizontal" action="{{ route('setting.update') }}" method="POST">
            @csrf
            <div class="card-header row">
                <div class="col-lg-5">
                    <!-- Razorpay Logo -->
                    <img src="{{asset('uploads/images (10).jpg')}}"
                         alt="Razorpay"
                         class="mb-4 paymentamethod_image"
                         >
                </div>
                <div class="col-lg-6">
                    <label class="switch switch-success float-right toggle_payment">
                        <input type="checkbox" class="switch-input" name="enable_razorpay" value="1"
                            {{ setting('enable_razorpay') ? 'checked' : '' }}>
                        <span class="switch-toggle-slider">
                            <span class="switch-on">
                                <i class="ti ti-check"></i>
                            </span>
                            <span class="switch-off">
                                <i class="ti ti-x"></i>
                            </span>
                        </span>
                    </label>
                </div>
            </div>
            <hr class="payment-hr">
            <div class="card-body">
                <input type="hidden" name="page_name" value="payment_methods">
                <input type="hidden" name="payment_method" value="razorpay">

                <div class="form-group row mt-3">
                    <div class="col-md-4">
                        <label class="col-form-label">Razorpay Key</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="razorpay_key"
                            value="{{ setting('razorpay_key') }}" placeholder="Razorpay Key" required>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-md-4">
                        <label class="col-form-label">Razorpay Secret</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="razorpay_secret"
                            value="{{ setting('razorpay_secret') }}" placeholder="Razorpay Secret" required>
                    </div>
                </div>

                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- stripe -->
    <div class="col-lg-6">
    <div class="card">
        <form class="form-horizontal" action="{{ route('setting.update') }}" method="POST">
            @csrf
            <div class="card-header row">
                <div class="col-lg-5">
                    <img src="{{asset('uploads/images (11).jpg')}}"
                         alt="Stripe"
                         class="mb-4 paymentamethod_image">
                </div>
                <div class="col-lg-6">
                    <label class="switch switch-success float-right toggle_payment">
                        <input type="checkbox" class="switch-input" name="enable_stripe" value="1"
                            {{ setting('enable_stripe') ? 'checked' : '' }}>
                        <span class="switch-toggle-slider">
                            <span class="switch-on">
                                <i class="ti ti-check"></i>
                            </span>
                            <span class="switch-off">
                                <i class="ti ti-x"></i>
                            </span>
                        </span>
                    </label>
                </div>
            </div>
            <hr class="payment-hr">
            <div class="card-body">
                <input type="hidden" name="page_name" value="payment_methods">
                <input type="hidden" name="payment_method" value="stripe">

                <div class="form-group row mt-3">
                    <div class="col-md-4">
                        <label class="col-form-label">Stripe Key</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="stripe_key"
                            value="{{ setting('stripe_key') }}" placeholder="Stripe Key" required>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-md-4">
                        <label class="col-form-label">Stripe Secret Key</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="stripe_secret_key"
                            value="{{ setting('stripe_secret_key') }}" placeholder="Stripe Secret Key" required>
                    </div>
                </div>

                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

    <!-- Paypal -->
<div class="col-lg-6 mt-5">
    <div class="card">
        <form class="form-horizontal" action="{{ route('setting.update') }}" method="POST">
            @csrf
            <div class="card-header row">
                <div class="col-lg-5">
                    <img src="{{asset('uploads/images.png')}}"
                         alt="PayPal"
                         class="mb-4 paymentamethod_image">
                </div>
                <div class="col-lg-6">
                    <label class="switch switch-success float-right toggle_payment">
                        <input type="checkbox" class="switch-input" name="enable_paypal" value="1"
                            {{ setting('enable_paypal') ? 'checked' : '' }}>
                        <span class="switch-toggle-slider">
                            <span class="switch-on">
                                <i class="ti ti-check"></i>
                            </span>
                            <span class="switch-off">
                                <i class="ti ti-x"></i>
                            </span>
                        </span>
                    </label>
                </div>
            </div>
            <hr class="payment-hr">
            <div class="card-body">
                <input type="hidden" name="page_name" value="payment_methods">
                <input type="hidden" name="payment_method" value="paypal">

                <div class="form-group row mt-3">
                    <div class="col-md-4">
                        <label class="col-form-label">PayPal Client ID</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="paypal_client_id"
                            value="{{ setting('paypal_client_id') }}" placeholder="PayPal Client ID" required>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-md-4">
                        <label class="col-form-label">PayPal Secret Key</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="paypal_secret_key"
                            value="{{ setting('paypal_secret_key') }}" placeholder="PayPal Secret Key" required>
                    </div>
                </div>

                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- COD -->
<div class="col-lg-6 mt-5">
    <div class="card">
        <form class="form-horizontal" action="{{ route('setting.update') }}" method="POST">
            @csrf
            <div class="card-header row">
                <div class="col-lg-5">
                    <img src="{{asset('uploads/images (12).jpg')}}"
                         alt="Cash on Delivery"
                         class="mb-4 paymentamethod_image">
                </div>
                <div class="col-lg-6">
                    <label class="switch switch-success float-right toggle_payment">
                        <input type="checkbox" class="switch-input" name="enable_cod" value="1"
                            {{ setting('enable_cod') ? 'checked' : '' }}>
                        <span class="switch-toggle-slider">
                            <span class="switch-on">
                                <i class="ti ti-check"></i>
                            </span>
                            <span class="switch-off">
                                <i class="ti ti-x"></i>
                            </span>
                        </span>
                    </label>
                </div>
            </div>
            <hr class="payment-hr">
            <div class="card-body">
                <input type="hidden" name="page_name" value="payment_methods">
                <input type="hidden" name="payment_method" value="cod">

                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

</div>
