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


<!-- <div class="panel panel-default">
    <div class="panel-body">
        <h1 class="text-3xl md:text-5xl font-extrabold text-center uppercase mb-12 bg-gradient-to-r from-indigo-400 via-purple-500 to-indigo-600 bg-clip-text text-transparent transform -rotate-2">Make A Payment</h1>
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        <form action="{{ route('stripe.store') }}" method="POST" id="card-form">
            @csrf
            <div class="mb-3">
                <label for="card-name" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Your name</label>
                <input type="text" name="name" id="card-name" class="border-2 border-gray-200 h-11 px-4 rounded-xl w-full">
            </div>
            <div class="mb-3">
                <label for="email" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Email</label>
                <input type="email" name="email" id="email" class="border-2 border-gray-200 h-11 px-4 rounded-xl w-full">
            </div>
            <div class="mb-3">
                <label for="card" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Card details</label>

                <div class="bg-gray-100 p-6 rounded-xl">
                    <div id="card"></div>
                </div>
            </div>
            <button type="submit" class="w-full bg-indigo-500 uppercase rounded-xl font-extrabold text-white px-6 h-12">Pay 👉</button>
        </form>
    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script>
    let stripe = Stripe('pk_test_51JCNT7LR3IU56nZgvfJ1uXeTt8gzDz0WsCne4wCvvMtaJ09YGJqEhnp5Abz7XUQ9dnmQQlljslXsp6r0hALOSuGm00Re1BTpx8')
    const elements = stripe.elements()
    const cardElement = elements.create('card', {
        style: {
            base: {
                fontSize: '16px'
            }
        }
    })
    const cardForm = document.getElementById('card-form')
    const cardName = document.getElementById('card-name')
    cardElement.mount('#card')
    cardForm.addEventListener('submit', async (e) => {
        e.preventDefault()
        const {
            paymentMethod,
            error
        } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
            billing_details: {
                name: cardName.value
            }
        })
        if (error) {
            console.log(error)
        } else {
            let input = document.createElement('input')
            input.setAttribute('type', 'hidden')
            input.setAttribute('name', 'payment_method')
            input.setAttribute('value', paymentMethod.id)
            cardForm.appendChild(input)
            cardForm.submit()
        }
    })
</script> -->
