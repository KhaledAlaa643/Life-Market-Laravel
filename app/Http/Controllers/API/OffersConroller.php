<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offers;
use App\Models\OfferProducts;
use App\Models\Products;

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
        $request->validate([
            'photo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->photo->extension()    ;
        $request->photo->move(public_path('storage/images'), $imageName);

        $record->photo=$imageName;
        // $record->created_at=now();

        $record->save();
        // $record =new Offers();
        // $record->offer_title=$request->offer_title;
        // $record->type=$request->type;
        // $record->discont_percent=$request->discont_percent;
        // $record->photo=$request->photo;
        // $record->created_at=now();

        // $record->save();
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
        $offer=Offers::find($id);
        $offer->offer_title=$request->offer_title;
        $offer->discont_percent=$request->discont_percent;
        $offer->type=$request->type;


        $offer->save();
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $offer=Offers::find($id);

        $arr[]=[];
        $i=0;
        //get ids of offer products 
        $offer_products_id=OfferProducts::where('offer_id',$id)->get("prd_id");

        if ($offer_products_id)
        {
           foreach($offer_products_id as $prd)                             //get all products that have the same product offer
           {
            $product=Products::where('id',$prd["prd_id"])->get();
            if (count ($product)!=0)
                 { $arr[$i]= $product[0];
                    $i++;
                 }

           }
        }
        // ////////////////////////////////////////////////////////////////////////////
            if ($arr[0]!=[])
            {
            foreach ($arr as $pro)
            {
            echo $pro;
            $pro["price"]=$pro["price_before_discount"];
            $pro["price_before_discount"]=0;
            
            }
            
            foreach ($arr as $pro)
            {
                $pro->save();

            }
          }

          $offer->delete();

    }

    public function get_offer_by_id (string $id)
    {
        $offer=Offers::find($id);
        return $offer;

    }
}
