@extends('frontend.layouts.main')
@section('content')
    <section class="xs_contact-hero-section">
        <div class="xs_contact-hero-overlay">
            <div class="container text-center py-5">
                <h1 class="contact-hero-title">Cancel Refund</h1>
                <nav class="breadcrumb-nav">
                    <a href="{{ route('index') }}" class="text-decoration-none text-white">
                        <span>Home</span>
                    </a> <span class="mx-2">/</span> <span class="active">Cancel Refund</span>
                </nav>
            </div>
        </div>
    </section>

    <!-- x_game-product-section START -->
    <section class="x_privacy a_header_container">
        <div>
            <div class="x_space">
                <!-- <h1 class="x_privacy-title mb-0  ">Privacy Policy</h1> -->
                <div class="x_privacy-content bg-opacity-75 p-4 ">
                        <p>At YOYO Khel, we want you to be completely satisfied with your purchase. If you wish to cancel an order, please contact us as soon as possible. Orders can only be canceled before they have been shipped. Once the order has been dispatched, cancellation is no longer possible. Refunds are available for eligible returns or issues with your order. If you receive a damaged or incorrect item, please notify us within 7 days of delivery, and we will work with you to resolve the issue, which may include a replacement or a refund. Refunds are processed once we receive the returned item, and the amount will be credited using the original payment method. Please note that shipping costs are generally non-refundable unless the return is due to an error on our part. For digital products or game downloads, cancellations and refunds are subject to specific terms and are generally not available once the product has been accessed or downloaded. If you have any questions regarding cancellations or refunds, please contact our customer support team.</p>
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
