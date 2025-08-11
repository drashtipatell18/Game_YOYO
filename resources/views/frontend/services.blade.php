@extends('frontend.layouts.main')
<style>
    .text-theme {
        color: #ad9d79 !important;
        /* your website’s gold theme */
    }

    .x_service-card {
        background-color: #1a1a1a;
        border: none;
        color: #fff;
    }
</style>
@section('content')
    <!-- page title section -->
    <section class="xs_contact-hero-section">
        <div class="xs_contact-hero-overlay">
            <div class="container text-center py-5">
                <h1 class="contact-hero-title">SERVICES</h1>
                <nav class="breadcrumb-nav">
                    <a href="{{ route('index') }}" class="text-decoration-none text-white">
                        <span>Home</span>
                    </a> <span class="mx-2">/</span> <span class="active">Services</span>
                </nav>
            </div>
        </div>
    </section>

    <section class="x_ser_sec">
        <div class="container py-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-3 fw-bold x_privacy-title" style="color:#ad9d79 ; text-shadow:none;">Game Ecomm
                        Services
                    </h2>
                    <p class="lead x_text-secondary x_fs_small">We provide a range of services to enhance your gaming
                        experience,
                        from
                        curated product selections to expert support and fast delivery. Buy your favorite games, pay
                        securely, and get instant installation on your device after purchase. Discover what makes us
                        your trusted gaming partner.</p>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($services as $service)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm x_service-card text-center bg-dark text-light">
                            <div class="card-body">
                                <div class="mb-3">
                                    <img src="{{ asset('images/services/' . $service->icon) }}" alt="{{ $service->title }}"
                                        style="width: 50px; height: 50px; filter: brightness(0) saturate(100%) invert(74%) sepia(19%) saturate(871%) hue-rotate(16deg) brightness(94%) contrast(87%);">

                                </div>
                                <h5 class="card-title mb-2">{{ $service->title }}</h5>
                                <p class="card-text x_text_color">{{ $service->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
