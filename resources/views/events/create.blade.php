@extends('dashboard')
@section('title')
    Add Event
@endsection
@section('header')
    <a href="{{ route('events') }}" class="btn btn-default"><i class="fa-solid fa-arrow-left mr-1"></i>{{__('Back')}}
    </a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger pb-0 pt-0">
                    <ul class="j-error-padding list-unstyled p-2 mb-0">
                        <li>{{ $errors->first() }}</li>
                    </ul>
                </div>
            @endif
            <div class="card card-default">
                <div class="card-body">
                    {{ Form::open(['route' => 'events.store', 'files' => 'true', 'id' => 'addCompanyForm']) }}
                    <div class="row">
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Title').':') }} <span class="mandatory">*</span>
                            {{ Form::text('title', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Date').':') }} <span class="mandatory">*</span>
                            {{ Form::text('date', null, ['class' => 'form-control datepicker','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Location').':') }} <span class="mandatory">*</span>
                            {{ Form::text('location', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Image').':') }}
                            <div>
                                <label class='file-label btn btn-primary mr-2'><i
                                        class="fa-solid fa-image mr-2"></i></i>Choose Image
                                    {{ Form::file('image') }}
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Detail').':') }} <span class="mandatory">*</span>
                            {{ Form::textarea('detail', null, ['class' => 'form-control','required','rows'=>'3']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Registration Link').':') }} <span class="mandatory">*</span>
                            {{ Form::text('registration_link', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-sm-12 pt-4">
                            {{ Form::submit(__('Save'), ['class' => 'btn btn-primary']) }}
                            <a href="{{ route('events') }}"
                               class="btn btn-default">{{__('Cancel')}}</a>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: true,
            timePicker: true,
            timePicker24Hour: true,
            startDate: new Date(),
            minDate: new Date(),
            locale: {
                format: 'YYYY-MM-DD hh:mm'
            }
        });
    </script>
@endsection
