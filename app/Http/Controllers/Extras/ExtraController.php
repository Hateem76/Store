<?php

namespace App\Http\Controllers\Extras;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;

class ExtraController extends Controller
{
    public function login(){
        if(Auth::check()){
            if(Auth::user()->account_type == 'seller'){
                return redirect(route('seller.index'));
            }
            else if(Auth::user()->account_type == 'buyer'){
                return redirect(route('buyer.index'));
            }
            else if(Auth::user()->account_type == 'admin'){
                return redirect(route('admin.index'));
            }
        }
        else{
            return redirect(route('index'));
        }
    }

    public function searchProducts(SearchProductRequest $request){
        $dataValidated = $request->validated();
        $check = 'Seller.layouts.app';
        $name = $request->input("search");
        if($request->input('option') == 'product'){
            $products = Product::where('name', 'like', '%' . $name . '%')->with('category')->with('user')->get();
            return view('mix-views.search-products',[
                'products'  => $products,
                'name'      => $name,
                'check'    => $check
            ]);
        }
        else if($request->input('option') == 'vendor'){
            $vendors = User::where('name', 'like', '%' . $name . '%')->get();
            return view('mix-views.vendor-searchList',[
                'vendors'  => $vendors,
                'check'    => $check,
                'name'     => $name
            ]);
        }
        else if($request->input('option') == 'bizzId'){
            $string = $request->input('search');
            $int = (int) filter_var($string, FILTER_SANITIZE_NUMBER_INT);
            $vendors = User::where('id', $int)->get();
            return view('mix-views.vendor-searchList',[
                'vendors'  => $vendors,
                'check'    => $check,
                'name'     => $name
            ]);
        }
        else if($request->input('option') == 'vendor'){
            $vendors = User::where('name', 'like', '%' . $name . '%')->get();
            return view('mix-views.vendor-searchList',[
                'vendors'  => $vendors,
                'check'    => $check
            ]);
        }
    }

    public function searchVendors(SearchProductRequest $request){    // Return Names of All Vendors
        $check = 'Seller.layouts.app';
        $dataValidated = $request->validated();
        $name = $request->input("search");

        
    }

    public function vendorProfile($id){    // Return Names of All Vendors
        $user = User::where('id',$id)->with('products')->first();
        $projects = Project::where('seller_id',$user->id)->orWhere('buyer_id',$user->id)->get();
        if($user->parent_child == 0){
            $user = User::where('parent_id',$user->parent_id)->with('products')->first();
            $projects = Project::where('seller_id',$user->id)->orWhere('buyer_id',$user->id)->get();
        }

        $sidebar = 'Seller.layouts.sidebar2';
        $header  = 'Seller.layouts.header';
        $logoutCode = 'Seller.layouts.logout-code';
        $check = 'Seller.layouts.app';
            
        return view('mix-views.public-profile',[
            'sidebar'  => $sidebar,
            'header'   => $header,
            'logoutCode' => $logoutCode,
            'user'     => $user,
            'projects'  => $projects
        ]);
        return redirect()->back();
    }

    public function viewProduct($id){
        if(Product::where('id',$id)->exists()){ 
            $product = Product::where('id',$id)->with('category')->get();
            
        }
    }


    public function downloadLetter(Request $request){
        $file_name = $request->input('letter');
        
        $myFile = public_path("confirmation-letters/".$file_name);
        $headers = ['Content-Type: application/file'];
        $path = public_path('confirmation-letters/'.$file_name);
        $isExists =   File::exists($path);
        if($isExists == false){
            $request->session()->flash('danger','File Not Found');
            return redirect(route('seller.confirmationIndex'));
        }
        else{
            return response()->download($myFile, $file_name, $headers);
        }
        return redirect(route('seller.confirmationIndex'));
    }

    public function downloadQuotation(Request $request){
        $file_name = $request->input('quotation');
        $myFile = public_path("quotations/".$file_name);
        $headers = ['Content-Type: application/file'];
        $path = public_path('quotations/'.$file_name);
        $isExists =   File::exists($path);
        if($isExists == false){
            $request->session()->flash('danger','File Not Found');
            return redirect(route('buyer.tenders.index'));
        }
        else{
            return response()->download($myFile, $file_name, $headers);
        }
        return redirect(route('buyer.tenders.index'));
    }

    public function downloadTenderFile(Request $request){
        $file_name = $request->input('tender_file');
        $myFile = public_path("tender-files/".$file_name);
        $headers = ['Content-Type: application/file'];
        $path = public_path('tender-files/'.$file_name);
        $isExists =   File::exists($path);
        if($isExists == false){
            $request->session()->flash('danger','File Not Found');
            return redirect()->back();
        }
        else{
            return response()->download($myFile, $file_name, $headers);
        }
        return redirect()->back();
    }

    public function showCatProducts($id){
        if(Category::where('id',$id)->exists()){
            $products = Product::where('category_id',$id)->get();
            return view('mix-views.without-login-products',[
                'products' => $products,
                'name'     => Category::where('id',$id)->value('name'),
            ]);
        }
        return redirect(route('index'));
    }


    
}
