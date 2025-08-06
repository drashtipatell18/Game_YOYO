@extends('frontend.layouts.main')
@section('title', 'YOYO Khel: About Us')

@section('content')
    <div class="Z_about_hero">
        <div class="Z_about_hero-overlay">
            <div class="container text-center py-5">

                <h1 class="Z_about_title">ABOUT US</h1>
                <nav class="breadcrumb-nav">
                    <a href="{{ route('index') }}" class="text-decoration-none text-white">
                        <span>Home</span>
                    </a> <span class="mx-2">/</span> <span class="active">About Us</span>
                </nav>
            </div>
        </div>
    </div>
    <section class="Z_about_content">
        <div class="container">
            <div class="Z_about_intro">
                <h2 class="Z_about_heading">A Clan That Slays Together<br>Stays Together</h2>
                <p class="Z_about_text">Our mission is to unite gamers from around the world under a single community, promoting teamwork, collaboration, and camaraderie while excelling in every gaming battle. Whether you’re into competitive esports, casual gaming, or online gaming events, we believe that strong player connections, strategy, and teamwork are the ultimate keys to gaming success and victory..
                </p>
            </div>
            <div class="Z_about_container">
                <div class="Z_about_features ">
                    <div class="Z_about_feature">
                        <div class="Z_about_icon">
                            <img src="{{ asset('frontend/images/inner-icon-img-1.png') }}" alt="Feature 1"
                                class="Z_about_img" />
                        </div>
                        <div class="Z_about_feature-content">
                            <h3 class="Z_about_feature-title">Fortitude & Honor</h3>
                            <p class="Z_about_feature-text">Fortitude & Honor guide every battle, forging champions through courage and loyalty.
                        </div>
                    </div>
                    <div class="Z_about_feature">
                        <div class="Z_about_icon">
                            <img src="{{ asset('frontend/images/inner-icon-img-2.png') }}" alt="Feature 2"
                                class="Z_about_img" />
                        </div>
                        <div class="Z_about_feature-content">
                            <h3 class="Z_about_feature-title">Vigilance & Justice</h3>
                            <p class="Z_about_feature-text">Vigilance & Justice guide every quest, defining heroes through watchfulness and fairness.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="Z_about_split-container">
                <div class="Z_about_split-left">
                    <img src="{{ asset('frontend/images/port-standard.jpg') }}" alt="Angel Warrior"
                        class="Z_about_split-img" />
                </div>
                <div class="Z_about_split-right">
                    <h2 class="Z_about_split-title">Going For The High Roll</h2>
                     <p class="Z_about_split-desc">In the world of epic battles and legendary beasts, going for the high roll means daring to face the impossible. Every hero who rises against mighty foes, like dragons or colossal armies, knows that true glory comes to those willing to take risks.
                    </p>
                    <div class="Z_about_split-features">
                        <div class="Z_about_split-feature">
                            <img src="{{ asset('frontend/images/inner-icon-img-3.png') }}" alt="Feature 1"
                                class="Z_about_split-icon" />
                             <span class="Z_about_split-feature-text">Master every challenge by facing towering enemies and complex quests with strategy, skill, and courage.Seize your victory, as every bold move can tip the scales of battle and lead to legendary rewards.</span>
                        </div>
                        <div class="Z_about_split-feature">
                            <img src="{{ asset('frontend/images/inner-icon-img-4.png') }}" alt="Feature 2"
                                class="Z_about_split-icon" />
                            <span class="Z_about_split-feature-text">Forge your legacy in a realm of fire and steel, where only those who dare the High Roll will be remembered.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="Z_about_image_slider">
            <div class="Z_about_slider_container">
                <div class="text-center mb-5 container">
                    <h2 class="Z_about_testimonial_heading"
                        style="color:#fff; font-family:'Cinzel',serif; font-size:2.4rem; font-weight:500;">What Our Clan
                        Members Say
                    </h2>
                    <div class="Z_about_testimonial_subheading" style="color:#ccc; font-size:1.1rem;">Real stories from
                        our gaming community.
                    </div>
                    <p class="Z_about_testimonial_intro"
                        style="color:#bdbdbd; font-size:1rem; max-width:600px; margin: 0.7rem auto 0 auto;">Our members
                        share their experiences, victories, and the bonds they've built through gaming. Discover what
                        makes our clan unique from the voices of our own community.
                    </p>
                </div>
                <div class="swiper Z_about_swiper">
                    <div class="swiper-wrapper">
                        @foreach ($membersSay as $member)
                            <div class="swiper-slide">
                                <div class="Z_about_card">
                                    <div class="Z_about_testimonial-content">
                                        @if ($member->image)
                                            <img src="{{ asset('images/members_say/' . $member->image) }}"
                                                alt="{{ $member->title }}" class="Z_about_card_img">
                                        @endif
                                        <div class="Z_about_card_body">
                                            <h3 class="Z_about_card_title">{{ $member->name }}</h3>
                                            <p class="Z_about_card_desc">{{ $member->description }}</p>
                                            <button class="Z_about_card_btn">Learn More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
@push('script')
    <script>
        const swiper = new Swiper('.Z_about_swiper', {
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            slidesPerView: 1,
            spaceBetween: 30,
            breakpoints: {
                640: {
                    slidesPerView: 1
                },
                900: {
                    slidesPerView: 2
                },
                1200: {
                    slidesPerView: 3
                }
            }
        });
        const featuresSwiper = new Swiper('.Z_about_features_swiper', {
            loop: false,
            navigation: {
                nextEl: '.Z_about_features_swiper .swiper-button-next',
                prevEl: '.Z_about_features_swiper .swiper-button-prev',
            },
            pagination: {
                el: '.Z_about_features_swiper .swiper-pagination',
                clickable: true,
            },
            slidesPerView: 1,
            spaceBetween: 30,
        });
    </script>
@endpush
