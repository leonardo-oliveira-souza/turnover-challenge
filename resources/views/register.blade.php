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

        <form method="POST" action="{{ url('register') }}" class="grid grid-cols-1 mx-8 mt-4">
            @csrf
            <x-forms.input type="text" name="username" placeholder="username" />
            <x-forms.input type="text" name="email" placeholder="email" />
            <x-forms.input type="password" name="password" placeholder="password" />

            <x-forms.submit-button>
                SIGN UP
            </x-forms.submit-button>

            <x-forms.redirect-link href=" {{ route('login') }}">
                Already have an account?
            </x-forms.redirect-link>
        </form>
    </div>
</body>
</html>