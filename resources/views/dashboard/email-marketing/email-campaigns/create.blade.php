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
                <div class="col-lg-12">
                    <div class="card begin account-head mb-4">
                        <div class="">
                            <h4 class="font-500">Email Campaign</h4>
                            <p>
                                Send instant, scheduled or automated email to your contact
                            </p>
                        </div>
                        <div class="d-flex account-nav">
                            <p class="ps-0 active">New Campaign</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="Edit">
                        <form method="POST" action="{{ route('user.email-marketing.email.campaigns.save', ['username' => Auth::user()->username ]) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="sms_type" value="whatsapp">
                            <div class="form">
                                <div class="row">
                                    <p class="tell mb-4">
                                        <b>
                                            Send Email Campaign
                                        </b>
                                    </p>
                                    <div class="col-lg-12">
                                        <label>Campaign Name:</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter campaign name" name="name" class="input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Subject:</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter campaign subject" name="subject" class="input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                Send Email:
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label style="margin-left: 0px"><input type="radio" name="message_timing" value="Immediately" style="display: inline-block !important; width: auto;" onclick="show1();" /> Immediately</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label style="margin-left: 0px"><input type="radio" name="message_timing" value="Schedule" style="display: inline-block !important; width: auto;" onclick="show2();" /> Schedule</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label style="margin-left: 0px"><input type="radio" name="message_timing" value="Series" style="display: inline-block !important; width: auto;" onclick="show3();" /> Series</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12" id="message">
                                        <label>Email template:</label>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <select name="email_template_id" class="bg-light w-100 py-2 rounded px-2 fs-6" onchange="loadTemplate()" id="email_template_id">
                                                        <option value="">Choose from email template</option>
                                                        @forelse ($email_templates as $email_template)
                                                            <option value="{{ $email_template->id }}">
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
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Email list:</label>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <select name="email_list" class="bg-light w-100 py-2 rounded px-2 fs-6">
                                                        {{-- mail_lists --}}
                                                        <option value="">Choose from email list</option>
                                                        @forelse ($mail_lists as $mail_list)
                                                            <option value="{{ $mail_list->id }}">
                                                                {{  $mail_list->name }}
                                                            </option>
                                                        @empty
                                                            {{ 'No email list at the moment. Please add new mail list' }}
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="logo-input w-full px-5 py-4 pb-5" id="attachment">
                                        <p>Upload Attachments:</p>
                                        <p>
                                            <b>
                                                Attach, images, videos, audios or files
                                            </b>
                                        </p>
                                        <div class="logo-input2 border-in py-5 px-2">
                                            <div class="avatar">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664984753/OjaFunnel-Images/Vectoor_rbkrfl.png" alt="">
                                            </div>
                                            <div class="logo-file">
                                                <input type="file" name="attachments[]" id="" multiple/>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-12" id="series" style="display: none;">
                                        <fieldset class="row series-row mb-2" style="border: 1px solid #cdd1dc;">
                                            <div class="col-md-6 mt-4">
                                                <label for="Time">Date</label>
                                                <input type="date" name="series_date[]" />
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="Time">Time</label>
                                                <input type="Time" name="series_time[]" />
                                            </div>
                                            <div class="col-md-12 mt-5">
                                                <select name="series_email_template_id[]" class="bg-light w-100 py-2 rounded px-2 fs-6" onchange="loadSeriesTemplate(this)" id="series_email_template_id">
                                                    <option value="">Choose from email template</option>
                                                    @forelse ($email_templates as $email_template)
                                                        <option value="{{ $email_template->id }}">
                                                            {{  $email_template->name }}
                                                        </option>
                                                    @empty
                                                        {{ 'No email template at the moment. Please add new template' }}
                                                    @endforelse
                                                </select>
                                                <div xid="series_email_template_editor" class="series_email_template_editor"></div>
                                                <div xid="series_email_template_data"></div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label>Upload Attachments:</label>
                                            </div>
                                            <div class="logo-input w-full px-5 py-4 pb-5">
                                                <p><b>Attach, images, videos, audios or files</b></p>
                                                <div class="logo-input2 border-in py-5 px-2">
                                                    <div class="avatar">
                                                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664984753/OjaFunnel-Images/Vectoor_rbkrfl.png" alt="">
                                                    </div>
                                                    <div class="logo-file">
                                                        <input type="file" name="series_attachments[]" id="" multiple/>
                                                    </div>
                                                </div>
                                            </div>
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
                                                <label for="Time">Start Date</label>
                                                <input type="date" name="start_date" />
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="Time">Start Time</label>
                                                <input type="Time" name="start_time" />
                                            </div>
                                            {{-- <div class="col-md-12 mt-5">
                                                <label for="">Frequency</label>
                                                <select name="frequency_cycle" id="selectFrenquncy" onchange="frequencyChange()">
                                                    <option value="onetime">One time</option>
                                                    <option value="daily">Daily</option>
                                                    <option value="weekly">Weekly</option>
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
                                                    <div class="col-md-12 mt-5" >
                                                        <label for="Time">End Date</label>
                                                        <input type="date" name="end_date" />
                                                    </div>
                                                    <div class="col-md-6 mt-5">
                                                        <label for="Time">End Time</label>
                                                        <input type="Time" name="end_time" />
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="boding">
                                                    <button class="btn px-3" style="color: #714091; border:1px solid #714091; background:#fff;">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="boding">
                                                    <button type="submit" name="submit">
                                                        Proceed
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js"></script>
<script src="http://cdn.ckeditor.com/4.21.0/standard-all/ckeditor.js"></script>
<script>
    function show1() {
        document.getElementById('message').style.display = 'block';
        document.getElementById('attachment').style.display = 'block';
        document.getElementById('schedule').style.display = 'none';
        document.getElementById('series').style.display = 'none';
        // document.getElementById('series_email_template').value = '';
    }

    function show2() {
        document.getElementById('series').style.display = 'none';
        // document.getElementById('series_email_template').value = '';
        document.getElementById('schedule').style.display = 'block';
        document.getElementById('message').style.display = 'block';
        document.getElementById('attachment').style.display = 'block';
    }

    function show3() {
        document.getElementById('schedule').style.display = 'none';
        document.getElementById('message').style.display = 'none';
        document.getElementById('attachment').style.display = 'none';
        // document.getElementById('email_template').value = '';
        document.getElementById('series').style.display = 'block';
    }

    // Function to initialize CKEditor
    function initializeCKEditor(selector) {
        CKEDITOR.replace(selector, {
            fullPage: true,
            extraPlugins: 'docprops',
            allowedContent: true,
            height: 320,
            removeButtons: 'PasteFromWord',
            removePlugins: 'sourcearea'
        });
    }

    // Function to destroy CKEditor
    function destroyCKEditor(selector) {
        if (CKEDITOR.instances[selector]) {
            CKEDITOR.instances[selector].destroy(true);
        }
    }

    $(document).ready(function () {
        // Add a new row when "Add More" button is clicked
        $('.add-series').click(function () {
            var clonedRow = $('.series-row:first').clone();
            var rowLength = $('.series-row').length;

            // Set unique IDs for the cloned row
            var editorId = 'series_editor_' + rowLength;
            clonedRow.find('textarea').attr('id', editorId);

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

            // Destroy CKEditor for the cloned row (if exists) and then initialize
            destroyCKEditor(editorId);
            initializeCKEditor(editorId);
        });

        // Remove the corresponding row when "Remove" button is clicked
        $(document).on('click', '.remove-series', function () {
            var editorIdToRemove = $(this).closest('.series-row').find('textarea').attr('id');
            destroyCKEditor(editorIdToRemove);
            $(this).closest('.series-row').remove();
        });
    });

    async function loadSeriesTemplate(e) {
        // Get a unique editor ID for the current row
        var rowLength = $('.series-row').length;
        var editorId = 'series_editor_' + rowLength;

        let next = e.nextElementSibling;

        const nextIdattr = next.getAttribute('class') + '_' + rowLength;
        next.setAttribute('class', nextIdattr);

        editorId = nextIdattr;
        

        //document.getElementById('series_email_template_editor')
        document.getElementsByClassName(nextIdattr)[0].innerHTML = `<textarea class="mt-2" cols="80" id="${editorId}" name="series_email_template[]"></textarea>`;

        let id = document.getElementById('series_email_template_id').value;
        let endpoint = "{{ route('user.email-marketing.email.campaigns.template_content', ['username' => Auth::user()->username, 'id' => '?']) }}".replace('?', id);
        let { data } = await axios.get(endpoint);

        if (data.success) {
            console.log(editorId);
            // Initialize CKEditor for the new textarea
            // destroyCKEditor(editorId);
            initializeCKEditor(editorId);
            // Set the content for the CKEditor instance when it's ready
            CKEDITOR.instances[editorId].on('instanceReady', function (event) {
                // Set the data when the CKEditor instance is ready
                event.editor.setData(data.data);
            });
        } else {
            // If there is no data, hide the textarea
            document.getElementById(editorId).style.display = 'none';
        }
    }

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
