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
                        <h4 class="mb-sm-0 font-size-18">Chat Support</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Chat Support</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- main content -->

            <div class="d-lg-flex">
                <div class="chat-leftsidebar me-lg-4">
                    <div class="">
                        <div class="py-4 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0 align-self-center me-3">
                                    <span class="avatar-xs rounded-circle" style="vertical-align: middle; align-items: center; background: #713f93; color: #fff; display: flex; justify-content: center;">{{ ucfirst(substr(Auth::guard('admin')->user()->name, 0, 1)) }}</span>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15 mb-1">{{Auth::guard('admin')->user()->name}}</h5>
                                    <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active</p>
                                </div>
                            </div>
                        </div>

                        <div class="chat-leftsidebar-nav">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a href="#chat" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                        <i class="bx bx-chat font-size-20 d-sm-none"></i>
                                        <span class="d-none d-sm-block">Chat</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content py-4">
                                <div class="tab-pane show active" id="chat">
                                    <div>
                                        <h5 class="font-size-14 mb-3">Chat</h5>
                                        <ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">
                                            @foreach(App\Models\User::get() as $user)
                                            <li class="active">
                                                <a href="javascript: void(0);" onclick="openChatBox({{$user}},{{Auth::guard('admin')->user()->id}});">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 align-self-center me-3">
                                                            <i class="mdi mdi-circle font-size-10" style="color: #723f93;"></i>
                                                        </div>
                                                        <div class="flex-shrink-0 align-self-center me-3">
                                                            <span class="rounded-circle avatar-xs" style="vertical-align: middle; align-items: center; background: #713f93; color: #fff; display: flex; justify-content: center;">{{ ucfirst(substr($user->first_name, 0, 1)) }} {{ ucfirst(substr($user->last_name, 0, 1)) }}</span>
                                                        </div>

                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 id="{{ $user->first_name }} {{ $user->last_name }}" class="text-truncate font-size-14 mb-1">{{$user->first_name}} {{$user->last_name}}</h5>
                                                            <p class="text-truncate text-success mb-0">Online</p>
                                                        </div>
                                                        <!-- <div class="font-size-11">05 min</div> -->
                                                    </div>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-100 user-chat" id="default_card">
                    <div class="card" style="height: 100%; display: flex; justify-content: center;">
                        <div class="chat-conversation p-3">
                            <h5 class="text-center" style="font-size: 2rem">Start a new chat</h5>
                        </div>
                    </div>
                </div>

                <div class="w-100 user-chat" id="active_card" style="display:none;">
                    <div class="card">
                        <div class="p-4 border-bottom ">
                            <div class="row">
                                <div class="col-md-4 col-9">
                                    <h5 class="font-size-15 mb-1" id="chatWithName">(Name of Selected Admin)</h5>
                                    <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active now</p>
                                </div>
                            </div>
                        </div>


                        <div>
                            <div class="chat-conversation p-3" id="latestThread" style="padding-top: 10px; padding-bottom: 10px; overflow-x: hidden; overflow-y: auto; height: 600px;">
                                <ul class="list-unstyled mb-0" id="messageThread" data-simplebar style="max-height: 486px;">
                                    <h3 id="loadingMessages">Loading . . .</h3>

                                </ul>
                            </div>
                            <div class="p-3 chat-input-section">
                                <form method="POST" onsubmit="submitMessage();">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="position-relative">
                                                <input type="hidden" id="convo_id" name="convo_id" required>
                                                <input type="text" class="form-control chat-input" name="message" id="messsageInput" placeholder="Enter Message...">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Page-content -->
</div>

