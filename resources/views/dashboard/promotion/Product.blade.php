@extends('layouts.dashboard-frontend')

@section('page-content')
<style>
    div#social-links {
        margin: 0 auto;
        max-width: 500px;
    }
    div#social-links ul li {
        display: inline-block;
    }          
    div#social-links ul li a {
        padding: 10px;
        /* border: 1px solid #ccc; */
        margin: 1px;
        font-size: 30px;
        color: #70418F;
        /* background-color: #ccc; */
    }
</style>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Product</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Product</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">Market Product</h4>
                            <p>
                            All your Market Product in one Place
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
                            <h4 class="card-title mb-4">Market Product</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Commission(s)</th>
                                            <th scope="col">Multi Level</th>
                                            {{-- <th scope="col">Visit</th> --}}
                                            <th scope="col">Created</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr>
                                                <td>
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td>
                                                    {{ $product->name }}
                                                </td>
                                                <td>
                                                    {{ $product->price }}
                                                </td>
                                                <td>
                                                    Level 1: <b>{{ $product->level1_comm }}%</b>, Level 2: <b>{{ $product->level2_comm }}%</b> (Super Affiliates only)
                                                </td>
                                                <td>
                                                    Yes
                                                </td>
                                                {{-- <td>
                                                    0
                                                </td> --}}
                                                <td>
                                                    {{ $product->created_at }}
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#onlineStore-{{ $product->id }}" title="View" class="btn btn-sm btn-soft-success"><i class="bi bi-eye-slash-fill"></i></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @empty
                                            No product(s) in any of Ojafunnel stores. Check back later.
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- LMS starts here-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Market LMS</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Subtitle</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Commission</th> 
                                            <th scope="col">Multi Level</th> 
                                            <th scope="col">Created</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($lms as $lm)
                                            <tr>
                                                <td>
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td>
                                                    {{ $lm->title }}
                                                </td>
                                                <td>
                                                    {{ \App\Models\Category::where('id', $lm->category_id)->first()->name }}
                                                </td>
                                                <td>
                                                    {{ $lm->subtitle }}
                                                </td>
                                                <td>
                                                    {{ $lm->description }}
                                                </td>
                                                <td>
                                                    Level 1: <b>{{ $lm->level1_comm }}%</b>, Level 2: <b>{{ $lm->level2_comm }}%</b> (Super Affiliates only)
                                                </td>
                                                <td>
                                                    Yes
                                                </td>
                                                <td>
                                                    {{ $product->created_at }}
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#onlineCourse-{{ $lm->id }}" title="View" class="btn btn-sm btn-soft-success"><i class="bi bi-eye-slash-fill"></i></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @empty
                                            No course(s) in any of Ojafunnel learning stores. Check back later.
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
<!-- Modal Ends -->
@foreach ($products as $product)
<!-- SuccessModal -->
<div class="modal fade" id="onlineStore-{{ $product->id }}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <h4 class="card-title mb-4">View Product</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="last">
                    <div class="col-lg-12">
                        <div class="images">
                            <img src="{{ Storage::url($product->image) }}" draggable="false" width="100%" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <b>Vendor</b>
                        </div>
                        <div class="col-md-8 mt-4">
                            {{ $product->store->user->first_name . ' ' . $product->store->user->last_name }}
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Name</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            {{ $product->name }}
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Description</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            {{ $product->description }}
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Price</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            {{ $product->price }}
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Commission Type</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            Multi Level
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Commissions</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            Level 1: <b>{{ $product->level1_comm }}%</b>, Level 2: <b>{{ $product->level2_comm }}%</b> (Super Affiliates only)
                        </div>
                        {{-- <div class="col-md-4 mt-3">
                            <b>Promotion Material(s)</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            <a href="#">
                                https://drive.google.com/drive/folders <br> /1X7DPkhjvK4WnaaxrVv2BBxzptLW08S2x
                            </a>
                        </div> --}}
                        <div class="col-md-4 mt-3">
                            <b>Created At</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            {{ $product->created_at }}
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Share</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            @php
                            $shareComponent = \Share::page(
                                route('user.stores.link', ['storename' => $product->store->name]).'?promotion_id='.Auth::user()->promotion_link.'&product_id='.$product->id.'#item-'.$product->id,
                                $product->name,
                            )
                            ->facebook()
                            ->twitter()
                            ->linkedin()
                            ->telegram()
                            ->whatsapp()        
                            ->reddit();
                            @endphp
                            {!! $shareComponent !!}
                        </div>
                        <div class="col-md-12 mt-4 mb-4 text-center">
                            <b>Affiliate Links</b>
                        </div>
                        <div class="Editt">
                            <div class="form">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" value="{{ route('user.stores.link', ['storename' => $product->store->name])}}?promotion_id={{ Auth::user()->promotion_link }}&product_id={{$product->id}}#item-{{ $product->id }}" name="name" id="myInput{{$product->id}}" class="input mov" readonly required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type=" button" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy" onclick="copy('{{$product->id}}')" class="btn btn-secondary push"><i class="mdi mdi-content-copy"></i></button>
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
@endforeach

