@extends('frontend.layouts.main')
@section('content')
    <!-- Hero Section Start -->
    <div class="Z_cards_hero">
        <div class="Z_cart_hero-overlay">
            <h1 class="Z_about_title">Yoyo Store</h1>
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
                                        <h5> Price</h5>
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
                                        <ul class="ps-0" id="categoryFilterListDesktop" name="categoryFilterListDesktop"></ul>
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
                                        <h5 class="mb-0"> Price</h5>
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
                                <li><a class="dropdown-item active" href="#" data-value="featured">Featured</a></li>
                                <li><a class="dropdown-item" href="#" data-value="name-asc">Alphabetically, A-Z</a></li>
                                <li><a class="dropdown-item" href="#" data-value="name-desc">Alphabetically, Z-A</a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-value="price-asc">Price, low to high</a></li>
                                <li><a class="dropdown-item" href="#" data-value="price-desc">Price, high to low</a>
                                </li>
                            </ul>

                        </div>

                    </div>

                    <!-- Products Count -->


                    <!-- Grid View -->
                    <div id="gridContainer" class="row"></div>

                    <!-- List View -->
                    <div id="listContainer" class="d-none"></div>
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

        document.addEventListener("DOMContentLoaded", function () {

            // Universal event delegation for card clicks
            document.body.addEventListener('click', function(e) {
                const gameCard = e.target.closest('.game-card');

                if (gameCard) {
                    // Prevent navigation if the click was on the ADD TO CART button
                    if (e.target.closest('.custom-cart-btn')) return;

                    const productId = gameCard.getAttribute('data-id');
                    if (productId) {
                        const baseUrl = window.location.origin;
                        window.location.href = `${baseUrl}/productDetails/${productId}`;
                    }
                }
            });

            // Universal event delegation for cart buttons
            document.body.addEventListener('click', async function(e) {
                const cartBtn = e.target.closest('.custom-cart-btn');

                if (cartBtn) {
                    e.stopPropagation();
                    const pro_id = Number(cartBtn.getAttribute('data-id'));
                    console.log('Add to cart clicked, product id:', pro_id);

                    localStorage.setItem('cart_id', pro_id);
                    const user_id = Number(localStorage.getItem('user_id'));

                    if (!user_id) {
                        alert('Please log in to add to cart!');
                        return;
                    }

                    try {
                        let cartRes = await fetch(`http://localhost:4000/cart?user_id=${user_id}`);
                        let carts = await cartRes.json();
                        let cart = carts[0];

                        if (cart) {
                            let products = cart.products || [];
                            let found = false;
                            products = products.map(item => {
                                if (item.pro_id === pro_id) {
                                    found = true;
                                    return { ...item, quantity: item.quantity + 1 };
                                }
                                return item;
                            });
                            if (!found) {
                                products.push({ pro_id, quantity: 1 });
                            }

                            await fetch(`http://localhost:4000/cart/${cart.id}`, {
                                method: 'PATCH',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ products })
                            });
                        } else {
                            await fetch('http://localhost:4000/cart', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({
                                    user_id,
                                    products: [{ pro_id, quantity: 1 }]
                                })
                            });
                        }

                        alert('Added to cart!');
                    } catch (error) {
                        console.error('Error adding to cart:', error);
                        alert('Failed to add to cart. Please try again.');
                    }
                }
            });

            // Main data fetching and initialization
            Promise.all([
                fetch("productsJson").then(res => res.json()),
                fetch("categoriesJson").then(res => res.json())
            ]).then(([products, categories]) => {
                // Store globally for other functions
                allProducts = products;
                allCategories = categories;

                // Map category id to name for quick lookup
                const catMap = {};
                categories.forEach(cat => { catMap[cat.id] = cat.name; });

                cardsData = products.map(product => ({
                    id: product.id,
                    name: product.name,
                    price: `$${parseFloat(product.price).toFixed(2)}`,
                    image: product.image,
                    description: product.description || '',
                    category: product.category_id ? product.category_id.toString() : '',
                    category_name: catMap[product.category_id] || "Unknown"
                }));

                filterCards();

                // Render product cards
                const gridContainer = document.getElementById('gridContainer');
                const listContainer = document.getElementById('listContainer');
                gridContainer.innerHTML = "";
                listContainer.innerHTML = "";

                products.forEach(product => {
                    const categoryName = product.category_name || "Unknown";
                    let firstImage = '';
                    if (Array.isArray(product.image)) {
                        firstImage = product.image[0];
                    } else if (typeof product.image === 'string') {
                        firstImage = product.image.split(',')[0].trim();
                    }

                    // Grid Card - WITH data-id
                    gridContainer.innerHTML += `
                        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 mb-4 d-flex justify-content-center">
                          <div class="game-card position-relative" data-id="${product.id}">
                            <img src="${firstImage}" alt="${product.name}" class="card-img-top" />
                            <div class="position-absolute card-content">
                              <div class="icons d-flex gap-2 mb-3">
                                <i class="fa-brands fa-apple"></i>
                                <i class="fa-brands fa-windows"></i>
                              </div>
                              <h3>${product.name}</h3>
                              <h3 class="mb-0">$${product.price.toFixed(2)}</h3>
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

                    // List Card - WITH data-id
                    listContainer.innerHTML += `
                        <div class="card mb-3 list-card border-1 border-light" style="background: rgba(34,34,34,0.92); color:#fff; border:none;">
                          <div class="row g-0 align-items-center game-card" data-id="${product.id}">
                            <div class="col-sm-4 d-flex align-items-center justify-content-center" style="min-height:180px;">
                              <div style="background:rgba(24,24,24,0.95); border-radius:16px; padding:12px; display:flex; align-items:center; justify-content:center; width:130px; height:130px;">
                                <img src="${product.image}" alt="${product.name}" style="width: 120px; height: 120px; object-fit: cover; border-radius: 12px; box-shadow:0 2px 8px rgba(0,0,0,0.2); background:#181818;" />
                              </div>
                            </div>
                            <div class="col-sm-8">
                              <div class="card-body d-flex flex-column justify-content-between h-100" style="min-height: 160px;">
                                <div>
                                  <h5 class="card-title mb-2" style="color:#ad9d79;">${product.name}</h5>
                                  <p class="card-text fw-bold mb-1 text-white">$${product.price.toFixed(2)}</p>
                                  <p class="card-text mb-2 text-white"><small>${product.description}</small></p>
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
                });
            });
        });

        // Grid/List view toggle
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
            });

            listBtn.addEventListener('click', () => {
                gridContainer.classList.add('d-none');
                listContainer.classList.remove('d-none');
                listBtn.classList.add('active');
                gridBtn.classList.remove('active');
            });
        }

        // Card creation functions - WITH data-id
        function createGridCard(cardData) {
            const firstImage = cardData.image ? cardData.image.split(',')[0].trim() : 'default.jpg';
            return `
            <div class="col-12 col-sm-6 col-md-4 col-lg-6 col-xl-4 mb-4 d-flex justify-content-center">
              <div class="game-card position-relative" data-id="${cardData.id}">
                <img src="${firstImage}" alt="${cardData.name}" class="card-img-top" />
                <div class="position-absolute card-content">
                  <div class="icons d-flex gap-2 mb-3">
                    <i class="fa-brands fa-apple"></i>
                    <i class="fa-brands fa-windows"></i>
                  </div>
                  <h3>${cardData.name}</h3>
                  <h3 class="mb-0">${cardData.price}</h3>
                </div>
                <div class="card-actions d-flex align-items-center gap-3">
                  <div class="d_main_button w-100">
                    <button class="custom-cart-btn w-100" data-id="${cardData.id}">ADD TO CART</button>
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
                  <p class="card-text mb-2 text-white"><small class="">${cardData.description}</small></p>
                </div>
                <div class="d-flex align-items-center gap-3 mt-auto">
                  <button class="btn btn-sm s_cart_btn custom-cart-btn text-nowrap" data-id="${cardData.id}">ADD TO CART</button>
                  <i class="fa-solid fa-eye fs-6" onclick="viewDetails(${cardData.id})" style="cursor:pointer;"></i>
                </div>
              </div>
            </div>
          </div>
        </div>`;
        }

        // Legacy functions for compatibility
        function addToCart(id) {
            const card = cardsData.find(c => c.id === id);
            if (!card) return;
            alert(`Added "${card.name}" to cart!`);
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

        // Sorting functionality
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

        // Filtering functionality
        function filterCards(sortValue) {
            const selectedPrices = Array.from(document.querySelectorAll('input[name="price"]:checked')).map(i => i.value);
            const selectedCategories = Array.from(document.querySelectorAll('input[name="category"]:checked')).map(i => i.value);
            const currentSortValue = sortValue || document.querySelector('.dropdown-item.active')?.dataset.value || "featured";

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
            if (gridContainer && listContainer) {
                gridContainer.innerHTML = sorted.map(createGridCard).join('');
                listContainer.innerHTML = sorted.map(createListCard).join('');
            }

            const productCountEl = document.getElementById('productCount');
            if (productCountEl) {
                productCountEl.innerText = `Showing ${sorted.length} products`;
            }
        }

        // Sort dropdown handling
        document.addEventListener('DOMContentLoaded', function() {
            // Handle dropdown sorting
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
            document.body.addEventListener('change', function (e) {
                if (e.target.name === 'category' || e.target.name === 'price') {
                    filterCards();
                }
            });
        });

        // Render products function - WITH data-id
        function renderProducts(products, categories) {
            const catMap = {};
            categories.forEach(cat => { catMap[cat.id] = cat.name; });

            const gridContainer = document.getElementById('gridContainer');
            if (!gridContainer) return;

            gridContainer.innerHTML = "";

            products.forEach(product => {
                const categoryName = product.category_name || "Unknown";
                let firstImage = '';
                if (Array.isArray(product.image)) {
                    firstImage = product.image[0];
                } else if (typeof product.image === 'string') {
                    firstImage = product.image.split(',')[0].trim();
                }

                gridContainer.innerHTML += `
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4 d-flex justify-content-center">
                        <div class="game-card position-relative" data-id="${product.id}">
                            <img src="${firstImage}" alt="${product.name}" class="card-img-top" />
                            <div class="position-absolute card-content">
                                <h3>${product.name}</h3>
                                <h3 class="mb-0">$${product.price.toFixed(2)}</h3>
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
            });
        }

        function filterAndRenderProducts() {
            const checkedCategories = Array.from(document.querySelectorAll('input[name="category"]:checked'))
                .map(cb => cb.value)
                .filter(id => id);
            const checkedPrices = Array.from(document.querySelectorAll('input[name="price"]:checked'))
                .map(cb => cb.value);

            let filtered = allProducts;

            // Filter by category if any selected
            if (checkedCategories.length > 0) {
                filtered = filtered.filter(p => {
                    const productCategoryId = String(p.category_id);
                    return checkedCategories.includes(productCategoryId);
                });
            }

            // Filter by price if any selected
            if (checkedPrices.length > 0) {
                filtered = filtered.filter(p => {
                    return checkedPrices.some(range => {
                        const [min, max] = range.split('-').map(Number);
                        return p.price >= min && p.price <= max;
                    });
                });
            }

            renderProducts(filtered, allCategories);
        }

        // Fetch and render with sorting - WITH data-id
        function fetchAndRenderProducts(sortType) {
            Promise.all([
                fetch("productsJson").then(res => res.json()),
                fetch("categoriesJson").then(res => res.json())
            ]).then(([products, categories]) => {
                let sortedProducts = [...products];
                switch (sortType) {
                    case 'name-asc':
                        sortedProducts.sort((a, b) => (a.name || '').localeCompare(b.name || ''));
                        break;
                    case 'name-desc':
                        sortedProducts.sort((a, b) => (b.name || '').localeCompare(a.name || ''));
                        break;
                    case 'price-asc':
                        sortedProducts.sort((a, b) => Number(a.price) - Number(b.price));
                        break;
                    case 'price-desc':
                        sortedProducts.sort((a, b) => Number(b.price) - Number(a.price));
                        break;
                    default:
                        break;
                }
                renderProductCards(sortedProducts, categories);
            });
        }

        function renderProductCards(products, categories) {
            const catMap = {};
            categories.forEach(cat => { catMap[cat.id] = cat.name; });
            const gridContainer = document.getElementById('gridContainer');
            if (!gridContainer) return;

            gridContainer.innerHTML = "";

            products.forEach(product => {
                const categoryName = product.category_name || "Unknown";
                let firstImage = '';
                if (Array.isArray(product.image)) {
                    firstImage = product.image[0];
                } else if (typeof product.image === 'string') {
                    firstImage = product.image.split(',')[0].trim();
                }

                gridContainer.innerHTML += `
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4 d-flex justify-content-center">
                      <div class="game-card position-relative" data-id="${product.id}">
                         <img src="${firstImage}" alt="${product.name}" class="card-img-top" />
                        <div class="position-absolute card-content">
                          <h3>${product.name}</h3>
                          <h3 class="mb-0">$${Number(product.price).toFixed(2)}</h3>
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
            });
        }
    </script>

    <!-- Categories filter script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
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
                        filterListMobile.addEventListener('change', function (e) {
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
        (function () {
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
        document.addEventListener("DOMContentLoaded", function () {
            // Initial fetch and render
            setTimeout(() => {
                fetchAndRenderProducts('featured');
            }, 100);

            // Handle sort dropdown click
            document.addEventListener('click', function(e) {
                if (e.target.matches('.s_sort-dropdown .dropdown-item')) {
                    e.preventDefault();

                    // Remove active from all, add to selected
                    document.querySelectorAll('.s_sort-dropdown .dropdown-item').forEach(i => i.classList.remove('active'));
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
