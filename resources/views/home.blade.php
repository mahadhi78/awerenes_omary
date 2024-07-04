@extends('layouts.app')
@section('page_title', 'Dashboard ')
@section('content')
    @if (Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR) || Auth::user()->hasRole(Constants::ROLE_ADMINISTRATOR))
        @include('pages.home.admin')
    @endif
    @if (Auth::user()->userType == Constants::LEARNER)
        @include('pages.home.student')
    @endif
    @include('pages.home.share')
    @include('pages.home.preview')

    @push('scripts')
        <script src="{{ asset('assets/system/js/addForm.js') }}"></script>
        <script type="text/javascript" language="javascript" class="init">
            function previewFaq(id) {
                var url = "{{ route('faqs.preview', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(response) {
                        document.getElementById('previewModalBody').innerHTML = response.description;
                        document.getElementById('title').innerHTML = response.new_name;
                        $("#documentModal").modal("show");;
                    }
                });
            }

            function previewNews(id) {
                var url = "{{ route('news_edit.list', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(response) {
                        document.getElementById('previewModalBody').innerHTML = response.description;
                        document.getElementById('title').innerHTML = response.new_name;
                        $("#documentModal").modal("show");;
                    }
                });
            }
        </script>
    @endpush
@endsection
