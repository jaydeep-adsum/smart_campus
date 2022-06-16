@extends('dashboard')
@section('title')
    Institute
@endsection
@section('header')
    <a href="{{route('institute.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</a>
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
    </div>
@endsection
@section('scripts')
    <script>
        let instituteUrl = "{{route('institute')}}";
    </script>
    <script src="{{asset('public/assets/js/institute/institute.js')}}"></script>
@endsection
