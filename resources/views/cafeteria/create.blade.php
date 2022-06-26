@extends('dashboard')
@section('title')
    Add Cafeteria
@endsection
@section('header')
    <a href="{{ route('cafeteria') }}" class="btn btn-default"><i class="fa-solid fa-arrow-left mr-1"></i>{{__('Back')}}
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
                    {{ Form::open(['route' => 'cafeteria.store', 'files' => 'true']) }}
                    <div class="row">
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Item Name').':') }} <span class="mandatory">*</span>
                            {{ Form::text('name', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Item Price').':') }} <span class="mandatory">*</span>
                            {{ Form::number('price', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Item Category').':') }} <span class="mandatory">*</span>
                            {{ Form::select('category_id', $category,null, ['class' => 'form-control','required','id'=>'category']) }}
                        </div>
                        @if(Auth::user()->role==0)
                            <div class="form-group col-xl-6 col-md-6 col-sm-12">
                                {{ Form::label(__('Institute Name').':') }} <span class="mandatory">*</span>
                                {{ Form::select('institute_id', $institute,null, ['class' => 'form-control','required','id'=>'institute_id']) }}
                            </div>
                        @endif
                        <div class="col-md-6">
                            {{ Form::label(__('Image').':') }}<span class="mandatory">*</span>
                            <div>
                                <label class='file-label btn btn-primary mr-2'><i
                                        class="fa-solid fa-image mr-2"></i>Choose Image
                                    {{ Form::file('image') }}
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 pt-4">
                            {{ Form::submit(__('Save'), ['class' => 'btn btn-primary']) }}
                            <a href="{{ route('cafeteria') }}"
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
        $("#category,#institute_id").select2({
            width: '100%',
        });
    </script>
@endsection
