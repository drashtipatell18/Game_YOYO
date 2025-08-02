<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>The Unconquered – Yoyo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend/css/d_style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/s_style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/z_style.css') }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
</head>
<style>
    .d_icon_top {
        height: 32px !important;
        width: 32px !important;
        background: white !important;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>

<body>
    <footer class="d_footer text-white">
        <div class="container py-md-3 ">
            <div class="row gy-4">
                <div class="col-md-4">
                    <h4 class="d_footer-logo mb-3">YOYO</h4>
                    <p class="d_footer_text">A realm where ancient horrors dwell and forgotten heroes rise again.
                        Unleash your
                        legend in the shadows.</p>
                </div>
                <div class="col-md-2 col-6">
                    <h5 class="text-white mb-3">Quick Links</h5>
                    <ul class="list-unstyled d_footer-links">
                        <li><a href="{{ route('index') }}" class="active">Home</a></li>
                        <li><a href="{{ route('allProducts') }}">Games</a></li>
                        <li><a href="{{ route('aboutus') }}">About</a></li>
                        <li><a href="{{ route('frontendcontactus') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-6">
                    <h5 class="text-white mb-3">Our Policy</h5>
                    <ul class="list-unstyled d_footer-links">
                        <li><a href="{{ route('shipmentPolicy') }}" class="active">Shiiping Policy</a></li>
                        <li><a href="{{ route('terms_conditions') }}">Terms Conditions</a></li>
                        <li><a href="{{ route('frontendprivacy') }}">Privacy Policy</a></li>
                         <li><a href="{{ route('cancel_refund') }}">Cancel Refund</a></li>
                        <li><a href="{{ route('frontendservice') }}">Service</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="text-white mb-3">Contact</h5>
                    <ul class="list-unstyled d_footer-links d_footer_text">
                        <li><i class="fas fa-envelope me-2"></i> support@yoyo.com</li>
                        <li><i class="fas fa-phone me-2"></i> +91 98765 43210</li>
                        <li><i class="fas fa-location-dot me-2"></i> Yoyo HQ, Darkrealm</li>
                    </ul>
                    <div class="d_footer-social mt-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-x-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-discord"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary mt-4" />
            <div class="text-center d_footer_text small">
                &copy; 2025 YOYO. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
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
        const gameSlider = document.querySelector('.db_game_slider');
        const leftArrow = document.querySelector('.db_left_arrow');
        const rightArrow = document.querySelector('.db_right_arrow');

        let currentCardIndex = 0; // Tracks the index of the first visible card
        const cardWidth = 280; // As defined in .db_game_card min-width/max-width
        const gapWidth = 32; // 2rem = 32px (assuming 1rem = 16px)
        const cardWidthWithGap = cardWidth + gapWidth; // Total space one card occupies

        function updateSliderPosition() {
            const sliderPadding = parseFloat(getComputedStyle(gameSlider).paddingLeft); // Get left padding dynamically
            const totalCards = document.querySelectorAll('.db_game_card').length;
            const visibleWidth = gameSlider.parentElement.offsetWidth; // Use container width, not slider width
            const totalWidth = totalCards * cardWidthWithGap;
            let translateXValue = currentCardIndex * cardWidthWithGap;

            // Calculate the maximum translateX so the last card is flush with the right edge
            const maxTranslateX = Math.max(0, totalWidth - visibleWidth);

            // If we're about to scroll past the end, clamp to maxTranslateX
            if (translateXValue > maxTranslateX) {
                translateXValue = maxTranslateX;
                // Optionally, update currentCardIndex so left arrow works as expected
                currentCardIndex = Math.round(maxTranslateX / cardWidthWithGap);
            }

            gameSlider.style.transform = `translateX(-${translateXValue}px)`;

            // Update arrow visibility
            leftArrow.style.opacity = currentCardIndex === 0 ? '0.5' : '1';
            rightArrow.style.opacity = translateXValue >= maxTranslateX ? '0.5' : '1';
        }

        leftArrow.addEventListener('click', () => {
            if (currentCardIndex > 0) {
                currentCardIndex--;
                updateSliderPosition();
            }
        });

        rightArrow.addEventListener('click', () => {
            const totalCards = document.querySelectorAll('.db_game_card').length;
            const visibleWidth = gameSlider.parentElement.offsetWidth;
            const totalWidth = totalCards * cardWidthWithGap;
            const maxTranslateX = Math.max(0, totalWidth - visibleWidth);

            let nextTranslateX = (currentCardIndex + 1) * cardWidthWithGap;
            if (nextTranslateX > maxTranslateX) {
                currentCardIndex = Math.round(maxTranslateX / cardWidthWithGap);
            } else {
                currentCardIndex++;
            }
            updateSliderPosition();
        });

        // Auto-scroll functionality
        let autoScrollInterval;

        function startAutoScroll() {
            stopAutoScroll(); // Clear any existing interval before starting a new one
            autoScrollInterval = setInterval(() => {
                const sliderPadding = parseFloat(getComputedStyle(gameSlider).paddingLeft);
                const totalCards = document.querySelectorAll('.db_game_card').length;
                const visibleWidth = gameSlider.parentElement.offsetWidth;
                const totalWidth = totalCards * cardWidthWithGap;
                const maxTranslateX = Math.max(0, totalWidth - visibleWidth);

                if (currentCardIndex >= maxTranslateX) {
                    currentCardIndex = 0; // Loop back to the beginning
                } else {
                    currentCardIndex++;
                }
                updateSliderPosition();
            }, 4000);
        }

        function stopAutoScroll() {
            clearInterval(autoScrollInterval);
        }

        // Start auto-scroll
        startAutoScroll();

        // Pause auto-scroll on hover
        const gamesSection = document.querySelector('.db_featured_games_section');
        gamesSection.addEventListener('mouseenter', stopAutoScroll);
        gamesSection.addEventListener('mouseleave', startAutoScroll);

        // Handle window resize
        window.addEventListener('resize', () => {
            // Recalculate everything on resize to ensure correct positioning
            updateSliderPosition();
        });

        // Initialize slider position on load
        window.addEventListener('load', updateSliderPosition);

        // Add click effects to game cards
        document.querySelectorAll('.db_game_card').forEach(card => {
            card.addEventListener('click', function() {
                const title = this.querySelector('.db_game_title').textContent;
                console.log(`Clicked on: ${title}`);
                // Add your game card click logic here
            });
        });

        // Add heart icon toggle functionality
        document.querySelectorAll('.db_game_icons button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const icon = this.querySelector('i');

                if (icon.classList.contains('fa-heart')) {
                    icon.classList.toggle('fas');
                    icon.classList.toggle('far');
                    this.style.background = icon.classList.contains('fas') ? '#c55978' :
                        'rgba(255, 255, 255, 0.9)';
                    this.style.color = icon.classList.contains('fas') ? '#fff' : '#18151a';
                }
            });
        });
    </script>

    <script>
        AOS.init({
            duration: 800,
            once: true
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
        document.addEventListener("DOMContentLoaded", function() {
            fetch("/categoriesJson")
                .then(res => res.json())
                .then(categories => {
                    const wrapper = document.getElementById("categoryWrapper");
                    wrapper.innerHTML = "";

                    categories.forEach(cat => {
                        wrapper.innerHTML += `
                                <div class="d_category_card">
                                    <img src="${cat.image}" alt="${cat.name} Game" />
                                    <div class="d_category_overlay">
                                        <div class="d_category_text">${cat.name}</div>
                                    </div>

                                    <img src="${cat.icon}" class="d_icon_top" alt="${cat.name} Icon" />
                                </div>
                            `;
                    });
                })
                .catch(() => {
                    document.getElementById("categoryWrapper").innerHTML =
                        "<div class='text-danger'>Failed to load categories.</div>";
                });
        });
    </script>

    <script>
        async function fetchAndRenderSwiperCards() {
            try {
                // Fetch products and technology data in parallel
                const [productsRes, techRes] = await Promise.all([
                    fetch('/productsJson'),
                    // fetch('/technology')
                ]);
                const [products, technologies] = await Promise.all([
                    productsRes.json(),
                    techRes.json()
                ]);

                // Render cards
                const swiperCards = document.getElementById('swiperCards');
                swiperCards.innerHTML = products.map(card => {
                    // Find technology objects for this product, render as <i> with background image
                    const techIcons = (card.technology_ids || [])
                        .map(id => technologies.find(t => t.id == id))
                        .filter(Boolean)
                        .map(tech => {
                            let iconClass = '';
                            if (tech.name === 'iOS' || tech.name === 'MacOS') iconClass =
                                'fa-brands fa-apple';
                            else if (tech.name === 'Windows') iconClass = 'fa-brands fa-windows';
                            else if (tech.name === 'Android') iconClass = 'fa-brands fa-android';
                            else if (tech.name === 'Linux') iconClass = 'fa-brands fa-linux';
                            return `<span class="tech-icon-img"><i class="${iconClass}"></i></span>`;
                        }).join(' ')

                    return `
                        <div class="swiper-slide d-flex justify-content-center">
                            <div class="game-card position-relative" data-id="${card.id}">
                                <img src="${card.image}" alt="${card.title}" class="card-img-top" />
                                <div class="position-absolute card-content">
                                    <div class="icons d-flex gap-2 mb-3">
                                    ${techIcons}
                                    </div>
                                    <h3>${card.title}</h3>
                                    <h3 class="mb-0">$${card.price}</h3>
                                </div>
                                <div class="card-actions d-flex align-items-center gap-3">
                                    <div class="d_main_button w-100">
                                        <button class="custom-cart-btn w-100" data-id="${card.id}">ADD TO CART</button>
                                        <div class="d_border"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                }).join('');

                // Initialize Swiper after rendering
                new Swiper('.mySwiper', {
                    slidesPerView: 3,
                    spaceBetween: 24,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1
                        },
                        576: {
                            slidesPerView: 2
                        },
                        768: {
                            slidesPerView: 3
                        },
                        1024: {
                            slidesPerView: 4
                        }
                    }
                });

                // Add click handler to each card
                document.querySelectorAll('.game-card').forEach(card => {
                    card.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        localStorage.setItem('item_id', id);
                        window.location.href = 'singleProduct.html';
                    });
                });

                // Add click handler for the "ADD TO CART" button
                document.querySelectorAll('.custom-cart-btn').forEach(btn => {
                    btn.addEventListener('click', async function(e) {
                        e.stopPropagation();
                        const pro_id = Number(this.getAttribute('data-id'));
                        localStorage.setItem('cart_id', pro_id);

                        // 1. Get user id from localStorage
                        const user_id = Number(localStorage.getItem('user_id'));
                        if (!user_id) {
                            alert('Please log in to add to cart!');
                            return;
                        }

                        // 2. Check if user already has a cart
                        let cartRes = await fetch(`http://localhost:4000/cart?user_id=${user_id}`);
                        let carts = await cartRes.json();
                        let cart = carts[0];

                        if (cart) {
                            // 3. If cart exists, update products array
                            let products = cart.products || [];
                            let found = false;
                            products = products.map(item => {
                                if (item.pro_id === pro_id) {
                                    found = true;
                                    return {
                                        ...item,
                                        quantity: item.quantity + 1
                                    };
                                }
                                return item;
                            });
                            if (!found) {
                                products.push({
                                    pro_id,
                                    quantity: 1
                                });
                            }

                            // 4. Update cart in db
                            await fetch(`http://localhost:4000/cart/${cart.id}`, {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    products
                                })
                            });
                        } else {
                            // 5. If no cart, create new cart
                            await fetch('http://localhost:4000/cart', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    user_id,
                                    products: [{
                                        pro_id,
                                        quantity: 1
                                    }]
                                })
                            });
                        }

                        alert('Added to cart!');
                    });
                });
            } catch (error) {
                console.error('Error fetching products or technologies:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', fetchAndRenderSwiperCards);
    </script>


    <script>
        async function renderLastFourProducts() {
            try {
                const res = await fetch('/products');
                let products = await res.json();

                // Reverse and get last 4
                const lastFour = products.reverse().slice(0, 4);

                // Render cards with proper date formatting
                const container = document.getElementById('recentProducts');
                container.innerHTML = lastFour.map(product => {
                    // Ensure we have a valid release date
                    const releaseDate = product.release_date || '2025-12-20';
                    const formattedDate = new Date(releaseDate).toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric'
                    });

                    return `
                <div class="d_coming_card" data-date="${releaseDate}" data-id="${product.id}" style="cursor: pointer;">
                    <div class="d_coming_card_img">
                        <span class="d_release_tag">${formattedDate}</span>
                        <img src="${product.image}" alt="${product.title}">
                    </div>
                    <div class="d_coming_card_body">
                        <div class="d_coming_card_title">${product.title}</div>
                        <div class="d_coming_card_meta">$${Number(product.price).toFixed(2)}</div>
                        <div class="d_coming_countdown">
                            <div><span class="days">00</span><small>Days</small></div>
                            <div><span class="hours">00</span><small>Hrs</small></div>
                            <div><span class="minutes">00</span><small>Min</small></div>
                            <div><span class="seconds">00</span><small>Sec</small></div>
                        </div>
                    </div>
                </div>
            `;
                }).join('');

                // Add click event listeners
                document.querySelectorAll('.d_coming_card').forEach(card => {
                    card.addEventListener('click', function() {
                        const productId = this.getAttribute('data-id');
                        localStorage.setItem('item_id', productId);
                        window.location.href = 'singleProduct.html';
                    });
                });

                // Re-initialize Slick slider
                $('#recentProducts').slick('unslick');
                $('#recentProducts').slick({
                    slidesToShow: 3,
                    arrows: true,
                    prevArrow: $('.d_prev_arrow'),
                    nextArrow: $('.d_next_arrow'),
                    responsive: [{
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        }

        // Improved countdown function with better error handling
        function updateCountdown(card, targetDate) {
            const now = new Date().getTime();
            const target = new Date(targetDate).getTime();

            // Check if target date is valid
            if (isNaN(target)) {
                console.error('Invalid date:', targetDate);
                return;
            }

            const diff = target - now;

            // If date has passed, show zeros
            if (diff < 0) {
                card.querySelector('.days').innerText = '00';
                card.querySelector('.hours').innerText = '00';
                card.querySelector('.minutes').innerText = '00';
                card.querySelector('.seconds').innerText = '00';
                return;
            }

            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            // Format with leading zeros
            card.querySelector('.days').innerText = days.toString().padStart(2, '0');
            card.querySelector('.hours').innerText = hours.toString().padStart(2, '0');
            card.querySelector('.minutes').innerText = minutes.toString().padStart(2, '0');
            card.querySelector('.seconds').innerText = seconds.toString().padStart(2, '0');
        }

        // Updated interval with error handling
        setInterval(() => {
            document.querySelectorAll('.d_coming_card').forEach(card => {
                const date = card.getAttribute('data-date');
                if (date) {
                    updateCountdown(card, date);
                }
            });
        }, 1000);

        document.addEventListener('DOMContentLoaded', renderLastFourProducts);
        $('.d_coming_slider').slick({
            slidesToShow: 2,
            arrows: true,
            prevArrow: $('.d_prev_arrow'),
            nextArrow: $('.d_next_arrow'),
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

        // function updateCountdown(card, targetDate) {
        //     const now = new Date().getTime();
        //     const diff = new Date(targetDate).getTime() - now;
        //     if (diff < 0) return;

        //     const d = Math.floor(diff / (1000 * 60 * 60 * 24));
        //     const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        //     const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        //     const s = Math.floor((diff % (1000 * 60)) / 1000);

        //     card.querySelector('.days').innerText = d;
        //     card.querySelector('.hours').innerText = h;
        //     card.querySelector('.minutes').innerText = m;
        //     card.querySelector('.seconds').innerText = s;
        // }

        setInterval(() => {
            document.querySelectorAll('.d_coming_card').forEach(card => {
                const date = card.getAttribute('data-date');
                updateCountdown(card, date);
            });
        }, 1000);
    </script>
    @stack('script')
</body>

</html>
