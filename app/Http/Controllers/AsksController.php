<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ask;
use App\Reply;

class AsksController extends Controller
{
    public function index()
    {
        $asks = Ask::orderBy('created_at', 'desc')->paginate(5);

        return view('asks.index', ['asks' => $asks]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'category'  => 'required',
            'title' => 'required|max:50',
            'ask_content' => 'required|max:5000',
        ],
        [
            'title.required' => 'タイトルを入力してください。',
            'title.max' => 'タイトルは50文字以内で入力してください。',
            'ask_content.required' => '質問内容を入力してください。',
            'ask_content.max' => '質問内容は5,000字以内で入力してください。',
        ]);

        $request->user()->asks()->create([
            'category' => $request->category,
            'title' => $request->title,
            'ask_content' => $request->ask_content,
            'user_id' => \Auth::User()->id,
        ]);

        return redirect('/asks');
    }

    public function show($id)
    {
        $ask = Ask::with(['replies' => function($query)
        {
            $query->orderBy('created_at', 'desc');

        }])->find($id);

        return view('asks.show', ['ask' => $ask]);
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
        $ask = Ask::find($id);

        $ask->delete();

        return redirect('/asks');
    }
}
