@extends('layouts.app')

@section('content')
    <side-bar :admin="{{ auth()->user()->admin ? 1 : 0 }}"></side-bar>
    
    @if (auth()->user()->admin)
        You are logged in
    @else
        <balance></balance>
    @endif
@endsection
