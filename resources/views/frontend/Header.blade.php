<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'YOYO Khel')</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend/css/d_style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/s_style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/z_style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/x_style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/checkout.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/card.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
</head>
<style>
    .offcanvas {
        --bs-offcanvas-width: 350px;
        background-color: #1a1a1a;
    }

    .error {
        color: red;
        /* Change the color to red */
        font-size: 0.875em;
        /* Optional: Adjust the font size */
        margin-top: 0.25em;
        /* Optional: Add some space above the error message */
    }

    @media (max-width: 991px) {
        .a_header_container {
            padding: 0px 8% !important;
        }
    }

    @media (max-width:375px) {
        .offcanvas {
            --bs-offcanvas-width: 300px;
        }
    }

    @media (max-width:320px) {
        .offcanvas {
            --bs-offcanvas-width: 280px;
        }
    }

    .user-initial {
        background-color: #444;
        color: white;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 16px;
    }

    .game-card {
        cursor: pointer;
    }

    .swal2-success-toast {
        background-color: #28a745 !important;
        /* Bootstrap success green */
        color: #fff !important;
    }

    .Z_about_card_desc {
        word-wrap: break-word;
        /* Allows long words to wrap */
        word-break: break-word;
        /* Breaks words if necessary */
        white-space: normal;
        /* Ensures text wraps normally */
    }

    .btn_gem {
        background-color: #8a775a;
        border: 1px solid #8a775a;
        border-radius: 20px;
        color: #fff;
        padding: 5px 20px;
        text-decoration: none
    }

    .badge-container {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        align-items: center;
    }

    /* USD badge with gradient */
    .usd-badge {
        background: linear-gradient(135deg, rgb(94, 77, 58), rgb(138, 119, 90));
        color: white;
        padding: 6px 10px;
        border-radius: 5px;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-block;
    }

    .d_search_form {
        position: relative;
        display: inline-block;
    }

    #suggestions {
        display: none;
        cursor: default;
        width: 99%;
        max-height: 300px;
        overflow-y: auto;
        list-style-type: none;
        padding: 0;
        margin: 0;
        border: 1px solid #ccc;
        position: absolute;
        background: #8a775a;
        z-index: 1000;
    }

    #suggestions li {
        padding: 8px;
        cursor: pointer;
    }

    #suggestions li:hover {
        background-color: #000000;
    }
    #suggestionsmoblie {
        display: none;
        cursor: default;
        width: 99%;
        max-height: 300px;
        overflow-y: auto;
        list-style-type: none;
        padding: 0;
        margin: 0;
        border: 1px solid #ccc;
        position: absolute;
        background: #8a775a;
        z-index: 1000;
    }

    #suggestionsmoblie li {
        padding: 8px;
        cursor: pointer;
    }

    #suggestionsmoblie li:hover {
        background-color: #000000;
    }
</style>

