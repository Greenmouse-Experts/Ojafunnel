@extends('layouts.dashboard-frontend')

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
                        <h4 class="mb-sm-0 font-size-18">SMS Campaign</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user.sms.automation', Auth::user()->username)}}">SMS Campaigns</a></li>
                                <li class="breadcrumb-item active">New Sms</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <!-- start page title -->
            <div class="row card account-head">
                <div class="col-lg-12">
                    <h4 class="font-500">New SMS Campaign</h4>
                    <p>
                        Send SMS to your new customer and those on your mailing list
                    </p>
                </div>
            </div>
            <!-- account container form -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="Edit">
                        <form method="POST" action="{{ route('user.sms.sendmessage.campaign')}}">
                            @csrf
                            <input type="hidden" name="sms_type" value="plain">
                            <div class="form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Campaign Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter Campaign Name" name="campaign_name" class="input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Sender Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter Sender Name" name="sender_name" class="input"  maxlength="11">
                                                <p><span class="text-danger">Note:</span> The sender name must not be greater than 11 characters.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" id="message">
                                        <label>SMS Message</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <textarea name="message" id="message" cols="30" rows="5" placeholder="Enter the message you would like to send to the reciepient(s) details below "></textarea>
                                                <div class="messageCounter" id="the-count"><span id="characters">0</span></div>
                                                <span class="text-danger">160 characters length per message</span>
                                                <br>
                                                <p class="text-danger">Note: Message must comply with SMS provider rules.</p>
                                                <p>
                                                    <code>$name</code> can be used in this message. <b>NB:</b> Name must have been added in the contact list to use this feature.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-4 justify-content-between">
                                        <div class="col-4">
                                            <p class="font-500 fs-6">Recipients:</p>
                                        </div>
                                        <div class="col-8">
                                            <select name="mailinglist_id" class="bg-light w-100 py-2 rounded px-2 fs-6">
                                                <option value="">Choose from mailing list</option>
                                                @if($contact_lists->isEmpty())
                                                <option value="">No Mailing List</option>
                                                @else
                                                @foreach($contact_lists as $contact_list)
                                                <option value="{{$contact_list->id}}">{{$contact_list->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <textarea name="contacts" cols="30" rows="5" placeholder="Add phone number manually E.g: +234 8000 111 333 "></textarea>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-12">
                                        <label>Opt Out Message </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter opt out message eg text stop to 12344" name="optout_message" class="input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-3">
                                                Send SMS:
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label style="margin-left: 0px"><input type="radio" name="message_timing" value="Immediately" style="display: inline-block !important; width: auto;" onclick="show1();" /> Immediately</label>
                                            </div>
                                            <div class="col-12">
                                                <label style="margin-left: 0px"><input type="radio" name="message_timing" value="Schedule" style="display: inline-block !important; width: auto;" onclick="show2();" /> Schedule</label>
                                            </div>
                                            <div class="col-12">
                                                <label style="margin-left: 0px"><input type="radio" name="message_timing" value="Series" style="display: inline-block !important; width: auto;" onclick="show3();" /> Series</label>
                                            </div>
                                        </div>
                                    </div>
                                    <p><b><spam class="text-danger font-weight-bold">Note:</spam> Contacts exceeding 10, to ensure smooth delivery and avoid overriding, please allocate sufficient time spacing between each sms sending.</b></p>
                                    <div class="col-12" id="series" style="display: none;">
                                        <fieldset class="row series-row mb-2" style="border: 1px solid #cdd1dc;">
                                            <div class="col-md-12 mt-4">
                                                <label for="datesSelect">Series</label>
                                                <select id="datesSelect" name="date[]"></select>
                                            </div>
                                            <div class="col-md-12 mt-5">
                                                <textarea name="series_message[]" id="series_message" cols="30" rows="5" placeholder="Enter the message you would like to send to the reciepient(s) details below "></textarea>
                                                <div class="messageCounter" id="series-the-count"><span id="series-characters">0</span></div>
                                                <span class="text-danger">160 characters length per message</span>
                                                <p><code>$name</code> can be used in this message. <b>NB:</b> Name must have been added in the contact list to use this feature.</p>
                                            </div>
                                            <!-- <button class="mb-2 remove-series" style="width: 25%;" type="button">Remove</button> -->
                                        </fieldset>
                                        <!-- Additional Rows -->
                                        <div class="additional-rows"></div>
                                        <div style="display: flex; justify-content: space-between;">
                                            <button class="add-series" type="button">Add More</button>
                                        </div>
                                    </div>
                                    <div class="col-12" id="schedule" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-6 mt-4">
                                                <label for="Time">Date</label>
                                                <input type="date" name="schedule_date" />
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="Time">Time</label>
                                                <input type="Time" name="schedule_time" />
                                            </div>
                                            <div class="col-md-12 mt-5">
                                                <label for="">Frequency</label>
                                                <select name="frequency_cycle" id="selectFrenquncy" onchange="frequencyChange()">
                                                    <option value="onetime">One time</option>
                                                    <option value="daily">Daily</option>
                                                    <option value="monthly">Monthly</option>
                                                    <option value="yearly">Yearly</option>
                                                    <option value="custom">Custom</option>
                                                </select>
                                            </div>
                                            <div id="frq_custom" class="col-md-12" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-6 mt-5" >
                                                        <label for="Frq_amount">Frequency Amount</label>
                                                        <input type="text" name="frequency_amount" />
                                                    </div>
                                                    <div class="col-md-6 mt-5">
                                                        <label for="Time">Frequency Unit</label>
                                                        <select name="frequency_unit" >
                                                            <option value="day">Day</option>
                                                            <option value="week">Week</option>
                                                            <option value="month">Month</option>
                                                            <option value="year">Year</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="end_period" class="col-md-12" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-6 mt-5" >
                                                        <label for="Time">End Date</label>
                                                        <input type="date" name="recurring_date" />
                                                    </div>
                                                    <div class="col-md-6 mt-5">
                                                        <label for="Time">End Time</label>
                                                        <input type="Time" name="recurring_time" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6"></div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="boding">
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#chooseIntegrationGateway">
                                                    Proceed
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- email chooseGateway modal -->
                                <div class="modal fade" id="chooseIntegrationGateway" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-bottom-0">
                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                    Your Active SMS Integration
                                                </h5>
                                                <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="Edit">
                                                        <div class="form">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="row">
                                                                        @if($integrations->isEmpty())
                                                                        <div class="col-12">
                                                                            <div class="circle" style="padding: 20px 20px 20px 2px; text-align: center;">
                                                                                <span class="text-dark">No SMS Integration Gateway</span>
                                                                            </div>
                                                                        </div>
                                                                        @else
                                                                        @foreach($integrations as $integration)
                                                                        <div class="col-2"></div>
                                                                        <div class="col-8">
                                                                            <div class="circle" style="padding: 20px 20px 20px 20px;">
                                                                                <span class="text-dark">{{$integration->type}}</span>
                                                                            </div>
                                                                            <div class="zazu">
                                                                                <input type="radio" name="integration" value="{{$integration->type}}" checked style="margin-top: -70px !important;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-2"></div>
                                                                        @endforeach
                                                                        @endif
                                                                        <div class="row">
                                                                            <div class="col-6 text-center">
                                                                                <a data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                    Cancel
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-6 text-center">
                                                                                <button class="btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                                                                    Send SMS
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end modal -->
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <botton class="open" onclick="openPreview()">
                        Open Preview
                    </botton>
                    <div class="row" id="preview" style="display: none;">
                        <div class="Edit">
                            <div class="form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="master">
                                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1669370587/OjaFunnel-Images/Frame_46722_vzkyft.png" draggable="false" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <div class="insert">
                                                        <textarea id="showMessage" cols="30" rows="10" placeholder="Enter Your Message" disabled></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content ---->
</div>
<!-- END layout-wrapper -->

<!-- smsModal -->
<div class="modal fade" id="smsSuccess" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="icon-success">
                    <img src="assets/image/theme.png" alt="" width="100%" />
                </div>
                <div class="text-center mt-5">
                    <p>
                        <b>
                            You’ve succesfully sent your SMS to the recipient(s)
                        </b>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<script>
    function show1() {
        document.getElementById('message').style.display = 'block';
        document.getElementById('schedule').style.display = 'none';
        document.getElementById('series').style.display = 'none';
        document.getElementById('series_message').value = '';
    }

    function show2() {
        document.getElementById('series').style.display = 'none';
        document.getElementById('series_message').value = '';
        document.getElementById('schedule').style.display = 'block';
        document.getElementById('message').style.display = 'block';
    }

    function show3() {
        document.getElementById('schedule').style.display = 'none';
        document.getElementById('message').style.display = 'none';
        document.getElementById('message').value = '';
        document.getElementById('series').style.display = 'block';
    }

    function openPreview() {
        // Get the text field
        var copyText = document.getElementById("message").value;
        var preview = document.getElementById("preview");
        if (preview.style.display === "none") {
            preview.style.display = "block";
            document.getElementById("showMessage").value = copyText;
        } else {
            preview.style.display = "none";
        }
    }

    // jQuery code
    $(document).ready(function() {
        // Populate select box with options
        $.ajax({
            url: '/getDates',
            type: 'GET',
            success: function(response) {
                var select = $('#datesSelect');
                // Add "Immediately Joined" option
                select.append('<option value="' + response[0] + ' ij">Immediately Joined</option>');
                // Add "Same Day Joined" option
                select.append('<option value="' + response[1] + ' sdj">Same Day Joined</option>');
                // Add the rest of the days
                for (var i = 2; i < response.length; i++) {
                    var dayNumber = i - 1; // Adjust day number to start from 1
                    select.append('<option value="' + response[i] + '-' + dayNumber + '">Day ' + dayNumber + '</option>');
                }
                // Trigger change event on select box to update the input box with the selected day number
                select.trigger('change');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });


        // Add a new row when "Add More" button is clicked
        $('.add-series').click(function() {
            var clonedRow = $('.series-row:first').clone();
            // Clear the values in the cloned row
            clonedRow.find('input, textarea').val('');
            // Remove button for the cloned row
            clonedRow.find('.remove-series').remove();
            // Append the cloned row to the container
            $('.additional-rows').append(clonedRow);
            // Add the "Remove" button to the cloned row
            $('.additional-rows .row:last').append('<button class="mb-2 remove-series" style="width: 25%;" type="button">Remove</button>');
            // Show the cloned row
            clonedRow.show();
        });


        // Remove the corresponding row when "Remove" button is clicked
        $(document).on('click', '.remove-series', function() {
            $(this).closest('.series-row').remove();
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

    // This code is executed when the key is lifted (keyup) in the "series_message" textarea.
    $('#series_message').keyup(function() {
        // Get the length of the text entered in the textarea.
        var characterCount = $(this).val().length,

        // Select the element with the ID "characters" and the element with the ID "the-count".
        current = $('#series-characters'),
        theCount = $('#series-the-count');

        // Update the content of the element with the ID "characters" to display the current character count.
        current.text(characterCount);

        // Apply different text colors based on character count ranges.
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

        // If the character count is greater than or equal to 140.
        if (characterCount >= 140) {
            current.css('color', '#713F93');
            theCount.css('font-weight','bold');
        } else {
            theCount.css('font-weight','normal');
        }
    });

</script>
@endsection
