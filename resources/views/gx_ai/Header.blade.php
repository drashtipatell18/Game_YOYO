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
                                <a href="{{ route('yin.index') }}" class="items-center flex gap-5"> <span
                                        class="material-symbols-outlined">edit_square</span>
                                    <span>New Chat</span>
                                </a>
                                <span class="new-chat">New Chat</span>
                            </li>
                            <li class="diamond">
                                <a href="{{ route('yin.explore_gem') }}" class="w-[100%] items-center flex gap-5"> <span
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
                                    <a href="{{ route('yin.public_link') }}" class="w-[100%] items-center flex gap-5">
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


    <!------------------------------------------------->
    <!-- Help Center -->
  <div id="help_Data"
        class="flex flex-col hidden  justify-start fixed top-[100px] rounded-2xl right-[10px] bg-[--bg-main] shadow-[0_1px_3px_0_rgba(60,64,67,0.3),_0_4px_8px_3px_rgba(60,64,67,0.15)]  lg:w-[23%] md:w-[40%] sm:w-[50%] w-[90%] h-[70vh] overflow-y-auto">

        <!-- Sticky Header -->
        <div class="sticky top-0 left-0 py-3 pb-8 w-full flex items-center justify-between bg-[--bg-main] z-10">
            <p class="text-2xl text-[--text-main] text-center w-full">Help</p>
            <button id="help_close" class="absolute right-4 top-3">
                <i class="fa-solid fa-xmark text-2xl text-[--text-main]"></i>
            </button>
        </div>

        <!-- Scrollable Content -->
        <div class="text-[--text-main] space-y-3 pb-4 text-left">
            <h6 class="text-[16px] text-[--text-main] ps-4">Popular help resources</h6>


            <div class="flex items-center gap-3 hover:bg-[--dropdown-hover] py-2 px-4 cursor-pointer">
                <div
                    class="w-[40px] h-[40px] min-h-[40px] min-w-[40px] rounded-full bg-[--examples-btn-hover]  flex justify-center items-center ">
                    <i class="fa-regular fa-file-lines text-[--add-btn]"></i>
                </div>
                <span class="text-[16px] text-[--text-main]">Manage & delete your YOYO Apps activity</span>
            </div>
            <div class="flex items-center gap-3 hover:bg-[--dropdown-hover] py-2 px-4 cursor-pointer">
                <div
                    class="w-[40px] h-[40px] min-h-[40px] min-w-[40px] rounded-full bg-[--examples-btn-hover] flex justify-center items-center">
                    <i class="fa-regular fa-file-lines text-[--add-btn]"></i>
                </div>
                <span class="text-[16px] text-[--text-main]">Use YOYO Apps</span>
            </div>
            <div class="flex items-center gap-3 hover:bg-[--dropdown-hover] py-2 px-4 cursor-pointer">
                <div
                    class="w-[40px] h-[40px] min-h-[40px] min-w-[40px] rounded-full bg-[--examples-btn-hover] flex justify-center items-center">
                    <i class="fa-regular fa-file-lines text-[--add-btn]"></i>
                </div>
                <span class="text-[16px] text-[--text-main]">Use & manage apps in YOYO</span>
            </div>
            <div class="flex items-center gap-3 hover:bg-[--dropdown-hover] py-2 px-4 cursor-pointer">
                <div
                    class="w-[40px] h-[40px] min-h-[40px] min-w-[40px] rounded-full bg-[--examples-btn-hover] flex justify-center items-center">
                    <i class="fa-regular fa-file-lines text-[--add-btn]"></i>
                </div>
                <span class="text-[16px] text-[--text-main]">Find & manage your recent chats in YOYO Apps</span>
            </div>
            <div class="flex items-center gap-3 hover:bg-[--dropdown-hover] py-2 px-4 cursor-pointer">
                <div
                    class="w-[40px] h-[40px] min-h-[40px] min-w-[40px] rounded-full bg-[--examples-btn-hover] flex justify-center items-center">
                    <i class="fa-regular fa-file-lines text-[--add-btn]"></i>
                </div>
                <span class="text-[16px] text-[--text-main]">Where you can use the YOYO web app</span>
            </div>


            <a href="" class="text-[14px] text-[--add-btn] w-full block hover:bg-[--bg-hover] py-4 px-10">Visit help
                forum <i class="fa-solid fa-arrow-up-right-from-square"></i></a>

            <div class="bg-[--dropdown-hover] py-3 mx-5 rounded-full flex items-center px-5 cursor-pointer">
                <i class="fa-solid fa-magnifying-glass me-3"></i>
                <input type="search" class="w-full bg-transparent outline-none border-0 cursor-pointer">
            </div>

            <div class="py-4 border-t-[8px] border-b-[8px] border-[--border-color]-500">
                <p class="text-[--text-main] ps-4">Need more help?</p>
                <div class="flex items-center gap-3 hover:bg-[--dropdown-hover] py-2 px-4 mt-3  cursor-pointer">
                    <div
                        class="w-[40px] h-[40px] min-h-[40px] min-w-[40px] rounded-full bg-[--examples-btn-hover] flex justify-center items-center">
                        <i class="fa-solid fa-message text-[--add-btn]"></i>
                    </div>
                    <div>
                        <p class="text-[--text-main] text-[16px]">Ask the Help Community</p>
                        <span class="text-[--text-muted] text-[16px]">Get answers from community experts</span>
                    </div>
                </div>

            </div>

            <div class="flex items-center gap-3 hover:bg-[--dropdown-hover] py-2 px-4 mt-3  cursor-pointer">
                <div
                    class="w-[40px] h-[40px] min-h-[40px] min-w-[40px] rounded-full bg-[--examples-btn-hover] flex justify-center items-center">
                    <i class="fa-solid fa-circle-exclamation text-[--add-btn]"></i>
                </div>
                <p class="text-[16px] text-[--add-btn] font-medium">Report a problem</p>
            </div>
        </div>
    </div>

    <script>
        const help_Data = document.getElementById('help_Data');
        const help_close = document.getElementById('help_close');
        const open_help_center = document.getElementById('open_help_center');



        open_help_center.addEventListener('click', () =>
            help_Data.classList.remove('hidden')
        );
        help_close.addEventListener('click', () =>
            help_Data.classList.add('hidden')
        );
    </script>

     <!-- ************Feedback********* -->

    <div id="feedback-data"
        class="flex z-50 flex-col hidden justify-between fixed top-0 right-0 rounded-l-2xl bg-[#1F1F1F] shadow-[0_1px_3px_0_rgba(60,64,67,0.3),_0_4px_8px_3px_rgba(60,64,67,0.15)] lg:w-[28%] md:w-[40%] sm:w-[50%] w-[90%] h-[100vh] overflow-hidden">

        <!-- Sticky Header -->
        <div
            class="sticky top-0 left-0 py-5 px-4 w-full flex items-center justify-between bg-[#1F1F1F] shadow-[0_1px_4px_rgba(0,0,0,0.6)] z-10">
            <p class="text-lg text-white w-full">Send feedback to Google</p>
            <button id="feedback_close"
                class="absolute right-4 w-[50px] h-[50px] rounded-full top-3 hover:bg-[#303134]">
                <i class="fa-solid fa-xmark text-2xl text-white"></i>
            </button>
        </div>

        <!-- Scrollable Content + Bottom -->
        <div class="flex flex-col justify-between h-full overflow-y-auto">
            <div class="space-y-3 text-white p-4 text-left">
                <h6 class="text-[14px]">Describe your feedback (required)</h6>

                <textarea name="feedback_message" id="feedback_message"
                    placeholder="Tell us what prompted this feedback..." rows="4"
                    class="w-full bg-transparent border rounded p-2 outline-none focus:ring-2 focus:ring-[#8AB4F8] focus:border-0 text-[16px] text-white"></textarea>


                <span class="text-[12px]">Please don’t include any sensitive information <i
                        class="fa-regular fa-circle-question"></i></span>

                <p class="text-[16px]">A screenshot will help us better understand your feedback.</p>

                <div
                    class="w-full border text-center text-[#7cacf8] rounded-md py-2 hover:border-[#7cacf8] hover:bg-[#2A3039] cursor-pointer">
                    <p class="text-[15px]"><i class="fa-solid fa-desktop"></i> Capture screenshot</p>
                </div>
            </div>

            <!-- Fixed Bottom Section -->
            <div class="mt-auto  bg-[#1F1F1F] ">
                <div class="flex items-center gap-2 mb-4 px-4">
                    <input type="checkbox" name="checkbox" id="checkbox"
                        class="w-5 h-5 bg-[#1F1F1F] accent-[#7CACF8] cursor-pointer border rounded" />
                    <label for="checkbox" class="text-white cursor-pointer">
                        We may email you for more information or updates
                    </label>
                </div>

                <p class="text-[14px] text-white mb-4 px-4">
                    Some account and system information may be sent to Google. We will use it to fix problems and
                    improve
                    our services, subject to our Privacy Policy and Terms of Service. We may email you for more
                    information
                    or updates. Go to Legal Help to ask for content changes for legal reasons.
                </p>

                <div class="text-end shadow-[0_-4px_6px_rgba(0,0,0,0.15)] mt-2 p-4">
                    <button id="sendBtn" disabled class="bg-[#373737] py-2 px-6 rounded-lg text-white text-[16px]">
                        Send
                    </button>

                </div>
            </div>
        </div>
    </div>



</body>
</html>