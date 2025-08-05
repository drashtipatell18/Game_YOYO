@extends('gx_ai.layouts.main')
@section('content')
    <style>
        /* Base light theme variables */
        :root {
            --bg-main: #ffffff;
            --text-main: #1f1f1f;
            --text-muted: #5f6368;
            --icon-bg: #ffd289;
            --icon-color: #7e5700;
            --card-bg: #f1f5f9;
            --card-hover-bg: #dde3ea;
            --experiment-tag-bg: #ffffff;
            --experiment-tag-text: #000000;
            --experiment-tag-border: #000000;
            --button-bg: #4285f4;
            --button-text: white;
            --button-hover-bg: #3367d6;
            --scrollbar-track: #f0f0f0;
            --scrollbar-thumb: #c0c0c0;
            --scrollbar-thumb-hover: #a0a0a0;
            --dropdown-hover: #dfe3e7;
        }

        /* Dark theme variables */
        body.dark {
            --bg-main: #1b1c1d;
            --text-main: #e0e0e0;
            --text-muted: #a0a0a0;
            --icon-bg: #7e5700;
            /* Darker background for the icon */
            --icon-color: #ffd289;
            /* Lighter icon for contrast */
            --card-bg: #282a2c;
            --card-hover-bg: #3a3a3a;
            --experiment-tag-bg: #3a3a3a;
            --experiment-tag-text: #e0e0e0;
            --experiment-tag-border: #777777;
            --button-bg: #7da5ff;
            --button-text: black;
            --button-hover-bg: #5c84e0;
            --scrollbar-track: #3a3a3a;
            --scrollbar-thumb: #555555;
            --scrollbar-thumb-hover: #777777;
            --dropdown-hover: #3b3d3f;
        }

        /* Apply variables to base elements and custom classes */
        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        h1,
        p,
        span {
            color: var(--text-main);
        }

        /* Specific overrides for elements with hardcoded Tailwind classes */
        .bg-white {
            background-color: var(--bg-main) !important;
        }

        .text-\[\#1F1F1F\] {
            color: var(--text-main) !important;
        }

        .bg-\[\#ffd289\] {
            background-color: var(--icon-bg) !important;
        }

        .text-\[\#7e5700\] {
            color: var(--icon-color) !important;
        }

        .bg-\[\#f1f5f9\] {
            background-color: var(--card-bg) !important;
        }

        .hover\:bg-\[\#dde3ea\]:hover {
            background-color: var(--card-hover-bg) !important;
        }

        .text-md {
            color: var(--text-muted);
        }

        /* Experiment tag styling */
        .ml-1.text-sm.border.px-2.py-0.rounded-full.bg-white.text-black.border-black {
            background-color: var(--experiment-tag-bg) !important;
            color: var(--experiment-tag-text) !important;
            border-color: var(--experiment-tag-border) !important;
        }
    </style>
