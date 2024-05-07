@extends('layouts.dashboard-frontend')

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
                        <h4 class="mb-sm-0 font-size-18">List Management</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">List Management</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="row">
                            <div class="col-lg-8 aminn">
                                <div class="py-2">
                                    <h4 class="font-500">List Management</h4>
                                    <p>
                                        All your list management List in one Place
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-1 aminn">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <p class="cash">Explainer Video Here</p> -->
                                        @if(App\Models\ExplainerContent::where('menu', 'List-Management')->exists())
                                        <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                            <i class="bi bi-play-btn"></i>
                                        </div>
                                        <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                            <i class="bi bi-card-text"></i>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 aminn">
                                <div class="card account-head">
                                    <div class="all-create">
                                        <a href="{{ route('user.create.list', ['username' => Auth::user()->username]) }}">
                                            <button>
                                                + Add List
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">View List</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Display Name</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Contact</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\ListManagement::latest()->where('user_id', Auth::user()->id)->get() as $key => $list)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                <p class='text-bold-600'> {{$list->name}} </p>
                                            </td>
                                            <td>
                                                {{$list->display_name}}
                                            </td>
                                            <td>
                                                {{ $list->slug }}
                                            </td>
                                            <td>
                                                <p class='text-bold-600'>{{ $list->description }}</p>
                                            </td>
                                            <td>{{App\Models\ListManagementContact::where('list_management_id', $list->id)->get()->count()}} Contact</td>
                                            <td>
                                                @if($list->status == true)
                                                <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                                @else
                                                <span class="badge badge-pill badge-soft-danger font-size-11">In-active</span>
                                                @endif
                                            </td>
                                            <td>{{ $list->created_at->toDayDateTimeString() }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="{{route('user.view.list', Crypt::encrypt($list->id))}}" style="cursor: pointer;">View</a></li>
                                                        <li><a class="dropdown-item" href="{{route('user.edit.list', Crypt::encrypt($list->id))}}" style="cursor: pointer;">Edit</a></li>
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$list->id}}">Delete</a></li>
                                                    </ul>
                                                </div>

                                                 <!-- Modal START -->
                                                 <div class="modal fade" id="delete-{{$list->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <form class="delete-list-form" data-list-url="{{ route('user.delete.list', Crypt::encrypt($list->id))}}">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <p><b>Delete List</b></p>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <p>This action cannot be undone. </p> <p>This will permanently delete this list and all contact attached to it.</p>
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <div class="boding">
                                                                                            <button type="submit" class="form-btn deleteListBtn">
                                                                                                I understand this consquences, Delete List
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end modal -->
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(App\Models\ExplainerContent::where('menu', 'List-Management')->exists())
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="400">
                                <source src="{{App\Models\ExplainerContent::where('menu', 'List-Management')->first()->video}}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Text Explainer</h4>
                        <div class="aller">
                           <p>
                           {{App\Models\ExplainerContent::where('menu', 'List-Management')->first()->text}}
                           </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->
@endif
<script>
    $('.delete-list-form').submit(function(e) {
        e.preventDefault(); // Prevent form submission
        var $form = $(this); // Get the form being submitted

        var deleteURL = $(this).data('list-url');

        // Disable submit button and show loading state
        $form.find('.deleteListBtn').attr('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deleting list management...');

        // Send Ajax request to Laravel backend
        $.ajax({
            type: 'DELETE',
            url: deleteURL,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include the CSRF token in the headers
            },
            success: function(response) {
                if(response.code === 200) {
                    // Show success toastr notification
                    toastr.success(response.message);
                    // Delay the redirection for 2 seconds (adjust the delay as needed)
                    setTimeout(function() {
                         // Reload the page after successful upload
                        window.location.reload();
                    }, 3000);
                } else if(response.code === 422) {
                    // Handle validation errors if needed
                    var errors = response.errors;
                    // Loop through errors and display them as toasts
                    $.each(errors, function(key, value) {
                        toastr.error(value[0]); // Display the first error message
                    });

                    // Enable submit button and reset its state
                   $form.find('.deleteListBtn').attr('disabled', false).html('I understand this consquences, Delete List');
                } else {
                    toastr.error(response.message);

                    // Enable submit button and reset its state
                   $form.find('.deleteListBtn').attr('disabled', false).html('I understand this consquences, Delete List');
                }

            },
            error: function(xhr, status, error) {
                // Show error toastr notification
                toastr.error('Deleting list management failed. Please try again.');

                // Enable submit button and reset its state
               $form.find('.deleteListBtn').attr('disabled', false).html('I understand this consquences, Delete List');
            }
        });
    });
</script>
@endsection
