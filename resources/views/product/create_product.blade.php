@extends('layouts.app')

@section('title', isset($product) ? 'Edit Product' : 'Create Product')

@section('content')
    <style>
        .form-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .form-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .form-switch input:checked+.form-check-label::before {
            background-color: #4caf50;
        }

        .form-check-label {
            position: relative;
            padding-left: 70px;
            cursor: pointer;
        }

        .form-check-label::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 60px;
            height: 34px;
            background-color: #ccc;
            border-radius: 34px;
            transition: background-color 0.4s;
        }

        .form-check-label::after {
            content: '';
            position: absolute;
            top: 4px;
            left: 4px;
            width: 26px;
            height: 26px;
            background-color: white;
            border-radius: 50%;
            transition: transform 0.4s;
        }

        .form-switch input:checked+.form-check-label::after {
            transform: translateX(26px);
        }
    </style>

    </style>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($product) ? 'Edit Product' : 'Create Product' }}</h4>
                    <form action="{{ isset($product) ? route('product.update', $product->id) : route('product.store') }}"
                        method="POST" enctype="multipart/form-data" id="product-form">
                        @csrf
                        {{-- Category and Name --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $key => $category)
                                            <option value="{{ $key }}"
                                                {{ isset($product) && $product->category_id == $key ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $product->name ?? '') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Price and Tags --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price" class="form-control" step="0.01"
                                        value="{{ old('price', $product->price ?? '') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tags">Tags (comma separated)</label>
                                    <input type="text" name="tags" id="tags" class="form-control"
                                        value="{{ old('tags', $product->tags ?? '') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Product Images (multiple)</label>
                            <div id="existing-images" class="d-flex flex-wrap" style="gap: 10px;">
                                @if (isset($product) && $product->image)
                                    @php
                                        $mediaFiles = explode(',', $product->image);
                                    @endphp
                                    @foreach ($mediaFiles as $index => $file)
                                        <div class="image-container position-relative" data-image="{{ $file }}">

                                            <img src="{{ asset('images/products/' . $file) }}" alt="Product Media"
                                                style="width: 70px; height: 70px; object-fit: cover;">

                                            <button type="button"
                                                class="btn btn-primary btn-sm position-absolute top-0 end-0 remove-btn d-flex justify-content-center text-white align-items-center custom-btn"
                                                style="width: 20px; height: 20px; border-radius: 50%;"
                                                onclick="removeImageImmediately(this, '{{ $file }}')">×</button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="mt-2">
                                <input type="file" class="form-control" id="image" name="image[]" multiple
                                    accept="image/*">
                                <input type="hidden" name="old_image" id="old_image"
                                    value="{{ isset($product) ? $product->image : '' }}">
                                <input type="hidden" name="deleted_images" id="deleted_images" value="">
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
                        </div>

                        {{-- Weight and Dimensions --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="weight">Weight (kg)</label>
                                    <input type="number" name="weight" id="weight" class="form-control" step="0.01"
                                        value="{{ old('weight', $product->weight ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="status">Status</label>
                                    <div class="form-check form-switch d-flex align-items-start gap-2">
                                        <input class="form-check-input" type="checkbox" id="status" name="status"
                                            value="active"
                                            {{ isset($product) && $product->status === 'active' ? 'checked' : '' }}
                                            onchange="updateStatusLabel(this)">
                                        <label class="form-check-label" for="status" id="status-label">
                                            {{ isset($product) && $product->status === 'active' ? 'Active' : 'Inactive' }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Dimensions (cm)</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="length">Length</label>
                                        <input type="number" name="length" id="length" class="form-control"
                                            placeholder="Length" value="{{ old('length', $product->length ?? '') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="width">Width</label>
                                        <input type="number" name="width" id="width" class="form-control"
                                            placeholder="Width" value="{{ old('width', $product->width ?? '') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="height">Height</label>
                                        <input type="number" name="height" id="height" class="form-control"
                                            placeholder="Height" value="{{ old('height', $product->height ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="form-group text-center p-3">
                            <button type="submit" class="btn btn-primary mr-2 text-white custom-btn"
                                style="pointer-events: auto;">
                                {{ isset($product) ? 'Update' : 'Submit' }}
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
        $(document).ready(function() {
            $('#image').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('#product-form').validate({
                rules: {
                    category_id: {
                        required: true
                    },
                    name: {
                        required: true,
                        minlength: 2
                    },
                    price: {
                        required: true,
                        number: true,
                    },
                    tags: {
                        required: true
                    },
                    description: {
                        required: false,
                        minlength: 10
                    },
                    weight: {
                        required: true,
                        number: true
                    },
                    length: {
                        required: true,
                        number: true
                    },
                    width: {
                        required: true,
                        number: true
                    },
                    height: {
                        required: true,
                        number: true
                    }


                },
                messages: {
                    category_id: "Please select a category",
                    name: {
                        required: "Please enter product name",
                        minlength: "Name must be at least 2 characters"
                    },
                    price: {
                        required: "Please enter price",
                        number: "Enter a valid number",
                    },
                    tags: {
                        required: "Please enter product tag",
                        minlength: "Name must be at least 2 characters"
                    },
                    description: {
                        minlength: "Description must be at least 10 characters"
                    },
                    weight: {
                        required: "Enter product weight",
                        number: "Weight must be a number"
                    },


                    length: "Enter length",
                    width: "Enter width",
                    height: "Enter height"
                },
                errorClass: 'text-danger',
                errorElement: 'small',
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                }
            });
        });


        let deletedImages = [];
        const productId = {{ isset($product) ? $product->id : 'null' }};

        // Immediate AJAX deletion (recommended approach)
        function removeImageImmediately(button, imageName) {
            if (!confirm('Are you sure you want to delete this image?')) {
                return;
            }

            if (productId) {
                // Add loading state
                const imageContainer = $(button).closest('.image-container');
                imageContainer.addClass('image-loading');
                $(button).prop('disabled', true);

                $.ajax({
                    url: '{{ route('product.image.destroy') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        image_name: imageName,
                        product_id: productId
                    },
                    success: function(response) {
                        if (response.success) {
                            imageContainer.fadeOut(300, function() {
                                $(this).remove();
                            });
                            // Show success message
                            showMessage('Image deleted successfully', 'success');
                        } else {
                            // Remove loading state on error
                            imageContainer.removeClass('image-loading');
                            $(button).prop('disabled', false);
                            showMessage('Error deleting image: ' + response.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        // Remove loading state on error
                        imageContainer.removeClass('image-loading');
                        $(button).prop('disabled', false);
                        showMessage('Error deleting image. Please try again.', 'error');
                    }
                });
            } else {
                // For new products (no ID yet), just remove from DOM
                $(button).closest('.image-container').fadeOut(300, function() {
                    $(this).remove();
                });
            }
        }

        // Optional: For delayed deletion (only when form is submitted)
        function removeExistingImage(button, imageName) {
            // Add to deleted images array
            if (!deletedImages.includes(imageName)) {
                deletedImages.push(imageName);
            }

            // Update hidden field with deleted images
            $('#deleted_images').val(deletedImages.join(','));

            // Remove the image container from DOM with animation
            $(button).closest('.image-container').fadeOut(300, function() {
                $(this).remove();
                updateRemainingImages();
            });
        }

        // Function to update remaining images hidden field
        function updateRemainingImages() {
            let remainingImages = [];
            $('.image-container').each(function() {
                let imageName = $(this).data('image');
                if (imageName && !deletedImages.includes(imageName)) {
                    remainingImages.push(imageName);
                }
            });
            $('#old_image').val(remainingImages.join(','));
        }

        // Function to show messages
        function showMessage(message, type) {
            // Remove existing messages
            $('.alert').remove();

            const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            const alertHtml = `
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;

            $('.card-body').prepend(alertHtml);

            // Auto hide after 3 seconds
            setTimeout(function() {
                $('.alert').fadeOut();
            }, 3000);
        }

        function updateStatusLabel(checkbox) {
            const label = document.getElementById('status-label');
            label.textContent = checkbox.checked ? 'Active' : 'Inactive';
        }
    </script>
@endpush
