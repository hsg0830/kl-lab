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
        $asks = Ask::orderBy('created_at', 'desc')->paginate(10);

        return view('asks.index', ['asks' => $asks]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'category'  => 'required',
           'title' => 'required|max:191',
           'ask_content' => 'required|max:10000',
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
