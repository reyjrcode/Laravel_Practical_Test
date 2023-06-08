<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TweetRequest;
use App\Models\Tweet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function createTweet(TweetRequest $request)
    {
        $tweet = $request->validated();
        $createTweet = Tweet::create($tweet);
        return response()->json(
            [
                'status' => 'Tweet created',
                'tweet' => $createTweet,
            ],
            200
        );
    }
    public function updateTweet(TweetRequest $request)
    {
        $tweetUpdate = Tweet::where('id', $request->id)
            ->update([
                'title' => $request->title,
                'content' => $request->content,
                'attachments' => $request->attachments,
                'updated_at' => Carbon::now(),
            ]);
        return response()->json(
            [
                'status' => 'Updated',
                'message' => 'Tweet successfully updated',
                'tweet_id' => $tweetUpdate,
            ],
            200
        );
    }
    public function deleteTweet(Request $request)
    {
        $tweetDelete = Tweet::where('id', $request->id);
        $tweetDelete->delete();
        return response()->json(
            [
                'status' => 'Delete',
                'message' => 'Tweet successfully deleted',
                'tweet_id' => $request->id,
            ],
            200
        );
    }

}