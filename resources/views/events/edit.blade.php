@extends('dashboard')
@section('title')
    Edit Event
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
                    {{ Form::model($event,['route' => ['events.update',$event->id], 'files' => 'true']) }}
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
                            {{ Form::label(__('From').':') }} <span class="mandatory">*</span>
                            {{ Form::text('from', null, ['class' => 'form-control timepicker','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('To').':') }} <span class="mandatory">*</span>
                            {{ Form::text('to', null, ['class' => 'form-control timepicker','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Location').':') }} <span class="mandatory">*</span>
                            {{ Form::text('location', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Registration Link').':') }}
                            {{ Form::text('registration_link', null, ['class' => 'form-control']) }}
                        </div>
                        @if(Auth::user()->role==0)
                            <div class="form-group col-xl-6 col-md-6 col-sm-12">
                                {{ Form::label(__('Institute Name').':') }} <span class="mandatory">*</span>
                                {{ Form::select('institute_id', $institute,null, ['class' => 'form-control','required','id'=>'institute_id']) }}
                            </div>
                        @endif
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Image').':') }}
                            <div>
                                <label class='file-label btn btn-primary mr-2'><i
                                        class="fa-solid fa-image mr-2"></i>Choose Image
                                    {{ Form::file('image') }}
                                </label>
                            </div>
                            <div class="">
                                <img src="{{$event->image_url}}" width="80px" height="80px" class="rounded shadow">
                            </div>
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Detail').':') }} <span class="mandatory">*</span>
                            {{ Form::textarea('detail', null, ['class' => 'form-control ckeditor','required','rows'=>'3']) }}
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
        $("#institute_id").select2({
            width: '100%',
        });
        let date = "{{ $event->date }}";
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoApply: true,
            maxDate: new Date(),
            setDate: date,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
        $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 10,
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
    </script>
@endsection
