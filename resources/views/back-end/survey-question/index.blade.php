@extends('back-end.admin-layout')

@section('content')

<form  method="post" action="{{ route('surveyquestion.store') }}">
    @csrf
    <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
        <div class="col-md-5">
            <h5>Survey Name:</h5> <h6>{{$survey->title}}</h6>
            <input type="hidden" name="survey_id" value="{{$survey->id}}">
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label>Question</label>
                <input class="form-control" name="question"  value="{{ old('question') }}" type="text" placeholder="Enter question">
            </div>
        </div>

        <div class="col-md-2">
            <label></label>
            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Submit</button>
        </div>
    </div>
</form>
@include('back-end.survey-question.datatable')

@endsection
