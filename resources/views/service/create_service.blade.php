@extends('layouts.app')
@section('title', isset($service) ? 'Edit Service' : 'Create Service')
@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($service) ? 'Edit Service' : 'Create Service' }}</h4>
                    <form action="{{ isset($service) ? route('update.service', $service->id) : route('service.store') }}"
                        method="post" id="service-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ isset($service) ? $service->title : '' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ isset($service) ? $service->description : '' }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="icon">Icon</label>
                            @if (isset($service))
                                <img src="{{ asset('images/services/' . $service->icon) }}" alt="Service Icon"
                                    class="img-fluid" style="width: 50px; height: 50px;">
                            @endif
                            <input type="hidden" name="icon"
                                value="{{ isset($service) ? $service->icon : '' }}">
                            <input type="file" name="icon" class="form-control">
                        </div>
                        <div class="form-group text-center p-3">
                            <button type="submit" class="btn btn-primary mr-2 text-white custom-btn" style="pointer-events: auto;">
                                {{ isset($service) ? 'Update' : 'Submit' }}
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
            $('#service-form').validate({
                rules: {
                    title: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                },
                messages: {
                    title: {
                        required: 'Title is required',
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
