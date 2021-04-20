<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->model = new Product();
    }

    public function index(){
        $product = $this->model::all();
        return response()->json($product);
    }

    public function show($id){
        $product = $this->model::find($id);
        if(empty($product)){
            return response()->json('Error: Tidak Ada Data');    
        } else {
            return response()->json($product);
        }
    }

    public function create(Request $request){
        $this->model->name = $request->name;
        $this->model->price = $request->price;
        $this->model->category = $request->category;

        $this->model->save();

        return response()->json('Produk telah diinsert');
    }

    public function update(Request $request, $id){
        $product = $this->model::find($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->category = $request->category;

        $product->save();

        return response()->json('Produk telah diupdate');
    }

    public function delete($id){
        $product = $this->model::find($id);
        $product->delete();

        return response()->json('Produk telah dihapus');   
    }
}
