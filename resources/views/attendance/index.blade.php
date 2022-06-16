@extends('dashboard')
@section('title')
    Student Attendance
@endsection
@section('header')
    <div class="d-flex px-4 px-sm-0 pt-2 pt-sm-0">
        <a href="#" class="btn btn-primary addModal"><i class="fa-solid fa-plus"></i> Add</a>
{{--        <a href="{{route('attendance.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Add</a>--}}
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    <table>

                    </table>
                    @include('attendance.attendance_table')
                </div>
            </div>
        </div>
        @include('attendance.modal')
    </div>
@endsection
@section('scripts')
    <script>
        $("#filter_department,#filter_year,#filter_semester,#month,#year").select2({
            width: '100%',
        });
        let attendanceUrl = "{{route('attendance')}}";
        let attendanceSessionUrl = "{{route('attendance.setSession')}}";
        let attendanceCreateUrl = "{{route('attendance.create')}}";
    </script>
    <script src="{{asset('public/assets/js/attendance/attendance.js')}}"></script>
@endsection
