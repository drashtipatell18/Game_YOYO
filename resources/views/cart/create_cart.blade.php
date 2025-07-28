@extends('layouts.app')
@section('title', isset($cart) ? 'Edit Cart' : 'Create Cart')
@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($cart) ? 'Edit Cart' : 'Create Cart' }}</h4>
                    <form action="{{ isset($cart) ? route('add-to-cart.update', $cart->id) : route('add-to-cart.store') }}"
                        method="post" enctype="multipart/form-data" id="cart-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="product_id">Product ID</label>
                                    <select name="product_id" class="form-control" required>
                                        <option value="">Select Product</option>
                                        @foreach ($products as $key => $product)
                                            <option value="{{ $key }}"
                                                {{ isset($cart) && $cart->product_id == $key ? 'selected' : '' }}>
                                                {{ $product }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="user_id">User ID</label>
                                    <select name="user_id" class="form-control" required>
                                        <option value="">Select User</option>
                                        @foreach ($users as $key => $user)
                                            <option value="{{ $key }}"
                                                {{ isset($cart) && $cart->user_id == $key ? 'selected' : '' }}>
                                                {{ $user }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" class="form-control"
                                        value="{{ isset($cart) ? $cart->quantity : 1 }}" required>
                                </div>

                            </div>
                        </div>
                        <div class="form-group text-center p-3">
                            <button type="submit" class="btn btn-primary mr-2 text-white custom-btn" style="pointer-events: auto;">
                                {{ isset($cart) ? 'Update' : 'Submit' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#cart-form').validate({
                rules: {
                    product_id: {
                        required: true,
                    },
                    user_id: {
                        required: true,
                    },
                    quantity: {
                        required: true,
                        min: 1
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    // Optional: Add loading state
                    var submitBtn = $(form).find('button[type="submit"]');
                    var originalText = submitBtn.text();
                    submitBtn.prop('disabled', true).text('Processing...');
                    // Submit the form
                    form.submit();
                }
            });
        });
    </script>
@endpush
