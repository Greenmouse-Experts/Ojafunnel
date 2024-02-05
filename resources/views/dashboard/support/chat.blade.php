@extends('layouts.dashboard-frontend')

@section('page-content')

<!-- Add this to your HTML -->
<input type="hidden" id="userID" value="{{ Auth::user()->id }}">
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
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Support</li>
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
                                    @if(Auth::user()->photo)
                                    <img id="file-ip-1-preview" class="avatar-xs rounded-circle" src="{{Auth::user()->photo}}" alt="{{Auth::user()->first_name}}" width="100%">
                                    @else
                                    <span class="avatar-xs rounded-circle" style="vertical-align: middle; align-items: center; background: #713f93; color: #fff; display: flex; justify-content: center;">{{ ucfirst(substr(Auth::user()->first_name, 0, 1)) }} {{ ucfirst(substr(Auth::user()->last_name, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15 mb-1">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h5>
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
                                        <ul id="chat-list-container" class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">
                                            @foreach($userWithMessageUser as $admin)
                                                <li class="active">
                                                    <a href="javascript: void(0);" onclick="openChatBox({{$admin['admin']}},{{Auth::user()->id}});">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 align-self-center me-3">
                                                                <i class="mdi mdi-circle font-size-10" style="color: #723f93;"></i>
                                                            </div>
                                                            <div class="flex-shrink-0 align-self-center me-3">
                                                                <span class="rounded-circle avatar-xs" style="vertical-align: middle; align-items: center; background: #713f93; color: #fff; display: flex; justify-content: center;">
                                                                    {{ ucfirst(substr($admin['admin']['first_name'], 0, 1)) }} {{ ucfirst(substr($admin['admin']['last_name'], 0, 1)) }}
                                                                </span>
                                                            </div>

                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <h5 id="{{ $admin['admin']['first_name'] }} {{ $admin['admin']['last_name'] }}" class="text-truncate font-size-14 mb-1">
                                                                    {{ $admin['admin']['first_name'] }} {{ $admin['admin']['last_name'] }}
                                                                </h5>
                                                                @if($admin['lastMessage'] && $admin['lastMessage']['message'])
                                                                    <p class="text-truncate mb-0" style="width: 150px;">{{ $admin['lastMessage']['message']}}</p>
                                                                @endif
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                @if($admin['lastMessage'] && $admin['lastMessage']['created_at'])
                                                                    <h5 class="font-size-12 mb-1">{{$admin['lastMessage']['created_at']->diffForHumans()}}</h5>
                                                                @endif
                                                                @if($admin['unreadCount'])
                                                                    <p class="badge bg-success rounded-pill">{{ $admin['unreadCount']}}</p>
                                                                @endif
                                                            </div>
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
                                <ul class="list-unstyled mb-0" id="messageThread">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        updateChatList();
        // // Refresh chat list every 5 seconds (adjust the interval as needed)
        setInterval(updateChatList, 5000);

        $(document).on('click', '.open-chat', function () {
            try {
                var admin = $(this).data('admin');
                var userId = $(this).data('user');
                openChatBox(admin, userId);
            } catch (e) {
                console.error('Error parsing JSON:', e);
                // You can add additional error handling or simply ignore the error
            }
        });
    });

    function ucfirst(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    function updateChatList() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'GET',
            url: '/support/chat',
            success: function (data) {
                // Access the admin user ID from the data attribute
                var UserId = $('#userID').val();

                console.log(data);

                // Update userWithMessageUser data
                userWithMessageUser = data.userWithMessageUser;

                // Clear the existing chat list container
                $('#chat-list-container').empty();

                // Build the updated chat list HTML
                var chatListHtml = '<ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">';

                $.each(userWithMessageUser, function (index, admin) {
                    chatListHtml += '<li class="active">';
                    chatListHtml += '<a href="javascript:void(0);" class="open-chat" data-admin=\'' + JSON.stringify(admin['admin']) + '\' data-user="' + UserId + '">';
                    chatListHtml += '<div class="d-flex">';
                    chatListHtml += '<div class="flex-shrink-0 align-self-center me-3">';
                    chatListHtml += '<i class="mdi mdi-circle font-size-10" style="color: #723f93;"></i>';
                    chatListHtml += '</div>';
                    chatListHtml += '<div class="flex-shrink-0 align-self-center me-3">';
                    chatListHtml += '<span class="rounded-circle avatar-xs" style="vertical-align: middle; align-items: center; background: #713f93; color: #fff; display: flex; justify-content: center;">';
                    chatListHtml += ucfirst(admin['admin']['first_name'].charAt(0)) + ' ' + ucfirst(admin['admin']['last_name'].charAt(0));
                    chatListHtml += '</span>';
                    chatListHtml += '</div>';
                    chatListHtml += '<div class="flex-grow-1 overflow-hidden">';
                    chatListHtml += '<h5 id="' + admin['admin']['first_name'] + ' ' + admin['admin']['last_name'] + '" class="text-truncate font-size-14 mb-1">';
                    chatListHtml += admin['admin']['first_name'] + ' ' + admin['admin']['last_name'];
                    chatListHtml += '</h5>';
                    if (admin['lastMessage'] && admin['lastMessage']['message']) {
                        chatListHtml += '<p class="text-truncate mb-0" style="width: 150px;">' + admin['lastMessage']['message'] + '</p>';
                    }
                    chatListHtml += '</div>';
                    chatListHtml += '<div class="flex-grow-1 overflow-hidden">';
                    if (admin['lastMessage'] && admin['lastMessage']['created_at']) {
                        // Format the date using Moment.js
                        var formattedDate = moment(admin['lastMessage']['created_at']).format('YYYY-MM-DD HH:mm:ss');
                        chatListHtml += '<h5 class="font-size-12 mb-1">' + moment(formattedDate).fromNow() + '</h5>';
                    }

                    if (admin['unreadCount']) {
                        chatListHtml += '<p class="badge bg-success rounded-pill">' + admin['unreadCount'] + '</p>';
                    }
                    chatListHtml += '</div>';
                    chatListHtml += '</div>';
                    chatListHtml += '</a>';
                    chatListHtml += '</li>';
                });

                chatListHtml += '</ul>';

                // Update the HTML content of the chat list container
                $('#chat-list-container').html(chatListHtml);
            },
            error: function () {
                // Handle errors if any
                console.error('Error fetching updated chat data');
            }
        });
    }

    var lastMessageId = 0;
    // auto scroll down chatbox when sending a message
    function scrollPaubos() {
        var messageThread = document.getElementById('messageThread');
        messageThread.scrollTop = messageThread.scrollHeight;
    }

    function scrollChat() {
        var chatThread = document.getElementById('latestThread');
        chatThread.scrollTop = chatThread.scrollHeight;
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
            url: '/support/checkConvo/' + user.id,
            success: function(response) {
                // console.log(response);
                inputWhoId.value = response;
                loadMessagesOfThisConvo(name);
            },
            error: function(response) {
                console.log(error);
            }
        });

        function loadMessagesOfThisConvo(name) {
            i = 0;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'GET',
                url: '/support/loadMessage/' + user.id + '/' + authUser,
                // success: function(response) {
                //     $('#messageThread').html('');
                //     // console.log(response);
                //     while (response[0][i] != null) {
                //         var isMessageRead = response[0][i].read_at !== null;
                //         if (response[1][0] == response[0][i].message_users_id) {
                //             $('#messageThread').append('<li class="right"><div class="conversation-list"><div class="ctext-wrap"><div class="conversation-name">You</div><p>' + response[0][i].message + '</p><p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i>'+ formattedTime(response[0][i].created_at) +'</p></div></div></li>');
                //         } else {
                //             $('#messageThread').append('<li class="last-chat mt-3"><div class="conversation-list"><div class="ctext-wrap"><div class="conversation-name">'+ name +'</div><p>' + response[0][i].message + '</p><p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i>'+ formattedTime(response[0][i].created_at) +'</p></div></div></li>');
                //         }
                //         lastMessageId = response[0][i].id + 1;
                //         i++;
                //     }
                //     scrollPaubos();
                //     retrieveMessages();
                // }
                success: function(response) {
                    $('#messageThread').html('');
                    // console.log(response);
                    while (response[0][i] != null) {
                        var isUserMessage = response[1] == response[0][i].user_id;
                        var isMessageRead = response[0][i].read_at !== null;

                        if (isUserMessage) {
                            $('#messageThread').append(
                                '<li class="right">' +
                                    '<div class="conversation-list">' +
                                        '<div class="ctext-wrap">' +
                                            '<div class="conversation-name">You</div>' +
                                            '<p>' + response[0][i].message + '</p>' +
                                            (isMessageRead ? '<i class="bx bx-check-double read-icon" style="color: green;"></i>' : '<p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i>') + formattedTime(response[0][i].created_at) + '</p>' +
                                        '</div>' +
                                    '</div>' +
                                '</li>'
                            );
                        } else {
                            $('#messageThread').append(
                                '<li class="last-chat mt-3">' +
                                    '<div class="conversation-list">' +
                                        '<div class="ctext-wrap">' +
                                            '<div class="conversation-name">' + name + '</div>' +
                                            '<p>' + response[0][i].message + '</p>' +
                                            '<p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i>' + formattedTime(response[0][i].created_at) + '</p>' +
                                        '</div>' +
                                    '</div>' +
                                '</li>'
                            );
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
                url: '/support/retrieveMessages/' + user.id + '/' + authUser + '/' + lastMessageId,
                success: function(response) {
                    // console.log(response);
                    //console.log(lastMessageId);
                    var shouldScroll = isScrolledToBottom(); // Check if user is already at the bottom before new messages are added

                    for (i = 0; i < response.length; i++) {
                    // Check if response[i] is defined
                        if (response[i]) {
                            var isRead = response[i].read_at !== null;
                            var messageContent = '<li class="last-chat mt-3">' +
                                '<div class="conversation-list">' +
                                '<div class="ctext-wrap">' +
                                '<div class="conversation-name">'+ name +'</div>' +
                                '<p>' + response[i].message + '</p>' +
                                '<p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i>' + formattedTime(response[i].created_at) + '</p>' +
                                '</div>' +
                                '</div>' +
                                '</li>';

                            $('#messageThread').append(messageContent);

                            lastMessageId = response[i].id + 1;

                            // Update the read_at timestamp of the retrieved message
                            // markMessageAsRead(response[i].id);

                            if (shouldScroll) {
                                scrollPaubos(); // Scroll to the bottom only if the user was already at the bottom
                            }
                        }

                    }

                },
                complete: function() {
                    retrieveMessages();
                }
            });
        }

        // Function to check if the user is scrolled to the bottom
        function isScrolledToBottom() {
            var messageThread = document.getElementById('messageThread');
            return messageThread.scrollHeight - messageThread.clientHeight <= messageThread.scrollTop + 1;
        }

        // Function to mark a message as read
        function markMessageAsRead(messageId) {
            console.log(messageId);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: '/support/markMessageAsRead/' + messageId,
                success: function(response) {
                    // Handle success if needed
                    console.log(response);
                },
                error: function(error) {
                    console.error(error);
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

        $('#messageThread').append('<li class="right"><div class="conversation-list"><div class="ctext-wrap"><div class="conversation-name">You</div><p>' + $('#messsageInput').val() + '</p><p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i>' + time + '</p></div></div></li>');
        // SEND MESSAGE TO THE CHOSEN USER
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '/support/sendMessage',
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
