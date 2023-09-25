<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank you</title>
</head>
<body>
    <h1>Hurrrayyyy Your Subscription is activated!!</h1>

    <h4>You will be redirect to the main page sortly... :)</h4>


<script>
    function redirectToHomePage() {
        setTimeout(function() {
            window.location.href = "{{ route('product') }}";
        }, 3000);
    }

    window.onload = function() {
        redirectToHomePage();
    };
</script>
</body>
</html>
