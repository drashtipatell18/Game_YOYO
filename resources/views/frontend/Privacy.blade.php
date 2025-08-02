@extends('frontend.layouts.main')
@section('content')
    <section class="xs_contact-hero-section">
        <div class="xs_contact-hero-overlay">
            <div class="container text-center py-5">
                <h1 class="contact-hero-title">Privacy Policy</h1>
                <nav class="breadcrumb-nav">
                    <span>Home</span> <span class="mx-2">/</span> <span class="active">Privacy Policy</span>
                </nav>
            </div>
        </div>
    </section>

    <!-- x_game-product-section START -->
  <section class="x_privacy a_header_container">
    <div>
        <div class="x_space">
            <div class="x_privacy-content bg-opacity-75 p-4">
                <h1 class="x_privacy-title mb-0">Privacy Policy</h1>
                <p>Effective Date: August 2, 2025</p>

                <p>Thank you for visiting our website. This Privacy Policy explains how we collect, use, and protect your personal information when you use our eCommerce platform.</p>

                <h4>1. Information We Collect</h4>
                <p>We collect personal information when you:</p>
                <ul>
                    <li>Create an account or make a purchase</li>
                    <li>Subscribe to our newsletter</li>
                    <li>Contact our customer support</li>
                    <li>Browse our website (via cookies and analytics tools)</li>
                </ul>
                <p>The data collected may include your name, email address, shipping address, phone number, payment details (handled securely), and IP address.</p>

                <h4>2. How We Use Your Information</h4>
                <p>We use your information to:</p>
                <ul>
                    <li>Process transactions and deliver orders</li>
                    <li>Provide customer support</li>
                    <li>Send updates, promotions, and service-related emails</li>
                    <li>Improve our website and services</li>
                </ul>

                <h4>3. Sharing Your Information</h4>
                <p>We do not sell your personal data. We may share it with trusted third parties only to the extent necessary to operate our business, such as:</p>
                <ul>
                    <li>Payment processors</li>
                    <li>Shipping carriers</li>
                    <li>Marketing and analytics providers</li>
                </ul>

                <h4>4. Cookies & Tracking</h4>
                <p>We use cookies to personalize your experience and analyze site traffic. You can control cookie preferences through your browser settings.</p>

                <h4>5. Data Security</h4>
                <p>We implement strong security measures to protect your data. However, no online system is 100% secure, so we recommend using strong passwords and monitoring your account activity.</p>

                <h4>6. Your Rights</h4>
                <p>You have the right to access, update, or delete your personal data. To make such a request, please contact us at <a href="mailto:support@yourstore.com">support@yourstore.com</a>.</p>

                <h4>7. Changes to This Policy</h4>
                <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with a new effective date.</p>

                <p>If you have questions or concerns about this Privacy Policy, please contact us.</p>
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
