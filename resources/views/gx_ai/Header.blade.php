<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Google Gemini</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=edit_square" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,0,0,0&icon_names=diamond" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('frontend/gx_ai/Gemini.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/gx_ai/SavedInfo.css') }}">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body>
    <div class="w-[100%] contents">
        <div class="backdrop" id="backdrop"></div>

        <div class="">
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
                                    <a href="{{ route('yin.savedInfo') }}" class="w-[100%] items-center flex gap-5">
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
    </div>
</body>
</html>