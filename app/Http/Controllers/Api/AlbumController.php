<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use File;
use App\Models\Album;
use Carbon\Carbon;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
       $lop_id = $request->lop_id;
       $data = [];
       $album = Album::where('lop_id', $lop_id);
       if(isset($request->start_date) 
          && $request->start_date != null
          && isset($request->end_date) 
          && $request->end_date != null
          ){
          $album->whereDate('created_at', ">=", $request->start_date)
                ->whereDate('created_at', "<=", $request->end_date);
       }
       $album = $album->get();
       $dir = config('common.DB_HOST_STORAGE') . '/albums/lop_' . $lop_id .'/';
       foreach($album as $item){
            $array_images = [];
            foreach(json_decode($item->item_images) as $image){
                    array_push($array_images, $dir .'album_' . $item->id  .'/' . $image);
            }
            $param = (object) [
                'id' => $item->id,
                'item_images' => $array_images,
                'auth_id' => $item->auth_id,
                'lop_id' => $item->lop_id,
                'title' => $item->title,
                'created_at' => Carbon::parse($item->created_at)->format('d/m/Y')
            ];
            array_push($data, $param);
       }
       return response()->json($data, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $album = Album::create([
            'title' => $request->title,
            'item_images' => $request->item_images,
            'auth_id' => $request->auth_id,
            'lop_id' => $request->lop_id
        ]);

        $dir = public_path() . '/albums/lop_' . $album->lop_id .'/';
        if ( !is_dir( $dir ) ) {
            mkdir( $dir );  
        }
        $dir_album = $dir .'/album_' . $album->id  .'/';
        if ( !is_dir( $dir_album ) ) {
            mkdir( $dir_album );  
        }
        $array_item_images = json_decode($album->item_images);
        foreach($array_item_images as $image){
            File::move(public_path() . '/albums/item_images/' . $image,
                       $dir_album . $image);
        }
    }

    public function fileUpload(Request $request)
    {
        $_IMAGE = $request->file('file');
        $filename = time().$_IMAGE->getClientOriginalName();
        $uploadPath = 'albums/item_images/';
        $_IMAGE->move($uploadPath,$filename);
        return response()->json($filename, Response::HTTP_OK);
    }

    public function removeUpload(Request $request)
    {   
        $image = str_replace('"', '', $request->file);
        $path = public_path() . '/albums/item_images/' . $image;
        if(File::exists($path)){
            unlink($path);
        }
        return response()->json($image, Response::HTTP_OK);
    }

    public function show($id)
    {
        $data = Album::find($id);
        if(!$data){
            return response()->json([], Response::HTTP_OK);
        }
        return response()->json($data, Response::HTTP_OK);
    }
}