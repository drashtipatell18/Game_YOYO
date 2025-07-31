@extends('frontend.layouts.main')
@section('content')
 
    <body style="padding-right: 0px;">
        <section class="d_hero-section">
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                   @foreach($banners as $index => $banner)
                        <div class="carousel-item @if($index == 0) active @endif">
                            <div class="d_hero-overlay"></div>
                            <div class="d_hero-content-wrapper">
                                <h1 class="d_hero-title">{{ strtoupper($banner->title) }}</h1>
                                <div class="d_hero-divider"></div>
                                <div class="d_hero-subtitle">{!! nl2br(e($banner->subtitle)) !!}</div>
                                @if($banner->link)
                                     <a href="{{ route('allProducts')}}" class="d_hero-btn">JOIN THE FIGHT</a>
                                @endif
                            </div>
                            <img src="{{ $banner->image }}" class="d-block w-100" alt="Banner Image" style="object-fit: cover; position: absolute; top: 0; left: 0; z-index: -1; height: 100%; width: 100%;">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
        <section class="d_category_section">
            <div class="container">
                <h2 class="d_section_title">Explore Game Categories</h2>
                <div class="d_category_scroll_wrapper" id="categoryWrapper"></div>
            </div>
        </section>
        <section class="db_featured_games_section">
            <div class="container">
                <div class="db_section_header">
                    <h2 class="db_section_title">Featured Games</h2>
                    <a href="{{ route('allProducts') }}" class="db_view_all_btn">View All</a>
                </div>
                <div class="swiper mySwiper py-4 mt-3">
                    <div class="swiper-wrapper" id="swiperCards">
                        @foreach ($featuteProducts as $game)
                            @php
                                $image = explode(',', $game->image)[0] ?? '';
                            @endphp
                            <div class="swiper-slide d-flex justify-content-center">
                                <a href="{{ route('productDetails', $game->id) }}" class="text-decoration-none text-dark">
                                    <div class="game-card position-relative" data-id="{{ $game->id }}">
                                        <img src="{{ asset('images/products/' . trim($image)) }}" alt="{{ $game->name }}" class="card-img-top" />
                                        <div class="position-absolute card-content">
                                            <h3>{{ $game->name }}</h3>
                                            <h3 class="mb-0">${{ number_format($game->price, 2) }}</h3>
                                            <span class="badge bg-secondary mt-2">{{ $game->category->name ?? 'No Category' }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Feature Section -->
        <section class="d_feature_section">
            <div class="container">
                <div class="d_feature_wrapper">
                    <!-- Image -->
                    <div class="d_feature_image">
                        <img src="https://rog.asus.com/media/1620192526692.jpg" alt="Gaming Feature" />
                    </div>
                    <!-- Content -->
                    <div class="d_feature_content">
                        <h2 class="d_feature_title"><i class="fa-solid fa-fire-flame-curved me-2"></i>Seasonal Game Launch
                        </h2>
                        <p class="d_feature_text">
                            Dive into the most anticipated games of the year! From action-packed adventures to immersive
                            RPGs,
                            our new collection delivers next-gen excitement. Get early access, exclusive bonuses, and
                            unmatched discounts now.
                        </p>
                       <button onclick="window.location='{{ route('aboutus') }}'" class="d_feature_btn">
                            Explore Now
                        </button>
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- comming soon start  -->
        <div class="d_coming_wrapper">
            
            <section class="d_coming_section">
                <div class="container">
                    <h2><i class="fa-solid fa-bolt me2"></i>Upcoming Premium Games</h2>
                    <div id="recentProducts" class="d_coming_slider">
                        @foreach ($upcomingProduct as $product)
                            @php
                                $firstImage = explode(',', $product->image)[0] ?? null;
                            @endphp
                            <div class="d_coming_card" data-date="{{ \Carbon\Carbon::parse($product->release_date)->toIso8601String() }}" data-id="{{ $product->id }}"
                                style="cursor: pointer;">
                                <div class="d_coming_card_img">
                                    <span
                                        class="d_release_tag">{{ \Carbon\Carbon::parse($product->release_date)->format('M d, Y') }}</span>
                                    <img src="{{ asset('images/products/' . trim($firstImage)) }}" alt="{{ $product->name }}">
                                </div>
                                <div class="d_coming_card_body">
                                    <div class="d_coming_card_title">{{ $product->name }}</div>
                                    <div class="d_coming_card_meta">${{ number_format($product->price, 2) }}</div>
                                    <div class="d_coming_countdown">
                                        <div><span class="days">00</span><small>Days</small></div>
                                        <div><span class="hours">00</span><small>Hrs</small></div>
                                        <div><span class="minutes">00</span><small>Min</small></div>
                                        <div><span class="seconds">00</span><small>Sec</small></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d_slider_nav">
                        <button class="d_arrow_btn d_prev_arrow"><i class="fa-solid fa-chevron-left"></i></button>
                        <button class="d_arrow_btn d_next_arrow"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            </section>
        
        </div>
        <!-- Founder & Team Section -->
        <section class="d_founder_section">
            <div class="container">
                <h2 class="d_section_title" data-aos="fade-down">Our Team</h2>
                <p class="d_section_subtitle" data-aos="fade-up">Creative minds behind the game</p>
                <div class="row justify-content-center">
                    @foreach ($ourTeams as $team)
                        <div class="col-12 col-sm-4 col-lg-3" data-aos="zoom-in" data-aos-delay="100">
                            <div class="d_member_card">
                                @php
                                    $image = $team->image ?? '';
                                    $imagePath = public_path('images/ourteam/' . $image);
                                @endphp
 
                                @if (!empty($image) && file_exists($imagePath))
                                    <img src="{{ asset('images/ourteam/' . $image) }}" alt="{{ $team->name }}" class="d_member_img">
                                @else
                                    <img src="{{ asset('assets/images/user.png') }}" alt="User Image" class="d_member_img">
                                @endif
 
                                <div class="d_member_content">
                                    <h4 class="d_member_name">{{ $team->name }}</h4>
                                    <p class="d_member_role"><i class="fas fa-gamepad"></i> {{ $team->designation }}</p>
                                    <div class="d_member_social">
                                        <a href="{{ $team->twitter }}"><i class="fab fa-twitter"></i></a>
                                        <a href="{{ $team->linkedin }}"><i class="fab fa-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
 
            </div>
        </section>
    </body>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: false,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                320: { slidesPerView: 1 },
                640: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                1024: { slidesPerView: 4 },
            }
        });
    });
    </script>
 
@endsection