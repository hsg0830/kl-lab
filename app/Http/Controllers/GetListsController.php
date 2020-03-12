<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Article;
use App\Question;
use App\Answer;
use App\Resource;
use App\Ask;

class GetListsController extends Controller
{

        public function ListForTop()
        {
          $articles = Article::orderBy('post_date', 'desc')->paginate(5);
          $resources = Resource::orderBy('created_at', 'desc')->paginate(5);
          $asks = Ask::orderBy('created_at', 'desc')->paginate(5);

          return view('index', [
              'articles' => $articles,
              'resources' => $resources,
              'asks' => $asks,
            ]);
        }
}
