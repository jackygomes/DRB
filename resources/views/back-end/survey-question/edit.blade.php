@extends('back-end.admin-layout')

@section('content')

<form  method="post" action="{{ route('surveyquestion.update', $surveyquestion->id) }}">
    @csrf
    @method('patch')
    <div class="row bg-white my-4 mx-1 p-3 shadow-sm">
        
        <div class="col-md-5">
            <h5>Survey Name:</h5> <h6>{{$surveyquestion->survey->title}}</h6>
            <input type="hidden" name="survey_id" value="{{$surveyquestion->survey->id}}">
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label>Question</label>
                <input class="form-control" name="question"  value="{{ $surveyquestion->question }}" type="text" placeholder="Enter question">
            </div>
        </div>

        <div class="col-md-2">
            <label></label>
            <button type="submit" class="btn btn-outline-primary w-100 mt-md-2">Update</button>
        </div>
    </div>
</form>

@endsection
