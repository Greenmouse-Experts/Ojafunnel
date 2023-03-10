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
                        <h4 class="mb-sm-0 font-size-18">{{ $list->name . " - " . number_with_delimiter($list->readCache('SubscriberCount')) . " " . trans('messages.subscribers') }}</h4>
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
                <div class="col-md-12">
                    @include("dashboard.campaign.lists._menu")

                    <h2 class="text-semibold text-primary my-4">{{ trans('messages.Embedded_form') }}</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-semibold">{{ trans('messages.options') }}</h4>
                            <form id="EmbeddedForm" action="{{ route("user.list.embeddedForm", ['username' => Auth::user()->username, 'uid' => $list->uid]) }}" class="embedded-options-form">
                                {{ csrf_field() }}
                                <div class="d-flex justify-content-space-between" style="width:100%;justify-content: space-between">
                                    <div class="me-4">
                                        @include('helpers.form_control', ['type' => 'text',
                                                'name' => 'options[form_title]',
                                                'label' => trans('messages.form_title'),
                                                'value' => $list->getEmbeddedFormOption('form_title'),
                                                'help_class' => 'list'
                                        ])

                                        @include('helpers.form_control', ['type' => 'text',
                                                'name' => 'options[redirect_url]',
                                                'label' => trans('messages.list.embedded_form.redirect_url'),
                                                'value' => $list->getEmbeddedFormOption('redirect_url'),
                                                'help_class' => 'list',
                                                'placeholder' => trans('messages.list.redirect_url.placeholder'),
                                        ])
                                    </div>
                                    <div class="me-4">
                                        <div class="form-group">
                                            <label>{!! trans('messages.show_only_required_fields', ["link" => route('user.field.index', ['username' => Auth::user()->username, 'list_uid' => $list->uid])]) !!}</label>
                                            <div class="notoping">
                                                @include('helpers.form_control', ['type' => 'checkbox',
                                                    'name' => 'options[only_required_fields]',
                                                    'label' => '',
                                                    'value' => $list->getEmbeddedFormOption('only_required_fields'),
                                                    'options' => ['no','yes'],
                                                    'help_class' => 'list'
                                                ])
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>{{ trans('messages.stylesheet_included') }}</label>
                                            <div class="notoping">
                                                @include('helpers.form_control', ['type' => 'checkbox',
                                                    'name' => 'options[stylesheet]',
                                                    'label' => '',
                                                    'value' => $list->getEmbeddedFormOption('stylesheet'),
                                                    'options' => ['no','yes'],
                                                    'help_class' => 'list'
                                                ])
                                            </div>
                                        </div>
                                    </div>
                                    <div class="me-4">
                                        <div class="form-group">
                                            <label>{{ trans('messages.include_javascript') }}</label>
                                            <div class="notoping">
                                                @include('helpers.form_control', ['type' => 'checkbox',
                                                    'name' => 'options[javascript]',
                                                    'label' => '',
                                                    'value' => $list->getEmbeddedFormOption('javascript'),
                                                    'options' => ['no','yes'],
                                                    'help_class' => 'list'
                                                ])
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ trans('messages.embeded_form.show_invisible') }}</label>
                                            <div class="notoping">
                                                @include('helpers.form_control', ['type' => 'checkbox',
                                                    'name' => 'options[show_invisible]',
                                                    'label' => '',
                                                    'value' => $list->getEmbeddedFormOption('show_invisible'),
                                                    'options' => ['no','yes'],
                                                    'help_class' => 'list'
                                                ])
                                            </div>
                                        </div>
                                    </div>
                                    <div class="" style="width: 440px">

                                                @include('helpers.form_control', ['type' => 'textarea',
                                                    'name' => 'options[custom_css]',
                                                    'class' => 'height-100 text-small',
                                                    'label' => trans('messages.custom_css'),
                                                    'value' => $list->getEmbeddedFormOption('custom_css'),
                                                    'help_class' => 'list'
                                                ])

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr />
                    <div class="embedded-form-result">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <h4 class="text-semibold me-auto">{{ trans('messages.Copy_paste_onto_your_site') }}</h4>
                                    <div>
                                        <a href="javascript:;" onclick="copyToClipboard(htmlDecode($('.main-code').html()));
                                        notify('success', '{{ trans('messages.notify.success') }}', '{{ trans('messages.embedded_form_code.copied') }}');" class="btn btn-sm btn-light copy-clipboard">
                                            <span class="material-icons-outlined">
                                                content_copy
                                                </span> {{ trans('messages.copy') }}</a>
                                    </div>
                                </div>

                                    <pre class="language-markup content-group embedded-code"><code></code></pre>
                                    <code style="height: 400px" class="form-control main-code hide">@include("dashboard.campaign.lists._embedded_form_content")</code>
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-semibold">{{ trans('messages.preview') }}</h4>
                                <iframe class="embedded_form" src="{{ route("user.list.embeddedFormFrame", ['username' => Auth::user()->username, 'uid' => $list->uid]) }}"></iframe>
                            </div>
                        </div>
                    </div>



                    <script>
                        var EmbeddedForm = {
                            formatCopyCode: function() {
                                var bio_text = $(".main-code").html();
                                bio_text = bio_text.replace(/\</g, '&lt;');
                                bio_text = bio_text.replace(/script_tmp/g, 'script');
                                bio_text = bio_text.replace(/\t/g, '');
                                bio_text = bio_text.replace(/\n/g, '');
                                bio_text = bio_text.replace(/\s+/g, ' ');
                                bio_text = bio_text.replace(/\>\s*&lt;/g, "&gt;\n&lt;");
                                bio_text = bio_text.replace(/\s+\{\s+/g, "{");
                                $("code").html(bio_text);

                                // Hightlight code
                                Prism.highlightAll();
                            },

                            save: function() {
                                var form = $('#EmbeddedForm');
                                var url = form.attr('action');
                                var data = form.serialize();

                                $.ajax({
                                    method: "POST",
                                    url: url,
                                    data: data
                                })
                                .done(function( msg ) {
                                    var html = $("<div>").html(msg).find(".embedded-form-result").html();
                                    $(".embedded-form-result").html(html);

                                    EmbeddedForm.formatCopyCode();
                                });
                            },
                        };

                        $(function() {
                            EmbeddedForm.formatCopyCode();

                            //
                            $(document).on("change keyup", ".embedded-options-form :input", function() {
                                var url = $(this).parents("form").attr("action");

                                EmbeddedForm.save();
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



