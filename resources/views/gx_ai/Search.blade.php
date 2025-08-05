@extends('gx_ai.layouts.main')
@section('content')
    <style>
        :root {
            --bg-main: #ffffff;
            --bg-hover: #f5f5f5;
            --text-main: #1f1f1f;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --card-bg: #f4f4f5;
        }

        body.dark {
            --bg-main: #1b1c1d;
            --bg-hover: #2e2e2e;
            --text-main: #e0e0e0;
            --text-muted: #a0a0a0;
            --border-color: #444444;
            --card-bg: #2e2e2e;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            transition: background-color 0.3s, color 0.3s;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
        }

        .search-input {
            background-color: var(--card-bg);
            color: var(--text-main);
            border: 1px solid var(--border-color);
        }

        .search-input::placeholder {
            color: var(--text-muted);
        }

        .chat-item {
            border-bottom: 1px solid var(--border-color);
        }

        .chat-item:hover {
            background-color: var(--bg-hover);
        }

        .hover-bg:hover {
            background-color: var(--bg-hover);
        }

        .chat-date {
            color: var(--text-muted);
            font-size: 0.75rem;
        }

        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
        }

        .chat-item span:first-child {
            font-size: 0.95rem;
        }
    </style>
    
    <body class="min-h-screen flex items-center justify-center transition-colors duration-300">
        <div class="gemini-data ">
            <div class="main-chat-area">
                <div class="chat-content-wrapper contents" style="background-color: var(--bg-main);">
                    <div class="w-full max-w-2xl p-6 mx-auto">

                        <!-- Header -->
                        <h1 class="text-2xl font-semibold mb-6 ml-4">Search</h1>

                        <!-- Search Input -->
                        <div class="relative w-full max-w-xl mx-auto mb-8">
                            <input type="text" placeholder="Search for chats"
                                class="w-full rounded-full py-3 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors search-input"
                                id="searchInput" />
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 text-muted"
                                xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0
        1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11
        0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </div>

                        <!-- Recent Chats -->
                        <div class="max-w-xl mx-auto">
                            <h2 class="text-base font-medium mb-4" id="recentTitle">Recent</h2>
                            <ul id="chatList">
                                <li class="flex justify-between py-4 px-4 rounded cursor-pointer chat-item"
                                    data-chat-id="chat-123456">
                                    <span>HTML and JavaScript Code Request</span>
                                    <span class="chat-date">Today</span>
                                </li>
                                <li class="flex justify-between py-4 px-4 rounded cursor-pointer chat-item"
                                    data-chat-id="chat-123456">
                                    <span>Fix Chat History Duplication Issue</span>
                                    <span class="chat-date">Yesterday</span>
                                </li>
                                <li class="flex justify-between py-4 px-4 rounded cursor-pointer chat-item"
                                    data-chat-id="chat-123456">
                                    <span>Clarification Needed: What's on Your Mind?</span>
                                    <span class="chat-date">Yesterday</span>
                                </li>
                                <li class="flex justify-between py-4 px-4 rounded cursor-pointer chat-item"
                                    data-chat-id="chat-123456">
                                    <span>HTML Code Review and Analysis</span>
                                    <span class="chat-date">Yesterday</span>
                                </li>
                                <li class="flex justify-between py-4 px-4 rounded cursor-pointer chat-item"
                                    data-chat-id="chat-123456">
                                    <span>Webpage Responsiveness: Techniques Explained</span>
                                    <span class="chat-date">Jun 14</span>
                                </li>
                                <li class="flex justify-between py-4 px-4 rounded cursor-pointer chat-item"
                                    data-chat-id="chat-123456">
                                    <span>Unclear Request, Need Clarification</span>
                                    <span class="chat-date">Jun 14</span>
                                </li>
                                <li class="flex justify-between py-4 px-4 rounded cursor-pointer hover-bg"
                                    data-chat-id="chat-123456">
                                    <span>Assistance Offered, Briefly Asked</span>
                                    <span class="chat-date">Jun 12</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
 
    <script>
        // const toggleBtn = document.getElementById('themeToggle');
        const html = document.documentElement;
        const input = document.getElementById('searchInput');
        const chatList = document.getElementById('chatList');
        const sectionTitle = document.getElementById('recentTitle');

        // Format date as "Today", "Yesterday", or "MMM DD"
        function formatChatDate(timestamp) {
            const now = new Date();
            const date = new Date(timestamp);
            const diffDays = Math.floor((now - date) / (1000 * 60 * 60 * 24));

            if (diffDays === 0) {
                return 'Today';
            } else if (diffDays === 1) {
                return 'Yesterday';
            } else {
                return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
            }
        }

        // Load and render chat history from localStorage
        function renderChatHistory() {
            const chatData = JSON.parse(localStorage.getItem('chatData')) || { chats: [] };

            // Sort chats by timestamp (newest first)
            const sortedChats = [...chatData.chats].sort((a, b) => b.timestamp - a.timestamp);

            // Clear existing list
            chatList.innerHTML = '';

            // Add each chat to the list
            sortedChats.forEach(chat => {
                const li = document.createElement('li');
                li.className = 'flex justify-between py-4 px-4 rounded cursor-pointer chat-item';
                li.dataset.chatId = chat.id;

                li.innerHTML = `
            <span>${chat.title || 'Untitled Chat'}</span>
            <span class="chat-date">${formatChatDate(chat.timestamp)}</span>
        `;

                // In Search.html
                li.addEventListener('click', function () {
                    // Clear any previous flags
                    localStorage.removeItem('chatToOpen');
                    localStorage.removeItem('specificChatToOpen');

                    // Set flags for the specific chat
                    localStorage.setItem('specificChatToOpen', chat.id);
                    localStorage.setItem('animateHistory', 'true'); // New flag for history animation

                    // Navigate to chat page
                    window.location.href = 'Gemini.html';
                });

                chatList.appendChild(li);
            });
        }

        renderChatHistory();

        // Filter chat list based on input
        input.addEventListener('input', () => {
            const query = input.value.toLowerCase().trim();
            let anyVisible = false;

            [...chatList.children].forEach(item => {
                const text = item.querySelector('span:first-child').textContent.toLowerCase();
                const match = text.includes(query);
                item.style.display = match ? 'flex' : 'none';
                if (match) anyVisible = true;
            });

            sectionTitle.style.display = query.length > 0 && !anyVisible ? 'none' : '';
        });

        document.addEventListener('DOMContentLoaded', function () {
            const chatData = JSON.parse(localStorage.getItem('chatData')) || { chats: [] };
            const chatList = document.getElementById('chatList');

            // Clear existing items
            chatList.innerHTML = '';

            // Add each chat to the list
            chatData.chats.forEach(chat => {
                const li = document.createElement('li');
                li.className = 'flex justify-between py-4 px-4 rounded cursor-pointer chat-item';
                li.dataset.chatId = chat.id;

                li.innerHTML = `
            <span>${chat.title || 'Untitled Chat'}</span>
            <span class="chat-date">${formatChatDate(chat.timestamp)}</span>
        `;

                // In Search.html
                li.addEventListener('click', function () {
                    // Clear any previous flags
                    localStorage.removeItem('chatToOpen');
                    localStorage.removeItem('specificChatToOpen');

                    // Set flags for the specific chat
                    localStorage.setItem('specificChatToOpen', chat.id);
                    localStorage.setItem('animateHistory', 'true'); // New flag for history animation

                    // Navigate to chat page
                    window.location.href = 'Gemini.html';
                });

                chatList.appendChild(li);
            });

            function formatChatDate(timestamp) {
                const date = new Date(timestamp);
                const now = new Date();
                const diffDays = Math.floor((now - date) / (1000 * 60 * 60 * 24));

                if (diffDays === 0) return 'Today';
                if (diffDays === 1) return 'Yesterday';
                return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
            }
        });
    </script>
@endsection