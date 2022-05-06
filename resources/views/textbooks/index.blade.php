@extends('dashboard')
@section('title')
    Text Books
@endsection
@section('header')
    <a href="{{route('textbooks.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
        Add</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    @include('textbooks.table')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let textBooksUrl = "{{route('textbooks')}}";
    </script>
    <script src="{{asset('public/assets/js/textbooks/textbook.js')}}"></script>
@endsection
