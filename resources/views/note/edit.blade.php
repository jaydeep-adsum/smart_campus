@extends('dashboard')
@section('title')
    Edit Note
@endsection
@section('header')
    <a href="{{ route('notes') }}" class="btn btn-default"><i class="fa-solid fa-arrow-left mr-1"></i>{{__('Back')}}</a>
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
                            {{ Form::label(__('Subject').':') }} <span class="mandatory">*</span>
                            {{ Form::text('title', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Chapter').':') }} <span class="mandatory">*</span>
                            {{ Form::text('chapter', null, ['class' => 'form-control','required']) }}
                        </div>
{{--                        <div class="form-group col-xl-6 col-md-6 col-sm-12">--}}
{{--                            {{ Form::label(__('Year').':') }} <span class="mandatory">*</span>--}}
{{--                            {{ Form::select('year_id', $year,null, ['class' => 'form-control','required','id'=>'year']) }}--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-xl-6 col-md-6 col-sm-12">--}}
{{--                            {{ Form::label(__('Department').':') }} <span class="mandatory">*</span>--}}
{{--                            {{ Form::select('department_id', $department,null, ['class' => 'form-control','required','id'=>'department']) }}--}}
{{--                        </div>--}}
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                                    {{ Form::label(__('Image').':') }}<span class="mandatory">*</span>
                                    <div>
                                        <label class='file-label btn btn-primary mr-2'><i
                                                class="fa-solid fa-image mr-2"></i>Choose Image
                                            {{ Form::file('image',['id'=>'image']) }}
                                        </label>
                                    </div>
                                    <div class="">
                                        <img src="{{$notes->image_url}}" width="80px" height="80px"
                                             class="rounded shadow"/>
                                    </div>
                                </div>
                                <div class="form-group col-xl-6 col-md-6 col-sm-12">
                                    {{ Form::label(__('Pdf').':') }}<span class="mandatory">*</span>
                                    <div>
                                        <label class='file-label btn btn-primary mr-2'><i
                                                class="fa-solid fa-file-pdf mr-2"></i>Choose Pdf
                                            {{ Form::file('pdf',['id'=>'pdf']) }}
                                        </label>
                                    </div>
                                    <div class="">
                                        @if($notes->pdf_url)
                                            <a title="Download" id="pdfSrc" class="btn edit-btn"
                                               href="{{$notes->pdf_url}}"
                                               download>
                                                <i class="fa-solid fa-download"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            {{ Form::label(__('Description').':') }} <span class="mandatory">*</span>
                            {{ Form::textarea('description', null, ['class' => 'form-control ckeditor','required','rows'=>'3']) }}
                        </div>
                        <div class="form-group col-xl-6 col-md-6 col-sm-12">
                            <div class="form-check my-4 ml-3">
                                <input class="form-check-input" name="all_institute" type="checkbox" {{$notes->institute_id==null?'checked':''}} value="1" id="all_institute">
                                {{ Form::label(__('For All Institute')) }}
                                <span class="text-muted">(Select to show notes to all institute)</span>
                            </div>
                            @if(Auth::user()->role==0)
                                <div id="institute_select">
                                    {{ Form::label(__('Institute Name').':') }} <span class="mandatory">*</span>
                                    {{ Form::select('institute_id', $institute,null, ['class' => 'form-control','required','id'=>'institute_id']) }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-sm-12 pt-4">
                            {{ Form::submit(__('Save'), ['class' => 'btn btn-primary saveNote']) }}
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
        if($("#all_institute").is(":checked")){
            $('#institute_select').hide();
        } else{
            $('#institute_select').show();
        }
        $("#all_institute").change(function() {
            if(this.checked) {
                $('#institute_select').hide();
            } else {
                $('#institute_select').show();
            }
        });
        $("#year,#department,#institute_id").select2({
            width: '100%',
        });
    </script>
@endsection
