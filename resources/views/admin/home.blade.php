@extends('dashboard')
@section('title')
    Dashboard
@endsection
@section('content')
    {{--<div class="row">--}}
    {{--    <div class="col-md-12">--}}
    <div class="container">
        <div class="row">
            @if(Auth::user()->role!=2)
            <div class="col-md-3">
                <div class="card bg-success">
                    <a href="{{route('student')}}">
                        <div class="card-body py-4 px-4">
                            <span style="font-size: 40px;"><i class="fa-solid fa-user-group"></i></span>
                            <h2 class="fw">{{$data['studentCount']?$data['studentCount']:0}}</h2>
                            <p>Students</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning">
                    <a href="{{route('events')}}">
                        <div class="card-body py-4 px-4">
                            <span style="font-size: 40px;"><i class="fa-solid fa-calendar-days"></i></span>
                            <h2 class="fw">{{$data['eventCount']?$data['eventCount']:0}}</h2>
                            <p>Events</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger">
                    <a href="{{route('notes')}}">
                        <div class="card-body py-4 px-4">
                            <span style="font-size: 40px;"><i class="fa-solid fa-clipboard"></i></span>
                            <h2 class="fw">{{$data['noteCount']?$data['noteCount']:0}}</h2>
                            <p>Notes</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info">
                    <a href="{{route('textbooks')}}">
                        <div class="card-body py-4 px-4">
                            <span style="font-size: 40px;"><i class="fa-solid fa-book-open"></i></span>
                            <h2 class="fw">{{$data['textBookCount']?$data['textBookCount']:0}}</h2>
                            <p>Text Books</p>
                        </div>
                    </a>
                </div>
            </div>
                {{--            <div class="col-md-3">--}}
                {{--                <div class="card bg-info">--}}
                {{--                    <a href="{{route('department.index')}}">--}}
                {{--                        <div class="card-body py-4 px-4">--}}
                {{--                            <span style="font-size: 40px;"> <i class="fa-solid fa-list-check"></i></span>--}}
                {{--                            <h2 class="fw">{{$data['departmentCount']?$data['departmentCount']:0}}</h2>--}}
                {{--                            <p>Department</p>--}}
                {{--                        </div>--}}
                {{--                    </a>--}}
                {{--                </div>--}}
                {{--            </div>--}}
            @endif
            @if(Auth::user()->role!=2)
                <div class="col-md-3">
                    <div class="card bg-dark">
                        <a href="{{route('news')}}">
                            <div class="card-body py-4 px-4">
                                <span style="font-size: 40px;"><i class="fa-solid fa-newspaper"></i></span>
                                <h2 class="fw">{{$data['newsCount']?$data['newsCount']:0}}</h2>
                                <p>News</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info">
                        <a href="{{route('fellowship')}}">
                            <div class="card-body py-4 px-4">
                                <span style="font-size: 40px;"><i
                                        class="fa-solid fa-people-arrows-left-right"></i></span>
                                <h2 class="fw">{{$data['fellowshipCount']?$data['fellowshipCount']:0}}</h2>
                                <p>Fellowship</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            @if(Auth::user()->role==2)
                <div class="col-md-3">
                    <div class="card bg-success">
                        <a href="{{route('cafeteria')}}">
                            <div class="card-body py-4 px-4">
                                <span style="font-size: 40px;"><i class="fa-solid fa-hotel"></i></span>
                                <h2 class="fw">{{$data['cafeteriaCount']?$data['cafeteriaCount']:0}}</h2>
                                <p>Cafeteria</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    {{--                </div>--}}
    {{--            </div>--}}
@endsection
