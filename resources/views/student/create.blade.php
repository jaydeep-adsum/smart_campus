@extends('dashboard')
@section('title')
    Add Students
@endsection
@section('header')
    <a href="{{ route('student') }}" class="btn btn-default"><i class="fa-solid fa-arrow-left mr-1"></i>{{__('Back')}}
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
                    {{ Form::open(['route' => 'student.store', 'files' => 'true', 'id' => 'addCompanyForm']) }}
                    <div class="row">
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('First Name').':') }} <span class="mandatory">*</span>
                            {{ Form::text('first_name', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Father Name').':') }} <span class="mandatory">*</span>
                            {{ Form::text('father_name', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Last Name').':') }} <span class="mandatory">*</span>
                            {{ Form::text('last_name', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Email').':') }} <span class="mandatory">*</span>
                            {{ Form::email('email', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('City').':') }} <span class="mandatory">*</span>
                            {{ Form::text('city', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('State').':') }} <span class="mandatory">*</span>
                            {{ Form::text('state', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Institute Name').':') }} <span class="mandatory">*</span>
                            {{ Form::text('institute_name', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Department/Stream').':') }} <span class="mandatory">*</span>
                            {{ Form::text('department', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Semester').':') }} <span class="mandatory">*</span>
                            {{ Form::text('semester', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('DOB').':') }} <span class="mandatory">*</span>
                            {{ Form::text('dob', null, ['class' => 'form-control datepicker','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Student ID').':') }} <span class="mandatory">*</span>
                            {{ Form::text('student_id', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Year').':') }} <span class="mandatory">*</span>
                            {!! Form::selectRange('year', 1900, \Carbon\Carbon::now()->format('Y'),null,['class' => 'form-control','required','id'=>'year']) !!}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Mobile No').':') }} <span class="mandatory">*</span>
                            {{ Form::number('mobile_no', null, ['class' => 'form-control','pattern'=>"[1-9]{1}[0-9]{9}"]) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Emergency Mobile No').':') }}<span class="mandatory">*</span>
                            {{ Form::number('emergency_contact', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Gender').':') }} <span class="mandatory">*</span>
                            <div class="form-check">
                                {{ Form::label(__('Male').':') }}
                                {{Form::radio('gender', 'male', true, ['class' => 'required'])}}
                                {{ Form::label(__('Female').':') }}
                                {{Form::radio('gender', 'female', ['class' => ''])}}
                            </div>
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
                            {{ Form::label(__('Address').':') }} <span class="mandatory">*</span>
                            {{ Form::textarea('address', null, ['class' => 'form-control','required','rows'=>'3']) }}
                        </div>
                        <div class="form-group col-sm-12 pt-4">
                            {{ Form::submit(__('Save'), ['class' => 'btn btn-primary']) }}
                            <a href="{{ route('student') }}"
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
        $("#year").select2({
            width: '100%',
        });
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            autoApply: true,
            startDate: new Date(),
            maxDate: new Date(),
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    </script>
@endsection
