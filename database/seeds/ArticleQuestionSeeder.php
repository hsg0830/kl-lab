<?php

use Illuminate\Database\Seeder;

class ArticleQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $content = 'この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。';

        for( $i = 1 ; $i <= 20 ; $i++) {
            $article = new Article;
            $article->category = vocaburary;
            $article->post_date = '2020/02/27';
            $article->title = "$i 番目の投稿";
            $article->content = $content;
            $article->user_id = User::find(1)->id;
            $article->save();
        }
    }
}
