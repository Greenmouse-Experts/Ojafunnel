<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ \App\Models\Setting::get("site_description") }}">
    <meta name="keywords" content="{{ \App\Models\Setting::get("site_keyword") }}" />
    <meta name="php-version" content="{{ phpversion() }}" />

	<link rel="shortcut icon" href="{{URL::asset('dash/assets/images/Logo-fav.png')}}" />

    <!-- Bootstrap Css -->
    <link href="{{URL::asset('dash/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{URL::asset('dash/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- style Css -->
    <link href="{{URL::asset('dash/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{URL::asset('dash/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('core/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css">
    <!-- Font Css-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/4.2.7/css/tooltipster.bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/4.2.7/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-light.min.css" />
    <!-- DataTables -->
    <link href="{{URL::asset('dash/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('dash/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('core/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/4.2.7/js/tooltipster.bundle.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('core/numeric/jquery.numeric.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/validate/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/autofill.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/validate.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/UrlAutofill.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('dash/assets/js/functions.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/link.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/box.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/popup.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/group-manager.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/sidebar.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/sidebar.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/list.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/anotify.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/dialog.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/iframe_modal.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/search.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/js/editor.js') }}"></script>
    <!-- Dropzone -->
	<script type="text/javascript" src="{{ URL::asset('core/dropzone/dropzone.js') }}"></script>

    @include('layouts.core._script_vars')
</head>
<body class="layout-dark topbar">
<nav class="navbar navbar-expand-xl nav-menu-dark navbar-dark bg-dark fixed-top navbar-main py-0">
    <div class="container-fluid ms-0">
        <a class="navbar-brand d-flex align-items-center me-2" href="#">
            <img style="height: 18px" class="logo" src="{{ URL::asset('images/logo_light_blue.svg') }}" alt="">
        </a>
        <button class="navbar-toggler" role="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample04">
            <ul class="navbar-nav me-auto mb-md-0">
                <li class="nav-item" rel0="HomeController">
                    <li class="d-flex align-items-center">
                        <div class="d-inline-block d-flex mr-auto align-items-center ml-1">
                            <h4 class="my-0 me-2 menu-title">{{ $campaign->name }}</h4>
                            <i class="material-icons-outlined">alarm</i>
                        </div>
                    </li>
                </li>
            </ul>
            <div class="navbar-right">
                <ul class="navbar-nav me-auto mb-md-0">
                    <li class="nav-item">
                        <a  href="javascript:;"
                            onclick="parent.$('body').removeClass('overflow-hidden');parent.$('.full-iframe-popup').fadeOut()"
                            class="nav-link d-flex align-items-center py-3 lvl-1">
                            <i class="material-icons-outlined me-2">arrow_back</i>
                            <span>{{ trans('messages.go_back') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.campaign.builderPlainEdit', [
                            'username' => Auth::user()->username,
                            'uid' => $campaign->uid
                        ]) }}"
                            class="nav-link d-flex align-items-center py-3 lvl-1">
                            <span>{{ trans('messages.campaign.plain_text_editor') }}</span>
                        </a>
                    </li>
                    @if ($campaign->plain != null)
                        <li class="d-flex align-items-center px-3">
                            <button class="btn btn-primary" onclick="$('#classic-builder-form').submit()">{{ trans('messages.save') }}</button>
                        </li>
                    @endif
                    <li>
                        <a href="javascript:;"
                            onclick="parent.$('body').removeClass('overflow-hidden');parent.$('.full-iframe-popup').fadeOut()"
                            class="nav-link close-button action black-close-button">
                            <i class="material-icons-outlined">close</i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<form style="" id="classic-builder-form" action="{{ route('user.campaign.builderPlainEdit', ['username' => Auth::user()->username, 'uid' => $campaign->uid]) }}" method="POST" class="form-validate-jqueryz">
    {{ csrf_field() }}

    <div class="row mr-0 ml-0 form-groups-bottom-0">
        <div class="col-md-9 pl-0 pb-0 pr-0 form-group-mb-0">
            @include('helpers.form_control', [
                'type' => 'textarea',
                'class' => 'campaign-plain-text',
                'name' => 'plain',
                'label' => '',
                'value' => $campaign->plain,
                'rules' => [],
                'help_class' => 'campaign',
                'disabled' => $campaign->plain == null,
            ])
        </div>
        <div class="col-md-3 pr-0 pb-0 sidebar pr-4 pt-4 pl-4" style="overflow:auto;background:#f5f5f5">
            <div>
                @if ($campaign->plain == null)
                    <p>
                        {{ trans('messages.campaign.plain.click_to_custom_html') }}
                    </p>
                    <div class="mb-4">
                        <a href="{{ action('CampaignController@customPlainOn', [
                            'uid' => $campaign->uid,
                        ]) }}" link-method="POST" class="btn btn-primary">
                            <span class="material-icons-outlined me-1">
                                dashboard_customize
                                </span>
                                {{ trans('messages.campaign.plain.use_custom_plain_content') }}
                        </a>
                    </div>
                    <hr>
                @else
                    <p>
                        {{ trans('messages.campaign.plain.automatically_extract') }}
                    </p>
                    <div class="mb-4">
                        <a href="{{ action('CampaignController@customPlainOff', [
                            'uid' => $campaign->uid,
                        ]) }}" link-method="POST" class="btn btn-primary">
                            <span class="material-icons-outlined me-1">
                                post_add
                                </span>
                                {{ trans('messages.campaign.plain.extract_from_html') }}
                        </a>
                    </div>
                    <hr>
                @endif
            </div>
            @include('elements._tags', ['tags' => Acelle\Model\Template::tags($campaign->defaultMailList)])
        </div>
    </div>
<form>

<script>
    $('#classic-builder-form').submit(function(e) {
        e.preventDefault();

        tinymce.triggerSave();

        var url = $(this).attr('action');
        var data = $(this).serialize();

        if ($(this).valid()) {
            // open builder effects
            addMaskLoading("{{ trans('messages.automation.template.saving') }}", function() {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: data,
                    statusCode: {
                        // validate error
                        400: function (res) {
                            removeMaskLoading();

                            // notify
                            parent.notify('error', '{{ trans('messages.notify.error') }}', res.responseText);
                        }
                    },
                    success: function (response) {
                        removeMaskLoading();

                        if (typeof(parent.builderSelectPopup) != 'undefined') {
                            parent.builderSelectPopup.hide();
                        }

                        // notify
                        parent.notify({
                            type: 'success',
                            title: '{!! trans('messages.notify.success') !!}',
                            message: response.message
                        });
                    }
                });
            });
        }
    });

    $('.sidebar').css('height', parent.$('.full-iframe-popup').height()-53);
    $('[name=plain]').css('height', parent.$('.full-iframe-popup').height()-53);
</script>


</body>

</html>
