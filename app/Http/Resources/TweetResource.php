<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'user' => [
                'id' => $this->user->id,
                'username' => $this->user->username,
                'email' => $this->user->email,
                'image' => $this->user->image,
            ],
            'comments' => $this->comments->count() > 0
                ? CommentResource::collection($this->comments->take(3)->sortByDesc('created_at'))
                : 'No comments yet',
            'likes_count' => $this->likes()->count(),
            'comments_count' => $this->comments()->count(),
        ];
    }
}
