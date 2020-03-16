<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Ask;
use App\Reply;

class RepliesController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'reply_content' => 'required|max:5,000',
        ],
        [
            'reply_content.required' => '回答内容を入力してください。',
            'reply_content.max' => '回答内容は5,000字以内で入力してください。',
        ]);

        $ask = Ask::find($request->ask_id);

        $ask->replies()->create([
            'reply_content' => $request->reply_content,
            'user_id' => \Auth::User()->id,
        ]);

        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $reply = Reply::find($id);

        $reply->delete();

        return back();
    }
}
