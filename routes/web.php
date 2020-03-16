<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'GetListsController@ListForTop');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

//コラムの投稿・編集など（Admin Gate テスト用）
Route::resource('articles', 'ArticlesController');

//コラムへの質問
Route::resource('questions', 'QuestionsController', ['only' => ['store', 'destroy']]);

//コラムへの質問への回答
Route::resource('answers', 'AnswersController', ['only' => ['store', 'destroy']]);

//資料室のルーティング
Route::resource('resources', 'ResourcesController', ['only' => ['index', 'store', 'show', 'destroy']]);

//ファイルのダウンロード
Route::get('download', 'DownloadController@index')->name('download');

//資料室の請求
Route::resource('offers', 'OffersController', ['only' => ['store', 'destroy']]);

//質問コーナーのルーティング
Route::resource('asks', 'AsksController', ['only' => ['index', 'store', 'show', 'destroy']]);

//質問への回答のルーティング
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);