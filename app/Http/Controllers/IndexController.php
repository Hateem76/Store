<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Extra;
use App\Models\Product;

class IndexController extends Controller
{
    public function index(){
        $data = Extra::find(1)->toArray();
        $cat1 = Category::where('id',$data['cat1'])->first();
        $cat2 = Category::where('id',$data['cat2'])->first();
        $cat3 = Category::where('id',$data['cat3'])->first();
        $cat4 = Category::where('id',$data['cat4'])->first();
        $cat5 = Category::where('id',$data['cat5'])->first();
        $cat6 = Category::where('id',$data['cat6'])->first();
        $pro1 = Product::where('id',$data['pro1'])->first();
        $pro2 = Product::where('id',$data['pro2'])->first();
        $pro3 = Product::where('id',$data['pro3'])->first();
        $pro4 = Product::where('id',$data['pro4'])->first();
        $pro5 = Product::where('id',$data['pro5'])->first();
        $pro6 = Product::where('id',$data['pro6'])->first();
        $pro7 = Product::where('id',$data['pro7'])->first();
        $pro8 = Product::where('id',$data['pro8'])->first();
        return view('index',[
            'cat1' => $cat1,
            'cat2' => $cat2,
            'cat3' => $cat3,
            'cat4' => $cat4,
            'cat5' => $cat5,
            'cat6' => $cat6,
            'pro1' => $pro1,
            'pro2' => $pro2,
            'pro3' => $pro3,
            'pro4' => $pro4,
            'pro5' => $pro5,
            'pro6' => $pro6,
            'pro7' => $pro7,
            'pro8' => $pro8,
        ]);
    }
}
