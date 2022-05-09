@extends('dashboard')
@section('title')
    Add Text Book
@endsection
@section('header')
    <a href="{{ route('textbooks') }}" class="btn btn-default"><i class="fa-solid fa-arrow-left mr-1"></i>{{__('Back')}}
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
                    {{ Form::open(['route' => 'textbooks.store', 'files' => 'true']) }}
                    <div class="row">
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Title').':') }} <span class="mandatory">*</span>
                            {{ Form::text('title', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Written By').':') }} <span class="mandatory">*</span>
                            {{ Form::text('written_by', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Year').':') }} <span class="mandatory">*</span>
                            {!! Form::selectRange('year', 1900, \Carbon\Carbon::now()->format('Y'),null,['class' => 'form-control','required','id'=>'year']) !!}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Stream').':') }} <span class="mandatory">*</span>
                            {{ Form::select('stream_id', $stream,null, ['class' => 'form-control','required','id'=>'stream']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Description').':') }} <span class="mandatory">*</span>
                            {{ Form::textarea('description', null, ['class' => 'form-control ckeditor','required','rows'=>'3']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::label(__('Image').':') }}<span class="mandatory">*</span>
                                    <div>
                                        <label class='file-label btn btn-primary mr-2'><i
                                                class="fa-solid fa-image mr-2"></i>Choose Image
                                            {{ Form::file('image',['id'=>'image']) }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label(__('Pdf').':') }}<span class="mandatory">*</span>
                                    <div>
                                        <label class='file-label btn btn-primary mr-2'><i
                                                class="fa-solid fa-file-pdf mr-2"></i>Choose Pdf
                                            {{ Form::file('pdf',['id'=>'pdf']) }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 pt-4">
                            {{ Form::submit(__('Save'), ['class' => 'btn btn-primary saveTextBook']) }}
                            <a href="{{ route('textbooks') }}"
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
        $(document).ready(function () {
            $('.saveTextBook').prop('disabled', true);
            $('#image').change(function (e) {
                let pdf = $('#pdf').val();
                if (pdf != '') {
                    $('.saveTextBook').prop('disabled', false);
                } else {
                    $('.saveTextBook').prop('disabled', true);
                }
            });
            $('#pdf').change(function (e) {
                let image = $('#image').val();
                if (image != '') {
                    $('.saveTextBook').prop('disabled', false);
                } else {
                    $('.saveTextBook').prop('disabled', true);
                }
            });
        });

        $("#year,#stream").select2({
            width: '100%',
        });
    </script>
@endsection
