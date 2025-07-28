@extends('frontend.layouts.main')
@section('content')

    <body style="padding-right: 0px;">
        <!-- Hero Section Start -->
        <div class="d_main">

            <!-- Offcanvas Mobile Menu -->
            <aside class="d_offcanvas_menu" id="d_offcanvas_menu">
                <button class="close_btn" aria-label="Close Menu">&times;</button>
                <nav>
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link " href="{{ route('index') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('allProducts')}}">Games</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('blog') }}">Blog</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('aboutus')}}">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('frontendcontactus')}}">Contact</a></li>
                    </ul>
                </nav>
                <form class="d_search_form_offcanvas">
                    <input type="search" placeholder="Search games..." />
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
                <div class="d_social_icons_offcanvas">
                    <a href="{{ route('cart') }}" class="active"><i class="fa fa-cart-plus"></i></a>
                    <a href="{{ route('profile', Auth::id()) }}"><i class="fas fa-user-circle"></i></a>
                </div>
            </aside>
        </div>
        <div class="Z_cart_darkbg">
            <div class="Z_cart_hero">
                <div class="Z_cart_hero-overlay">
                    <h1 class="Z_about_title">Your Cart</h1>
                </div>
            </div>
            <!-- Hero Section End -->
            <div class="container py-5">
                <div class="Z_cart_box mx-auto">
                    <div class="Z_cart_table_scroll text-nowrap" style="overflow-x:auto; width:100%; ">
                        <table class="Z_cart_table w-100 mb-0">
                            <thead>
                                <tr>
                                    <th class="Z_cart_th">Product</th>
                                    <th class="Z_cart_th">Category</th>
                                    <th class="Z_cart_th">Price</th>
                                    <th class="Z_cart_th">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td class="Z_cart_td">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="./images/gg1.png" alt="Explore the Firefly" class="Z_cart_img">
                                            <span class="Z_cart_name">Explore the Firefly</span>
                                        </div>
                                    </td>
                                    <td class="Z_cart_td">Action</td>
                                    <td class="Z_cart_td">£35.00</td>
                                    <td class="Z_cart_td text-center">
                                        <button class="Z_cart_removebtn"><i class="fa-solid fa-xmark"></i></button>
                                    </td>
                                </tr> -->
                                <!-- <tr>
                                    <td class="Z_cart_td">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="./images/gg2.png" alt="Danger Zone" class="Z_cart_img">
                                            <span class="Z_cart_name">Danger Zone</span>
                                        </div>
                                    </td>
                                    <td class="Z_cart_td">Adventure</td>
                                    <td class="Z_cart_td">£65.00</td>
                                    <td class="Z_cart_td text-center">
                                        <button class="Z_cart_removebtn"><i class="fa-solid fa-xmark"></i></button>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <div class="row g-2 align-items-center mt-3">
                        <div class="col-md-6">
                            <!-- <form class="d-flex Z_Minput_form">
                                <input type="text" class="form-control Z_Minput_input" placeholder="Coupon code">
                                <button class="Z_Minput_btn ms-md-2 ms-0" type="submit">APPLY COUPON</button>
                            </form> -->
                        </div>
                        <div class="col-md-6 text-md-end mt-2 mt-md-0">
                            <button class="Z_Minput_btn">UPDATE CART</button>
                        </div>
                    </div>
                    <div class="Z_cart_totals mt-4">
                        <div class="Z_cart_totals_title mb-2">Cart totals</div>
                        <!-- <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>£100.00</span>
                        </div> -->
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total</span>
                            <span id="cartTotal">£100.00</span>
                        </div>
                        <div class="text-end mt-3">

                            <button class="Z_cart_btn Z_cart_btnoutline" data-bs-toggle="modal"
                                data-bs-target="#paymentModal">
                                BUY NOW
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        <div class="modal fade" id="paymentModal2" tabindex="-1" aria-labelledby="paymentModalLabel2"
            aria-hidden="true">
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
                                        <div class="col text-end">$124.24</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">Sales tax</div>
                                        <div class="col text-end">$7.45</div>
                                    </div>
                                    <div class="row total">
                                        <div class="col">Total</div>
                                        <div class="col text-end">$131.69</div>
                                    </div>
                                </div>

                                <button class="btn confirm-btn w-100 mt-3">Place your order</button>

                                <div class="terms">Review the <a href="#" class="text-white">terms and
                                        conditions</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('script')
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Logout functionality
            document.querySelectorAll('a').forEach(function(link) {
                if (link.textContent.trim().toLowerCase() === 'logout') {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        localStorage.removeItem('user_id');
                        window.location.href = 'landingpage.html';
                    });
                }
            });
        </script>
        <script>
            // Show first letter of user email in user icon if logged in
            document.addEventListener('DOMContentLoaded', async function() {
                const userId = localStorage.getItem('user_id');
                const userIconDiv = document.getElementById('db_user_icon');
                if (userId && userIconDiv) {
                    try {
                        const res = await fetch(`http://localhost:4000/users/${userId}`);
                        if (res.ok) {
                            const user = await res.json();
                            if (user.email && user.email.length > 0) {
                                userIconDiv.innerHTML =
                                    `<span style="font-size:20px;font-weight:200;display:inline-block;width:2.2rem;height:2.2rem;line-height:2.2rem;text-align:center;background:#ad9d79;color:#fff;border-radius:50%;">${user.email[0].toUpperCase()}</span>`;
                            }
                        }
                    } catch (e) {
                        // fallback: keep icon
                    }
                }
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
            (function() {
                const toggler = document.querySelector('.d_toggler_btn');
                const offcanvas = document.getElementById('d_offcanvas_menu');
                const closeBtn = offcanvas.querySelector('.close_btn');

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

                // Sticky header scroll effect
                window.addEventListener('scroll', () => {
                    const header = document.querySelector('.d_header');
                    if (window.scrollY > 20) {
                        header.classList.add('d_scrolled');
                    } else {
                        header.classList.remove('d_scrolled');
                    }
                });
            })();
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const dbContinueBtn = document.getElementById("db_continue_btn");
                const modal1El = document.getElementById("paymentModal");
                const modal2El = document.getElementById("paymentModal2");

                const modal2 = new bootstrap.Modal(modal2El);

                dbContinueBtn.addEventListener("click", () => {
                    // Properly hide the first modal
                    bootstrap.Modal.getInstance(modal1El)?.hide();

                    // Show the second modal
                    modal2.show();
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
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", async function() {
                // 1. Get user id from localStorage
                const userId = localStorage.getItem('user_id');
                const tbody = document.querySelector(".Z_cart_table tbody");
                tbody.innerHTML = ""; // Clear existing rows

                if (!userId) {
                    tbody.innerHTML =
                        `<tr><td colspan="4" class="text-center text-danger">User not found. Please log in.</td></tr>`;
                    return;
                }

                try {
                    // 2. Fetch the user's cart
                    const cartRes = await fetch(`http://localhost:4000/cart?user_id=${userId}`);
                    if (!cartRes.ok) {
                        throw new Error('Failed to fetch cart');
                    }
                    const carts = await cartRes.json();
                    const cart = carts[0];

                    if (!cart || !cart.products || cart.products.length === 0) {
                        tbody.innerHTML = `<tr><td colspan="4" class="text-center">Your cart is empty.</td></tr>`;
                        document.getElementById('cartTotal').textContent = '£0.00';
                        return;
                    }

                    // 3. Fetch all products and categories
                    const [productsRes, categoriesRes] = await Promise.all([
                        fetch("http://localhost:4000/products"),
                        fetch("http://localhost:4000/categories")
                    ]);

                    if (!productsRes.ok || !categoriesRes.ok) {
                        throw new Error('Failed to fetch products or categories');
                    }

                    const products = await productsRes.json();
                    const categories = await categoriesRes.json();

                    let total = 0; // Add this before the loop
                    let validProductsCount = 0;

                    // 4. Render each product in the cart
                    cart.products.forEach(item => {
                        const product = products.find(p => Number(p.id) === Number(item.pro_id));
                        if (!product) {
                            console.warn(`Product with id ${item.pro_id} not found, skipping...`);
                            return; // skip if product not found
                        }

                        validProductsCount++;

                        // Find category name
                        const category = categories.find(cat => String(cat.id) === String(product.cat_id));
                        const categoryName = category ? category.name : "-";

                        // Add product price to total
                        total += Number(product.price);

                        tbody.innerHTML += `
                <tr>
                    <td class="Z_cart_td">
                        <div class="d-flex align-items-center gap-3">
                            <img src="${product.image}" alt="${product.title}" class="Z_cart_img">
                            <span class="Z_cart_name">${product.title}</span>
                        </div>
                    </td>
                    <td class="Z_cart_td">${categoryName}</td>
                    <td class="Z_cart_td">£${Number(product.price).toFixed(2)}</td>
                    <td class="Z_cart_td text-center">
                        <button class="Z_cart_removebtn" onclick="deleteItem(${item.pro_id})"><i class="fa-solid fa-xmark"></i></button>
                    </td>
                </tr>
            `;
                    });

                    // Check if any valid products were found
                    if (validProductsCount === 0) {
                        tbody.innerHTML = `<tr><td colspan="4" class="text-center">Your cart is empty.</td></tr>`;
                        total = 0;
                    }

                    // After the loop, update the total in the DOM
                    document.getElementById('cartTotal').textContent = `£${total.toFixed(2)}`;
                } catch (err) {
                    console.error('Error loading cart:', err);
                    tbody.innerHTML =
                        `<tr><td colspan="4" class="text-center text-danger">Error loading cart data. Please try again.</td></tr>`;
                    document.getElementById('cartTotal').textContent = '£0.00';
                }
            });

            // Remove from cart function (removes one product from the cart)
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Redirect to allProduct.html when UPDATE CART is clicked
                const updateCartBtn = document.querySelector('.Z_Minput_btn');
                if (updateCartBtn) {
                    updateCartBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        window.location.href = '/allproducts';
                    });
                }
            });
        </script>
        <!-- Place this at the bottom before </body> -->
        <script>
            // Function to handle delete item button click
            async function deleteItem(productId) {
                try {
                    // Store product ID in localStorage under delete_item key
                    localStorage.setItem('delete_item', productId);
                    console.log('Product ID stored in localStorage:', productId);

                    // Get user_id from localStorage
                    const userId = localStorage.getItem('user_id');
                    if (!userId) {
                        alert('User not found. Please log in.');
                        return;
                    }

                    // 1. Get the user's cart
                    const cartRes = await fetch(`http://localhost:4000/cart?user_id=${userId}`);
                    if (!cartRes.ok) {
                        throw new Error('Failed to fetch cart');
                    }
                    const carts = await cartRes.json();
                    const cart = carts[0];

                    if (!cart) {
                        alert('Cart not found for this user.');
                        return;
                    }

                    // 2. Remove the product with matching pro_id from products array
                    const updatedProducts = cart.products.filter(item => Number(item.pro_id) !== Number(productId));

                    // 3. Update the cart using PATCH method to update only products array
                    const updateRes = await fetch(`http://localhost:4000/cart/${cart.id}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            products: updatedProducts
                        })
                    });

                    if (!updateRes.ok) {
                        throw new Error('Failed to update cart');
                    }

                    console.log('Product removed successfully from cart');
                    alert('Product removed from cart successfully!');

                    // Clear delete_item from localStorage
                    localStorage.removeItem('delete_item');

                    // Refresh the page to show updated cart
                    location.reload();

                } catch (error) {
                    console.error('Error deleting product:', error);
                    alert('Error removing product from cart: ' + error.message);
                }
            }
        </script>

    </body>
@endpush
