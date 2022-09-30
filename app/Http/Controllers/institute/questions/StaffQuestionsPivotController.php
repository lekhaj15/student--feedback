<?php

namespace App\Http\Controllers\institute\questions;

use App\Http\Controllers\Controller;
use App\Models\institute\questions\StaffQuestion;
use App\Models\institute\questions\StaffQuestionPivot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StaffQuestionsPivotController extends Controller
{
    // URI: /
    // SUM:
    public function getStaffQuestionPivotIndex(Request $request): JsonResponse
    {
        $institute_id=auth('institute')->id();
//        dd($institute_id);
        $pivot=StaffQuestionPivot::where('institute_id','=', $institute_id )

            ->orderBy('id','DESC')
            ->paginate(15);
        return response()->json([
            'pivot' => $pivot,
        ], Response::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postStaffQuestionPivotStore(Request $request): JsonResponse
    {
        $institute_id = auth('institute')->id();

        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $topic_id = $request->input('topic_id');
        $question_id = $request->input('question_id');



        $pivot =StaffQuestion::create([
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
    public function getStaffQuestionPivotShow($id): JsonResponse
    {
        $pivot= StaffQuestionPivot::where('id', '=',$id)
            ->first();

        return response()->json([
            'pivot' => $pivot,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:


    public function patchStaffQuestionPivotUpdate(Request $request, $id): JsonResponse
    {
        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $topic_id = $request->input('topic_id');
        $question_id = $request->input('question_id');


        StaffQuestionPivot::toBase()->where([
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
    public function deleteStaffQuestionPivotDestroy($id): JsonResponse
    { $pivot = StaffQuestionPivot::where('id','=',$id)
        ->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
