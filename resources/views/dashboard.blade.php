@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

<style>
    :root {
        --primary-brown: #8B7355;
        --secondary-brown: #A0956B;
        --light-brown: #B8A082;
        --dark-brown: #6B5B47;
        --cream: #F5F2ED;
        --warm-white: #FEFCF8;

        --primary-gradient: linear-gradient(135deg, #8B7355 0%, #A0956B 100%);
        --secondary-gradient: linear-gradient(135deg, #A0956B 0%, #B8A082 100%);
        --accent-gradient: linear-gradient(135deg, #B8A082 0%, #D4C4A8 100%);

        --card-shadow: 0 10px 30px rgba(139, 115, 85, 0.15);
        --card-hover-shadow: 0 20px 40px rgba(139, 115, 85, 0.25);
    }

    body {
        background: linear-gradient(135deg, #F5F2ED 0%, #E8E2D5 100%);
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .dashboard-container {
        padding: 2rem 0;
        min-height: 100vh;
    }

    .dashboard-header {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
    }

    .dashboard-title {
        font-size: 3rem;
        font-weight: 800;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
        letter-spacing: -0.02em;
    }

    .dashboard-subtitle {
        color: var(--dark-brown);
        font-size: 1.1rem;
        font-weight: 500;
        opacity: 0.8;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .stat-card {
        background: var(--warm-white);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(139, 115, 85, 0.1);
        border-radius: 24px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: var(--card-shadow);
    }

    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--card-hover-shadow);
        background: #FFFFFF;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient);
    }

    .stat-card.users::before {
        background: var(--primary-gradient);
    }

    .stat-card.blogs::before {
        background: var(--secondary-gradient);
    }

    .stat-card.services::before {
        background: var(--accent-gradient);
    }

    .stat-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
        background: rgba(139, 115, 85, 0.05);
    }

    .stat-icon::before {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--gradient);
        opacity: 0.1;
        border-radius: 20px;
    }

    .stat-icon i {
        font-size: 2.5rem;
        color: var(--icon-color);
        z-index: 1;
        position: relative;
    }

    .users .stat-icon {
        --gradient: var(--primary-gradient);
    }

    .users .stat-icon i {
        --icon-color: var(--primary-brown);
    }

    .blogs .stat-icon {
        --gradient: var(--secondary-gradient);
    }

    .blogs .stat-icon i {
        --icon-color: var(--secondary-brown);
    }

    .services .stat-icon {
        --gradient: var(--accent-gradient);
    }

    .services .stat-icon i {
        --icon-color: var(--light-brown);
    }

    .stat-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark-brown);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        opacity: 0.8;
    }

    .stat-number {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 1rem;
        color: var(--number-color);
    }

    .users .stat-number {
        --number-color: var(--primary-brown);
    }

    .blogs .stat-number {
        --number-color: var(--secondary-brown);
    }

    .services .stat-number {
        --number-color: var(--light-brown);
    }

    .stat-description {
        color: var(--dark-brown);
        font-size: 0.9rem;
        font-weight: 500;
        opacity: 0.7;
    }

    .floating-shapes {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
        overflow: hidden;
    }

    .shape {
        position: absolute;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(139, 115, 85, 0.08), rgba(160, 149, 107, 0.05));
        animation: float 20s infinite linear;
    }

    .shape:nth-child(1) {
        width: 100px;
        height: 100px;
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape:nth-child(2) {
        width: 150px;
        height: 150px;
        top: 60%;
        right: 10%;
        animation-delay: -5s;
    }

    .shape:nth-child(3) {
        width: 80px;
        height: 80px;
        bottom: 20%;
        left: 20%;
        animation-delay: -10s;
    }

    .shape:nth-child(4) {
        width: 120px;
        height: 120px;
        top: 10%;
        right: 30%;
        animation-delay: -15s;
        background: radial-gradient(circle, rgba(184, 160, 130, 0.06), rgba(212, 196, 168, 0.03));
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        33% {
            transform: translateY(-20px) rotate(120deg);
        }
        66% {
            transform: translateY(10px) rotate(240deg);
        }
    }

    .pulse-animation {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.85;
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .dashboard-title {
            font-size: 2.5rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
            padding: 0 1rem;
        }

        .stat-card {
            padding: 1.5rem;
        }

        .stat-number {
            font-size: 2.5rem;
        }
    }

    /* Custom toastr styling to match brown theme */


    .toast-error {
        background: linear-gradient(135deg, #C4927A 0%, #B8704F 100%) !important;
        color: white !important;
    }

    .toast-info {
        background: var(--primary-gradient) !important;
        color: white !important;
    }

    /* Additional brown-themed elements */
    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle at center, rgba(139, 115, 85, 0.03), transparent);
        border-radius: 50%;
        transform: translate(30px, 30px);
    }
</style>

<div class="floating-shapes">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
</div>

<div class="container dashboard-container">
    <div class="dashboard-header">
        <h1 class="dashboard-title">Admin Dashboard</h1>
        <p class="dashboard-subtitle">Monitor your platform's key metrics and performance</p>
    </div>

    <div class="stats-grid">
        <!-- Users Card -->
        <div class="stat-card users">
            <div class="stat-icon">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-title">Total Users</div>
            <div class="stat-number pulse-animation">{{ $users ?? '1' }}</div>
            <div class="stat-description">Registered platform users</div>
        </div>

        <!-- Blogs Card -->
        <div class="stat-card blogs">
            <div class="stat-icon">
                <i class="bi bi-journal-text"></i>
            </div>
            <div class="stat-title">Total Blogs</div>
            <div class="stat-number pulse-animation">{{ $blog ?? '1' }}</div>
            <div class="stat-description">Published blog articles</div>
        </div>

        <!-- Services Card -->
        <div class="stat-card services">
            <div class="stat-icon">
                <i class="bi bi-gear-fill"></i>
            </div>
            <div class="stat-title">Total Products</div>
            <div class="stat-number pulse-animation">{{ $product ?? '0' }}</div>
            <div class="stat-description">Available service offerings</div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    // Enhanced toastr configuration with brown theme
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    @if(session('success'))
        toastr.success("{{ session('success') }}", "Success");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}", "Error");
    @endif

    // Add smooth scroll behavior
    document.documentElement.style.scrollBehavior = 'smooth';

    // Add entrance animations
    window.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.stat-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            setTimeout(() => {
                card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 200);
        });
    });

    // Add subtle hover sound effect (optional)
    document.querySelectorAll('.stat-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.borderColor = 'rgba(139, 115, 85, 0.2)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.borderColor = 'rgba(139, 115, 85, 0.1)';
        });
    });
</script>
@endpush

@endsection
