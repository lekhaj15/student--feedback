<?php

namespace App\Http\Controllers\institute\questions;

use App\Http\Controllers\Controller;
use App\Models\institute\grade\GradeSubCategory;
use App\Models\institute\questions\StaffQuestion;
use App\Models\institute\questions\StaffQuestionPivot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class StaffQuestionsController extends Controller
{
    // URI: /
    // SUM:
    public function getstaffquestionIndex(Request $request,int $subcategory_id): JsonResponse
    {
        $institute_id=auth('institute')->id();
        $subcategory=GradeSubCategory::where('id',$subcategory_id)->first();


        $question = DB::table('staff_question_pivots')
            ->select('staff_question_pivots.id','staff_question_pivots.created_at','staff_questions.question_name',
                'staff_questions.option1','staff_questions.option2','staff_questions.option3','staff_questions.option4',
                'grade_categories.category_name','grade_sub_categories.subcategory_name','topics.topic_name')
            ->leftJoin('staff_questions', 'staff_question_pivots.question_id', '=', 'staff_questions.id')
            ->leftJoin('grade_categories', 'staff_question_pivots.category_id', '=', 'grade_categories.id')
            ->leftJoin('grade_sub_categories', 'staff_question_pivots.subcategory_id', '=', 'grade_sub_categories.id')
            ->leftJoin('institutes', 'staff_question_pivots.institute_id', '=', 'institutes.id')
            ->leftJoin('topics', 'staff_question_pivots.topic_id', '=', 'topics.id')
            ->where('staff_question_pivots.institute_id',$institute_id)
            ->where('staff_question_pivots.subcategory_id',$subcategory_id)
            ->where('staff_question_pivots.category_id',$subcategory->category_id)
            ->paginate(15);

        return response()->json([
            'question' => $question,
        ], Response::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postStaffQuestionStore(Request $request): JsonResponse
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

        $question =StaffQuestion::create([
            'question_name' => $question_name,
            'option1' => $option1,
            'option2' => $option2,
            'option3' => $option3,
            'option4' => $option4,
        ]);

        $pivot =StaffQuestionPivot::create([
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
    public function getstaffquestionShow($id): JsonResponse
    {
        $question=   DB::table('staff_question_pivots')
            ->select('staff_question_pivots.id','staff_question_pivots.created_at','staff_questions.question_name','staff_questions.option1','staff_questions.option2','staff_questions.option3','staff_questions.option4',
                'grade_categories.category_name','grade_sub_categories.subcategory_name','topics.topic_name')
            ->leftJoin('staff_questions', 'staff_question_pivots.question_id', '=', 'staff_questions.id')
            ->leftJoin('grade_categories', 'staff_question_pivots.category_id', '=', 'grade_categories.id')
            ->leftJoin('grade_sub_categories', 'staff_question_pivots.subcategory_id', '=', 'grade_sub_categories.id')
            ->leftJoin('institutes', 'staff_question_pivots.institute_id', '=', 'institutes.id')
            ->leftJoin('topics', 'staff_question_pivots.topic_id', '=', 'topics.id')
            ->where('staff_question_pivots.id', '=',$id)

            ->first();


        return response()->json([
            'staff_questions' => $question,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:

    public function patchStaffQuestionUpdate(Request $request, $id): JsonResponse
    {
        $question_name = $request->input('question_name');
        $option1 = $request->input('option1');
        $option2 = $request->input('option2');
        $option3 = $request->input('option3');
        $option4 = $request->input('option4');


        StaffQuestion::toBase()->where([
            ['id','=',$id],
        ])

            ->update([
                'question_name'=> $question_name,
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
    public function deletestaffQuestionDestroy($id)
    {
        $staffpivot=StaffQuestionPivot::where('id','=',$id)
            ->first();
        $question=StaffQuestion::where('id','=',$staffpivot->question_id)->delete();
        StaffQuestionPivot::where('id','=',$id)
            ->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
