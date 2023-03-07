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
                        <h4 class="mb-sm-0 font-size-18">FAQs</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">FAQs</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner -->
            <div class=''>
                <div class=''>
                    <div class="row align-items-center bg-white p-lg-3">
                        <div class="col-lg-9">
                            <div class="py-2">
                                <h4 class="font-500">All FAQs</h4>
                                <p>
                                    Frequently Asked Questions
                                </p>
                            </div>
                        </div>
                        <div class='col-lg-3 text-end'>
                            <div class="">
                                <div class="all-create">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#createCat">
                                        <i class="bi bi-card-checklist pe-1"></i>Add FAQs
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table content of courses -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">FAQs List</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table align-middle table-nowrap">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Date Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\Faq::latest()->get() as $faq)
                                        <tr>

                                            <td><a href="javascript: void(0);" class="text-body fw-bold">{{$loop->iteration}}</a> </td>
                                            <td>
                                                {{$faq->question}}
                                            </td>
                                            <td>
                                                {{$faq->answer}}
                                            </td>
                                            <td>
                                                {{$faq->created_at->toDayDateTimeString()}}
                                            </td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editCat-{{$faq->id}}" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteCat-{{$faq->id}}" class="btn btn-sm btn-soft-danger"><i class="bi bi-x-circle"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                            <div class="modal fade" id="editCat-{{$faq->id}}" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-title" id="staticBackdropLabel">
                                                                Edit FAQ
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="Edit-level">
                                                                    <form method="post" action="{{route('updateFaq', Crypt::encrypt($faq->id))}}">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <div class="col-lg-12">
                                                                                <label>Question</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <input type="text" value="{{$faq->question}}" name="question" class="input" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <label>Answer</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <textarea type="text" value="{{$faq->answer}}" name="answer" class="input" required>{{$faq->answer}}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row justify-content-between">
                                                                                <div class="col-6">
                                                                                    <button class="px-3 btn" data-bs-dismiss="modal" aria-label="Close" style="color: #714091; border: 1px solid #714091">
                                                                                        Cancel
                                                                                    </button>
                                                                                </div>
                                                                                <div class="col-6 text-end">
                                                                                    <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091">
                                                                                        Update
                                                                                    </button>
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

                                            <!-- delete faq modal -->
                                            <div class="modal fade" id="deleteCat-{{$faq->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-bottom-0 bg-light">
                                                            <h5 class="modal-title py-2" id="staticBackdropLabel">
                                                                Are you sure you want to delete this faq?
                                                            </h5>
                                                        </div>
                                                        <div class='row justify-content-between p-3'>
                                                            <form method="post" action="{{route('deleteFaq', Crypt::encrypt($faq->id))}}">
                                                                @csrf
                                                                <div class='col'>
                                                                    <button type="button" class="btn px-3" data-bs-dismiss="modal" aria-label="Close" style="color: #714091; border: 1px solid #714091;">Cancel</button>
                                                                </div>
                                                                <div class='col text-end'>
                                                                    <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091">Delete</button>
                                                                </div>
                                                            </form>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
<div class="modal fade" id="createCat" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Add FAQ
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="post" action="{{route('addFaq')}}">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Question</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" name="question" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Answer</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea type="text" name="answer" class="input" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button class="px-3 btn" data-bs-dismiss="modal" aria-label="Close" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091">
                                            Save
                                        </button>
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
@endsection