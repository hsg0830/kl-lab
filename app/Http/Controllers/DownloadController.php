<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\User;
use App\Resource;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
      if(\Auth::check())
      {
        $disk = Storage::disk('s3');

        //ファイル名を取得
        $id = $request->id;
        $file = Resource::find($id);
        $file_name = $file->name_of_file;

        //当該ファイルのPathを取得
        //$path = $disk->url($file_name);

        $mimeType = $disk->mimeType($file_name);

        $headers = [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'attachment; filename="' . $file_name . '"'
        ];

        return \Response::make($disk->get($file_name), 200, $headers);

      }
      else
      {
        return back();
      }
    }
}
