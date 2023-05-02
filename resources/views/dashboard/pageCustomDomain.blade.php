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
                        <h4 class="mb-sm-0 font-size-13">PAGE CUSTOM DOMAIN</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Add Custom Domain</li>
                            </ol>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">Add Custom Domain</h4>
                            <p>
                                Add your top-level domain to your page with a button click.
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
            </div> 
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Add Custom Domain</h4> 
                            <div class="row">
                                <div class="col-lg-1">
                                   <span style="font-size:25px; font-weight: bold;">
                                        1.
                                   </span>
                                </div>
                                <div class="col-lg-11">
                                    <p>
                                        Go to your domain DNS settings and create <b>A Record</b> pointing your root domain or sub domain to <b>45.79.102.122</b> 
                                    </p>
                                    <p>
                                        <span>e.g</span><br>
                                        <span> Point <b>@</b> to <b>45.79.102.122</b> - root domain (example.com)</span><br>
                                        <span> Point <b>page</b> to <b>45.79.102.122</b> - sub domain (page.example.com)</span>
                                    </p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-1">
                                   <span style="font-size:25px; font-weight: bold;">
                                        2.
                                   </span>
                                </div>
                                <div class="col-lg-11"> 
                                    <div class="row">
                                        <div class="">
                                            <form method="POST" action="{{ route('user.page.save.custom.domain', ['username' => Auth::user()->username]) }}">
                                                @csrf
                                                <div class="form">
                                                    <p>
                                                        Submit Your Domain
                                                    </p>
                                                    <div class="row">
                                                        <input type="hidden" name="id" value="{{ $page->id }}">
                                                        <input type="hidden" name="request_type" value="{{ $domain ? 'update' : 'save' }}"> 
                                                        <div class="col-lg-12">
                                                            <label>Sub Domain</label>
                                                            <div class="row">
                                                                <div class="col-md-12 mb-4">
                                                                    <input type="text" placeholder="File Folder" name="file_folder" id="subdomain" class="input" value="{{$page->folder}}" required readonly>
                                                                    <small id="generateSubDomain"></small>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <div class="col-lg-12">
                                                            <label>Domain</label>
                                                            <div class="row">
                                                                <div class="col-md-12 mb-4">
                                                                    <input type="text" placeholder="Enter your domain name e.g example.com or page.example.com" name="domain" class="input" value="{{ $domain ? $domain->domain : null }}" required> 
                                                                    <small>
                                                                        NB: Enter domain name <b>without</b> protocol <b>(https:// or http://)</b> 
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 mb-4">
                                                            <div class="boding">
                                                                <button type="submit">
                                                                    {{ $domain ? 'Update Custom Domain' : 'Add Custom Domain' }} 
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
                </div>
            </div>
            <!-- end page title --> 
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Custom Domain</h4> 
                            <div class="row">
                                <div>
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                            <tr> 
                                                <th scope="col">Domain</th>
                                                <th scope="col">Status</th> 
                                                <th scope="col">Actions</th>
                                            </tr> 
                                        </thead> 
                                        <tbody>
                                            @if ($domain)
                                                <tr>
                                                    <td> {{ $domain->domain }} </td>
                                                    <td> {{ $domain->status }} </td>
                                                    <td> 
                                                        <button class="btn btn-danger" type="button"  data-bs-toggle="modal" data-bs-target="#remove">
                                                            Remove
                                                        </button> 
                                                    </td>
                                                </tr>
                                            @endif 
                                        </tbody>
                                    </table>
                                    @if ($domain)
                                        <div class="modal fade" id="remove" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content pb-3">
                                                    <div class="modal-header border-bottom-0">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <div class="row">
                                                            <div class="Editt">
                                                                <form method="POST" action="{{ route('user.page.remove.custom.domain', ['username' => Auth::user()->username]) }}">
                                                                    @csrf
                                                                    <div class="form">
                                                                        <p><b>Remove Domain</b></p>
                                                                        <input type="hidden" name="id" value="{{ $domain->id }}">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <p>This action cannot be undone. This will permanently remove <b>{{$domain->domain}}</b>.</p>
                                                                                <label>Please type DELETE to confirm.</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <input type="text" name="delete" class="input" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12 mb-4">
                                                                                <div class="boding">
                                                                                    <button type="submit" class="form-btn">
                                                                                        I understand this consquences, Delete
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
                                    @endif 
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- ... -->
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
 
<!-- end modal -->
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
<script>
    let subdomain = document.getElementById('subdomain'); 
    let subdomaintext = document.getElementById('generateSubDomain'); 

    if('{{ env('APP_URL') }}'.startsWith('https')) 
            subdomaintext.innerText = `https://${subdomain.value.replace(/\s+/g, ' ').split(' ').join('-').toLowerCase() + '-page'}.ojafunnel.com`
</script>
<!-- Modal Ends -->
@endsection
