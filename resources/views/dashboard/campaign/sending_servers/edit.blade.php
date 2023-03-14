@extends('layouts.dashboard-email-frontend')

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
                    @foreach ($notices as $n)
                        @include('elements._notification', [
                            'level' => 'warning',
                            'title' => $n['title'],
                            'message' => htmlspecialchars($n['message']),
                        ])
                    @endforeach
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">{{ $server->name }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user.sending-server.index', Auth::user()->username)}}">{{ trans('messages.sending_servers') }}</a></li>
                                <li class="breadcrumb-item active">
                                    <span class="text-semibold">{{ trans('messages.edit') }}</span>
                                </li>
                            </ol>
                        </div>
                        <h1>
                            <div class="d-flex align-items-center">
                                <span class="text-semibold me-3"><span class="material-icons-outlined">
                    edit
                    </span>
                                    {{ $server->name }}
                                </span>

                                <span class="label label-flat bg-{{$server->status}}">{{$server->status}}</span>
                            </div>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @include('dashboard.campaign.sending_servers.form.' . $server->type, ['identities' => $identities, 'bigNotices' => $bigNotices])

                <script>
                    var SendTestEmail = {
                        popup: null,
                        url: '{{ route('user.sending-server.test', ['username' => Auth::user()->username, 'uid' => $server->uid]) }}',

                        getPopup: function() {
                            if (this.popup == null) {
                                this.popup = new Popup({
                                    url: this.url
                                });
                            }

                            return this.popup;
                        }
                    }
                    $(function() {
                        $('#SendTestEmailButton').on('click', function(e) {
                            e.preventDefault();

                            SendTestEmail.getPopup().load();
                        });
                    });
                </script>

                <script>
                    $(function() {
                        $('.test-connection-button').on('click', function(e) {
                            e.preventDefault();
                            var button = $(this);
                            var url = $(this).attr('href');

                            new Link({
                                type: 'ajax',
                                url: url,
                                method: 'POST',
                                data: {
                                    _token: CSRF_TOKEN,
                                },
                                before: function() {
                                    addButtonMask(button);
                                },
                                done: function(response) {
                                    new Dialog('alert', {
                                        title: LANG_SUCCESS,
                                        message: response
                                    });

                                    removeButtonMask(button);
                                }
                            });
                        });

                        var manager = new GroupManager();
                        manager.add({
                            editBox: $('#editServerForm .edit-group'),
                            editButton: $('#editServerForm .edit-group .switch-form-toggle'),
                            cancelBox: $('#editServerForm .cancel-group'),
                            cancelButton: $('#editServerForm .cancel-group .switch-form-toggle'),
                            form: $('#editServerForm'),
                        });
                        manager.bind(function(group) {
                            group.cancelButton.on('click', function() {
                                group.form.find('input, select').prop('disabled', true);

                                group.editBox.removeClass('hide');
                                group.cancelBox.addClass('hide');
                            });
                            group.editButton.on('click', function() {
                                group.form.find('input, select').prop('disabled', false);

                                group.editBox.addClass('hide');
                                group.cancelBox.removeClass('hide');
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection








