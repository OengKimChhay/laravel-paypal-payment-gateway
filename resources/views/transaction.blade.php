<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Here is site title</title>
</head>
<body>

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

</body>
</html>
