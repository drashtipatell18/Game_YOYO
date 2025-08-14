@extends('frontend.layouts.main')
@section('content')
    <style>
        .toast-success {
            background-color: #28a745 !important;
            color: white !important;
        }

        .toast-success .toast-title {
            color: white !important;
            font-weight: bold;
        }

        .toast-success .toast-message {
            color: white !important;
        }

        .toast-success .toast-progress {
            background-color: rgba(255, 255, 255, 0.7) !important;
        }
        .swal2-success-toast {
            background-color: #28a745 !important; /* Bootstrap success green */
            color: #fff !important;
        }
    </style>


        <div class="Z_cart_darkbg">
            <div class="Z_cart_hero">
                <div class="Z_cart_hero-overlay">
                    <h1 class="Z_about_title">Your Cart</h1>
                </div>
            </div>

            <!-- Hero Section End -->
            <div class="container py-5">
                <div class="Z_cart_box mx-auto">
                    <div class="Z_cart_table_scroll text-nowrap" style="overflow-x:auto; width:100%;">
                        <table class="Z_cart_table w-100 mb-0">
                            <thead>
                                <tr>
                                    <th class="Z_cart_th">Product</th>
                                    <th class="Z_cart_th">Category</th>
                                    <th class="Z_cart_th">Price</th>
                                    <th class="Z_cart_th">Action</th>
                                </tr>
                            </thead>
                            <tbody id="cartTableBody">
                                @if ($carts->count() > 0)
                                    @foreach ($carts as $cart)
                                        @if ($cart->product)
                                            <tr id="cart-row-{{ $cart->id }}">
                                                <td class="Z_cart_td">
                                                    {{-- <div class="d-flex align-items-center gap-3">
                                                        <img src="{{ asset('images/products/' . ($cart->product->image ?? 'default.png')) }}"
                                                            alt="{{ $cart->product->title ?? 'Product Image' }}"
                                                            class="Z_cart_img">

                                                        <span class="Z_cart_name">{{ $cart->product->title }}</span>
                                                    </div> --}}
                                                    <div class="d-flex align-items-center gap-3">
                                                        @php
                                                            $images = explode(
                                                                ',',
                                                                $cart->product->image ?? 'default.png',
                                                            );
                                                            $firstImage = trim($images[0]);
                                                        @endphp

                                                        <img src="{{ asset('images/products/' . $firstImage) }}"
                                                            alt="{{ $cart->product->title ?? 'Product Image' }}"
                                                            class="Z_cart_img">

                                                        <span class="Z_cart_name">{{ $cart->product->name }}</span>

                                                    </div>


                                                </td>
                                                <td class="Z_cart_td">{{ $cart->product->category->name ?? 'N/A' }}</td>
                                                <td class="Z_cart_td">${{ number_format($cart->product->price, 2) }}</td>
                                                <td class="Z_cart_td text-center">
                                                    <button class="Z_cart_removebtn"
                                                        onclick="deleteItem({{ $cart->id }})">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">Your cart is empty.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="row g-2 align-items-center mt-3">
                        <div class="col-md-6">
                            <!-- Coupon code can be added here -->
                        </div>
                        <div class="col-md-6 text-md-end mt-2 mt-md-0">
                            <button class="Z_Minput_btn" onclick="updateCart()">UPDATE CART</button>
                        </div>
                    </div>

                    <div class="Z_cart_totals mt-4">
                        <div class="Z_cart_totals_title mb-2">Cart totals</div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total</span>
                            <span id="cartTotal">${{ number_format($cartTotal ?? 0, 2) }}</span>
                        </div>
                        <div class="text-end mt-3">
                            <button class="Z_cart_btn Z_cart_btnoutline"
                                onclick="payNow(this)"
                                data-total="{{ $cartTotal ?? 0 }}"
                                data-cart-id="{{ $cart->id ?? 0 }}"
                                {{ $carts->count() == 0 ? 'disabled' : '' }}>
                                BUY NOW
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Modals remain the same -->
        <div class="modal fade " id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <!-- Modal content stays the same as in your original code -->
        </div>

        <div class="modal fade" id="paymentModal2" tabindex="-1" aria-labelledby="paymentModalLabel2" aria-hidden="true">
            <!-- Modal content stays the same as in your original code -->
        </div>

    @endsection

    @push('script')
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- CSRF Token for AJAX requests -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script>
            // Set up CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Function to delete item from cart
            async function deleteItem(cartId) {
                if (!confirm('Are you sure you want to remove this item from your cart?')) {
                    return;
                }

                try {
                    const response = await $.ajax({
                        url: `/api/cart/${cartId}`,
                        method: 'DELETE',
                        dataType: 'json'
                    });

                    if (response.message) {
                        // Remove the row from the table
                        $(`#cart-row-${cartId}`).fadeOut(300, function() {
                            $(this).remove();
                            updateCartDisplay();
                        });

                        // Show success toast
                        toastr.success('Item removed from cart successfully!', 'Success', {
                            timeOut: 3000,
                            positionClass: 'toast-top-right',
                            progressBar: true
                        });
                    }
                } catch (error) {
                    console.error('Error removing item:', error);

                    // Show error toast
                    toastr.error('Error removing item from cart. Please try again.', 'Error', {
                        timeOut: 5000,
                        positionClass: 'toast-top-right',
                        progressBar: true
                    });
                }
            }

            // Function to update cart display
            function updateCartDisplay() {
                const tbody = $('#cartTableBody');

                if (tbody.find('tr').length === 0) {
                    tbody.html('<tr><td colspan="4" class="text-center">Your cart is empty.</td></tr>');
                    $('#cartTotal').text('£0.00');
                    $('[data-bs-target="#paymentModal"]').prop('disabled', true);
                } else {
                    // Recalculate total
                    let total = 0;
                    tbody.find('tr').each(function() {
                        const priceText = $(this).find('.Z_cart_td:nth-child(3)').text();
                        const price = parseFloat(priceText.replace('£', ''));
                        if (!isNaN(price)) {
                            total += price;
                        }
                    });
                    $('#cartTotal').text(`£${total.toFixed(2)}`);
                    $('[data-bs-target="#paymentModal"]').prop('disabled', false);
                }
            }

            // Function to update cart (redirect to products page)
            function updateCart() {
                window.location.href = "{{ route('allProducts') }}";
            }

            // Modal functionality
            document.addEventListener("DOMContentLoaded", function() {
                const dbContinueBtn = document.getElementById("db_continue_btn");
                const modal1El = document.getElementById("paymentModal");
                const modal2El = document.getElementById("paymentModal2");

                if (dbContinueBtn && modal1El && modal2El) {
                    const modal2 = new bootstrap.Modal(modal2El);

                    dbContinueBtn.addEventListener("click", () => {
                        bootstrap.Modal.getInstance(modal1El)?.hide();
                        modal2.show();
                    });

                    // Handle payment method selection
                    const methods = document.querySelectorAll(".payment-method");
                    methods.forEach(method => {
                        method.addEventListener("click", () => {
                            methods.forEach(m => m.classList.remove("active"));
                            method.classList.add("active");
                        });
                    });
                }

                // Promo checkbox functionality
                const promoCheckbox = document.querySelector(".promo-code");
                if (promoCheckbox) {
                    promoCheckbox.addEventListener("click", function() {
                        promoCheckbox.classList.toggle("active");
                    });
                }
            });

            // Offcanvas menu functionality
            (function() {
                const toggler = document.querySelector('.d_toggler_btn');
                const offcanvas = document.getElementById('d_offcanvas_menu');
                const closeBtn = offcanvas?.querySelector('.close_btn');

                if (toggler && offcanvas && closeBtn) {
                    toggler.addEventListener('click', () => {
                        offcanvas.classList.add('active');
                        document.body.style.overflow = 'hidden';
                    });

                    closeBtn.addEventListener('click', () => {
                        offcanvas.classList.remove('active');
                        document.body.style.overflow = '';
                    });

                    document.addEventListener('click', (e) => {
                        if (!offcanvas.contains(e.target) && !toggler.contains(e.target)) {
                            offcanvas.classList.remove('active');
                            document.body.style.overflow = '';
                        }
                    });

                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'Escape') {
                            offcanvas.classList.remove('active');
                            document.body.style.overflow = '';
                        }
                    });
                }

                // Sticky header scroll effect
                window.addEventListener('scroll', () => {
                    const header = document.querySelector('.d_header');
                    if (header) {
                        if (window.scrollY > 20) {
                            header.classList.add('d_scrolled');
                        } else {
                            header.classList.remove('d_scrolled');
                        }
                    }
                });
            })();
        </script>
        
