@extends('dashboard')
@section('title')
    Cafeteria User
@endsection
@section('header')
    <a href="#" class="btn btn-primary addModal"><i class="fa-solid fa-plus"></i> Add</a>
@endsection
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body table-responsive">
                        @include('cafeteria_user.table')
                    </div>
                </div>
            </div>
            @include('cafeteria_user.create')
            @include('cafeteria_user.edit')
        </div>
    @endsection
    @section('scripts')
        <script>
            $("#institute_id,#edit_institute_id").select2({
                width: '100%',
            });
            let cafeteriaUserUrl = "{{route('cafeteria_user')}}";
            let cafeteriaUserSaveUrl = "{{ route('cafeteria_user.store') }}";
        </script>
        <script src="{{asset('public/assets/js/cafeteria_user/cafeteria_user.js')}}"></script>
    @endsection
