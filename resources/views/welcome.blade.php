<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>
    <div class="container">

        <form class="d-flex justify-content-center align-items-center vh-100 flex-row" style="width: 100%" action="{{ route('Post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" class="form-control" accept="image/*" multiple name="image[]">
            <input type="submit" value="Send it" class="btn ms-1 btn-dark">
        </form>
    </div>
</body>
</html>
