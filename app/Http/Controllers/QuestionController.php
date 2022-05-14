<?php

namespace App\Http\Controllers;

use App\Datatable\QuestionDatatable;
use App\Models\Question;
use App\Repositories\QuestionRepository;
use DataTables;
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

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new QuestionDatatable())->get())->make(true);
        }
        return view('question.index');
    }

    public function store(Request $request){
        $question = $this->questionRepository->create($request->all());

        return $this->sendResponse($question, 'Question saved successfully.');
    }
    public function edit(Question $question)
    {
        return $this->sendResponse($question, 'Question Retrieved Successfully.');
    }
    public function update(Request $request)
    {
        $this->questionRepository->update($request->all(), $request->questionId);

        return $this->sendSuccess('Question updated successfully.');
    }
    public function destroy(Question $question)
    {
        $question->delete();

        return $this->sendSuccess('Question deleted successfully.');
    }
}
