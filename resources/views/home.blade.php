@extends('layouts.app')

@section('content')
    @if (auth()->user()->admin)
        <check-control></check-control>
    @else
        <balance></balance>
    @endif
@endsection
