@extends('dashboard')
@section('title')
    Streams
@endsection
@section('header')
    <a href="#" class="btn btn-primary addStreamModal"><i class="fa-solid fa-plus"></i> Add</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    @include('streams.table')
                </div>
            </div>
        </div>
        @include('streams.create')
        @include('streams.edit')
    </div>
@endsection
@section('scripts')
    <script>
        let streamUrl = "{{route('streams')}}";
        let streamSaveUrl = "{{ route('streams.store') }}";
    </script>
    <script src="{{asset('public/assets/js/streams/stream.js')}}"></script>
@endsection