<body>
    <div class="d_main">
        <!-- Header -->
        <header class="d_header d-flex align-items-center justify-content-between">
            <a href="{{ route('index') }}">
                <img src="{{ asset('frontend/images/yoyo logo done.png') }}" style="padding: 7px; height: 60px;"
                    alt="logo" class="img-fluid">
            </a>

            <!-- Desktop Nav -->
            <nav class="d_navbar navbar navbar-expand-lg d-none d-lg-flex">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}"
                            href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('allProducts') ? 'active' : '' }}"
                            href="{{ route('allProducts') }}">Games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blogfronted') ? 'active' : '' }}"
                            href="{{ route('blogfronted') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutus') ? 'active' : '' }}"
                            href="{{ route('aboutus') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('frontendcontactus') ? 'active' : '' }}"
                            href="{{ route('frontendcontactus') }}">Contact</a>
                    </li>
                </ul>


                <form class="d_search_form" method="GET">
                    <!-- @csrf would go here in Laravel -->
                    <input type="search" placeholder="Search games..." id="search" name="search" />
                    <button type="submit"><i class="fas fa-search"></i></button>
                    <ul id="suggestions"></ul>
                </form>

                <div class="d_social_icons me-3">
                    <a href="{{ route('cart') }}"><i class="fa fa-cart-plus"></i></a>
                </div>

                <div class="d_user_icon_wrapper position-relative">
                    <div class="d_user_icon" id="db_user_icon" title="User Profile">
                        @auth
                            <div class="user-initial">
                                {{ strtoupper(Auth::user()->name[0]) }}
                            </div>
                        @else
                            <i class="fas fa-user-circle"></i>
                        @endauth
                    </div>



                    <div class="d_user_dropdown" id="db_user_dropdown">
                        <ul>
                            @guest
                                <li><a href="{{ route('frontend.login') }}">Sign in</a></li>
                            @endguest

                            @if (Auth::check())
                                <li><a href="{{ route('profile', Auth::id()) }}">Profile</a></li>
                                <li><a href="{{ route('frontlogout') }}">Logout</a></li>
                            @endif

                        </ul>
                    </div>
                </div>

            </nav>

            <!-- Mobile Toggler -->
            <button class="d_toggler_btn d-lg-none" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
        </header>

        <!-- Offcanvas Mobile Menu -->
        <aside class="d_offcanvas_menu" id="d_offcanvas_menu">
            <button class="close_btn" aria-label="Close Menu">&times;</button>
            <nav>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}"
                            href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('allProducts') ? 'active' : '' }}"
                            href="{{ route('allProducts') }}">Games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blogfronted') ? 'active' : '' }}"
                            href="{{ route('blogfronted') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutus') ? 'active' : '' }}"
                            href="{{ route('aboutus') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('frontendcontactus') ? 'active' : '' }}"
                            href="{{ route('frontendcontactus') }}">Contact</a>
                    </li>
                </ul>
            </nav>
             <form class="d_search_form" method="GET">
                    <!-- @csrf would go here in Laravel -->
                    <input type="search" placeholder="Search games..." id="searchmoblie" name="searchmoblie" />
                    <button type="submit"><i class="fas fa-search"></i></button>
                    <ul id="suggestions"></ul>
                </form>
            <div class="d_social_icons_offcanvas">
                <a href="{{ route('cart') }}"><i class="fa fa-cart-plus"></i></a>
                <a href="{{ route('profile', Auth::id()) }}"><i class="fas fa-user-circle"></i></a>
            </div>
        </aside>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Prevent form submission on Enter for both search inputs
   $('#search, #searchmoblie').on('keypress', function (event) {
        if (event.which === 13) {
            event.preventDefault();
            const query = $(this).val().trim();
            if (query.length > 1) {
                window.location.href = '/allproducts?search=' + encodeURIComponent(query);
            }
        }
    });

    let searchResults = [];  // store results globally

    // Handle keyup on main search input
    $('#search').on('keyup', function() {
        let query = $(this).val().trim();

        if (query.length > 1) {
            $.ajax({
                url: "/search-products",
                method: "GET",
                data: { search: query },
                success: function(data) {
                    searchResults = data;  // store search data

                    let suggestions = '';
                    if (data.length) {
                        suggestions = data.map(item =>
                            `<li class="suggestion-item" data-id="${item.id}" style="cursor:pointer;">${item.name}</li>`
                        ).join('');
                    } else {
                        suggestions = '<li style="text-align: center; list-style: none;">No results found</li>';
                    }
                    $('#suggestions').html(suggestions).show();
                },
                error: function(xhr, status, error) {
                    console.log('Search error:', error);
                    $('#suggestions').hide();
                }
            });
        } else {
            $('#suggestions').hide();
        }
    });

    // Handle click on suggestion item (desktop)
    $(document).on('click', '#suggestions .suggestion-item', function() {
        const id = $(this).data('id');
        const name = $(this).text();

        if (!id) return;

        // Hide suggestions dropdown after click
        $('#suggestions').hide();

        // Set the clicked name in the search input
        $('#search').val(name);

        // Find clicked product in cached search results
        const product = searchResults.find(p => p.id === id);
        if (product) {
            renderSingleProduct(product);
        } else {
            // Optional: fetch full product data from server if not found
            $.ajax({
                url: '/',
                method: 'GET',
                data: { id: id },
                success: function(productData) {
                    renderSingleProduct(productData);
                },
                error: function() {
                    alert('Failed to load product details.');
                }
            });
        }
    });

    // $(document).on('click', '#suggestions .suggestion-item', function() {
    //     const name = $(this).text().trim();

    //     if (name) {
    //         // Redirect to allproducts page with search query
    //         window.location.href = '/allproducts?search=' + encodeURIComponent(name);
    //     }
    // });



    // Handle keyup on mobile search input
    $('#searchmoblie').on('keyup', function() {
        let query = $(this).val().trim();

        if (query.length > 1) {
            $.ajax({
                url: "/search-products",
                method: "GET",
                data: { search: query },
                success: function(data) {
                    searchResults = data;

                    let suggestions = '';
                    if (data.length) {
                        suggestions = data.map(item =>
                            `<li class="suggestion-item" data-id="${item.id}" style="cursor:pointer;">${item.name}</li>`
                        ).join('');
                    } else {
                        suggestions = '<li style="text-align: center; list-style: none;">No results found</li>';
                    }
                    $('#suggestionsmoblie').html(suggestions).show();
                },
                error: function() {
                    $('#suggestionsmoblie').hide();
                }
            });
        } else {
            $('#suggestionsmoblie').hide();
        }
    });

    // Handle click on suggestion item (mobile)
    $(document).on('click', '#suggestionsmoblie .suggestion-item', function() {
        const id = $(this).data('id');
        const name = $(this).text();

        if (!id) return;

        $('#suggestionsmoblie').hide();
        $('#searchmoblie').val(name);

        // Optionally render product or redirect
        const product = searchResults.find(p => p.id === id);
        if (product) {
            renderSingleProduct(product);
        } else {
            $.ajax({
                url: '/get-product',
                method: 'GET',
                data: { id: id },
                success: function(productData) {
                    renderSingleProduct(productData);
                },
                error: function() {
                    alert('Failed to load product details.');
                }
            });
        }
    });

    // Hide suggestions when clicking outside for desktop and mobile
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.d_search_form').length) {
            $('#suggestions').hide();
            $('#suggestionsmoblie').hide();
        }
    });

    // Render a single product card in #gridContainer
    function renderSingleProduct(product) {
        const gridContainer = $('#gridContainer');
        gridContainer.empty();

        const firstImage = (product.image && typeof product.image === 'string')
            ? product.image.split(',')[0].trim()
            : 'default.jpg';

        const categoryName = product.category_name || "Unknown";
        const productPrice = parseFloat(product.price).toFixed(2);

        const cardHtml = `
            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 mb-4 d-flex justify-content-center">
                <div class="game-card position-relative" data-id="${product.id}">
                    <img src="${firstImage}" alt="${product.name}" class="card-img-top" />
                    <div class="position-absolute card-content">
                        <h3>${product.name}</h3>
                        <h3 class="mb-0">$${productPrice} <span class="badge usd-badge">USD</span></h3>
                        <span class="badge bg-secondary mt-2">${categoryName}</span>
                    </div>
                    <div class="card-actions d-flex align-items-center gap-3">
                        <div class="d_main_button w-100">
                            <button class="custom-cart-btn w-100" data-id="${product.id}">ADD TO CART</button>
                            <div class="d_border"></div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        gridContainer.append(cardHtml);
    }
});
</script>


</html>
