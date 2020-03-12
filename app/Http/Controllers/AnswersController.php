<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Article;
use App\Question;
use App\Answer;


class AnswersController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $question_id = $request->id;

        return view('articles.answer', ['question_id' => $question_id]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'content_A' => 'required|max:2000',
        ]);

        /*$answer = new Answer();

        $answer->question_id = $request->question_id;
        $answer->user_id = \Auth::User()->id;
        $answer->content = $request->content_A;
        $answer->save();
        */

        $question = Question::find($request->question_id);

        $question->answers()->create([
            'content' => $request->content_A,
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
        $answer = Answer::find($id);

        $answer->delete();

        return back();
    }
}