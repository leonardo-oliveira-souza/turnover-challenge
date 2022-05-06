@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ url('login') }}" class="grid grid-cols-1 mx-8 mt-4">
        @csrf
        <x-forms.input type="text" name="username" placeholder="username" />
        <x-forms.input type="password" name="password" placeholder="password" />

        <x-forms.submit-button>
            SIGN IN
        </x-forms.submit-button>

        <x-forms.redirect-link href=" {{ route('register') }}">
            Create a new account
        </x-forms.redirect-link>
    </form>
@endsection
