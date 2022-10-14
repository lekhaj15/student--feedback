<?php

namespace App\Http\Controllers\institute\answers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffAnswerController extends Controller
{
    // URI: /
    // SUM:
    public function getStaffAnswerIndex(Request $request,int $staff_id): JsonResponse
    {
        $institute_id=auth('institute')->id();


//        $pivot=QuestionPivot::where('institute_id','=', $institute_id )
//
//            ->orderBy('id','DESC')
//            ->paginate(15);
        $staff_answers = DB::table('staff_answers')
            ->select('staff_answers.id','staff_answers.created_at','staff_answers.answer_name','topics.topic_name','questions.question_name','questions.option1','questions.option2','questions.option3','questions.option4')
            ->leftJoin('questions', 'staff_answers.question_id', '=', 'questions.id')
            ->leftJoin('topics', 'staff_answers.topic_id', '=', 'topics.id')

            ->where('staff_answers.institute_id',$institute_id)
            ->where('staff_answers.staff_id',$staff_id)

            ->get();


        return response()->json([
            'staff_answers' => $staff_answers,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postStore(Request $request): JsonResponse
    {
        return response()->json([
            '' => null,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /
    // SUM:
    public function getShow($id): JsonResponse
    {
        return response()->json([
            '' => null,
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
    public function patchUpdate(Request $request, $id): JsonResponse
    {
        return response()->json([
            '' => null,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /
    // SUM:
    public function deleteDestroy($id): JsonResponse
    {
        return response()->json([
            '' => null,
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
