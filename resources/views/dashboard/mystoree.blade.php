<html lang="en">

<head>
  <meta charset="utf-8" />
  <title> Oja Funnel | Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta content="Oja Funnel |  Dashboard" name="Oja Funnel |  Dashboard" />
  <meta content="Oja Funnel |  Dashboard" name="Oja Funnel |  Dashboard" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{URL::asset('dash/assets/images/Logo-fav.png')}}" />

  <!-- App Css-->
  <link href="{{URL::asset('dash/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
  <!-- Bootstrap Css -->
  <link href="{{URL::asset('dash/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- Icons Css -->
  <link href="{{URL::asset('dash/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- style Css -->
  <link href="{{URL::asset('dash/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <!-- Font Css-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-white">
  <header class="pt-4">
    <div class="container">
      <div class="row justify-content-between align-items-center">
        <div class="col-4 d-flex align-items-center">
          <img src="{{Storage::url($store->logo) ?? URL::asset('dash/assets/image/store-logo.png')}}" alt="" width="40" />
          <h3 class="mt-3 px-2">{{$store->name}}</h3>
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
            <a href="{{route('user.my.store', Auth::user()->username)}}">set up your own store</a>
          </div>
            <a href="{{route('user.cart', Auth::user()->username)}}">
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-cart-check"></i>
                </button>
            </a>
        </div>
      </div>
    </div>
  </header>
  <div class="acc-border my-4"></div>
  <div>
    <div class="container">
      <div class="hero-store d-flex align-items-center justify-content-center">
        <div class="text-center">
          <img src="{{Storage::url($store->logo) ?? URL::asset('dash/assets/image/store-logo.png')}}" alt="" width="60" />
          <h3 class="mt-3 px-2">{{$store->name}}</h3>
        </div>
      </div>
    </div>
  </div>
  <!-- main content -->
  <div class="container">
    <div class="row mt-5">
      <div class="keyword col-lg-3 mt-">
        <h3 class="mt-5">Keyword</h3>
        <div class="mt-4">
          <!-- <div class="search-store w-75 bg-white border-in flex">
              <input14444444
                class="py-2 border-right"
                type="search"
                placeholder="search by name"
                name="store"
                id=""
              />
              <button class="bg-white border-left border-dark">
                <i class="bi bi-search text-dark"></i>
              </button>
            </div> -->
        </div>
        <div class="mt-5">
          <h4>Sort By</h4>
          <ul class="list-unstyled">
            <li class="d-flex align-items-center">
              <input type="radio" name="sortby" id="" />
              <label class="px-2 mt-1">Sections</label>
            </li>
            <li class="d-flex align-items-center">
              <input type="radio" name="sortby" id="" />
              <label class="px-2 mt-1">Lowest Price</label>
            </li>
            <li class="d-flex align-items-center">
              <input type="radio" name="sortby" id="" />
              <label class="px-2 mt-1">Highest Price</label>
            </li>
            <li class="d-flex align-items-center">
              <input type="radio" name="sortby" id="" />
              <label class="px-2 mt-1">A - Z</label>
            </li>
            <li class="d-flex align-items-center">
              <input type="radio" name="sortby" id="" />
              <label class="px-2 mt-1">Z - A</label>
            </li>
          </ul>
        </div>
      </div>
      <div class="products col-lg-9 mt-5">
        <div class="found-head">
          <h3>All Products Found (4)</h3>
        </div>
        <div class="found-con w-100 mt-5">
          <div class="row">
            <div class="col-md-4">
              <div class="founds">
                <div class="found-top"></div>
                <div class="p-2">
                  <p class="font-500">Audio Book</p>
                  <p>10,000 NGN</p>
                  <button><i class="bi bi-cart-check"></i> Add to Cart</button>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="founds">
                <div class="found-top"></div>
                <div class="p-2">
                  <p class="font-500">Chukka Book</p>
                  <p>10,000 NGN</p>
                  <button><i class="bi bi-cart-check"></i> Add to Cart</button>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="founds">
                <div class="found-top"></div>
                <div class="p-2">
                  <p class="font-500">2 Steps</p>
                  <p>10,000 NGN</p>
                  <button><i class="bi bi-cart-check"></i> Add to Cart</button>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-5">
              <div class="founds">
                <div class="found-top"></div>
                <div class="p-2">
                  <p class="font-500">Audio Book</p>
                  <p>10,000 NGN</p>
                  <button><i class="bi bi-cart-check"></i> Add to Cart</button>
                </div>
              </div>
            </div>
            <div class="col-md-4  mb-5">
              <div class="founds">
                <div class="found-top"></div>
                <div class="p-2">
                  <p class="font-500">Chukka Book</p>
                  <p>10,000 NGN</p>
                  <button><i class="bi bi-cart-check"></i> Add to Cart</button>
                </div>
              </div>
            </div>
            <div class="col-md-4  mb-5">
              <div class="founds">
                <div class="found-top"></div>
                <div class="p-2">
                  <p class="font-500">2 Steps</p>
                  <p>10,000 NGN</p>
                  <button><i class="bi bi-cart-check"></i> Add to Cart</button>
                </div>
              </div>
            </div>
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
  <script src="{{URL::asset('dash/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{URL::asset('dash/assets/libs/metismenu/metisMenu.min.js')}}"></script>
  <script src="{{URL::asset('dash/assets/libs/simplebar/simplebar.min.js')}}"></script>
  <script src="{{URL::asset('dash/assets/libs/node-waves/waves.min.js')}}"></script>
  <!-- Code injected by live-server -->
</body>

</html>
