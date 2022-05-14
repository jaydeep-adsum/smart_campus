@extends('dashboard')
@section('title')
    Opportunity
@endsection
@section('header')
    <a href="{{route('opportunity.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body table-responsive">
                    @include('opportunity.table')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let opportunityUrl = "{{route('opportunity')}}";
    </script>
    <script src="{{asset('public/assets/js/opportunity/opportunity.js')}}"></script>
@endsection
