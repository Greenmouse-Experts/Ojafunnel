@extends('layouts.admin-frontend')

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
                        <h4 class="mb-sm-0 font-size-18">Ojafunnel Support</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Email Support</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- main content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="row px-3 justify-content-between align-items-center">
                            <div class="py-2 col-md-7">
                                <h4 class="font-500">Email Support</h4>
                                <p>
                                    Send and receive email from support team.
                                </p>
                            </div>
                            <div class="col-md-5 row justify-content-end">
                                <div class="all-create text-end">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#sendMail">
                                        <button class="">New Mail</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <!-- messages -->
            <div class="mt-2 p-5 bg-white">
                @foreach(App\Models\OjafunnelMailSupport::latest()->where('admin_id', Auth::guard('admin')->user()->id)->get() as $ojafunnelmail)
                <div class="email-msg-box">
                    <div class='bg-white email-box' data-bs-toggle="modal" data-bs-target="#viewMail-{{$ojafunnelmail->id}}">
                        <div class="d-flex">
                            <div class=''>
                                <div class='bg-light email-img-box'>
                                    <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217513/OjaFunnel-Images/Logo-fav_d0wyqv.png' alt='profile' />
                                </div>
                            </div>
                            <div class=''>
                                <div class=''>
                                    @if($ojafunnelmail->by_who == 'User')
                                    <p class='p-0 m-0 fw-bold'>Sent from {{App\Models\User::find($ojafunnelmail->user_id)->first_name}} {{App\Models\User::find($ojafunnelmail->user_id)->last_name}}</p>
                                    @else
                                    <p class='p-0 m-0 fw-bold'>From Admininstrator - {{App\Models\User::find($ojafunnelmail->user_id)->first_name}} {{App\Models\User::find($ojafunnelmail->user_id)->last_name}}</p>
                                    @endif
                                </div>
                                <div>
                                    <p class='mb-1 mt-1'>{{$ojafunnelmail->title}}</p>
                                </div>
                                <div>
                                    <p class='fst-italic '>{{$ojafunnelmail->created_at->diffForHumans()}}</p>
                                </div>
                            </div>
                        </div>
                        <div class=''>
                            <div class='bg-light email-img-box' data-bs-toggle="modal" data-bs-target="#replyMail-{{$ojafunnelmail->id}}">
                                <img src='https://static-00.iconduck.com/assets.00/mail-reply-sender-icon-245x256-vcu9gxgm.png' alt='profile' />
                            </div>
                        </div>
                    </div>
                </div>
                @foreach(App\Models\ReplyMailSupport::latest()->where('mail_id', $ojafunnelmail->id)->get() as $reply)
                <div class="email-msg-box">
                    <div class='bg-white email-box'>
                        <div class="d-flex">
                            <div class=''>
                                <div class='bg-light email-img-box'>
                                    <img src='https://static-00.iconduck.com/assets.00/mail-reply-sender-icon-245x256-vcu9gxgm.png' alt='profile' />
                                </div>
                            </div>
                            <div class=''>
                                @if($reply->replied_by == 'admin')
                                <div class=''>
                                    <p class='p-0 m-0 fw-bold'>Reply sent to {{App\Models\User::find($ojafunnelmail->user_id)->first_name}} {{App\Models\User::find($ojafunnelmail->user_id)->last_name}}</p>
                                </div>
                                @else
                                <div class=''>
                                    <p class='p-0 m-0 fw-bold'>{{App\Models\User::find($ojafunnelmail->user_id)->first_name}} {{App\Models\User::find($ojafunnelmail->user_id)->last_name}} replied</p>
                                </div>
                                @endif
                                <div>
                                    <p class='mb-1 mt-1'>{{$reply->body}}</p>
                                </div>
                                <div>
                                    <p class='fst-italic '>{{$reply->created_at->diffForHumans()}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="modal fade" id="viewMail-{{$ojafunnelmail->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <h5 class="modal-title" id="staticBackdropLabel">
                                    @if($ojafunnelmail->by_who == 'User')
                                    Mail from {{App\Models\User::find($ojafunnelmail->user_id)->first_name}} {{App\Models\User::find($ojafunnelmail->user_id)->last_name}} (User)
                                    @else
                                    Mail to {{App\Models\User::find($ojafunnelmail->user_id)->first_name}} {{App\Models\User::find($ojafunnelmail->user_id)->last_name}} (User)
                                    @endif
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="Edit-level">
                                        <p>{{$ojafunnelmail->created_at->toDayDateTimeString()}}</p>
                                        <div>
                                            <p>{{$ojafunnelmail->body}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="replyMail-{{$ojafunnelmail->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <h5 class="modal-title" id="staticBackdropLabel">
                                    Reply {{App\Models\User::find($ojafunnelmail->user_id)->first_name}} {{App\Models\User::find($ojafunnelmail->user_id)->last_name}}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="Edit-level">
                                        <form method="post" action="{{route('replyEmailSupport', Crypt::encrypt($ojafunnelmail->id))}}">
                                            @csrf
                                            <div class="form">
                                                <div class="col-lg-12">
                                                    <label>Your Message</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <textarea name="message"></textarea>
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
                                                        <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091"
                                                            >
                                                            Send
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
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<div class="modal fade" id="sendMail" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Send Instant Mail to Ojafunnel
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="post" action="{{route('admin.send.message.user')}}">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Recipient</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <select name="name" class="input">
                                                <option value="">-- Select User --</option>
                                                @foreach(App\Models\User::latest()->get() as $user)
                                                <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Subject</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter your email..." name="subject" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Your Message</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea name="message"></textarea>
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
                                        <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091"
                                            >
                                            Send
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
<!-- END layout-wrapper -->
@endsection