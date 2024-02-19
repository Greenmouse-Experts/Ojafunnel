@extends('layouts.dashboard-frontend')

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
                        <h4 class="mb-sm-0 font-size-18">Email Campaigns Series</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Email Campaigns Series</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4 class="font-500">Email Campaigns Series</h4>
                                    <p>
                                        All your Email Campaigns Series in one Place
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="store-table">
                    <div class="table-head row pt-4">
                        <div class="col-lg-12">
                            <h4>Campaigns Series</h4>
                        </div>
                    </div>
                    <div class="table-body mt-1 table-responsive">
                        <table id="datatable-buttons" class=" table table-bordered dt-responsive nowrap w-100">
                            <thead class="fw-bold dark" style="background:#F5E6FE;">
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Campaign Name</th>
                                    <th scope="col">Day</th>
                                    <th scope="col">Template Id</th>
                                    <th scope="col">Attachment</th>
                                    <th scope="col">Sent</th>
                                    <th scope="col">Failed</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            @foreach($series as $key => $campaign)
                            <tbody>
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>
                                        <p class='text-bold-600'> {{$campaign->campaign->name}} </p>
                                        <p class='text-muted'>Created at: {{$campaign->campaign->created_at->toDayDateTimeString()}}</p>
                                    </td>
                                    <td>
                                        {{$campaign->day}}
                                    </td>
                                    <td>
                                        {{$campaign->email_template_id}}
                                    </td>
                                    <td>
                                        {{$campaign->attachment_paths ? count(json_decode($campaign->attachment_paths)) : 0}}
                                    </td>
                                    <td>
                                        {{$campaign->sent}}
                                    </td>
                                    <td>
                                        {{$campaign->bounced}}
                                    </td>
                                    <td>
                                        @if($campaign->action == 'Play')
                                        <span class="bg-success p-2" style="color: #fff;">{{$campaign->action}}</span>
                                        @endif
                                        @if($campaign->action == 'Pause')
                                        <span class="bg-danger p-2" style="color: #fff;">{{$campaign->action}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown dropstart">
                                            <button class="btn-list btn bg-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true">
                                                Options
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <a class="dropdown-item edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#edit-{{$campaign->id}}" data-campaign-id="{{$campaign->id}}" data-campaign-day="{{$campaign->day}}">
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('user.email.automation.action.series', Crypt::encrypt($campaign->id))}}" type="button">
                                                        @if($campaign->action == 'Play') Pause @else Play @endif
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#delete-{{$campaign->id}}">
                                                        Delete
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="edit-{{$campaign->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content pb-3">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-title" id="staticBackdropLabel">
                                                                Edit
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <div class="row">
                                                                <div class="Editt">
                                                                    <form method="POST" action="{{ route('user.email.automation.update.series', Crypt::encrypt($campaign->id))}}" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <div class="row">
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="datesSelect">Series</label>
                                                                                    <select id="datesSelect-{{$campaign->id}}" name="date"></select>
                                                                                    <input id="inputdateSelect" value="{{$campaign->id}}" hidden>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label>Email Template</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <select name="email_template_id" class="bg-light w-100 py-2 rounded px-2 fs-6" onchange="loadTemplate()" id="email_template_id">
                                                                                                <option value="">Choose from email template</option>
                                                                                                @forelse ($email_templates as $email_template)
                                                                                                    <option value="{{ $email_template->id }}" @if($campaign->email_template_id == $email_template->id) selected @endif>
                                                                                                        {{  $email_template->name }}
                                                                                                    </option>
                                                                                                @empty
                                                                                                    {{ 'No email template at the moment. Please add new template' }}
                                                                                                @endforelse
                                                                                            </select>
                                                                                            <div id="email_template_editor"></div>
                                                                                            <div id="email_template_data"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label>Attachment <b>Attach, images, videos, audios or files</b></label>
                                                                                    <div class="logo-input2 border-in py-5 px-2">
                                                                                        <div class="avatar">
                                                                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664984753/OjaFunnel-Images/Vectoor_rbkrfl.png" alt="">
                                                                                        </div>
                                                                                        <div class="logo-file">
                                                                                            <input type="file" name="attachments[]" id="" multiple/>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6"></div>
                                                                                <div class="col-6">
                                                                                    <div class="row">
                                                                                        <div class="boding">
                                                                                            <button type="submit">
                                                                                                Update
                                                                                            </button>
                                                                                        </div>
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
                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="delete-{{$campaign->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content pb-3">
                                                        <div class="modal-header border-bottom-0">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <div class="row">
                                                                <div class="Editt">
                                                                    <form method="POST" action="{{ route('user.email.automation.delete.series', Crypt::encrypt($campaign->id))}}">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <p><b>Delete Email Series</b></p>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <p>This action cannot be undone. <br>This will permanently delete this email series.</p>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <div class="boding">
                                                                                        <button type="submit" class="form-btn">
                                                                                            I understand this consquences, Delete Sms Series
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
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js"></script>
<script src="http://cdn.ckeditor.com/4.21.0/standard-all/ckeditor.js"></script>
<script>
    // jQuery code
    $(document).ready(function() {
       // Function to fetch dates
        function fetchDates(campaignId, campaignDay) {
            $.ajax({
                url: '/getDates',
                type: 'GET',
                success: function(response) {
                    // Generate the ID of the select element based on the campaignId
                    var selectId = 'datesSelect-' + campaignId;
                    // Get the select element using the generated ID
                    var select = $('#' + selectId);
                    select.empty(); // Clear existing options

                    // Add "Immediately Joined" option
                    select.append('<option value="' + response[0] + ' ij">Immediately Joined</option>');
                    // Add "Same Day Joined" option
                    select.append('<option value="' + response[1] + ' sdj">Same Day Joined</option>');

                    // Loop through the rest of the days
                    for (var i = 2; i < response.length; i++) {
                        var dayNumber = i - 1; // Adjust day number to start from 1
                        var option = $('<option></option>').val(response[i] + '-' + dayNumber).text('Day ' + dayNumber);

                        // Check if the dayNumber matches the campaign's day value
                        if (dayNumber == campaignDay) {
                            option.attr('selected', 'selected'); // Set the 'selected' attribute
                        }

                        select.append(option);
                    }

                    // Trigger change event on select box to update the input box with the selected day number
                    select.trigger('change');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Attach click event listener to edit buttons
        $(document).on('click', '.edit-btn', function() {
            // Fetch dates when edit button is clicked
            // Get the campaign ID from the data attribute
            var campaignId = $(this).data('campaign-id');
            var campaignDay = $(this).data('campaign-day');

            fetchDates(campaignId, campaignDay);
        });
    });

    async function loadTemplate() {
        document.getElementById('email_template_editor').innerHTML = `<textarea class="mt-2" cols="80" id="editor" name="email_template"></textarea>`

        let id = document.getElementById('email_template_id').value

        let endpoint = "{{ route('user.email-marketing.email.campaigns.template_content', ['username' => Auth::user()->username, 'id' => '?']) }}".replace('?', id)
        let { data } = await axios.get(endpoint)

        if(data.success) {
            document.getElementById('editor').innerHTML = data.data;

            CKEDITOR.replace('editor', {
                fullPage: true,
                extraPlugins: 'docprops',
                allowedContent: true,
                height: 320,
                removeButtons: 'PasteFromWord',
                removePlugins: 'sourcearea'
            });
        } else document.getElementById('editor').style.display = 'none';
    }
</script>
@endsection
