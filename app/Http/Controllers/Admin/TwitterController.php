<?php

namespace emutoday\Http\Controllers\Admin;

use Illuminate\Http\Request;

use emutoday\Http\Requests;

use emutoday\Tweet;

class TwitterController extends Controller
{
    //
    protected $tweets;

    public function __construct(Tweet $tweets)
    {
      $this->tweets = $tweets;
    }

    public function index()
    {
      $tweets_public = Tweet::where('approved',1)->orderBy('created_at','desc')->take(5)->get();

      $tweets = Tweet::orderBy('created_at','desc')->paginate(5);
      return view('admin.twitter.index', compact('tweets', 'tweets_public'));
    }
    // public function store(Request $request)
    // {
    //     $this->users->create($request->only('name', 'email', 'password'));
    //     flash()->success('User has been created.');
    //     return redirect(route('admin.users.index'));//->with('status', 'User has been created.');
    // }

    public function store(Request $request) {
        foreach ($request->all() as $input_key => $input_val) {
            if ( strpos($input_key, 'approval-status-') === 0 ) {
                $tweet_id = substr_replace($input_key, '', 0, strlen('approval-status-'));
                $tweet = Tweet::where('id',$tweet_id)->first();
                if ($tweet) {
                    $tweet->approved = (int)$input_val;
                    $tweet->save();
                }
            }
        }
        flash()->success('Tweets approved');

        return redirect()->back();
    }

}
