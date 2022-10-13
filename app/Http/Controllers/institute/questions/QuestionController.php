<?php

namespace App\Http\Controllers\institute\questions;

use App\Http\Controllers\Controller;
use App\Models\institute\questions\Question;
use App\Models\institute\questions\QuestionPivot;
use App\Models\institute\questions\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    // URI: /
    // SUM:
    public function getQuestionIndex(Request $request): JsonResponse
    {

        $institute_id=auth('institute')->id();
//        dd($institute_id);
//        $question=QuestionPivot::with('questionInformation','categoryInformation','subCategoryInformation','topicinformation')
//
//            ->orderBy('id','DESC')
//
//            ->paginate(15);

        $question = DB::table('question_pivots')
            ->select('question_pivots.id','question_pivots.created_at','questions.question_name','questions.option1','questions.option2','questions.option3','questions.option4',
            'grade_categories.category_name','grade_sub_categories.subcategory_name','topics.topic_name')
            ->leftJoin('questions', 'question_pivots.question_id', '=', 'questions.id')
            ->leftJoin('grade_categories', 'question_pivots.category_id', '=', 'grade_categories.id')
            ->leftJoin('grade_sub_categories', 'question_pivots.subcategory_id', '=', 'grade_sub_categories.id')
            ->leftJoin('institutes', 'question_pivots.institute_id', '=', 'institutes.id')
            ->leftJoin('topics', 'question_pivots.topic_id', '=', 'topics.id')
            ->where('question_pivots.institute_id',$institute_id)
            ->paginate(15);

        return response()->json([
            'question' => $question,
        ], Response::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postQuestionStore(Request $request): JsonResponse
    {
        /*$request->validate([
            'question_name' => 'required|string|max:45',
        ]);*/
        $institute_id = auth('institute')->id();

        $question_name = $request->input('question_name');
        $option1 = $request->input('option1');
        $option2 = $request->input('option2');
        $option3 = $request->input('option3');
        $option4 = $request->input('option4');

        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $topic_id = $request->input('topic_id');

        $question =Question::create([
            'question_name' => $question_name,
            'option1' => $option1,
            'option2' => $option2,
            'option3' => $option3,
            'option4' => $option4,
        ]);

        $pivot =QuestionPivot::create([
            'category_id' => $category_id,
            'institute_id'=>$institute_id,
            'subcategory_id' => $subcategory_id,
            'topic_id' => $topic_id,
            'question_id' => $question->id,
        ]);

        return response()->json([
            'question' => $question,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /
    // SUM:
    public function getQuestionShow($id): JsonResponse
    {

//        $question= QuestionPivot::with('questionInformation','categoryInformation','subCategoryInformation','topicInformation')

           $question=   DB::table('question_pivots')
                ->select('question_pivots.id','question_pivots.created_at','questions.question_name','questions.option1','questions.option2','questions.option3','questions.option4',
                    'grade_categories.category_name','grade_sub_categories.subcategory_name','topics.topic_name')
                ->leftJoin('questions', 'question_pivots.question_id', '=', 'questions.id')
                ->leftJoin('grade_categories', 'question_pivots.category_id', '=', 'grade_categories.id')
                ->leftJoin('grade_sub_categories', 'question_pivots.subcategory_id', '=', 'grade_sub_categories.id')
                ->leftJoin('institutes', 'question_pivots.institute_id', '=', 'institutes.id')
                ->leftJoin('topics', 'question_pivots.topic_id', '=', 'topics.id')
               ->where('question_pivots.id', '=',$id)

            ->first();


        return response()->json([
            'question' => $question,
        ], JsonResponse::HTTP_OK);
    }



    // URI: /
    // SUM:
    public function patchQuestionUpdate(Request $request, $id): JsonResponse
    {
        $question_name = $request->input('question_name');
        $option1 = $request->input('option1');
        $option2 = $request->input('option2');
        $option3 = $request->input('option3');
        $option4 = $request->input('option4');


        Question::toBase()->where([
            ['id','=',$id],
        ])

            ->update([
                'topic_name'=> $question_name,
                'option1' => $option1,
                'option2' => $option2,
                'option3' => $option3,
                'option4' => $option4,

            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /
    // SUM:
    public function deleteQuestionDestroy($id)
    {
        $questionpivot=QuestionPivot::where('id','=',$id)
            ->first();
        $question=Question::where('id','=',$questionpivot->question_id)->delete();
      QuestionPivot::where('id','=',$id)
            ->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
