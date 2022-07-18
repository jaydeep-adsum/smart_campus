@extends('dashboard')
@section('title')
    Department
@endsection
@section('header')
    <a href="#" class="btn btn-primary addDepartmentModal"><i class="fa-solid fa-plus"></i> Add</a>
@endsection
@section('content')
    <div class="bg-white d-flex profile-tab-div">
        <a href="{{route('year.index')}}" class="{{ Request::is('year*')? 'active':''}}"><div class="profile-tab {{ Request::is('year*')? 'active':''}}"><p class="mb-0">Year</p></div></a>
        <a href="{{route('semester.index')}}" class="{{ Request::is('semester*')? 'active':''}}"><div class="profile-tab {{ Request::is('semester*')? 'active':''}}"><p class="mb-0">Semester</p></div></a>
        <a href="{{route('department.index')}}" class="{{ Request::is('department*')? 'active':''}}"><div class="profile-tab {{ Request::is('department*')? 'active':''}}"><p class="mb-0">Department</p></div></a>
    </div>
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
