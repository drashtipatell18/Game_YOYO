<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'YOYO Khel')</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend/css/d_style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/s_style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/z_style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/x_style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/checkout.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/card.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
</head>
<style>
    .offcanvas {
        --bs-offcanvas-width: 350px;
        background-color: #1a1a1a;
    }

    .error {
        color: red;
        /* Change the color to red */
        font-size: 0.875em;
        /* Optional: Adjust the font size */
        margin-top: 0.25em;
        /* Optional: Add some space above the error message */
    }

    @media (max-width: 991px) {
        .a_header_container {
            padding: 0px 8% !important;
        }
    }

    @media (max-width:375px) {
        .offcanvas {
            --bs-offcanvas-width: 300px;
        }
    }

    @media (max-width:320px) {
        .offcanvas {
            --bs-offcanvas-width: 280px;
        }
    }

    .user-initial {
        background-color: #444;
        color: white;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 16px;
    }

    .game-card {
        cursor: pointer;
    }

    .swal2-success-toast {
        background-color: #28a745 !important;
        /* Bootstrap success green */
        color: #fff !important;
    }

    .Z_about_card_desc {
        word-wrap: break-word;
        /* Allows long words to wrap */
        word-break: break-word;
        /* Breaks words if necessary */
        white-space: normal;
        /* Ensures text wraps normally */
    }

    .btn_gem {
        background-color: #8a775a;
        border: 1px solid #8a775a;
        border-radius: 20px;
        color: #fff;
        padding: 5px 20px;
        text-decoration: none
    }

    .badge-container {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        align-items: center;
    }

    /* USD badge with gradient */
    .usd-badge {
        background: linear-gradient(135deg, rgb(94, 77, 58), rgb(138, 119, 90));
        color: white;
        padding: 6px 10px;
        border-radius: 5px;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-block;
    }

    .d_search_form {
        position: relative;
        display: inline-block;
    }

    #suggestions {
        display: none;
        cursor: default;
        width: 99%;
        max-height: 300px;
        overflow-y: auto;
        list-style-type: none;
        padding: 0;
        margin: 0;
        border: 1px solid #ccc;
        position: absolute;
        background: #8a775a;
        z-index: 1000;
    }

    #suggestions li {
        padding: 8px;
        cursor: pointer;
    }

    #suggestions li:hover {
        background-color: #000000;
    }

    #suggestionsmoblie {
        display: none;
        cursor: default;
        width: 99%;
        max-height: 40px;
        overflow-y: auto;
        list-style-type: none;
        padding: 0;
        margin: 0;
        border: 1px solid #ccc;
        position: absolute;
        background: #8a775a;
        z-index: 1000;
    }

    #suggestionsmoblie li {
        padding: 8px;
        cursor: pointer;
    }

    #suggestionsmoblie li:hover {
        background-color: #000000;
    }

    .search-wrapper {
        position: relative;
    }

    #search-icon,
    #clear-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 10px;
        color: #333;
    }

    input[type="search"]::-webkit-search-cancel-button {
        -webkit-appearance: none;
        appearance: none;
        display: none;
    }

    #searchmoblie-icon,
    #clearmoblie-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 10px;
        color: #333;
    }

    /* Explore Genras Mobile Responsive Code */

    .d_category_section {
        padding: 2rem 0;
    }

    .d_category_scroll_wrapper {
        display: flex;
        gap: 1rem;
        overflow-x: auto;
        padding-bottom: 1rem;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }

    .category-link {
        flex: 0 0 auto;
        scroll-snap-align: start;
        text-decoration: none;
    }

    .d_category_card {
        width: 150px;
        /* or use % like 40% for fluid width */
        height: 220px;
        border-radius: 1rem;
        overflow: hidden;
        position: relative;
        background-color: #000;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .d_category_card img {
        width: 100%;
        height: auto;
        display: block;
    }

    .d_icon_top {
        position: absolute;
        top: 10px;
        left: 10px;
        width: 32px;
        height: 32px;
    }

    .d_category_overlay {
        position: absolute;
        bottom: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.6);
        padding: 0.5rem;
        text-align: center;
    }

    .d_category_text {
        color: #fff;
        font-weight: bold;
        font-size: 1rem;
    }

    @media (max-width: 768px) {
        .d_category_card {
            width: 120px;
            height: 180px;
        }

        .d_category_text {
            font-size: 0.9rem;
        }

        .d_icon_top {
            width: 24px;
            height: 24px;
        }
    }

    /* End Resposive Code */
