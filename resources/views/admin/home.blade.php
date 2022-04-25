@extends('dashboard')
@section('title')
    Dashboard
@endsection
@section('content')
{{--<div class="row">--}}
{{--    <div class="col-md-12">--}}
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-success">
                    <a href="{{route('student')}}">
                    <div class="card-body py-4 px-4">
                        <span style="font-size: 40px;"><i class="fa-solid fa-user-group"></i></span>
                        <h2 class="fw">{{$studentCount?$studentCount:0}}</h2>
                        <p>Students</p>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
{{--                </div>--}}
{{--            </div>--}}
@endsection