<script>
    var lastMessageId = 0;
    // auto scroll down chatbox when sending a message
    function scrollPaubos() {
        var a = document.getElementById('messageThread');
        a.scrollTop = a.scrollHeight;
    }

    function scrollChat() {
        var a = document.getElementById('latestThread');
        a.scrollTop = a.scrollHeight;
    }

    // when choosing a user to message
    function openChatBox(user, authUser) {
        $('#messageThread').html('<h3 class="text-center"> Loading. . .');

        $('#default_card').hide();
        $('#active_card').show();
        var who = document.getElementById('chatWithName');
        var inputWhoId = document.getElementById('convo_id');
        who.innerHTML = user.first_name + ' ' + user.last_name;
        var name = user.first_name + ' ' + user.last_name;

        //Check if the conversation exist in database. Create if not
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'GET',
            url: '/admin/page/support/checkConvo/' + user.id,
            success: function(response) {
                // console.log(response);
                inputWhoId.value = response;
                loadMessagesOfThisConvo(name);
            },
            error: function(response) {
                console.log(response);
            }
        });

        function loadMessagesOfThisConvo(name) {
            i = 0;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'GET',
                url: '/admin/page/support/loadMessage/' + user.id + '/' + authUser,
                success: function(response) {
                    $('#messageThread').html('');
                    // console.log(response);
                    while (response[0][i] != null) {
                        if (response[1][0] == response[0][i].message_users_id) {
                            $('#messageThread').append('<li class="right"><div class="conversation-list"><div class="ctext-wrap"><div class="conversation-name">You</div><p>' + response[0][i].message + '</p><p class="chat-time mb-0"><i class="bx bx-check-double align-middle me-1"></i>'+ formattedTime(response[0][i].created_at) +'</p></div></div></li>');
                        } else {
                            $('#messageThread').append('<li class="last-chat mt-3"><div class="conversation-list"><div class="ctext-wrap"><div class="conversation-name">'+ name +'</div><p>' + response[0][i].message + '</p><p class="chat-time mb-0"><i class="bx bx-check-double align-middle me-1"></i>'+ formattedTime(response[0][i].created_at) +'</p></div></div></li>');
                        }
                        lastMessageId = response[0][i].id + 1;
                        i++;
                    }
                    scrollPaubos();
                    retrieveMessages();
                }
            });
        }

        function formattedTime(currentISOtime) {
            const timestamp = new Date(currentISOtime);
            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thru', 'Fri', 'Sat'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            const addZeroOffset = timeObject => {
                if (timeObject < 10) return '0' + timeObject;

                return timeObject;
            }

            const timeformat = `${days[timestamp.getDay()]}, ${months[timestamp.getMonth()]} ${addZeroOffset(timestamp.getDate())} | ${addZeroOffset(timestamp.getHours())}:${addZeroOffset(timestamp.getMinutes())}`;
            return timeformat;
        }

        function retrieveMessages() {
            i = 0;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'GET',
                url: '/admin/page/support/retrieveMessages/' + user.id + '/' + authUser + '/' + lastMessageId,
                success: function(response) {
                    console.log(response);
                    //console.log(lastMessageId);
                    while (response[i] != null) {
                        $('#messageThread').append('<li class="last-chat mt-3"><div class="conversation-list"><div class="ctext-wrap"><div class="conversation-name">'+ name +'</div><p>' + response[i].message + '</p><p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i>'+ formattedTime(response[i].created_at) +'</p></div></div></li>');
                        lastMessageId = response[i].id + 1;
                        i++;
                    }
                    // scrollChat();
                },
                complete: function() {
                    retrieveMessages();
                }
            });
        }
    }

    function copyToClipboard(element) {
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }

    function submitMessage() {
        event.preventDefault();
        var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

        $('#messageThread').append('<li class="right"><div class="conversation-list"><div class="ctext-wrap"><div class="conversation-name">You</div><p>' + $('#messsageInput').val() + '</p><p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i>'+ time +'</p></div></div></li>');
        // SEND MESSAGE TO THE CHOSEN USER
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '/admin/page/support/sendMessage',
            data: {
                'convo_id': $('#convo_id').val(),
                'message': $('#messsageInput').val()
            },
            success: function(response) {
                //console.log(response);
            },
            error: function(response) {
                console.log(error);
            }
        });
        $('#messsageInput').val('');
        scrollChat();
    }
</script>
@endsection
