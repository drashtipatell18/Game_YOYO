@extends('layouts.app')
@section('title', isset($membersSay) ? 'Edit Members Say' : 'Create Members Say')
@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($membersSay) ? 'Edit Members Say' : 'Create Members Say' }}</h4>
                    <form action="{{ isset($membersSay) ? route('update.members-say', $membersSay->id) : route('members-say.store') }}"
                        method="post" id="membersSay-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ isset($membersSay) ? $membersSay->name : '' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ isset($membersSay) ? $membersSay->description : '' }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            @if (isset($membersSay))
                                <img src="{{ asset('images/members_say/' . $membersSay->image) }}" alt="membersSay Icon"
                                    class="img-fluid" style="width: 50px; height: 50px;">
                            @endif
                            <input type="hidden" name="image" value="{{ isset($membersSay) ? $membersSay->image : '' }}">
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="form-group text-center p-3">
                            <button type="submit" class="btn btn-primary mr-2 text-white custom-btn"
                                style="pointer-events: auto;">
                                {{ isset($membersSay) ? 'Update' : 'Submit' }}
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
            $('#membersSay-form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
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
