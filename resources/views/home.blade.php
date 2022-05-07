@extends('layouts.app')

@section('content')
    @if (auth()->user()->admin)
        You are logged in
    @else
        <balance></balance>
    @endif
@endsection
