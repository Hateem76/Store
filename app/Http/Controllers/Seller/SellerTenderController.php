<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenderResponseRequest;
use App\Models\ChFavorite;
use Illuminate\Http\Request;
use App\Models\Tender;
use App\Models\PrivateTenderUserRelator;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\TenderResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Project;

class SellerTenderController extends Controller
{
    public function index(){
        $userId = Auth::user()->id;
        if(Gate::allows('child-seller')){
            $userId = Auth::user()->parent_id;
        }
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
        
        $tenders = $publicTenders->merge($privateTenders);
        $serialNo = 1;
        $products = Product::where('user_id',$userId)->get();
        return view('Seller.tender.index',[
            'tenders'  => $tenders,
            'serialNo'  => $serialNo,
            'products'  => $products
        ]);
        
    }
    public function sendResponse(TenderResponseRequest $request){
        $dataValidated = $request->validated();
        $userId = Auth::user()->id;
        if(Gate::allows('child-seller')){
            $userId = Auth::user()->parent_id;
        }
        // Check if Response Already Exists
        if(TenderResponse::where('user_id',$userId)->where('tender_id',$request->input('tender_id'))->exists()){
            $request->session()->flash('danger','Response already exists.');
            return redirect(route('seller.tenders'));
        }
        
        // Check if You Have enough Stock of Product to be rented.
        $stock = Tender::where('id',$request->input('tender_id'))->first();
        $quantity = $stock->quantity; // Quantity Demanded of Product
        $product = Product::where('id',$request->input('name'))->first();
        if($product->stock - $quantity < 0){ // if stock less than 0
            $request->session()->flash('danger','You dont have enough Stock of Product.');
            return redirect(route('seller.tenders'));
        }
        try{ // everything OK, now finish it.
            $file_name = null;
            if($request->hasFile('quotation') && $request->input('link') == null){ 
                $file_name = time(). '-' . $request->input('tender_id') . $userId. '.' . $request->quotation->extension();
                $request->quotation->move(public_path('quotations'),$file_name);
            }
            $tenderResponse = TenderResponse::create([
                'tender_id'  => $request->input('tender_id'),
                'user_id'    => $userId,
                'product_id' => $request->input('name'),
                'quotation'  => $file_name,
                'attachments_link' => $request->input('link'),
                'price'      => $request->input('price'),
                'description' => $request->input('description'),
            ]);
        }

        catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger','Response Did not Submit.');
            return redirect(route('seller.tenders'));
        }
        $request->session()->flash('success','Response Submitted Successfully. Now Buyer decides further.');
        return redirect(route('seller.tenders'));  
        
    }

//--------------------------------Confirmation Methods-----------------------------------------

    public function confirmationIndex(){
        $userId = Auth::user()->id;
        if(Gate::allows('child-seller')){
            $userId = Auth::user()->parent_id;
        }
        $serialNo = 1;
        $tenders = TenderResponse::where('user_id',$userId)->where('deleted',0)->with('product')->with('tender')->get();
        // dd($tenders);
        return view('Seller.tender.confirmation-index',[
            'responses'  => $tenders,
            'serialNo' => $serialNo
        ]);
    }

    public function changePrice(Request $request){
        $dataValidated = $request->validate([
            'price' => 'required',
        ]);
        $userId = Auth::user()->id;
        if(Gate::allows('child-seller')){
            $userId = Auth::user()->parent_id;
        }
        if(TenderResponse::where('user_id',$userId)->where('id',$request->input('id'))->exists()){
            TenderResponse::where('user_id',$userId)->where('id',$request->input('id'))->update([
                'price'  => $request->input('price')
            ]);
            $request->session()->flash('success','Price Changed.');
            return redirect(route('seller.confirmationIndex'));
        }
        else{
            $request->session()->flash('danger','Response Does not exist.');
            return redirect(route('seller.confirmationIndex'));
        }
    }

    public function confirmProject(Request $request){
        // if checkbox checked => Create with different dates. else different dates
        $date_from = "";
        $date_to = "";
        if($request->input('checkbox') == 'on'){ //if checkbox checked => Validate dates
            $request->validate([                      
                'start_date2' => 'required',
                'end_date2' => 'required',
            ]);
            $start_date = $request->input('start_date2'); // changed Dates
            $end_date = $request->input('end_date2');

        }   // if checkbox is not checked
        else{ 
            $start_date = $request->input('start_date1');  // unchanged Dates.
            $end_date = $request->input('end_date1');  
        }
        $id = $request->input('tender_id');
        $userId = Auth::user()->id;
        if(Gate::allows('child-seller')){
            $userId = Auth::user()->parent_id;
        }
        // Check if Seller's response exists and letter_pdf and confirmation is set to 1
        if(TenderResponse::where('user_id',$userId)->where('tender_id',$id)->where('confirmation_letter',1)->exists()){
            // He has rights for it
            try{
                $tender = Tender::find($id); // The linked Tender
                $project = Project::create([
                    'tender_id' => $id,
                    'user_id'   => $userId,  // Buyer's Id.
                    'buyer'     => $tender->user_id,
                    'date_from' => $start_date,
                    'date_to'   => $end_date,
                ]);
            }
            catch(\Illuminate\Database\QueryException $e){
                $request->session()->flash('danger','Project Did not Confirm.');
                return redirect(route('seller.confirmationIndex'));
            }
            $request->session()->flash('success','Project Confirmed.');
            return redirect(route('seller.confirmationIndex'));
        }
        else{   // Illegal Confirmation
            $request->session()->flash('danger','Could not confirm your Project.');
            return redirect(route('seller.confirmationIndex'));  
        }
        
    }



//--------------------------------Projects Methods-----------------------------------------

        public function projects(){
            // $current_date = Date('Y-m-d');
            // $projects = Project::all();    // If any Project have reached its Finished Date,
            // foreach($projects as $project){ // then change its status to finished => 1.
            //     if($project->date_to == $current_date && $project->status == 0){
            //         $project->status = 1;
            //         $project->save();
            //     }
            // }
            
            $userId = Auth::user()->id;
            if(Gate::allows('child-seller')){
                $userId = Auth::user()->parent_id;
            }
            $serialNo = 1;
            $projects = Project::where('seller_id',$userId)->with('buyer')->with('seller')->get();
            return view('Seller.tender.projects',[
                'projects' => $projects,
                'serialNo' => $serialNo
            ]);
        }




}
