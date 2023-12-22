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
                        <h4 class="mb-sm-0 font-size-13">PAGE BUILDER</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Page Builder</li>
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
                            <h4 class="font-60">Use A Template</h4>
                            <p>
                            Pick a ready made template to begin building your pages
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
                            <button data-bs-toggle="modal" data-bs-target="#template" class="btn btn-primary d-block mt-2">New Template</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- store data information-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{route('user.page.create_use_template', ['username' => Auth::user()->username])}}">
                                {{ csrf_field() }}
                                <div class="form">
                                    <p>
                                        <b>
                                            Use Page Template
                                        </b>
                                    </p>
                                    <div class="row col-lg-8 col-sm-12">
                                        <div class="col-lg-12">
                                            <label>Selected Page Template</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="text" value="@if (env('APP_ENV') == 'local') {{ $page->file_location }} @else @if($page->name == 'index.html') {{ 'https://' . $page->slug . '-page.ojafunnel.com' . '/' }} @else {{ 'https://' . $page->slug . '-page.ojafunnel.com' . '/' . explode('.', $page->name)[0] }} @endif  @endif" class="input" readonly>
                                                    <input type="hidden" name="selected_page" value="{{ $page->id }}" class="input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label> Title </label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="text" placeholder="e.g Homepage" name="title" class="input" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Sub Domain</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="text" placeholder="e.g Tola Cake And Pasteries" id="subdomain" name="file_folder" class="input" required>
                                                    <small id="generateSubDomain"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Page Name</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="text" placeholder="e.g Home" id="pagename" name="file_name" class="input" required>
                                                    <small id="generatePage"></small>
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

    <!-- end page title -->
</div>
</div>
</div>
<!-- END layout-wrapper -->
<style>
    .pageName {
        background: #556ee6;
        padding: 0.7rem;
        border-radius: 20px;
        color: #fff;
    }
</style>
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
                            <iframe src="https://www.youtube.com/embed/9xwazD5SyVg" title="Explainer Video" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
<script>
    localStorage.setItem('use_template', JSON.stringify({
        page_id: "{{ $page->id }}",
        view: true
    }));
</script>
<!-- Modal Ends -->
@endsection
