<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticlesController extends Controller
{

    public function index()
    {
        $articles = Article::all();
        $articles = Article::orderBy('post_date', 'desc')->paginate(5);

        return view('articles.index', ['articles' => $articles]);

    }

    public function create()
    {
        if(\Auth::user()->is_admin == true) {

            return view('articles.create');

        } else {

            return redirect('/articles');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'post_date'  => 'required',
           'title' => 'required|max:191',
           'content' => 'required|max:10000',
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
        $article = Article::find($id);

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return view('articles.show', ['article' => $article]);

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
