@extends('layouts.dashboard-frontend')

@section('page-content')
<style>
    div#social-links {
        margin: 0 auto;
        max-width: 500px;
    }
    div#social-links ul li {
        display: grid;
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
                        <h4 class="mb-sm-0 font-size-18">Available Product</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Available Product</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="py-2">
                                    <h4 class="font-500">Available Product</h4>
                                    <p>
                                        All your Available Product in one Place
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create">
                                        <a href="#">
                                            <button type="submit" data-bs-toggle="modal" data-bs-target="#addProduct">
                                                + Add Product
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create">
                                        <a href="#">
                                            <button type="submit" data-bs-toggle="modal" data-bs-target="#addDigitalProduct">
                                                + Add Digital Product
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
                            <h4 class="card-title mb-4">View Product</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Product Type</th>
                                            <th scope="col">Product Image</th>
                                            <th scope="col" style="width: 15%;">Product Description</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Promo Price</th>
                                            <th scope="col">Date From</th>
                                            <th scope="col">Date To</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($product->count() > 0)
                                        @foreach($product as $item)
                                        <tr>
                                            <td>
                                                {{$item->name}}
                                            </td>
                                            <td>
                                                @if($item->type == 'Physical')
                                                Physical
                                                @else
                                                Digital <br>
                                                <a href="{{$item->link}}" target="_blank" class="text-decoration-underline">Preview</a>
                                                @endif
                                            </td>
                                            <td>
                                                <img src="{{Storage::url($item->image) ?? URL::asset('dash/assets/images/product/img-1.png')}}" alt="product-img" title="product-img" class="avatar-md" />
                                            </td>
                                            <td>
                                                <div class="font-size-14 text-wrap" style="width: 500px;">{{$item->description}}</div>
                                            </td>
                                            <td>
                                               {{$item->currency_sign}}{{number_format($item->price, 2)}}
                                            </td>
                                            <td>
                                                {{$item->quantity}}
                                            </td>
                                            <td>
                                                {{$item->currency_sign}}{{number_format($item->new_price)}}
                                            </td>
                                            <td>
                                                {{ $item->date_from ? date("D jS, M Y h:ia", strtotime($item->date_from)) : '' }}
                                            </td>
                                            <td>
                                                {{ $item->date_to ? date("D jS, M Y h:ia", strtotime($item->date_to)) : '' }}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editProduct-{{$item->id}}" type="button">Edit</a></li>

                                                        <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#deleteProduct-{{$item->id}}">Delete</a></li>
                                                    </ul>

                                                    {{-- modal --}}
                                                    @if($item->link == null )
                                                    <div class="modal fade" id="editProduct-{{$item->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content pb-3">

                                                                <div class="modal-header border-bottom-0">
                                                                    <h4 class="card-title mb-4">Add Product</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="Editt">
                                                                        <form action="{{route('user.store.product.update', ['username' => Auth::user()->username, 'store_id' => $store_id, 'id' => $item->id])}}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Product Name</label>
                                                                                        <input type="text" name="name" value="{{$item->name}}" placeholder="Enter product name" required />
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Image</label>
                                                                                        <input type="file" name="image" />
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Product Description</label>
                                                                                        <textarea name="description" id="" cols="30" rows="10" placeholder="Enter your product description" required>
                                                                                        {{$item->description}}
                                                                                        </textarea>
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Price</label>
                                                                                        <input type="number" name="price" value="{{$item->price}}" placeholder="Enter price" required />
                                                                                    </div>
                                                                                    <div class="col-lg-6 mb-4">
                                                                                        <label for="Name">Currency</label>
                                                                                        <input type="text" name="currency" value="{{$item->currency}}" placeholder="Enter currency" required />
                                                                                    </div>
                                                                                    <div class="col-lg-6 mb-4">
                                                                                        <label for="Name">Currency Sign</label>
                                                                                        <input type="text" name="currency_sign" value="{{$item->currency_sign}}" placeholder="Enter currency sign" required />
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Quantity</label>
                                                                                        <input type="number" name="quantity" value="{{$item->quantity}}" required />
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Level 1 Commission (%)</label>
                                                                                        <input type="number" name="level1_comm" value="{{$item->level1_comm}}" required />
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Level 2 Commission (%)</label>
                                                                                        <input type="number" name="level2_comm" value="{{$item->level2_comm}}" required />
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
                                                    @else
                                                    <div class="modal fade" id="editProduct-{{$item->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content pb-3">

                                                                <div class="modal-header border-bottom-0">
                                                                    <h4 class="card-title mb-4">Add Product</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="Editt">
                                                                        <form action="{{route('user.store.digital.product.update', ['username' => Auth::user()->username, 'store_id' => $store_id, 'id' => $item->id])}}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Product Name</label>
                                                                                        <input type="text" name="name" value="{{$item->name}}" placeholder="Enter product name" required />
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Product Type</label>
                                                                                        <select name="content_type">
                                                                                            <option value="{{$item->content_type}}">{{$item->content_type}}</option>
                                                                                            <option value="">-- Select Product Type --</option>
                                                                                            <option value="video">Video</option>
                                                                                            <option value="audio">Audio</option>
                                                                                            <option value="ebook">Ebook</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Product File</label>
                                                                                        <input type="file" name="file" />
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Image</label>
                                                                                        <input type="file" name="image" />
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Product Description</label>
                                                                                        <textarea name="description" id="" cols="30" rows="10" placeholder="Enter your product description" required>
                                                                                        {{$item->description}}
                                                                                        </textarea>
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Price</label>
                                                                                        <input type="number" name="price" value="{{$item->price}}" placeholder="Enter price" required />
                                                                                    </div>
                                                                                    <div class="col-lg-6 mb-4">
                                                                                        <label for="Name">Currency</label>
                                                                                        <input type="text" name="currency" value="{{$item->currency}}" placeholder="Enter currency" required />
                                                                                    </div>
                                                                                    <div class="col-lg-6 mb-4">
                                                                                        <label for="Name">Currency Sign</label>
                                                                                        <input type="text" name="currency_sign" value="{{$item->currency_sign}}" placeholder="Enter currency sign" required />
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Quantity</label>
                                                                                        <input type="number" name="quantity" value="{{$item->quantity}}" required />
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Level 1 Commission (%)</label>
                                                                                        <input type="number" name="level1_comm" value="{{$item->level1_comm}}" required />
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="Name">Level 2 Commission (%)</label>
                                                                                        <input type="number" name="level2_comm" value="{{$item->level2_comm}}" required />
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
                                                    @endif
                                                    <div class="modal fade" id="deleteProduct-{{$item->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" style="max-width: 35%">
                                                            <div class="modal-content pb-3">

                                                                <div class="modal-header border-bottom-0">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="Editt">
                                                                        <form action="{{route('user.store.product.delete', ['username' => Auth::user()->username, 'id' => $item->id])}}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <div class="row">
                                                                                    <h3 style="text-align: center; margin-bottom: 15%;">Are you sure you want to delete this product <br> ({{$item->name}})</h3>
                                                                                    <div class="row justify-content-between">
                                                                                        <div class="col-6">
                                                                                            <a href="#" class="text-decoration-none">
                                                                                                <button type="button" data-bs-dismiss="modal" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                                    Cancel
                                                                                                </button></a>
                                                                                        </div>
                                                                                        <div class="col-6 text-end">
                                                                                            <a href="#" class="text-decoration-none">
                                                                                                <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #BA0028">
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
                                        @endforeach
                                        @endif
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
<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <h4 class="card-title mb-4">Add Product</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="Editt">
                    <form action="{{route('user.store.product.add', ['username' => Auth::user()->username, 'store_id' => $store_id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form">
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Product Name</label>
                                    <input type="text" name="name" placeholder="Enter product name" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Image</label>
                                    <input type="file" name="image" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Product Description</label>
                                    <textarea name="description" id="" cols="30" rows="10" placeholder="Enter your product description" required></textarea>
                                </div>
                                <div class="col-lg-9 mb-4">
                                    <label for="Name">Price</label>
                                    <input type="number" name="price" placeholder="Enter price" required />
                                    <span style="color:red;">Please enter numbers</span>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="Name">Currency</label>
                                    <input type="text" name="currency" placeholder="Enter currency" required />
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="Name">Currency Sign</label>
                                    <input type="text" name="currency_sign" placeholder="Enter currency sign" required />
                                </div>
                                <div class="col-lg-3 mb-4 ps-0">
                                    <button type="button" class="btn mt-2 addTimer" style="color:#714091; border:1px solid #714091; padding:13px 10px; background:#ccc;border:1px solid #999">
                                        Add Timer
                                    </button>
                                </div>

                                <div class="col-lg-12 mb-2 dynamic_timer p-3" style="background:#eee; border-radius:8px; display:none">
                                    <div class="row">
                                        <div style="margin:-5px 0 10px 0; font-size:12px; line-height:19px">If price is entered, date from and date to must be entered as well</div>
                                        <div class="col-lg-6 mb-2 pe-1">
                                            <label>From</label>
                                            <input type="datetime-local" name="from" placeholder="Select Date" />
                                        </div>
                                        <div class="col-lg-6 mb-2 ps-1">
                                            <label>To</label>
                                            <input type="datetime-local" name="to" placeholder="Select Date" />
                                        </div>
                                        <div class="col-lg-12 mb-0">
                                            <label>Price</label>
                                            <input type="number" name="new_price" placeholder="Enter new price" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Quantity</label>
                                    <input type="number" name="quantity" placeholder="Enter quantity" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Level 1 Commision (%)</label>
                                    <input type="number" name="level1_comm" placeholder="Enter level 1 commission" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Level 2 Commision (%)</label>
                                    <input type="number" name="level2_comm" placeholder="Enter level 2 commission" required />
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
<!-- end modal -->
<!-- SuccessModal -->
<div class="modal fade" id="addDigitalProduct" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <h4 class="card-title mb-4">Add Digital Product</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="Editt">
                    <form action="{{route('user.store.digital.product.add', ['username' => Auth::user()->username, 'store_id' => $store_id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form">
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Product Name</label>
                                    <input type="text" name="name" placeholder="Enter product name" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Product Type</label>
                                    <select name="content_type" required>
                                        <option value="">-- Select Product Type --</option>
                                        <option value="video">Video</option>
                                        <option value="audio">Audio</option>
                                        <option value="ebook">Ebook</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Product File</label>
                                    <input type="file" name="file" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Image</label>
                                    <input type="file" name="image" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Product Description</label>
                                    <textarea name="description" id="" cols="30" rows="10" placeholder="Enter your product description" required></textarea>
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Price</label>
                                    <input type="number" name="price" placeholder="Enter price" required />
                                    <span style="color:red;">Please enter numbers</span>
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Currency</label>
                                    <input type="text" name="currency" placeholder="Enter currency" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Currency Sign</label>
                                    <input type="text" name="currency_sign" placeholder="Enter currency sign" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Quantity</label>
                                    <input type="number" name="quantity" placeholder="Enter quantity" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Level 1 Commision (%)</label>
                                    <input type="number" name="level1_comm" placeholder="Enter level 1 commission" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Level 2 Commision (%)</label>
                                    <input type="number" name="level2_comm" placeholder="Enter level 2 commission" required />
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
<!-- end modal -->
@endsection
