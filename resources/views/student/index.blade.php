@extends('dashboard')
@section('title')
    Student
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{asset('public/sample.xlsx')}}" class="btn btn-primary">Sample Excel File</a>
                        </div>
                        <div class="col-md-6 card-head-div">
                            {{ Form::open(['route' => 'import', 'files' => 'true', 'enctype' => 'multipart/form-data']) }}
                            <label class='file-label btn btn-primary mb-0 mr-2'><i
                                    class="fa-solid fa-file-excel mr-2"></i>Choose Excel File
                                <input type="file" class="" name="file" accept="" id="import"
                                       title="Choose excel file to insert data" onchange="form.submit()">
                            </label>
                            {{ Form::close() }}
                            <a href="{{route('student.create')}}" class="btn btn-primary"><i
                                    class="fa-solid fa-plus"></i>
                                Add</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    @include('student.table')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let studentUrl = "{{route('student')}}";
    </script>
    <script src="{{asset('public/assets/js/student/student.js')}}"></script>
@endsection
