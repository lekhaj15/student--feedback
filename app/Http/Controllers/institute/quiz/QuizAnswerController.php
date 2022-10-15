<?php

namespace App\Http\Controllers\institute\quiz;

use App\Http\Controllers\Controller;
use App\Models\institute\questions\Answer;
use App\Models\institute\quiz\QuizAnswer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuizAnswerController extends Controller
{
    // URI: /
    // SUM:
    public function getQuizAnswerIndex(Request $request): JsonResponse
    {
        $institute_id=auth('institute')->id();
//        dd($institute_id);
        $quiz_answer=QuizAnswer::where('institute_id','=', $institute_id )

            ->orderBy('id','DESC')

            ->paginate(15);
        return response()->json([
            'quiz_answer' => $quiz_answer,
        ], Response::HTTP_OK);
    }
    public function getQuizAnswer(Request $request): JsonResponse
    {
        $institute_id=auth('institute')->id();
//        dd($institute_id);
        $quiz_answer=QuizAnswer::where('institute_id','=', $institute_id )

            ->orderBy('id','DESC')

            ->get();
        return response()->json([
            'quiz_answer' => $quiz_answer,
        ], Response::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postQuizAnswerStore(Request $request): JsonResponse
    {
        $institute_id = auth('institute')->id();

        $answer_name = $request->input('answer_name');

        $quiz_answer =QuizAnswer::create([
            'answer_name' => $answer_name,
            'institute_id'=>$institute_id,

        ]);
        return response()->json([
            'quiz_answer' => $quiz_answer,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /
    // SUM:
    public function getShow($id): JsonResponse
    {
        $quiz_answer= QuizAnswer::where('id', '=',$id)
            ->first();

        return response()->json([
            'quiz_answer' => $quiz_answer,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function getEdit($id): JsonResponse
    {
        return response()->json([
            '' => null,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function patchQuizAnswerUpdate(Request $request, $id): JsonResponse
    {
        $answer_name = $request->input('answer_name');

        QuizAnswer::toBase()->where([
            ['id','=',$id],
        ])

            ->update([
                'answer_name'=> $answer_name
            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /
    // SUM:
    public function deleteQuizAnswerDestroy($id): JsonResponse
    {
        $quiz_answer=QuizAnswer::where('id','=',$id)
            ->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
