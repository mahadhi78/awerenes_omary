@if ($course->count())
    <div class="container section-title" data-aos="fade-up">
        <h2>Courses</h2>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($course as $c)
                <div class="col-lg-3 col-md-5 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="course-item">
                        <img src="{{ asset($c->c_logo) }}" class="img-fluid" alt="...">
                        <div class="course-content">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <p class="category">{{ $c->level_name }}</p>
                            </div>

                            <h3><a href="course-details.html">{{ $c->c_name }}</a></h3>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@else
<p class="alert alert-info">No Course Available</p>

@endif
<!-- Section Title -->
