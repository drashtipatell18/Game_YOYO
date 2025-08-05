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
</head>
<body>

    
    
</body>
    <script src="{{ asset('frontend/gx_ai/JS/index.js') }}"></script>
    <script src="{{ asset('frontend/gx_ai/JS/Gemini.js') }}"></script>
    <script src="{{ asset('frontend/gx_ai/JS/SavedInfo.js') }}"></script>
    <script src="{{ asset('frontend/gx_ai/JS/NewGem.js') }}"></script>
   
    
    <script>
        const feedback_message = document.getElementById("feedback_message");
        const sendBtn = document.getElementById("sendBtn");
        const feedback_close = document.getElementById("feedback_close");
        const feedback_open = document.getElementById("feedback_open");
        const feedback_data = document.getElementById("feedback-data");

        feedback_open.addEventListener('click', () =>
            feedback_data.classList.remove('hidden')
        );
        feedback_close.addEventListener('click', () =>
            feedback_data.classList.add('hidden')
        );

        feedback_message.addEventListener("input", function () {
            if (feedback_message.value.trim().length > 0) {
                sendBtn.disabled = false;
                sendBtn.classList.remove("bg-[#373737]", "text-white");
                sendBtn.classList.add("bg-[#7CACF8]", "text-[#062E6F]");
            } else {
                sendBtn.disabled = true;
                sendBtn.classList.remove("bg-[#7CACF8]", "text-[#062E6F]");
                sendBtn.classList.add("bg-[#373737]", "text-white");
            }
        });
    </script>
    <!---------------------------------------------->


    <!-- -----------Profile JS---------------- -->

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
                       <div class="flex items-center relative px-4 pt-5 pb-2">
                            <div class="flex-1 text-center text-sm font-medium truncate px-2 max-w-[90%]"
                                style="color: var(--dropdown-text); ">
                                ${accountData.email}
                            </div>
                            <button id="profile-close"
                                class="text-lg absolute top-[14px] right-[6px] hover:bg-[var(--sidebar-hover)] w-[36px] h-[36px] rounded-full font-medium text-[var(--text-muted)]">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
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


        }
        //  else {

        //     document.getElementById('account').innerHTML = `
        // <button 
        //     class="bg-[--add-btn] text-[--add-btn-text] font-bold py-2 px-4 rounded-lg" 
        //     onclick="handleRedirectLogin()">
        //     Login
        // </button>`;

        // }

     function handleRedirectLogin() {
    window.location.href = '/yin/login?add=true';  // matches the Laravel route
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
</html>
