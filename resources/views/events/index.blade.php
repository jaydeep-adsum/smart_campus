@extends('dashboard')
@section('title')
    Events
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-head-div">
                        <a href="{{route('events.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
                            Add</a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    @include('events.table')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let eventUrl = "{{route('events')}}";
    </script>
    <script src="{{asset('public/assets/js/events/event.js')}}"></script>
@endsection
