@extends('frontend.layouts.main')
@section('content')
        <!-- Hero Section Start -->
        <div class="Z_profile_hero">
            <div class="Z_cart_hero-overlay">
                <h1 class="Z_about_title">Profile</h1>
            </div>
        </div>

        <section class="Z_profile_page">
            <div class="Z_profile_container">
                <div class="Z_profile_card">
                    <div class="Z_profile_online_status"></div>

                    <div class="row w-100 m-0">
                        <div
                            class="col-12 col-md-4 mx-auto Z_profile_left d-flex flex-column align-items-center justify-content-center">
                            <div class="Z_profile_avatar-wrap">
                                <img src="{{ asset('frontend/images/Profile.jpg')}}" alt="Profile Avatar" class="Z_profile_avatar"
                                    id="Z_profile_avatar_preview">
                                <label for="Z_profile_avatar_input" class="Z_profile_avatar_upload_btn">
                                    <i class="fa fa-camera"></i>
                                </label>
                                <input type="file" id="Z_profile_avatar_input" class="Z_profile_avatar_input"
                                    accept="image/*" style="display:none;">
                            </div>
                            <h2 class="Z_profile_name" id="Z_profile_name_heading">Maria Fernanda</h2>
                        </div>

                        <div class="col-12 col-md-8 Z_profile_right">
                            <h3 class="Z_profile_section_title">
                                <i class="fas fa-info-circle"></i>
                                Bio & other details
                                <button class="Z_profile_edit_btn" title="Edit Profile"><i
                                        class="fas fa-pen"></i>Edit</button>
                            </h3>

                            <div class="Z_profile_details_grid" id="Z_profile_details_grid">
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Username</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_username_view">gamer_fernanda</div>
                                    <input type="text" class="Z_profile_input" id="Z_profile_username_input"
                                        value="gamer_fernanda" style="display:none;">
                                </div>
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Email</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_email_view">maria.fernanda@email.com
                                    </div>
                                    <input type="email" class="Z_profile_input" id="Z_profile_email_input"
                                        value="maria.fernanda@email.com" style="display:none;">
                                </div>
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Mobile Number</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_mobile_view">+1 555-123-4567</div>
                                    <input type="tel" class="Z_profile_input" id="Z_profile_mobile_input"
                                        value="+1 555-123-4567" style="display:none;">
                                </div>
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Favorite Game</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_game_view">Valorant</div>
                                    <input type="text" class="Z_profile_input" id="Z_profile_game_input" value="Valorant"
                                        style="display:none;">
                                </div>
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Gaming Platform</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_platform_view">PC</div>
                                    <input type="text" class="Z_profile_input" id="Z_profile_platform_input"
                                        value="PC" style="display:none;">
                                </div>
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Country/Region</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_country_view">USA</div>
                                    <input type="text" class="Z_profile_input" id="Z_profile_country_input"
                                        value="USA" style="display:none;">
                                </div>
                                <!-- Add more fields as needed -->
                            </div>
                            <div class="d-flex justify-content-center" id="Z_profile_edit_actions" style="display:none;">
                                <button class="Z_profile_btn_save" id="Z_profile_btn_save">Save</button>
                                <button class="Z_profile_btn_cancel me-0" id="Z_profile_btn_cancel">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
 @endsection

    @push('script')
        <script>
            // Helper: Get user_id from localStorage
            const userId = localStorage.getItem('user_id');
            let userData = null;

            // Field mapping for API
            const profileFields = [{
                    key: 'name',
                    view: 'Z_profile_username_view',
                    input: 'Z_profile_username_input',
                    heading: 'Z_profile_name_heading'
                },
                {
                    key: 'email',
                    view: 'Z_profile_email_view',
                    input: 'Z_profile_email_input'
                },
                {
                    key: 'mobile',
                    view: 'Z_profile_mobile_view',
                    input: 'Z_profile_mobile_input'
                },
                {
                    key: 'game',
                    view: 'Z_profile_game_view',
                    input: 'Z_profile_game_input'
                },
                {
                    key: 'platform',
                    view: 'Z_profile_platform_view',
                    input: 'Z_profile_platform_input'
                },
                {
                    key: 'country',
                    view: 'Z_profile_country_view',
                    input: 'Z_profile_country_input'
                },
            ];

            // Load user data from API
            async function loadProfileFromAPI() {
                // if (!userId) {
                //     alert('No user logged in.');
                //     return;
                // }
                try {
                    const res = await fetch(`http://localhost:4000/users/${userId}`);
                    if (!res.ok) throw new Error('User not found');
                    userData = await res.json();
                    // Fill fields
                    profileFields.forEach(f => {
                        const value = userData[f.key] || '';
                        document.getElementById(f.view).textContent = value;
                        document.getElementById(f.input).value = value;
                        if (f.heading) {
                            document.getElementById(f.heading).textContent = value;
                        }
                    });
                    // Avatar
                    if (userData.avatar) {
                        document.getElementById('Z_profile_avatar_preview').src = userData.avatar;
                    }
                } catch (e) {
                    alert('Failed to load user profile.');
                }
            }

            // Save to API
            async function saveProfileToAPI() {
                if (!userData) return;
                // Update userData with new values
                profileFields.forEach(f => {
                    userData[f.key] = document.getElementById(f.input).value;
                });
                // Avatar
                userData.avatar = document.getElementById('Z_profile_avatar_preview').src;
                // PUT to API
                const res = await fetch(`http://localhost:4000/users/${userId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(userData)
                });
                if (res.ok) {
                    // alert('Profile updated!');
                    setEditMode(false);
                    loadProfileFromAPI();
                } else {
                    alert('Failed to update profile.');
                }
            }

            // Avatar upload
            document.getElementById('Z_profile_avatar_input').addEventListener('change', function(event) {
                const [file] = event.target.files;
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const base64 = e.target.result;
                        document.getElementById('Z_profile_avatar_preview').src = base64;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Edit/save/cancel logic
            const editBtn = document.querySelector('.Z_profile_edit_btn');
            const saveBtn = document.getElementById('Z_profile_btn_save');
            const cancelBtn = document.getElementById('Z_profile_btn_cancel');

            function setEditMode(editing) {
                profileFields.forEach(f => {
                    document.getElementById(f.view).style.display = editing ? 'none' : '';
                    document.getElementById(f.input).style.display = editing ? '' : 'none';
                });
                document.getElementById('Z_profile_edit_actions').style.display = editing ? '' : 'none';
                editBtn.style.display = editing ? 'none' : '';
            }
            editBtn.addEventListener('click', () => setEditMode(true));
            cancelBtn.addEventListener('click', () => {
                setEditMode(false);
                loadProfileFromAPI();
            });
            saveBtn.addEventListener('click', saveProfileToAPI);

            // On page load
            loadProfileFromAPI();
            setEditMode(false);
        </script>


      
    @endpush
