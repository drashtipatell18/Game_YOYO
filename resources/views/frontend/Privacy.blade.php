@extends('frontend.layouts.main')
@section('content')
    <section class="xs_contact-hero-section">
        <div class="xs_contact-hero-overlay">
            <div class="container text-center py-5">
                <h1 class="contact-hero-title">Privacy Policy</h1>
                <a href="{{ route('index') }}" class="text-decoration-none text-white">
                    <span>Home</span>
                </a> <span class="mx-2">/</span> <span class="active">Privacy Policy</span>
                </nav>
            </div>
        </div>
    </section>

    <!-- x_game-product-section START -->
    <section class="x_privacy a_header_container">
        <div>
            <div class="x_space">
                <div class="x_privacy-content bg-opacity-75 p-4">
                    <p>At <strong>YOYO Khel Web</strong>, your privacy is important to us. This Privacy Policy explains how
                        we collect, use, disclose, and safeguard your information.
                        By using our site or services, you agree to the terms of this Privacy Policy. If you do not agree
                        with these terms, please do not use our website or games.</p>

                    <h4>1. Information We Collect</h4>
                    <ul>
                        <strong>a. Personal Information (if voluntarily submitted):</strong>
                        {{-- <ul> --}}
                            <li>Name</li>
                            <li>Email address (for support, newsletters, or accounts)</li>
                        {{-- </ul> --}}

                        <strong>b. Non-Personal Information:</strong>
                        {{-- <ul> --}}
                            <li>IP address</li>
                            <li>Browser type</li>
                            <li>Device information</li>
                            <li>Game scores or in-game activity</li>
                            <li>Cookies and usage data</li>
                        {{-- </ul> --}}
                    </ul>

                    <h4>2. How We Use Your Information</h4>
                    <ul>
                        <li>Providing and maintaining our games and website</li>
                        <li>Improving gameplay and user experience</li>
                        <li>Communicating with users (support or promotional emails)</li>
                        <li>Analyzing trends and usage</li>
                        <li>Detecting and preventing fraud</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
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
@endpush
