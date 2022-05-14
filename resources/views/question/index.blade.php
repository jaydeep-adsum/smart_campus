@extends('dashboard')
@section('title')
    Questions & Responses
@endsection
@section('header')
    <a href="#" class="btn btn-primary addQuestionModal"><i class="fa-solid fa-plus"></i> Add</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    @include('question.table')
                </div>
            </div>
        </div>
        @include('question.create')
        @include('question.edit')
    </div>
@endsection
@section('scripts')
    <script>
        let questionUrl = "{{route('question')}}";
        let questionSaveUrl = "{{ route('question.store') }}";
    </script>
    <script src="{{asset('public/assets/js/question/question.js')}}"></script>
@endsection
