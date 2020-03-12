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
           'reply_content' => 'required|max:10000',
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
