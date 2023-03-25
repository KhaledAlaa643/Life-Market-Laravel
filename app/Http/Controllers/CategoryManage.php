<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryManage extends Controller
{
    public function updateCategory(Request $request){

        $request->validate([
            'name' => 'required | string | unique:categories,name',
            'description' => 'required | string',


        ]);
        DB::table('categories')->where('id', $request->id)
        ->update([
            'name'=>$request->name,
            'photo'=>$request->photo,
            'description'=>$request->description,
            'updated_at' => now()
        ]);
        $UpdatedCategory =DB::table('categories')->where('id', $request->id)->first();

     return $UpdatedCategory;

        }
        public function DeleteCategory(Request $request){
            DB::table('categories')->where('id', '=', $request->id)->delete();

           }

           public function createCategory(Request $request)
    {
        $request->validate([
            'name' => 'required | string | unique:categories,name',
            'description' => 'required | string',
            'photo' => 'required | string',

        ]);
        $cat = Categories::create([
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $request->photo,
        ]);
        return $cat;

    }
    public function getCategories(){
        return   DB::table('categories')->get();
    }

    public function getCategoryById(Request $request){
        return DB::table('categories')->where('id', '=', $request->id)->first();
           }
}
