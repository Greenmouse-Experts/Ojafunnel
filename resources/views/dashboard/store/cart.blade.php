<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>{{$store->name}} | Oja Funnel | StoreFront</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta content="title" name="{{$store->name}} | Oja Funnel | StoreFront" />
  <meta content="description" name="{{$store->description}} | Oja Funnel | StoreFront" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{Storage::url($store->logo)}}" />

  <!-- App Css-->
  <link href="{{URL::asset('dash/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
  <!-- Bootstrap Css -->
  <link href="{{URL::asset('dash/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
  <!-- Icons Css -->
  <link href="{{URL::asset('dash/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- style Css -->
  <link href="{{URL::asset('dash/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <!-- Font Css-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-white">
  <header class="pt-4">
    <div class="container">
      <div class="row justify-content-between align-items-center">
        <div class="col-4 d-flex align-items-center">
            <a href="{{route('user.stores.link', $store->name)}}" style="display: contents;">
                <img src="{{Storage::url($store->logo) ?? URL::asset('dash/assets/image/store-logo.png')}}" alt="" width="40" />
                <h3 class="mt-3 px-2">{{$store->name}}</h3>
            </a>
        </div>
        <div class="col-4">
          <form class="app-search d-none d-lg-block">
            <div class="position-relative">
              <input type="text" class="form-control" placeholder="Search...">
              <span class="bx bx-search-alt"></span>
            </div>
          </form>
        </div>
        <div class="col-3 d-flex align-items-center justify-content-between">
          <div>
            @auth
                <a href="{{route('user.my.store', Auth::user()->username)}}">Go to store</a>
            @else
                <a href="{{route('index')}}">Set up your own store</a>
            @endauth
          </div>

            {{-- <a href="{{route('user.cart', Auth::user()->username)}}">
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-cart-check"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}
                </button>
            </a> --}}
            <div class="dropdown">
                <button type="button" class="btn btn-info dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                </button>

                <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1">
                    <div class="row total-header-section">
                        <div class="col-lg-6 col-sm-6 col-6">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                        </div>
                        @php $total = 0 @endphp
                        @foreach((array) session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                        @endforeach
                        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                            <p>Total: <span class="text-info">{{ $total }}</span></p>
                        </div>
                    </div>
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            <div class="row cart-detail">
                                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                    <img style="width: 70px" src="{{ Storage::url($details['image']) }}" />
                                </div>
                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                    <p>{{ $details['name'] }}</p>
                                    <span class="price text-info"> {{$details['currency_sign']}}{{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                            <a href="{{ route('cart', $store->name) }}" class="btn btn-primary btn-block">View all</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </header>
  <div class="acc-border my-4"></div>

  <!-- main content -->
  <div class="container">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Cart</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-nowrap">
                                    <thead class="tread">
                                        <tr class="font-500">
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Images</th>
                                            <th scope="col">Product Description</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0 @endphp
                                        @if(session('cart'))
                                            @foreach(session('cart') as $id => $details)
                                                @php $total += $details['price'] * $details['quantity'] @endphp
                                                    <tr data-id="{{ $id }}">
                                                        <td>
                                                            <h5 class="font-size-14 text-truncate"><a href="#" class="text-dark">{{ $details['name'] }}</a></h5>
                                                        </td>
                                                        <td>
                                                            <img src="{{Storage::url($details['image'])}}" alt="product-img" title="product-img" class="avatar-md" />
                                                        </td>
                                                        <td>
                                                            <h5 class="font-size-14 text-wrap" style="width: 330px;"><a href="#" class="text-dark">{{ $details['description'] }}</a></h5>
                                                        </td>
                                                        <td>
                                                            {{$store->currency_sign}}<span id="price">{{ $details['price'] }}</span>
                                                        </td>
                                                        <td style="display: flex; flex-direction: row">
                                                            <!-- <button class="btn btn-danger" style="margin-right: 10px;font-size: 18px;">-</button> -->
                                                            <!-- <div class="me-3" style="width: 80px;margin-top: 10px">
                                                                <input type="number" id="qty" onkeyup="compute_tcost()" value="{{ $details['quantity'] }}" class="form-control quantity update-cart>
                                                                <small style="font-size: 63%">Availabe: {{ $details['rmQuan'] }}</small>
                                                            </div> -->
                                                            <!-- <button class="btn btn-success">+</button> -->
                                                            <div class="me-3" style="width: 80px; margin-top: 10px">
                                                                <input type="number" class="form-control quantity"
                                                                    data-item-id="{{ $details['id'] }}"
                                                                    data-avail-quantity="{{ $details['rmQuan'] }}"
                                                                    value="{{ $details['quantity'] }}">
                                                                <small style="font-size: 63%">Available: {{ $details['rmQuan'] }}</small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{$store->currency_sign}}<span id="tcost">{{ $details['price'] * $details['quantity'] }}</span>
                                                        </td>
                                                        <td>
                                                            <a href="javascript(0);" class="action-icon text-danger remove-from-cart"> <i class="mdi mdi-trash-can font-size-18"></i></a>
                                                        </td>
                                                    </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7" class="text-end"><h3>Total {{$store->currency_sign}}{{number_format($total, 2) }}</h3></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="
                                    @if(Request::has('product_id'))
                                        {{
                                            route('user.stores.link', [
                                                'storename' => $store->name,
                                                'promotion_id' => Request::get('promotion_id'),
                                                'product_id' => Request::get('product_id')
                                            ]) . '#item-' . Request::get('product_id')
                                        }}
                                    @else
                                    {{
                                        route('user.stores.link', [
                                            'storename' => $store->name,
                                            'promotion_id' => Request::get('promotion_id'),
                                            'product_id' => Request::get('product_id')
                                        ])
                                    }}
                                    @endif
                                    " class="btn text-muted d-none d-sm-inline-block btn-link"><i class="mdi mdi-arrow-left me-1"></i> Continue Shopping</a>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-end">
                                        <a href="
                                            {{
                                                route('checkout', [
                                                    'storename' => $store->name,
                                                    'promotion_id' => Request::get('promotion_id'),
                                                    'product_id' => Request::get('product_id')
                                                ])
                                            }}
                                            " class="btn btn-success">
                                            <i class="mdi mdi-truck-fast me-1"></i> Proceed to Checkout </a>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- Modal -->
<div class="modal fade" id="CartDelete" tabindex="-1" aria-labelledby="CartDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body px-4 py-5 text-center">
                <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="avatar-sm mb-4 mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
                <p class="text-muted font-size-16 mb-4">Are you sure you want to permanently remove this Product.</p>

                <div class="hstack gap-2 justify-content-center mb-0">
                    <button type="button" class="btn btn-danger">Delete Now</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 mb-2 mt-5">
          <div class="text-center text-dark">Copyright ©
            <script>
              document.write(new Date().getFullYear())
            </script> {{config('app.name')}} | All Right Reserved
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Button trigger modal -->


  <!-- JAVASCRIPT -->
  <script src="{{URL::asset('dash/assets/libs/jquery/jquery.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="{{URL::asset('dash/assets/libs/metismenu/metisMenu.min.js')}}"></script>
  <script src="{{URL::asset('dash/assets/libs/simplebar/simplebar.min.js')}}"></script>
  <script src="{{URL::asset('dash/assets/libs/node-waves/waves.min.js')}}"></script>

  <script>

//     function compute_tcost() {
//         var price = $("#price").text();
//         var qty = $("#qty").val();

//         if(qty == "") {
//             $("#qty").val("1");
//             qty = "1";
//         }

//         if(qty == "0") {
//             $("#qty").val("1");
//             qty = "1";
//         }

//         var tcost = Number.parseInt(price) * Number.parseInt(qty);
//         $("#tcost").html(tcost);
//     }

//   $(".update-cart").change(function (e) {
//       e.preventDefault();

//       var ele = $(this);
//       var quantity = ele.parents("tr").find(".quantity").val();
//       var rm = "{{ $details['rmQuan'] ?? 0 }}";
//       if (quantity > parseInt(rm)) {
//         ele.parents("tr").find(".quantity").val(parseInt(rm))
//       }
//       else{
//         $.ajax({
//           url: '{{ route('update.cart') }}',
//             method: "patch",
//             data: {
//                 _token: '{{ csrf_token() }}',
//                 id: ele.parents("tr").attr("data-id"),
//                 quantity: quantity
//             },
//             success: function (response) {
//                 window.location.reload();
//             }
//         });
//       }

//   });

    function debounce(func, wait) {
        let timeout;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                func.apply(context, args);
            }, wait);
        };
    }

    $('.quantity').on('input', debounce(function () {
        const input = $(this);
        const itemId = input.data('item-id');
        const availQuantity = input.data('avail-quantity');
        const quantity = parseInt(input.val()) || 0;

        if (quantity > availQuantity) {
            input.val(availQuantity);
        } else {
            updateCart(itemId, quantity);
        }
    }, 500));

    function updateCart(itemId, quantity) {
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: 'patch',
            data: {
                _token: '{{ csrf_token() }}',
                id: itemId,
                quantity: quantity
            },
            success: function (response) {
                window.location.reload();
            },
            error: function (xhr, status, error) {
                // Handle AJAX request errors here
                console.log(error);
            }
        });
    }

  $(".remove-from-cart").click(function (e) {
      e.preventDefault();

      var ele = $(this);

      if(confirm("Are you sure want to remove?")) {
          $.ajax({
              url: '{{ route('remove.from.cart') }}',
              method: "DELETE",
              data: {
                  _token: '{{ csrf_token() }}',
                  id: ele.parents("tr").attr("data-id")
              },
              success: function (response) {
                  window.location.reload();
              }
          });
      }
  });
  </script>
  <!-- Code injected by live-server -->
