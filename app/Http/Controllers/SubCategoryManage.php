<?php

namespace App\Http\Controllers;

use App\Models\SubCategories;
use Doctrine\DBAL\Schema\ForeignKeyConstraint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryManage extends Controller
{
    public function createSubCategory(Request $request)
    {
        $request->validate([
            'name' => 'required | string | unique:sub_categories,name',
            'description' => 'required | string',
            'cat_id' => 'required | int',

        ]);
        $sub_cat = SubCategories::create([
            'name' => $request->name,
            'description' => $request->description,
            'cat_id' => $request->cat_id,
            'created_at' => now()
        ]);
        return $sub_cat;

    }

   public function DeleteSubCategory(Request $request){
 DB::table('sub_categories')->where('id', '=', $request->id)->delete();
   }


   public function getSubCategories(){

   return   DB::table('sub_categories')->get();
   
   }

   public function updateSubCategory(Request $request){

    $request->validate([
        'name' => 'required | string | unique:categories,name',
        'description' => 'required | string',
        'cat_id' => 'required',

    ]);
    DB::table('sub_categories')->where('id', $request->id)
    ->update([
        'name'=>$request->name,
        'cat_id'=>$request->cat_id,
        'description'=>$request->description ,
        'updated_at' => now()
    ]);
    $UpdatedSubCategory =DB::table('sub_categories')->where('id', $request->id)->first();

 return $UpdatedSubCategory;

    }
    public function getSubCategoryById(Request $request){
        return DB::table('sub_categories')->where('id', '=', $request->id)->first();
           }
}
