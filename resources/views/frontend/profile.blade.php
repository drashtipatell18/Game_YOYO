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
            <form id="Z_profile_form" action={{ route('profile.update', Auth::id()) }} enctype="multipart/form-data" method="POST">
                @csrf
                <div class="Z_profile_card">
                    <div class="Z_profile_online_status"></div>
                    <div class="row w-100 m-0">
                        <div
                            class="col-12 col-md-4 mx-auto Z_profile_left d-flex flex-column align-items-center justify-content-center">
                            <div class="Z_profile_avatar-wrap">
                                <img src="{{ $user->image ? asset('images/users/' . $user->image) : asset('frontend/images/Profile.jpg') }}"
                                alt="Profile Avatar"
                                class="Z_profile_avatar"
                                id="Z_profile_avatar_preview">

                                <label for="Z_profile_avatar_input" class="Z_profile_avatar_upload_btn">
                                    <i class="fa fa-camera"></i>
                                </label>
                                <input type="file" name="image" id="Z_profile_avatar_input"
                                    class="Z_profile_avatar_input" accept="image/*" style="display:none;">
                            </div>
                            <h2 class="Z_profile_name" id="Z_profile_name_heading">{{ $user->name }}</h2>
                        </div>
                        <div class="col-12 col-md-8 Z_profile_right">
                            <h3 class="Z_profile_section_title">
                                <i class="fas fa-info-circle"></i>
                                Bio & other details
                                <button type="button" class="Z_profile_edit_btn" id="Z_profile_edit_btn"
                                    title="Edit Profile">
                                    <i class="fas fa-pen"></i> Edit
                                </button>
                            </h3>
                            <div class="Z_profile_details_grid" id="Z_profile_details_grid">
                                @csrf
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Username</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_username_view">{{ $user->username }}
                                    </div>
                                    <input type="text" name="username" class="Z_profile_input"
                                        id="Z_profile_username_input" value="{{ $user->username }}" style="display:none;">
                                </div>
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Email</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_email_view">{{ $user->email }}</div>
                                    <input type="email" name="email" class="Z_profile_input" id="Z_profile_email_input"
                                        value="{{ $user->email }}" style="display:none;">
                                </div>
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Mobile Number</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_mobile_view">{{ $user->phone }}</div>
                                    <input type="tel" name="phone" class="Z_profile_input" id="Z_profile_mobile_input"
                                        value="{{ $user->phone }}" style="display:none;">
                                </div>
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Favorite Game</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_game_view">{{ $user->favourite_game }}
                                    </div>
                                    <input type="text" name="favourite_game" class="Z_profile_input"
                                        id="Z_profile_game_input" value="{{ $user->favourite_game }}"
                                        style="display:none;">
                                </div>
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Gaming Platform</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_platform_view">
                                        {{ $user->gaming_platform }}</div>
                                    <input type="text" name="gaming_platform" class="Z_profile_input"
                                        id="Z_profile_platform_input" value="{{ $user->gaming_platform }}"
                                        style="display:none;">
                                </div>
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Country/Region</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_country_view">{{ $user->country }}
                                    </div>
                                    <input type="text" name="country" class="Z_profile_input"
                                        id="Z_profile_country_input" value="{{ $user->country }}" style="display:none;">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center" id="Z_profile_edit_actions" style="display:none;">
                                <button type="submit" class="Z_profile_btn_save" id="Z_profile_btn_save">Save</button>
                                <button type="button" class="Z_profile_btn_cancel me-0"
                                    id="Z_profile_btn_cancel">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
