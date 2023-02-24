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
                        <h4 class="mb-sm-0">Birthday Modules</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Birthday Module</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Birthday Module</h4>
                            <p>
                                Browse through birthday automated modules created by ojafunnel users.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <!-- table content of courses -->
            <div class="col-md-12">
                <div class="card-body card">
                    <h4 class="card-title mb-4">Module Listing</h4>
                    <div class="tab-content">
                        <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive" >
                                <table class="table  table-nowrap" id="datatable-buttons">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Owner's</th>
                                            <th scope="col">List Name</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Automation</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bm as $b)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <th scope="row">
                                                    <p>{{$b->user->username}}</p>
                                                    <p>{{$b->user->email}}</p>

                                                </th>
                                                <td>{{\App\Models\BirthdayContactList::where('id', $b->birthday_contact_list_id)->first()->name}}</td>
                                                <td>
                                                    {{$b->title}}
                                                </td>
                                                <td>
                                                    @php
                                                    $bb = json_decode($b->automation, true);

                                                @endphp
                                                    @foreach ($bb as $key => $value)
                                                        <p style="text-transform:capitalize">{{$value}}</p>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span class="badge badge-pill badge-soft-success font-size-11">{{$b->status}}</span>
                                                </td>
                                                <td>{{$b->start_date}}</td>
                                                <td>{{$b->end_date}}</td>
                                                <td>
                                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="View Message">
                                                            <a href="" data-bs-toggle="modal" data-bs-target="#viewMessage-{{$b->id}}" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <div class="modal fade" id="viewMessage-{{$b->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-bottom-0">
                                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                                    {{$b->title}} ({{$b->user->username}})
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="Edit-level">
                                                                        <div>
                                                                            <p>
                                                                                {{$b->message}}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
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

@endsection
