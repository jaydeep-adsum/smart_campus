@extends('dashboard')
@section('title')
    Semester
@endsection
@section('header')
    <a href="#" class="btn btn-primary addSemesterModal"><i class="fa-solid fa-plus"></i> Add</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    @include('semester.table')
                </div>
            </div>
        </div>
        @include('semester.create')
        @include('semester.edit')
    </div>
@endsection
@section('scripts')
    <script>
        let semesterUrl = "{{route('semester.index')}}";
        let semesterSaveUrl = "{{ route('semester.store') }}";
    </script>
    <script src="{{asset('public/assets/js/semester/semester.js')}}"></script>
@endsection
