@extends('frontend.layouts.main')
@section('content')
    <!-- page title section -->
    <section class="x_contact-hero-section">
        <div class="x_contact-hero-overlay">
            <div class="container text-center py-5">
                <h1 class="contact-hero-title">Blog</h1>
                <nav class="breadcrumb-nav">
                    <span>Home</span> <span class="mx-2">/</span> <span class="active">Blog</span>
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

                <div class="col-lg-8 x_blog-main mb-2  MB-MD-5 p-0 mb-lg-0">
                    <div id="blogPostsContainer">
                        <!-- Blog Post 1 -->
                        @foreach ($blogs as $blog)
                            <div class="x_blog-post mb-3">
                                <div class="x_blog-media mb-3">
                                    @if ($blog->video)
                                        <div class="video-container"
                                            style="position: relative; width: 100%; max-width: 800px;">
                                            <video controls
                                                style="width: 100%; height: auto; max-height: 400px; object-fit: contain;"
                                                preload="metadata">
                                                <source src="{{ asset('videos/blogs/' . $blog->video) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    @elseif($blog->image)
                                        <img src="{{ asset('images/blogs/' . $blog->image) }}" class="img-fluid"
                                            alt="Blog image">
                                    @endif
                                </div>

                                <div class="x_blog-meta mb-1">{{ $blog->category ?? 'Uncategorized' }}</div>

                                <h2 class="x_blog-title">{{ $blog->name }}</h2>

                                <p class="x_blog-desc">{{ Str::limit($blog->description, 200) }}</p>

                                <div class="x_blog-footer d-flex align-items-center gap-3 mt-2">
                                    <span class="x_blog-author">
                                        <img src="{{ $blog->user->profile_image ?? asset('frontend/images/user.jpg') }}"
                                            class="x_blog-user-img"
                                            onerror="this.onerror=null;this.classList.add('x_blog-user-default');this.src='{{ asset('frontend/images/user.jpg') }}';"
                                            alt="User" />
                                        by {{ $blog->user->name ?? 'admin' }}
                                    </span>

                                    <span class="x_blog-date">
                                        <i class="fa-regular fa-calendar me-1"></i>
                                        {{ $blog->created_at->format('F d, Y') }}
                                    </span>

                                    <span class="x_blog-comments">
                                        <i class="fa-regular fa-comment me-1"></i>
                                        {{ $blog->comments_count ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="pagination-container d-flex justify-content-center mt-4 x_review-form">
                        <button id="prevPage" class="x_pagination-btn me-2"><i class="fa-solid fa-chevron-left me-1"></i>
                        </button>
                        <div id="pageNumbers" class="d-flex gap-2"></div>
                        <button id="nextPage" class="x_pagination-btn ms-2"> <i
                                class="fa-solid fa-chevron-right ms-1"></i></button>
                    </div>
                </div>
                <!-- Blog Sidebar (Desktop) -->
                <div class="col-lg-4 d-none d-lg-block x_blog-sidebar">
                    <!-- ...existing code for sidebar widgets... -->
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
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('frontend/images/blog1.jpg') }}" class="x_blog-top-thumb me-3"
                                    alt="Black Angel" width="50">
                                <div>
                                    <div class="x_blog-top-title">Black Angel</div>
                                    <div class="x_blog-top-date">June 7, 2017</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center x_line_li_tb mb-3">
                                <img src="{{ asset('frontend/images/blog2.jpg') }}" class="x_blog-top-thumb me-3"
                                    alt="Black Castle" width="50">
                                <div>
                                    <div class="x_blog-top-title">Black Castle</div>
                                    <div class="x_blog-top-date">June 7, 2017</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('frontend/images/blog3.jpg') }}" class="x_blog-top-thumb me-3"
                                    alt="Black Wings" width="50">
                                <div>
                                    <div class="x_blog-top-title">Black Wings</div>
                                    <div class="x_blog-top-date">June 6, 2017</div>
                                </div>
                            </div>
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
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('frontend/images/blog1.jpg') }}" class="x_blog-top-thumb me-3"
                                        alt="Black Angel" width="50">
                                    <div>
                                        <div class="x_blog-top-title">Black Angel</div>
                                        <div class="x_blog-top-date">June 7, 2017</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center x_line_li_tb mb-3">
                                    <img src="{{ asset('frontend/images/blog2.jpg') }}" class="x_blog-top-thumb me-3"
                                        alt="Black Castle" width="50">
                                    <div>
                                        <div class="x_blog-top-title">Black Castle</div>
                                        <div class="x_blog-top-date">June 7, 2017</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('frontend/images/blog3.jpg') }}" class="x_blog-top-thumb me-3"
                                        alt="Black Wings" width="50">
                                    <div>
                                        <div class="x_blog-top-title">Black Wings</div>
                                        <div class="x_blog-top-date">June 6, 2017</div>
                                    </div>
                                </div>
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
        document.addEventListener('DOMContentLoaded', function() {
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

                // Update pagination buttons
                prevButton.disabled = page === 1;
                nextButton.disabled = page === totalPages;

                // Update page numbers
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

            // Show first page initially
            showPage(1);
        });
    </script>
@endpush
