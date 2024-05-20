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
                                    <a href="">{{ $tmp->temp_name }}</a>
                                </div>
                            </a>
                        </div>

                    </div>
                @endforeach

            </div>

        </div>
    </div>
</div>
