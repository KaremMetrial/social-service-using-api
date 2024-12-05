<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTweetRequest;
use App\Http\Requests\UpdateTweetRequest;
use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tweets = Tweet::latest()->paginate(3);
        if($tweets->isEmpty()) {
            return response()->json([
                'message' => 'No tweets found.'
            ]);
        }
        return TweetResource::collection($tweets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTweetRequest $request)
    {
        $validated = $request->validated();

        $tweet = auth()->user()->tweets()->create([
            'content' => $validated['content'],
        ]);

        return response()->json([
            'message' => 'Tweet created successfully!',
            'tweet' => new TweetResource($tweet)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTweetRequest $request, Tweet $tweet)
    {
        Gate::authorize('update', $tweet);

        $validated = $request->validated();

        $tweet->update([
            'content' => $validated['content']
        ]);
        return response()->json([
            'message' => 'Tweet updated successfully',
            'tweet' => new TweetResource($tweet->fresh())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function timeline()
    {
        $following = auth()->user()->following()->pluck('followed_id');

        $tweets = Tweet::whereIn('user_id', $following)
            ->latest()
            ->paginate(3);

        if ($tweets->isEmpty()) {
            return response()->json([
                'message' => 'No tweets in your timeline',
            ]);
        }

        return TweetResource::collection($tweets);
    }

}
