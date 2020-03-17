<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\User;
use App\Resource;
use App\Offer;
use Carbon\Carbon;

class ResourcesController extends Controller
{
    public function index()
    {
        $resources = Resource::orderBy('created_at', 'desc')->paginate(5);

        $offers = Offer::orderBy('created_at', 'desc')->get();

        return view('resources.index', ['resources' => $resources, 'offers' => $offers]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
            $request->validate([
                'title' => 'required|max:50',
                'explanation' => 'required|max:2000',
                'file' => 'required',
            ],
            [
                'title.required' => 'タイトルを入力してください。',
                'title.max' => 'タイトルは50文字以内で入力してください。',
                'explanation.required' => '説明を入力してください。',
                'explanation.max' => '説明は2,000字以内で入力してください。',
                'file.required' => 'ファイルを添付してください。',
            ]);

            //s3用にファイルを取得
            $file = $request->file('file');

           //拡張子の取得
            $file_name = $request->file('file')->getClientOriginalName(); //投稿されたファイル名を取得
            $file_extention = pathinfo($file_name, PATHINFO_EXTENSION); //ファイル名から拡張子を取得

            //保存時のファイル名を作成
            $date = Carbon::now();
            $date = $date->format('ymdhi');

            $file_fullname = $date . '_0' . \Auth::User()->id . '.' . $file_extention;


            //S3に保存し、Pathを取得
            $file_path = Storage::disk('s3')->putFileAs('/', $file, $file_fullname, 'publc');

            //DBに情報を保存
            Resource::create([
                'category' => $request->category,
                'title' => $request->title,
                'explanation' => $request->explanation,
                'user_id' => \Auth::User()->id,
                'type_of_file' => $file_extention,
                'name_of_file' => $file_fullname,
                'file_path' => $file_path,
                ]);

            return back();

    }

    public function show($id)
    {
        $resource = Resource::find($id);

        return view('resources.show', ['resource' => $resource]);
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
        $resource = Resource::find($id);

        //ローカルの場合
        //削除対象のファイル名を取得
        //$file_name = $resource->file_path;
        //対象のファイルを削除
        //Storage::delete($file_name);

        //S3の場合
        $file_name = $resource->name_of_file;

        $disk = Storage::disk('s3');
        $disk->delete($file_name);

        //ファイルの情報をDBから削除
        $resource->delete();

        return redirect('/resources');
    }
}
