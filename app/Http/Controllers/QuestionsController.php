<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Article;
use App\Question;
use App\Answer;

class QuestionsController extends Controller
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
                'content_Q' => 'required|max:2000',
           ],
           [
                'content_Q.required' => '質問内容を入力してください。',
                'content_Q.max' => '質問は2,000字以内で入力してください。',
        ]);

        /*$question = new Question();

        $question->article_id = $request->article_id;
        $question->user_id = \Auth::User()->id;
        $question->content = $request->content1;
        $question->user_of_handled = 1;
        $question->save();
        */

        $article = Article::find($request->article_id);

        $article->questions()->create([
            'content' => $request->content_Q,
            'user_id' => \Auth::User()->id,
            'user_of_handled' => 1,
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
        $question = Question::find($id);

        $question->delete();

        return back();
    }
}
