@extends('dashboard')
@section('title')
    Student Attendance
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    {{ Form::open(['route' => 'attendance.store', 'files' => 'true']) }}
                    @include('attendance.table')
                </div>
            </div>
            <div class="card">
                <div class="card-body text-right"><button type="submit" class="btn btn-primary">Add Attendance</button></div>
            </div>
            {{ Form::close() }}
        </div>
     </div>
@endsection
@section('scripts')
    <script src="{{asset('public/assets/js/attendance/attendance.js')}}"></script>
    <script>
        let month = {{ session('month') }};
        let year = {{ session('year') }};
        let attendance = "{{ $attendance }}";
        let attendanceCreateUrl = "{{route('attendance.create')}}";
        let attendanceUrl = "{{route('attendance')}}";
    </script>
@endsection
