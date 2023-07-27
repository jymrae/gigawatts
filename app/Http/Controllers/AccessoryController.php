<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accessory;


class AccessoryController extends Controller
{
    public function index() 
    {
        $accessory = Accessory::query()
            ->select('product_id', 'brand', 'description','price', 'stock')
            ->limit(10)
            ->orderBy('product_id', 'DESC')
            ->get();
        return view('accessory', compact('accessory'));
    }
    public function restock(Request $request, string $id)
    {
        $p = Accessory::query()
            ->select('stock', 'brand')
            ->where('product_id', '=', $id)
            ->get()
            ->first();
        $new_stock = $p->stock +  $request->input('stock_change');
        Accessory::where('product_id', '=', $id)
            ->update(
                [
                    'stock' => $new_stock
                ]
            );

        return redirect('/admin/accessory')->with('success', 'Added ' . $request->input('stock_change') . " to " . $p->brand);
    }
  
    public function create()
    {
        return view('accessory_create');
    }

   
    public function store(Request $request)
    {
        $p = new Accessory;
        $p->brand = $request->input("brand");
        $p->description = $request->input("description");
        $p->price = $request->input("price");
        $p->stock = $request->input("stock");
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHiu') . $file->getClientOriginalName();
            $file->move(public_path('img/food'), $filename);
            $p->image = $filename;
        }
        $p->save();
        return redirect("/admin/accessory");
    }

    public function show(string $id)
    {
        
    }

   
    public function edit(string $id)
    {
        
    }

    
    public function update(Request $request, string $id)
    {
        
    }

 
    public function destroy(string $id)
    {
        
    }
   
     
    }