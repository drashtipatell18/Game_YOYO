@extends('frontend.layouts.main')
@section('content')
<body style="padding-right: 0px;">
   <section class="d_hero-section">
      <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
         <div class="carousel-inner">
            <div class="carousel-item active">
               <div class="d_hero-overlay"></div>
               <div class="d_hero-content-wrapper">
                  <h1 class="d_hero-title">THE UNCONQUERED</h1>
                  <div class="d_hero-divider"></div>
                  <div class="d_hero-subtitle">It seemed to be a sort of monster, or symbol representing a
                     monster,<br /> of a
                     form which only a diseased fancy could conceive.
                  </div>
                  <a href="#" class="d_hero-btn">BUY THEME</a>
               </div>
            </div>
            <div class="carousel-item">
               <div class="d_hero-overlay"></div>
               <div class="d_hero-content-wrapper">
                  <h1 class="d_hero-title">YOYO HORROR</h1>
                  <div class="d_hero-divider"></div>
                  <div class="d_hero-subtitle">Beyond time and sanity, the void gazes back.<br /> What will you do
                     when it
                     calls your name?
                  </div>
                  <a href="/About_us.html" class="d_hero-btn">EXPLORE NOW</a>
               </div>
            </div>
            <div class="carousel-item">
               <div class="d_hero-overlay"></div>
               <div class="d_hero-content-wrapper">
                  <h1 class="d_hero-title">RISE OF THE VOID</h1>
                  <div class="d_hero-divider"></div>
                  <div class="d_hero-subtitle">Whispers in the dark, forgotten tomes, and eternal war.<br /> The
                     rise begins
                     now.
                  </div>
                  <a href="#" class="d_hero-btn">JOIN THE FIGHT</a>
               </div>
            </div>
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
            <a href="/allProduct.html" class="db_view_all_btn">View All</a>
         </div>
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
               <button class="d_feature_btn">
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
            <div id="recentProducts" class="d_coming_slider"></div>
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
            <!-- Founder -->
            <div class="col-12 col-sm-4 col-lg-3" data-aos="zoom-in" data-aos-delay="100">
               <div class="d_member_card">
                  <img src="https://i.pinimg.com/736x/d0/cb/d1/d0cbd1380c72ddf3750c896433b2dea1.jpg" alt="Founder"
                     class="d_member_img">
                  <div class="d_member_content">
                     <h4 class="d_member_name">Alex Knight</h4>
                     <p class="d_member_role"><i class="fas fa-gamepad"></i> Founder</p>
                     <div class="d_member_social">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Team Member 1 -->
            <div class="col-12 col-sm-4 col-lg-3" data-aos="zoom-in" data-aos-delay="200">
               <div class="d_member_card">
                  <img src="https://avatars.mds.yandex.net/i?id=b21df524f3cd6e6d72d8c1d12ca23ff54e1b9d56-10503706-images-thumbs&n=13"
                     alt="Dev" class="d_member_img">
                  <div class="d_member_content">
                     <h4 class="d_member_name">Ryan Smith</h4>
                     <p class="d_member_role">Lead Dev</p>
                     <div class="d_member_social">
                        <a href="#"><i class="fab fa-github"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Team Member 2 -->
            <div class="col-12 col-sm-4 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
               <div class="d_member_card">
                  <img src="https://avatars.mds.yandex.net/i?id=3fdf8c2c5a8d0d62d31f6b74a0f22f644943d27d-5257871-images-thumbs&n=13"
                     alt="Designer" class="d_member_img">
                  <div class="d_member_content">
                     <h4 class="d_member_name">Emily Ray</h4>
                     <p class="d_member_role">UI/UX Designer</p>
                     <div class="d_member_social">
                        <a href="#"><i class="fab fa-behance"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Team Member 3 -->
            <div class="col-12 col-sm-4 col-lg-3" data-aos="zoom-in" data-aos-delay="400">
               <div class="d_member_card">
                  <img src="https://avatars.mds.yandex.net/i?id=69733bdc9e798a69a804b7aa5a2845f9999bbe99-5087049-images-thumbs&n=13"
                     alt="QA" class="d_member_img">
                  <div class="d_member_content">
                     <h4 class="d_member_name">Liam Jones</h4>
                     <p class="d_member_role">QA Engineer</p>
                     <div class="d_member_social">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</body>
@endsection