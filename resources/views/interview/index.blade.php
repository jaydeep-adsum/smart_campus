@extends('dashboard')
@section('title')
    Interview Tips
@endsection
@section('header')
    <a href="#" class="btn btn-primary addInterviewModal"><i class="fa-solid fa-plus"></i> Add</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    @include('interview.table')
                </div>
            </div>
        </div>
        @include('interview.create')
        @include('interview.edit')
    </div>
@endsection
@section('scripts')
    <script>
        $("#institute_id,#edit_institute_id").select2({
            width: '100%',
        });
        let interviewUrl = "{{route('interview')}}";
        let interviewSaveUrl = "{{ route('interview.store') }}";
    </script>
    <script src="{{asset('public/assets/js/interview/interview.js')}}"></script>
@endsection
