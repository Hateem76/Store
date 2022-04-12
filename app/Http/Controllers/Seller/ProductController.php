<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStockRequest;
use Illuminate\Http\Request;
use App\Http\Requests\SearchProductRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        if(Gate::allows('child-seller')){
            $userId = Auth::user()->parent_id;
        }
        $serialNo = 1;
        $products = Product::where('user_id',$userId)->with('category')->get();
       
        return view('Seller.products.index',[
            'products' => $products,
            'serialNo' => $serialNo
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Seller.products.create',[
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $userId = Auth::user()->id;
        if(Gate::allows('child-seller')){
            $userId = Auth::user()->parent_id;
        }
        // Validation using form request
        $dataValidated = $request->validated();
       
        $image_name = 'not_found.jpg';
        if($request->hasFile('image_path')){ 
            $image_name = time(). '-' . $request->name . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('images/products'),$image_name);
        }
        try{
            $product = Product::create([
                'name' => $request->input('name'),
                'category_id' => $request->input('category'),
                'brand_name' => $request->input('brand_name'),
                'stock' => $request->input('quantity'),
                'unit' => $request->input('unit'),
                'image_path' => $image_name,
                'description' => $request->input('description'),
                'currency'   => $request->input('currency'),
                'rent_day' => $request->input('rent_day'),
                'rent_week' => $request->input('rent_week'),
                'rent_month' => $request->input('rent_month'),
                'user_id'   => $userId,
    
            ]);
        }
        catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger','Product did not create.');
            return redirect(route('seller.products.index'));
        }
        $request->session()->flash('success','You have Created the Prodcut');
        return redirect(route('seller.products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $units = [
            "No.",'gram','kg','mm','cm','m3','m2','feet','inch','height','width','ton'
        ];
        return view('Seller.products.edit',[
            'units'   => $units,
            'product'  => Product::find($id),
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductStoreRequest $request, $id)
    {
        $userId = Auth::user()->id;
        if(Gate::allows('child-seller')){
            $userId = Auth::user()->parent_id;
        }
        $product = Product::find($id);          // to get old image_path
        $dataValidated = $request->validated();
        $image_name = $product->image_path;     // if there is already img of product. So dont change that
        if($request->hasFile('image_path')){ 
            
            $image_name = time(). '-' . $request->name . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('images/products'),$image_name);
             
        }
        try{
            $product = Product::where('id',$id)->where('user_id',$userId)
            ->update([
                'name' => $request->input('name'),
                'category_id' => $request->input('category'),
                'brand_name' => $request->input('brand_name'),
                'stock' => $request->input('quantity'),
                'unit' => $request->input('unit'),
                'image_path' => $image_name,
                'description' => $request->input('description'),
                'currency'  => $request->input('currency'),
                'rent_day' => $request->input('rent_day'),
                'rent_week' => $request->input('rent_week'),
                'rent_month' => $request->input('rent_month'),
            ]);
        }
        catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger','Product did not update.');
            return redirect(route('seller.products.index'));
        }
        $request->session()->flash('success','You have Edited the Prodcut');
        return redirect(route('seller.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        try{
            Product::destroy($id);
        }
        catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger','Product did not Delete.');
            return redirect(route('seller.products.index'));
        }
        $request->session()->flash('success','You have Deleted the Prodcut');
        return redirect(route('seller.products.index'));
    }
    public function stockInForm()
    {
        $userId = Auth::user()->id;
        if(Gate::allows('child-seller')){
            $userId = Auth::user()->parent_id;
        }
        $products = Product::where('user_id',$userId)->get();
        return view('Seller.products.stock-in',[
            'products' => $products
        ]);
    }
    public function stockOutForm()
    {
        $userId = Auth::user()->id;
        if(Gate::allows('child-seller')){
            $userId = Auth::user()->parent_id;
        }
        $products = Product::where('user_id',$userId)->get(); 
        return view('Seller.products.stock-out',[
            'products' => $products
        ]);
    }

    public function stockIn(ProductStockRequest $request)
    {
       $dataValidated = $request->validated(); 
       $userId = Auth::user()->id;
       if(Gate::allows('child-seller')){
           $userId = Auth::user()->parent_id;
       }
       try{
           $stockIn = Product::where('id',$request->input('name'))->increment('stock',$request->input('quantity'));
       }
       catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger','Stock Did not Add.');
            return redirect(route('seller.stockInForm'));
        } 
        $request->session()->flash('success','Stock Added Successfully.');
        return redirect(route('seller.stockInForm'));
        
    }

    public function stockOut(ProductStockRequest $request)
    {
        $dataValidated = $request->validated();
        $userId = Auth::user()->id;
       if(Gate::allows('child-seller')){
           $userId = Auth::user()->parent_id;
       }
       try{
           $product = Product::where('id',$request->input('name'))->first();
           if($product->stock - $request->input('quantity') >= 0){ // if stock greater or equal to 0
                $stockOut = Product::where('id',$request->input('name'))->decrement('stock',$request->input('quantity'));
           }
           else{
                $request->session()->flash('danger','Stock is Getting Negative. Cannot Remove');
                return redirect(route('seller.stockOutForm'));
           }
       }
       catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger','Stock Did not Remove.');
            return redirect(route('seller.stockOutForm'));
        } 
        $request->session()->flash('success','Stock Removed Successfully.');
        return redirect(route('seller.stockOutForm'));
    }

}
