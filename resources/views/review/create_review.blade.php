@extends('layouts.app')

@section('title', isset($review) ? 'Edit Review' : 'Create Review')

@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($review) ? 'Edit Review' : 'Create Review' }}</h4>
                    <form action="{{ isset($review) ? route('update.reviews', $review->id) : route('reviews.store') }}"
                        method="POST" enctype="multipart/form-data" id="review-form">
                        @csrf
                        {{-- Category and Name --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="product_id">Product</label>
                                    <select class="form-control" id="product_id" name="product_id">
                                            <option value="">Select Product</option>
                                                @foreach ($products as $key => $product)
                                                    <option value="{{ $key }}"
                                                        {{ isset($review) && $review->product_id == $key ? 'selected' : '' }}>
                                                        {{ $product }}</option>
                                                @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="user_id">User</label>
                                    <select class="form-control" id="user_id" name="user_id">
                                        <option value="">Select User</option>
                                        @foreach ($users as $key => $user)
                                            <option value="{{ $key }}"
                                                {{ isset($review) && $review->user_id == $key ? 'selected' : '' }}>
                                                {{ $user }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="quantity">Rating</label>
                                <input type="number" class="form-control" id="rating" min="1" max="5"
                                    name="rating" value="{{ isset($review) ? $review->rating : '' }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="review">Review</label>
                                <textarea name="review" id="review" class="form-control" rows="8" placeholder="Enter your comment here...">{{ old('review', $review->review ?? '') }}</textarea>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="form-group text-center p-3">
                            <button type="submit" class="btn btn-primary mr-2 text-white custom-btn" style="pointer-events: auto;">
                                {{ isset($review) ? 'Update' : 'Submit' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#review-form').validate({
            rules: {
                product_id: {
                    required: true
                },
                user_id: {
                    required: true
                },
                rating: {
                    required: true,
                    number: true,
                    min: 1,
                    max: 5
                },
                review: {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                product_id: "Please select a product",
                user_id: "Please select a user",
                rating: {
                    required: "Please enter a rating",
                    number: "Please enter a valid number",
                    min: "Minimum rating is 1",
                    max: "Maximum rating is 5"
                },
                review: {
                    required: "Please enter your review",
                    minlength: "Review must be at least 5 characters long"
                }
            },
            errorClass: 'text-danger',
            errorElement: 'small',
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endpush
