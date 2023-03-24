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
                        <h4 class="mb-sm-0 font-size-18">WA Number</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">WA Number</li>
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
                                    <h4 class="font-500">WA Number</h4>
                                    <p>
                                        All your WA Number in one Place
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create">
                                        <a href="#">
                                            <button type="submit" data-bs-toggle="modal" data-bs-target="#addWANumber">
                                                + Add WA Number
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">View WA Number</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">Phone Number</th> 
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @forelse ($whatsapp_numbers as $whatsapp_number)
                                            <tr> 
                                                <td>
                                                    {{ $whatsapp_number['phone_number'] }}
                                                </td>
                                                <td>
                                                    {{ $whatsapp_number['status'] }}
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-{{ $whatsapp_number['id'] }}" type="button">Edit</a></li>
                                                            @if ($whatsapp_number['status'] == 'Connected')
                                                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#disconnect-{{ $whatsapp_number['id'] }}" type="button">Disconnect</a></li>
                                                            @else
                                                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#connect-{{ $whatsapp_number['id'] }}" type="button">Connect</a></li>
                                                            @endif 
                                                            <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#delete-{{ $whatsapp_number['id'] }}">Delete</a></li>
                                                        </ul>

                                                        {{-- modal --}}
                                                        <div class="modal fade" id="edit-{{ $whatsapp_number['id'] }}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content pb-3">
                                                                    <div class="modal-header border-bottom-0">
                                                                        <h4 class="card-title mb-4">Edit WA Number</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="Editt">
                                                                            <form action="{{ route('user.whatsapp.update-wa-number', ['username' => Auth::user()->username ]) }}" method="POST">
                                                                                @csrf
                                                                                <div class="form">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 mb-4">
                                                                                            <label for="Name">Phone number</label>
                                                                                            <input type="hidden" name="id" value="{{ $whatsapp_number['id'] }}">
                                                                                            <input type="text" name="phone_number" value="{{ $whatsapp_number['phone_number'] }}" placeholder="Enter your phone number" required />
                                                                                        </div>   
                                                                                        <div class="text-end mt-2">
                                                                                            <a href="#" class="text-decoration-none">
                                                                                                <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                                                                    Submit
                                                                                                </button>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- modal --}}
                                                        <div class="modal fade" id="connect-{{ $whatsapp_number['id'] }}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content pb-3"> 
                                                                    <div class="modal-header border-bottom-0">
                                                                        <h4 class="card-title mb-4">Connect</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="Editt">
                                                                            <div>
                                                                                You're about to connect ({{ $whatsapp_number['phone_number'] }}). <br> Are you sure you want to continue?
                                                                            </div> <br>
                                                                            <img id="QR-{{ $whatsapp_number['id'] }}" src="https://placehold.co/250x250/png" alt="" style="height: 250px; width: 250px"><br><br>
                                                                            <span id="status-{{ $whatsapp_number['id'] }}"></span>
                                                                            <button type="button" onclick="generateQR('{{ $whatsapp_number['full_jwt_session'] }}', '{{ $whatsapp_number['id'] }}')" id="generateBtn-{{ $whatsapp_number['id'] }}" class="btn px-3" style="color: #714091; border: 1px solid #714091" >
                                                                                Generate QR Code
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- modal --}}
                                                        <div class="modal fade" id="disconnect-{{ $whatsapp_number['id'] }}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content pb-3"> 
                                                                    <div class="modal-header border-bottom-0">
                                                                        <h4 class="card-title mb-4">Disconnect</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="Editt"> 
                                                                            <div>
                                                                                You're about to disconnect ({{ $whatsapp_number['phone_number'] }}). <br> Are you sure you want to continue?
                                                                            </div> <br>
                                                                            <button type="button" onclick="disconnectWA('{{ $whatsapp_number['full_jwt_session'] }}', '{{ $whatsapp_number['id'] }}')" id="disconnectBtn-{{ $whatsapp_number['id'] }}" class="btn px-3" style="color: #714091; border: 1px solid #714091" >
                                                                                Disconnect
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade" id="delete-{{ $whatsapp_number['id'] }}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 35%">
                                                                <div class="modal-content pb-3">

                                                                    <div class="modal-header border-bottom-0">
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="Editt">
                                                                            <form action="{{ route('user.whatsapp.delete-wa-number', ['username' => Auth::user()->username ])}}" method="POST">
                                                                                @csrf
                                                                                <div class="form">
                                                                                    <div class="row">
                                                                                        <h3 style="text-align: center; margin-bottom: 15%;" >Are you sure you want to delete this WhatsApp Number <br> ({{ $whatsapp_number['phone_number'] }})</h3>
                                                                                        <div class="row justify-content-between">
                                                                                            <div class="col-6">
                                                                                                <a href="#" class="text-decoration-none">
                                                                                                    <button type="button" data-bs-dismiss="modal" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                                        Cancel
                                                                                                    </button></a>
                                                                                            </div>
                                                                                            <div class="col-6 text-end">
                                                                                                <input type="hidden" name="id" value="{{ $whatsapp_number['id'] }}">
                                                                                                <a href="#" class="text-decoration-none">
                                                                                                    <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #BA0028"
                                                                                                        >
                                                                                                        Delete
                                                                                                    </button>
                                                                                                </a>
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
                                                </td>
                                            </tr> 
                                        @empty
                                            {{ 'No WA Numbers at the moment' }}
                                        @endforelse 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SuccessModal -->
