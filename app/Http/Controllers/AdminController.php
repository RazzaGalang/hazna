<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\AdminModel;

class AdminController extends Controller
{
    public function tampildata(){
        $product = DB::table('product')->get();

        return view('dashboard', ['product' => $product]);
    }

    public function destroy($product_id){
        $delete = AdminModel::find($product_id);
        $delete->delete();

        return redirect()->back()->with('berhasilhapus', 'Product Deleted');
    }

    public function store (Request $request){
        $request->validate([
            'add_product_name' => 'required',
            'add_description' => 'required',
            'add_price' => 'required',
            'add_image' => 'required'
        ]);

        $file_name = $request->add_image->getClientOriginalName();
        $image = $request->add_image->storeAs('images', $file_name);

        DB::table('product')->insert([
            'product_name'  => $request->add_product_name,
            'description'   => $request->add_description,
            'price'         => $request->add_price,
            'image'         => $image
        ]);

        return redirect()->back()->with('berhasiltambah', 'Product Added');
    }

    public function edit($product_id, Request $request){
        $request->validate([
            'add_product_name' => 'required',
            'add_description' => 'required',
            'add_price' => 'required',
        ]);


        $edit = AdminModel::find($product_id);
        $edit->product_name = $request->input('add_product_name');
        $edit->description  = $request->input('add_description');
        $edit->price        = $request->input('add_price');
        $edit->save();

        return redirect()->back()->with('berhasiledit', 'Product Edited');
    }
}
