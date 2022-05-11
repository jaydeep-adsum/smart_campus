@extends('dashboard')
@section('title')
    Edit Category
@endsection
@section('header')
    <a href="{{ route('category') }}" class="btn btn-default"><i class="fa-solid fa-arrow-left mr-1"></i>{{__('Back')}}
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
                    {{ Form::model($category,['route' => ['category.update',$category->id], 'files' => 'true']) }}
                    <div class="form-group col-sm-6">
                        {{ Form::label('category',__('Category').':') }}<span class="text-danger">*</span>
                        {{ Form::text('name', null, ['class' => 'form-control','required','id'=>'category']) }}
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
                            <img src="{{$category->image_url}}" width="80px" height="80px" class="rounded shadow">
                        </div>
                    </div>
                    <div class="text-right">
                        {{ Form::button(__('Save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'categoryBtnSave']) }}
                        <a href="{{ route('category') }}"
                           class="btn btn-default">{{__('Cancel')}}</a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
