@extends('back-end.admin-layout')

@section('content')

<form  method="post" action="{{ route('surveyansweroption.store') }}">
    @csrf
    <div class="row">

        <div class="col-md-3">
            <h5>Survey Question:</h5> <h6>{{$surveyquestion->question}}</h6>
            <input type="hidden" name="survey_question_id" value="{{$surveyquestion->id}}">
        </div>

        <div class="col-md-3">
            <div class="form-group">
            <label>Answer</label>
            <input class="form-control" name="answer_option"  value="{{ old('answer_option') }}" type="text" placeholder="Enter Answer">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Color</label>
                <input class="form-control" name="color"  value="{{ old('color') }}" type="color" placeholder="Select color">
            </div>
        </div>

        <div class="col-md-3">
            <label>.</label>
            <button type="submit" class="btn btn-outline-primary w-100">Submit</button>
        </div>
    </div>
</form>
@include('back-end.survey-answer-option.datatable')

@endsection
