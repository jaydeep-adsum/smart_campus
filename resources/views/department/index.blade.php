@extends('dashboard')
@section('title')
    Department
@endsection
@section('header')
    <a href="#" class="btn btn-primary addDepartmentModal"><i class="fa-solid fa-plus"></i> Add</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    @include('department.table')
                </div>
            </div>
        </div>
        @include('department.create')
        @include('department.edit')
    </div>
@endsection
@section('scripts')
    <script>
        $("#institute_id,#edit_institute_id").select2({
            width: '100%',
        });
        let departmentUrl = "{{route('department.index')}}";
        let departmentSaveUrl = "{{ route('department.store') }}";
    </script>
    <script src="{{asset('public/assets/js/department/department.js')}}"></script>
@endsection
