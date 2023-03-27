<?php

namespace App\Http\Controllers;

use App\Models\product_photos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
 public function  getGalleryById(Request $request){

    $gallery=   DB::table('product_photos')->where('prd_id',$request->id)->get();
  if(count($gallery)==0){
    return response()->json(['message'=>'This product has no images yet .']);
  }
  return $gallery;
}
public function createGallery(Request $request){
   $file      = $request->file('photo');
    $filename  = time().'.'.$file->getClientOriginalName();
    $extension = $file->getClientOriginalExtension();
    $request->photo->move(public_path('storage/images/gallery'), $filename);


  $gallery=  product_photos::create([
        'path'=>$filename,
        'prd_id'=>$request->prd_id,
        'created_at'=>now(),
        ]);
        return $gallery;
}

public function deleteGallery(Request $request){
Db::table('product_photos')->where('id','=',$request->id)->delete();
}
}
