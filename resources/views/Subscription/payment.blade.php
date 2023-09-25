<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subscription Payment</title>
</head>
<body>
    <div>
        <h3>Your Subscription ID is :  {{$subs->id}}</h3>
        Click on PayNow Button to activate subscription now!!
        <div>
            <button id="rzp-button">Pay Now</button>
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <script>
                var subid = "{{ $subs->id }}";
                var options = {
                "key": "{{ env('RAZORPAY_KEY') }}",
                "subscription_id": subid,
                "name": "My Billing Label",
                "description": "Auth txn for " + subid,
                "handler": function (response){
                    if (response.razorpay_payment_id) {
                        window.location.href = "{{ route('suscription.confirm') }}";
                    } else {
                        alert('Payment failed. Please try again.');
                    }
                }
                };
                var rzp1 = new Razorpay(options);
                document.getElementById('rzp-button').onclick = function(e){
                rzp1.open();
                }
            </script>
        </div>
    </div>
</body>
</html>
