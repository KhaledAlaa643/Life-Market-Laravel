<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact_Us;


class ContactUsConroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts=Contact_Us::all();
        return $contacts;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $record =new Contact_Us();
        $record->user_name=$request->user_name;
        $record->email=$request->email;
        $record->comment=$request->comment;
        $record->created_at=now();

        $record->save();


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
