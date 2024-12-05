<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likeTweet(Request $request, Tweet $tweet)
{
    $tweet->likes()->firstOrCreate(['user_id' => auth()->id()]);

    return response()->json(['message' => 'Tweet liked successfully!']);
}

}
