<?php

namespace App\Http\Controllers\institute\questions;

use App\Http\Controllers\Controller;


use App\Models\institute\questions\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TopicController extends Controller
{
    // URI: /
    // SUM:
    public function getquestionstopicIndex(Request $request): JsonResponse
    {
        $institute_id=auth('institute')->id();
//        dd($institute_id);
        $topic=Topic::where('institute_id','=', $institute_id )

            ->orderBy('id','DESC')

            ->paginate(15);
        return response()->json([
            'topic' => $topic,
        ], Response::HTTP_OK);

    }
    public function gettopic(Request $request): JsonResponse
    {
        $institute_id=auth('institute')->id();
//        dd($institute_id);
        $topic=Topic::where('institute_id','=', $institute_id )

            ->orderBy('id','DESC')

            ->get();
        return response()->json([
            'topic' => $topic,
        ], Response::HTTP_OK);
    }

    public function getstafftopic(Request $request,int $category_id,int $subcategory_id): JsonResponse
    {
        $institute_id=auth('institute')->id();
//        dd($institute_id);
        $topic=Topic::where('institute_id','=', $institute_id )
            ->where('topic_role','staff')
            ->where('category_id',$category_id)
            ->where('subcategory_id',$subcategory_id)
            ->orderBy('id','DESC')

            ->get();
        return response()->json([
            'topic' => $topic,
        ], Response::HTTP_OK);
    }

    // URI: /
    // SUM:
    public function postquestionstopicStore(Request $request): JsonResponse
    {
        $request->validate([
            'topic_name' => 'required|string|max:45',
        ]);
        $institute_id = auth('institute')->id();

        $topic_name = $request->input('topic_name');
        $topic_role = $request->input('topic_role');
        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');



        $topic =Topic::create([
            'topic_name' => $topic_name,
            'topic_role' => $topic_role,
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'institute_id'=>$institute_id,

        ]);
        return response()->json([
            'topic' => $topic,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /
    // SUM:
    public function getquestionstopicShow($id): JsonResponse
    {

        $topic= Topic::where('id', '=',$id)
            ->first();

        return response()->json([
            'topic' => $topic,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /
    // SUM:

    public function patchquestionstopicUpdate(Request $request, $id): JsonResponse
    {

            $topic_role = $request->input('topic_role');
            $topic_name = $request->input('topic_name');
        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');

        Topic::toBase()->where([
                ['id','=',$id],
            ])

            ->update([
                'topic_role'=> $topic_role,
                'topic_name'=> $topic_name,
                'category_id' => $category_id,
                'subcategory_id' => $subcategory_id,
            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /
    // SUM:
    public function deletequestionstopicDestroy($id): JsonResponse
    {
        $topic=Topic::where('id','=',$id)
            ->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
