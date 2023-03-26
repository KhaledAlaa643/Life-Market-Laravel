<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryManage extends Controller
{
    public function updateCategory(Request $request){
        $file = $request->file('photo');
        $filename  = time().'.'.$file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $request->photo->move(public_path('storage/images/categories'), $filename);

        $request->validate([
            'name' => 'required | string ',
            'description' => 'required | string',
        ]);

         DB::table('categories')->where('id', $request->id)->update([
            'name'=>$request->name,
            'photo'=>$filename,
            'description'=>$request->description,
        ]);


    }
    public function DeleteCategory(Request $request){
        DB::table('categories')->where('id', '=', $request->id)->delete();

    }

    public function createCategory(Request $request)
    {
        $file = $request->file('photo');
        $filename  = time().'.'.$file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $request->photo->move(public_path('storage/images/categories'), $filename);

        $request->validate([
            'name' => 'required | string | unique:categories,name',
            'description' => 'required | string',


        ]);
        $cat = Categories::create([
            'name' => $request->name,
            'description' => $request->description,
            'photo' =>$filename,
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
