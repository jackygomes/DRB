@extends('layout')

@section('main-content')

<!-- Navigation -->
@include('front-end.partial.nav')
@yield('content')

@include('front-end.partial.footer')
@yield('scripts')
@endsection
