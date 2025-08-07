@extends('frontend.layouts.main')
@section('content')
    <style>
        .invalid-feedback {
            color: red;
            font-size: 0.875em;
            display: block;
            margin-top: 0.25rem;
        }

        .is-invalid {
            border-color: red;
        }

        .is-valid {
            border-color: green;
        }

        .Z_profile_input {
            width: 100%;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }
    </style>
    <!-- Hero Section Start -->
    <div class="Z_profile_hero">
        <div class="Z_cart_hero-overlay">
            <h1 class="Z_about_title">Profile</h1>
        </div>
    </div>
    <section class="Z_profile_page">
        <div class="Z_profile_container">
            <form id="Z_profile_form" action={{ route('profile.update', Auth::id()) }} enctype="multipart/form-data"
                method="POST" novalidate>
                @csrf
                <div class="Z_profile_card">
                    <div class="Z_profile_online_status"></div>
                    <div class="row w-100 m-0">
                        <div
                            class="col-12 col-md-4 mx-auto Z_profile_left d-flex flex-column align-items-center justify-content-center">
                            <div class="Z_profile_avatar-wrap">
                                <img src="{{ $user->image ? asset('images/users/' . $user->image) : asset('frontend/images/Profile.jpg') }}"
                                    alt="Profile Avatar" class="Z_profile_avatar" id="Z_profile_avatar_preview">

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
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Username</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_username_view">{{ $user->username }}
                                    </div>
                                    <input type="text" name="username" class="Z_profile_input"
                                        id="Z_profile_username_input" value="{{ $user->username }}"
                                        style="display:none;" required minlength="3" maxlength="20">
                                    <div class="invalid-feedback" id="username-error"></div>
                                </div>
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Email</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_email_view">{{ $user->email }}</div>
                                    <input type="email" name="email" class="Z_profile_input" id="Z_profile_email_input"
                                        value="{{ $user->email }}" style="display:none;" required>
                                    <div class="invalid-feedback" id="email-error"></div>
                                </div>
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Mobile Number</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_mobile_view">{{ $user->phone }}</div>
                                    <input type="tel" name="phone" class="Z_profile_input" id="Z_profile_mobile_input"
                                        value="{{ $user->phone }}" style="display:none;"
                                        required pattern="[0-9]{10}" minlength="10" maxlength="10">
                                    <div class="invalid-feedback" id="phone-error"></div>
                                </div>
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Favorite Game</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_game_view">{{ $user->favourite_game }}
                                    </div>
                                    <input type="text" name="favourite_game" class="Z_profile_input"
                                        id="Z_profile_game_input" value="{{ $user->favourite_game }}"
                                        style="display:none;" required minlength="2" maxlength="50">
                                    <div class="invalid-feedback" id="favourite_game-error"></div>
                                </div>
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Gaming Platform</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_platform_view">
                                        {{ $user->gaming_platform }}</div>
                                    <input type="text" name="gaming_platform" class="Z_profile_input"
                                        id="Z_profile_platform_input" value="{{ $user->gaming_platform }}"
                                        style="display:none;" required>
                                    <div class="invalid-feedback" id="gaming_platform-error"></div>
                                </div>
                                <div class="Z_profile_detail_item">
                                    <div class="Z_profile_detail_label">Country/Region</div>
                                    <div class="Z_profile_detail_value" id="Z_profile_country_view">{{ $user->country }}
                                    </div>
                                    <input type="text" name="country" class="Z_profile_input"
                                        id="Z_profile_country_input" value="{{ $user->country }}"
                                        style="display:none;" required>
                                    <div class="invalid-feedback" id="country-error"></div>
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
        // Vanilla JavaScript Form Validation
        class ProfileFormValidator {
            constructor(formId) {
                this.form = document.getElementById(formId);
                this.errors = {};
                this.rules = {
                    username: {
                        required: true,
                        minlength: 3,
                        maxlength: 20,
                        messages: {
                            required: "Username is required",
                            minlength: "Username must be at least 3 characters",
                            maxlength: "Username must be no more than 20 characters"
                        }
                    },
                    email: {
                        required: true,
                        email: true,
                        messages: {
                            required: "Email is required",
                            email: "Please enter a valid email address"
                        }
                    },
                    phone: {
                        required: true,
                        pattern: /^[0-9]{10}$/,
                        messages: {
                            required: "Mobile number is required",
                            pattern: "Mobile number must be exactly 10 digits"
                        }
                    },
                    favourite_game: {
                        required: true,
                        minlength: 2,
                        maxlength: 50,
                        messages: {
                            required: "Favorite game is required",
                            minlength: "Must be at least 2 characters",
                            maxlength: "Must be no more than 50 characters"
                        }
                    },
                    gaming_platform: {
                        required: true,
                        messages: {
                            required: "Gaming platform is required"
                        }
                    },
                    country: {
                        required: true,
                        messages: {
                            required: "Country or region is required"
                        }
                    }
                };

                this.init();
            }

            init() {
                // Add real-time validation
                Object.keys(this.rules).forEach(fieldName => {
                    const field = this.form.querySelector(`[name="${fieldName}"]`);
                    if (field) {
                        field.addEventListener('blur', () => this.validateField(fieldName));
                        field.addEventListener('input', () => this.clearFieldError(fieldName));
                    }
                });

                // Add form submit validation
                this.form.addEventListener('submit', (e) => this.handleSubmit(e));
            }

            validateField(fieldName) {
                const field = this.form.querySelector(`[name="${fieldName}"]`);
                const rule = this.rules[fieldName];
                const value = field.value.trim();

                // Skip validation if field is hidden (not in edit mode)
                if (field.style.display === 'none') {
                    return true;
                }

                let isValid = true;
                let errorMessage = '';

                // Required validation
                if (rule.required && !value) {
                    isValid = false;
                    errorMessage = rule.messages.required;
                }
                // Email validation
                else if (rule.email && value) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(value)) {
                        isValid = false;
                        errorMessage = rule.messages.email;
                    }
                }
                // Pattern validation (for phone)
                else if (rule.pattern && value) {
                    if (!rule.pattern.test(value)) {
                        isValid = false;
                        errorMessage = rule.messages.pattern;
                    }
                }
                // Length validation
                else if (value) {
                    if (rule.minlength && value.length < rule.minlength) {
                        isValid = false;
                        errorMessage = rule.messages.minlength;
                    } else if (rule.maxlength && value.length > rule.maxlength) {
                        isValid = false;
                        errorMessage = rule.messages.maxlength;
                    }
                }

                this.displayFieldError(fieldName, isValid, errorMessage);
                return isValid;
            }

            validateForm() {
                let isFormValid = true;
                this.errors = {};

                Object.keys(this.rules).forEach(fieldName => {
                    const fieldValid = this.validateField(fieldName);
                    if (!fieldValid) {
                        isFormValid = false;
                    }
                });

                return isFormValid;
            }

            displayFieldError(fieldName, isValid, errorMessage) {
                const field = this.form.querySelector(`[name="${fieldName}"]`);
                const errorDiv = document.getElementById(`${fieldName}-error`);

                if (isValid) {
                    field.classList.remove('is-invalid');
                    field.classList.add('is-valid');
                    if (errorDiv) {
                        errorDiv.textContent = '';
                        errorDiv.style.display = 'none';
                    }
                } else {
                    field.classList.remove('is-valid');
                    field.classList.add('is-invalid');
                    if (errorDiv) {
                        errorDiv.textContent = errorMessage;
                        errorDiv.style.display = 'block';
                    }
                }
            }

            clearFieldError(fieldName) {
                const field = this.form.querySelector(`[name="${fieldName}"]`);
                const errorDiv = document.getElementById(`${fieldName}-error`);

                field.classList.remove('is-invalid');
                if (errorDiv) {
                    errorDiv.textContent = '';
                    errorDiv.style.display = 'none';
                }
            }

            clearAllErrors() {
                Object.keys(this.rules).forEach(fieldName => {
                    this.clearFieldError(fieldName);
                    const field = this.form.querySelector(`[name="${fieldName}"]`);
                    field.classList.remove('is-valid', 'is-invalid');
                });
            }

            handleSubmit(e) {
                e.preventDefault();

                if (this.validateForm()) {
                    const submitBtn = this.form.querySelector('button[type="submit"]');
                    const originalText = submitBtn.textContent;

                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Processing...';

                    // Submit the form
                    this.form.submit();
                } else {
                    // Focus on first invalid field
                    const firstInvalidField = this.form.querySelector('.is-invalid');
                    if (firstInvalidField) {
                        firstInvalidField.focus();
                    }
                }
            }
        }

        // Initialize validation when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize form validator
            const validator = new ProfileFormValidator('Z_profile_form');

            // Helper: Get user_id from localStorage (if using API)
            const userId = localStorage.getItem('user_id');
            let userData = null;

            // Field mapping for API
            const profileFields = [
                {
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
                    const viewEl = document.getElementById(f.view);
                    const inputEl = document.getElementById(f.input);

                    if (viewEl) viewEl.style.display = editing ? 'none' : 'block';
                    if (inputEl) inputEl.style.display = editing ? 'block' : 'none';
                });

                document.getElementById('Z_profile_edit_actions').style.display = editing ? 'flex' : 'none';
                editBtn.style.display = editing ? 'none' : 'inline-block';

                // Clear validation errors when switching modes
                if (!editing) {
                    validator.clearAllErrors();
                }
            }

            // Event handlers
            editBtn.addEventListener('click', () => setEditMode(true));

            cancelBtn.addEventListener('click', () => {
                setEditMode(false);
                // Reset form values to original if needed
                // loadProfileFromAPI();
            });

            // Initialize
            setEditMode(false);
        });
    </script>
@endpush
