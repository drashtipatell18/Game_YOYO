@extends('frontend.layouts.main')
@section('content')
    <style>
        .x_review-form .form-control:focus {
            background: transparent;
            color: #fff;
            border-color: #cfcfcf !important;
            box-shadow: none;
        }

        .submitReviewButton:hover {
            border-radius: 2px;
            font-weight: 500;
            letter-spacing: 1px;
            border: 1px solid transparent;
            background-color: #928e75 !important;
            color: #fff !important;
        }
        .toast-success {
            background-color: #28a745 !important;  /* Bootstrap's green */
            color: white !important;
        }
        .toast-error {
            background-color: #dc3545 !important;  /* Bootstrap's red */
            color: white !important;
        }
    </style>
    <!-- x_game-product-section START -->
    <section class="x_game-shop a_header_container">
        <div class=" x_game-product-section py-5">
            <div class="x_space">

                <div class="row">
                    <!-- Thumbnails -->
                    <div class="col-md-1 d-none d-md-flex flex-column align-items-center x_thumb-list">
                        @if (!empty($images) && count($images) > 0)
                            @foreach ($images as $index => $img)
                                <img src="{{ asset('images/products/' . trim($img)) }}"
                                    class="img-fluid mb-3 x_thumb-img {{ $index === 0 ? 'active' : '' }}"
                                    alt="thumb{{ $index + 1 }}" onclick="changeMainImage(this)">
                            @endforeach
                        @else
                            <!-- Optional: dummy thumbnail -->
                            <img src="{{ asset('images/products/dummy_product.png') }}"
                                class="img-fluid mb-3 x_thumb-img active" alt="default-thumb">
                        @endif
                    </div>


                    <!-- Main Image -->
                    <div class="col-md-5 text-center x_main-img-wrap">
                        <img id="mainImage" class="img-fluid x_main-img"
                            src="{{ isset($images[0]) ? asset('images/products/' . trim($images[0])) : asset('images/products/dummy_product.png') }}"
                            alt="main">
                    </div>

                    <!-- Product Info -->
                    <div class="col-md-6 x_product-info text-white">
                        <div class="x_shop_info mt-3 mt-sm-0">
                            <h2 class="x_product-title">{{ $product['name'] ?? 'Unknown Product' }}</h2>
                            <div class="x_product-price mb-3">
                                ${{ number_format($product['price'] ?? 0, 2) }}
                            </div>

                            @if (isset($product['description']))
                                <div class="x_product-description mb-3">
                                    <p>{{ $product['description'] }}</p>
                                </div>
                            @endif

                            @php
                                $isLoggedIn = auth()->check();
                            @endphp
                            <div class="d-flex align-items-center mb-3">
                                <button class="btn btn-outline-light x_add-cart-btn px-md-4 px-3 me-3"
                                    onclick="payNow({{ $product['id'] ?? 0 }}, {{ $isLoggedIn ? 'true' : 'false' }})">
                                    BUY NOW
                                </button>

                                <button class="btn btn-outline-light x_add-cart-btn px-md-4 px-3"
                                    onclick="addToCart({{ $product['id'] ?? 0 }})">
                                    ADD TO CART
                                </button>
                            </div>

                            <div class="x_product-meta x_line_tb mb-2">
                                <div>SKU: {{ $product['SKU'] ?? ($product['id'] ?? '000') }}</div>
                                <div>Category: {{ $product->category->name ?? 'Games' }}</div>
                                @if (isset($product['tags']))
                                    <div>Tags:
                                        {{ is_array($product['tags']) ? implode(', ', $product['tags']) : $product['tags'] }}
                                    </div>
                                @else
                                    <div>Tags: gaming, entertainment</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tabs -->
                <div class="row mt-md-5 mt-4">
                    <div class="col-12">
                        <ul class="nav nav-tabs x_tabs w-100 overflow-x-auto overflow-y-hidden flex-nowrap text-nowrap"
                            id="x_productTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active x_tab-link" id="desc-tab" data-bs-toggle="tab"
                                    data-bs-target="#desc" type="button" role="tab">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link x_tab-link" id="addinfo-tab" data-bs-toggle="tab"
                                    data-bs-target="#addinfo" type="button" role="tab">Additional Information</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link x_tab-link" id="reviews-tab" data-bs-toggle="tab"
                                    data-bs-target="#reviews" type="button" role="tab">Reviews
                                    ({{ $reviewCount }})</button>
                            </li>
                        </ul>
                        <div class="tab-content x_tab-content p-4 bg-opacity-75" id="x_productTabContent">
                            <div class="tab-pane fade show active" id="desc" role="tabpanel">
                                {{ $product['description'] ?? 'No description available.' }}
                            </div>
                            <div class="tab-pane fade" id="addinfo" role="tabpanel">
                                <div class="x_additional-info">
                                    <h5 class="mb-3">Additional information</h5>
                                    <div class="row mb-2">
                                        <div class="col-4 col-md-2">Weight</div>
                                        <div class="col-8 col-md-10">{{ $product['weight'] ?? 'N/A' }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 col-md-2">Dimensions</div>
                                        <div class="col-8 col-md-10">{{ $product['dimensions'] ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="x_reviews">
                                    <h5 class="mb-3">Reviews</h5>
                                    <p>There are no reviews yet.</p>
                                    <p>Be the first to review <b>"Falldown Republic"</b></p>
                                    <p class="mb-1">Your email address will not be published. Required fields are marked
                                        *</p>
                                    <div class="alert alert-success x_review-success" style="display:none;"></div>
                                    <form class="x_review-form">
                                        <input type="hidden" id="product_id" value="{{ $product->id }}">
                                        <!-- Add this -->
                                        <div class="mb-2">Your rating *</div>
                                        <div class="mb-3 x_rating-stars">
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <div class="invalid-feedback d-block x_rating-error" style="display:none;">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="review" class="form-label">Your review *</label>
                                            <textarea class="form-control bg-transparent text-white border-secondary" id="review" rows="4"></textarea>
                                            <div class="invalid-feedback d-block x_review-error" style="display:none;">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name *</label>
                                            <input type="text"
                                                class="form-control bg-transparent text-white border-secondary"
                                                id="name"
                                                value="{{ auth()->check() ? auth()->user()->name : '' }}"{{ auth()->check() ? 'disabled' : '' }}>
                                            <div class="invalid-feedback d-block x_name-error" style="display:none;">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email *</label>
                                            <input type="email"
                                                class="form-control bg-transparent text-white border-secondary"
                                                id="email"
                                                value="{{ auth()->check() ? auth()->user()->email : '' }}"{{ auth()->check() ? 'disabled' : '' }}>
                                            <div class="invalid-feedback d-block x_email-error" style="display:none;">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="x_btn btn btn-outline-light mx-auto submitReviewButton">SUBMIT</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- slider -->
                <h3 class="mb-3 mt-5" style="font-weight:600; color: #8a775a;">More Like This</h3>
                <div class="swiper mySwiper py-4 mt-3">
                    <div class="swiper-wrapper" id="swiperCards">
                        <!-- Cards will be injected here by JS -->
                    </div>
                    <!-- Add navigation buttons
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            Add pagination
                            <div class="swiper-pagination"></div> -->
                </div>
            </div>
        </div>
    </section>

    <!-- Payment Modal 1 - Choose Payment Method -->
    <div class="modal fade " id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content payment_model_bg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title mb-3" id="paymentModalLabel">
                        Choose payment method
                    </h5>
                    <button type="button" class="btn-close mb-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body pt-1">
                    <div class="payment-method active" data-value="visa">
                        <div class="method-details">
                            <img src="https://img.icons8.com/color/48/visa.png" alt="Visa" />
                            <div class="method-label">Visa</div>
                        </div>
                        <div class="custom-radio"></div>
                    </div>

                    <div class="payment-method" data-value="mastercard">
                        <div class="method-details">
                            <img src="https://img.icons8.com/color/48/mastercard.png" alt="Mastercard" />
                            <div class="method-label">Master Card</div>
                        </div>
                        <div class="custom-radio"></div>
                    </div>

                    <div class="payment-method" data-value="discover">
                        <div class="method-details">
                            <img src="https://img.icons8.com/color/48/discover.png" alt="Discover" />
                            <div class="method-label">Discover</div>
                        </div>
                        <div class="custom-radio"></div>
                    </div>

                    <div class="payment-method" data-value="paypal">
                        <div class="method-details">
                            <img src="https://img.icons8.com/color/48/paypal.png" alt="PayPal" />
                            <div class="method-label">PayPal</div>
                        </div>
                        <div class="custom-radio"></div>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn confirm-btn" id="db_continue_btn">
                        <a style="text-decoration: none; color: inherit;">Continue</a>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal 2 - Payment Details -->
    <div class="modal fade" id="paymentModal2" tabindex="-1" aria-labelledby="paymentModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">

                <div class="modal-body ">
                    <div class="payment-card">
                        <div class="payment-card-body payment_model_bg text-white">
                            <a data-bs-target="#paymentModal" data-bs-dismiss="#paymentModal2" data-bs-toggle="modal"
                                class="back-link">&larr; Go Back</a>
                            <h4 class="section-title">Payment details</h4>

                            <div class="mb-3">
                                <label class="form-label">Name on card</label>
                                <input type="text" class="form-control" placeholder="Abigail Lorincz" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Card number</label>
                                <input type="text" class="form-control" placeholder="1234 5678 9012 3456" />
                            </div>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Expiry</label>
                                    <input type="text" class="form-control" placeholder="08 / 2024" />
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label">CVV</label>
                                    <input type="password" class="form-control" placeholder="•••" />
                                </div>
                            </div>

                            <div class="promo-code checkbox-item">
                                <div class="custom-checkbox"></div>
                                <label class="checkbox-label cursor-pointer">Enter a promo code</label>
                            </div>

                            <div class="summary">
                                <div class="row">
                                    <div class="col">Subtotal</div>
                                    <div class="col text-end" id="paymentSubtotal">£0.00</div>
                                </div>
                                <div class="row">
                                    <div class="col">Sales tax</div>
                                    <div class="col text-end" id="paymentTax">£0.00</div>
                                </div>
                                <div class="row total">
                                    <div class="col">Total</div>
                                    <div class="col text-end" id="paymentTotal">£0.00</div>
                                </div>
                            </div>

                            <button class="btn confirm-btn w-100 mt-3">Place your order</button>

                            <div class="terms">Review the <a href="#" class="text-white">terms and conditions</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const isLoggedIn = @json(Auth::check()); // returns true or false
        const loginUrl = "{{ route('frontend.login') }}";
    </script>
    <script>
        $(document).ready(function() {
            // Thumbnail image click
            $('.x_thumb-img').on('click', function() {
                var newSrc = $(this).attr('src');
                $('.x_main-img').attr('src', newSrc);
                $('.x_thumb-img').removeClass('active');
                $(this).addClass('active');
            });

            // Set first thumbnail as active
            $('.x_thumb-img').first().addClass('active');

            // Star rating click
            $('.x_rating-stars i').on('click', function() {
                var index = $(this).index();
                $('.x_rating-stars i').each(function(i) {
                    if (i <= index) {
                        $(this).removeClass('fa-regular').addClass('fa-solid');
                    } else {
                        $(this).removeClass('fa-solid').addClass('fa-regular');
                    }
                });
                $('.x_review-form').data('rating', index + 1);
            });

            // Review form submission with validation
            $('.x_review-form').on('submit', function(e) {
                e.preventDefault();

                if (!isLoggedIn) {
                    window.location.href = loginUrl;
                    return;
                }

                var valid = true;
                var rating = $(this).data('rating') || 0;
                var review = $('#review').val().trim();
                var name = $('#name').val().trim();
                var email = $('#email').val().trim();
                var product_id = $('#product_id').val();
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                // Reset previous errors
                $('.x_rating-error, .x_review-error, .x_name-error, .x_email-error').hide().text('');
                $('#review, #name, #email').removeClass('is-invalid');
                $('.x_rating-stars').removeClass('is-invalid');

                // Validation checks
                if (rating === 0) {
                    $('.x_rating-error').text('Please select a rating.').show();
                    $('.x_rating-stars').addClass('is-invalid');
                    valid = false;
                }
                if (review.length < 5) {
                    $('.x_review-error').text('Please enter a review (min 5 characters).').show();
                    $('#review').addClass('is-invalid');
                    valid = false;
                }
                if (name.length < 2) {
                    $('.x_name-error').text('Please enter your name.').show();
                    $('#name').addClass('is-invalid');
                    valid = false;
                }
                if (!emailPattern.test(email)) {
                    $('.x_email-error').text('Please enter a valid email address.').show();
                    $('#email').addClass('is-invalid');
                    valid = false;
                }

                if (!valid) return;

                // Submit via AJAX
                $.ajax({
                    url: "{{ route('frontReviewStore') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        product_id: product_id,
                        rating: rating,
                        review: review,
                        name: name,
                        email: email
                    },
                    success: function(response) {
                        // Show success message
                        toastr.success('Review submitted successfully!');

                        // Reset form
                        $('.x_review-form')[0].reset();
                        $('.x_rating-stars i').removeClass('fa-solid').addClass('fa-regular');
                        $('.x_review-form').removeData('rating');

                        // Hide alert after 4 seconds
                        setTimeout(function() {
                            $('.x_review-success').fadeOut();
                        }, 4000);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            if (errors.rating) $('.x_rating-error').text(errors.rating[0])
                                .show();
                            if (errors.review) $('.x_review-error').text(errors.review[0])
                                .show();
                            if (errors.name) $('.x_name-error').text(errors.name[0]).show();
                            if (errors.email) $('.x_email-error').text(errors.email[0]).show();
                        } else {
                            console.error(xhr);
                            toastr.error('Something went wrong. Please try again.');
                        }
                    }
                });
            });
        });
    </script>

    <script>
        const cardsData = {!! json_encode(
            $relatedProducts->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'image' => asset('images/products/' . explode(',', $item->image)[0]),
                    'price' => '$' . number_format($item->price, 2),
                    'category' => optional($item->category)->name,
                ];
            }),
        ) !!};
    </script>

    <script>
        function renderSwiperCards() {
            const swiperCards = document.getElementById('swiperCards');

            swiperCards.innerHTML = cardsData.map(card => `
            <div class="swiper-slide d-flex justify-content-center">
                <div class="game-card position-relative" data-id="${card.id}" style="cursor: pointer;">
                    <img src="${card.image}" alt="${card.name}" class="card-img-top" />
                    <div class="position-absolute card-content">
                        <!--
                        <div class="icons d-flex gap-2 mb-3">
                            <i class="fa-brands fa-apple"></i>
                            <i class="fa-brands fa-windows"></i>
                        </div>
                        -->
                        <h3>${card.name}</h3>
                        <h3 class="mb-0">${card.price}</h3>
                       <span class="badge bg-secondary mt-2">${card.category}</span>
                    </div>
                    <div class="card-actions d-flex align-items-center gap-3">
                        <div class="d_main_button w-100">
                            <button class="custom-cart-btn w-100" data-id="${card.id}">ADD TO CART</button>
                            <div class="d_border"></div>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');

            // Product card click
            document.querySelectorAll('.game-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    if (e.target.closest('.custom-cart-btn')) return;
                    const productId = this.getAttribute('data-id');
                    localStorage.setItem('item_id', productId);
                    window.location.href = '/productDetails/' + productId; // Update route if needed
                });
            });

            // Add to Cart button
            document.querySelectorAll('.custom-cart-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const productId = this.getAttribute('data-id');
                    addToCartFromSlider(productId); // Define this function separately
                });
            });
        }

        // Run Swiper and render cards
        document.addEventListener('DOMContentLoaded', function() {
            renderSwiperCards();
            new Swiper('.mySwiper', {
                slidesPerView: 3,
                spaceBetween: 24,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1
                    },
                    576: {
                        slidesPerView: 2
                    },
                    768: {
                        slidesPerView: 3
                    },
                    1024: {
                        slidesPerView: 3
                    },
                    1200: {
                        slidesPerView: 4
                    },
                    1400: {
                        slidesPerView: 4
                    },
                    1600: {
                        slidesPerView: 5
                    },
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const promoCheckbox = document.querySelector(".promo-code");

            promoCheckbox.addEventListener("click", function() {
                promoCheckbox.classList.toggle("active");
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const itemId = localStorage.getItem('item_id');


            try {
                const res = await fetch(`products/${id}`);
                if (!res.ok) throw new Error('Product not found');

                const product = await res.json();

                // Split comma-separated image string
                const imageArray = product.image ? product.image.split(',') : [];

                if (imageArray.length > 0) {
                    // Set main image
                    document.querySelector('.x_main-img').src = `images/products/${imageArray[0]}`;
                }

                // Render thumbnails dynamically
                const thumbList = document.querySelector('.x_thumb-list');
                if (thumbList) {
                    thumbList.innerHTML = ''; // Clear previous

                    imageArray.forEach((img, index) => {
                        const imgTag = document.createElement('img');
                        imgTag.src = `images/products/${img.trim()}`;
                        imgTag.className = `img-fluid mb-3 x_thumb-img${index === 0 ? ' active' : ''}`;
                        imgTag.alt = `thumb${index + 1}`;
                        imgTag.onclick = () => changeMainImage(imgTag);

                        thumbList.appendChild(imgTag);
                    });
                }

                // Product details
                document.querySelector('.x_product-title').textContent = product.title;
                document.querySelector('.x_product-price').textContent = `£${product.price}`;
                document.getElementById('desc').textContent = product.description;

            } catch (e) {
                console.error(e);
                // alert('Error loading product');
                // window.location.href = 'allProduct.html';
            }
        });

        function changeMainImage(thumb) {
            const mainImage = document.querySelector('.x_main-img');
            if (mainImage) mainImage.src = thumb.src;

            // Toggle active class
            document.querySelectorAll('.x_thumb-img').forEach(img => img.classList.remove('active'));
            thumb.classList.add('active');
        }
    </script>

    <script>
        function addToCart(productId, quantity = 1, buttonElement = null) {
            // Show loading state if button element is provided
            if (buttonElement) {
                setButtonLoading(buttonElement, true);
            }

            // Prepare form data
            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('quantity', quantity);

            // Get CSRF token (make sure you have this in your HTML head)
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        showNotification(data.message, 'success');

                        // Update cart count in UI if you have a cart counter
                        updateCartCount(data.cart_count);

                        // Optional: Change button text temporarily
                        if (buttonElement) {
                            const originalText = buttonElement.querySelector('.btn-text').textContent;
                            buttonElement.querySelector('.btn-text').textContent = 'ADDED!';
                            buttonElement.classList.add('btn-success');

                            setTimeout(() => {
                                buttonElement.querySelector('.btn-text').textContent = originalText;
                                buttonElement.classList.remove('btn-success');
                            }, 2000);
                        }

                        // Optional: Auto redirect to cart after delay
                        setTimeout(() => {
                            window.location.href = '/cart';
                        }, 1500);

                    } else {
                        // Handle error
                        showNotification(data.message, 'error');

                        // If user not authenticated, redirect to login
                        if (data.message.includes('login')) {
                            setTimeout(() => {
                                window.location.href = '/frontend-login';
                            }, 2000);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Something went wrong. Please try again.', 'error');
                })
                .finally(() => {
                    // Remove loading state
                    if (buttonElement) {
                        setButtonLoading(buttonElement, false);
                    }
                });
        }

        // Function to show loading state on button
        function setButtonLoading(button, isLoading) {
            const btnText = button.querySelector('.btn-text');
            const spinner = button.querySelector('.spinner-border');

            if (isLoading) {
                btnText.style.display = 'none';
                spinner.classList.remove('d-none');
                button.disabled = true;
            } else {
                btnText.style.display = 'inline';
                spinner.classList.add('d-none');
                button.disabled = false;
            }
        }

        // Function to update cart count in UI
        function updateCartCount(count) {
            const cartCountElements = document.querySelectorAll('.cart-count');
            cartCountElements.forEach(element => {
                element.textContent = count;

                // Add bounce animation
                element.classList.add('cart-updated');
                setTimeout(() => {
                    element.classList.remove('cart-updated');
                }, 600);
            });
        }

        // Function to show notifications (you can customize this based on your notification system)
        function showNotification(message, type = 'info') {
            // Using simple alert for now - you can replace with toast notifications
            if (type === 'success') {
                // Create or use your success notification
                console.log('Success:', message);

                // Example with custom notification
                createNotification(message, 'success');
            } else if (type === 'error') {
                console.error('Error:', message);
                createNotification(message, 'error');
            }
        }

        // Custom notification function (optional)
        function createNotification(message, type) {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.custom-notification');
            existingNotifications.forEach(notification => notification.remove());

            // Create notification element
            const notification = document.createElement('div');
            notification.className =
                `custom-notification alert alert-${type === 'success' ? 'success' : 'danger'} position-fixed`;
            notification.style.cssText = `
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        animation: slideIn 0.3s ease-out;
    `;
            notification.innerHTML = `
        <div class="d-flex align-items-center">
            <span>${message}</span>
            <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
        </div>
    `;

            document.body.appendChild(notification);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }

        // Function to redirect to cart page
        function redirectToCart() {
            window.location.href = '/cart';
        }
    </script>
    <script>
        // Payment modal functionality
        document.addEventListener("DOMContentLoaded", function() {
            const dbContinueBtn = document.getElementById("db_continue_btn");
            const modal1El = document.getElementById("paymentModal");
            const modal2El = document.getElementById("paymentModal2");
            const modal2 = new bootstrap.Modal(modal2El);

            // Handle continue button
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

            // Handle promo code checkbox
            const promoCheckbox = document.querySelector(".promo-code");
            if (promoCheckbox) {
                promoCheckbox.addEventListener("click", function() {
                    promoCheckbox.classList.toggle("active");
                });
            }

            // Update payment summary with product price
            async function updatePaymentSummary() {
                try {
                    const itemId = localStorage.getItem('item_id');
                    if (itemId) {
                        const res = await fetch(`http://localhost:4000/products/${itemId}`);
                        if (res.ok) {
                            const product = await res.json();
                            const price = Number(product.price);
                            const tax = price * 0.06; // 6% tax
                            const total = price + tax;

                            document.getElementById('paymentSubtotal').textContent = `£${price.toFixed(2)}`;
                            document.getElementById('paymentTax').textContent = `£${tax.toFixed(2)}`;
                            document.getElementById('paymentTotal').textContent = `£${total.toFixed(2)}`;
                        }
                    }
                } catch (error) {
                    console.error('Error updating payment summary:', error);
                }
            }

            // Update payment summary when modal opens
            modal1El.addEventListener('show.bs.modal', updatePaymentSummary);
        });
    </script>



    <!-- Razor Pay Code -->
    <script>
        function payNow(productId, isLoggedIn) {
            if (!isLoggedIn) {
                window.location.href = "{{ route('frontend.login') }}";
                return;
            }

            fetch(`/get-payment-details/${productId}`)
                .then(res => res.json())
                .then(data => {
                    const options = {
                        "key": "{{ env('RAZORPAY_KEY') }}",
                        "amount": data.amount * 100,
                        "currency": "INR",
                        "name": data.name,
                        "description": data.description,
                        "image": data.image || '/default.png',
                        "order_id": data.razorpay_order_id,
                        "handler": function(response) {
                            fetch('/payment/success', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        razorpay_payment_id: response.razorpay_payment_id,
                                        razorpay_order_id: response.razorpay_order_id,
                                        razorpay_signature: response.razorpay_signature,
                                        product_id: productId,
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
                                        });
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
@endpush
