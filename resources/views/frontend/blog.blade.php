{{-- 
@extends('frontend.layouts.main')
@section('content')

<style>
    .x_blog-desc {
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: all 0.3s ease;
        position: relative;
    }

    .x_blog-desc.expanded {
        -webkit-line-clamp: unset;
        overflow: visible;
    }

    .show-more-link {
        display: block;
        color: #007bff;
        cursor: pointer;
        font-weight: 500;
        margin-top: 5px;
    }

    /* Search Icon Over ride Text Css */
   .x_blog-search-wrap {
        position: relative;
        width: 100%;
    }

    .x_blog-search {
        width: 100%;
        padding: 10px 40px 10px 10px; /* Add right padding for icon */
        font-size: 16px;
        border-radius: 4px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        color: rgb(214, 200, 200);
        background-color: #000; /* or your actual background */
    }

    .x_blog-search-icon {
        position: absolute;
        top: 50%;
        right: 12px;
        transform: translateY(-50%);
        color: #888;
        pointer-events: none; /* So it doesn't block typing */
        font-size: 16px;
    }
    @media (max-width: 576px) {
        .x_blog-search {
            font-size: 14px;
            padding-right: 44px; 
            color: white !important;
        }
    }
    /* End Css Override Icon */

</style>

<!-- page title section -->
<section class="x_contact-hero-section">
    <div class="x_contact-hero-overlay">
        <div class="container text-center py-5">
            <h1 class="contact-hero-title">BLOG</h1>
            <nav class="breadcrumb-nav">
                <a href="{{ route('index') }}" class="text-decoration-none text-white">
                    <span>Home</span>
                </a> <span class="mx-2">/</span> <span class="active">Blog</span>
            </nav>
        </div>
    </div>
</section>

<!-- x_blog-section START -->
<div class="x_blog-section py-md-5 py-4">
    <div class="a_header_container">
        <div class="row w-100 p-0 m-auto">
            <!-- Offcanvas Menu Button -->
            <div class="d-lg-none w-100 d-flex justify-content-end align-items-center mb-2"
                style="position:relative;z-index:1000;">
                <button id="xSidebarMenuBtn" class="btn p-2 rounded-circle shadow-sm" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#xBlogSidebarOffcanvas"
                    aria-controls="xBlogSidebarOffcanvas"
                    style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
                    <i class="fa-solid fa-bars fa-lg" style="color: #d5d1d1;"></i>
                </button>
            </div>

            <!-- Blog Main -->
            <div class="col-lg-8 x_blog-main mb-2  MB-MD-5 p-0 mb-lg-0">
                <div id="blogPostsContainer">
                    @foreach ($blogs as $index => $blog)
                        @php
                            $images = [];
                            if (is_string($blog->image) && str_starts_with($blog->image, '[')) {
                                $images = json_decode($blog->image, true) ?? [];
                            } elseif (is_string($blog->image)) {
                                $images[] = $blog->image;
                            }
                            $carouselId = 'x_blogCarousel_' . $index;
                        @endphp

                        <div class="x_blog-post mb-3 blog-post-item"
                             data-title="{{ strtolower($blog->name) }}"
                             data-desc="{{ strtolower($blog->description) }}">
                            @if (!empty($images))
                                <div id="{{ $carouselId }}" class="carousel slide x_blog-carousel mb-3" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($images as $imgIndex => $img)
                                            <div class="carousel-item @if ($imgIndex === 0) active @endif">
                                                <img src="{{ asset('images/blogs/' . $img) }}" class="d-block w-100" alt="Blog Image {{ $imgIndex + 1 }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    @if (count($images) > 1)
                                        <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" ar ia-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    @endif
                                </div>
                            @endif

                            <h2 class="x_blog-title">{{ $blog->name }}</h2>

                            <p class="x_blog-desc" id="desc-{{ $index }}">
                                {{ $blog->description }}
                            </p>
                            <span class="show-more-link" onclick="showMore({{ $index }})" id="link-{{ $index }}">Show More</span>

                            <div class="x_blog-footer d-flex align-items-center gap-3 mt-2">
                                <span class="x_blog-author">
                                    <img src="{{ $blog->user->profile_image ?? asset('frontend/images/user.jpg') }}"
                                         class="x_blog-user-img"
                                         onerror="this.onerror=null;this.classList.add('x_blog-user-default');this.src='{{ asset('frontend/images/user.jpg') }}';"
                                         alt="User" />
                                    by {{ $blog->user->name ?? 'admin' }}
                                </span>
                                <span class="x_blog-date"><i class="fa-regular fa-calendar me-1"></i>{{ $blog->created_at->format('F d, Y') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pagination-container d-flex justify-content-center mt-4 x_review-form">
                    <button id="prevPage" class="x_pagination-btn me-2"><i class="fa-solid fa-chevron-left me-1"></i></button>
                    <div id="pageNumbers" class="d-flex gap-2"></div>
                    <button id="nextPage" class="x_pagination-btn ms-2"><i class="fa-solid fa-chevron-right ms-1"></i></button>
                </div>
            </div>

            <!-- Blog Sidebar (Desktop) -->
            <div class="col-lg-4 d-none d-lg-block x_blog-sidebar">
                <div class="x_blog-widget mb-4">
                    <h5 class="x_blog-widget-title">Blog Search</h5>
                    <div class="x_blog-search-wrap">
                        <input type="text" class="x_blog-search" placeholder="Search">
                        <span class="x_blog-search-icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                    </div>
                </div>

                <div class="x_blog-widget mb-4">
                    <h5 class="x_blog-widget-title">Top Articles</h5>
                    <div class="x_blog-top-articles">
                        @foreach ($topArticle as $article)
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('images/articles/' . $article->image) }}" class="x_blog-top-thumb me-3" alt="{{ $article->name }}" width="50">
                                <div>
                                    <div class="x_blog-top-title">{{ $article->name }}</div>
                                    <div class="x_blog-top-date">
                                        {{ \Carbon\Carbon::parse($article->created_at)->format('F d, Y') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Blog Sidebar (Mobile/Tablet Offcanvas) -->
            <div class="offcanvas offcanvas-end" style="background-color: #2a2a2a;" tabindex="-1"
                id="xBlogSidebarOffcanvas" aria-labelledby="xBlogSidebarOffcanvasLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="xBlogSidebarOffcanvasLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"
                        style="color: #d5d1d1; filter: invert(1) brightness(80%);"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="x_blog-widget mb-4">
                        <h5 class="x_blog-widget-title">Blog Search</h5>
                          <div class="x_blog-search-wrap">
                            <input type="text" class="x_blog-search" placeholder="Search">
                            <span class="x_blog-search-icon">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                        </div>
                    </div>

                    <div class="x_blog-widget mb-4">
                        <h5 class="x_blog-widget-title">Top Articles</h5>
                        <div class="x_blog-top-articles">
                            @foreach ($topArticle as $article)
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('images/articles/' . $article->image) }}" class="x_blog-top-thumb me-3" alt="{{ $article->name }}" width="50">
                                    <div>
                                        <div class="x_blog-top-title">{{ $article->name }}</div>
                                        <div class="x_blog-top-date">
                                            {{ \Carbon\Carbon::parse($article->created_at)->format('F d, Y') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="x_blog-widget mb-4">
                        <h5 class="x_blog-widget-title">Categories</h5>
                        <ul class="x_blog-categories list-unstyled mb-0">
                            <li class="x_blog-category-item x_line_auto_b">Epic</li>
                            <li class="x_blog-category-item x_line_auto_b">Playing</li>
                            <li class="x_blog-category-item">Uncategorized</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const postsPerPage = 5;
        const blogPosts = document.querySelectorAll('.x_blog-post, .x_blog-quote-section');
        const totalPosts = blogPosts.length;
        const totalPages = Math.ceil(totalPosts / postsPerPage);
        let currentPage = 1;

        const prevButton = document.getElementById('prevPage');
        const nextButton = document.getElementById('nextPage');
        const pageNumbers = document.getElementById('pageNumbers');

        function showPage(page) {
            const start = (page - 1) * postsPerPage;
            const end = start + postsPerPage;

            blogPosts.forEach((post, index) => {
                post.style.display = (index >= start && index < end) ? 'block' : 'none';
            });

            prevButton.disabled = page === 1;
            nextButton.disabled = page === totalPages;

            pageNumbers.innerHTML = '';
            for (let i = 1; i <= totalPages; i++) {
                const div = document.createElement('div');
                div.className = `pagination-btn ${i === page ? 'active' : ''}`;
                div.textContent = i;
                div.onclick = () => showPage(i);
                pageNumbers.appendChild(div);
            }

            currentPage = page;
        }

        prevButton.onclick = () => showPage(currentPage - 1);
        nextButton.onclick = () => showPage(currentPage + 1);

        showPage(1);
    });
</script>

<script>
    function showMore(index) {
        const desc = document.getElementById('desc-' + index);
        const link = document.getElementById('link-' + index);
        desc.classList.add('expanded');
        link.style.display = 'none';
    }
</script>

<script>
    $(document).ready(function () {
        $('.x_blog-search').on('keyup', function () {
            let searchText = $(this).val().toLowerCase();
            let anyVisible = false;

            $('.blog-post-item').each(function () {
                let title = $(this).data('title');
                let desc = $(this).data('desc');

                if (title.includes(searchText) || desc.includes(searchText)) {
                    $(this).show();
                    anyVisible = true;
                } else {
                    $(this).hide();
                }
            });

            if (searchText.length > 0) {
                $('.pagination-container').hide();
            } else {
                $('.pagination-container').show();
            }
        });
    });
</script>
@endpush --}}


