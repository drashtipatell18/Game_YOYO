@extends('frontend.layouts.main')
@section('content')
    <style>
        /* Custom Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin: 32px 0 16px 0;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination a,
        .pagination span {
            display: inline-block;
            min-width: 36px;
            height: 36px;
            line-height: 36px;
            text-align: center;
            font-size: 16px;
            font-weight: 500;
            color: #8a775a;
            background: #fff;
            border: 1px solid #8a775a;
            border-radius: 8px;
            margin: 0 2px;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }

        .pagination a:hover,
        .pagination .active a,
        .pagination .active span {
            background: linear-gradient(135deg, #8a775a, #5e4d3a);
            color: #fff;
            border-color: #5e4d3a;
            transform: scale(1.08);
        }

        .pagination .disabled a,
        .pagination .disabled span {
            color: #ccc;
            border-color: #eee;
            background: #f8f8f8;
            cursor: not-allowed;
        }

        .pagination .page-link i {
            font-size: 18px;
            vertical-align: middle;
        }



        @media (max-width: 576px) {

            .pagination a,
            .pagination span {
                min-width: 28px;
                height: 28px;
                line-height: 28px;
                font-size: 13px;
                border-radius: 6px;
            }

            .pagination .page-link i {
                font-size: 15px;
            }
            .pagination {
                --bs-pagination-padding-x: 0!important;
                --bs-pagination-padding-y: 0!important;
            }
        }

       
    </style>
    <!-- Hero Section Start -->
    <div class="Z_cards_hero">
        <div class="Z_cart_hero-overlay">
            <h1 class="Z_about_title">YOYO STORE</h1>
        </div>
    </div>

    <div class="s_body_img py-5 text-white">
        <div class="a_header_container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 d-none d-lg-block">
                    <div class=" p-4">
                        <div class="accordion s_accordion" id="accordionExample">
                            <!-- Price Filter -->
                            <div class="accordion-item" style="border: 1px solid #ad9d79;">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h5> Price</h5>&nbsp
                                        <span class="badge usd-badge">USD</span>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class="ps-0">
                                            <li><input type="checkbox" name="price" value="0-99"> $0 - $99</li>
                                            <li><input type="checkbox" name="price" value="100-199"> $100 - $199</li>
                                            <li><input type="checkbox" name="price" value="200-299"> $200 - $299</li>
                                            <li><input type="checkbox" name="price" value="300-399"> $300 - $399</li>
                                            <li><input type="checkbox" name="price" value="400-499"> $400 - $499</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Category Filter -->
                            <div class="accordion-item" style="border: 1px solid #ad9d79;">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <h5>Category</h5>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class="ps-0" id="categoryFilterListDesktop" name="categoryFilterListDesktop">
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="offcanvas offcanvas-start d-lg-none d_offcan_width" tabindex="-1" id="filterOffcanvas"
                    aria-labelledby="filterOffcanvasLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title text-white" id="filterOffcanvasLabel">Filters</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="accordion s_accordion" id="accordionExampleMobile">
                            <!-- Price Filter -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseMobileOne" aria-expanded="true"
                                        aria-controls="collapseMobileOne">
                                        <h5 class="mb-0"> Price
                                            <span class="badge usd-badge">USD</span>
                                        </h5>
                                    </button>
                                </h2>
                                <div id="collapseMobileOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExampleMobile">
                                    <div class="accordion-body">
                                        <ul class="ps-0">
                                            <li><input type="checkbox" name="price" value="0-99"> $0 - $99</li>
                                            <li><input type="checkbox" name="price" value="100-199"> $100 - $199</li>
                                            <li><input type="checkbox" name="price" value="200-299"> $200 - $299</li>
                                            <li><input type="checkbox" name="price" value="300-399"> $300 - $399</li>
                                            <li><input type="checkbox" name="price" value="400-499"> $400 - $499</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Category Filter -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseMobileTwo" aria-expanded="false"
                                        aria-controls="collapseMobileTwo">
                                        <h5 class="mb-0">Category</h5>
                                    </button>
                                </h2>
                                <div id="collapseMobileTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExampleMobile">
                                    <div class="accordion-body">
                                        <ul class="ps-0" id="categoryFilterListMobile"></ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Product Display Area -->

                <div class="col-xl-9 col-lg-8">
                    <div class="d-flex px-md-4  justify-content-between align-items-center mb-3">
                        <div class="d-none">
                            <i id="gridView" class="fa-solid fa-grip active mx-2 text-white"></i>
                            <i id="listView" class="fa-solid fa-list me-2 text-white d-md-block d-none"></i>
                        </div>
                        <!-- <div class="mb-3">
                                                                                                                    <span id="productCount" >Showing 6 products</span>
                                                                                                                </div> -->
                        <div class="d-block d-lg-none">
                            <button class="btn border text-white" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#filterOffcanvas" aria-controls="filterOffcanvas">Filters
                            </button>
                        </div>
                        <div class="dropdown s_sort-dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="sortDropdownBtn"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Sort By: <span id="selectedSort" style="color: #ad9d79;">Featured</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="sortDropdownBtn">
                                <li><a class="dropdown-item active" href="#" data-value="featured">Featured</a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-value="name-asc">Alphabetically, A-Z</a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-value="name-desc">Alphabetically,
                                        Z-A</a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-value="price-asc">Price, low to high</a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-value="price-desc">Price, high to
                                        low</a>
                                </li>
                            </ul>

                        </div>

                    </div>

                    <!-- Products Count -->
                    <div class="mb-3 px-md-4">
                        <span id="productCount" class="text-white">Loading...</span>
                    </div>

                    <!-- Grid View -->
                    <div id="gridContainer" class="row product-list"></div>

                    <ul class="pagination" id="pagination"></ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let cardsData = [];
        let allProducts = [];
        let allCategories = [];
        let filteredProducts = [];
        let currentSort = 'featured';
        let currentPage = 1;

        document.addEventListener("DOMContentLoaded", function() {
            initializeApp();
        });

        async function initializeApp() {
            try {
                // Fetch data
                const [products, categories] = await Promise.all([
                    fetch("productsJson").then(res => res.json()),
                    fetch("categoriesJson").then(res => res.json())
                ]);

                // Store data globally
                allProducts = products;
                allCategories = categories;

                // Create category map for quick lookup
                const catMap = {};
                categories.forEach(cat => {
                    catMap[cat.id] = cat.name;
                });

                // Transform products data to include category names
                allProducts = allProducts.map(product => ({
                    ...product,
                    category_name: catMap[product.category_id] || catMap[product.cat_id] || "Unknown"
                }));

                const urlParams = new URLSearchParams(window.location.search);
                const categoryIdFromUrl = urlParams.get('category'); // e.g. '7'

                if (categoryIdFromUrl) {
                    // Filter products by category from URL
                    filteredProducts = allProducts.filter(product =>
                        product.category_id == categoryIdFromUrl || product.cat_id == categoryIdFromUrl
                    );
                } else {
                    filteredProducts = [...allProducts];
                }



                console.log('Products loaded:', allProducts);
                console.log('Categories loaded:', allCategories);
                console.log('Filtered products by category:', filteredProducts);

                // Initialize UI
                renderCategoryFilters();
                renderProducts();
                setupEventListeners();
                updateProductCount();
            } catch (error) {
                console.error('Failed to initialize app:', error);
                const productCount = document.getElementById('productCount');
                if (productCount) {
                    productCount.textContent = 'Failed to load products';
                }
            }
        }

        function renderCategoryFilters() {
            const desktopList = document.getElementById("categoryFilterListDesktop");
            const mobileList = document.getElementById("categoryFilterListMobile");

            const categoryHTML = allCategories.map(cat =>
                `<li><input type="checkbox" name="category" value="${cat.id}" id="cat_${cat.id}">
         <label for="cat_${cat.id}">${cat.name}</label></li>`
            ).join('');

            if (desktopList) {
                desktopList.innerHTML = categoryHTML;
            }
            if (mobileList) {
                mobileList.innerHTML = categoryHTML;
            }
        }

        function applyFilters() {
            console.log('Applying filters...');

            // Get selected filters
            const selectedPrices = Array.from(document.querySelectorAll('input[name="price"]:checked')).map(i => i.value);
            const selectedCategories = Array.from(document.querySelectorAll('input[name="category"]:checked')).map(i =>
                parseInt(i.value));

            console.log('Selected categories:', selectedCategories);
            console.log('Selected prices:', selectedPrices);

            // Filter products
            filteredProducts = allProducts.filter(product => {
                // Price filter
                const productPrice = parseFloat(product.price);
                const priceMatch = selectedPrices.length === 0 || selectedPrices.some(range => {
                    const [min, max] = range.split('-').map(Number);
                    return productPrice >= min && productPrice <= max;
                });

                // Category filter - check both category_id and cat_id fields
                const productCategoryId = product.category_id || product.cat_id;
                const categoryMatch = selectedCategories.length === 0 || selectedCategories.includes(parseInt(
                    productCategoryId));

                console.log(
                    `Product ${product.name}: categoryId=${productCategoryId}, priceMatch=${priceMatch}, categoryMatch=${categoryMatch}`
                );

                return priceMatch && categoryMatch;
            });

            console.log('Filtered products:', filteredProducts);

            // Apply sorting
            applySorting();

            // Reset to first page when filters change
            currentPage = 1;
            renderProducts();
            updateProductCount();
        }

        function applySorting() {
            switch (currentSort) {
                case 'name-asc':
                    filteredProducts.sort((a, b) => (a.name || a.title || '').localeCompare(b.name || b.title || ''));
                    break;
                case 'name-desc':
                    filteredProducts.sort((a, b) => (b.name || b.title || '').localeCompare(a.name || a.title || ''));
                    break;
                case 'price-asc':
                    filteredProducts.sort((a, b) => parseFloat(a.price) - parseFloat(b.price));
                    break;
                case 'price-desc':
                    filteredProducts.sort((a, b) => parseFloat(b.price) - parseFloat(a.price));
                    break;
                default:
                    // Featured or default - keep original order
                    break;
            }
        }

        function renderProducts() {
            const gridContainer = document.getElementById('gridContainer');
            const listContainer = document.getElementById('listContainer');

            if (!gridContainer) {
                console.error('Grid container not found');
                return;
            }

            // Clear containers
            gridContainer.innerHTML = "";
            if (listContainer) {
                listContainer.innerHTML = "";
            }

            // Calculate pagination
            const productsPerPage = 12;
            const totalProducts = filteredProducts.length;
            const totalPages = Math.ceil(totalProducts / productsPerPage);

            // Ensure current page is valid
            if (currentPage < 1) currentPage = 1;
            if (currentPage > totalPages && totalPages > 0) currentPage = totalPages;

            // Calculate start and end indices
            const startIndex = (currentPage - 1) * productsPerPage;
            const endIndex = Math.min(startIndex + productsPerPage, totalProducts);

            // Get products for current page
            const currentPageProducts = filteredProducts.slice(startIndex, endIndex);

            console.log(`Rendering ${currentPageProducts.length} products for page ${currentPage}`);

            // Render products
            currentPageProducts.forEach(product => {
                const categoryName = product.category_name || "Unknown";
                const firstImage = (product.image && typeof product.image === 'string') ?
                    product.image.split(',')[0].trim() :
                    'default.jpg';

                const productPrice = parseFloat(product.price).toFixed(2);

                gridContainer.innerHTML += `
            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 mb-4 d-flex justify-content-center">
                <div class="game-card position-relative" data-id="${product.id}">
                    <img src="${firstImage}" alt="${product.name}" class="card-img-top" />
                    <div class="position-absolute card-content">
                        <h3>${product.name}</h3>
                        <h3 class="mb-0">$${productPrice}
                        <span class="badge usd-badge">USD</span></h3>
                        <span class="badge bg-secondary mt-2">${categoryName}</span>
                    </div>
                    <div class="card-actions d-flex align-items-center gap-3">
                        <div class="d_main_button w-100">
                            <button class="custom-cart-btn w-100" data-id="${product.id}">ADD TO CART</button>
                            <div class="d_border"></div>
                        </div>
                    </div>
                </div>
            </div>
        `;

                // Render list view if container exists
                if (listContainer) {
                    listContainer.innerHTML += `
                <div class="card mb-3 list-card border-1 border-light" style="background: rgba(34,34,34,0.92); color:#fff; border:none;">
                    <div class="row g-0 align-items-center">
                        <div class="col-sm-4 d-flex align-items-center justify-content-center" style="min-height:180px;">
                            <div style="background:rgba(24,24,24,0.95); border-radius:16px; padding:12px; display:flex; align-items:center; justify-content:center; width:130px; height:130px;">
                                <img src="${firstImage}" alt="${product.name}" style="width: 120px; height: 120px; object-fit: cover; border-radius: 12px; box-shadow:0 2px 8px rgba(0,0,0,0.2); background:#181818;" />
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-body d-flex flex-column justify-content-between h-100" style="min-height: 160px;">
                                <div>
                                    <h5 class="card-title mb-2" style="color:#ad9d79;">${product.name}</h5>
                                    <p class="card-text fw-bold mb-1 text-white">$${productPrice}</p>
                                    <span class="badge usd-badge">USD</span>
                                    <p class="card-text mb-2 text-white"><small>${product.description || ''}</small></p>
                                    <span class="badge bg-secondary">${categoryName}</span>
                                </div>
                                <div class="d-flex align-items-center gap-3 mt-auto">
                                    <button class="btn btn-sm s_cart_btn custom-cart-btn" data-id="${product.id}">ADD TO CART</button>
                                    <i class="fa-regular fa-heart fs-5" onclick="toggleWishlist(${product.id})" style="cursor:pointer;"></i>
                                    <i class="fa-solid fa-eye fs-6" onclick="viewDetails(${product.id})" style="cursor:pointer;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                }
            });

            // Generate pagination if needed
            if (totalPages > 1) {
                generatePagination(currentPage, totalPages);
            }

            // Add event listeners to product cards and buttons
            addProductEventListeners();
        }

        function updateProductCount() {
            const productCount = document.getElementById('productCount');
            if (productCount) {
                const productsPerPage = 12;
                const totalProducts = filteredProducts.length;
                const startIndex = (currentPage - 1) * productsPerPage;
                const endIndex = Math.min(startIndex + productsPerPage, totalProducts);

                if (totalProducts > 0) {
                    productCount.textContent = `Showing ${startIndex + 1}-${endIndex} of ${totalProducts} products`;
                } else {
                    productCount.textContent = 'No products found';
                }
            }
        }

        function generatePagination(currentPageParam, totalPages) {
            const pagination = document.getElementById('pagination');
            if (!pagination) return;

            pagination.innerHTML = '';

            function addPage(page, text = page, active = false, disabled = false) {
                const li = document.createElement('li');
                li.className = `page-item ${active ? 'active' : ''} ${disabled ? 'disabled' : ''}`;

                const element = document.createElement(active || disabled ? 'span' : 'a');
                element.className = 'page-link';
                element.innerHTML = text;

                if (!disabled && !active) {
                    element.href = '#';
                    element.onclick = (e) => {
                        e.preventDefault();
                        // Update the global currentPage variable
                        currentPage = page;

                        // Update URL (optional)
                        const url = new URL(window.location);
                        url.searchParams.set('page', page);
                        window.history.pushState({}, '', url);

                        // Re-render products with new page
                        renderProducts();

                        // Update product count
                        updateProductCount();
                    };
                }

                li.appendChild(element);
                pagination.appendChild(li);
            }

            // Previous button
            addPage(currentPageParam - 1, '<i class="fa fa-angle-left"></i>', false, currentPageParam === 1);

            // Mobile-friendly pagination logic
            if (totalPages <= 5) {
                // Show all pages if 5 or fewer
                for (let i = 1; i <= totalPages; i++) {
                    addPage(i, i, i === currentPageParam);
                }
            } else {
                // Mobile pagination: Show first, current, and last page with dots
                if (currentPageParam === 1) {
                    // First page: show 1, 2, ..., last
                    addPage(1, '1', true);
                    addPage(2, '2', false);

                    const dots = document.createElement('li');
                    dots.className = 'page-item disabled';
                    dots.innerHTML = '<span class="page-link">...</span>';
                    pagination.appendChild(dots);

                    addPage(totalPages, totalPages, false);
                } else if (currentPageParam === totalPages) {
                    // Last page: show 1, ..., last-1, last
                    addPage(1, '1', false);

                    const dots = document.createElement('li');
                    dots.className = 'page-item disabled';
                    dots.innerHTML = '<span class="page-link">...</span>';
                    pagination.appendChild(dots);

                    addPage(totalPages - 1, totalPages - 1, false);
                    addPage(totalPages, totalPages, true);
                } else {
                    // Middle pages: show 1, ..., current, ..., last
                    addPage(1, '1', false);

                    const dots1 = document.createElement('li');
                    dots1.className = 'page-item disabled';
                    dots1.innerHTML = '<span class="page-link">...</span>';
                    pagination.appendChild(dots1);

                    addPage(currentPageParam, currentPageParam, true);

                    const dots2 = document.createElement('li');
                    dots2.className = 'page-item disabled';
                    dots2.innerHTML = '<span class="page-link">...</span>';
                    pagination.appendChild(dots2);

                    addPage(totalPages, totalPages, false);
                }
            }

            // Next button
            addPage(currentPageParam + 1, '<i class="fa fa-angle-right"></i>', false, currentPageParam === totalPages);
        }

        // Also add this function to handle URL-based pagination on page load
        function initializePaginationFromURL() {
            const urlParams = new URLSearchParams(window.location.search);
            const pageParam = urlParams.get('page');
            if (pageParam) {
                const pageNum = parseInt(pageParam);
                if (pageNum > 0) {
                    currentPage = pageNum;
                }
            }
        }

        function addProductEventListeners() {
            // Add click event to product cards for navigation
            document.querySelectorAll('.game-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    // Prevent navigation if the click was on the ADD TO CART button
                    if (e.target.closest('.custom-cart-btn')) return;

                    const id = this.getAttribute('data-id');
                    // Store item id for single product page
                    if (typeof Storage !== "undefined") {
                        localStorage.setItem('item_id', id);
                    }
                    window.location.href = '/productDetails/' + id;
                });
            });

            // Add click event to cart buttons
            document.querySelectorAll('.custom-cart-btn').forEach(btn => {
                btn.addEventListener('click', async function(e) {
                    e.stopPropagation();
                    const pro_id = Number(this.getAttribute('data-id'));
                    await addToCart(pro_id);
                });
            });
        }

        function setupEventListeners() {
            // Filter change listeners
            document.body.addEventListener('change', function(e) {
                if (e.target.name === 'category' || e.target.name === 'price') {
                    applyFilters();
                }
            });

            // Sort dropdown listeners
            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', e => {
                    e.preventDefault();

                    // Remove active class from all
                    document.querySelectorAll('.dropdown-item').forEach(i => i.classList.remove('active'));

                    // Add active to selected
                    item.classList.add('active');

                    // Update visible text and sort value
                    const label = item.textContent;
                    currentSort = item.getAttribute('data-value');
                    document.getElementById('selectedSort').textContent = label;

                    // Apply new sorting
                    applyFilters();
                });
            });

            // Mobile menu functionality
            setupMobileMenu();

            // User dropdown functionality
            setupUserDropdown();
        }

        function setupMobileMenu() {
            const toggler = document.querySelector('.d_toggler_btn');
            const offcanvas = document.getElementById('d_offcanvas_menu');
            const closeBtn = offcanvas?.querySelector('.close_btn');

            if (toggler && offcanvas && closeBtn) {
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
            }
        }

        function setupUserDropdown() {
            const dbUserIcon = document.getElementById('db_user_icon');
            const dbUserDropdown = document.getElementById('db_user_dropdown');

            if (dbUserIcon && dbUserDropdown) {
                dbUserIcon.addEventListener('click', (e) => {
                    e.stopPropagation();
                    dbUserDropdown.style.display = dbUserDropdown.style.display === 'block' ? 'none' : 'block';
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', () => {
                    dbUserDropdown.style.display = 'none';
                });
            }
        }






        // Enhanced items per page functionality
        function changeItemsPerPage(newItemsPerPage) {
            const oldItemsPerPage = itemsPerPage;
            itemsPerPage = parseInt(newItemsPerPage);

            // Calculate new page to maintain roughly the same position
            const firstItemIndex = (currentPage - 1) * oldItemsPerPage;
            currentPage = Math.floor(firstItemIndex / itemsPerPage) + 1;

            // Ensure we don't exceed max pages
            const maxPages = Math.ceil(totalItems / itemsPerPage);
            if (currentPage > maxPages) currentPage = maxPages;
            if (currentPage < 1) currentPage = 1;

            renderCurrentPage();
            renderPagination();
        }

        // Grid/List view toggle (enhanced)
        const gridBtn = document.getElementById('gridView');
        const listBtn = document.getElementById('listView');
        const gridContainer = document.getElementById('gridContainer');
        const listContainer = document.getElementById('listContainer');

        if (gridBtn && listBtn) {
            gridBtn.addEventListener('click', () => {
                gridContainer.classList.remove('d-none');
                listContainer.classList.add('d-none');
                gridBtn.classList.add('active');
                listBtn.classList.remove('active');

                // Re-attach event listeners after view change
                setTimeout(attachCartEventListeners, 100);
            });

            listBtn.addEventListener('click', () => {
                gridContainer.classList.add('d-none');
                listContainer.classList.remove('d-none');
                listBtn.classList.add('active');
                gridBtn.classList.remove('active');

                // Re-attach event listeners after view change
                setTimeout(attachCartEventListeners, 100);
            });
        }

        // Card creation functions (unchanged)
        function createGridCard(cardData) {
            const firstImage = cardData.image ? cardData.image.split(',')[0].trim() : 'default.jpg';
            return `
        <div class="col-12 col-sm-6 col-md-4 col-lg-6 col-xl-4 mb-4 d-flex justify-content-center">
            <div class="game-card position-relative" data-id="${cardData.id}">
                <img src="${firstImage}" alt="${cardData.name}" class="card-img-top" />
                <div class="position-absolute card-content">
                    <h3>${cardData.name}</h3>
                    <h3 class="mb-0">${cardData.price}
                    <span class="badge usd-badge">USD</span></h3>
                </div>
                <div class="card-actions d-flex align-items-center gap-3">
                    <div class="d_main_button w-100">
                        <button class="custom-cart-btn w-100" data-id="${cardData.id}">
                            <span class="btn-text">ADD TO CART</span>
                            <div class="spinner-border spinner-border-sm d-none" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                        <div class="d_border"></div>
                    </div>
                </div>
            </div>
        </div>
    `;
        }

        function createListCard(cardData) {
            return `
        <div class="card mb-3 list-card border-1 border-light" style="background: rgba(34,34,34,0.92) url('../images/inner-background-img-3.jpg'); background-blend-mode: darken, normal; color:#fff; border:none; box-shadow: 0 8px 32px 0 rgba(0,0,0,0.35), 0 1.5px 6px 0 rgba(0,0,0,0.25);">
            <div class="row g-0 align-items-center game-card" data-id="${cardData.id}">
                <div class="col-sm-4 d-flex align-items-center justify-content-center" style="min-height:180px;">
                    <div style="background:rgba(24,24,24,0.95); border-radius:16px; padding:12px; display:flex; align-items:center; justify-content:center; width:130px; height:130px;">
                        <img src="${cardData.image}" alt="${cardData.name}" style="width: 120px; height: 120px; object-fit: cover; border-radius: 12px; box-shadow:0 2px 8px rgba(0,0,0,0.2); background:#181818;" />
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card-body d-flex flex-column justify-content-between h-100" style="min-height: 160px;">
                        <div>
                            <h5 class="card-title mb-2" style="color:#ad9d79;">${cardData.name}</h5>
                            <p class="card-text fw-bold mb-1 text-white">${cardData.price}</p>
                            <span class="badge usd-badge">USD</span>
                            <p class="card-text mb-2 text-white"><small class="">${cardData.description}</small></p>
                        </div>
                        <div class="d-flex align-items-center gap-3 mt-auto">
                            <button class="btn btn-sm s_cart_btn custom-cart-btn text-nowrap" data-id="${cardData.id}">
                                <span class="btn-text">ADD TO CART</span>
                                <div class="spinner-border spinner-border-sm d-none" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                            <i class="fa-solid fa-eye fs-6" onclick="viewDetails(${cardData.id})" style="cursor:pointer;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
        }

        // Enhanced filtering functionality
        function filterCards(sortValue) {
            const selectedPrices = Array.from(document.querySelectorAll('input[name="price"]:checked')).map(i => i.value);
            const selectedCategories = Array.from(document.querySelectorAll('input[name="category"]:checked')).map(i => i
                .value);
            const currentSortValue = sortValue || document.querySelector('.dropdown-item.active')?.dataset.value ||
                "featured";

            const filtered = cardsData.filter(card => {
                const price = parseFloat(card.price.replace('$', ''));
                const priceMatch = selectedPrices.length === 0 || selectedPrices.some(range => {
                    const [min, max] = range.split('-').map(Number);
                    return price >= min && price <= max;
                });

                const categoryMatch = selectedCategories.length === 0 || selectedCategories.includes(card.category);

                return priceMatch && categoryMatch;
            });

            const sorted = sortCards(filtered, currentSortValue);

            // Update pagination data
            filteredData = sorted;
            totalItems = filteredData.length;
            currentPage = 1; // Reset to first page when filtering

            // Render first page and pagination
            renderCurrentPage();
            renderPagination();
        }

        // Sorting functionality (unchanged)
        function sortCards(cards, sortValue) {
            return [...cards].sort((a, b) => {
                const priceA = parseFloat(a.price.replace('$', ''));
                const priceB = parseFloat(b.price.replace('$', ''));
                const nameA = (a.name || '').toLowerCase();
                const nameB = (b.name || '').toLowerCase();

                switch (sortValue) {
                    case 'name-asc':
                        return nameA.localeCompare(nameB);
                    case 'name-desc':
                        return nameB.localeCompare(nameA);
                    case 'price-asc':
                        return priceA - priceB;
                    case 'price-desc':
                        return priceB - priceA;
                    default:
                        return 0;
                }
            });
        }

        // Enhanced event handling
        document.addEventListener('DOMContentLoaded', function() {
            // Handle dropdown sorting with event delegation
            document.addEventListener('click', function(e) {
                if (e.target.matches('.dropdown-item')) {
                    e.preventDefault();

                    // Remove active class from all
                    document.querySelectorAll('.dropdown-item').forEach(i => i.classList.remove('active'));

                    // Add active to selected
                    e.target.classList.add('active');

                    // Update visible text
                    const label = e.target.textContent;
                    const value = e.target.getAttribute('data-value');
                    const selectedSortEl = document.getElementById('selectedSort');
                    if (selectedSortEl) {
                        selectedSortEl.textContent = label;
                    }

                    // Trigger filtering with sort
                    filterCards(value);
                }
            });

            // Filter event binding using delegation
            document.body.addEventListener('change', function(e) {
                if (e.target.name === 'category' || e.target.name === 'price') {
                    filterCards();
                }
            });
        });

        // Rest of the functions remain the same (addToCart, toggleWishlist, etc.)
        function addToCart(productId, quantity = 1, buttonElement = null) {
            if (buttonElement) {
                setButtonLoading(buttonElement, true);
            }

            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('quantity', quantity);

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification(data.message, 'success');
                        updateCartCount(data.cart_count);

                        if (buttonElement) {
                            const originalText = buttonElement.querySelector('.btn-text').textContent;
                            buttonElement.querySelector('.btn-text').textContent = 'ADDED!';
                            buttonElement.classList.add('btn-success');

                            setTimeout(() => {
                                buttonElement.querySelector('.btn-text').textContent = originalText;
                                buttonElement.classList.remove('btn-success');
                            }, 2000);
                        }

                        setTimeout(() => {
                            window.location.href = '/cart';
                        }, 1500);

                    } else {
                        showNotification(data.message, 'error');

                        if (data.message.includes('login')) {
                            setTimeout(() => {
                                window.location.href = '/frontend-login';
                            }, 2000);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Something went wrong. Please try again.', 'error');
                })
                .finally(() => {
                    if (buttonElement) {
                        setButtonLoading(buttonElement, false);
                    }
                });
        }

        function toggleWishlist(id) {
            const card = cardsData.find(c => c.id === id);
            if (!card) return;
            alert(`Added "${card.name}" to wishlist!`);
        }

        function viewDetails(id) {
            const baseUrl = window.location.origin;
            window.location.href = `${baseUrl}/productDetails/${id}`;
        }

        function attachCartEventListeners() {
            const cartButtons = document.querySelectorAll('.custom-cart-btn');

            cartButtons.forEach(button => {
                // Remove existing listeners to prevent duplicates
                button.removeEventListener('click', handleCartClick);
                button.addEventListener('click', handleCartClick);
            });
        }

        function handleCartClick(e) {
            e.preventDefault();
            e.stopPropagation();

            const productId = this.getAttribute('data-id');
            addToCart(productId, 1, this);
        }

        // Utility functions (unchanged)
        function setButtonLoading(button, isLoading) {
            const btnText = button.querySelector('.btn-text');
            const spinner = button.querySelector('.spinner-border');

            if (isLoading) {
                btnText.style.display = 'none';
                spinner.classList.remove('d-none');
                button.disabled = true;
            } else {
                btnText.style.display = 'inline';
                spinner.classList.add('d-none');
                button.disabled = false;
            }
        }

        function updateCartCount(count) {
            const cartCountElements = document.querySelectorAll('.cart-count');
            cartCountElements.forEach(element => {
                element.textContent = count;
                element.classList.add('cart-updated');
                setTimeout(() => {
                    element.classList.remove('cart-updated');
                }, 600);
            });
        }

        function showNotification(message, type = 'info') {
            if (type === 'success') {
                console.log('Success:', message);
                createNotification(message, 'success');
            } else if (type === 'error') {
                console.error('Error:', message);
                createNotification(message, 'error');
            }
        }

        function createNotification(message, type) {
            const existingNotifications = document.querySelectorAll('.custom-notification');
            existingNotifications.forEach(notification => notification.remove());

            const notification = document.createElement('div');
            notification.className =
                `custom-notification alert alert-${type === 'success' ? 'success' : 'danger'} position-fixed`;
            notification.style.cssText = `
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        animation: slideIn 0.3s ease-out;
    `;
            notification.innerHTML = `
        <div class="d-flex align-items-center">
            <span>${message}</span>
            <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
        </div>
    `;

            document.body.appendChild(notification);

            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }

        // Function to redirect to cart page
        function redirectToCart() {
            window.location.href = '/cart';
        }

        // Function to get cart items (useful for cart page)
        function loadCartItems() {
            fetch('/cart/items', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        renderCartItems(data.cart_items, data.total);
                        updateCartCount(data.count);
                    }
                })
                .catch(error => {
                    console.error('Error loading cart:', error);
                });
        }

        // Function to render cart items (for cart page)
        function renderCartItems(cartItems, total) {
            const cartContainer = document.getElementById('cartItemsContainer');
            if (!cartContainer) return;

            if (cartItems.length === 0) {
                cartContainer.innerHTML = `
            <div class="text-center py-5">
                <h4>Your cart is empty</h4>
                <p>Add some products to get started!</p>
                <a href="/" class="btn btn-primary">Continue Shopping</a>
            </div>
        `;
                return;
            }

            let cartHTML = '';
            cartItems.forEach(item => {
                cartHTML += `
            <div class="cart-item row mb-3 p-3 border rounded" data-cart-id="${item.id}">
                <div class="col-md-2">
                    <img src="${item.product.image}" alt="${item.product.name}" class="img-fluid">
                </div>
                <div class="col-md-4">
                    <h5>${item.product.name}</h5>
                    <p class="text-muted">$${parseFloat(item.price).toFixed(2)}</p>
                </div>
                <div class="col-md-3">
                    <div class="quantity-controls d-flex align-items-center">
                        <button class="btn btn-outline-secondary btn-sm" onclick="updateCartQuantity(${item.id}, ${item.quantity - 1})">-</button>
                        <span class="mx-3">${item.quantity}</span>
                        <button class="btn btn-outline-secondary btn-sm" onclick="updateCartQuantity(${item.id}, ${item.quantity + 1})">+</button>
                    </div>
                </div>
                <div class="col-md-2">
                    <strong>$${(item.quantity * item.price).toFixed(2)}</strong>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-danger btn-sm" onclick="removeFromCart(${item.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
            });

            cartHTML += `
        <div class="cart-total text-end mt-4">
            <h4>Total: $${total.toFixed(2)}</h4>
            <button class="btn btn-success btn-lg mt-3">Proceed to Checkout</button>
        </div>
    `;

            cartContainer.innerHTML = cartHTML;
        }

        // Function to update cart quantity
        function updateCartQuantity(cartId, newQuantity) {
            if (newQuantity < 1) {
                removeFromCart(cartId);
                return;
            }

            const formData = new FormData();
            formData.append('cart_id', cartId);
            formData.append('quantity', newQuantity);

            fetch('/cart/update', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadCartItems(); // Reload cart items
                    } else {
                        showNotification(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error updating cart', 'error');
                });
        }

        // Function to remove item from cart
        function removeFromCart(cartId) {
            if (!confirm('Are you sure you want to remove this item?')) {
                return;
            }

            fetch('/cart/remove', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        cart_id: cartId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadCartItems(); // Reload cart items
                        showNotification(data.message, 'success');
                    } else {
                        showNotification(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error removing item', 'error');
                });
        }

        // Initialize cart functionality when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // If on cart page, load cart items
            if (window.location.pathname === '/cart') {
                loadCartItems();
            }

            // Load initial cart count
            if (document.querySelector('.cart-count')) {
                fetch('/cart/items')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateCartCount(data.count);
                        }
                    })
                    .catch(error => console.log('Error loading cart count:', error));
            }
        });

        // CSS for animations (add to your CSS file)
        const style = document.createElement('style');
        style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .cart-updated {
        animation: bounce 0.6s ease-in-out;
    }

    @keyframes bounce {
        0%, 20%, 60%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        80% {
            transform: translateY(-5px);
        }
    }

    .custom-cart-btn {
        transition: all 0.3s ease;
    }

    .custom-cart-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
`;
        document.head.appendChild(style);
    </script>

    <!-- Categories filter script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("categoriesJson")
                .then(res => res.json())
                .then(categories => {
                    // Desktop filter
                    const filterListDesktop = document.getElementById("categoryFilterListDesktop");
                    if (filterListDesktop) {
                        filterListDesktop.innerHTML = "";
                        categories.forEach(cat => {
                            const catId = cat.id;
                            filterListDesktop.innerHTML += `
                                <li>
                                    <input type="checkbox" name="category" value="${catId}"> ${cat.name || "Unnamed"}
                                </li>
                            `;
                        });
                    }

                    // Mobile filter
                    const filterListMobile = document.getElementById("categoryFilterListMobile");
                    if (filterListMobile) {
                        filterListMobile.innerHTML = "";
                        categories.forEach(cat => {
                            filterListMobile.innerHTML += `
                                <li>
                                    <input type="checkbox" name="category" value="${cat.id}"> ${cat.name || "Unnamed"}
                                </li>
                            `;
                        });

                        // Close offcanvas on selection
                        filterListMobile.addEventListener('change', function(e) {
                            const offcanvas = document.getElementById('filterOffcanvas');
                            if (offcanvas && typeof bootstrap !== 'undefined') {
                                const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvas);
                                bsOffcanvas.hide();
                            } else if (offcanvas) {
                                offcanvas.classList.remove('show');
                                offcanvas.style.visibility = 'hidden';
                            }
                        });
                    }
                });
        });
    </script>

    <!-- Header and offcanvas script -->
    <script>
        (function() {
            const toggler = document.querySelector('.d_toggler_btn');
            const offcanvas = document.getElementById('d_offcanvas_menu');

            if (toggler && offcanvas) {
                const closeBtn = offcanvas.querySelector('.close_btn');

                toggler.addEventListener('click', () => {
                    offcanvas.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });

                if (closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        offcanvas.classList.remove('active');
                        document.body.style.overflow = '';
                    });
                }

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
            }

            // Sticky header scroll effect
            window.addEventListener('scroll', () => {
                const header = document.querySelector('.d_header');
                if (header) {
                    if (window.scrollY > 20) {
                        header.classList.add('d_scrolled');
                    } else {
                        header.classList.remove('d_scrolled');
                    }
                }
            });
        })();
    </script>

    <!-- Sort functionality initialization -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initial fetch and render
            setTimeout(() => {
                fetchAndRenderProducts('featured');
            }, 100);

            // Handle sort dropdown click
            document.addEventListener('click', function(e) {
                if (e.target.matches('.s_sort-dropdown .dropdown-item')) {
                    e.preventDefault();

                    // Remove active from all, add to selected
                    document.querySelectorAll('.s_sort-dropdown .dropdown-item').forEach(i => i.classList
                        .remove('active'));
                    e.target.classList.add('active');

                    // Update label
                    const selectedSortEl = document.getElementById('selectedSort');
                    if (selectedSortEl) {
                        selectedSortEl.textContent = e.target.textContent;
                    }

                    // Fetch and render with selected sort
                    fetchAndRenderProducts(e.target.dataset.value);
                }
            });
        });
    </script>
@endpush
