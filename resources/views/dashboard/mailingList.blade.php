@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Mailing List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active"> Mailing List</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Mailing List </h4>
                            <p>
                                Create, view, edit and do many more with your contact list
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card account-head" style="padding-top: 45px;">
                        <div class="all-create py-2">
                            <a style="background-color: #000;
                            color: #fff;
                            border: none;
                            padding: 11px 20px 11px 20px;
" href="{{route('user.create.list', Auth::user()->username)}}">+ Create Mailing List </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">All Mailing List(s)</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Mailing List Name </th>
                                            <th>Subscribers </th>
                                            <th>Open Rate </th>
                                            <th>Click Rate </th>
                                            {{-- <th>Status</th> --}}
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @if($mailinglists->isEmpty())
                                    <tbody>
                                        <tr>
                                            <td class="align-enter text-dark font-15" colspan="7">No Mailing List Added.</td>
                                        </tr>
                                    </tbody>
                                    @else
                                    @foreach($mailinglists as $key => $mailinglist)
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$mailinglist->name}}</td>
                                            <td><span class="no-margin text-primary stat-num">{{$mailinglist->subscribers->count() }}</span></td>
                                            <td>
                                                <div class="single-stat-box pull-left ml-20">
                                                    <span class="no-margin text-primary stat-num">{{ $mailinglist->openUniqRate() }}%</span>
                                                    <div class="progress progress-xxs">
                                                        <div class="progress-bar progress-bar-info" style="width: {{ $mailinglist->readCache('UniqOpenRate', 0) }}%">
                                                        </div>
                                                    </div>
                                                    <span class="text-muted small">Open rate</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="single-stat-box pull-left ml-20">
                                                    <span class="no-margin text-primary stat-num">{{ $mailinglist->readCache('ClickedRate', 0) }}%</span>
                                                    <div class="progress progress-xxs">
                                                        <div class="progress-bar progress-bar-info" style="width: {{ $mailinglist->readCache('ClickedRate', 0) }}%">
                                                        </div>
                                                    </div>
                                                    <span class="text-muted small">Click rate</span>
                                                </div>
                                            </td>
                                            {{-- <td>
                                                @if($mailinglist->status == 'Active')
                                                <span class="text-success">{{$mailinglist->status}}</span>
                                                @else
                                                <span class="text-danger">{{$mailinglist->status}}</span>
                                                @endif
                                            </td> --}}
                                            <td>{{$mailinglist->created_at->toDayDateTimeString()}}</td>
                                            <td>
                                                <a href="#" data-popup="tooltip"
                                                    title="{{ trans('messages.create_subscriber') }}" role="button" class="btn btn-secondary btn-icon " style="padding: 0.321em 0.75em">
                                                    <span class="material-icons-outlined">
                                                        person_add
                                                    </span>
                                                </a>
                                                <a href="{{ route('user.view.overview', ["username" => Auth::user()->username, "uid" => $mailinglist->uid]) }}" role="button" class="btn btn-primary me-1" style="padding: 0.321em 0.75em">
                                                    <span class="material-icons-outlined">
                                                        multiline_chart
                                                    </span> Statistics
                                                </a>
                                                {{-- <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="{{route('user.contact', [Auth::user()->username, Crypt::encrypt($mailinglist->id)])}}">Add Contact</a></li>
                                                        @if($mailinglist->status == 'Active')
                                                        <li><a class="dropdown-item" href="{{route('user.subscriber.mailing.disable', Crypt::encrypt($mailinglist->id))}}">Disable</a></li>
                                                        @else
                                                        <li><a class="dropdown-item" href="{{route('user.subscriber.mailing.enable', Crypt::encrypt($mailinglist->id))}}">Enable</a></li>
                                                        @endif
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$mailinglist->id}}">Delete</a></li>
                                                    </ul>
                                                </div>
                                                <!-- Modal START -->
                                                <div class="modal fade" id="delete-{{$mailinglist->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <form method="POST" action="{{ route('user.subscriber.mailing.delete', Crypt::encrypt($mailinglist->id))}}">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <p><b>Delete Contact</b></p>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <p>This action cannot be undone. This will permanently delete {{$mailinglist->mailinglist_name}} mailing list.</p>
                                                                                        <label>Please type DELETE to confirm.</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" name="delete_field" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <div class="boding">
                                                                                            <button type="submit" class="form-btn">
                                                                                                I understand this consquences, Delete Mailing List
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
                                                </div> --}}
                                                <!-- end modal -->
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
    </div>
</div>
<!-- END layout-wrapper -->

<!-- Modal START -->
<div class="modal fade" id="mailinglist" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div class="Editt">
                        <form method="POST" action="{{ route('user.subscriber.mailing.create') }}">
                            {{ csrf_field() }}
                            <div class="form">
                                <p>
                                    <b>
                                        Create Mailing List
                                    </b>
                                </p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Mailing List Name </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter the name of your mailing list" name="name" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <div class="boding">
                                            <button type="submit">
                                                Proceed
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
@endsection
