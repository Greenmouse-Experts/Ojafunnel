<script src="https://checkout.flutterwave.com/v3.js"></script>
<form>
  <div>
    Your order is ₦2,500
  </div>
  <button type="button" id="start-payment-button" onclick="makePayment()">Pay Now</button>
</form>
<script>
  function makePayment() {
    // FlutterwaveCheckout({
    //   public_key: "FLWPUBK_TEST-8d8edca06ec9268f0478286ec1d1728d-X",
    //   tx_ref: "txref-DI0NzMx12",
    //   amount: 2500,
    //   currency: "NGN",
    //   payment_options: "card, banktransfer, ussd",
    //   meta: {
    //     source: "docs-inline-test",
    //     consumer_mac: "92a3-912ba-1192a",
    //   },
    //   customer: {
    //     email: "test@mailinator.com",
    //     phone_number: "08100000000",
    //     name: "Ayomide Jimi-Oni",
    //   },
    //   customizations: {
    //     title: "Flutterwave Developers",
    //     description: "Test Payment",
    //     logo: "https://checkout.flutterwave.com/assets/img/rave-logo.png",
    //   },
    // });

    FlutterwaveCheckout({
        public_key: "FLWPUBK_TEST-8d8edca06ec9268f0478286ec1d1728d-X",
        tx_ref: "ay_" + Math.floor((Math.random() * 1000000000) + 1),
        amount: 100,
        currency: "NGN",
        customer: {
            email: 'testing@gmail.com',
            phonenumber: '+234',
            name: 'Testing'
        },
        callback: function (data) {
            console.log(data);
            const reference = data.tx_ref;
            alert("payment was successfully completed" + reference)
        },
        customizations: {
            "title": "Wonderful Direct pharmacy",
            "description": "payment integration",
            "logo": "https://image.flaticon.com/icons/png/512/809/809957.png"
        }
    });
  }
</script>
