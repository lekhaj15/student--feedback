<?php

namespace App\Http\Controllers\student\feedback;

use App\Http\Controllers\Controller;
use App\Models\institute\questions\Answer;
use App\Models\institute\questions\QuestionPivot;
use App\Models\institute\questions\Topic;
use App\Models\institute\student\StudentInformation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentFeedbackController extends Controller
{
    // URI: /
    // SUM:
    public function getFeedbackIndex(Request $request,$topic_id): JsonResponse
    {

        $stud_id=auth('student')->id();

        $student_information=StudentInformation::where('id',$stud_id)->first();

        $question = DB::table('question_pivots')
            ->select('question_pivots.id','question_pivots.created_at','questions.question_name','questions.option1','questions.option2','questions.option3','questions.option4',
                'grade_categories.category_name','grade_sub_categories.subcategory_name','topics.topic_name')
            ->leftJoin('questions', 'question_pivots.question_id', '=', 'questions.id')
            ->leftJoin('grade_categories', 'question_pivots.category_id', '=', 'grade_categories.id')
            ->leftJoin('grade_sub_categories', 'question_pivots.subcategory_id', '=', 'grade_sub_categories.id')
            ->leftJoin('institutes', 'question_pivots.institute_id', '=', 'institutes.id')
            ->leftJoin('topics', 'question_pivots.topic_id', '=', 'topics.id')
            ->where('question_pivots.institute_id',$student_information->institute_id)
            ->where('question_pivots.category_id',$student_information->category_id)
            ->where('question_pivots.subcategory_id',$student_information->subcategory_id)
            ->where('question_pivots.topic_id',$topic_id)
            ->get();

        return response()->json([
            'question' =>$question ,
        ], JsonResponse::HTTP_OK);
    }

    public function getTopicIndex(Request $request): JsonResponse
    {

        $stud_id=auth('student')->id();

        $student_information=StudentInformation::where('id',$stud_id)->first();
        $topic= Topic::where('institute_id',$student_information->institute_id)->get();

        return response()->json([
            'topic' =>$topic ,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postFeedbackStore (Request $request ): JsonResponse
    {
        $topic_id = $request->input('topic_id');
        $selected_answers = $request->input('answers');

        $stud_id = auth('student')->id();
        $student_information=StudentInformation::where('id',$stud_id)->first();

        foreach ($selected_answers as $sc) {
            $answers = Answer::create([
                'institute_id' => $student_information->institute_id,
                'student_id' => $stud_id,
                'topic_id' => $topic_id,
                'question_id' => $sc['question_id'],
                'answer_name' => $sc['answer'],
            ]);
        }

        return response()->json([
            'answers' => 'success',
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
