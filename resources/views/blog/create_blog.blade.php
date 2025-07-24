@extends('layouts.app')
@section('title', isset($blog) ? 'Edit Blog' : 'Create Blog')
<style>
    .image-loading {
        opacity: 0.6;
        pointer-events: none;
    }

    .video-loading {
        opacity: 0.6;
        pointer-events: none;
    }

    .image-container img {
        border: 2px solid #ddd;
        border-radius: 4px;
    }

    .remove-btn {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
</style>
@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($blog) ? 'Edit Blog' : 'Create Blog' }}</h4>
                    <form action="{{ isset($blog) ? route('update.blog', $blog->id) : route('blog.store') }}" method="post"
                        id="blog-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="user_id">User</label>
                            <select name="user_id" class="form-control">
                                <option>select user</option>
                                @foreach ($user as $key => $user)
                                    <option value="{{ $key }}"
                                        {{ isset($blog) && $blog->user_id == $key ? 'selected' : '' }}>
                                        {{ $user }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ isset($blog) ? $blog->name : '' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ isset($blog) ? $blog->description : '' }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            <div class="existing-images">
                                @if (isset($blog) && $blog->image)
                                    @foreach (json_decode($blog->image) as $image)
                                        <div class="image-container position-relative d-inline-block me-2 mb-2"
                                            data-image="{{ $image }}">
                                            <img src="{{ asset('images/blogs/' . $image) }}" alt="Blog Image"
                                                class="img-fluid" style="width: 100px; height: 100px; object-fit: cover;">
                                            <button type="button"
                                                class="btn btn-danger custom-btn btn-sm position-absolute top-0 end-0 remove-btn d-flex justify-content-center text-white align-items-center"
                                                style="width: 20px; height: 20px; border-radius: 50%; font-size: 12px;"
                                                onclick="removeImageImmediately(this, '{{ $image }}')">×</button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="mt-4">
                                <input type="file" name="image[]" class="form-control" multiple accept="image/*">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="video">Video</label>
                            @if (isset($blog) && $blog->video)
                                <div class="video-container position-relative d-inline-block" id="existing-video">
                                    <div class="mt-2">
                                        <video controls style="max-width: 100%; width: 300px; height: auto;">
                                            <source src="{{ asset('videos/blogs/' . $blog->video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <button type="button"
                                            class="btn btn-danger custom-btn btn-sm position-absolute top-0 end-0 remove-btn d-flex justify-content-center text-white align-items-center"
                                            style="width: 20px; height: 20px; border-radius: 50%; font-size: 12px;"
                                            onclick="removeVideoImmediately()">×</button>
                                    </div>
                                </div>
                            @endif
                            <div class="mt-2">
                                <input type="file" name="video" class="form-control" accept="video/*">
                            </div>
                        </div>
                        <div class="form-group text-center p-3">
                            <button type="submit" class="btn btn-primary mr-2 text-white custom-btn" style="pointer-events: auto;">
                                {{ isset($blog) ? 'Update' : 'Submit' }}
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
        let deletedImages = [];
        const blogId = {{ isset($blog) ? $blog->id : 'null' }};

        // Immediate AJAX image deletion
        function removeImageImmediately(button, imageName) {
            if (!confirm('Are you sure you want to delete this image?')) {
                return;
            }

            if (blogId) {
                // Add loading state
                const imageContainer = $(button).closest('.image-container');
                imageContainer.addClass('image-loading');
                $(button).prop('disabled', true).text('...');

                $.ajax({
                    url: '{{ route('blog.image.destroy') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        image_name: imageName,
                        blog_id: blogId
                    },
                    success: function(response) {
                        if (response.success) {
                            imageContainer.fadeOut(300, function() {
                                $(this).remove();
                            });
                            showMessage('Image deleted successfully', 'success');
                        } else {
                            imageContainer.removeClass('image-loading');
                            $(button).prop('disabled', false).text('×');
                            showMessage('Error deleting image: ' + response.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        imageContainer.removeClass('image-loading');
                        $(button).prop('disabled', false).text('×');
                        let errorMessage = 'Error deleting image. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        showMessage(errorMessage, 'error');
                    }
                });
            } else {
                // For new blogs (no ID yet), just remove from DOM
                $(button).closest('.image-container').fadeOut(300, function() {
                    $(this).remove();
                });
            }
        }

        // Immediate AJAX video deletion
        function removeVideoImmediately() {
            if (!confirm('Are you sure you want to delete this video?')) {
                return;
            }

            if (blogId) {
                const videoContainer = $('#existing-video');
                videoContainer.addClass('video-loading');
                videoContainer.find('button').prop('disabled', true).text('Deleting...');

                $.ajax({
                    url: '{{ route('blog.video.destroy') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        blog_id: blogId
                    },
                    success: function(response) {
                        if (response.success) {
                            videoContainer.fadeOut(300, function() {
                                $(this).remove();
                            });
                            showMessage('Video deleted successfully', 'success');
                        } else {
                            videoContainer.removeClass('video-loading');
                            videoContainer.find('button').prop('disabled', false).text('Remove Video');
                            showMessage('Error deleting video: ' + response.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        videoContainer.removeClass('video-loading');
                        videoContainer.find('button').prop('disabled', false).text('Remove Video');
                        let errorMessage = 'Error deleting video. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        showMessage(errorMessage, 'error');
                    }
                });
            }
        }

        // Function to show messages
        function showMessage(message, type) {
            $('.alert').remove();

            const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            const alertHtml = `
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;

            $('.card-body').prepend(alertHtml);

            setTimeout(function() {
                $('.alert').fadeOut();
            }, 3000);
        }

        // Form validation
        $(document).ready(function() {
            $('#blog-form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    description: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: 'Name is required',
                    },
                    description: {
                        required: 'Description is required',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    var submitBtn = $(form).find('button[type="submit"]');
                    var originalText = submitBtn.text();
                    submitBtn.prop('disabled', true).text('Processing...');
                    form.submit();
                }
            });
        });
    </script>
@endpush
