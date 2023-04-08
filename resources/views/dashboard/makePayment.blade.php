@extends('layouts.dashboard-frontend')
<!-- place below the html form -->
<script>
  function paySubscriptionWithPaystack(){
    var handler = PaystackPop.setup({
      key: 'pk_test_dafbbf580555e2e2a10a8d59c6157b328192334d',
      email: '{{Auth::user()->email}}',
      amount: '{{$price}}' * 100,
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      callback: function(response){
        let url = '{{ route("user.upgrade.account.confirm", [Crypt::encrypt($plan->id), ":response", Crypt::encrypt($price), Crypt::encrypt($currency)]) }}';
        url = url.replace(':response', response.reference);
        window.location.href=url;
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }
</script>

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row card begin">
                <div class="col-12 account-head">
                    <div class="row py-3 justify-content-between align-items-center">
                        <div class="col-md-12">
                            <h4 class="font-60">{{$plan->name}} Plan</h4>
                            <p>
                                Our service plans grow with your workforce!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="annoyed">
                        @if ($plan->description != "")
                            @foreach(explode(',', $plan->description) as $info) 
                            <h1>
                                <i class="bi bi-check2">{{$info}}</i>
                            </h1>
                            @endforeach
                        @endif
                        <button type="button" onclick="paySubscriptionWithPaystack()">
                            PAY
                        </button>
                    </div>
                </div>
                <div class="col-lg-8"></div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection