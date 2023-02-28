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
                        <h4 class="mb-sm-0 font-size-18">{{ $campaign->name }}</h4>
                        {{-- @include('campaigns._steps', ['current' => 1]) --}}
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">{{ trans('messages.campaigns') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Edit">
                <div class="row">
                    <div class="col-md-10">
                        <form action="{{ route('user.campaign.recipient.post', ['username' => Auth::user()->username ,'uid' => $campaign->uid]) }}" method="POST" class="form-validate-jqueryz recipients-form">
                            {{ csrf_field() }}

                            <h4 class="mb-20 mt-0">
                                {{ trans('messages.choose_lists_segments_for_the_campaign') }}
                            </h4>

                            <div class="addable-multiple-form">
                                <div class="addable-multiple-container campaign-list-segments">
                                    <?php $num = 0 ?>
                                    @foreach ($campaign->getListsSegmentsGroups() as $index =>  $lists_segment_group)
                                        @include('dashboard.campaign._list_segment_form', [
                                            'lists_segment_group' => $lists_segment_group,
                                            'index' => $num,
                                        ])
                                        <?php $num++ ?>
                                    @endforeach
                                </div>
                                <br />
                                <a
                                    sample-url="{{ route('user.campaign.listSegmentForm', ['username' => Auth::user()->username, 'uid'=> $campaign->uid]) }}"
                                    href="#add_condition" class="btn btn-secondary add-form">
                                    <span class="material-icons-outlined" style="font-size: 17px; position: relative;top: 4px; color: #fff;" class="material-icons-outlined">
                    add
                    </span> {{ trans('messages.add_list_segment') }}
                                </a>
                            </div>

                            <hr>

                            <div class="text-end">
                                <button class="btn btn-secondary">{{ trans('messages.save_and_next') }}
                                    <span style="font-size: 17px; position: relative;top: 4px; color: #fff;" class="material-icons-outlined">
                                        arrow_forward
                                    </span>
                                </button>
                            </div>
                        <form>

                        <script>
                            var CampaignsReciepientsSegment = {
                                manager: null,

                                rowToGroup: function(row) {
                                    return {
                                        listSelect: row.find('.list-select'),
                                        url: row.find('.list-select').closest('.list_select_box').attr("segments-url"),
                                        segmentSelect: row.find('.segments-select-box'),
                                        getVal: function() {
                                            return row.find('.list-select').val();
                                        },
                                        index: row.closest('.condition-line').attr('rel')
                                    }
                                },

                                addRow: function(row) {
                                    group = this.rowToGroup(row);
                                    this.getManager().add(group);

                                    this.groupAction(group);
                                },

                                groupAction: function(group) {
                                    group.check = function() {
                                        if(group.getVal() !== '') {
                                            $.ajax({
                                                method: "GET",
                                                url: group.url,
                                                data: {
                                                    list_uid: group.getVal(),
                                                    index: group.index
                                                }
                                            })
                                            .done(function( res ) {
                                                group.segmentSelect.html(res);

                                                initJs(group.segmentSelect);
                                            });
                                        } else {
                                            group.segmentSelect.html('');
                                        }
                                    }

                                    group.listSelect.on('change', function() {
                                        group.check();
                                    });
                                },

                                getManager: function() {
                                    if (this.manager == null) {
                                        this.manager = new GroupManager();

                                        $('.condition-line').each(function() {
                                            var row = $(this);

                                            CampaignsReciepientsSegment.addRow(row);
                                        });
                                    }

                                    return this.manager;
                                },

                                check: function() {
                                    this.getManager().groups.forEach(function(group) {
                                        group.check();
                                    });
                                }
                            }

                            $(function() {
                                CampaignsReciepientsSegment.getManager();


                                $('.recipients-form').submit(function(e) {
                                    if (!$('[radio-group=campaign_list_info_defaulf]:checked').length) {
                                        new Dialog('alert', {
                                            message: '{{ trans('messages.recipients.select_default_list.warning') }}',
                                        });

                                        e.preventDefault();
                                        return false;
                                    }
                                });

                                // addable multiple form
                                $(document).on("click", ".addable-multiple-form .add-form", function(e) {
                                    var form = $(this).parents('.addable-multiple-form');
                                    var container = form.find('.addable-multiple-container');
                                    var status = $(this).attr('automation-status');

                                    if(status == 'active') {
                                        //show disable automation confirm
                                        $('#disable_automation_confirm').modal('show');
                                        return;
                                    }

                                    // ajax update custom sort
                                    $.ajax({
                                        method: "GET",
                                        url: $(this).attr('sample-url'),
                                    })
                                    .done(function( msg ) {
                                        var num = "0";

                                        if(container.find('.condition-line').length) {
                                            num = parseInt(container.find('.condition-line').last().attr("rel"))+1;
                                        }

                                        msg = msg.replace(/__index__/g, num);

                                        container.append(msg);

                                        var new_line = container.find('.condition-line').last();

                                        if(new_line.find('.event-campaigns-container').length) {
                                            loadAutomationEmail(new_line.find('.event-campaigns-container'));
                                        }

                                        initJs(new_line);

                                        CampaignsReciepientsSegment.addRow(new_line);
                                    });
                                });

                                // radio group check
                                $(document).on('change', '[radio-group]', function() {
                                    var checked = $(this).is(':checked');
                                    var group = $(this).attr('radio-group');

                                    if(checked) {
                                        $('[radio-group="' + group + '"]').prop('checked', false);
                                        $(this).prop('checked', true);
                                    }
                                });
                            });

                            function loadAutomationEmail(container) {
                                var url = container.attr('data-url');

                                $.ajax({
                                    method: "GET",
                                    url: url
                                })
                                .done(function( data ) {
                                    container.html(data);
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var CampaignsIndex = {
                getList: function() {
                    return makeList({
                        url: '{{ route('user.campaign.list', ['username' => Auth::user()->username]) }}',
                        container: $('#CampaignsIndexContainer'),
                        content: $('#CampaignsIndexContent')
                    });
                }
            };

            $(document).ready(function() {
                console.log(CampaignsIndex.getList())
                CampaignsIndex.getList().load();
            });
        </script>
    </div>
</div>
@endsection
