@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="main-content">
  <div class="page-content">
    <!-- container-fluid -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
            <h4 class="mb-sm-0 font-size-18">My Store</h4>

            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                <li class="breadcrumb-item active">My Store</li>
              </ol>
            </div>

          </div>
        </div>
      </div>
      <!-- start page title -->
      <div class="row">
        <div class="col-lg-12">
          <div class="card account-head">
            <div class="row">
              <div class="col-md-9">
                <div class="py-2">
                  <h4 class="font-600">My Store</h4>
                  <p>
                    All your shops and the products in them
                  </p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="">
                  <div class="all-create">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#createContactList">
                      Create New Store
                    </button>
                  </div>
                </div>
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
              <h4 class="card-title mb-4">All Stores</h4>
              <div class="table-responsive">
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                  <thead class="tread">
                    <tr>
                      <th>S/N</th>
                      <th>Store Name</th>
                      <th>Available Product</th>
                      <th>Store Link</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Chukka Shoes</td>
                      <td>120</td>
                      <td>
                        <a href="store.html" class="text-decoration-underline">Preview</a>
                      </td>
                      <td>
                        <div class="dropdown dropstart">
                          <button class="btn-list dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" style="border: none; background:#fff">
                            View More
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                              <a class="dropdown-item" href="#">
                              View Shop
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item" type="button">
                              Edit Shop
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item" type="button">
                              Manage Shop
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item" type="button">
                                Delete Shop
                              </a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="container">
        <div class="store-table">
          <div class="table-head row pt-4">
            <div class="col-lg-6">
              <h3>All Stores</h3>
            </div>
          </div>
          <div class="table-body mt-5 table-responsive">
            <table class="table text-center">
              <thead class="fw-bold bg-light rounded-pill">
                <tr>
                  <th scope="col">S/N</th>
                  <th scope="col">Store Name</th>
                  <th scope="col">Available Product</th>
                  <th scope="col">Store Link</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Chukka Shoes</td>
                  <td>120</td>
                  <td>
                    <a href="store.html" class="text-decoration-underline">Preview</a>
                  </td>
                  <td>
                    <div class="d-flex justify-content-center">
                      <ul class="list-unstyled d-flex">
                        <li class="px-1">
                          <a href="#" class="text-decoration-none">View Shop</a>
                        </li>
                        <li class="px-1">
                          <a href="#" class="text-decoration-none">Edit Shop</a>
                        </li>
                        <li class="px-1">
                          <a href="#" class="text-decoration-none">Manage Shop</a>
                        </li>
                        <li class="px-1">
                          <a href="#" class="text-decoration-none text-danger">Delete Shop</a>
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Chukka Digital Books</td>
                  <td>12</td>
                  <td>
                    <a href="store.html" class="text-decoration-underline">Preview</a>
                  </td>
                  <td>
                    <div class="d-flex justify-content-center">
                      <ul class="list-unstyled d-flex">
                        <li class="px-1">
                          <a href="#" class="text-decoration-none">View Shop</a>
                        </li>
                        <li class="px-1">
                          <a href="#" class="text-decoration-none">Edit Shop</a>
                        </li>
                        <li class="px-1">
                          <a href="#" class="text-decoration-none">Manage Shop</a>
                        </li>
                        <li class="px-1">
                          <a href="#" class="text-decoration-none text-danger">Delete Shop</a>
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div> -->
      <!-- end page title -->
    </div>
  </div>
  <!-- End Page-content -->
</div>
@endsection