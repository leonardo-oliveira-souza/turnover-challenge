<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BNB Bank</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div>
        <div class="flex bg-blue-500 h-32 justify-center">
            <h1 class="text-white self-end mb-4 text-3xl">BNB Bank</h1>
        </div>

        @yield('content')
    </div>
</body>
</html>