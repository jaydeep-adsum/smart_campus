@extends('dashboard')
@section('title')
    Edit Note
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
                    {{ Form::model($notes, ['route' => ['notes.update',$notes->id], 'files' => 'true']) }}
                    <div class="row">
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Title').':') }} <span class="mandatory">*</span>
                            {{ Form::text('title', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Chapter').':') }} <span class="mandatory">*</span>
                            {{ Form::text('chapter', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Year').':') }} <span class="mandatory">*</span>
                            {!! Form::selectRange('year', 1900, \Carbon\Carbon::now()->format('Y'),null,['class' => 'form-control','required','id'=>'year']) !!}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Stream').':') }} <span class="mandatory">*</span>
                            {{ Form::text('stream', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Description').':') }} <span class="mandatory">*</span>
                            {{ Form::textarea('description', null, ['class' => 'form-control','required','rows'=>'3']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::label(__('Image').':') }}
                                    <div>
                                        <label class='file-label btn btn-primary mr-2'><i
                                                class="fa-solid fa-image mr-2"></i>Choose Image
                                            {{ Form::file('image') }}
                                        </label>
                                    </div>
                                    <div class="">
                                        <img src="{{$notes->image_url}}" width="80px" height="80px"
                                             class="rounded shadow"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label(__('Pdf').':') }}
                                    <div>
                                        <label class='file-label btn btn-primary mr-2'><i
                                                class="fa-solid fa-file-pdf mr-2"></i>Choose Pdf
                                            {{ Form::file('pdf') }}
                                        </label>
                                    </div>
                                    <div class="">
                                        @if($notes->pdf_url)
                                            <a title="Download" class="btn edit-btn" href="{{$notes->pdf_url}}"
                                               download>
                                                <i class="fa-solid fa-download"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 pt-4">
                            {{ Form::submit(__('Save'), ['class' => 'btn btn-primary']) }}
                            <a href="{{ route('notes') }}"
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
    </script>
@endsection