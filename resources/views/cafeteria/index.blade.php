@extends('dashboard')
@section('title')
    Cafeteria
@endsection
@section('header')
    <a href="{{route('cafeteria.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    @include('cafeteria.table')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let cafeteriaUrl = "{{route('cafeteria')}}";
    </script>
    <script src="{{asset('public/assets/js/cafeteria/cafeteria.js')}}"></script>
@endsection
