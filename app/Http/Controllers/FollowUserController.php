<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FollowUser;
use App\Models\User;
use Illuminate\Http\Request;

class FollowUserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function followuserornot(Request $request)
    {
        $finFirst = FollowUser::where('follow_user_id', $request->followId);
        if ($finFirst->exists()) {
            $finFirst->update([
                'status' => $request->status,
            ]);
            return response()->json(
                [
                    'status' => $request->status == true ? 'Follow User' : 'Unfollowed user',
                    'user' => $finFirst->get(),
                ],
                200
            );
        }
        $createFollow = FollowUser::create([
            'user_id' => $request->user_id,
            'follow_user_id' => $request->followId,
            'status' => true
        ]);
        return response()->json([
            'status' => 'Follow user',
            'user' => [
                $createFollow
            ]
        ], 200);
    }
    public function followedList(Request $request)
    {
        $getlist = FollowUser::where('user_id', $request->id)
            ->where('status', true)
            ->has('user')
            ->simplePaginate(20);
        return response()->json([
            'status' => 'Success',
            'list' => $getlist
        ], 200);
    }

    public function recommendedList()
    {
        $getlist = User::inRandomOrder()
            ->simplePaginate(20);

        return response()->json(
            [
                'status' => 'success',
                'list' => $getlist
            ],
            200
        );
    }
}