<div class="modal fade" id="addWANumber" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <h4 class="card-title mb-4">Add Number</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="Editt">
                    <form action="{{ route('user.whatsapp.create-wa-number', ['username' => Auth::user()->username]) }}" method="POST">
                        @csrf
                        <div class="form">
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Phone number</label>
                                    <input type="text" name="phone_number" value="" placeholder="Enter your phone number" required />
                                </div>   
                                <div class="text-end mt-2">
                                    <a href="#" class="text-decoration-none">
                                        <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                            Submit
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js"></script>
<script>
    async function generateQR(full_jwt_session, id) {
        let QR = document.getElementById(`QR-${id}`)
        let generateBtn = document.getElementById(`generateBtn-${id}`)
        let status = document.getElementById(`status-${id}`)

        generateBtn.innerText = 'Generating... Please Wait'

        let { data } = await axios.post("{{ route('user.whatsapp.wa-number-generate-qr', ['username' => Auth::user()->username]) }}", { 
            full_jwt_session
        })

        if(data.status == "CLOSED") setTimeout(async () => { await generateQR(full_jwt_session, id) }, 3000)

        if(data.status == "INITIALIZING") setTimeout(async () => { await generateQR(full_jwt_session, id) }, 3000)

        if(data.status == "QRCODE") {
            QR.src = data.qrcode

            status.innerHTML = 'Go to WhatsApp > Settings > Linked Devices <br> > Link a Device > Scan QR <br><br>'
            generateBtn.innerText = 'Generate QR Code'

            // check session connection for the next 60 s
            let session = await checkSessionConnection(60000, full_jwt_session, id)

            console.log(session)

            if(session) {
                window.location.assign("{{ route('user.whatsapp.wa-number', ['username' => Auth::user()->username]) }}")
            } else await generateQR(full_jwt_session, id)
        } 

        if(data.status == "CONNECTED") window.location.assign("{{ route('user.whatsapp.wa-number', ['username' => Auth::user()->username]) }}")
    }

    async function disconnectWA(full_jwt_session, id) {
        let disconnectBtn = document.getElementById(`disconnectBtn-${id}`)
        disconnectBtn.innerText = 'Disconnecting... Please Wait'

        let { data } = await axios.post("{{ route('user.whatsapp.wa-number-logout-session', ['username' => Auth::user()->username]) }}", { 
            full_jwt_session
        }) 

        if(data.status == true && data.message == 'Session successfully closed') window.location.assign("{{ route('user.whatsapp.wa-number', ['username' => Auth::user()->username]) }}")
    }

    async function checkSessionConnection(seconds, full_jwt_session, id) {
        return new Promise((resolve, reject) => { 
            return setTimeout(async () => { 
                // be long polling here to check connection session
                let { data } = await axios.post("{{ route('user.whatsapp.wa-number-check-session-connection', ['username' => Auth::user()->username]) }}", { 
                    full_jwt_session
                }) 

                if(data['message'] == 'Connected'){
                    return resolve(true);
                } else{ 
                    seconds -= 10000
                    
                    if(seconds > 0) {
                        await checkSessionConnection(seconds,  full_jwt_session, id)
                    } 
                    
                    return resolve(false);
                } 
            }, 10000)
        }) 
    }
</script>
<!-- end modal -->
@endsection
