<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Extra;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index(){
        $users = User::all();
        $users = $users->count();
        $categories = Category::all();
        $categories = $categories->count();
        return view('Admin.dashboard',[
            'users'  =>  $users,
            'categories' => $categories,
        ]);
    }

    public function setCategoryView(){
        $catIds = Category::all()->pluck('id');
        return view('Admin.categories.landing_pg',[
            'catIds'  => $catIds
        ]);
    }

    public function setProductView(){
        $proIds = Product::all()->pluck('id');
        return view('Admin.products.landing_pg_products',[
            'proIds'  => $proIds
        ]);
    }

    public function setCategory(Request $request){
        $position = $request->input('position');
        Extra::where('id',1)->update([
            $position => $request->input('category')
        ]);
        $request->session()->flash('success','Done!');
        return redirect(route('admin.setCategoryView'));
    }

    public function setProduct(Request $request){
        $position = $request->input('position');
        Extra::where('id',1)->update([
            $position => $request->input('product')
        ]);
        $request->session()->flash('success','Done!');
        return redirect(route('admin.setProductView'));
    }
}
