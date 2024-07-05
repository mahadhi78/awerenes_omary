<div class="row mt-3">

    <div class="col-lg-12 animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                @foreach ($templates as $tmp)
                    <div class="file-box">
                        <div class="file">
                            <a href="#">
                                <span class="corner"></span>

                                <div class="icon">
                                    <i class="fa fa-file"></i>
                                </div>
                                <div class="file-name">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <a href="">{{ $tmp->temp_name }}</a>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="row">

                                                @can('template-delete')
                                                    <button title="Delete" class='btn btn-danger btn-sm'
                                                        onclick="deleteTemplate({{ $tmp->id }})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteTemplate(id) {
            var formData = new FormData()
            formData.append('id', id);
            var url = "{{ route('template.destroy') }}";
            deleteData(formData, url);
        }
    </script>
@endpush
