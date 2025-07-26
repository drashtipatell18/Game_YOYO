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
                <!-- <h1 class="x_privacy-title mb-0  ">Privacy Policy</h1> -->
                <div class="x_privacy-content bg-opacity-75 p-4 ">
                    @foreach ($privacy as $pri)
                        <h2 class="x_privacy-heading">{{ $pri->title }}</h2>
                        <ul>
                            <li>
                                {{ $pri->description }}
                            </li>
                        </ul>
                    @endforeach
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
