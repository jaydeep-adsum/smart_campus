<?php

namespace App\Http\Controllers;

use App\Datatable\QuestionDatatable;
use App\Models\Question;
use App\Repositories\QuestionRepository;
use Auth;
use DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionController extends AppBaseController
{
    /**
     * QuestionController constructor.
     * @param QuestionRepository $questionRepository
     */
    public function __construct(QuestionRepository $questionRepository)
    {
        return $this->questionRepository = $questionRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $behaviour = Question::where('category','Behaviour')->get();
        $motivational = Question::where('category','Motivational')->get();
        return view('question.index',compact('behaviour','motivational'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $institute_id = (Auth::check()&&Auth::user()->role==1)?Auth::user()->institute->id:null;
        $input['institute_id'] = $institute_id;
        $question = $this->questionRepository->create($input);

        return $this->sendResponse($question, 'Question saved successfully.');
    }

    /**
     * @param Question $question
     * @return JsonResponse
     */
    public function edit(Question $question)
    {
        return $this->sendResponse($question, 'Question Retrieved Successfully.');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $this->questionRepository->update($request->all(), $request->questionId);

        return $this->sendSuccess('Question updated successfully.');
    }

    /**
     * @param Question $question
     * @return JsonResponse
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return $this->sendSuccess('Question deleted successfully.');
    }
}
