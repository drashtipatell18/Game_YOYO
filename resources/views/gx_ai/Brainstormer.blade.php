@extends('gx_ai.layouts.main')
@section('content')
    <style>
        /* Base light theme variables */
        :root {
            --bg-main: #ffffff;
            --text-main: #1f1f1f;
            --text-muted: #5f6368;
            --icon-bg: #ffcfb4;
            --icon-color: #96490a;
            --card-bg: #f1f5f9;
            --card-hover-bg: #dde3ea;
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
            --icon-bg: #6b3507;
            /* Darker background for the icon */
            --icon-color: #ffcfb4;
            /* Lighter icon for contrast */
            --card-bg: #282a2c;
            --card-hover-bg: #3a3a3a;
            --button-bg: #7da5ff;
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
            /* Default text color for these elements */
        }

        /* Specific overrides for elements with hardcoded Tailwind classes */
        .bg-white {
            background-color: var(--bg-main) !important;
        }

        .text-\[\#1F1F1F\] {
            color: var(--text-main) !important;
        }

        .bg-\[\#ffcfb4\] {
            background-color: var(--icon-bg) !important;
        }

        .text-\[\#96490a\] {
            color: var(--icon-color) !important;
        }

        .text-md {
            /* Targeting the description paragraph */
            color: var(--text-muted) !important;
        }

        .bg-\[\#f1f5f9\] {
            background-color: var(--card-bg) !important;
        }

        .hover\:bg-\[\#dde3ea\]:hover {
            background-color: var(--card-hover-bg) !important;
        }

        ::-webkit-scrollbar {
            height: 8px;
            width: 8px;
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
        <div class="gemini-data ">
            <div class="main-chat-area">
                <div class="chat-content-wrapper" style="background-color: var(--bg-main);">
                    <div class="p-10 min-h-screen flex items-center justify-center">
                        <div class="max-w-3xl mx-auto w-full">

                            <div class="flex flex-wrap sm:flex-nowrap items-start sm:items-center gap-4 mb-6">
                                <div class="w-16 h-16 rounded-full flex items-center justify-center shrink-0"
                                    style="background-color: var(--icon-bg);">
                                    <i class="ph ph-lightbulb text-4xl" style="color: var(--icon-color);"></i>
                                </div>
                                <div>
                                    <h1 class="text-3xl" style="color: var(--text-main);"> Brainstormer </h1>
                                    <p class="text-md" style="color: var(--text-muted);">
                                        Find inspiration easily. Fresh ideas for parties, gifts, businesses and
                                        more.
                                    </p>
                                </div>
                            </div>

                            <div class="block md:hidden overflow-x-auto">
                                <div class="flex gap-4 w-max">
                                    <div class="w-[180px] h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                        style="background-color: var(--card-bg); color: var(--text-main);"
                                        onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                        onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                        Affordable and creative gift ideas for my friend’s birthday.
                                    </div>
                                    <div class="w-[180px] h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                        style="background-color: var(--card-bg); color: var(--text-main);"
                                        onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                        onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                        How to decorate an office space to look cozier yet professional?
                                    </div>
                                    <div class="w-[180px] h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                        style="background-color: var(--card-bg); color: var(--text-main);"
                                        onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                        onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                        Help me plan a large family reunion to host at my house.
                                    </div>
                                    <div class="w-[180px] h-[160px] p-3 rounded-xl cursor-pointer text-sm flex items-start"
                                        style="background-color: var(--card-bg); color: var(--text-main);"
                                        onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                        onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                        What are some fun picnic ideas for kids?
                                    </div>
                                </div>
                            </div>

                            <div class=" md:grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="h-[160px] p-4 rounded-xl cursor-pointer text-sm"
                                    style="background-color: var(--card-bg); color: var(--text-main);"
                                    onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                    onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                    Affordable and creative gift ideas for my friend’s birthday.
                                </div>
                                <div class="h-[160px] p-4 rounded-xl cursor-pointer text-sm"
                                    style="background-color: var(--card-bg); color: var(--text-main);"
                                    onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                    onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                    How to decorate an office space to look cozier yet professional?
                                </div>
                                <div class="h-[160px] p-4 rounded-xl cursor-pointer text-sm"
                                    style="background-color: var(--card-bg); color: var(--text-main);"
                                    onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                    onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                    Help me plan a large family reunion to host at my house.
                                </div>
                                <div class="h-[160px] p-4 rounded-xl cursor-pointer text-sm"
                                    style="background-color: var(--card-bg); color: var(--text-main);"
                                    onmouseover="this.style.backgroundColor='var(--card-hover-bg)'"
                                    onmouseout="this.style.backgroundColor='var(--card-bg)'">
                                    What are some fun picnic ideas for kids?
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
