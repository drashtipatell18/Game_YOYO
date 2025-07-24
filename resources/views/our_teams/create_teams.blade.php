@extends('layouts.app')
@section('title', isset($ourTeams) ? 'Edit Our Team' : 'Create Our Team')
@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($ourTeams) ? 'Edit Our Team' : 'Create Our Team' }}</h4>
                    <form action="{{ isset($ourTeams) ? route('update.our_teams', $ourTeams->id) : route('our_teams.store') }}" method="post"
                        enctype="multipart/form-data" id="ourTeam-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ isset($ourTeams) ? $ourTeams->name : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            @if (isset($ourTeams) && $ourTeams->image)
                                <img src="{{ asset('images/ourteam/' . $ourTeams->image) }}" alt="User Image" class="img-fluid"
                                    style="width: 100px; height: 100px;">
                            @endif
                            <input type="file" name="image" class="form-control" id="image">
                            <div id="image-preview" class="mt-2" style="display: none;">
                                <img src="" alt="Image Preview" class="img-fluid"
                                    style="width: 100px; height: 100px;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="designation">Designation</label>
                                    <input type="text" name="designation" class="form-control"
                                        value="{{ isset($ourTeams) ? $ourTeams->designation : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center p-3">
                            <button type="submit" class="btn btn-primary mr-2 text-white custom-btn" style="pointer-events: auto;">
                                {{ isset($ourTeams) ? 'Update' : 'Submit' }}
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
            });
            $(document).ready(function() {
                $('#ourTeam-form').validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        designation: {
                            required: true,
                        }

                    },
                    messages: {
                        name: {
                            required: 'Name is required',
                        },
                        designation:{
                            required : 'Designation is required'
                        }
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
