<?php

namespace App\Http\Controllers\institute\quiz;

use App\Http\Controllers\Controller;
use App\Models\institute\grade\GradeSubCategory;
use App\Models\institute\questions\Question;
use App\Models\institute\questions\QuestionPivot;
use App\Models\institute\quiz\Quiz;
use App\Models\institute\quiz\QuizPivot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class QuizController extends Controller
{
    // URI: /
    // SUM:
    public function getQuizIndex(Request $request,int $subcategory_id): JsonResponse
    {

        $institute_id=auth('institute')->id();
        $subcategory=GradeSubCategory::where('id',$subcategory_id)->first();

        $quiz = DB::table('quiz_pivots')
            ->select('quiz_pivots.id','quiz_pivots.created_at','quizzes.question_name','quizzes.option1','quizzes.option2','quizzes.option3','quizzes.option4',
                'grade_categories.category_name','grade_sub_categories.subcategory_name','subjects.subject_name')
            ->leftJoin('quizzes', 'quiz_pivots.quiz_id', '=', 'quizzes.id')
            ->leftJoin('grade_categories', 'quiz_pivots.category_id', '=', 'grade_categories.id')
            ->leftJoin('grade_sub_categories', 'quiz_pivots.subcategory_id', '=', 'grade_sub_categories.id')
            ->leftJoin('institutes', 'quiz_pivots.institute_id', '=', 'institutes.id')
            ->leftJoin('subjects', 'quiz_pivots.subject_id', '=', 'subjects.id')
            ->where('quiz_pivots.institute_id',$institute_id)
            ->where('quiz_pivots.subcategory_id',$subcategory_id)
            ->where('quiz_pivots.category_id',$subcategory->category_id)
            ->paginate(15);

        return response()->json([
            'quiz' => $quiz,
        ], Response::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postStore(Request $request): JsonResponse
    {
        $institute_id = auth('institute')->id();

        $quiz_name = $request->input('quiz_name');
        $option1 = $request->input('option1');
        $option2 = $request->input('option2');
        $option3 = $request->input('option3');
        $option4 = $request->input('option4');

        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $subject_id = $request->input('subject_id');

        $quiz =Quiz::create([
            'quiz_name' => $quiz_name,
            'option1' => $option1,
            'option2' => $option2,
            'option3' => $option3,
            'option4' => $option4,
        ]);

        $pivot =QuizPivot::create([
            'category_id' => $category_id,
            'institute_id'=>$institute_id,
            'subcategory_id' => $subcategory_id,
            'subject_id' => $subject_id,
            'quiz_id' => $quiz->id,
        ]);

        return response()->json([
            'quiz' => $quiz,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /
    // SUM:
    public function getQuizShow($id): JsonResponse
    {
        $quiz=   DB::table('quiz_pivots')
            ->select('quiz_pivots.id','quiz_pivots.created_at','questions.question_name','questions.option1','questions.option2','questions.option3','questions.option4',
                'grade_categories.category_name','grade_sub_categories.subcategory_name','topics.topic_name')
            ->leftJoin('quizzes', 'quiz_pivots.quiz_id', '=', 'quizzes.id')
            ->leftJoin('grade_categories', 'quiz_pivots.category_id', '=', 'grade_categories.id')
            ->leftJoin('grade_sub_categories', 'quiz_pivots.subcategory_id', '=', 'grade_sub_categories.id')
            ->leftJoin('institutes', 'quiz_pivots.institute_id', '=', 'institutes.id')
            ->leftJoin('subjects', 'quiz_pivots.subject_id', '=', 'subject.id')
            ->where('quiz_pivots.id', '=',$id)

            ->first();


        return response()->json([
            'quiz' => $quiz,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function patchQuizUpdate(Request $request, $id): JsonResponse
    {
        $institute_id = auth('institute')->id();

        $quiz_name = $request->input('quiz_name');
        $option1 = $request->input('option1');
        $option2 = $request->input('option2');
        $option3 = $request->input('option3');
        $option4 = $request->input('option4');

        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $subject_id = $request->input('subject_id');
        Quiz::toBase()->where([
            ['id','=',$id],
        ])

            ->update([
                'quiz_name'=> $quiz_name,
                'option1' => $option1,
                'option2' => $option2,
                'option3' => $option3,
                'option4' => $option4,

            ]);
        QuizPivot::toBase()->where([
            ['question_id','=',$id],
        ])

            ->update([
                'category_id' => $category_id,
                'institute_id'=>$institute_id,
                'subcategory_id' => $subcategory_id,
                'subject_id' => $subject_id,

            ]);



        return response()->json([
            'success' => 'update success'  ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /
    // SUM:
    public function deleteQuizDestroy($id): JsonResponse
    {
        $quizpivot=QuizPivot::where('id','=',$id)
            ->first();
        $quiz=Quiz::where('id','=',$quizpivot->quiz_id)->delete();
        QuizPivot::where('id','=',$id)
            ->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