</body>
<style>
.thumbnail {
    position: relative;
    padding: 0px;
    margin-bottom: 20px;
}
.thumbnail img {
    width: 80%;
}
.thumbnail .caption{
    margin: 7px;
}
.main-section{
    background-color: #F8F8F8;
}
.dropdown button.btn-info{
    /* float:right;
    padding-right: 30px; */
    color: {{$store->color}};
    background: {{$store->theme}};
}
.btn-success{
    color: {{$store->color}} !important;
    background: {{$store->theme}} !important;
}
.btn{
    border:0px;
    margin:10px 0px;
    box-shadow:none !important;
}
.dropdown .dropdown-menu{
    padding:20px;
    /*top:30px !important;*/
    width:350px !important;
    /*left:-110px !important;*/
    box-shadow:0px 4px 7px #a8a7a7;
}
.total-header-section{
    border-bottom:1px solid #d2d2d2;
}
.total-section p{
    margin-bottom:20px;
}
.cart-detail{
    padding:15px 0px;
}
.cart-detail-img img{
    width:100%;
    height:100%;
    padding-left:15px;
}
.cart-detail-product p{
    margin:0px;
    color:#000;
    font-weight:500;
}

span.text-info{
    color: {{$store->theme}} !important;
}
.cart-detail .price{
    font-size:12px;
    margin-right:10px;
    font-weight:500;
}
.cart-detail .count{
    color:#C2C2DC;
}
.checkout{
    border-top:1px solid #d2d2d2;
    padding-top: 15px;
}
.checkout .btn-primary{
    color: {{$store->color}};
    background: {{$store->theme}};
}
.dropdown-menu:before{
    content: " ";
    position:absolute;
    top:-20px;
    right:50px;
    border:10px solid transparent;
    border-bottom-color:#fff;
}
</style>
</html>
