<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowControllers extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // public function follow(Request $request, User $user)
    // {

    //     // if p

    //     $userid = $request->input('userid');

    //     echo $userid;
    //     // $follow = Follow::firstOrCreate([
    //     //     'follower_id' => Auth::id(),
    //     //     'following_id' => $userid,
    //     // ]);

    //     // return response()->json([
    //     //     'success' => true,
    //     //     'message' => 'Successfully followed user'
    //     // ]);
    // }

    // public function unfollow(User $user)
    // {
    //     $follow = Follow::where('follower_id', Auth::id())
    //         ->where('following_id', $user->id)
    //         ->delete();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Successfully unfollowed user'
    //     ]);
    // }

    // // New method to show followers
    // public function followers(User $user)
    // {
    //     $followers = $user->followers()
    //         ->with('follower')
    //         ->latest()
    //         ->paginate(20);

    //     return view('follows.followers', [
    //         'user' => $user,
    //         'followers' => $followers
    //     ]);
    // }

    // // New method to show following
    // public function following(User $user)
    // {
    //     $following = $user->following()
    //         ->with('following')
    //         ->latest()
    //         ->paginate(20);

    //     return view('follows.following', [
    //         'user' => $user,
    //         'following' => $following
    //     ]);
    // }
    // public function userDirectory(Request $request)
    // {
    //     $query = User::where('id', '!=', Auth::id()) // Exclude current user
    //         ->withCount(['followers', 'following']) // Add counts for followers and following
    //         ->latest();

    //     // Add search functionality
    //     if ($request->has('search')) {
    //         $search = $request->get('search');
    //         $query->where(function ($q) use ($search) {
    //             $q->where('name', 'like', "%{$search}%")
    //                 ->orWhere('email', 'like', "%{$search}%");
    //         });
    //     }

    //     $users = $query->paginate(20);

    //     return view('follows.directory', compact('users'));
    // }
}
