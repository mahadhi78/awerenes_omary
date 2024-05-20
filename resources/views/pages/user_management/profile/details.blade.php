<ul class="nav nav-tabs" role="tablist">
    <li>
        <a class="nav-link active show" data-toggle="tab" href="#tab-1">
            Information
        </a>
    </li>
</ul>
<div class="tab-content">
    <div role="tabpanel" id="tab-1" class="tab-pane active show">
        <div class="panel-body">
            <div class="row">
                <label class="col-lg-4 ">First Name:
               </label>
                <div class="col-lg-8 d-flex align-items-center">
                    <span class="fw fs-6 me-2">{{ Auth::user()->firstname }}</span>
                </div>
            </div>
            
            <div class="row">
                <label class="col-lg-4 ">Last Name:
               </label>
                <div class="col-lg-8 d-flex align-items-center">
                    <span class="fw fs-6 me-2">{{ Auth::user()->lastname }}</span>
                </div>
            </div>
            <div class="row">
                <label class="col-lg-4 ">Email:
               </label>
                <div class="col-lg-8 d-flex align-items-center">
                    <span class="fw fs-6 me-2">{{ Auth::user()->email }}</span>
                </div>
            </div>
            <div class="row">
                <label class="col-lg-4 ">Phone Number:
               </label>
                <div class="col-lg-8 d-flex align-items-center">
                    <span class="fw fs-6 me-2">{{ Auth::user()->phone_number }}</span>
                </div>
            </div>
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bolder text-dark">Date of Birth
               </label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 d-flex align-items-center">
                    <span class="fw fs-6 me-2">
                        @if(Auth::user()->dob != null)
                        <span>{{ Auth::user()->dob }}</span>
                        @else
                        <span>NULL</span>
                        @endif
                    </span>
                </div>
                <!--end::Col-->
            </div>
        </div>
    </div>
    
</div>
