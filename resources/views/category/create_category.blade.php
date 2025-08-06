@extends('layouts.app')
@section('title', isset($category) ? 'Edit Category' : 'Create Category')

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card" style="margin: 0 auto;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ isset($category) ? 'Edit Category' : 'Create Category' }}</h4>
                <form action="{{ isset($category) ? route('update.category', $category->id) : route('category.store') }}"
                      method="post" enctype="multipart/form-data" id="category-form">
                    @csrf

                    {{-- Name --}}
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                               value="{{ isset($category) ? $category->name : '' }}">
                    </div>

                    {{-- Image --}}
                    <div class="form-group mb-3">
                        <label for="image">Image</label>
                        @if (isset($category) && $category->image)
                            <img src="{{ asset('images/category/' . $category->image) }}" alt="Image" class="img-fluid mb-2"
                                 style="width: 100px; height: 100px;">
                        @endif
                        <input type="file" name="image" class="form-control" id="image">
                        <div id="image-preview" class="mt-2" style="display: none;">
                            <img src="" alt="Image Preview" class="img-fluid" style="width: 100px; height: 100px;">
                        </div>
                    </div>

                    {{-- Icon --}}
                    <div class="form-group mb-3">
                        <label for="icon">Icon</label>
                        @if (isset($category) && $category->icon)
                            <img src="{{ asset('images/category/' . $category->icon) }}" alt="Icon" class="img-fluid mb-2"
                                 style="width: 100px; height: 100px;">
                        @endif
                        <input type="file" name="icon" class="form-control" id="icon">
                        <div id="icon-preview" class="mt-2" style="display: none;">
                            <img src="" alt="Icon Preview" class="img-fluid" style="width: 100px; height: 100px;">
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="form-group text-center p-3">
                        <button type="submit" class="btn btn-primary mr-2 text-white custom-btn">
                            {{ isset($category) ? 'Update' : 'Submit' }}
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

    // Preview for Image
    $('#image').change(function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#image-preview img').attr('src', e.target.result);
            $('#image-preview').show();
        }
        reader.readAsDataURL(this.files[0]);
    });

    // Preview for Icon
    $('#icon').change(function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#icon-preview img').attr('src', e.target.result);
            $('#icon-preview').show();
        }
        reader.readAsDataURL(this.files[0]);
    });

    // Validation
    $('#category-form').validate({
        rules: {
            name: {
                required: true,
            },
            image: {
                required: true,
                extension: "jpg|jpeg|png"
            },
            icon: {
                required: true,
                extension: "jpg|jpeg|png"
            }
        },
        messages: {
            name: {
                required: 'Name is required',
            },
            image: {
                required: 'Image is required',
                extension: 'Only JPG, JPEG, PNG files are allowed'
            },
            icon: {
                required: 'Icon is required',
                extension: 'Only JPG, JPEG, PNG files are allowed'
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        },
        submitHandler: function(form) {
            var submitBtn = $(form).find('button[type="submit"]');
            submitBtn.prop('disabled', true).text('Processing...');
            form.submit();
        }
    });

});
</script>
@endpush
