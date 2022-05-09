@extends('dashboard')
@section('title')
    News
@endsection
@section('header')
    <a href="{{route('news.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    @include('news.table')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let newsUrl = "{{route('news')}}";
    </script>
    <script src="{{asset('public/assets/js/news/news.js')}}"></script>
@endsection
