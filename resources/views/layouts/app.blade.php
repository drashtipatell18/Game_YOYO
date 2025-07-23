<!DOCTYPE html>
<html lang="en">

<head>
    <title> Game Ecommerce</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Game Ecommerce">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">
</head>
<style>
    .app-footer.fixed-footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        background-color: #f8f9fa;
        /* Add background color */
        border-top: 1px solid #dee2e6;
        /* Optional: add border */
        z-index: 1000;
        /* Ensure footer stays on top */
    }

    /* Important: Add padding to body to prevent content from being hidden */
    body {
        padding-bottom: 80px;
        /* Adjust based on your footer height */
    }

    .form-control {
        padding: 7px !important;
    }

    .btn:hover {
        color: var(--bs-btn-hover-color);
        background-color: black !important;
        border-color: var(--bs-btn-hover-border-color);
    }

    .table th,
    .table td {
        text-align: center;
        /* Center align text */
    }

    .table img {
        border-radius: 50%;
        /* Make images circular */
    }

    .table-responsive {
        overflow-x: clip !important;
        -webkit-overflow-scrolling: touch;
    }


    .box-design {
        padding: 8px !important;
        border-radius: inherit !important;
        color: white;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5rem 1rem;
        margin: 0 0.1rem;
        border-radius: 0.25rem;
        border: 1px solid #8A775A;
        color: #8A775A;
        cursor: pointer;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #8A775A;
        color: white;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #8A775A;
        color: white;
    }

    /* Search input styles */
    .dataTables_wrapper .dataTables_filter input {
        margin-left: 0.5rem;
        border-radius: 0.25rem;
        border: 1px solid #ced4da;
        padding: 0.375rem 0.75rem;
    }

    /* Active navigation styles */
    .app-nav .nav-link.active {
        background-color: #8A775A !important;
        color: white !important;
        border-radius: 0.375rem;
    }

    .app-nav .nav-link.active:hover {
        background-color: #8A775A !important;
        color: white !important;
    }

    .app-nav .sub-menu .nav-link.active {
        background-color: #f8f9fa !important;
        color: #000 !important;
        border-left: 3px solid #000;
        padding-left: 1.5rem;
    }

    .app-nav .sub-menu .nav-link.active:hover {
        background-color: #e9ecef !important;
        color: #8A775A !important;
    }

    /* Collapsed menu active state */
    .app-nav .nav-link.collapsed.active {
        background-color: #8A775A !important;
        color: white !important;
    }

    .app-nav .nav-link.collapsed.active:hover {
        background-color: #333 !important;
        color: white !important;
    }
</style>

<body class="app">
    <header class="app-header fixed-top">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                    viewBox="0 0 30 30" role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                        stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div>
                        <!--//col-->
                        <div class="search-mobile-trigger d-sm-none col">
                            <i class="search-mobile-trigger-icon fa-solid fa-magnifying-glass"></i>
                        </div>
                        <!--//col-->
                        <div class="app-search-box col">
                            <form class="app-search-form">
                                <input type="text" placeholder="Search..." name="search"
                                    class="form-control search-input">
                                <button type="submit" class="btn search-btn btn-primary" value="Search"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </div>
                        <!--//app-search-box-->
                        <div class="app-utilities col-auto">

                            <div class="app-utility-item app-user-dropdown dropdown">
                                <a class="dropdown-toggle d-flex align-items-center" id="user-dropdown-toggle"
                                    data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                    <img src="{{ Auth::user()->image ? asset('images/users/' . Auth::user()->image) : asset('assets/images/user.png') }}"
                                        alt="User Profile"
                                        style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; margin-right: 8px;">
                                    <span>{{ Auth::user()->name }}</span>
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Log Out
                                        </a></li>
                                </ul>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                            <!--//app-user-dropdown-->
                        </div>
                        <!--//app-utilities-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-header-content-->
            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-header-inner-->
        <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
                <div class="app-branding d-flex justify-content-center">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="logo-icon me-2">
                </div>
                <!--//app-branding-->
                <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                        <li class="nav-item">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">
                                <span class="nav-icon">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                                        <path fill-rule="evenodd"
                                            d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                            <!--//nav-link-->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('users*') ? 'active' : '' }}"
                                href="{{ route('users') }}">
                                <span class="nav-icon">
                                    <i class="fa-solid fa-users"></i>
                                </span>
                                <span class="nav-link-text">Users</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category') }}">
                                <span class="nav-icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <span class="nav-link-text">Category</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contactUs') }}">
                                <span class="nav-icon">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <span class="nav-link-text">Contact US</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('our_teams') }}">
                                <span class="nav-icon">
                                    <i class="fa-solid fa-people-group"></i>
                                </span>
                                <span class="nav-link-text">Our Teams</span>
                            </a>
                        </li>

                        <!--//nav-item-->
                    </ul>
                    <!--//app-menu-->
                </nav>

            </div>
            <!--//sidepanel-inner-->
        </div>
        <!--//app-sidepanel-->
    </header>
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            @yield('content')
        </div><!--//app-content-->

        <footer class="app-footer fixed-footer">
            <div class="container text-center py-3 font-size:16px">
                <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
                <span class="text-muted text-center" style="font-weight: bold; font-size:16px">
                    Copyright © 2025.
                    <a style="font-weight: bold; font-size:16px; text-decoration: none;"
                        href="https://kalathiyainfotech.com/" target="_blank">Kalathiya Infotech</a>
                </span>
            </div>
        </footer>

    </div><!--//app-wrapper-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Javascript -->
    <script src="{{ asset('assets/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Charts JS -->
    <script src="{{ asset('assets/plugins/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/index-charts.js') }}"></script>

    <!-- Page Specific JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @stack('scripts')
</body>

</html>
