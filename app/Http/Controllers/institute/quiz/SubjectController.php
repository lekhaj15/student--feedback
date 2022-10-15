<?php

namespace App\Http\Controllers\institute\quiz;

use App\Http\Controllers\Controller;
use App\Models\institute\questions\Topic;
use App\Models\institute\quiz\Subject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // URI: /
    // SUM:
    public function getSubjectIndex(Request $request): JsonResponse
    {
        $institute_id=auth('institute')->id();
//        dd($institute_id);
        $subject=Subject::where('institute_id','=', $institute_id )

            ->orderBy('id','DESC')

            ->paginate(15);
        return response()->json([
            'subject' => $subject,
        ], Response::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postSubjectStore(Request $request): JsonResponse
    {

        $institute_id = auth('institute')->id();

        $subject_name = $request->input('topic_name');
        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');



        $subject =Subject::create([

            'subject_name' => $subject_name,
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'institute_id'=>$institute_id,

        ]);
        return response()->json([
            'subject' => $subject,
        ], JsonResponse::HTTP_CREATED);
    }

    public function getSubject(Request $request, $category_id, $subcategory_id): JsonResponse
    {
        $institute_id=auth('institute')->id();
//        dd($institute_id);
        $subject=Topic::where('institute_id','=', $institute_id )
            ->where('category_id',$category_id)
            ->where('subcategory_id',$subcategory_id)
            ->orderBy('id','DESC')
            ->get();
        return response()->json([
            'topic' => $subject,
        ], Response::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function getSubjectShow($id): JsonResponse
    {
        $subject= Topic::where('id', '=',$id)
            ->first();

        return response()->json([
            'topic' => $subject,
        ], JsonResponse::HTTP_OK);

    }



    // URI: /
    // SUM:
    public function patchsubjectUpdate(Request $request, $id): JsonResponse
    {
        $subject_name = $request->input('topic_name');
        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');

        Topic::toBase()->where([
            ['id','=',$id],
        ])

            ->update([
                'subject_name'=> $subject_name,
                'category_id' => $category_id,
                'subcategory_id' => $subcategory_id,
            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /
    // SUM:
    public function deletesubjectDestroy($id): JsonResponse
    {
        $subject=Subject::where('id','=',$id)
            ->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
