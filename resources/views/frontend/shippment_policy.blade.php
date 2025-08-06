@extends('frontend.layouts.main')

@section('content')
<section class="xs_contact-hero-section">
    <div class="xs_contact-hero-overlay">
        <div class="container text-center py-5">
            <h1 class="contact-hero-title">Shipping Policy</h1>
            <nav class="breadcrumb-nav">
                <span>Home</span> <span class="mx-2">/</span> <span class="active">Shipping Policy</span>
            </nav>
        </div>
    </div>
</section>

<section class="x_privacy a_header_container">
    <div>
        <div class="x_space">
            <div class="x_privacy-content bg-opacity-75 p-4">
                <p>
                    At YOYO Khel, we strive to deliver your orders promptly and securely. Once your payment is confirmed, we process orders within 1 to 3 business days. Orders placed on weekends or public holidays will be processed on the next business day. After your order is shipped, we will send you a confirmation email along with tracking information, if available. We offer several shipping options at checkout, with delivery times depending on your location and chosen method. For domestic shipments within [Your Country], you can expect delivery within 3 to 7 business days. For international orders, delivery usually takes between 7 to 21 business days, although this may vary due to customs processing or other unforeseen delays. Shipping costs are calculated during checkout based on your location and order details. Occasionally, we may offer free shipping promotions, so keep an eye out for special offers on our website. Please note that for international shipments, any customs duties or taxes imposed by your country are your responsibility and are not included in the shipping fees. To avoid delays or lost packages, please ensure that you provide a complete and accurate shipping address at the time of purchase. If your order arrives damaged or doesn’t arrive within the expected timeframe, please contact us
                </p>

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

        document.addEventListener('click', () => {
            dbUserDropdown.style.display = 'none';
        });
    </script>
@endpush
