@extends('gx_ai.layouts.main')
    @section('content')
    <style>
        /* Base light theme variables */
        :root {
            --bg-main: #ffffff;
            --text-main: #1f1f1f;
            --text-muted: #5f6368;
            --icon-bg: #ffcbda;
            /* pink-200 equivalent */
            --icon-color: #9e4f6d;
            --card-bg: #f1f5f9;
            --card-hover-bg: #dde3ea;
            --button-bg: #4285f4;
            /* Theme toggle button default */
            --button-text: white;
            /* Theme toggle button default */
            --button-hover-bg: #3367d6;
            /* Theme toggle button hover */
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
            --icon-bg: #5a3c4f;
            /* Darker pink for dark mode */
            --icon-color: #ffb8d9;
            /* Lighter pink for dark mode */
            --card-bg: #282a2c;
            --card-hover-bg: #3a3a3a;
            --button-bg: #7da5ff;
            /* Dark theme toggle button */
            --button-text: black;
            /* Dark theme toggle button */
            --button-hover-bg: #5c84e0;
            /* Dark theme toggle button hover */
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
            /* Smooth transition */
        }

        /* Direct styling for elements using CSS variables */
        h1,
        h2,
        h3,
        p {
            /* Apply text color to common elements */
            color: var(--text-main);
        }

        /* Specific override for muted text */
        .text-\[\#5F6368\] {
            color: var(--text-muted) !important;
        }

        /* Styles for icon container */
        .w-16.h-16.rounded-full.bg-pink-200 {
            /* Targeting original classes */
            background-color: var(--icon-bg);
        }

        /* Styles for icon */
        .ph.ph-briefcase.text-4xl.text-\[\#9e4f6d\] {
            /* Targeting original classes */
            color: var(--icon-color);
        }

        /* Styles for cards */
        .bg-\[\#f1f5f9\] {
            /* Targeting original classes */
            background-color: var(--card-bg);
        }

        .hover\:bg-\[\#dde3ea\]:hover {
            /* Targeting original classes for hover */
            background-color: var(--card-hover-bg);
        }

        /* Styles for the theme toggle button */
        #themeToggle {
            background-color: var(--button-bg);
            color: var(--button-text);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        #themeToggle:hover {
            background-color: var(--button-hover-bg);
        }

        /* Custom scrollbar for webkit browsers to match theme */
        ::-webkit-scrollbar {
            height: 8px;
            width: 8px;
            /* For vertical scrollbars, if any */
        }

        ::-webkit-scrollbar-track {
            background: var(--scrollbar-track);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--scrollbar-thumb);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--scrollbar-thumb-hover);
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
                                    <!-- <span class="dot"></span> -->
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
                    <div id="account">

                    </div>
                </div>
            </div>
        </div>
        <div class="gemini-data ">
            <div class="main-chat-area">
                <div class="chat-content-wrapper" style="background-color: var(--bg-main);">
                    <div class="p-10 min-h-screen flex items-center justify-center">
                        <div class="max-w-3xl mx-auto w-full">

                            <!-- Header -->
                            <div class="flex flex-wrap sm:flex-nowrap items-start sm:items-center gap-4 mb-6">
                                <div class="w-16 h-16 rounded-full flex items-center justify-center shrink-0"
                                    style="background-color: var(--icon-bg);">
                                    <i class="ph ph-briefcase text-4xl" style="color: var(--icon-color);"></i>
                                </div>
                                <div class="flex-1 min-w-[200px]">
                                    <h1 class="text-2xl sm:text-4xl font-semibold" style="color: var(--text-main);">
                                        Career guide</h1>
                                    <p class="text-sm sm:text-base text-\[\#5F6368\]">
                                        Unlock your career potential. Get a detailed plan to refine your skills and
                                        achieve your career
                                        goals.
                                    </p>
                                </div>
                            </div>

                            <!-- Scroll wrapper only for small screens -->
                            <div class="block md:hidden overflow-x-auto">
                                <div class="flex gap-4 w-max">
                                    <div class="w-[180px] h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                        style="background-color: var(--card-bg); color: var(--text-main);"
                                        onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                        onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                        I’d like to improve my presentation skills.
                                    </div>
                                    <div class="w-[180px] h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                        style="background-color: var(--card-bg); color: var(--text-main);"
                                        onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                        onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                        Help me figure out how to advocate with my manager for a promotion.
                                    </div>
                                    <div class="w-[180px] h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                        style="background-color: var(--card-bg); color: var(--text-main);"
                                        onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                        onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                        How do I prepare for a job interview with behavioral questions?
                                    </div>
                                    <div class="w-[180px] h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                        style="background-color: var(--card-bg); color: var(--text-main);"
                                        onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                        onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                        Give me advice on how to find a mentor.
                                    </div>
                                </div>
                            </div>

                            <!-- Grid layout for medium and up -->
                            <div class=" md:grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                    style="background-color: var(--card-bg); color: var(--text-main);"
                                    onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                    onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                    I’d like to improve my presentation skills.
                                </div>
                                <div class="h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                    style="background-color: var(--card-bg); color: var(--text-main);"
                                    onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                    onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                    Help me figure out how to advocate with my manager for a promotion.
                                </div>
                                <div class="h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                    style="background-color: var(--card-bg); color: var(--text-main);"
                                    onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                    onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                    How do I prepare for a job interview with behavioral questions?
                                </div>
                                <div class="h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                    style="background-color: var(--card-bg); color: var(--text-main);"
                                    onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                    onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                    Give me advice on how to find a mentor.
                                </div>
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
        const accountData = JSON.parse(localStorage.getItem('login'))

        console.log(accountData);

        const allAccounts = JSON.parse(localStorage.getItem('accounts')) || [];

        const filteredAccounts = allAccounts.filter(acc => acc.email !== accountData.email);

        const accountsList = filteredAccounts
            .map((acc, index) => {

                return `
        <div onclick="switchAccount('${acc.email}')"
            class="flex items-center gap-3 p-4 h-[60px] sm:p-3 cursor-pointer bg-[--bg-main] hover:bg-[var(--sidebar-hover)] ">
            <div class="w-[36px] h-[36px]  bg-[#78909c] text-white flex items-center justify-center rounded-full font-semibold text-lg">
                ${acc.name.charAt(0).toUpperCase()}
            </div>
            <div class="text-left truncate overflow-hidden w-[175px] sm:w-auto">
                <div class="text-sm font-medium text-[var(--text-main)]">${acc.name}</div>
                <div class="text-xs text-[var(--text-muted)] truncate overflow-hidden whitespace-nowrap ">${acc.email}</div>
            </div>
        </div>`;
            }).join('');




        if (accountData) {
            document.getElementById('account').innerHTML =


                `<div class="relative">
                    <div class="relative group inline-block">
                        <button id="profile-button"
                        class="w-8 h-8 bg-[#78909c] rounded-full flex items-center justify-center text-white font-medium">
                        ${accountData.name.charAt(0).toUpperCase()}
                        </button>

                        <div id='account-tooltips' class="absolute z-[999] right-0 mt-1 min-w-56 p-2 bg-[#3c4043e6] hidden group-hover:block rounded">
                        <h5 class="text-[13px] text-[#E8EAED] font-medium m-0">Google Account</h5>
                        <p class="text-[13px] text-[#9AA0A6] font-medium m-0">${accountData.name}</p>
                        <p class="text-[13px] text-[#9AA0A6] font-medium m-0">${accountData.email}</p>
                        </div>
                    </div>

                    <div id="profile-dropdown"
                        class="absolute right-4 top-14 w-[400px] max-w-[90vw] sm:max-w-md rounded-3xl shadow-xl z-50 overflow-hidden"
                        style="background-color: var(--dropdown-bg); color: var(--dropdown-text);">

                        <!-- Header -->
                        <div class="px-4 pt-5 pb-2 text-center text-sm font-medium" style="color: var(--dropdown-text);">
                        ${accountData.email}
                        </div>

                        <!-- Avatar and Welcome -->
                        <div class="px-4 py-4 flex flex-col items-center">
                        <div class="relative">
                            <div id="profile-circle"
                            class="w-[75px] h-[75px] bg-[#78909c] rounded-full flex items-center justify-center text-white text-4xl font-medium mb-2 overflow-hidden cursor-pointer">
                            ${accountData.name.charAt(0).toUpperCase()}
                            </div>
                            <input type="file" id="profile-img-upload" accept="image/*" class="hidden" />
                            <div class="w-6 h-6 bottom-[4px] left-[53px] absolute rounded-full items-center justify-center flex pointer-events-none"
                            style="background-color:var(--sidebar-bg);">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                                fill="currentColor">
                                <path
                                d="M480-264q72 0 120-49t48-119q0-69-48-118.5T480-600q-72 0-120 49.5t-48 119q0 69.5 48 118.5t120 49Zm0-72q-42 0-69-28.13T384-433q0-39.9 27-67.45Q438-528 480-528t69 27.55q27 27.55 27 67.45 0 40.74-27 68.87Q522-336 480-336ZM168-144q-29 0-50.5-21.5T96-216v-432q0-29 21.5-50.5T168-720h120l72-96h240l72 96h120q29.7 0 50.85 21.5Q864-677 864-648v432q0 29-21.15 50.5T792-144H168Zm0-72h624v-432H636l-72.1-96H396l-72 96H168v432Zm312-217Z" />
                            </svg>
                            </div>
                        </div>

                        <div class="text-center mt-2">
                            <div class="font-medium text-base sm:text-xl">Hi, ${accountData.name}</div>
                            <button class="text-sm mt-2 py-2 font-semibold border rounded-full px-5"
                            style="color: var(--accent-blue); border-color: var(--border-color);">Manage your Google Account</button>
                        </div>
                        </div>


                        <!-- Add & Sign Out -->

                        ${accountsList ? `
                             <!-- Other Accounts (Toggleable) -->
                                <div class="flex flex-col gap-1 mt-3 mb-3 m-3 ">
                                        <button id="toggleAccountsBtn" class="w-full   flex justify-between items-center px-4 py-4 bg-[--bg-main] hover:bg-[--account-hover] transition rounded-t-3xl rounded-b-3xl">
                                            <span id="toggleText" class="text-base sm:text-lg">Show more accounts</span>
                                            <i id="iconExpand" class="fa-solid fa-chevron-down transition-transform duration-300"></i>
                                        </button>


                                        <div id="accountList" class="hidden  flex flex-col gap-1 ">
                                            ${accountsList}

                                            <div onclick="handleRedirectLogin()" class="px-4 h-[60px] py-4 flex items-center text-sm justify-start  bg-[--bg-main] hover:bg-[--account-hover] cursor-pointer ">
                                                <div class="w-6 h-6 rounded-full flex items-center justify-center mr-2" style="background-color: var(--sidebar-hover);">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--accent-blue)">
                                                    <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                                                </svg>
                                                </div>
                                                Add account
                                            </div>

                                        <div onclick="signOutAllAccounts()" class="px-4 h-[60px] py-4 flex items-center text-sm justify-start rounded-b-3xl  bg-[--bg-main] hover:bg-[--account-hover] cursor-pointer ">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" class="mr-2" width="24px" fill="currentColor">
                                            <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                                            </svg>
                                            Sign out of all accounts
                                        </div>
                                        </div>
                                </div> `
                    :
                    `
                             <div class="flex justify-center items-center gap-[2px] px-4">
                                <div onclick="handleRedirectLogin()" class="px-4 h-[60px] py-4 flex items-center text-sm justify-start rounded-s-full bg-[--bg-main] hover:bg-[--account-hover] cursor-pointer w-[50%]">
                                    <div class="w-6 h-6 rounded-full flex items-center justify-center mr-2" style="background-color: var(--sidebar-hover);">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--accent-blue)">
                                        <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                                    </svg>
                                    </div>
                                    Add account
                                </div>
                                <div onclick="handleRemoveLogin()" class="px-4 h-[60px] py-4 flex items-center text-sm justify-start rounded-e-full bg-[--bg-main] hover:bg-[--account-hover] cursor-pointer w-[50%]">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" class="mr-2" width="24px" fill="currentColor">
                                    <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                                    </svg>
                                    Sign out
                                </div>
                        </div>`
                }

                        <!-- Footer -->
                        <div class="px-4 py-4 flex justify-center items-center text-xs text-[--text-muted]">
                        <a href="#" class="mr-1 rounded-md p-2 hover:bg-[var(--sidebar-hover)]">Privacy Policy</a>
                        <span class="text-[5px]"> ● </span>
                        <a href="#" class="ml-1 rounded-md p-2 hover:bg-[var(--sidebar-hover)]">Terms of Service</a>
                        </div>
                    </div>
                    </div>`


            document.getElementById('greeting-div').classList.add('hidden')


        } else {

            document.getElementById('account').innerHTML = `
        <button
            class="bg-[--add-btn] text-[--add-btn-text] font-bold py-2 px-4 rounded-lg"
            onclick="handleRedirectLogin()">
            Login
        </button>`;

        }

        function handleRedirectLogin() {
            window.location.href = 'login.html?add=true';  // set flag
        }


        function signOutAllAccounts() {
            localStorage.removeItem('login');
            localStorage.removeItem('accounts');
            window.location.href = 'login.html?add=true'; // or wherever your login page is
        }



        function handleRemoveLogin() {
            const current = JSON.parse(localStorage.getItem('login'));
            let accounts = JSON.parse(localStorage.getItem('accounts')) || [];

            if (current) {
                // Remove current user from saved list
                accounts = accounts.filter(acc => acc.email !== current.email);
                localStorage.setItem('accounts', JSON.stringify(accounts));
            }

            // Set next user as login if available
            if (accounts.length > 0) {
                const nextUser = accounts[0]; // First saved user
                localStorage.setItem('login', JSON.stringify(nextUser));
                window.location.href = 'Gemini.html'; // Auto redirect to app
            } else {
                // No user left, go to login page
                localStorage.removeItem('login');
                window.location.href = 'login.html';
            }
        }



        function switchAccount(email) {
            const allAccounts = JSON.parse(localStorage.getItem('accounts')) || [];
            const user = allAccounts.find(acc => acc.email === email);
            if (user) {
                localStorage.setItem('login', JSON.stringify(user));
                window.location.reload(); // or redirect as needed
            }
        }

        function removeAccount(email) {
            let accounts = JSON.parse(localStorage.getItem('accounts')) || [];
            accounts = accounts.filter(acc => acc.email !== email);
            localStorage.setItem('accounts', JSON.stringify(accounts));

            const current = JSON.parse(localStorage.getItem('login'));
            if (current && current.email === email) {
                localStorage.removeItem('login');
                window.location.href = 'login.html';
            } else {
                window.location.reload();
            }
        }




    </script>
    <script>
        const toggleBtn = document.getElementById("toggleAccountsBtn");
        const accountList = document.getElementById("accountList");
        const toggleText = document.getElementById("toggleText");
        const iconExpand = document.getElementById("iconExpand");

        toggleBtn.addEventListener("click", () => {
            const isVisible = !accountList.classList.contains("hidden");
            accountList.classList.toggle("hidden");

            // Update text and icon
            toggleText.textContent = isVisible ? "Show more accounts" : "Hide more accounts";
            iconExpand.classList.toggle("rotate-180", !isVisible);

            // Toggle bottom radius of the button
            if (!isVisible) {
                toggleBtn.classList.remove("rounded-b-3xl");
            } else {
                toggleBtn.classList.add("rounded-b-3xl");
            }
        });

    </script>
@endpush