@extends('frontend.layouts.main')
@section('content')
    <style>
        .x_blog-desc {
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: all 0.3s ease;
            position: relative;
        }

        .x_blog-desc.expanded {
            -webkit-line-clamp: unset;
            overflow: visible;
        }

        .show-more-link {
            display: block;
            color: #007bff;
            cursor: pointer;
            font-weight: 500;
            margin-top: 5px;
        }

        .no-data {
            text-align: center;
            color: #ccc;
            font-size: 16px;
            margin-top: 20px;
            display: none;
        }

        .x_blog-search-wrap {
            position: relative;
        }

        .x_blog-search-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
        }
    </style>

    <!-- page title section -->
    <section class="x_contact-hero-section">
        <div class="x_contact-hero-overlay">
            <div class="container text-center py-5">
                <h1 class="contact-hero-title">BLOG</h1>
                <nav class="breadcrumb-nav">
                    <a href="{{ route('index') }}" class="text-decoration-none text-white">
                        <span>Home</span>
                    </a> <span class="mx-2">/</span> <span class="active">Blog</span>
                </nav>
            </div>
        </div>
    </section>

    <!-- x_blog-section START -->
    <div class="x_blog-section py-md-5 py-4">
        <div class="a_header_container">
            <div class="row w-100 p-0 m-auto">

                <!-- Offcanvas Menu Button -->
                <div class="d-lg-none w-100 d-flex justify-content-end align-items-center mb-2"
                    style="position:relative;z-index:1000;">
                    <button id="xSidebarMenuBtn" class="btn p-2 rounded-circle shadow-sm" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#xBlogSidebarOffcanvas"
                        aria-controls="xBlogSidebarOffcanvas"
                        style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;">
                        <i class="fa-solid fa-bars fa-lg" style="color: #d5d1d1;"></i>
                    </button>
                </div>

                <!-- Blog Main -->
                <div class="col-lg-8 x_blog-main mb-2 p-0 mb-lg-0">
                    <div id="blogPostsContainer">
                        @foreach ($blogs as $index => $blog)
                            @php
                                $images = [];
                                if (is_string($blog->image) && str_starts_with($blog->image, '[')) {
                                    $images = json_decode($blog->image, true) ?? [];
                                } elseif (is_string($blog->image)) {
                                    $images[] = $blog->image;
                                }
                                $carouselId = 'x_blogCarousel_' . $index;
                            @endphp

                            <div class="x_blog-post mb-3 blog-post-item" data-title="{{ strtolower($blog->name) }}"
                                data-desc="{{ strtolower($blog->description) }}">
                                @if (!empty($images))
                                    <div id="{{ $carouselId }}" class="carousel slide x_blog-carousel mb-3"
                                        data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($images as $imgIndex => $img)
                                                <div class="carousel-item @if ($imgIndex === 0) active @endif">
                                                    <img src="{{ asset('images/blogs/' . $img) }}" class="d-block w-100"
                                                        alt="Blog Image {{ $imgIndex + 1 }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        @if (count($images) > 1)
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        @endif
                                    </div>
                                @endif

                                <h2 class="x_blog-title">{{ $blog->name }}</h2>
                                <p class="x_blog-desc" id="desc-{{ $index }}">
                                    {{ $blog->description }}
                                </p>
                                <span class="show-more-link" onclick="showMore({{ $index }})"
                                    id="link-{{ $index }}">Show More</span>

                                <div class="x_blog-footer d-flex align-items-center gap-3 mt-2">
                                    <span class="x_blog-author">
                                        <img src="{{ $blog->user->profile_image ?? asset('frontend/images/user.jpg') }}"
                                            class="x_blog-user-img"
                                            onerror="this.onerror=null;this.classList.add('x_blog-user-default');this.src='{{ asset('frontend/images/user.jpg') }}';"
                                            alt="User" />
                                        by {{ $blog->user->name ?? 'admin' }}
                                    </span>
                                    <span class="x_blog-date"><i
                                            class="fa-regular fa-calendar me-1"></i>{{ $blog->created_at->format('F d, Y') }}</span>
                                </div>
                            </div>
                        @endforeach

                        <div class="no-data" id="noDataMessage">No Blog Found</div>
                    </div>

                    <div class="pagination-container d-flex justify-content-center mt-4 x_review-form">
                        <button id="prevPage" class="x_pagination-btn me-2"><i
                                class="fa-solid fa-chevron-left mx-auto p-2"></i> </button>
                        <div id="pageNumbers" class="d-flex gap-2"></div>
                        <button id="nextPage" class="x_pagination-btn ms-2"> <i
                                class="fa-solid fa-chevron-right mx-auto p-2"></i></button>
                    </div>
                </div>

                <!-- Blog Sidebar (Desktop) -->
                <div class="col-lg-4 d-none d-lg-block x_blog-sidebar">
                    <div class="x_blog-widget mb-4">
                        <h5 class="x_blog-widget-title">Blog Search</h5>
                        <div class="x_blog-search-wrap">
                            <input type="text" class="form-control blog-search-input" placeholder="Search"
                                style="color: rgb(22, 22, 22);">
                            <span class="x_blog-search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                        </div>
                    </div>
                </div>

                <!-- Blog Sidebar (Mobile/Tablet Offcanvas) -->
                <div class="offcanvas offcanvas-end" style="background-color: #2a2a2a;" tabindex="-1"
                    id="xBlogSidebarOffcanvas" aria-labelledby="xBlogSidebarOffcanvasLabel">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"
                            style="color: #d5d1d1; filter: invert(1) brightness(80%);"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="x_blog-widget mb-4">
                            <h5 class="x_blog-widget-title">Blog Search</h5>
                            <div class="x_blog-search-wrap">
                                <input type="text" class="form-control blog-search-input" placeholder="Search"
                                    style="color: rgb(22, 22, 22);">
                                <span class="x_blog-search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function showMore(index) {
            const desc = document.getElementById('desc-' + index);
            const link = document.getElementById('link-' + index);
            if (desc) desc.classList.add('expanded');
            if (link) link.style.display = 'none';
        }

        $(function() {
            function filterBlogs(searchText) {
                searchText = (searchText || '').toLowerCase();
                let anyVisible = false;
                $(".blog-post-item").each(function() {
                    const title = String($(this).data("title") || "").toLowerCase();
                    const desc = String($(this).data("desc") || "").toLowerCase();

                    if (!searchText || title.includes(searchText) || desc.includes(searchText)) {
                        $(this).show();
                        anyVisible = true;
                    } else {
                        $(this).hide();
                    }
                });

                $("#noDataMessage").toggle(!anyVisible);
            }

            // On input: toggle icon & filter
            $(document).on("input", ".blog-search-input", function() {
                const $wrap = $(this).closest(".x_blog-search-wrap");
                const $icon = $wrap.find(".x_blog-search-icon i");
                const text = $(this).val().trim();

                if (text.length) {
                    $icon.attr('class', 'fa-solid fa-xmark');
                } else {
                    $icon.attr('class', 'fa-solid fa-magnifying-glass');
                }

                filterBlogs(text);
                $(".pagination-container").toggle(text.length === 0);
            });

            // On icon click: clear input if icon is xmark, else focus input
            $(document).on("click", ".x_blog-search-icon", function(e) {
                e.preventDefault();
                const $wrap = $(this).closest(".x_blog-search-wrap");
                const $input = $wrap.find(".blog-search-input");
                const $icon = $wrap.find("i");

                const iconClass = ($icon.attr('class') || '').toLowerCase();

                if (iconClass.includes('xmark')) {
                    // Clear input
                    $input.val('');
                    $icon.attr('class', 'fa-solid fa-magnifying-glass');

                    // Show all posts + pagination, hide no-data
                    $(".blog-post-item").show();
                    $(".pagination-container").show();
                    $("#noDataMessage").hide();

                    // Trigger input event to keep state consistent
                    $input.trigger('input');
                } else {
                    // Focus input if icon is magnifying glass
                    $input.focus();
                }
            });

            // Esc key clears input
            $(document).on("keydown", ".blog-search-input", function(e) {
                if (e.key === "Escape") {
                    const $wrap = $(this).closest(".x_blog-search-wrap");
                    const $input = $wrap.find(".blog-search-input");
                    const $icon = $wrap.find(".x_blog-search-icon i");

                    $input.val('');
                    $icon.attr('class', 'fa-solid fa-magnifying-glass');
                    $(".blog-post-item").show();
                    $(".pagination-container").show();
                    $("#noDataMessage").hide();

                    // trigger input event
                    $input.trigger('input');
                }
            });

            // On page load, reset icon if input empty
            $(".blog-search-input").each(function() {
                if (!$(this).val().trim()) {
                    const $wrap = $(this).closest(".x_blog-search-wrap");
                    $wrap.find(".x_blog-search-icon i").attr('class', 'fa-solid fa-magnifying-glass');
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {

            const postsPerPage = 4;
            const blogPosts = Array.from(document.querySelectorAll('.x_blog-post, .x_blog-quote-section'));
            const totalPosts = blogPosts.length;
            const totalPages = Math.ceil(totalPosts / postsPerPage);
            let currentPage = 1;

            const prevButton = document.getElementById('prevPage');
            const nextButton = document.getElementById('nextPage');
            const pageNumbers = document.getElementById('pageNumbers');
            const paginationContainer = document.querySelector(".pagination-container");
            const blogContainer = document.getElementById("blogPostsContainer");

            // ✅ If no posts
            if (totalPosts === 0) {
                paginationContainer.style.display = "none";
                prevPage.style.display = "none";
                nextPage.style.display = "none";
                blogContainer.innerHTML = `
           <div class="text-center p-4">
                <img src="/images/file.png" 
                    alt="No Data" 
                    style="max-width:100px; opacity:0.85;">
                <h4 class="mt-3 x_blog-widget-title border-0">No Blog Posts Found</h4>
            </div>

        `;
                return;
            }

            function renderPagination() {
                pageNumbers.innerHTML = '';

                if (totalPages <= 1) {
                    paginationContainer.style.display = "none";
                    return;
                } else {
                    paginationContainer.style.display = "flex";
                }

                let paginationHTML = '';

                paginationHTML += createPageBtn(1);

                if (currentPage > 3) {
                    paginationHTML += `<span class="dots">...</span>`;
                }

                let start = Math.max(2, currentPage - 1);
                let end = Math.min(totalPages - 1, currentPage + 1);

                for (let i = start; i <= end; i++) {
                    paginationHTML += createPageBtn(i);
                }

                if (currentPage < totalPages - 2) {
                    paginationHTML += `<span class="dots">...</span>`;
                }

                if (totalPages > 1) {
                    paginationHTML += createPageBtn(totalPages);
                }

                pageNumbers.innerHTML = paginationHTML;
            }

            function createPageBtn(page) {
                return `<button class="pagination-btn ${page === currentPage ? 'active' : ''}" data-page="${page}">${page}</button>`;
            }

            function showPage(page) {
                currentPage = page;
                const start = (page - 1) * postsPerPage;
                const end = start + postsPerPage;

                blogPosts.forEach((post, index) => {
                    post.style.display = (index >= start && index < end) ? 'block' : 'none';
                });

                prevButton.disabled = currentPage === 1;
                nextButton.disabled = currentPage === totalPages;
                renderPagination();
            }

            pageNumbers.addEventListener('click', function(e) {
                if (e.target.classList.contains('pagination-btn')) {
                    const page = parseInt(e.target.dataset.page);
                    if (!isNaN(page)) {
                        showPage(page);
                    }
                }
            });

            prevButton.addEventListener('click', function() {
                if (currentPage > 1) {
                    showPage(currentPage - 1);
                }
            });

            nextButton.addEventListener('click', function() {
                if (currentPage < totalPages) {
                    showPage(currentPage + 1);
                }
            });

            showPage(1);
        });
    </script>
@endpush
