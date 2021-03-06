@extends('dashboard')
@section('title')
    Edit Institute
@endsection
@section('header')
    <a href="{{ route('institute') }}" class="btn btn-default"><i class="fa-solid fa-arrow-left mr-1"></i>{{__('Back')}}
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
                    {{ Form::model($institute, ['route' => ['institute.update',$institute->id], 'files' => 'true']) }}
                    <div class="row">
                        {{ Form::hidden('user_id',$institute->user?$institute->user->id:null) }}
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Point Of Contact').':') }} <span class="mandatory">*</span>
                            {{ Form::text('name',$institute->user?$institute->user->name:null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Institute Name').':') }} <span class="mandatory">*</span>
                            {{ Form::text('institute', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Email').':') }} <span class="mandatory">*</span>
                            {{ Form::email('email', $institute->user?$institute->user->email:null, ['class' => 'form-control','required']) }}
                        </div>
                        @if(!$institute->user)
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Password').':') }} <span class="mandatory">*</span>
                            {{ Form::text('password', null, ['class' => 'form-control','required']) }}
                        </div>
                        @endif
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Contact').':') }} <span class="mandatory">*</span>
                            {{ Form::number('contact', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Address').':') }} <span class="mandatory">*</span>
                            {{ Form::text('address', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Image').':') }}
                            <div>
                                <label class='file-label btn btn-primary mr-2'><i
                                        class="fa-solid fa-image mr-2"></i>Choose Image
                                    {{ Form::file('image') }}
                                </label>
                            </div>
                            <div class="">
                                <img src="{{$institute->image_url}}" width="80px" height="80px" class="rounded shadow">
                            </div>
                        </div>
                        <div class="form-group col-sm-12 pt-4">
                            {{ Form::submit(__('Save'), ['class' => 'btn btn-primary']) }}
                            <a href="{{ route('institute') }}"
                               class="btn btn-default">{{__('Cancel')}}</a>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
