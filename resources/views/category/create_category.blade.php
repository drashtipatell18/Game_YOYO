@extends('layouts.app')
@section('title', isset($category) ? 'Edit Category' : 'Create Category')
@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($category) ? 'Edit User' : 'Create User' }}</h4>
                    <form action="{{ isset($category) ? route('update.category', $category->id) : route('category.store') }}" method="post"
                        enctype="multipart/form-data" id="category-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ isset($category) ? $category->name : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            @if (isset($category) && $category->image)
                                <img src="{{ asset('images/category/' . $category->image) }}" alt="User Image" class="img-fluid"
                                    style="width: 100px; height: 100px;">
                            @endif
                            <input type="file" name="image" class="form-control" id="image">
                            <div id="image-preview" class="mt-2" style="display: none;">
                                <img src="" alt="Image Preview" class="img-fluid"
                                    style="width: 100px; height: 100px;">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Icon</label>
                            @if (isset($category) && $category->icon)
                                <img src="{{ asset('images/category/' . $category->icon) }}" alt="User Image" class="img-fluid"
                                    style="width: 100px; height: 100px;">
                            @endif
                            <input type="file" name="icon" class="form-control" id="icon">
                            <div id="image-preview" class="mt-2" style="display: none;">
                                <img src="" alt="Image Preview" class="img-fluid"
                                    style="width: 100px; height: 100px;">
                            </div>
                        </div>

                        <div class="form-group text-center p-3">
                            <button type="submit" class="btn btn-primary mr-2 text-white" style="pointer-events: auto;">
                                {{ isset($category) ? 'Update' : 'Submit' }}
                            </button>
                        </div>
                    </form>
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
                $('#icon').change(function() {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image-preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });
            });
            $(document).ready(function() {
                $('#category-form').validate({
                    rules: {
                        name: {
                            required: true,
                        },
                    },
                    messages: {
                        name: {
                            required: 'Name is required',
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
                        // Optional: Add loading state
                        var submitBtn = $(form).find('button[type="submit"]');
                        var originalText = submitBtn.text();
                        submitBtn.prop('disabled', true).text('Processing...');
                        // Submit the form
                        form.submit();
                    }
                });
            });
        </script>
    @endpush
