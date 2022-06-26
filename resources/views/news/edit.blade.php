@extends('dashboard')
@section('title')
    Edit News
@endsection
@section('header')
    <a href="{{ route('news') }}" class="btn btn-default"><i class="fa-solid fa-arrow-left mr-1"></i>{{__('Back')}}</a>
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
                    {{ Form::model($news, ['route' => ['news.update',$news->id], 'files' => 'true']) }}
                    @if(Auth::user()->role==0)
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Institute Name').':') }} <span class="mandatory">*</span>
                            {{ Form::select('institute_id', $institute,null, ['class' => 'form-control','required','id'=>'institute_id']) }}
                        </div>
                    @endif
                    <div class="form-group col-xl-6 col-md-6 col-sm-12">
                        {{ Form::label(__('Title').':') }} <span class="mandatory">*</span>
                        {{ Form::text('title', null, ['class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-xl-6 col-md-6 col-sm-12">
                        {{ Form::label(__('Description').':') }} <span class="mandatory">*</span>
                        {{ Form::textarea('description', null, ['class' => 'form-control ckeditor','required','rows'=>'3']) }}
                    </div>
                    <div class="form-group col-xl-6 col-md-6 col-sm-12">
                        {{ Form::label(__('Image').':') }}<span class="mandatory">*</span>
                        <div>
                            <label class='file-label btn btn-primary mr-2'><i
                                    class="fa-solid fa-image mr-2"></i>Choose Image
                                {{ Form::file('image',['id'=>'image']) }}
                            </label>
                        </div>
                        <div class="">
                            <img src="{{$news->image_url}}" width="80px" height="80px"
                                 class="rounded shadow"/>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 pt-4">
                        {{ Form::submit(__('Save'), ['class' => 'btn btn-primary saveNote']) }}
                        <a href="{{ route('news') }}"
                           class="btn btn-default">{{__('Cancel')}}</a>
                    </div>
                    {{ Form::close() }}
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
    </script>
@endsection
