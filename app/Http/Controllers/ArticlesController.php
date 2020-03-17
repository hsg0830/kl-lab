<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use App\Question;
use App\Answer;
use App\Offer;
use Carbon\Carbon;

class ArticlesController extends Controller
{

    public function index()
    {
        // $articles = Article::all();
        $articles = Article::orderBy('post_date', 'desc')->paginate(5);

        return view('articles.index', ['articles' => $articles]);

    }

    public function create()
    {
        if(\Auth::user()->is_admin == true) {

            //$date = Carbon::now();
            //$date = $date->format('yyyy-mm-dd');

            //return view('articles.create', ['date' => $date]);
            return view('articles.create');

        } else {

            return redirect('/articles');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
           'post_date'  => 'required',
           'title' => 'required|max:50',
           'content' => 'required|max:10000',
        ],
        [
            'post_date.required' => '日付を選択してください。',
            'title.required' => 'タイトルを入力してください。',
            'title.max' => 'タイトルは50文字以内で入力してください。',
            'content.required' => '本文を入力してください。',
            'content.max' => '本文は10,000字以内で入力してください。'
        ]);

        $request->user()->articles()->create([
            'category' => $request->category,
            'post_date' => $request->post_date,
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => \Auth::User()->id,
        ]);

        return redirect('/articles');
    }

    public function show($id)
    {
        //$article = Article::find($id);

        //$questions = Article::find($id)->questions;

        $article = Article::with(['questions' => function($query)
        {
            $query->orderBy('created_at', 'desc');

        }])->find($id);

        return view('articles.show', ['article' => $article]);
    }

    public function edit($id)
    {
        if(\Auth::user()->is_admin == true) {

            $article = Article::find($id);

            return view('articles.edit', ['article' => $article]);

        } else {

            return redirect('/articles');
        }
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        $article->category = $request->category;
        $article->post_date = $request->post_date;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->user_id = \Auth::User()->id;

        $article->save();

        //return back();

        $article = Article::find($id);
        $questions = Article::find($id)->questions;

        return view('articles.show', ['article' => $article, 'questions' => $questions]);

    }

    public function destroy($id)
    {
        if(\Auth::user()->is_admin == true) {

            $article = Article::find($id);

            $article->delete();

            return redirect('/articles');
        }
    }
}
