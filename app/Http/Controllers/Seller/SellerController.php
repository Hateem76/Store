<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Project;
use App\Models\Tender;
use App\Models\User;
use App\Models\TenderResponse;
use App\Models\PrivateTenderUserRelator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SellerController extends Controller
{
    public function index(){
        $userId = Auth::user()->id;
        if(Gate::allows('child-seller')){
            $userId = Auth::user()->parent_id;
        }
        $users = User::where('parent_id',$userId)->get();
        $users = $users->count();
        $products = Product::where('user_id',$userId)->get();
        $products = $products->count();
        $deals = Project::where('seller_id',$userId)->get();
        $deals = $deals->count();
        $contacts = Contact::where('me',$userId)->get();
        $contacts = $contacts->count();
            // All tenders for me.
        $userIdsToExclude = TenderResponse::where('user_id',$userId)->pluck('user_id')->toArray(); 
            // Tenders to which I already have responded. 
        $tenderIdsToExclude = TenderResponse::where('user_id',$userId)->pluck('tender_id')->toArray(); 
            // Public Tenders available to me.
        $publicTenders = Tender::where('public_private',1)->whereNotIn('id',$tenderIdsToExclude)->get(); 
            // Reference of all Private Tenders available to me.
        $privateTendersReference = PrivateTenderUserRelator::where('user_id',$userId)->whereNotIn('tender_id',$tenderIdsToExclude)->pluck('tender_id')->toArray();  // All private tenders available to him
        // dd($privateTendersReference);
            // Now Fetch Records of the above private tenders form main Table.
        $privateTenders = Tender::where(function($q) {
                $q->where('public_private', 0)
                ->orWhere('public_private', null);
                })->whereIn('id',$privateTendersReference)->get();
        
        $new_tenders = $publicTenders->merge($privateTenders);
        $new_tenders = $new_tenders->count();
        $confirmations = TenderResponse::where('user_id',$userId)->with('product')->with('tender')->get();
        $confirmations = $confirmations->count();

        
        return view('Seller.index',[
            'products' => $products,
            'users' => $users,
            'contacts' => $contacts,
            'tenders' => $new_tenders,
            'confirmations' => $confirmations,
            'deals'  => $deals
        ]);
    }
}
