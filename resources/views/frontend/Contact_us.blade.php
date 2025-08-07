@extends('frontend.layouts.main')
@section('content')
<section class="contact-hero-section">
   <div class="contact-hero-overlay">
      <div class="container text-center py-5">
         <h1 class="contact-hero-title">CONTACT US</h1>
         <nav class="breadcrumb-nav">
            <span>Home</span> <span class="mx-2">/</span> <span class="active">Contact</span>
         </nav>
      </div>
   </div>
</section>
<!-- Contact Form & Info Section + Map Section with shared background -->
<div class="contact-bg-wrap py-5">
   <section class="contact-main-section">
      <div class="container">
         <div class="row g-4 align-items-stretch">
            <!-- Contact Form -->
            <div class="col-lg-7">
               <div class="contact-form-card p-4 h-100">
                  <h2 class="contact-form-title mb-3">GET IN TOUCH</h2>
                  <p class="contact-form-desc mb-4">We love to hear from fellow gamers! Fill out the form and
                     our team will get back to you soon.
                  </p>
                  <div id="formSuccessMsg"></div>
                  <form id="contactForm" action="{{ route('contactus.store') }}" method="POST">
                     @csrf
                     @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                     @endif
                     <div class="mb-3">
                        <input type="text" name="name" id="name" class="form-control contact-input" placeholder="Name*">
                     </div>
                     <div class="mb-3">
                        <input type="email" name="email" id="email" class="form-control contact-input" placeholder="Email*"
                           >
                     </div>
                     <div class="mb-3">
                        <input type="text" name="tag" id="tag"  class="form-control contact-input"
                           placeholder="Discord / Gamer Tag">
                     </div>
                     <div class="mb-3">
                        <textarea type="text" name="message" id="message" class="form-control contact-input" rows="4" placeholder="Your message*"
                           ></textarea>
                     </div>
                     <button type="submit" class="btn contact-send-btn w-100">SEND MESSAGE</button>
                  </form>
               </div>
            </div>
            <!-- Contact Info Card -->
            <div class="col-lg-5">
               <div class="contact-info-card p-4 h-100">
                  <div class="mb-4">
                     <h5 class="contact-info-title mb-2"><i class="fas fa-map-marker-alt me-2"></i>OUR HQ
                     </h5>
                     <p class="contact-info-text mb-0">264 Weber St W, Kitchener,<br/> ON N2H 4A6, Canada</p>
                  </div>
                  <div class="mb-4">
                     <h5 class="contact-info-title mb-2"><i class="fas fa-phone me-2"></i>CONTACT</h5>
                    <p class="contact-info-text mb-0">1800-9797-6361<br>info@yoyokhel.com</p>
                  </div>
                  <div>
                     <h5 class="contact-info-title mb-2"><i class="fas fa-share-alt me-2"></i>JOIN OUR
                        COMMUNITY
                     </h5>
                     <div class="contact-social-icons mb-3">
                        {{-- <a href="#"><i class="fab fa-discord"></i></a> --}}
                        {{-- <a href="#"><i class="fab fa-twitch"></i></a> --}}
                        <a href="#"><i class="fab fa-twitter"></i></a>
                     </div>
                     <div class="map-embed-wrapper rounded-4 overflow-hidden">
                        <iframe
                           src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.019019019019!2d-122.419415484681!3d37.7749297797597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085809c5b5b5b5b%3A0x5b5b5b5b5b5b5b5b!2sSan+Francisco%2C+CA!5e0!3m2!1sen!2sus!4v1680000000000!5m2!1sen!2sus"
                           width="100%" height="180" style="border:0;" allowfullscreen="" loading="lazy"
                           referrerpolicy="no-referrer-when-downgrade"></iframe>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="Z_newsletter container">
      <div
         class="Z_newsletter-bg position-relative overflow-hidden my-4 d-flex flex-column flex-md-row align-items-center justify-content-between p-4 p-md-5">
         <div class="Z_newsletter-content text-center text-md-start mb-3 mb-md-0">
            <div class="Z_newsletter-subtitle text-uppercase mb-1">Get Updates</div>
            <h2 class="Z_newsletter-title mb-2">TINJA NEWSLETTER</h2>
         </div>
         <form class="Z_newsletter-form d-flex flex-column flex-md-row align-items-center gap-2 w-100 w-md-auto"
            style="max-width: 500px;">
            <input type="email" class="form-control Z_newsletter-input flex-grow-1"
               placeholder="Enter your email address" required>
            <button type="submit" class="btn Z_newsletter-btn">SUBSCRIBE</button>
         </form>
      </div>
   </section>
</div>
@endsection
@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
   $(document).ready(function() {
       $("#contactForm").validate({
           rules: {
               name: {
                   required: true,
                   minlength: 2
               },
               email: {
                   required: true,
                   email: true
               },
               tag:{
                  required: true,
               },
               message: {
                   required: true,
                   minlength: 10
               }
           },
           messages: {
               name: {
                   required: "Please enter your name",
                   minlength: "Your name must be at least 2 characters long"
               },
               email: {
                   required: "Please enter your email",
                   email: "Please enter a valid email address"
               },
               tag:{
                  required: "Please enter your Tag",
               },
               message: {
                   required: "Please enter a message",
                   minlength: "Your message must be at least 10 characters long"
               }
           },
           submitHandler: function(form) {
               let formData = {
                   name: $('input[name="name"]').val(),
                   email: $('input[name="email"]').val(),
                   tag: $('input[name="tag"]').val(),
                   message: $('textarea[name="message"]').val(),
                   _token: $('input[name="_token"]').val() // CSRF token
               };

               $.ajax({
                  url: '{{ route("contactus.store") }}',
                  type: 'POST',
                  data: formData,
                  success: function(response) {
                     // Show success message in the div
                     $('#formSuccessMsg').html(`
                           <div class="alert alert-success alert-dismissible fade show" role="alert">
                              ${response.success}
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>
                     `);
                     form.reset();
                  },
                  error: function(xhr) {
                     $('#formSuccessMsg').html(`
                           <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              Error sending message. Please try again.
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>
                     `);
                  }
               });
            }
       });
   });
</script>
@endpush