@foreach ($lms as $lm)
<!-- SuccessModal -->
<div class="modal fade" id="onlineCourse-{{ $lm->id }}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <h4 class="card-title mb-4">View LMS</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="last">
                    <div class="col-lg-12">
                        <div class="images">
                            <img src="{{$lm->image}}" draggable="false" width="100%" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <b>Vendor</b>
                        </div>
                        <div class="col-md-8 mt-4">
                            {{ 
                                \App\Models\User::where('id', $lm->user_id)->first()->first_name . ' ' . 
                                \App\Models\User::where('id', $lm->user_id)->first()->first_name
                            }}
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Title</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            {{ $lm->title }}
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Subtitle</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            {{ $lm->subtitle }}
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Description</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            {{ $lm->description }}
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Price</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            {{ $lm->currency}} {{ $lm->price }}
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Commission Type</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            Multi Level
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Commissions</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            Level 1: <b>{{ $lm->level1_comm }}%</b>, Level 2: <b>{{ $lm->level2_comm }}%</b> (Super Affiliates only)
                        </div>
                        {{-- <div class="col-md-4 mt-3">
                            <b>Promotion Material(s)</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            <a href="#">
                                https://drive.google.com/drive/folders <br> /1X7DPkhjvK4WnaaxrVv2BBxzptLW08S2x
                            </a>
                        </div> --}}
                        <div class="col-md-4 mt-3">
                            <b>Created At</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            {{ $lm->created_at }}
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Share</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            @php
                                $shareComponentForLMS = \Share::page(
                                    route('user.shops.link', ['shopname' => \App\Models\Shop::where('user_id', $lm->user_id)->first()->name]) . '?promotion_id=' . Auth::user()->promotion_link.'&course_id='. $lm->id . '#item-' . $lm->id,
                                    $lm->title,
                                )
                                ->facebook()
                                ->twitter()
                                ->linkedin()
                                ->telegram()
                                ->whatsapp()        
                                ->reddit();
                            @endphp 

                            {!! $shareComponentForLMS !!}
                        </div>
                        <div class="col-md-12 mt-4 mb-4 text-center">
                            <b>Affiliate Links</b>
                        </div>
                        <div class="Editt">
                            <div class="form">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" value="{{ route('user.shops.link', ['shopname' => \App\Models\Shop::where('user_id', $lm->user_id)->first()->name]) . '?promotion_id=' . Auth::user()->promotion_link.'&course_id='. $lm->id . '#item-' . $lm->id }}" class="input mov" id="myInputLMS{{$lm->id}}" readonly required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type=" button" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy" onclick="copyLMS('{{$lm->id}}')" class="btn btn-secondary push"><i class="mdi mdi-content-copy"></i></button>
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
@endforeach

<script>
    function copy(id) {
        // Get the text field
        var copyText = document.getElementById(`myInput${id}`);

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        alert("Copied the text: " + copyText.value);
    }
</script>

<script>
    function copyLMS(id) {
        // Get the text field
        var copyText = document.getElementById(`myInputLMS${id}`);

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        alert("Copied the text: " + copyText.value);
    }
</script>

@endsection
