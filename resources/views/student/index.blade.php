@extends('dashboard')
@section('title')
    Student
@endsection
@section('header')
    <div class="d-flex px-4 px-sm-0 pt-2 pt-sm-0">
        <a href="{{route('student.export')}}" class="btn btn-primary mr-2"><i class="fa-solid fa-file-excel"></i> Export
            Student</a>
        <a href="{{asset('public/sample.xlsx')}}" class="btn btn-primary mr-2">Sample Excel File</a>
        {{ Form::open(['route' => 'import', 'files' => 'true', 'enctype' => 'multipart/form-data']) }}
        <label class='file-label btn btn-primary mb-0 mr-2'><i
                class="fa-solid fa-file-excel mr-2"></i>Choose Excel File
            <input type="file" class="" name="file" accept="" id="import"
                   title="Choose excel file to insert data" onchange="form.submit()">
        </label>
        {{ Form::close() }}
        <a href="{{route('student.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Add</a>
    </div>
@endsection
@section('content')
    <div class="bg-white pt-3 px-3 mb-1 rounded">
        <div class="row">
            @if(Auth::user()->role!=1)
        <div class="form-group col-xl-3 col-md-3 col-sm-12">
            {{ Form::select('institute_id', $institute,null, ['class' => 'form-control','required','id'=>'institute_id','placeholder'=>'select Institute']) }}
        </div>
            @endif
        <div class="form-group col-xl-3 col-md-3 col-sm-12">
            {{ Form::select('year_id', $year,null, ['class' => 'form-control','required','id'=>'year_id','placeholder'=>'select Year']) }}
        </div>
        <div class="form-group col-xl-3 col-md-3 col-sm-12">
            {{ Form::select('department_id', $department,null, ['class' => 'form-control','required','id'=>'department_id','placeholder'=>'select Department']) }}
        </div>
        <div class="form-group col-xl-3 col-md-3 col-sm-12">
            {{ Form::select('semester_id', $semester,null, ['class' => 'form-control','required','id'=>'semester_id','placeholder'=>'select Semester']) }}
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    @include('student.table')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $("#year_id,#institute_id,#semester_id,#department_id").select2({
            width: '100%',
        });
        let studentUrl = "{{route('student')}}";
    </script>
    <script src="{{asset('public/assets/js/student/student.js')}}"></script>
@endsection
