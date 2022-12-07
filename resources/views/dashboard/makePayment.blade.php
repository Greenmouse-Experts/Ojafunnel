@extends('layouts.dashboard-frontend')
<!-- place below the html form -->
<script>
  function payWithPaystack(){
    var handler = PaystackPop.setup({
      key: 'pk_test_dafbbf580555e2e2a10a8d59c6157b328192334d',
      email: '{{$user->email}}',
      amount: {{$amount}} * 100,
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
         custom_fields: [
            {
                plan_id: {{$plan->id}},
            }
         ]
      },
      callback: function(response){
        // var_dump('success. transaction ref is ' + response.reference);
        //   alert(response);
        let url = '{{ route("user.upgrade.account.confirm", [Crypt::encrypt($plan->id), ':response', Crypt::encrypt($amount)]) }}';
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
                            <h4 class="font-60">Launch your online business with {{config('app.name')}}!</h4>
                            <p>
                                Our service plans grow with your workforce!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row Pricing">
                <div class="col-lg-12">
                    <div class="pricing-intro">
                        <h1>
                            <form>
                                <script src="https://js.paystack.co/v1/inline.js"></script>
                                <button type="button" onclick="payWithPaystack()"> Pay </button> 
                            </form>
                        </h1>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection