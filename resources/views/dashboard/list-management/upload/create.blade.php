@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">List Management Contact</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Upload new contact list</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4>List Management Contact</h4>
                                    <p>
                                        Import (merge) contact data from a csv, xsls, xsl file format
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body" style="padding: 4rem;">
                        <form id="contact-upload-form" data-upload-url="{{ route('user.upload.contact', Crypt::encrypt($list->id)) }}">
                            @csrf
                            <div class="row">
                                <p class="notifyme d-none text-success">Thanks for uploading your contacts! We're now processing them to ensure everything is in order. This may take a moment, so please hang tight. We'll notify you as soon as your contacts are ready for use. Thanks for your patience!</p>
                                <div class="mt-5">
                                    <div class="logo-input border-in w-full px-5 py-4 pb-5">
                                        <p>
                                            <b>
                                                Upload a file containing your contacts
                                            </b>
                                        </p>
                                        <div class="logo-input2 border-in py-5 px-3">
                                            <div class="avatar">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664984753/OjaFunnel-Images/Vectoor_rbkrfl.png" alt="">
                                            </div>
                                            <div class="logo-file">
                                                <input type="file" id="contact_upload" class="mt-4 w-100" />
                                                <span class="mt-3 text-danger text-center">This tool allows you to import (merge) contact data from a csv, xsls, xsl file format.</span>
                                            </div>
                                        </div>
                                        <p class="mt-5 text-center">
                                            <b><a href="{{route('user.subscriber.download.format')}}">Click here to view our format</a></b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end mt-2">
                                <a href="{{route('user.view.list', Crypt::encrypt($list->id))}}">
                                    <button type="button" class="btn px-4 py-1 btn-danger">
                                        Cancel
                                    </button>
                                </a>
                                <button type="submit" id="uploadContactButton" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                    Upload
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
    $('#contact-upload-form').submit(function(e) {
        e.preventDefault(); // Prevent form submission
        var $form = $(this); // Get the form being submitted

        var uploadURL = $(this).data('upload-url');

        $('.notifyme').removeClass('d-none');

        // Disable submit button and show loading state
        $form.find('#uploadContactButton').attr('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Contacts uploading...');

        // Create a FormData object and append form data
        var formData = new FormData();
        var file = $('#contact_upload')[0].files[0];
        if (file) {
            formData.append('contact_upload', file);
        }

        // Send Ajax request to Laravel backend
        $.ajax({
            type: 'POST',
            url: uploadURL,
            data: formData,
            contentType: false, // Set contentType to false
            processData: false, // Set processData to false
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include the CSRF token in the headers
            },
            success: function(response) {
                if(response.code === 200) {
                    // Show success toastr notification
                    toastr.success(response.message);
                } else if(response.code === 422) {
                    // Handle validation errors if needed
                    var errors = response.errors;
                    // Loop through errors and display them as toasts
                    $.each(errors, function(key, value) {
                        toastr.error(value[0]); // Display the first error message
                    });
                } else {
                    toastr.error(response.message);
                }

                $('.notifyme').addClass('d-none');

                // Enable submit button and reset its state
                $form.find('#uploadContactButton').attr('disabled', false).html('Upload');
            },
            error: function(xhr, status, error) {
                // Show error toastr notification
                toastr.error('Contact uploading failed. Please try again.');

                // Enable submit button and reset its state
               $form.find('#uploadContactButton').attr('disabled', false).html('Upload');
            }
        });
    });
</script>
@endsection
