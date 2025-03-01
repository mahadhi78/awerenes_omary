@extends('layouts.app')
@section('page_title', 'Course')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                @foreach ($modules as $key => $module)
                    <div class="ibox" id="module{{ $key }}">
                        <div class="ibox-title">
                            <h5>{{ $module['lesson_name'] }}</h5>

                            <div class="ibox-tools">
                                <a href="#" class="collapse-link" onclick="toggleCollapse({{ $key }})">
                                    <i class="fa fa-chevron-{{ $key === 0 ? 'down' : 'up' }}"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="{{ $key === 0 ? 'display: block;' : 'display: none;' }}">
                            {!! $module['description'] !!}
                        </div>
                    </div>
                @endforeach



            </div>
        </div>
        @push('scripts')
            <script>
                function toggleCollapse(moduleId) {
                    var moduleDiv = document.getElementById('module' + moduleId);
                    var collapseLink = moduleDiv.querySelector('.collapse-link');
                    var contentDiv = moduleDiv.querySelector('.ibox-content');

                    if (contentDiv.style.display === 'none') {
                        // Expand the section
                        contentDiv.style.display = 'block';
                        collapseLink.innerHTML = '<i class="fa fa-chevron-up"></i>';
                    } else {
                        // Collapse the section
                        contentDiv.style.display = 'none';
                        collapseLink.innerHTML = '<i class="fa fa-chevron-down"></i>';
                    }
                }
            </script>
        @endpush


    @endsection
