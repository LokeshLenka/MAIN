<?php

namespace App\Http\Controllers;

use App\Models\BlogUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class BlogUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $count = 0;
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
        // var_dump($userdetails);
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
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $authUser = auth()->user();

        if ($request->action === 'follow') {
            // Follow the user if not already followed
            if (!$authUser->isFollowing($user->id)) {
                $authUser->following()->attach($user->id);
                $user->followers_count += 1; // Increment the cached count if available
                $user->save();
            }
        } elseif ($request->action === 'unfollow') {
            // Unfollow the user if currently followed
            if ($authUser->isFollowing($user->id)) {
                $authUser->following()->detach($user->id);
                $user->followers_count -= 1; // Decrement the cached count if available
                $user->save();
            }
        }

        return response()->json(['followers' => $user->followers()->count()], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogUser $user)
    {
        //
    }
}
