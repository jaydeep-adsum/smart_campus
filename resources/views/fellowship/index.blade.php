@extends('dashboard')
@section('title')
    Fellowship
@endsection
@section('header')
    <a href="{{route('fellowship.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    @include('fellowship.table')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let fellowshipUrl = "{{route('fellowship')}}";
    </script>
    <script src="{{asset('public/assets/js/fellowship/fellowship.js')}}"></script>
@endsection
