<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Here is site title</title>
</head>
<body>
    inter amount
    <form action="{{ route('processTransaction')}}" method="GET">
        @csrf
        <input type="number" name="amount">
        <button type="submit">Pay</button>
    </form>
    <h1>
        @if (session()->has('error'))
        {{ session()->get('error') }}
        @endif
        @if (session()->has('success'))
        {{ session()->get('success') }}
        @endif
    </h1>
    <br>
    or without open another tap <br>
    <input type="number" id="amount">
    <div id="paypal-button-container" style="max-width:100px;"></div>



    <script src="https://www.paypal.com/sdk/js?client-id=AfVD6aEUZKQGYPe670gnugKPZH0xjgtB9gYUsE2A5tHJAoEGGnBQvjA0wcGB8Eat7In7GC-tGizcGFMS&currency=USD"></script>
    <script>
        paypal.Buttons({

            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                const amount = document.getElementById('amount').value;
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: amount // Can also reference a variable or function
                        }
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For dev/demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                    // When ready to go live, remove the alert and show a success message within this page. For example:
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            }
        }).render('#paypal-button-container');

    </script>
</body>
</html>
