<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offers;

class OffersConroller extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_offers=Offers::all();
        return $all_offers;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $record =new Offers();
        $record->offer_title=$request->offer_title;
        $record->type=$request->type;
        $record->discont_percent=$request->discont_percent;
        $record->photo=$request->photo;
        $record->created_at=now();

        $record->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $offer=Offers::where('type',$id)->get();
        return $offer;
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
