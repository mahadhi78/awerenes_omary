@extends('layouts.app')
@section('links')
    <link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
@endsection
@section('page_title', 'Send Phishing')

@section('content')
    @if (Gate::check('staffs-save'))
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()"
                                    class="btn btn-default  fa fa-arrow-circle-left"></a>&nbsp;&nbsp;
                                <h4>Send Phishing Email</h4>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="col-md-8">
                                <form method="post" action="{{ route('phishing.save') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">Learners<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select name="user_id[]" id="user_id"
                                                class="form-control @error('user_id') is-invalid @enderror" multiple>
                                                <option value="all">All</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">
                                                        {{ $user->firstname . ' ' . $user->middlename . ' ' . $user->lastname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <span class="invalid-feedback">
                                                    <p>{{ $message }}</p>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">Compaign<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select name="compaign_id" id="compaign_id"
                                                class="form-control @error('compaign_id') is-invalid @enderror">
                                                <option value="">[ please select ]</option>
                                                @foreach ($compaign as $key => $option)
                                                    <option value="{{ $key }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                            @error('compaign_id')
                                                <span class="invalid-feedback">
                                                    <p>{{ $message }}</p>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">Template<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select name="template_id" id="template_id"
                                                class="form-control @error('template_id') is-invalid @enderror">
                                                <option value="">[ please select ]</option>
                                                @foreach ($template as $key => $option)
                                                    <option value="{{ $key }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                            @error('template_id')
                                                <span class="invalid-feedback">
                                                    <p>{{ $message }}</p>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">
                                            Submit 
                                            <i class=" fa fa-save ml-2"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
            <script src="{{ asset('assets/system/js/addForm.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
            <script type="text/javascript" language="javascript" class="init">
                $(".indicator-progress").toggle(false);

                $('#user_id,#compaign_id,#template_id').chosen({
                    width: "100%",
                    theme: "classic"
                });

                removeError();
            </script>
        @endpush
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
@endsection
