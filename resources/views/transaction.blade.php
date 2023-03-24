<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 7 PayPal Payment Gateway Integration Tutorial</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
</head>
<body>
<div class="container d-flex justify-content-center align-items-center">
				    <div class="row" style="padding: 18px; display: none;" id="paypalbtn">
                      <div>
                          <input type="hidden" name="cmd" value="_xclick">
            			  <input type="hidden" name="business" value="sb-wrj47s1394765104@business.example.com">
                          <input type="hidden" name="currency_code" value="USD">
                          <input type="hidden" name="amount" value="{{ $dPayableAmount }}">
                          <input type="hidden" name="first_name" id="first_name" value="">
                          <input type="hidden" name="last_name" id="last_name" value="">
                          <input type="hidden" name="address1" value="">
                          <input type="hidden" name="address2" value="">
                          <input type="hidden" name="email" value="{{ Crypt::decryptString(Session::get('ue')) }}">
                          <input type="hidden" name="country" value="Saudi Arabia">

                          <input type="hidden" name="return" value="{{ URL('paypal/success') }}">
                          <input type="hidden" name="cancel_return" value="{{ URL('paypal/cancel') }}">

                          <input type="image"
                            src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png" alt="Pay Now" style="cursor: pointer;">

                          <img alt="" src="https://paypalobjects.com/en_US/i/src/pixel.gif" width="1" height="1" style="cursor: pointer;">
                     </div>
				    </div>
				  </div>

</body>
</html>