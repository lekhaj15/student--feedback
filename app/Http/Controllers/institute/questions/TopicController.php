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
        $topic=Topic::toBase()
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
        $topic_name = $request->input('topic_name');

        $topic =Topic::create([
            'topic_name' => $topic_name,
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

            $topic_name = $request->input('topic_name');

        Topic::toBase()->where([
                ['id','=',$id],
            ])

            ->update([
                'topic_name'=> $topic_name
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
