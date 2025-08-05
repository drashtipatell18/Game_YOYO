@extends('gx_ai.layouts.main')
@section('content')
        <div class="gemini-data gemini-container">
            <div class="main-chat-area">
                <div class="chat-content-wrapper gemini-chat-content-wrapper" style="background-color: var(--bg-main);">
                    <div id="chat-history" class=" space-y-4 relative">

                    </div>

                    <div id="greeting-div"
                        class="absolute inset-0 flex flex-col items-center text-center justify-center pointer-events-none">
                        <!-- <h1 class="text-3xl font-medium"> Meet </h1> -->
                        <h1
                            class="text-3xl bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 text-transparent bg-clip-text">
                            <span class="text-[--text-main] ">Meet</span>
                            YOYO.
                        </h1>
                        <h1 class="text-3xl  text-[--text-main] ">your personal AI assistant</h1>
                    </div>

                    <div class="input-area-wrapper">
                        <div class="relative border-2 rounded-3xl px-6 pt-4 pb-12"
                            style="border-color: var(--border-color);">
                            <div id="image-preview-container" class="mb-2 relative hidden group w-fit">
                                <img id="image-preview" class="max-w-[100px] max-h-[100px] rounded-md" />
                                <button id="remove-preview"
                                    class="absolute top-1 right-1 w-8 h-8 text-2xl bg-black bg-opacity-60 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    &times;
                                </button>

                            </div>

                            <textarea id="user-input" placeholder="Ask YOYO"
                                class="w-full text-sm md:text-base font-medium bg-transparent resize-none overflow-y-auto max-h-[150px] focus:outline-none"
                                oninput="autoResize(this)" style="color: var(--text-main);">
                            </textarea>

                            <div
                                class="input-area-buttons flex justify-between items-center text-[var(--sidebar-text);]">
                                <div class="flex gap-2 text-sm items-center">
                                    <div class="relative">
                                        <button id="plus-button"
                                            class="group h-10 w-10 flex items-center justify-center rounded-full hover:bg-[var(--bg-hover)]">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                                width="24px" fill="currentColor">
                                                <path d="M0 0h24v24H0V0z" fill="none" />
                                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                                            </svg>
                                        </button>

                                        <div id="plus-dropdown"
                                            class="hidden absolute py-2 left-0 bottom-full mb-2 w-48 rounded-lg shadow-lg z-50"
                                            style="background-color: var(--dropdown-bg); color: var(--dropdown-text);">
                                            <button id="trigger-upload"
                                                class="w-full text-left px-4 py-2 flex items-center gap-2 hover:bg-[var(--dropdown-hover)]">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20px"
                                                    viewBox="0 -960 960 960" width="20px" fill="currentColor">
                                                    <path
                                                        d="M696-312q0 89.86-63.07 152.93Q569.86-96 480-96q-91 0-153.5-65.5T264-319v-389q0-65 45.5-110.5T420-864q66 0 111 48t45 115v365q0 40.15-27.93 68.07Q520.15-240 480-240q-41 0-68.5-29.09T384-340v-380h72v384q0 10.4 6.8 17.2 6.8 6.8 17.2 6.8 10.4 0 17.2-6.8 6.8-6.8 6.8-17.2v-372q0-35-24.5-59.5T419.8-792q-35.19 0-59.5 25.5Q336-741 336-706v394q0 60 42 101.5T480-168q60 1 102-43t42-106v-403h72v408Z" />
                                                </svg>
                                                Upload files
                                            </button>
                                            <button
                                                class="w-full text-left px-4 py-2 flex items-center gap-2 hover:bg-[var(--dropdown-hover)]">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20px"
                                                    viewBox="0 -960 960 960" width="20px" fill="currentColor">
                                                    <path
                                                        d="M232-120q-17 0-31.5-8.5t-22.29-22.09L80.79-320.41Q73-334 73-351t8-31l248-427q8-14 22.5-22.5t31.06-8.5h194.88q16.56 0 31.06 8.5t22.42 22.37L811-500q-21-5-42-4.5t-42 4.5L571-768H389L146-351l92 159h337q11 21.17 25.5 39.59Q615-134 634-120H232Zm68-171-27-48 172.95-302H514l110 192q-14.32 13-26.53 28.5T576-388l-96-168-111 194h196q-6 17-9.5 34.7-3.5 17.71-3.5 36.3H300Zm432 147v-108H624v-72h108v-108h72v108h108v72H804v108h-72Z" />
                                                </svg>
                                                Add from Drive
                                            </button>
                                        </div>
                                    </div>

                                    <!-- <div
                                        class="group h-10 rounded-full px-2 py-1 flex items-center font-bold relative hover:bg-[var(--bg-hover)]">
                                        <span class="material-icons-outlined">
                                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 20 20"
                                                height="20px" viewBox="0 0 20 20" width="20px" fill="currentColor">
                                                <rect fill="none" height="20" width="20" />
                                                <path
                                                    d="M17.85,8.5h-1.54c-0.48-2.03-1.93-3.68-3.82-4.48V4.5C12.5,5.33,11.83,6,11,6H9v1c0,0.55-0.45,1-1,1H7v2h1v2H7L3.64,8.64 C3.55,9.08,3.5,9.53,3.5,10c0,3.58,2.92,6.5,6.5,6.5V18c-4.42,0-8-3.58-8-8s3.58-8,8-8C13.91,2,17.15,4.8,17.85,8.5z M18,16.44 l-1.06,1.06l-2.56-2.56c-0.54,0.35-1.19,0.56-1.88,0.56C10.57,15.5,9,13.93,9,12s1.57-3.5,3.5-3.5S16,10.07,16,12 c0,0.69-0.21,1.34-0.56,1.88L18,16.44z M14.5,12c0-1.1-0.9-2-2-2s-2,0.9-2,2s0.9,2,2,2S14.5,13.1,14.5,12z" />
                                            </svg>
                                        </span>
                                        <span class="hidden sm:inline pl-1">Deep Research</span>
                                        <div class="absolute opacity-0 scale-95 group-hover:opacity-100 font-medium group-hover:scale-100 group-hover:translate-y-1 transform transition-all duration-300 top-[90%] text-xs p-2 mt-2 left-1/2 -translate-x-1/2 rounded whitespace-nowrap"
                                            style="background-color: var(--dropdown-text); color: var(--bg-main);">
                                            Get in-depth answers
                                        </div>
                                    </div>

                                    <div
                                        class="group h-10 rounded-full px-2 py-1 flex items-center font-bold relative hover:bg-[var(--bg-hover)]">
                                        <span class="material-icons-outlined">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24"
                                                width="20px" fill="currentColor">
                                                <path d="M0 0h24v24H0V0z" fill="none" />
                                                <path
                                                    d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H8V4h12v12zm-7-2h2v-3h3V9h-3V6h-2v3h-3v2h3z" />
                                            </svg>
                                        </span>
                                        <span class="hidden sm:inline pl-1">Canvas</span>
                                        <div class="absolute opacity-0 scale-95 group-hover:opacity-100 font-medium group-hover:scale-100 group-hover:translate-y-1 transform transition-all duration-300 top-[90%] text-xs p-2 mt-2 left-1/2 -translate-x-1/2 rounded whitespace-nowrap"
                                            style="background-color: var(--dropdown-text); color: var(--bg-main);">
                                            Create docs and apps
                                        </div>
                                    </div> -->
                                </div>

                                <button id="send-button"
                                    class="group h-10 w-10 rounded-full flex items-center justify-center relative overflow-hidden transition-all duration-300 hover:bg-[var(--bg-hover)]">

                                    <span id="mic-icon"
                                        class="absolute transition-all duration-300 ease-in-out opacity-100 scale-100 translate-x-0">

                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                            width="24px" fill="currentColor">
                                            <path
                                                d="M120-160v-640l760 320-760 320Zm80-120 474-200-474-200v140l240 60-240 60v140Zm0 0v-400 400Z" />
                                        </svg>
                                    </span>

                                </button>
                            </div>
                            <input type="file" id="upload-preview-input" accept="image/*" class="hidden" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('frontend/gx_ai/JS/index.js') }}"></script>