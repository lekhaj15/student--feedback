<?php

namespace App\Http\Controllers\institute\answers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentAnswerController extends Controller
{
    // URI: /
    // SUM:
    public function getStudentAnswerIndex(Request $request,int $student_id): JsonResponse
    {
        $institute_id=auth('institute')->id();


//        $pivot=QuestionPivot::where('institute_id','=', $institute_id )
//
//            ->orderBy('id','DESC')
//            ->paginate(15);
        $answers = DB::table('answers')
            ->select('answers.id','answers.created_at','answers.answer_name','topics.topic_name','questions.question_name','questions.option1','questions.option2','questions.option3','questions.option4')
            ->leftJoin('questions', 'answers.question_id', '=', 'questions.id')
            ->leftJoin('topics', 'answers.topic_id', '=', 'topics.id')

            ->where('answers.institute_id',$institute_id)
            ->where('answers.student_id',$student_id)

            ->get();


        return response()->json([
            'answers' => $answers,
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
