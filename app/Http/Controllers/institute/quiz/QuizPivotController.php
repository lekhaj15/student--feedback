<?php

namespace App\Http\Controllers\institute\quiz;

use App\Http\Controllers\Controller;
use App\Models\institute\questions\QuestionPivot;
use App\Models\institute\quiz\Quiz;
use App\Models\institute\quiz\QuizPivot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuizPivotController extends Controller
{
    // URI: /
    // SUM:
    public function getQuizPivotIndex(Request $request): JsonResponse
    {
        $institute_id=auth('institute')->id();
//        dd($institute_id);
        $pivot=QuizPivot::where('institute_id','=', $institute_id )

            ->orderBy('id','DESC')
            ->paginate(15);
        return response()->json([
            'pivot' => $pivot,
        ], Response::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postStore(Request $request): JsonResponse
    {
        $institute_id = auth('institute')->id();

        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $subject_id = $request->input('subject_id');
        $quiz_id = $request->input('question_id');



        $pivot =Quiz::create([
            'question_name' => $category_id,
            'institute_id'=>$institute_id,
            'subcategory_id' => $subcategory_id,
            'subject_id' => $subject_id,
            'question_id' => $quiz_id,



        ]);
        return response()->json([
            'pivot' => $pivot,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /
    // SUM:


    public function getQuizPivotShow($id): JsonResponse
    {
        $pivot= QuizPivot::where('id', '=',$id)
            ->first();

        return response()->json([
            'pivot' => $pivot,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function patchQuizPivotUpdate(Request $request, $id): JsonResponse
    {
        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $subject_id = $request->input('subject_id');
        $quiz_id = $request->input('quiz_id');


        QuizPivot::toBase()->where([
            ['id','=',$id],
        ])

            ->update([
                'question_name' => $category_id,
                'subcategory_id' => $subcategory_id,
                'subject_id' => $subject_id,
                'quiz_id' => $quiz_id,

            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /
    // SUM:
    public function deleteQuizDestroy($id): JsonResponse
    {
        $pivot = QuizPivot::where('id','=',$id)
            ->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
