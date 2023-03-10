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
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">{{ $list->name . ": " . trans('messages.create_subscriber') }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("user.list.index", Auth::user()->username) }}">{{ trans('messages.lists') }}</a></li>
                                <li class="breadcrumb-item">
                                    <div class="btn-group other-lists" style="margin-top: -4px;">
                                        <button role="button" class="btn dropdown-toggle text-teal-600 change-list-button" data-bs-toggle="dropdown">{{ trans('messages.change_list') }} <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-left">
                                            @forelse ($list->otherLists() as $l)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('user.list.overview', ['username' => Auth::user()->username, 'uid' => $l->uid]) }}">
                                                        {{ $l->readCache('LongName', $l->name) }}
                                                    </a>
                                                </li>
                                            @empty
                                                <li><a href="#">({{ trans('messages.empty') }})</a></li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </li>
                            </ol>
                        </div>

                    </div>
                    <h1>
                        <span class="text-semibold">{{ $list->name }}</span>
                    </h1>
                    <span class="badge badge-info bg-info-800 badge-big">{{ number_with_delimiter($list->readCache('SubscriberCount')) }}</span> {{ trans('messages.subscribers') }}
                </div>
            </div>
            <div class="row">
                @include("dashboard.campaign.lists._menu")
                <div class="col-md-12">
                    <h2 class="text-semibold text-primary my-4"><span class="material-icons-outlined">
                        add
                        </span> {{ trans('messages.create_segment') }}</h2>

                            <form action="{{ route('user.segment.store', ['username' => Auth::user()->username, 'list_uid' => $list->uid]) }}" method="POST" class="form-validate-jqueryz">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-12">
                                        @include("dashboard.campaign.segment._form")
                                        <hr>
                                        <div class="text-left">
                                            <button class="btn btn-secondary me-2"><i class="icon-check"></i> {{ trans('messages.save') }}</button>
                                            <a href="{{ route('user.segment.index', ['username' => Auth::user()->username, 'uid' => $list->uid]) }}" class="btn btn-link"><i class="icon-cross2"></i> {{ trans('messages.cancel') }}</a>
                                        </div>
                                    </div>
                                </div>
                            <form>

                            <script>
                                // add segment condition
                                $(document).on("click", ".add-segment-condition", function(e) {
                                    // ajax update custom sort
                                    $.ajax({
                                        method: "GET",
                                        url: $(this).attr('sample-url'),
                                    })
                                    .done(function( msg ) {
                                        var num = "0";

                                        if($('.segment-conditions-container .condition-line').length) {
                                            num = parseInt($('.segment-conditions-container .condition-line').last().attr("rel"))+1;
                                        }

                                        msg = msg.replace(/__index__/g, num);

                                        $('.segment-conditions-container').append(msg);

                                        var new_line = $('.segment-conditions-container .condition-line').last();
                                        new_line.find('select').select2({
                                            templateResult: formatSelect2TextOption,
                                            templateSelection: formatSelect2TextSelected
                                        });
                                        new_line.find('select').trigger('change');
                                    });
                                });

                                // add segment condition
                                $(document).on("change", ".condition-line .operator-col select", function(e) {
                                    var op = $(this).val();

                                    if(op == 'blank' || op == 'not_blank') {
                                        $(this).parents(".condition-line").find('.value-col').css("visibility", "hidden");
                                    } else {
                                        $(this).parents(".condition-line").find('.value-col').css("visibility", "visible");
                                    }
                                });

                                // Segment condition field type select
                                $(document).on('change', '.condition-field-select', function() {
                                    var line = $(this).parents('.condition-line');
                                    var field_uid = $(this).val();
                                    var value_col = line.find('.operator_value_col');
                                    var url = value_col.attr('data-url');
                                    var index = line.attr('rel');
                                    var operator = line.find('.operator-col select').val();

                                    value_col.html('');

                                    if (field_uid != '') {
                                        $.ajax({
                                            type: 'GET',
                                            url: url,
                                            data: {
                                                field_uid: field_uid,
                                                index: index,
                                                operator: field_uid
                                            }, // serializes the form's elements.
                                            success: function(data)
                                            {
                                                value_col.html(data);
                                                value_col.find('select').select2();
                                            }
                                        });
                                    }
                                });
                            </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