</style>

<body>
    <div class="d_main">
        <!-- Header -->
        <header class="d_header d-flex align-items-center justify-content-between">
            <a href="{{ route('index') }}">
                <img src="{{ asset('frontend/images/yoyo logo done.png') }}" style="padding: 7px; height: 60px;"
                    alt="logo" class="img-fluid">
            </a>

            <!-- Desktop Nav -->
            <nav class="d_navbar navbar navbar-expand-lg d-none d-lg-flex">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}"
                            href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('allProducts') ? 'active' : '' }}"
                            href="{{ route('allProducts') }}">Games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blogfronted') ? 'active' : '' }}"
                            href="{{ route('blogfronted') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutus') ? 'active' : '' }}"
                            href="{{ route('aboutus') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('frontendcontactus') ? 'active' : '' }}"
                            href="{{ route('frontendcontactus') }}">Contact</a>
                    </li>
                    <li class="nav-item px-2">
                        <button class="d_search_form btn_gem" id="chatToggleNav">
                            Chatbox
                        </button>
                    </li>

                    <div class="chatbox" id="chatbox">
                        <div class="chatbox-header">
                            🎮 GameStore AI
                            <span id="closeChat">✖</span>
                        </div>
                        <div class="chatbox-messages" id="chatMessages">
                            <div class="message bot">Hi! I’m your gaming assistant. How can I help you today?</div>
                        </div>
                        <div class="chatbox-suggestions">
                            <button onclick="handleSuggestion('What are the latest games?')">What are the latest
                                games?</button>
                            <button onclick="handleSuggestion('Do you have any offers?')">Do you have any
                                offers?</button>
                            <button onclick="handleSuggestion('What consoles do you sell?')">What consoles do you
                                sell?</button>
                        </div>
                        <div class="chatbox-input">
                            <input type="text" id="userInput" placeholder="Type your message...">
                            <button id="sendMessage">➤</button>
                        </div>
                    </div>

                    <!-- ChatBoat Question and Answer Script -->
                    <script>
                        const chatToggleNav = document.getElementById("chatToggleNav");
                        const chatbox = document.getElementById("chatbox");
                        const closeChat = document.getElementById("closeChat");
                        const sendMessageBtn = document.getElementById("sendMessage");
                        const userInput = document.getElementById("userInput");
                        const chatMessages = document.getElementById("chatMessages");

                        // Conversation flow state
                        let conversationState = "askName";
                        let userName = "";
                        let userEmail = "";

                        // Open chat and greet only once
                        chatToggleNav.addEventListener("click", () => {
                            chatbox.style.display = "flex";
                            if (chatMessages.children.length === 0) {
                                appendMessage("Hi! I’m your gaming assistant. 👋 What’s your name?", "bot");
                            }
                        });

                        // Close chat
                        closeChat.addEventListener("click", () => {
                            chatbox.style.display = "none";
                        });

                        // Send message
                        function sendMessage() {
                            const message = userInput.value.trim();
                            if (message === "") return;

                            appendMessage(message, "user");
                            userInput.value = "";

                            setTimeout(() => {
                                let reply = handleConversation(message);
                                appendMessage(reply, "bot");
                            }, 800);
                        }

                        function appendMessage(text, sender) {
                            const msg = document.createElement("div");
                            msg.classList.add("message", sender);
                            msg.innerText = text;
                            chatMessages.appendChild(msg);
                            chatMessages.scrollTop = chatMessages.scrollHeight;
                        }

                        function handleConversation(message) {
                            switch (conversationState) {
                                case "askName":
                                    userName = message;
                                    conversationState = "askEmail";
                                    return `Nice to meet you, ${userName}! 😊 Can I have your email?`;
                                case "askEmail":
                                    if (!validateEmail(message)) {
                                        return "That doesn't seem like a valid email. Please enter it again.";
                                    }
                                    userEmail = message;
                                    conversationState = "chatReady";
                                    return `Thanks, ${userName}! You can now ask me anything about games. 🎮`;
                                case "chatReady":
                                    return getBotReply(message);
                                default:
                                    return "Let's start with your name. 😊";
                            }
                        }

                        function validateEmail(email) {
                            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                        }

                        function getBotReply(userMsg) {
                            userMsg = userMsg.toLowerCase();

                            // Platform-specific responses first
                            if (userMsg.includes("android")) {
                                return "For Android, we recommend Call of Duty Mobile, PUBG Mobile, Genshin Impact, and Asphalt 9. 📱";
                            }
                            if (userMsg.includes("ios") || userMsg.includes("iphone")) {
                                return "Popular iOS games include Clash Royale, Monument Valley, and Among Us. Available on the App Store! 🍏";
                            }
                            if (userMsg.includes("windows") || userMsg.includes("pc games")) {
                                return "On Windows PC, check out Cyberpunk 2077, Valorant, and Microsoft Flight Simulator. 🖥️";
                            }
                            if (userMsg.includes("mobile")) {
                                return "We’ve got mobile game recommendations for both Android and iOS platforms! Want suggestions?";
                            }
                            if (userMsg.includes("platform") || userMsg.includes("available on")) {
                                return "Most games are available on PC, PlayStation, Xbox, Nintendo Switch, Android, and iOS.";
                            }

                            // General questions
                            if (userMsg.includes("offer") || userMsg.includes("discount")) {
                                return "Check out our deals page for discounts up to 50%! 🔥";
                            }
                            if (userMsg.includes("console")) {
                                return "We sell PS5, Xbox Series X, and Nintendo Switch consoles.";
                            }
                            if (userMsg.includes("release") || userMsg.includes("new game")) {
                                return "The newest releases this month include Elden Ring DLC and Spider-Man 3.";
                            }
                            if (userMsg.includes("top games") || userMsg.includes("popular games")) {
                                return "Top games right now: GTA VI, Fortnite, Call of Duty: Black Ops, and FIFA 25.";
                            }
                            if (userMsg.includes("multiplayer") || userMsg.includes("co-op")) {
                                return "Try Apex Legends, Valorant, or Overcooked 2 for co-op fun!";
                            }
                            if (userMsg.includes("single player") || userMsg.includes("story mode")) {
                                return "Try God of War: Ragnarok or The Last of Us for an immersive story experience.";
                            }
                            if (userMsg.includes("pc requirements") || userMsg.includes("system requirements")) {
                                return "System requirements are listed on each game's product page under 'Specs'.";
                            }
                            if (userMsg.includes("pre-order")) {
                                return "Pre-orders are open for several upcoming titles! Check our Pre-Orders section.";
                            }
                            if (userMsg.includes("refund") || userMsg.includes("return")) {
                                return "We offer refunds within 14 days if the game hasn't been played for more than 2 hours.";
                            }
                            if (userMsg.includes("subscription") || userMsg.includes("membership")) {
                                return "We offer GamePass and PlayStation Plus subscriptions—monthly and yearly plans available.";
                            }

                            // Fallback response
                            return "I’m not sure about that, but I can connect you to a human agent. 😊";
                        }


                        function handleSuggestion(text) {
                            if (conversationState !== "chatReady") {
                                appendMessage("Please enter your name and email before asking game questions. 😊", "bot");
                                return;
                            }

                            appendMessage(text, "user");

                            setTimeout(() => {
                                let reply = getBotReply(text);
                                appendMessage(reply, "bot");
                            }, 500);
                        }

                        sendMessageBtn.addEventListener("click", sendMessage);
                        userInput.addEventListener("keypress", e => {
                            if (e.key === "Enter") sendMessage();
                        });
                    </script>

                    <!-- End Question and Answer Script -->
                </ul>


                <form class="d_search_form" method="GET">
                    @csrf
                    <div class="search-wrapper">
                        <input type="search" placeholder="Search games..." id="search" name="search" />

                        <!-- Search Icon -->
                        <i id="search-icon" class="fas fa-search"></i>

                        <!-- Clear Button (X) -->
                        <span id="clear-btn" style="display:none; cursor:pointer;">&#10005;</span>

                        <ul id="suggestions"></ul>
                    </div>
                </form>

                <div class="d_social_icons me-3">
                    <a href="{{ route('cart') }}"><i class="fa fa-cart-plus"></i></a>
                </div>

                <div class="d_user_icon_wrapper position-relative">
                    <div class="d_user_icon" id="db_user_icon" title="User Profile">
                        @if (Auth::check())
                            <div class="user-initial">
                                {{ strtoupper(Auth::user()->name[0]) }}
                            </div>
                        @else
                            <i class="fas fa-user-circle"></i>
                        @endif
                    </div>



                    <div class="d_user_dropdown" id="db_user_dropdown">
                        <ul>
                            @guest
                                <li><a href="{{ route('frontend.login') }}">Sign in</a></li>
                            @endguest

                            @if (Auth::check())
                                <li><a href="{{ route('profile', Auth::id()) }}">Profile</a></li>
                                <li><a href="{{ route('frontlogout') }}">Logout</a></li>
                            @endif

                        </ul>
                    </div>
                </div>

            </nav>

            <!-- Mobile Toggler -->
            <button class="d_toggler_btn d-lg-none" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
        </header>

        <!-- Offcanvas Mobile Menu -->
        <aside class="d_offcanvas_menu" id="d_offcanvas_menu">
            <button class="close_btn" aria-label="Close Menu">&times;</button>
            <nav>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}"
                            href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('allProducts') ? 'active' : '' }}"
                            href="{{ route('allProducts') }}">Games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blogfronted') ? 'active' : '' }}"
                            href="{{ route('blogfronted') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('aboutus') ? 'active' : '' }}"
                            href="{{ route('aboutus') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('frontendcontactus') ? 'active' : '' }}"
                            href="{{ route('frontendcontactus') }}">Contact</a>
                    </li>
                    @guest
                        <a class="nav-link {{ request()->routeIs('frontend.login') ? 'active' : '' }}"
                            href="{{ route('frontend.login') }}">Login</a>
                    @endguest

                    @auth
                        <a class="nav-link {{ request()->routeIs('frontlogout') ? 'active' : '' }}" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Log Out
                        </a>

                        <form id="logout-form" action="{{ route('frontlogout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    @endauth

                    <li class="nav-item px-2">
                        <button class="d_search_form btn_gem" id="navChatToggle">
                            Chatbox
                        </button>
                    </li>

                    <div class="chatbox" id="navChatbox">
                        <div class="chatbox-header">
                            🎮 GameStore AI
                            <span id="navCloseChat">✖</span>
                        </div>
                        <div class="chatbox-messages" id="navChatMessages">
                            <div class="message bot">Hi! I’m your gaming assistant. How can I help you today?</div>
                        </div>
                        <div class="chatbox-suggestions">
                            <button onclick="handleSuggestion1('What are the latest games?')">What are the latest
                                games?</button>
                            <button onclick="handleSuggestion1('Do you have any offers?')">Do you have any
                                offers?</button>
                            <button onclick="handleSuggestion1('What consoles do you sell?')">What consoles do you
                                sell?</button>
                        </div>
                        <div class="chatbox-input">
                            <input type="text" id="navUserInput" placeholder="Type your message...">
                            <button id="navSendMessage">➤</button>
                        </div>
                    </div>

                    <!-- Mobile Device  -->
                    <script>
                        const navChatToggle = document.getElementById("navChatToggle");
                        const navChatbox = document.getElementById("navChatbox");
                        const navCloseChat = document.getElementById("navCloseChat");
                        const navSendMessageBtn = document.getElementById("navSendMessage");
                        const navUserInput = document.getElementById("navUserInput");
                        const navChatMessages = document.getElementById("navChatMessages");

                        let navConversationState = "askName";
                        let navUserName = "";
                        let navUserEmail = "";

                        // Open Chat
                        navChatToggle.addEventListener("click", () => {
                            navChatbox.style.display = "flex";
                            if (navChatMessages.children.length === 0) {
                                appendNavMessage1("Hi! I’m your gaming assistant. 👋 What’s your name?", "bot");
                            }
                        });

                        // Close Chat
                        navCloseChat.addEventListener("click", () => {
                            navChatbox.style.display = "none";
                        });

                        // Send Message
                        navSendMessageBtn.addEventListener("click", sendNavMessage);
                        navUserInput.addEventListener("keypress", e => {
                            if (e.key === "Enter") sendNavMessage();
                        });

                        function sendNavMessage() {
                            const message = navUserInput.value.trim();
                            if (message === "") return;

                            appendNavMessage1(message, "user");
                            navUserInput.value = "";

                            setTimeout(() => {
                                let reply = handleNavConversation(message);
                                appendNavMessage1(reply, "bot");
                            }, 800);
                        }

                        function appendNavMessage1(text, sender) {
                            const msg = document.createElement("div");
                            msg.classList.add("message", sender);
                            msg.innerText = text;
                            navChatMessages.appendChild(msg);
                            navChatMessages.scrollTop = navChatMessages.scrollHeight;
                        }

                        function handleNavConversation(message) {
                            switch (navConversationState) {
                                case "askName":
                                    navUserName = message;
                                    navConversationState = "askEmail";
                                    return `Nice to meet you, ${navUserName}! 😊 Can I have your email?`;
                                case "askEmail":
                                    if (!validateNavEmail(message)) {
                                        return "That doesn't seem like a valid email. Please enter it again.";
                                    }
                                    navUserEmail = message;
                                    navConversationState = "chatReady";
                                    return `Thanks, ${navUserName}! You can now ask me anything about games. 🎮`;
                                case "chatReady":
                                    return getNavBotReply(message);
                                default:
                                    return "Let's start with your name. 😊";
                            }
                        }

                        function validateNavEmail(email) {
                            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                        }

                        function getNavBotReply(userMsg) {
                            userMsg = userMsg.toLowerCase();

                            if (userMsg.includes("android")) {
                                return "For Android, we recommend Call of Duty Mobile, PUBG Mobile, Genshin Impact, and Asphalt 9. 📱";
                            }
                            if (userMsg.includes("ios") || userMsg.includes("iphone")) {
                                return "Popular iOS games include Clash Royale, Monument Valley, and Among Us. 🍏";
                            }
                            if (userMsg.includes("windows") || userMsg.includes("pc games")) {
                                return "On Windows PC, check out Cyberpunk 2077, Valorant, and Microsoft Flight Simulator. 🖥️";
                            }
                            if (userMsg.includes("mobile")) {
                                return "We’ve got mobile game recommendations for both Android and iOS platforms! Want suggestions?";
                            }
                            if (userMsg.includes("offer") || userMsg.includes("discount")) {
                                return "Check out our deals page for discounts up to 50%! 🔥";
                            }
                            if (userMsg.includes("console")) {
                                return "We sell PS5, Xbox Series X, and Nintendo Switch consoles.";
                            }
                            if (userMsg.includes("release") || userMsg.includes("new game")) {
                                return "The newest releases this month include Elden Ring DLC and Spider-Man 3.";
                            }
                            if (userMsg.includes("top games") || userMsg.includes("popular games")) {
                                return "Top games right now: GTA VI, Fortnite, Call of Duty: Black Ops, and FIFA 25.";
                            }
                            if (userMsg.includes("multiplayer") || userMsg.includes("co-op")) {
                                return "Try Apex Legends, Valorant, or Overcooked 2 for co-op fun!";
                            }
                            if (userMsg.includes("single player") || userMsg.includes("story mode")) {
                                return "Try God of War: Ragnarok or The Last of Us for an immersive story experience.";
                            }
                            if (userMsg.includes("pc requirements") || userMsg.includes("system requirements")) {
                                return "System requirements are listed on each game's product page under 'Specs'.";
                            }
                            if (userMsg.includes("pre-order")) {
                                return "Pre-orders are open for several upcoming titles! Check our Pre-Orders section.";
                            }
                            if (userMsg.includes("refund") || userMsg.includes("return")) {
                                return "We offer refunds within 14 days if the game hasn't been played for more than 2 hours.";
                            }
                            if (userMsg.includes("subscription") || userMsg.includes("membership")) {
                                return "We offer GamePass and PlayStation Plus subscriptions—monthly and yearly plans available.";
                            }

                            return "I’m not sure about that, but I can connect you to a human agent. 😊";
                        }

                        function handleSuggestion1(text) {
                            if (navConversationState !== "chatReady") {
                                appendNavMessage1("Please enter your name and email before asking game questions. 😊", "bot");
                                return;
                            }

                            appendNavMessage1(text, "user");

                            setTimeout(() => {
                                let reply = getNavBotReply(text);
                                appendNavMessage1(reply, "bot");
                            }, 500);
                        }
                    </script>
                    <!-- End Mobile Device -->

                </ul>
            </nav>
            <form class="d_search_form" method="GET">
                @csrf
                <div class="search-wrapper">
                    <input type="search" placeholder="Search games..." id="searchmoblie" name="searchmoblie" />

                    <!-- Search Icon -->
                    <i id="searchmoblie-icon" class="fas fa-search"></i>

                    <!-- Clear Button -->
                    <span id="clearmoblie-btn" style="display:none; cursor:pointer;">&#10005;</span>

                    <ul id="suggestionsmoblie"></ul>
                </div>
            </form>
            <div class="d_social_icons_offcanvas">
                @if (Auth::check())
                    <a href="{{ route('cart') }}"><i class="fa fa-cart-plus"></i></a>
                    <a href="{{ route('profile', Auth::id()) }}"><i class="fas fa-user-circle"></i></a>
                @endif
            </div>
        </aside>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Prevent form submission on Enter for both search inputs
        $('#search, #searchmoblie').on('keypress', function(event) {
            if (event.which === 13) {
                event.preventDefault();
                const query = $(this).val().trim();
                if (query.length > 1) {
                    window.location.href = '/allproducts?search=' + encodeURIComponent(query);
                }
            }
        });

        let searchResults = []; // store results globally

        // Handle keyup on main search input
        $('#search').on('keyup', function() {
            let query = $(this).val().trim();

            if (query.length > 1) {
                $.ajax({
                    url: "/search-products",
                    method: "GET",
                    data: {
                        search: query
                    },
                    success: function(data) {
                        searchResults = data; // store search data

                        let suggestions = '';
                        if (data.length) {
                            suggestions = data.map(item =>
                                `<li class="suggestion-item" data-id="${item.id}" style="cursor:pointer;">${item.name}</li>`
                            ).join('');
                        } else {
                            suggestions =
                                '<li style="text-align: center; list-style: none;">No results found</li>';
                        }
                        $('#suggestions').html(suggestions).show();
                    },
                    error: function(xhr, status, error) {
                        console.log('Search error:', error);
                        $('#suggestions').hide();
                    }
                });
            } else {
                $('#suggestions').hide();
            }
        });

        // Handle click on suggestion item (desktop)
        $(document).on('click', '#suggestions .suggestion-item', function() {
            const id = $(this).data('id');
            const name = $(this).text().trim();

            if (!id) return;

            // Hide suggestions dropdown after click
            $('#suggestions').hide();

            // Set the clicked name in the search input
            $('#search').val(name);

            // redirect to allproducts page with search value.

            // http://127.0.0.1:8000/allproducts?search=vice_city

            if (name.length > 1) {
                console.log('enterrrr');
                window.location.href = '/allproducts?search=' + encodeURIComponent(name);
            }


            // Find clicked product in cached search results
            const product = searchResults.find(p => p.id === id);
            if (product) {
                renderSingleProduct(product);
            } else {
                // Optional: fetch full product data from server if not found
                $.ajax({
                    url: '/',
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function(productData) {
                        renderSingleProduct(productData);
                    },
                    error: function() {
                        alert('Failed to load product details.');
                    }
                });
            }
        });





        // Handle keyup on mobile search input
        $('#searchmoblie').on('keyup', function() {
            let query = $(this).val().trim();

            if (query.length > 1) {
                $.ajax({
                    url: "/search-products",
                    method: "GET",
                    data: {
                        search: query
                    },
                    success: function(data) {
                        searchResults = data;

                        let suggestions = '';
                        if (data.length) {
                            suggestions = data.map(item =>
                                `<li class="suggestion-item" data-id="${item.id}" style="cursor:pointer;">${item.name}</li>`
                            ).join('');
                        } else {
                            suggestions =
                                '<li style="text-align: center; list-style: none;">No results found</li>';
                        }
                        $('#suggestionsmoblie').html(suggestions).show();
                    },
                    error: function() {
                        $('#suggestionsmoblie').hide();
                    }
                });
            } else {
                $('#suggestionsmoblie').hide();
            }
        });

        // Handle click on suggestion item (mobile)
        $(document).on('click', '#suggestionsmoblie .suggestion-item', function() {
            const id = $(this).data('id');
            const name = $(this).text();

            if (!id) return;

            $('#suggestionsmoblie').hide();
            $('#searchmoblie').val(name);

            // Optionally render product or redirect
            const product = searchResults.find(p => p.id === id);
            if (product) {
                renderSingleProduct(product);
            } else {
                $.ajax({
                    url: '/get-product',
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function(productData) {
                        renderSingleProduct(productData);
                    },
                    error: function() {
                        alert('Failed to load product details.');
                    }
                });
            }
        });

        // Hide suggestions when clicking outside for desktop and mobile
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.d_search_form').length) {
                $('#suggestions').hide();
                $('#suggestionsmoblie').hide();
            }
        });

        // Render a single product card in #gridContainer
        function renderSingleProduct(product) {
            const gridContainer = $('#gridContainer');
            gridContainer.empty();

            const firstImage = (product.image && typeof product.image === 'string') ?
                product.image.split(',')[0].trim() :
                'default.jpg';

            const categoryName = product.category_name || "Unknown";
            const productPrice = parseFloat(product.price).toFixed(2);

            const cardHtml = `
            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 mb-4 d-flex justify-content-center">
                <div class="game-card position-relative" data-id="${product.id}">
                    <img src="${firstImage}" alt="${product.name}" class="card-img-top" />
                    <div class="position-absolute card-content">
                        <h3>${product.name}</h3>
                        <h3 class="mb-0">$${productPrice} <span class="badge usd-badge">USD</span></h3>
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
            gridContainer.append(cardHtml);
        }
    });
    const searchInput = document.getElementById('search');
    const searchIcon = document.getElementById('search-icon');
    const clearBtn = document.getElementById('clear-btn');

    searchInput.addEventListener('input', () => {
        if (searchInput.value.trim() !== '') {
            searchIcon.style.display = 'none';
            clearBtn.style.display = 'inline';
        } else {
            searchIcon.style.display = 'inline';
            clearBtn.style.display = 'none';
        }
    });

    clearBtn.addEventListener('click', () => {
        searchInput.value = '';
        searchInput.dispatchEvent(new Event('input'));
        searchInput.focus();
    });
    const searchInputMob = document.getElementById('searchmoblie');
    const searchIconMob = document.getElementById('searchmoblie-icon');
    const clearBtnMob = document.getElementById('clearmoblie-btn');

    searchInputMob.addEventListener('input', () => {
        if (searchInputMob.value.trim() !== '') {
            searchIconMob.style.display = 'none';
            clearBtnMob.style.display = 'inline';
        } else {
            searchIconMob.style.display = 'inline';
            clearBtnMob.style.display = 'none';
        }
    });

    clearBtnMob.addEventListener('click', () => {
        searchInputMob.value = '';
        searchInputMob.dispatchEvent(new Event('input'));
        searchInputMob.focus();
    });
</script>


</html>