<!-- Razor Pay Code -->
    <script>
        function payNow(button) {
            const cartId = button.getAttribute('data-cart-id');
            const totalAmount = parseFloat(button.getAttribute('data-total')) || 0;

            fetch(`/get-payment-details-cart/${cartId}`)
                .then(res => res.json())
                .then(data => {
                    const options = {
                        "key": "{{ env('RAZORPAY_KEY') }}",
                        "amount": data.amount * 100, // Convert $75 to 7500 cents
                        "currency": "USD", // ✅ Set to USD
                        "name": data.name,
                        "description": data.description,
                        "image": data.image || '/default.png',
                        "order_id": data.razorpay_order_id,
                        "handler": function (response) {
                            fetch('/cart/success', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    razorpay_payment_id: response.razorpay_payment_id,
                                    razorpay_order_id: response.razorpay_order_id,
                                    razorpay_signature: response.razorpay_signature,
                                    amount: totalAmount,
                                    cart_id: cartId 
                                })
                            }).then(res => res.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    Swal.fire({
                                        toast: true,
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Payment Successful!',
                                        showConfirmButton: false,
                                        timer: 5000, // ⏱ Show for 5 seconds
                                        timerProgressBar: true,
                                        customClass: {
                                            popup: 'swal2-success-toast'
                                        }
                                    }).then(() => {
                                        // Redirect to invoice page
                                        window.location.href = data.invoice_url;
                                    });
                                   

                                    $('#cartTableBody').html('<tr><td colspan="4" class="text-center">Your cart is empty.</td></tr>');
                                    $('#cartTotal').text('$0.00');
                                    $('[data-bs-target="#paymentModal"]').prop('disabled', true);

                                } else {
                                    Swal.fire({
                                        toast: true,
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'Payment failed to store.',
                                        showConfirmButton: false,
                                        timer: 5000,
                                        customClass: {
                                            popup: 'swal2-danger-toast'
                                        }
                                    });
                                }
                            });
                        },
                        "theme": {
                            "color": "#3399cc"
                        }
                    };

                    const rzp = new Razorpay(options);
                    rzp.open();
                });
        }
        </script>
    </body>
@endpush
