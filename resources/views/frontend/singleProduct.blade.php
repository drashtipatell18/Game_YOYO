@extends('frontend.layouts.main')
@section('content')

    <!-- x_game-product-section START -->
    <section class="x_game-shop a_header_container">
        <div class=" x_game-product-section py-5">
            <div class="x_space">

                 <div class="row">
                    <!-- Thumbnails -->
                    <div class="col-md-1 d-none d-md-flex flex-column align-items-center x_thumb-list">
                    @if(isset($product['images']) && !empty($product['images']))
                        @php
                            // Handle if images is a JSON string or array
                            $images = is_string($product['images']) ? json_decode($product['images'], true) : $product['images'];
                            $images = is_array($images) ? $images : [$product['images']];
                        @endphp
                        
                        @foreach($images as $index => $image)
                            <img src="{{ asset('storage/' . $image) }}" 
                                 class="img-fluid mb-3 x_thumb-img {{ $index === 0 ? 'active' : '' }}" 
                                 alt="thumb{{ $index + 1 }}" 
                                 onclick="changeMainImage('{{ asset('storage/' . $image) }}', this)"
                                 style="cursor: pointer; border: {{ $index === 0 ? '2px solid #007bff' : '1px solid #ddd' }};">
                        @endforeach
                    @elseif(isset($product['image']) && !empty($product['image']))
                        <!-- Single image fallback -->
                        <img src="{{ asset('storage/' . $product['image']) }}" 
                             class="img-fluid mb-3 x_thumb-img active" 
                             alt="thumb1"
                             style="border: 2px solid #007bff;">
                    @else
                        <!-- Default images if no images available -->
                        <img src="{{ asset('images/gg1.png') }}" class="img-fluid mb-3 x_thumb-img active" alt="thumb1" onclick="changeMainImage('{{ asset('images/gg1.png') }}', this)" style="cursor: pointer; border: 2px solid #007bff;">
                        <img src="{{ asset('images/gg2.png') }}" class="img-fluid mb-3 x_thumb-img" alt="thumb2" onclick="changeMainImage('{{ asset('images/gg2.png') }}', this)" style="cursor: pointer; border: 1px solid #ddd;">
                        <img src="{{ asset('images/gg3.png') }}" class="img-fluid x_thumb-img" alt="thumb3" onclick="changeMainImage('{{ asset('images/gg3.png') }}', this)" style="cursor: pointer; border: 1px solid #ddd;">
                    @endif
                </div>
                
                    
                    <!-- Main Image -->
                    <div class="col-md-5 text-center x_main-img-wrap">
                        <img src="{{ $product['image'] ?? './images/gg1.png' }}" 
                             class="img-fluid x_main-img" 
                             alt="{{ $product['name'] ?? 'Product Image' }}"
                             id="mainProductImage">
                    </div>
                    
                    <!-- Product Info -->
                    <div class="col-md-6 x_product-info text-white">
                        <div class="x_shop_info mt-3 mt-sm-0">
                            <h2 class="x_product-title">{{ $product['name'] ?? 'Unknown Product' }}</h2>
                            <div class="x_product-price mb-3">
                                ${{ number_format($product['price'] ?? 0, 2) }}
                            </div>
                            
                            @if(isset($product['description']))
                                <div class="x_product-description mb-3">
                                    <p>{{ $product['description'] }}</p>
                                </div>
                            @endif
                            
                            <div class="d-flex align-items-center mb-3">
                                <button class="btn btn-outline-light x_add-cart-btn px-md-4 px-3 me-3"
                                        data-bs-toggle="modal" data-bs-target="#paymentModal">
                                    BUY NOW
                                </button>

                                <button class="btn btn-outline-light x_add-cart-btn px-md-4 px-3"
                                        onclick="addToCart({{ $product['id'] ?? 0 }})">
                                    ADD TO CART
                                </button>
                            </div>
                            
                            <div class="x_product-meta x_line_tb mb-2">
                                <div>SKU: {{ $product['sku'] ?? $product['id'] ?? '000' }}</div>
                                <div>Category: {{ $product['category_name'] ?? 'Games' }}</div>
                                @if(isset($product['tags']))
                                    <div>Tags: {{ is_array($product['tags']) ? implode(', ', $product['tags']) : $product['tags'] }}</div>
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
                                    data-bs-target="#reviews" type="button" role="tab">Reviews (0)</button>
                            </li>
                        </ul>
                        <div class="tab-content x_tab-content p-4 bg-opacity-75" id="x_productTabContent">
                            <div class="tab-pane fade show active" id="desc" role="tabpanel">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean commodo ligula eget
                                dolor.
                                Aenean massa. Cum sociis Theme natoque penatibus et magnis dis parturient montes,
                                nascetur
                                ridiculus mus. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                Phasellus
                                viverra nulla ut metus varius laoreet. Quisque rutrum.
                            </div>
                            <div class="tab-pane fade" id="addinfo" role="tabpanel">
                                <div class="x_additional-info">
                                    <h5 class="mb-3">Additional information</h5>
                                    <div class="row mb-2">
                                        <div class="col-4 col-md-2">Weight</div>
                                        <div class="col-8 col-md-10">0.100 kg</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 col-md-2">Dimensions</div>
                                        <div class="col-8 col-md-10">30 × 15 × 3 cm</div>
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
                                    <form class="x_review-form">
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
                                            <textarea class="form-control bg-transparent text-white border-secondary"
                                                id="review" rows="4"></textarea>
                                            <div class="invalid-feedback d-block x_review-error" style="display:none;">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name *</label>
                                            <input type="text"
                                                class="form-control bg-transparent text-white border-secondary"
                                                id="name">
                                            <div class="invalid-feedback d-block x_name-error" style="display:none;">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email *</label>
                                            <input type="email"
                                                class="form-control bg-transparent text-white border-secondary"
                                                id="email">
                                            <div class="invalid-feedback d-block x_email-error" style="display:none;">
                                            </div>
                                        </div>
                                        <div class="form-check promo-code  checkbox-item mb-3 p-0  ">
                                            <!-- <input class="form-check-input" type="checkbox" id="saveInfo"> -->
                                            <div class="custom-checkbox"></div>
                                            <label class="form-check-label" for="saveInfo">
                                                Save my name, email, and website in this browser for the next time I
                                                comment.
                                            </label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="x_btn btn btn-outline-light mx-auto">SUBMIT</button>
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

                            <div class="terms">Review the <a href="#" class="text-white">terms and conditions</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script>
        // Image thumbnail click to main image swap
        $(document).ready(function () {
            $('.x_thumb-img').on('click', function () {
                var newSrc = $(this).attr('src');
                $('.x_main-img').attr('src', newSrc);
                $('.x_thumb-img').removeClass('active');
                $(this).addClass('active');
            });
            // Set first thumb as active on load
            $('.x_thumb-img').first().addClass('active');

            // Star rating click
            $('.x_rating-stars i').on('click', function () {
                var index = $(this).index();
                $('.x_rating-stars i').each(function (i) {
                    if (i <= index) {
                        $(this).removeClass('fa-regular').addClass('fa-solid');
                    } else {
                        $(this).removeClass('fa-solid').addClass('fa-regular');
                    }
                });
                // Store rating value
                $('.x_review-form').data('rating', index + 1);
            });

            // Review form validation
            $('.x_review-form').on('submit', function (e) {
                var valid = true;
                var rating = $(this).data('rating') || 0;
                var review = $('#review').val().trim();
                var name = $('#name').val().trim();
                var email = $('#email').val().trim();
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                // Reset errors
                $('.x_rating-error, .x_review-error, .x_name-error, .x_email-error').hide().text("");
                $('#review, #name, #email').removeClass('is-invalid');
                $('.x_rating-stars').removeClass('is-invalid');
                // Validate fields
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
                if (!valid) {
                    e.preventDefault();
                }
            });


        });
    </script>
    <script>
        const dbUserIcon = document.getElementById('db_user_icon');
        const dbUserDropdown = document.getElementById('db_user_dropdown');

        dbUserIcon.addEventListener('click', (e) => {
            e.stopPropagation();
            dbUserDropdown.style.display = dbUserDropdown.style.display === 'block' ? 'none' : 'block';
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            dbUserDropdown.style.display = 'none';
        });
    </script>
    <script>
        // Example cards data (replace with your real data if needed)
        const cardsData = [
            { id: 1, title: "The Elder Scrolls V Skyrim", price: "$144.00", image: "/images/card_img1.png" },
            { id: 2, title: "Grand Theft Auto V", price: "$89.99", image: "/images/card_img2.png" },
            { id: 3, title: "Call of Duty: Modern Warfare", price: "$129.00", image: "/images/card_img3.png" },
            { id: 4, title: "FIFA 24", price: "$99.99", image: "/images/card_img4.png" },
            { id: 5, title: "Assassin's Creed Valhalla", price: "$79.99", image: "/images/card_img5.png" },
            { id: 6, title: "Cyberpunk 2077", price: "$159.99", image: "/images/card_img6.png" }
        ];

        function renderSwiperCards() {
            const swiperCards = document.getElementById('swiperCards');
            swiperCards.innerHTML = cardsData.map(card => `
                <div class="swiper-slide d-flex justify-content-center">
                    <div class="game-card position-relative" data-id="${card.id}" style="cursor: pointer;">
                        <img src="${card.image}" alt="${card.title}" class="card-img-top" />
                        <div class="position-absolute card-content">
                            <div class="icons d-flex gap-2 mb-3">
                                <i class="fa-brands fa-apple"></i>
                                <i class="fa-brands fa-windows"></i>
                            </div>
                            <h3>${card.title}</h3>
                            <h3 class="mb-0">${card.price}</h3>
                        </div>
                        <div class="card-actions d-flex align-items-center gap-3 ">
                            <div class="d_main_button w-100">
                                <button class="custom-cart-btn w-100" data-id="${card.id}">ADD TO CART</button>
                                <div class="d_border"></div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            `).join('');

            // Add click event listeners to slider cards
            document.querySelectorAll('.game-card').forEach(card => {
                card.addEventListener('click', function (e) {
                    // Don't trigger if clicking on ADD TO CART button
                    if (e.target.closest('.custom-cart-btn')) {
                        return;
                    }

                    const productId = this.getAttribute('data-id');
                    localStorage.setItem('item_id', productId);
                    window.location.href = 'singleProduct.html';
                });
            });

            // Add click event listeners to ADD TO CART buttons
            document.querySelectorAll('.custom-cart-btn').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.stopPropagation(); // Prevent card click
                    const productId = this.getAttribute('data-id');
                    addToCartFromSlider(productId);
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
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
                    0: { slidesPerView: 1 },
                    576: { slidesPerView: 2 },
                    768: { slidesPerView: 3 },
                    1024: { slidesPerView: 3 },
                    1200: { slidesPerView: 4 },
                    1400: { slidesPerView: 4 },
                    1600: { slidesPerView: 5 },
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const promoCheckbox = document.querySelector(".promo-code");

            promoCheckbox.addEventListener("click", function () {
                promoCheckbox.classList.toggle("active");
            });
        });
    </script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const itemId = localStorage.getItem('item_id');
            if (!itemId) {
                alert('No product selected!');
                window.location.href = 'allProduct.html'; // fallback
                return;
            }
            try {
                const res = await fetch(`http://localhost:4000/products/${itemId}`);
                if (!res.ok) throw new Error('Product not found');
                const product = await res.json();

                // Fill product details
                document.querySelector('.x_product-title').textContent = product.title;
                document.querySelector('.x_product-price').textContent = `£${product.price}`;
                document.querySelector('.x_main-img').src = product.image;
                // If you want to update thumbnails, do it here as well

                // Fill description tab
                document.getElementById('desc').textContent = product.description;

                // Optionally fill other fields (category, tags, etc.)
                // document.querySelector('.x_product-meta').innerHTML = ...;

            } catch (e) {
                alert('Error loading product');
                window.location.href = 'allProduct.html';
            }
        });
    </script>
    <script>
        // Function to add product to cart
        async function addToCart() {
            try {
                // Get user_id from localStorage
                const userId = localStorage.getItem('user_id');
                if (!userId) {
                    alert('Please log in to add items to cart');
                    window.location.href = './auth/Login.html';
                    return;
                }

                // Get product ID from localStorage
                const productId = localStorage.getItem('item_id');
                if (!productId) {
                    alert('No product selected!');
                    return;
                }

                console.log('Adding product ID:', productId, 'to cart for user ID:', userId);

                // 1. Check if user already has a cart
                const cartRes = await fetch(`http://localhost:4000/cart?user_id=${userId}`);
                if (!cartRes.ok) {
                    throw new Error('Failed to fetch cart');
                }
                const carts = await cartRes.json();
                let cart = carts[0];

                // 2. If no cart exists, create a new one
                if (!cart) {
                    const newCartRes = await fetch('http://localhost:4000/cart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            user_id: Number(userId),
                            products: [{
                                pro_id: Number(productId),
                                quantity: 1
                            }]
                        })
                    });

                    if (!newCartRes.ok) {
                        throw new Error('Failed to create cart');
                    }

                    cart = await newCartRes.json();
                    console.log('New cart created:', cart);
                } else {
                    // 3. If cart exists, check if product is already in cart
                    const existingProduct = cart.products.find(item => Number(item.pro_id) === Number(productId));

                    if (existingProduct) {
                        // Product already exists, increase quantity
                        existingProduct.quantity += 1;
                    } else {
                        // Add new product to cart
                        cart.products.push({
                            pro_id: Number(productId),
                            quantity: 1
                        });
                    }

                    // 4. Update the existing cart
                    const updateRes = await fetch(`http://localhost:4000/cart/${cart.id}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            products: cart.products
                        })
                    });

                    if (!updateRes.ok) {
                        throw new Error('Failed to update cart');
                    }

                    console.log('Cart updated successfully');
                }

                alert('Product added to cart successfully!');

                // Optionally redirect to cart page
                // window.location.href = './Cart.html';

            } catch (error) {
                console.error('Error adding to cart:', error);
                alert('Error adding product to cart: ' + error.message);
            }
        }

        // Function to add product to cart from slider
        async function addToCartFromSlider(productId) {
            try {
                // Get user_id from localStorage
                const userId = localStorage.getItem('user_id');
                if (!userId) {
                    alert('Please log in to add items to cart');
                    window.location.href = './auth/Login.html';
                    return;
                }

                console.log('Adding product ID:', productId, 'to cart for user ID:', userId);

                // 1. Check if user already has a cart
                const cartRes = await fetch(`http://localhost:4000/cart?user_id=${userId}`);
                if (!cartRes.ok) {
                    throw new Error('Failed to fetch cart');
                }
                const carts = await cartRes.json();
                let cart = carts[0];

                // 2. If no cart exists, create a new one
                if (!cart) {
                    const newCartRes = await fetch('http://localhost:4000/cart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            user_id: Number(userId),
                            products: [{
                                pro_id: Number(productId),
                                quantity: 1
                            }]
                        })
                    });

                    if (!newCartRes.ok) {
                        throw new Error('Failed to create cart');
                    }

                    cart = await newCartRes.json();
                    console.log('New cart created:', cart);
                } else {
                    // 3. If cart exists, check if product is already in cart
                    const existingProduct = cart.products.find(item => Number(item.pro_id) === Number(productId));

                    if (existingProduct) {
                        // Product already exists, increase quantity
                        existingProduct.quantity += 1;
                    } else {
                        // Add new product to cart
                        cart.products.push({
                            pro_id: Number(productId),
                            quantity: 1
                        });
                    }

                    // 4. Update the existing cart
                    const updateRes = await fetch(`http://localhost:4000/cart/${cart.id}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            products: cart.products
                        })
                    });

                    if (!updateRes.ok) {
                        throw new Error('Failed to update cart');
                    }

                    console.log('Cart updated successfully');
                }

                alert('Product added to cart successfully!');

            } catch (error) {
                console.error('Error adding to cart:', error);
                alert('Error adding product to cart: ' + error.message);
            }
        }
    </script>
    <script>
        // Payment modal functionality
        document.addEventListener("DOMContentLoaded", function () {
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
                promoCheckbox.addEventListener("click", function () {
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
    @endpush