<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogUser;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BlogUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('users.showbloguser');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogUser $user, string $id)
    {
        $userdetails = BlogUser::where('user_id', $id)->first();
        $username = User::select('name')->find($id);
        return view('users.showbloguser', compact(['userdetails', 'username']));
        // // var_dump($userdetails);

        // dd($userdetails);
        dd($username);
    }

    public function showAllUsers()
    {
        $blogusers = BlogUser::all();
        $users = User::all();

        // $names = DB::select('SELECT name FROM users, blogusers WHERE users.id = blogusers.user_id');

        return view('users.showallusers', compact(['blogusers', 'users']));
        // dd($names);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogUser $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     // First, ensure the route is protected with auth middleware
    //     $user = User::findOrFail($id);

    //     // Use Auth facade explicitly
    //     $authUser = Auth::user();

    //     // Check if user is authenticated
    //     if (!$authUser) {
    //         return response()->json(['error' => 'Unauthenticated'], 401);
    //     }

    //     if ($request->action === 'follow') {
    //         if (!$authUser->isFollowing($user->id)) {
    //             $authUser->following()->attach($user->id);
    //             $user->followers_count += 1;
    //             $user->save();
    //         }
    //     } elseif ($request->action === 'unfollow') {
    //         if ($authUser->isFollowing($user->id)) {
    //             $authUser->following()->detach($user->id);
    //             $user->followers_count -= 1;
    //             $user->save();
    //         }
    //     }

    //     return response()->json(['followers' => $user->followers()->count()], 200);
    // }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogUser $user)
    {
        //
    }


    public function followUser(Request $request)
    {

        $follower_id = $request->input('userid');
        $action = $request->input('action');

        if ($action == 'follow') {
            Follow::Create([
                'following_id' => $follower_id,
                'follower_id' => Auth::id(),
            ]);
        } else if ($action == 'unfollow') {
            Follow::where('follower_id', Auth::id())
                ->where('following_id', $follower_id)
                ->delete();
        }
        return redirect()->back();
    }

    public function unFollowUser(Request $request) {}
}
