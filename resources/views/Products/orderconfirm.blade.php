<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank You</title>
</head>
<body>
<div class="main">
    <h1>Congratulations!! You Ordered Successfully</h1>
    <h3>Your Order Details are...</h3>
@foreach ($paymentdetails as $paymentdetail)
    <h3>User Email : {{$paymentdetail->user_email}}</h3>
    <h3>Billing Amount : {{$paymentdetail->amount}}.00 INR</h3>
    <h3>Transaction ID : {{$paymentdetail->r_payment_id}}</h3>
@endforeach

<a href="{{route('product')}}"> back to home page </a>

</div>
</body>
</html>
