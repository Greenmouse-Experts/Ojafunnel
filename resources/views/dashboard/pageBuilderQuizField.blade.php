@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-13">QUIZ FIELD BUILDER</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Quiz Field Builder</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">Add Fields on ({{$page->title}}) Page</h4>
                            <p>
                                Manage quiz fields to enable data collection from your traffice.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="card">
                        <div class="card-body">
                            <!-- <p class="cash">Explainer Video Here</p> -->
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                <i class="bi bi-play-btn"></i>
                            </div>
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                <i class="bi bi-card-text"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="all-create">
                            <button data-bs-toggle="modal" data-bs-target="#template" class="btn btn-primary d-block mt-2">New Field</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4"> {{$page->title}} Fields</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Question</th>
                                            <th>Type</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($form->formfields as $field)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $field->field_question }}</td>
                                                <td>
                                                    {{ $field->field_type }}
                                                </th>

                                                <td>{{ $field->created_at->toDayDateTimeString() }}</td>
                                                <td>
                                                    <div class="dropdown-center">
                                                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Options
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                                            <li>
                                                                <a class="dropdown-item" style="cursor: pointer;" href="
                                                                {{route('user.page.builder.view.quiz.field.delete', [Auth::user()->username, Crypt::encrypt($page->id), Crypt::encrypt($field->id)])}}?form_id={{$form->id}}
                                                                ">DELETE FIELD</a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            {{ 'No fields at the moment' }}
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

    <!-- end page title -->
</div>
</div>
</div>
<!-- END layout-wrapper -->

<!-- Modal START -->
<div class="modal fade" id="template" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div class="Editt">
                        <form method="POST" action="{{route('user.page.builder.view.edit.quiz.addfields', [Auth::user()->username, Crypt::encrypt($page->id)])}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="form_id" value="{{$form->id}}" />
                            <div class="form">
                                <p>
                                    <b>
                                        New Field
                                    </b>
                                </p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label> Question </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <textarea type="text" placeholder="e.g What is the name of your pet?" rows="3" name="question" class="input" required></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <label>Field Type</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <select name="field_type" class="input" required style="height: 50px;" onchange="enableFields()">
                                                    <option>--Select Field Type--</option>
                                                    <option value="text">Input: Text</option>
                                                    <option value="number">Input: Number</option>
                                                    <option value="date">Input: Date</option>
                                                    <option value="time">Input: Time</option>
                                                </select>
                                                {{-- <small id="generatePage"></small> --}}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 mb-4">
                                        <div class="boding">
                                            <button type="submit">
                                                Proceed
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



<style>
    .pageName {
        background: #556ee6;
        padding: 0.7rem;
        border-radius: 20px;
        color: #fff;
    }
</style>
<script>
function enableFields() {
    const selectedOption = document.getElementById("page_options").value;
    const divOption1 = document.getElementById("upsell_select");
    const divOption2 = document.getElementById("bumpsell_select");
    const divOption3 = document.getElementById("success_select");

    // Hide all divs initially
    divOption1.style.display = "none";
    divOption2.style.display = "none";
    divOption3.style.display = "none";

    // Show the corresponding div based on the selected option
    if (selectedOption === "upsell_page") {
        divOption1.style.display = "block";
    } else if (selectedOption === "upsell_bump_page") {
        divOption2.style.display = "block";
    }
}
function removeField(e) {
    const field = e.parentNode.parentNode;
    // console.log(field);
    const container = document.getElementById('bumps');
    container.removeChild(field);
}

let fieldCounter = 1;
function addMore() {
    fieldCounter++;
    const container = document.getElementById('bumps');
    const field = document.createElement('div');
    field.className = 'row';
    field.innerHTML = `
            <div class="col-md-6">
                <label>Product Name</label>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <input type="text" placeholder="e.g Data Analytics Course" id="bump_product_name" name="bump_product_name_${fieldCounter}" class="input">
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <label>Product Price</label>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <input type="number" placeholder="e.g 10000" id="bump_product_price" name="bump_product_price_${fieldCounter}" class="input">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <a href="#" onclick="removeField(this)"><i class="fa fa-times"></i></a>
            </div>`;
    container.appendChild(field);
}



</script>
<script>
    let subdomain = document.getElementById('subdomain');
    let pagename = document.getElementById('pagename');

    let subdomaintext = document.getElementById('generateSubDomain');
    let pagetext = document.getElementById('generatePage');

    subdomain.addEventListener('input', (event) => {
        if('{{ env('APP_URL') }}'.startsWith('https'))
            subdomaintext.innerText = `https://${event.target.value.replace(/\s+/g, ' ').split(' ').join('-').toLowerCase() + '-page'}.ojafunnel.com`

        subdomain.value = event.target.value.replace(/\s+/g, ' ')
    })

    pagename.addEventListener('input', (event) => {
        if('{{ env('APP_URL') }}'.startsWith('https'))
            pagetext.innerText = `${subdomaintext.innerText}/${event.target.value.replace(/\s+/g, ' ').split(' ').join('-').toLowerCase()}`

        pagename.value = event.target.value.replace(/\s+/g, ' ')
    })
</script>
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <iframe src="https://www.youtube.com/embed/9xwazD5SyVg" title="Dummy Video For YouTube API Test" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, ducimus iste. Consequuntur doloremque voluptatem officia, quos laborum delectus atque distinctio reprehenderit earum iure. Sequi voluptate architecto libero, repellat neque deserunt assumenda sunt in sit ipsam delectus nostrum qui ratione. Laboriosam aliquid obcaecati vitae voluptatum ea minus quidem! Pariatur soluta quasi modi harum aut quas veritatis et. Necessitatibus fuga illo ipsa dicta aut nisi laborum nam at, id eveniet consectetur praesentium enim, cum dignissimos ipsum rem odio. Atque, eaque magni aut incidunt quo laudantium repudiandae quae modi officiis in, iusto suscipit fugiat rem inventore non dolorum adipisci rerum dolorem. Nulla, vero!
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
@endsection
