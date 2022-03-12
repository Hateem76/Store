<?php

namespace App\Http\Controllers\Extras;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchProductRequest;
use App\Models\Product;
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
            $vendors = User::where('name', 'like', '%' . $name . '%')->paginate(2);
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
        $vendors = User::where('name', 'like', '%' . $name . '%')->paginate(2);
        return view('mix-views.vendor-searchList',[
            'vendors'  => $vendors,
            'check'    => $check
        ]);
    }

    public function vendorProfile($id){    // Return Names of All Vendors
        $check = 'Seller.layouts.app';
        if(User::where('id',$id)->exists()){ 
            $vendor = User::find($id);
            $products = Product::with('category')->get();
            return view('mix-views.public-profile',[
                'vendor'   => $vendor,
                'products' => $products,
                'check'    => $check
            ]);
        }
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


    
}
