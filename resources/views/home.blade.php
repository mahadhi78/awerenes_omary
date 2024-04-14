@extends('layouts.app')
@section('page_title', 'Dashboard ')
@section('content')
    @if (Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR) || Auth::user()->hasRole(Constants::ROLE_ADMINISTRATOR))
        @include('pages.home.admin')
    @else
        @include('pages.home.staff')
    @endif
    @push('scripts')

@endpush
@endsection
