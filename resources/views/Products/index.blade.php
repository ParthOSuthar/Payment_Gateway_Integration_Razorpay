<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product List</title>
</head>
<body>
    {{-- <ul>
        @foreach ($products as $product)
        <form action="{{route('product.buy',['product' => $product->id])}}" method="POST">
            @csrf
            <li>{{$product->name}}</li>
            <button type="submit">Pay {{$product->price}} ₹</button>
        </form>
        @endforeach
    </ul> --}}
    <div class="card card-default">
        <div style="text-align: center">
            <h2> Laravel - Razorpay Payment Gateway Integration </h2>
        </div>
        <div class="card-body text-center" style="margin-top: 20px; display:flex; justify-content:center">
            @foreach ($products as $product)
            <div style="text-align:center">
                <div style="margin: 5px; padding:20px; background:whitesmoke; width:50%; font-size:15px; font-weight:bold">
                    <form action="{{ route('razorpay.payment.store') }}" method="POST" >
                        @csrf
                        <label>{{$product->name}}</label>
                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ env('RAZORPAY_KEY') }}"
                                data-amount="{{$product->price*100}}"
                                data-buttontext="Pay {{$product->price}} INR"
                                data-name="Demo Payment"
                                data-description="Razorpay payment"
                                data-image="data:image/png;base64,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"
                                data-prefill.name="ABC"
                                data-prefill.email="abc@gmail.com"
                                data-theme.color="#ff7529">
                        </script>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

            <div style="text-align: center">
                <h2>List of All Plans Available</h2>
                @foreach ($plans->items as $plan)
                <form action="{{route('subscription.page')}}" method="POST">
                    @csrf
                    <div style="display:flex; justify-content:center">
                        <div style="margin: 5px; padding:20px; background:whitesmoke; width:30%; font-size:15px; font-weight:bold">
                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                            <input type="hidden" name="plan_name" value="{{ $plan->item->name }}">
                            <input type="hidden" name="plan_description" value="{{ $plan->item->description }}">
                            <input type="hidden" name="plan_amount" value="{{ $plan->item->amount }}">
                            <input type="hidden" name="plan_interval" value="{{ $plan->period }}">
                            <label>Plan ID :  {{$plan->id}}</label><br>
                            <label>Name :  {{$plan->item->name}}</label><br>
                            <label>Description :  {{$plan->item->description}}</label><br>
                            <label>Amount per Interval :  {{$plan->item->amount/100}}  INR</label><br>
                            <label>Interval :  {{$plan->period}}</label><br><br>
                            <button type="submit">Subscribe Now</button>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
    </div>
</body>
</html>
