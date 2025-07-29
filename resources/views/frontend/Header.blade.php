    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title', 'YoYo Games')</title>
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
            color: red; /* Change the color to red */
            font-size: 0.875em; /* Optional: Adjust the font size */
            margin-top: 0.25em; /* Optional: Add some space above the error message */
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
            background-color: #28a745 !important; /* Bootstrap success green */
            color: #fff !important;
        }
    </style>

    <body>
        <div class="d_main">
            <!-- Header -->
            <header class="d_header d-flex align-items-center justify-content-between">
                <div class="d_logo">
                    <img src="{{ asset('frontend/images/yoyo logo done.png') }}" style="padding: 7px; height: 60px;"
                        alt="logo" class="img-fluid">
                </div>

                <!-- Desktop Nav -->
                <nav class="d_navbar navbar navbar-expand-lg d-none d-lg-flex">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link active" href="{{ route('index') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('allProducts') }}">Games</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('blogfronted') }}">Blog</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('aboutus') }}">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('frontendcontactus') }}">Contact</a>
                        </li>
                    </ul>

                    <form class="d_search_form ">
                        <input type="search" placeholder="Search games..." />
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>

                    <div class="d_social_icons me-3">
                        <a href="{{ route('cart') }}"><i class="fa fa-cart-plus"></i></a>
                    </div>

                    <div class="d_user_icon_wrapper position-relative">
                        <div class="d_user_icon" id="db_user_icon" title="User Profile">
                            @if (Auth::check())
                                <div class="user-initial">
                                    {{ strtoupper(Auth::user()->name[0]) }}
                                </div>
                            @else
                                <i class="fas fa-user-circle"></i>
                            @endif
                        </div>



                        <div class="d_user_dropdown" id="db_user_dropdown">
                            <ul>
                                <li><a href="{{ route('frontend.login') }}">Sign in</a></li>
                                <li><a href="{{ route('profile', Auth::id()) }}">Profile</a></li>
                                <li><a href="{{ route('frontlogout')}}">Logout</a></li>
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
                        <li class="nav-item"><a class="nav-link active" href="{{ route('index') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('allProducts') }}">Games</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('blog') }}">Blog</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('aboutus') }}">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('frontendcontactus') }}">Contact</a>
                        </li>
                    </ul>
                </nav>
                <form class="d_search_form_offcanvas">
                    <input type="search" placeholder="Search games..." />
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
                <div class="d_social_icons_offcanvas">
                    <a href="{{ route('cart') }}"><i class="fa fa-cart-plus"></i></a>
                    <a href="{{ route('profile', Auth::id()) }}"><i class="fas fa-user-circle"></i></a>
                </div>
            </aside>
        </div>

    </body>

    </html>
