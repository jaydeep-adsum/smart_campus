@extends('dashboard')
@section('title')
    Questions & Responses
@endsection
@section('header')
    <a href="#" class="btn btn-primary addQuestionModal"><i class="fa-solid fa-plus"></i> Add</a>
@endsection
@section('extra_css')
    <style>
        .response-body {
            height: 4.5rem;
            overflow: hidden;
        }

        .res-card {
            transition: all ease 0.5s;
        }

        .res-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px 2px rgba(0, 0, 0, 0.5);
        }

        .action-btn {
            display: none;
        }

        .res-card:hover .action-btn {
            display: block;
            transition: all ease 0.5s;
        }

        .border-danger {
            border-color: #d94b09 !important;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    <div class="row" id="response-div">
                        <div class="col-md-6">
                            <div class="card p-2 border-left border-danger">
                                <span class="text-bold text-primary"
                                      style="font-size: 25px">{{__('Motivational')}}</span>
                            </div>
                            @foreach($motivational as $motive)
                                <div class="card rounded shadow border-bottom border-danger res-card">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="card-body response-body">
                                                {!! $motive->response !!}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="action-btn mt-2">
                                                <a title="Edit" class="btn btn-sm edit-btn" data-id="{{$motive->id}}"
                                                   href="#">
                                                    <i class="fa fa-edit"></i>
                                                </a> <a title="Delete" class="btn btn-sm delete-btn"
                                                        data-id="{{$motive->id}}" href="#">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <div class="card p-2 border-left border-danger">
                                <span class="text-bold text-primary" style="font-size: 25px">{{__('Behaviour')}}</span>
                            </div>
                            @foreach($behaviour as $data)
                                <div class="card rounded shadow border-bottom border-danger res-card">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="card-body response-body">
                                                {!! $data->response !!}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="action-btn mt-2">
                                                <a title="Edit" class="btn btn-sm edit-btn" data-id="{{$data->id}}"
                                                   href="#">
                                                    <i class="fa fa-edit"></i>
                                                </a> <a title="Delete" class="btn btn-sm delete-btn"
                                                        data-id="{{$data->id}}" href="#">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('question.create')
        @include('question.edit')
    </div>
@endsection
@section('scripts')
    <script>
        $("#institute_id,#department_id,#editCategory,#edit_institute_id").select2({
            width: '100%',
        });
        let questionUrl = "{{route('question')}}";
        let questionSaveUrl = "{{ route('question.store') }}";
    </script>
    <script src="{{asset('public/assets/js/question/question.js')}}"></script>
@endsection
