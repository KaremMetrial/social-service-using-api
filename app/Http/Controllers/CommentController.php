<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Tweet;

class CommentController extends Controller
{
    public function addComment(AddCommentRequest $request, Tweet $tweet)
    {
        $validated = $request->validated();

        $comment = $tweet->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return response()->json([
            'message' => 'Comment added successfully!',
            'comment' => new CommentResource($comment),
        ]);
    }

}
