@extends('frontend.layouts.main')
@section('content')
    <section class="xs_contact-hero-section">
        <div class="xs_contact-hero-overlay">
            <div class="container text-center py-5">
                <h1 class="contact-hero-title">Terms Conditions</h1>
                <nav class="breadcrumb-nav">
                    <span>Home</span> <span class="mx-2">/</span> <span class="active">Terms Conditions</span>
                </nav>
            </div>
        </div>
    </section>

    <!-- x_game-product-section START -->
    <section class="x_privacy a_header_container">
    <div>
        <div class="x_space">
            <!-- <h1 class="x_privacy-title mb-0">Terms and Conditions</h1> -->
            <div class="x_privacy-content bg-opacity-75 p-4">
                <ul class="list-unstyled">
                    <li><strong>Agreement to Terms:</strong>
                        <ul>
                            <li>By visiting or using the YoYo Game website, you acknowledge and agree to comply with these Terms and Conditions.</li>
                            <li>If you do not agree with any part of these terms, please do not use our services.</li>
                        </ul>
                    </li>

                    <li><strong>User Eligibility:</strong>
                        <ul>
                            <li>To use our services, you must be at least 13 years old.</li>
                            <li>Users under the age of 18 should review these terms with a parent or guardian before creating an account.</li>
                        </ul>
                    </li>

                    <li><strong>Account Responsibility:</strong>
                        <ul>
                            <li>When signing up, you must provide true and up-to-date information.</li>
                            <li>Keep your username and password private to prevent unauthorized access.</li>
                            <li>You are fully responsible for all actions taken through your account.</li>
                        </ul>
                    </li>

                    <li><strong>Acceptable Use Policy:</strong>
                        <ul>
                            <li>Do not engage in cheating, hacking, or using unauthorized tools that give unfair advantages.</li>
                            <li>Treat others respectfully—any form of bullying, offensive language, or harassment is strictly prohibited.</li>
                            <li>Avoid sharing or uploading harmful content such as malware or viruses.</li>
                        </ul>
                    </li>

                    <li><strong>Gameplay Integrity:</strong>
                        <ul>
                            <li>Always play by the rules of each game featured on our platform.</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection
@push('script')
    <script>
        const dbUserIcon = document.getElementById('db_user_icon');
        const dbUserDropdown = document.getElementById('db_user_dropdown');

        dbUserIcon.addEventListener('click', (e) => {
            e.stopPropagation();
            dbUserDropdown.style.display = dbUserDropdown.style.display === 'block' ? 'none' : 'block';
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            dbUserDropdown.style.display = 'none';
        });
    </script>
@endpush
