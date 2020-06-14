<?php

namespace App\Http\Controllers;

use App\Survey;
use App\SurveyAnswerOption;
use App\SurveyQuestion;
use Illuminate\Http\Request;

class SurveyQuestionController extends Controller
{
    public function index()
    {
        $surveys = Survey::orderBy('title')->get()->sortBy('title', SORT_NATURAL|SORT_FLAG_CASE);
        $surveyquestions = SurveyQuestion::orderBy('question')->get()->sortBy('question', SORT_NATURAL|SORT_FLAG_CASE);
        return view('back-end.survey-question.index', compact('surveys', 'surveyquestions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'survey_id' => 'required',
            'question' => 'required',
        ]);

        $surveyquestion = new SurveyQuestion([
            'survey_id' => $request->get('survey_id'),
            'question' => $request->get('question')
        ]);
        $surveyquestion->save();
        return redirect()->back()->with('success', 'Survey question has been created successfully');
    }

    public function edit($id)
    {
        $surveyquestion = SurveyQuestion::find($id);
        return view('back-end.survey-question.edit', compact('surveyquestion'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'survey_id' => 'required',
            'question' => 'required',
        ]);
        $surveyquestion = SurveyQuestion::find($id);
        $surveyquestion->survey_id = $request->get('survey_id');
        $surveyquestion->question = $request->get('question');
        $surveyquestion->save();
        return redirect('admin/survey/'. $request->get('survey_id'))->with('success', 'Survey question has been updated successfully');
    }

    public function destroy($id)
    {
        $surveyquestion = SurveyQuestion::find($id);
        $surveyquestion->delete();
        return redirect()->back()->with('success', 'Survey question has been deleted successfully');
    }

    public function show(Request $request, SurveyQuestion   $surveyquestion )
    {
        $surveyansweroptions = SurveyAnswerOption::where('survey_question_id', $surveyquestion->id)->orderBy('answer_option')->get()->sortBy('answer_option', SORT_NATURAL|SORT_FLAG_CASE);
        return view('back-end.survey-answer-option.index', compact('surveyquestion', 'surveyansweroptions'));
    }
}
