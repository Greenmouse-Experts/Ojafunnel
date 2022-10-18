@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="main-content">
        <div class="page-content">
          <!-- container-fluid -->
          <div class="container-fluid">
            <!-- start page title -->
            <div class="row card begin mt-1">
              <div class="col-12 account-head">
                <div
                  class="row justify-content-between align-items-center"
                >
                  <div class="col">
                    <h4 class="font-60">My Store</h4>
                    <p>All your shops and the products in them</p>
                  </div>
                  <div class="col text-end">
                    <a href="{{route('user.my.store')}}"
                      ><button
                        class="btn px-3"
                        style="color: #714091; border: 1px solid #714091"
                      >
                        Create New Store
                      </button></a
                    >
                  </div>
                </div>
              </div>
            </div>
            <!-- store data information-->
            <div class="store-table">
                <div class="table-head row pt-4">
                  <div class="col-lg-6"><h3>All Stores</h3></div>
                  <div class="col-lg-6 search-item">
                    <div class="bg-light search-store border-in flex">
                      <input
                        class="bg-light"
                        type="search"
                        placeholder="search by name"
                        name="store"
                        id=""
                      />
                      <button><i class="bi bi-search"></i></button>
                    </div>
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
                          <a href="{{route('user.store')}}" class="text-decoration-underline"
                            >Preview</a
                          >
                        </td>
                        <td>
                          <div class="d-flex justify-content-center">
                            <ul class="list-unstyled d-flex">
                              <li class="px-1">
                                <a href="{{route('user.my.store')}}" class="text-decoration-none"
                                  >View Shop</a
                                >
                              </li>
                              <li class="px-1">
                                <a href="#" class="text-decoration-none"
                                  >Edit Shop</a
                                >
                              </li>
                              <li class="px-1">
                                <a href="#" class="text-decoration-none"
                                  >Manage Shop</a
                                >
                              </li>
                              <li class="px-1">
                                <a
                                  href="#"
                                  class="text-decoration-none text-danger"
                                  >Delete Shop</a
                                >
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
                          <a href="{{route('user.store')}}" class="text-decoration-underline"
                            >Preview</a
                          >
                        </td>
                        <td>
                          <div class="d-flex justify-content-center">
                            <ul class="list-unstyled d-flex">
                              <li class="px-1">
                                <a href="{{route('user.my.store')}}" class="text-decoration-none"
                                  >View Shop</a
                                >
                              </li>
                              <li class="px-1">
                                <a href="#" class="text-decoration-none"
                                  >Edit Shop</a
                                >
                              </li>
                              <li class="px-1">
                                <a href="#" class="text-decoration-none"
                                  >Manage Shop</a
                                >
                              </li>
                              <li class="px-1">
                                <a
                                  href="#"
                                  class="text-decoration-none text-danger"
                                  >Delete Shop</a
                                >
                              </li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div
                  class="row align-items-center table-footer mt-4 bg-light rounded-pill"
                >
                  <div class="col-6 mt-2 fw-bold ps-4">
                    <p>132 products in total</p>
                  </div>
                  <div class="col-6 text-end">
                    <button
                      class="btn mx-4 fw-bold fs-4 btn-outline-dark py-0 px-2"
                    ></button>
                    <button
                      class="btn fw-bold fs-4 btn-outline-dark py-0 px-2"
                    ></button>
                  </div>
                </div>
              </div>
            <!-- end page title -->
          </div>
        </div>
        <!-- End Page-content -->

        <footer class="footer border-0 bg-transparent mt-5">
          <div class="container-fluid mt-5">
            <div class="row text-center bg-white mt-5">
              <div class="text-center py-4">
                Copyright ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                Ojafunnel | All Right Reserved
              </div>
            </div>
          </div>
        </footer>
      </div>
@endsection