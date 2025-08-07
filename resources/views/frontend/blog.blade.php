
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
</style>

<!-- page title section -->
<section class="x_contact-hero-section">
    <div class="x_contact-hero-overlay">
        <div class="container text-center py-5">
            <h1 class="contact-hero-title">Blog</h1>
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
                        <input type="text" class="form-control x_blog-search" placeholder="Search" style="color: rgb(214, 200, 200)";>
                        <span class="x_blog-search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
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
                            <input type="text" class="form-control x_blog-search" placeholder="Search">
                            <span class="x_blog-search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
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
@endpush
