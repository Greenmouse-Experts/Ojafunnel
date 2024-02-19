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
                        <h4 class="mb-sm-0 font-size-18">SMS Campaigns</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user.sms.automation', Auth::user()->username)}}">SMS Campaigns</a></li>
                                <li class="breadcrumb-item active">SMS Series</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- start page title -->
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">My SMS Campaigns Series</h4>
                            <p>
                                View your sent and scheduled sms series to your customers
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card">
                        <div class="card-body">
                            <!-- <p class="cash">Explainer Video Here</p> -->
                            @if(App\Models\ExplainerContent::where('menu', 'Automation')->exists())
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                <i class="bi bi-play-btn"></i>
                            </div>
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                <i class="bi bi-card-text"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- store data information-->
            <div class="">
                <div class="store-table">
                    <div class="table-head row pt-4">
                        <div class="col-lg-12">
                            <h4>Campaigns Series</h4>
                        </div>
                    </div>
                    <div class="table-body mt-1 table-responsive">
                        <table id="datatable-buttons" class=" table table-bordered dt-responsive nowrap w-100">
                            <thead  class="fw-bold dark" style="background:#F5E6FE;">
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Campaign Name</th>
                                    <th scope="col">Day</th>
                                    <th scope="col">Message</th>
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
                                        <p class='text-bold-600'> {{$campaign->campaign->title}} </p>
                                        <p class='text-muted'>Created at: {{$campaign->campaign->created_at->toDayDateTimeString()}}</p>
                                    </td>
                                    <td>
                                        {{$campaign->day}}
                                    </td>
                                    <td>
                                        {{$campaign->message}}
                                    </td>
                                    <td>
                                        {{$campaign->DeliveredCount}}
                                    </td>
                                    <td>
                                        {{$campaign->FailedDeliveredCount}}
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
                                            <button class="btn-list dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true">
                                            Options
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <a class="dropdown-item edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#edit-{{$campaign->id}}" data-campaign-id="{{$campaign->id}}" data-campaign-day="{{$campaign->day}}">
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('user.automation.action.series', Crypt::encrypt($campaign->id))}}" type="button" >
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
                                                                    <form method="POST" action="{{ route('user.automation.update.series', Crypt::encrypt($campaign->id))}}">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <div class="row">
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="datesSelect">Series</label>
                                                                                    <select id="datesSelect-{{$campaign->id}}" name="date"></select>
                                                                                    <input id="inputdateSelect" value="{{$campaign->id}}" hidden>
                                                                                </div>
                                                                                <div class="col-lg-12" id="message">
                                                                                    <label>SMS Message</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <textarea name="message" id="message" cols="30" rows="5" placeholder="Enter the message you would like to send to the reciepient(s) details below " value="{{$campaign->message}}" required>{{$campaign->message}}</textarea>
                                                                                            <div class="messageCounter" id="the-count"><span id="characters">0</span></div>
                                                                                            <span class="text-danger">160 characters length per message</span>
                                                                                            <br>
                                                                                            <p>
                                                                                                <code>$name</code> can be used in this message. <br>
                                                                                            </p>
                                                                                            <p class="text-danger">Note: Message must comply with SMS provider rules.</p>
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
                                                                    <form method="POST" action="{{ route('user.automation.delete.series', Crypt::encrypt($campaign->id))}}">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <p><b>Delete Sms Series</b></p>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <p>This action cannot be undone. <br>This will permanently delete this sms series.</p>
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
            <!-- end page title -->
        </div>
    </div>
</div>

<style>
    .btn-list{
        border: 0;
        padding: 5px 10px;
        border-radius: 5px;
        color: #7b7676;
    }
    .btn-list .material-icons-outlined{
        font-size: 16px;
    }
    .dropdown-item .material-icons-outlined{
        font-size: 15px;
    }
    .dropdown{
        display: inline;
    }
    .Type span {
        color: #000 !important;
    }
</style>
@if(App\Models\ExplainerContent::where('menu', 'Automation')->exists())
<!-- end modal -->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="400">
                                <source src="{{App\Models\ExplainerContent::where('menu', 'Automation')->first()->video}}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Text Explainer</h4>
                        <div class="aller">
                            <p>
                                {{App\Models\ExplainerContent::where('menu', 'Automation')->first()->text}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->
@endif
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

        // Update character count when typing in any series message textarea
        $(document).on('keyup', '.series-message', function() {
            var characterCount = $(this).val().length;
            var current = $(this).siblings('.messageCounter').find('.series-characters');
            current.text(characterCount);
            // Add your character count styling logic here if needed
        });
    });

    $('textarea').keyup(function() {

        var characterCount = $(this).val().length,
        current = $('#characters'),
        // maximum = $('#maximum'),
        theCount = $('#the-count');

        current.text(characterCount);

        /*This isn't entirely necessary, just playin around*/
        if (characterCount < 70) {
        current.css('color', '#666');
        }
        if (characterCount > 70 && characterCount < 90) {
        current.css('color', '#6d5555');
        }
        if (characterCount > 90 && characterCount < 100) {
        current.css('color', '#793535');
        }
        if (characterCount > 100 && characterCount < 120) {
        current.css('color', '#841c1c');
        }
        if (characterCount > 120 && characterCount < 139) {
        current.css('color', '#8f0001');
        }

        if (characterCount >= 140) {
            current.css('color', '#713F93');
            theCount.css('font-weight','bold');
        } else {
            theCount.css('font-weight','normal');
        }
    });
</script>
@endsection
