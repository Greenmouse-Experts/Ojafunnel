@extends('layouts.admin-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Validate Email Addresses</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Validate Emails</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Add Plans</h4>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div> -->

            <div class="row">
                <!-- <div class="col-lg-2"></div> -->
                <div class="col-lg-6">
                    <div class="Edit">
                        <form class="formSubmitValidation">
                            @csrf
                            <div class="form">
                                <div class="row">
                                    <p class="tell mb-4 mt-n3">
                                        <b>You can only enter a maximum of 10 emails at a go. This is to reduce the work load on the api check</b>
                                    </p>
                                    <div class="col-lg-12">
                                        <label>Email Addresses</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <textarea type="text" placeholder="Enter email addresses. Eg. abcd@test.com, wxyz@testing.com" name="emails" class="input emails" required></textarea>
                                                <p class="text-danger">Please seperate the emails separated by comma (,)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="boding">
                                            <button type="submit" class="submitBtn">
                                                Validate
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-4">
                                        <div class="row display_email_data">

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="validation-result">
                        <!-- Validation result will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.formSubmitValidation').submit(function(event) {
            event.preventDefault();

            // Disable submit button and show loading state
            $('.submitBtn').attr('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verifying...');

            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: "{{ route('clrs') }}",
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include the CSRF token in the headers
                },
                success: function(response) {
                    console.log(response);
                    // Update the HTML content with the validation result
                    if (response.data.length > 0) {
                        var tableHtml = '<table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">';
                        tableHtml += '<thead class="tread">';
                        tableHtml += '<tr><th>Email</th><th>Result</th></tr>';
                        tableHtml += '</thead><tbody>';

                        // Iterate over each result object
                        response.data.forEach(function(result) {
                            tableHtml += '<tr><td>' + result.debounce.email + '</td><td>' + result.debounce.result + '</td></tr>';
                        });

                        tableHtml += '</tbody></table>';
                        $('.validation-result').html(tableHtml);
                    } else {
                        $('.validation-result').html('<p class="text-danger">No validation result found.</p>');
                    }

                    // Enable submit button and reset its state
                    $('.submitBtn').attr('disabled', false).html('Validate');
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                    $('.validation-result').html('<p class="text-danger">Failed to validate email addresses.</p>');
                    // Enable submit button and reset its state
                    $('.submitBtn').attr('disabled', false).html('Validate');
                }
            });
        });
    });
</script>

@endsection