</head>

    <div class="w-[100%]">
        <div class="backdrop" id="backdrop"></div>

        <div class="flex w-[100%] ">
            <div class="main-content" id="main-content">
                <div class="main-scroll-area">
                    <div class="main-inner">
                        <div class="main-inner-left">
                            <button id="openBtn">☰</button>
                            <span class="expand">Expand menu</span>
                            <span class="collapse">Collapse menu</span>
                        </div>

                        <div class="main-inner-right">
                            <a href="Search.html" class="flex items-center justify-center" id="search-icon"> <span
                                    class="material-icons">search</span> </a>
                            <span class="search-span">Search</span>
                        </div>
                    </div>

                    <div class="drawer" id="drawer">
                        <ul class="drawer-data ">
                            <li id="new-chat-button">
                                <a href="Gemini.html" class="items-center flex gap-5"> <span
                                        class="material-symbols-outlined">edit_square</span>
                                    <span>New Chat</span>
                                </a>
                                <span class="new-chat">New Chat</span>
                            </li>
                            <li class="diamond">
                                <a href="Explore_Gem.html" class="w-[100%] items-center flex gap-5"> <span
                                        class="material-symbols-outlined">diamond </span>
                                    <span>Explore Gems</span>
                                </a>
                                <span class="expore">Explore Gems</span>
                            </li>
                        </ul>

                        <div class="recent-section">
                            <h3>Recent</h3>
                            <ul id="recent-chats">
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="setting-help" id="setting-help">
                    <ul class="drawer-data">
                        <li class="dropdown-toggle " onclick="toggleDropdown()">
                            <a class="material-symbols-outlined">settings</a>
                            <span>Setting & Help</span>
                            <span class="seting-span">Setting & Help</span>
                        </li>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <ul class="pb-2">

                                <li>
                                    <a href="SavedInfo.html " class="w-[100%] items-center flex gap-5">
                                        <span class="material-symbols-outlined"> person </span>
                                        Saved info
                                    </a>

                                </li>

                                <li>
                                    <a href="Public_Links.html" class="w-[100%] items-center flex gap-5">
                                        <span class="material-symbols-outlined"> link </span>
                                        Your public links
                                    </a>
                                </li>
                                <li class="submenu flex justify-between" id="themeOptions">
                                    <div class="flex gap-[20px]">
                                        <span class="material-symbols-outlined">light_mode</span>
                                        Theme
                                    </div>
                                    <i class="fa-solid fa-caret-right pe-3 text-base"></i>
                                    <ul class="theme-options">
                                        <li data-theme="system">System</li>
                                        <li data-theme="light">Light</li>
                                        <li data-theme="dark">Dark</li>
                                    </ul>
                                </li>

                                <li id="feedback_open">
                                    <span class="material-symbols-outlined"> feedback</span>
                                    Send feedback
                                </li>
                                <li id="open_help_center">
                                    <span class="material-symbols-outlined"> quiz </span>
                                    Help
                                </li>
                            </ul>

                            <div class="location-info">
                                <div>Nana Varachha, Surat, Gujarat, India</div>
                                <div><a href="#">From your IP address</a> • <a href="#">Update location</a></div>
                            </div>
                        </div>
                    </ul>
                </div>

            </div>
            <div class="z-10 gemini-header p-2 flex items-center justify-between">
                <div class="relative ">
                    <button class="mobile-menu-btn" id="mobileMenuBtn">☰</button>
                    <div class="pl-48px">
                        <h1 class="text-2xl " style="color: var(--text-main);">YOYO</h1>
                        <div class="relative">
                            <button id="model-toggle"
                                class="mt-1 rounded-full flex items-center justify-center w-[100px] h-6 font-medium text-sm "
                                style="background-color: var(--sidebar-bg); color: var(--sidebar-text);">
                                <span class="pl-2 font-semibold">2.5 Flash</span>
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                    fill="currentColor">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M7 10l5 5 5-5H7z" />
                                </svg>
                            </button>

                            <div id="model-dropdown"
                                class="absolute left-[10%] -translate-x-1/2 top-full mt-1 w-[315px] sm:max-w-xs rounded-xl shadow-lg z-50 py-2"
                                style="background-color: var(--dropdown-bg); border-color: var(--dropdown-border); color: var(--dropdown-text);">
                                <div class="px-4 py-2 text-sm font-medium" style="color: var(--text-muted);">Choose your
                                    model</div>

                                <!-- Option 1 - Default selected -->
                                <div class="option flex justify-between items-center px-5 py-2 cursor-pointer hover:bg-[var(--dropdown-hover)] selected"
                                    style="color: var(--dropdown-text);" onclick="selectOption(this)">
                                    <div class="justify-between items-center">
                                        <span class="text-xs font-semibold">2.5 Flash</span>
                                        <div class="text-xs mt-0">Fast all-around help</div>
                                    </div>
                                    <i class="fa-regular fa-circle-check"></i>
                                </div>

                                <!-- Option 2 -->
                                <div class="option flex justify-between items-center px-5 py-2 cursor-pointer hover:bg-[var(--dropdown-hover)] selected"
                                    style="color: var(--dropdown-text);" onclick="selectOption(this)">
                                    <div class="justify-between items-center">
                                        <span class="text-xs font-semibold">2.5 Pro (preview)</span>
                                        <div class="text-xs">Reasoning, math & code</div>
                                    </div>
                                    <i class="fa-regular fa-circle-check hidden"></i>
                                </div>

                                <!-- Option 3 -->
                                <div class="option flex justify-between items-center px-5 py-2 cursor-pointer hover:bg-[var(--dropdown-hover)] selected"
                                    style="color: var(--dropdown-text);" onclick="selectOption(this)">
                                    <div class="justify-between items-center">
                                        <span class="text-xs font-semibold">Personalization (preview)</span>
                                        <div class="text-xs">Based on your Search history </div>
                                    </div>
                                    <i class="fa-regular fa-circle-check hidden"></i>
                                </div>

                                <div class="px-5 pb-3 justify-center flex items-center">
                                    <div class="cursor-pointer">
                                        <div class="flex justify-between items-center">
                                            <span class="text-xs font-semibold"
                                                style="color: var(--dropdown-text);">Upgrade
                                                to Google AI
                                                Pro</span>
                                        </div>
                                        <div class="text-xs">Get our most capable models &
                                            features</div>
                                    </div>
                                    <div class="pl-5">
                                        <a href="Upgrad.html"
                                            class="h-9 rounded-full justify-center flex items-center text-sm  w-[100px]"
                                            style="background-color: var(--sidebar-hover); color: var(--accent-blue);">
                                            Upgrade
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-2 items-center">
                    <a href="Upgrad.html"
                        class="h-9 block cursor-pointer rounded-md flex items-center justify-center text-xs font-semibold px-6 mr-3"
                        style="background-color: var(--sidebar-hover);">

                        Upgrade
                    </a>
                    <div id="account"></div>
                </div>
            </div>
        </div>
        <div class="gemini-data ">
            <div class="main-chat-area">
                <div class="chat-content-wrapper" style="background-color: var(--bg-main);">
                    <div class="p-10 min-h-screen flex items-center justify-center">
                        <div class="max-w-3xl mx-auto w-full">


                            <div class="flex flex-wrap sm:flex-nowrap items-start sm:items-center gap-4 mb-6">
                                <div class="w-16 h-16 rounded-full flex items-center justify-center shrink-0"
                                    style="background-color: var(--icon-bg);">
                                    <i class="ph ph-strategy text-4xl" style="color: var(--icon-color);"></i>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h1 class="text-3xl" style="color: var(--text-main);">Chess champ</h1>
                                        <span class="ml-1 text-sm border px-2 py-0 rounded-full"
                                            style="background-color: var(--experiment-tag-bg); color: var(--experiment-tag-text); border-color: var(--experiment-tag-border);">
                                            Experiment
                                        </span>
                                    </div>
                                    <p class="text-md" style="color: var(--text-muted);">
                                        Play chess with a language model. Make your first move using chess notation
                                        to
                                        start your match.
                                    </p>
                                </div>
                            </div>

                            <div class="block md:hidden overflow-x-auto">
                                <div class="flex gap-4 w-max">
                                    <div class="w-[180px] h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                        style="background-color: var(--card-bg); color: var(--text-main);"
                                        onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                        onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                        Let's play chess! I start with e4.
                                    </div>
                                    <div class="w-[180px] h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                        style="background-color: var(--card-bg); color: var(--text-main);"
                                        onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                        onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                        I start with moving my knight to f3. Write a verse after every move.
                                    </div>
                                    <div class="w-[180px] h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                        style="background-color: var(--card-bg); color: var(--text-main);"
                                        onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                        onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                        My move is d4. Comment on the game as Sherlock Holmes.
                                    </div>
                                    <div class="w-[180px] h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                        style="background-color: var(--card-bg); color: var(--text-main);"
                                        onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                        onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                        How do I make a move?
                                    </div>
                                </div>
                            </div>

                            <div class="block md:grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="h-[160px] p-4 rounded-xl cursor-pointer text-sm"
                                    style="background-color: var(--card-bg); color: var(--text-main);"
                                    onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                    onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                    Let's play chess! I start with e4.
                                </div>
                                <div class="h-[160px] p-4 rounded-xl cursor-pointer text-sm"
                                    style="background-color: var(--card-bg); color: var(--text-main);"
                                    onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                    onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                    I start with moving my knight to f3. Write a verse after every move.
                                </div>
                                <div class="h-[160px] p-4 rounded-xl cursor-pointer text-sm"
                                    style="background-color: var(--card-bg); color: var(--text-main);"
                                    onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                    onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                    My move is d4. Comment on the game as Sherlock Holmes.
                                </div>
                                <div class="h-[160px] p-4 rounded-xl cursor-pointer text-sm"
                                    style="background-color: var(--card-bg); color: var(--text-main);"
                                    onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                    onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                    How do I make a move?
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
