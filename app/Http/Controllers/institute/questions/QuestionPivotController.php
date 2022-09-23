<?php

namespace App\Http\Controllers\institute\questions;

use App\Http\Controllers\Controller;
use App\Models\institute\questions\QuestionPivot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionPivotController extends Controller
{
    // URI: /
    // SUM:
    public function getQuestionPivotIndex(Request $request): JsonResponse
    {
        $institute_id=auth('institute')->id();
//        dd($institute_id);
        $pivot=QuestionPivot::where('institute_id','=', $institute_id )

            ->orderBy('id','DESC')
            ->paginate(15);
        return response()->json([
            'pivot' => $pivot,
        ], Response::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postQuestionPivotStore(Request $request): JsonResponse
    {
        $institute_id = auth('institute')->id();

        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $topic_id = $request->input('topic_id');
        $question_id = $request->input('question_id');



        $pivot =Question::create([
            'question_name' => $category_id,
            'institute_id'=>$institute_id,
            'subcategory_id' => $subcategory_id,
            'topic_id' => $topic_id,
            'question_id' => $question_id,



        ]);
        return response()->json([
            'pivot' => $pivot,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /
    // SUM:
    public function getQuestionPivotShow($id): JsonResponse
    {

        $pivot= QuestionPivot::where('id', '=',$id)
            ->first();

        return response()->json([
            'pivot' => $pivot,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:

    public function patchQuestionPivotUpdate(Request $request, $id): JsonResponse
    {
        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $topic_id = $request->input('topic_id');
        $question_id = $request->input('question_id');


        QuestionPivot::toBase()->where([
            ['id','=',$id],
        ])

            ->update([
                'question_name' => $category_id,
                'subcategory_id' => $subcategory_id,
                'topic_id' => $topic_id,
                'question_id' => $question_id,

            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /
    // SUM:
    public function deleteQuestionPivotDestroy($id): JsonResponse
    {
        $pivot = QuestionPivot::where('id','=',$id)
            ->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
