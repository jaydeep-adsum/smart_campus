@extends('dashboard')
@section('title')
    Add Students
@endsection
@section('content')
    <style>
        .iti {
            width: 100%;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body">
                    {{ Form::open(['route' => 'student.store', 'files' => 'true', 'id' => 'addCompanyForm']) }}
                    <div class="row">
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('First Name').':') }}
                            {{ Form::text('first_name', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Father Name').':') }}
                            {{ Form::text('father_name', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Last Name').':') }}
                            {{ Form::text('last_name', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Email').':') }}
                            {{ Form::email('email', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('City').':') }}
                            {{ Form::text('city', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('State').':') }}
                            {{ Form::text('state', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Institute Name').':') }}
                            {{ Form::text('institute_name', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Department/Stream').':') }}
                            {{ Form::text('department', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Semester').':') }}
                            {{ Form::text('semester', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('DOB').':') }}
                            {{ Form::text('dob', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Student ID').':') }}
                            {{ Form::text('student_id', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Year').':') }}
                            {{ Form::text('year', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{--                            {{ Form::label(__('Mobile No').':' }}--}}
                            <label for="Mobile No" class="w-100">Mobile No</label>
                            {{ Form::tel('mobile_no', null, ['class' => 'form-control w-100','required','id'=>'phoneNumber']) }}
                            {{ Form::hidden('region_code',null,['id'=>'prefix_code']) }}
                            <br>
                            <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
                            <span id="error-msg" class="hide"></span>
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Emergency Mobile No').':') }}
                            {{ Form::number('emergency_contact', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Gender').':') }}
                            <div class="form-check">
                                {{ Form::label(__('Male').':') }}
                                {{Form::radio('gender', 'male', true, ['class' => ''])}}
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
                            {{ Form::label(__('Address').':') }}
                            {{ Form::textarea('address', null, ['class' => 'form-control','required','rows'=>'3']) }}
                        </div>
                        <div class="form-group col-sm-12 pt-4">
                            {{ Form::submit(__('Save'), ['class' => 'btn btn-primary']) }}
                            <a href="{{ route('student') }}"
                               class="btn btn-default text-dark">{{__('Cancel')}}</a>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    let isEdit = false;
    <script src="{{ asset('public/assets/js/custom/phone-number-country-code.js') }}"></script>
@endpush
