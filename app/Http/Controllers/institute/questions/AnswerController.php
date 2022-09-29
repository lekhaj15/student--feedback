<?php

namespace App\Http\Controllers\institute\questions;

use App\Http\Controllers\Controller;
use App\Models\institute\questions\Answer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    // URI: /
    // SUM:
    public function getAnswerIndex(Request $request): JsonResponse
    {
        $institute_id=auth('institute')->id();
//        dd($institute_id);
        $answer=Answer::where('institute_id','=', $institute_id )

            ->orderBy('id','DESC')

            ->paginate(15);
        return response()->json([
            'answer' => $answer,
        ], Response::HTTP_OK);
    }
    public function getAnswer(Request $request): JsonResponse
    {
        $institute_id=auth('institute')->id();
//        dd($institute_id);
        $answer=Answer::where('institute_id','=', $institute_id )

            ->orderBy('id','DESC')

            ->get();
        return response()->json([
            'answer' => $answer,
        ], Response::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postAnswerStore(Request $request): JsonResponse
    {
       // $request->validate([
           // 'topic_name' => 'required|string|max:45',
        //]);
        $institute_id = auth('institute')->id();

        $answer_name = $request->input('answer_name');

        $answer =Answer::create([
            'answer_name' => $answer_name,
            'institute_id'=>$institute_id,

        ]);
        return response()->json([
            'answer' => $answer,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /
    // SUM:
    public function getAnswerShow($id): JsonResponse
    {
        $answer= Answer::where('id', '=',$id)
            ->first();

        return response()->json([
            'answer' => $answer,
        ], JsonResponse::HTTP_OK);
    }



    // URI: /
    // SUM:
    public function patchUpdate(Request $request, $id): JsonResponse
    {
        $answer_name = $request->input('answer_name');

        Answer::toBase()->where([
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
    public function deleteAnswerDestroy($id): JsonResponse
    {
        $answer=Answer::where('id','=',$id)
            ->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
