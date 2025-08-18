@extends('gx_ai.layouts.main')
@section('content')
        <div class="gemini-data ">
            <div class="main-chat-area">
                <div class="chat-content-wrapper" style="background-color: var(--bg-main);">
                    <!-- Profile Tooltip -->
                    <div class="absolute top-6 right-6 group">

                        <div
                            class="absolute right-0 mt-2 p-2 rounded-md bg-[var(--tooltip-bg)] text-[var(--tooltip-text)] text-sm shadow-lg opacity-0 group-hover:opacity-100 transition duration-200 z-10">
                            <div class="font-semibold">Google Account</div>
                            <div>denish.kalathiyainfotech</div>
                            <div>denish.info@yoyokhel.com</div>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <main class="text-center px-4 pt-40">
                        <h1 class="text-3xl md:text-4xl font-medium mb-4">Your public links</h1>
                        <p class=" mb-6 w-[36rem] mx-auto">
                            You can share chats or an individual prompt & response. Once you do, you can manage
                            public
                            links that you've
                            created and see their details here.
                        </p>
                        <a href="{{ route('yin.index') }}"
                            class="bg-[#0b57d0] hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-full transition">
                            Chat with YOYO
                        </a>
                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection