@extends('dashboard')
@section('title')
    Institute
@endsection
@section('header')
    <a href="#" class="btn btn-primary addInstituteModal"><i class="fa-solid fa-plus"></i> Add</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    @include('institute.table')
                </div>
            </div>
        </div>
        @include('institute.create')
        @include('institute.edit')
    </div>
@endsection
@section('scripts')
    <script>
        let instituteUrl = "{{route('institute')}}";
        let instituteSaveUrl = "{{ route('institute.store') }}";
    </script>
    <script src="{{asset('public/assets/js/institute/institute.js')}}"></script>
@endsection
