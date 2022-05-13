@extends('dashboard')
@section('title')
    Add Fellowship
@endsection
@section('header')
    <a href="{{ route('fellowship') }}" class="btn btn-default"><i class="fa-solid fa-arrow-left mr-1"></i>{{__('Back')}}</a>
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
                    {{ Form::open(['route' => 'fellowship.store', 'files' => 'true']) }}
                    <div class="row">
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('name').':') }} <span class="mandatory">*</span>
                            {{ Form::text('name', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Web Url').':') }} <span class="mandatory">*</span>
                            {{ Form::text('web_url', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Start Date').':') }} <span class="mandatory">*</span>
                            {{ Form::text('start_date', null, ['class' => 'form-control datepicker','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('End Date').':') }} <span class="mandatory">*</span>
                            {{ Form::text('end_date', null, ['class' => 'form-control datepicker','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Description').':') }} <span class="mandatory">*</span>
                            {{ Form::textarea('description', null, ['class' => 'form-control ckeditor','required','rows'=>'3']) }}
                        </div>
                        <div class="form-group col-sm-12 pt-4">
                            {{ Form::submit(__('Save'), ['class' => 'btn btn-primary saveNote']) }}
                            <a href="{{ route('fellowship') }}"
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
            autoApply: true,
            showDropdowns: true,
            startDate: new Date(),
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    </script>
@endsection
