<!DOCTYPE html>
<html>

<head>
    <title>Employee App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light text-dark">
    <div class="container mt-5">
        <div class="d-flex justify-content-end gap-2 mb-3">
            <a href="{{ route('lang.switch', 'en') }}" class="btn btn-sm btn-primary">English</a>
            <a href="{{ route('lang.switch', 'ar') }}" class="btn btn-sm btn-primary">العربية</a>
        </div>


        @yield('content')

    </div>
</body>

</html>