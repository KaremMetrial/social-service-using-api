<?php

namespace App\Http\Controllers;

use App\Events\NewFollowerEvent;
use App\Mail\FollowNotification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class FollowController extends Controller
{
    public function followUser(User $user)
    {


        if (auth()->id() === $user->id) {
            return response()->json([
                'message' => 'You cannot follow yourself',
            ]);
        }


        $isFollowing = auth()->user()->following()->toggle($user->id);


        if ($isFollowing['attached']) {
            Mail::to($user->email)
                ->send(new FollowNotification(auth()->user()));
                event(new NewFollowerEvent(auth()->user(), $user));
            }


        return response()->json([
            'message' => $isFollowing['attached'] ? 'Followed successfully' : 'Unfollowed successfully',
            'is_following' => !empty($isFollowing['attached']),
            'followers_count' => $user->followers()->count(),
            'following_count' => $user->following()->count(),
        ]);
    }
}
