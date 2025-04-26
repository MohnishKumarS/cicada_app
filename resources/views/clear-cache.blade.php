<!DOCTYPE html>
<html>
<head>
    <title>Clear Cache</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">

<div class="container">
    <h1>Clear Cache Panel</h1>

    @if(session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
    @endif

    <form action="/clear-cache" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-danger">Clear Laravel Cache</button>
    </form>
</div>

</body>
</html>
