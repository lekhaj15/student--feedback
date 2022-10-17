<?php

namespace App\Http\Controllers\institute\questions;

use App\Http\Controllers\Controller;
use App\Models\institute\grade\GradeSubCategory;
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
    public function getQuestionIndex(Request $request,int $subcategory_id): JsonResponse
    {

        $institute_id=auth('institute')->id();
        $subcategory=GradeSubCategory::where('id',$subcategory_id)->first();

        $question = DB::table('question_pivots')
            ->select('question_pivots.id','question_pivots.created_at','questions.question_name','questions.option1','questions.option2','questions.option3','questions.option4',
            'grade_categories.category_name','grade_sub_categories.subcategory_name','topics.topic_name')
            ->leftJoin('questions', 'question_pivots.question_id', '=', 'questions.id')
            ->leftJoin('grade_categories', 'question_pivots.category_id', '=', 'grade_categories.id')
            ->leftJoin('grade_sub_categories', 'question_pivots.subcategory_id', '=', 'grade_sub_categories.id')
            ->leftJoin('institutes', 'question_pivots.institute_id', '=', 'institutes.id')
            ->leftJoin('topics', 'question_pivots.topic_id', '=', 'topics.id')
            ->where('question_pivots.institute_id',$institute_id)
            ->where('question_pivots.subcategory_id',$subcategory_id)
            ->where('question_pivots.category_id',$subcategory->category_id)
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
        $institute_id = auth('institute')->id();

        $question_name = $request->input('question_name');
        $option1 = $request->input('option1');
        $option2 = $request->input('option2');
        $option3 = $request->input('option3');
        $option4 = $request->input('option4');

        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $topic_id = $request->input('topic_id');
        Question::toBase()->where([
            ['id','=',$id],
        ])

            ->update([
                'question_name'=> $question_name,
                'option1' => $option1,
                'option2' => $option2,
                'option3' => $option3,
                'option4' => $option4,

            ]);
        QuestionPivot::toBase()->where([
            ['question_id','=',$id],
        ])

            ->update([
                'category_id' => $category_id,
                'institute_id'=>$institute_id,
                'subcategory_id' => $subcategory_id,
                'topic_id' => $topic_id,

            ]);



        return response()->json([
            'success' => 'update success'  ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    public function getQuestion(Request $request,int $subcategory_id): JsonResponse
    {

        $institute_id=auth('institute')->id();
        $subcategory=GradeSubCategory::where('id',$subcategory_id)->first();

//        $question = DB::table('answers')
//            ->select('question_id')
////                ->where('question_id',1)
//            ->where('subcategory_id',$subcategory_id)
//            ->get();

        $question = DB::table('answers')
                ->select('answers.id','questions.question_name',
                    DB::raw("count(answers.option1) as excellent_count"),
                    DB::raw("count(answers.option2) as good_count") ,
                    DB::raw("count(answers.option3) as avg_count"),
                    DB::raw("count(answers.option4) as poor_count"))
            ->leftJoin('questions', 'answers.question_id', '=', 'questions.id')

            ->where('answers.question_id',1)
//                ->where('subcategory_id',$subcategory_id)
//                ->groupBy('id')
                ->where('answers.option1','excellent')
            ->orwhere('answers.option2','good')
            ->orwhere('answers.option3','average')
            ->orwhere('answers.option4','poor')
            ->groupBy('answers.id')
                ->get();
//        foreach ($question as $quest){
//
//            $question = DB::table('answers')
//                ->select('id',DB::raw("count(answer_name) as count"))
//                ->where('question_id',$quest->question_id)
//                ->where('subcategory_id',$subcategory_id)
//                ->groupBy('id')
//                ->first();
//
//        }

        return response()->json([
            'question' => $question,
        ], Response::HTTP_OK);
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
