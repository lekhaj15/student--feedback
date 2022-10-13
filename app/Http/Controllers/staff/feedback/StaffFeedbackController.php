<?php

namespace App\Http\Controllers\staff\feedback;

use App\Http\Controllers\Controller;
use App\Models\institute\questions\Answer;
use App\Models\institute\questions\StaffAnswer;
use App\Models\institute\staff\StaffInformation;
use App\Models\institute\student\StudentInformation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\institute\questions\Topic;


class StaffFeedbackController extends Controller
{
    // URI: /
    // SUM:
    public function getStaffFeedbackIndex(Request $request, $topic_id): JsonResponse
    {
        $staffs_id = auth('staff')->id();

        $staff_information = StaffInformation::where('id', $staffs_id)->first();
        $question = DB::table('staff_question_pivots')
            ->select('staff_question_pivots.id', 'staff_question_pivots.created_at',
                'staff_questions.question_name', 'staff_questions.option1', 'staff_questions.option2',
                'staff_questions.option3', 'staff_questions.option4',
                'grade_categories.category_name', 'grade_sub_categories.subcategory_name',
                'topics.topic_name')
            ->leftJoin('staff_questions', 'staff_question_pivots.question_id', '=', 'staff_questions.id')
            ->leftJoin('grade_categories', 'staff_question_pivots.category_id', '=', 'grade_categories.id')
            ->leftJoin('grade_sub_categories', 'staff_question_pivots.subcategory_id', '=', 'grade_sub_categories.id')
            ->leftJoin('institutes', 'staff_question_pivots.institute_id', '=', 'institutes.id')
            ->leftJoin('topics', 'staff_question_pivots.topic_id', '=', 'topics.id')
            ->where('staff_question_pivots.institute_id', $staff_information->institute_id)
            ->where('staff_question_pivots.category_id', $staff_information->category_id)
            ->where('staff_question_pivots.subcategory_id', $staff_information->subcategory_id)
          ->where('staff_question_pivots.topic_id', $topic_id)
            ->get();

        return response()->json([
            'question' => $question,
        ], JsonResponse::HTTP_OK);

    }

    // URI: /
    // SUM:
    public function poststafffeedbackStore(Request $request): JsonResponse
    {
        $topic_id = $request->input('topic_id');
        $selected_answers = $request->input('answers');

        $staffs_id = auth('staff')->id();
        $staff_information = StaffInformation::where('id', $staffs_id)->first();

        foreach ($selected_answers as $sc) {
            $answers = StaffAnswer::create([
                'institute_id' => $staff_information->institute_id,
                'staff_id' => $staffs_id,
                'topic_id' => $topic_id,
                'question_id' => $sc['question_id'],
                'answer_name' => $sc['answer'],
            ]);
        }
        return response()->json([
            'answers' => 'success',
        ], JsonResponse::HTTP_CREATED);
    }


    public function getStaffTopicIndex(Request $request): JsonResponse
    {
        $staffs_id=auth('staff')->id();

        $staff_information=StaffInformation::where('id',$staffs_id)->first();
        $topic= Topic::where('institute_id',$staff_information->institute_id)
            ->where('topic_role','staff')->get();

        return response()->json([
            'topic' =>$topic ,
        ], JsonResponse::HTTP_OK);
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
