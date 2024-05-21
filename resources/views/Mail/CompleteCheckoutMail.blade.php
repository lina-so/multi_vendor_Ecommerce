<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Checkout Completed</title>
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success">
            <h4> Thanks to Choose Our Store <strong>{{ $user->name }}</strong> Your order has been received successfully!</h4>
            <p>Thank you for your order. It will be reviewed shortly.</p>
        </div>

        <div class="row mt-4">
            <div class="col">
              <div class="alert alert-info" role="alert">
                If you have any questions regarding your order, feel free to contact us at <a href="mailto:support@ourstore.com">support@arzonastore.com</a>.
              </div>
            </div>
    </div>


</body>
</html>
