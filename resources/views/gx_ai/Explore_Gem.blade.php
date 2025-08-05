@extends('gx_ai.layouts.main')
@section('content')
    <style>
        :root {
            --bg-main: #ffffff;
            --bg-hover: #f0f4f9;
            --text-main: #1f1f1f;
            --text-muted: #5f6368;
            --scroll-track: #f0f4f9;
            --scroll-thumb: #d5d9dc;
            --scroll-thumb-hover: #adb3b8;
            --tooltip-bg: #5f6368;
            --tooltip-text: #ffffff;
            --border-color: #dadce0;
            --sidebar-bg: #f0f4f9;
            --sidebar-text: #575b5f;
            --sidebar-hover: #e1e4ea;
            --dropdown-bg: #f0f4f9;
            --dropdown-border: #dadce0;
            --dropdown-text: #1f1f1f;
            --dropdown-hover: #dfe3e7;
            --input-bg: #ffffff;
            --input-border-focus: #4285f4;
            --user-bubble-bg: #e8f0fe;
            --user-bubble-text: #1f1f1f;
            --gemini-bubble-bg: transparent;
            --gemini-bubble-text: #1f1f1f;
            --accent-blue: #4285f4;
            --accent-green: #34a853;
            --card-bg: #F0F4F9;
            --card-hover-bg: #e2e8f0;
            --experiment-tag-bg: #ffffff;
            --experiment-tag-border: #000000;
            --experiment-tag-text: #000000;
            --your-gems-bg: #F0F4F9;
            --your-gems-text: #1b1c1d;
            --new-gem-btn-bg: #0b57d0;
            --new-gem-btn-hover-bg: #1a73e8;
            --new-gem-btn-text: white;
            --copydropdown-bg: black;
            --icon-bg: #ffcbda;
            --icon-color: #9e4f6d;
        }

        body.dark {
            --bg-main: #1b1c1d;
            --bg-hover: #2e2e2e;
            --text-main: #e0e0e0;
            --text-muted: #a0a0a0;
            --scroll-track: #3a3a3a;
            --scroll-thumb: #555555;
            --scroll-thumb-hover: #777777;
            --tooltip-bg: #a0a0a0;
            --tooltip-text: #1f1f1f;
            --border-color: #444444;
            --sidebar-bg: #2e2e2e;
            --sidebar-text: #a0a0a0;
            --sidebar-hover: #3a3a3a;
            --dropdown-bg: #2e2e2e;
            --dropdown-border: #444444;
            --dropdown-text: #e0e0e0;
            --dropdown-hover: #3b3d3f;
            --input-bg: #2e2e2e;
            --input-border-focus: #7da5ff;
            --user-bubble-bg: #3a3a3a;
            --user-bubble-text: #e0e0e0;
            --gemini-bubble-bg: transparent;
            --gemini-bubble-text: #e0e0e0;
            --accent-blue: #7da5ff;
            --accent-green: #6dc37e;
            --card-bg: #282a2c;
            --card-hover-bg: #3a3a3a;
            --experiment-tag-bg: #3a3a3a;
            --experiment-tag-border: #777777;
            --experiment-tag-text: #e0e0e0;
            --your-gems-bg: #282a2c;
            --your-gems-text: #e0e0e0;
            --new-gem-btn-bg: #a8c7fa;
            --new-gem-btn-hover-bg: #809ee0;
            --new-gem-btn-text: #062e6f;
            --copydropdown-bg: #e3e3e3;
            --icon-bg: #5a3c4f;
            --icon-color: #ffb8d9;
        }

        :root {
            --bg-main: #FFFFFF;
            --bg-hover: #E2E7EB;
            --text-main: #1F1F1F;
            --text-muted: #5F6368;
            --scroll-track: #F0F4F9;
            --scroll-thumb: #D5D9DC;
            --scroll-thumb-hover: #ADB3B8;
            --tooltip-bg: #5F6368;
            --tooltip-text: #FFFFFF;
            --border-color: #DADCE0;
            --sidebar-bg: #f0f4f9;
            --sidebar-text: #575b5f;
            --sidebar-hover: #e1e4ea;
            --dropdown-bg: #f0f4f9;
            --dropdown-border: #DADCE0;
            --dropdown-text: #1F1F1F;
            --input-bg: #FFFFFF;
            --input-border-focus: #4285F4;
            --user-bubble-bg: #E8F0FE;
            --user-bubble-text: #1F1F1F;
            --gemini-bubble-bg: transparent;
            --gemini-bubble-text: #1F1F1F;
            --accent-blue: #4285F4;
            --accent-green: #34A853;

        }

        body.dark {
            --bg-main: #1b1c1d;
            --bg-hover: #2b2d2e;
            --text-main: #E8EAED;
            --text-muted: #9AA0A6;
            --scroll-track: #1e293b;
            --scroll-thumb: #4a5568;
            --scroll-thumb-hover: #64748b;
            --tooltip-bg: #282a2c;
            --tooltip-text: #E8EAED;
            --border-color: #4a5050;
            --sidebar-bg: #282a2c;
            --sidebar-text: #a2a9b0;
            --sidebar-hover: #303134;
            --dropdown-bg: #282a2c;
            --dropdown2-bg: #1b1c1d;
            --dropdown-border: #3c4043;
            --dropdown-text: #E8EAED;
            --input-border-focus: #8AB4F8;
            --user-bubble-bg: #333537;
            --user-bubble-text: #E8EAED;
            --gemini-bubble-bg: transparent;
            --gemini-bubble-text: #E8EAED;
            --accent-blue: #8AB4F8;
            --accent-green: #6AA56A;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-main);
        }

        .bg-\[\#F0F4F9\] {
            background-color: var(--card-bg);
        }

        .hover\:bg-\[\#e2e8f0\]:hover {
            background-color: var(--card-hover-bg);
        }

        .text-\[var\(--text-muted\)\] {
            color: var(--text-muted);
        }

        .bg-white {
            background-color: var(--experiment-tag-bg);
        }

        .border-black {
            border-color: var(--experiment-tag-border);
        }

        .text-black {
            color: var(--experiment-tag-text);
        }

        .text-white {
            color: var(--new-gem-btn-text);
        }

        .your-gems-message {
            color: var(--your-gems-text) !important;
        }

        .bg-\[var\(--bg-hover\)\] {
            background-color: var(--your-gems-bg);
        }

        svg[fill="#575b5f"] {
            fill: var(--text-muted);
        }

        svg[fill="#1b1c1d"] {
            fill: var(--text-main);
        }

        .copy-menu {
            position: relative;
            display: inline-block;
        }

        .copy-menu-content {
            position: absolute;
            bottom: 0;
            right: 25px;
            background-color: var(--copydropdown-bg);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 99;
            display: none;
            font-size: 13px;
            color: var(--tooltip-text);
        }

        .copy-menu:hover .copy-menu-content {
            display: block;
        }

        .copy-menu-item {
            padding: 4px 8px;
            cursor: pointer;
            white-space: nowrap;
            color: var(--bg-main);
        }
    </style>
        <div class="gemini-data ">
            <div class="main-chat-area">
                <div class="chat-content-wrapper" style="background-color: var(--bg-main);">
                    <div class="max-w-4xl mx-auto px-6 py-10 ">


                        <h1 class="text-3xl mb-8">Gem manager</h1>
                        <div class="justify-between mb-4 flex">
                            <h2 class="font-medium ">Premade by Google</h2>
                            <button id="toggleBtnExpore" class="font-medium flex items-center gap-1">
                                <span id="toggleTextExplore">Show more</span>
                                <i class="ph ph-caret-down"></i>
                            </button>
                        </div>

                        <div id="cardContainer"
                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-2 mb-5">
                            <a href="../Career_guide.html"
                                class="p-4 rounded-xl transition cursor-pointer bg-[var(--card-bg)] hover:bg-[var(--card-hover-bg)]">
                                <div class="flex justify-between items-center gap-2 pb-3">
                                    <div
                                        class="w-7 h-7 rounded-full justify-center items-center flex bg-[var(--icon-bg)]">
                                        <i class="ph ph-briefcase text-[var(--icon-color)] text-lg "></i>
                                    </div>
                                    <div class="copy-menu">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                            width="20px" fill="var(--text-muted)">
                                            <path
                                                d="M360-240q-29.7 0-50.85-21.15Q288-282.3 288-312v-480q0-29.7 21.15-50.85Q330.3-864 360-864h384q29.7 0 50.85 21.15Q816-821.7 816-792v480q0 29.7-21.15 50.85Q773.7-240 744-240H360Zm0-72h384v-480H360v480ZM216-96q-29.7 0-50.85-21.15Q144-138.3 144-168v-552h72v552h456v72H216Zm144-216v-480 480Z" />
                                        </svg>
                                        <div class="copy-menu-content">
                                            <div class="copy-menu-item" onclick="copyToClipboard('Make a copy')">
                                                Make a
                                                copy</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-hidden">
                                    <h3 class="font-semibold pb-1">Career guide</h3>
                                    <p class="text-[13px] text-[var(--text-muted)] line-clamp-3">
                                        Unlock your career potential. Get a detailed plan to refine your skills and
                                        achieve your...
                                    </p>
                                </div>
                            </a>

                            <a href="../Chess_champ.html"
                                class="p-4 rounded-xl transition cursor-pointer bg-[var(--card-bg)] hover:bg-[var(--card-hover-bg)]">
                                <div class="flex justify-start items-center gap-2 pb-3">
                                    <div class="w-7 h-7 rounded-full justify-center items-center flex bg-[#ffd289]">
                                        <i class="ph ph-strategy text-[#7e5700] text-lg "></i>
                                    </div>
                                    <span
                                        class="ml-1 text-sm border px-2 py-0 rounded-full bg-[var(--experiment-tag-bg)] text-[var(--experiment-tag-text)] border-[var(--experiment-tag-border)]">
                                        Experiment
                                    </span>
                                </div>
                                <div class="overflow-hidden">
                                    <h3 class="font-semibold pb-1">Chess champ</h3>
                                    <p class="text-[13px] text-[var(--text-muted)] line-clamp-3">
                                        Play chess with a language model. Make your first move using chess notation
                                        to
                                        start...
                                    </p>
                                </div>
                            </a>

                            <a href="../Brainstormer.html"
                                class="p-4 rounded-xl transition cursor-pointer bg-[var(--card-bg)] hover:bg-[var(--card-hover-bg)]">
                                <div class="flex justify-between items-center gap-2 pb-3">
                                    <div class="w-7 h-7 rounded-full justify-center items-center flex bg-[#ffcfb4]">
                                        <i class="ph ph-lightbulb text-[#96490a] text-lg "></i>
                                    </div>
                                    <div class="copy-menu">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                            width="20px" fill="var(--text-muted)">
                                            <path
                                                d="M360-240q-29.7 0-50.85-21.15Q288-282.3 288-312v-480q0-29.7 21.15-50.85Q330.3-864 360-864h384q29.7 0 50.85 21.15Q816-821.7 816-792v480q0 29.7-21.15 50.85Q773.7-240 744-240H360Zm0-72h384v-480H360v480ZM216-96q-29.7 0-50.85-21.15Q144-138.3 144-168v-552h72v552h456v72H216Zm144-216v-480 480Z" />
                                        </svg>
                                        <div class="copy-menu-content">
                                            <div class="copy-menu-item" onclick="copyToClipboard('Make a copy')">
                                                Make a
                                                copy</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-hidden">
                                    <h3 class="font-semibold pb-1"> Brainstormer </h3>
                                    <p class="text-[13px] text-[var(--text-muted)] line-clamp-3">
                                        Find inspiration easily. Fresh ideas for parties, gifts, businesses and
                                        more.
                                    </p>
                                </div>
                            </a>

                            <a href="../Coding_partner.html"
                                class="p-4 rounded-xl transition cursor-pointer bg-[var(--card-bg)] hover:bg-[var(--card-hover-bg)]">
                                <div class="flex justify-between items-center gap-2 pb-3">
                                    <div class="w-7 h-7 rounded-full justify-center items-center flex bg-[#92e5ff]">
                                        <i class="ph ph-code text-[#00677d] text-lg "></i>
                                    </div>
                                    <div class="copy-menu">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                            width="20px" fill="var(--text-muted)">
                                            <path
                                                d="M360-240q-29.7 0-50.85-21.15Q288-282.3 288-312v-480q0-29.7 21.15-50.85Q330.3-864 360-864h384q29.7 0 50.85 21.15Q816-821.7 816-792v480q0 29.7-21.15 50.85Q773.7-240 744-240H360Zm0-72h384v-480H360v480ZM216-96q-29.7 0-50.85-21.15Q144-138.3 144-168v-552h72v552h456v72H216Zm144-216v-480 480Z" />
                                        </svg>
                                        <div class="copy-menu-content">
                                            <div class="copy-menu-item" onclick="copyToClipboard('Make a copy')">
                                                Make a
                                                copy</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-hidden">
                                    <h3 class="font-semibold pb-1"> Coding partner </h3>
                                    <p class="text-[13px] text-[var(--text-muted)] line-clamp-3">
                                        Level up your coding skills. Get the help you need to build your projects
                                        and
                                        learn as yo...
                                    </p>
                                </div>
                            </a>

                            <a href="{{ route('yin.learningCoatch') }}"
                                class="extra-card transition-all duration-300 ease-in-out overflow-hidden max-h-0 opacity-0 scale-y-90 transform origin-top bg-[var(--card-bg)] hover:bg-[var(--card-hover-bg)] cursor-pointer p-4 mb-3 rounded-xl">

                                <div class="flex justify-between items-center gap-2 pb-3">
                                    <div class="w-7 h-7 rounded-full justify-center items-center flex bg-[#bedcff]">
                                        <i class="ph ph-book-open text-[#00629e] text-lg "></i>
                                    </div>
                                    <div class="copy-menu">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                            width="20px" fill="var(--text-muted)">
                                            <path
                                                d="M360-240q-29.7 0-50.85-21.15Q288-282.3 288-312v-480q0-29.7 21.15-50.85Q330.3-864 360-864h384q29.7 0 50.85 21.15Q816-821.7 816-792v480q0 29.7-21.15 50.85Q773.7-240 744-240H360Zm0-72h384v-480H360v480ZM216-96q-29.7 0-50.85-21.15Q144-138.3 144-168v-552h72v552h456v72H216Zm144-216v-480 480Z" />
                                        </svg>
                                        <div class="copy-menu-content">
                                            <div class="copy-menu-item" onclick="copyToClipboard('Make a copy')">
                                                Make a
                                                copy</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-hidden">
                                    <h3 class="font-semibold pb-1">Learning coach</h3>
                                    <p class="text-[13px] text-[var(--text-muted)] line-clamp-3">
                                        Here to help you learn and practice new concepts. Tell me what you'd like to
                                        learn, and I...
                                    </p>
                                </div>
                            </a>

                            <a href="../Writing_editor.html"
                                class="extra-card transition-all duration-300 ease-in-out overflow-hidden max-h-0 opacity-0 scale-y-90 transform origin-top bg-[var(--card-bg)] hover:bg-[var(--card-hover-bg)] cursor-pointer p-4 mb-3 rounded-xl">

                                <div class="flex justify-between items-center gap-2 pb-3">
                                    <div class="w-7 h-7 rounded-full justify-center items-center flex bg-[#f2ccff]">
                                        <i class="ph ph-pencil-circle text-[#9700d2] text-lg "></i>
                                    </div>
                                    <div class="copy-menu">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                            width="20px" fill="var(--text-muted)">
                                            <path
                                                d="M360-240q-29.7 0-50.85-21.15Q288-282.3 288-312v-480q0-29.7 21.15-50.85Q330.3-864 360-864h384q29.7 0 50.85 21.15Q816-821.7 816-792v480q0 29.7-21.15 50.85Q773.7-240 744-240H360Zm0-72h384v-480H360v480ZM216-96q-29.7 0-50.85-21.15Q144-138.3 144-168v-552h72v552h456v72H216Zm144-216v-480 480Z" />
                                        </svg>
                                        <div class="copy-menu-content">
                                            <div class="copy-menu-item" onclick="copyToClipboard('Make a copy')">
                                                Make a
                                                copy</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-hidden">
                                    <h3 class="font-semibold pb-1">Writing editor</h3>
                                    <p class="text-[13px] text-[var(--text-muted)] line-clamp-3">
                                        Elevate your writing. Get clear, constructive feedback, from grammar to
                                        structure.
                                    </p>
                                </div>
                            </a>
                        </div>

                        <div class="mb-6">
                            <div class="justify-between mb-10 flex items-center">
                                <h2 class="font-medium">Your Gems</h2>
                                <a href="{{ route('yin.new_gem') }}"
                                    class="bg-[var(--new-gem-btn-bg)] cursor-pointer text-[var(--new-gem-btn-text)] px-4 py-2 rounded-full font-medium hover:bg-[var(--new-gem-btn-hover-bg)]">
                                    <i class="ph ph-plus-circle mr-2"></i>
                                    New Gem
                                </a>
                            </div>
                            <div id="showGems" class="flex flex-col gap-2"></div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ---------------------------------------------- -->
    <!-- Gems Delete Modal -->
    <div id="gemDeleteModal"
        class="bg-[--form-theme] pt-5 lg:w-[30%] md:w-[60%] sm:w-[80%] w-[90%] px-8 pb-6 rounded-2xl top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 fixed hidden z-50 rounded-2xl shadow-lg">
        <h3 class="text-[--text-main] text-2xl mb-9 ">Delete Gem?</h3>
        <p class="text-[--text-muted] text-[14px]">Deleting this Gem will only delete the template you created,
            including any knowledge files uploaded to the Gem. Chats and public links associated with this Gem will
            remain. If you want to delete chats, you can do that in your list of chats in Recent or in your YOYO Apps
            Activity. If you want to delete public links, you can do that in your public links page in YOYO
            Settings.</p>
        <div class="flex justify-end mt-8">
            <button id="cancel-delete-gem"
                class="text-[--input-border-focus] text-md hover:bg-[--examples-btn-hover] py-2 px-3 rounded-3xl font-semibold">Cancel</button>
            <button id="confirm-delete-gem"
                class="text-[--input-border-focus] text-md hover:bg-[--examples-btn-hover] py-2 px-3 rounded-3xl font-semibold">Delete</button>
        </div>
    </div>

    <script>
        const toggleBtnExpore = document.getElementById("toggleBtnExpore");
        const toggleTextExplore = document.getElementById("toggleTextExplore");
        const extraCards = document.querySelectorAll(".extra-card");
        const themeToggle = document.getElementById("themeToggle");
        const body = document.body;

        let expanded = false;



        // Toggle button for showing/hiding extra cards
        toggleBtnExpore.addEventListener("click", () => {
            expanded = !expanded;
            toggleTextExplore.textContent = expanded ? "Show less" : "Show more";

            extraCards.forEach(card => {
                if (expanded) {
                    card.classList.remove("max-h-0", "opacity-0", "scale-y-90");
                    card.classList.add("max-h-[200px]", "opacity-100", "scale-y-100");
                } else {
                    card.classList.remove("max-h-[200px]", "opacity-100", "scale-y-100");
                    card.classList.add("max-h-0", "opacity-0", "scale-y-90");
                }
            });
        });


        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                console.log('Copied: ' + text);
                // Close the menu after copying
                document.querySelectorAll('.copy-menu-content').forEach(menu => {
                    menu.style.display = 'none';
                });
            });
        }
    </script>

    <script>
        const colorPalette = [
            "#F44336",
            "#E91E63",
            "#9C27B0",
            "#3F51B5",
            "#2196F3",
            "#00BCD4",
            "#009688",
            "#4CAF50",
            "#FF9800",
            "#795548",
            "#607D8B",
            "#FF5722",
            "#673AB7"
        ];


        function getColorFromPalette(name) {
            let hash = 0;
            for (let i = 0; i < name.length; i++) {
                hash = name.charCodeAt(i) + ((hash << 5) - hash);
            }
            return colorPalette[Math.abs(hash) % colorPalette.length];
        }


        function getContrastColor(bg) {
            const hex = bg.replace("#", "");
            const r = parseInt(hex.substr(0, 2), 16);
            const g = parseInt(hex.substr(2, 2), 16);
            const b = parseInt(hex.substr(4, 2), 16);
            const brightness = (r * 299 + g * 587 + b * 114) / 1000;
            return brightness > 150 ? "#000000" : "#FFFFFF";
        }

        async function fetchGemsData() {
            const showGems = document.getElementById("showGems");

            try {
                const response = await fetch('http://localhost:8080/newGems');
                const gemsdata = await response.json();

                showGems.innerHTML = "";

                if (gemsdata && gemsdata.length > 0) {
                    gemsdata.forEach((v, i) => {
                        const bgColor = getColorFromPalette(v.gemsName || "default");
                        const textColor = getContrastColor(bgColor);

                        showGems.innerHTML += `
                        <div class="rounded-xl p-4 x-gem text-[var(--text-muted)] flex justify-between items-center bg-[var(--your-gems-bg)] hover:bg-[--gems-bg-hover]">
                            <div class="flex items-center gap-4">
                                <button
                                    class="w-8 h-8 rounded-full flex items-center justify-center font-medium"
                                    style="background-color: ${bgColor}; color: ${textColor};">
                                    ${v.gemsName?.charAt(0).toUpperCase() || "U"}
                                </button>
                                <div class="flex flex-col gap-2 ">
                                    <p class="text-[12px] font-medium text-[--text-main]">${v.gemsName || "No Name"}</p>
                                    <span title="${v.gemsDescription || ''}" class="text-[12px]  text-[--text-muted] truncate overflow-hidden whitespace-nowrap w-[100px] sm:max-w-[160px] md:max-w-[200px]">
                                        ${v.gemsDescription || ""}
                                    </span>

                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button onclick=handleEditgem('${v.id}') class="hover:bg-[--model-hover] w-10 h-10 rounded-full flex items-center justify-center text-[--text-muted] font-medium">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <div class="relative gemx-wrapper">
                                    <button onclick="gemxToggleMenu('${v.id}')" class="hover:bg-[--model-hover] w-10 h-10 rounded-full flex items-center justify-center text-[--text-muted] font-medium gemx-menu-btn">
                                         <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div id="gemx-menu-${v.id}" class="gemx-dropdown absolute right-0 bottom-full mb-2 w-56 rounded-xl shadow-xl bg-[--bg-main] text-[--text-main] hidden z-10">
                                        <ul class="py-1 text-sm">
                                            <li> <a  href="Gemini.html" class="flex cursor-pointer items-center gap-2 px-4 py-4 text-[16px] hover:bg-[--model-hover]"><i class="fa-regular fa-comment text-[20px]"></i> New chat </a></li>
                                            <li > <a onclick='copyGem(${JSON.stringify(v)})' class="flex cursor-pointer items-center gap-2 px-4 py-4 text-[16px] hover:bg-[--model-hover]"><i class="fa-regular fa-copy text-[20px]"></i> Make a copy </a></li>
                                            <li > <a onclick="handleDeleteGem('${v.id}')" class="flex cursor-pointer items-center gap-2 px-4 py-4 text-[16px] hover:bg-[--model-hover] "><i class="fa-regular fa-trash-can text-[20px]"></i> Delete </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    });
                } else {
                    showGems.innerHTML = `
                    <div class="rounded-xl p-6 text-center x-gem text-[var(--text-muted)] flex justify-center items-center bg-[var(--your-gems-bg)]">
                        <i class="fa-regular fa-gem text-xl text-[var(--user-bubble-text)]"></i>
                        <p class="ml-2 text-lg your-gems-message">The Gems you create will appear here</p>
                    </div>`;
                }
            } catch (err) {
                console.error("Error fetching gems:", err);
                showGems.innerHTML = `<p class="text-red-500">Error loading gems</p>`;
            }
        }

        async function handleEditgem(id) {
            const response = await fetch('http://localhost:8080/newGems');
            const gemsdata = await response.json();

            const gem = gemsdata.find((v) => v.id === id);

            localStorage.setItem('editingGem', JSON.stringify(gem));

            localStorage.removeItem('copiedGem');

            window.location.href = 'NewGem.html';
        }


        fetchGemsData();



        function gemxToggleMenu(id) {

            const targetMenu = document.getElementById(`gemx-menu-${id}`);

            const isVisible = !targetMenu.classList.contains("hidden");

            // Hide all other open menus

            document.querySelectorAll('.gemx-dropdown').forEach(menu => {

                menu.classList.add("hidden");

            });

            // Toggle visibility of clicked one

            if (!isVisible) {

                targetMenu.classList.remove("hidden");

            }

        }

        // Close dropdowns when clicking outside

        document.addEventListener("click", function (event) {

            const clickedInsideDropdown = event.target.closest('.gemx-dropdown');

            const clickedMenuButton = event.target.closest('.gemx-menu-btn');

            if (!clickedInsideDropdown && !clickedMenuButton) {

                document.querySelectorAll('.gemx-dropdown').forEach(menu => {

                    menu.classList.add("hidden");

                });

            }

        });



        let currentDeleteId = null;

        const handleDeleteGem = (id) => {
            currentDeleteId = id;
            const gemDeleteModal = document.getElementById('gemDeleteModal');
            if (gemDeleteModal) {
                gemDeleteModal.classList.remove('hidden');

                const confirmDeleteBtn = document.getElementById('confirm-delete-gem');
                if (confirmDeleteBtn) {

                    confirmDeleteBtn.replaceWith(confirmDeleteBtn.cloneNode(true));
                    document.getElementById('confirm-delete-gem').addEventListener('click', async () => {
                        await handleDeleteConfirmed();
                    });
                }
            }
        };


        const handleDeleteConfirmed = async () => {
            if (!currentDeleteId) return;

            try {
                const response = await fetch('http://localhost:8080/newGems/' + currentDeleteId, {
                    method: "DELETE"
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const gemDeleteModal = document.getElementById('gemDeleteModal');
                if (gemDeleteModal) {
                    gemDeleteModal.classList.add('hidden');
                }
                currentDeleteId = null;
                await Display();
            } catch (error) {
                console.error("Error deleting info:", error);

            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const cancelDeleteGem = document.getElementById('cancel-delete-gem');
            if (cancelDeleteGem) {
                cancelDeleteGem.addEventListener('click', () => {
                    gemDeleteModal.classList.add('hidden');
                });
            }
        })


        function copyGem(selectedGem) {
            const copiedGem = { ...selectedGem };
            delete copiedGem.id;

            localStorage.setItem('editingGem', JSON.stringify(copiedGem));
            localStorage.setItem('copiedGem', 'true');
            window.location.href = 'NewGem.html';
        }
    </script>
@endsection