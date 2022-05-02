@extends('dashboard')
@section('title')
    Notes
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-head-div">
                        <a href="{{route('notes.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('note.table')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let notesUrl = "{{route('notes')}}";
        let noDocument = "{{asset('public/assets/images/no-document.png')}}"
    </script>
    <script src="{{asset('public/assets/js/notes/note.js')}}"></script>
@endsection
