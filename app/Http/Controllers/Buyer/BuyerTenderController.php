<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmationLetterRequest;
use App\Http\Requests\StoreTenderRequest;
use Illuminate\Http\Request;
use App\Models\Tender;
use App\Models\TenderResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Project;
use App\Models\Contact;
use App\Models\PrivateTenderUserRelator;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BuyerTenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $date = Date();
        
        $userId = Auth::user()->id;
        if(Gate::allows('child-buyer')){
            $userId = Auth::user()->parent_id;
        }
        $serialNo = 1;
        $projects = Project::pluck('tender_id')->all();
        $tenders = Tender::where('user_id',$userId)->whereNotIn('id',$projects)->with('tender_responses')->get();
        // dd($tenders);
        return view('Buyer.tender.index',[
            'tenders'   => $tenders,
            'serialNo'  => $serialNo
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Buyer.tender.create',[
            'speacial'  => 'no'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->input('speacial') == 'yes'){
            $request->validate([
                'name' => 'required|max:30',
                'opening_date' => 'required',
                'closing_date' => 'required',
                'quantity' => 'required|integer|max:10000',
                'description' => 'max:290',
                'unit'     => 'max:15',
                'tender_file' => 'max:150|mimes:pdf,txt,docx',
                'location'  => 'max:18',
                'currency'  => 'max:9',
            ]);
            $public_private = null;
        }
        else{
            $request->validate([
                'name' => 'required|max:30',
                'opening_date' => 'required',
                'closing_date' => 'required',
                'quantity' => 'required|integer|max:10000',
                'description' => 'max:290',
                'unit'     => 'max:15',
                'public_private' => 'required',
                'tender_file' => 'max:150|mimes:pdf,txt,docx',
                'location'  => 'max:18',
                'currency'  => 'max:9',
            ]);
            $public_private = $request->input('public_private');
        }
        $userId = Auth::user()->id;
        if(Gate::allows('child-buyer')){
            $userId = Auth::user()->parent_id;
        }
        $file_name = 'not_found.pdf';
            if($request->hasFile('tender_file')){ 
                $file_name = time(). '-' . $request->input('tender_id') . $userId. '.' . $request->tender_file->extension();
                $request->tender_file->move(public_path('tender-files'),$file_name);
            }
        // dump($friends);
        try{
            $tender = Tender::create([
                'user_id' => $userId,
                'name' => $request->input('name'),
                'opening_date' => $request->input('opening_date'),
                'closing_date' => $request->input('closing_date'),
                'description' => $request->input('description'),
                'location'  => $request->input('location'),
                'currency'  => $request->input('currency'),
                'unit'       => $request->input('unit'),
                'public_private' => $public_private,
                'quantity' => $request->input('quantity'),
                'tender_file' => $file_name,
                'confirmation_letter' => 0
    
            ]);
                // if Speacial Tender for specific seller
            if($request->input('speacial') == 'yes'){// only show to That Specific Seller
                $relator = PrivateTenderUserRelator::create([
                    'user_id'   => $request->input('seller'),
                    'tender_id'  => $tender->id
                ]);    
            }
            elseif($request->input('public_private') == 0){ // means private tender
                $friends = Contact::where('me',$userId)->get();  // my all friends
                foreach($friends as $friend){
                    $relator = PrivateTenderUserRelator::create([
                        'user_id'   => $friend->user_id,
                        'tender_id'  => $tender->id
                    ]);
                }
            }
            
        }
        catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger','Tender not Posted.');
            return redirect(route('buyer.tenders.index'));
        }
        $request->session()->flash('success','Tender Posted Successfully');
        return redirect(route('buyer.tenders.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = Auth::user()->id;
        if(Gate::allows('child-buyer')){
            $userId = Auth::user()->parent_id;
        }
        if(Tender::where("user_id",$userId)->where('id',$id)->exists()){
            $tender = Tender::where('id',$id)->with("tender_responses")->first();
            return view('Buyer.tender.show',[
                'tender' => $tender
            ]);
        }
        else{
            return redirect()->back();
        }
    }

    public function submitRemarks(Request $request){
        
        $userId = Auth::user()->id;
        if(Gate::allows('child-buyer')){
            $userId = Auth::user()->parent_id;
        }
        if(Tender::where("user_id",$userId)->where('id',$request->input('id'))->exists()){
            TenderResponse::where('id',$request->input('response_id'))->where('tender_id',$request->input('id'))->update([
                'buyer_remarks' => $request->input('buyer_remarks')
            ]);
            $tender = Tender::where('id',$request->input('id'))->with('tender_responses')->first();
            $request->session()->flash('success','Remarks Submitted.');
            return redirect(route("buyer.tenders.show",$request->input('id')));
        }
        else{
            return redirect()->back();
        }
    }

    public function deleteResponse(Request $request){
        $userId = Auth::user()->id;
        if(Gate::allows('child-buyer')){
            $userId = Auth::user()->parent_id;
        }
        if(Tender::where("user_id",$userId)->where('id',$request->input('id'))->exists()){
            TenderResponse::where('id',$request->input('response_id'))->where('tender_id',$request->input('id'))->update([
                'deleted' => 1
            ]);
            $tender = Tender::where('id',$request->input('id'))->with('tender_responses')->first();
            $request->session()->flash('success','Response Deleted.');
            return redirect(route("buyer.tenders.show",$request->input('id')));
        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function confirmationLetter(ConfirmationLetterRequest $request){

        $dataValidated = $request->validated();
        $userId = Auth::user()->id;
        if(Gate::allows('child-buyer')){
            $userId = Auth::user()->parent_id;
        }
        $tenderId = $request->input('tender_id');
        $toUserId = $request->input('user_id');
        // Check if He is the Owner of That Tender and This Tender has no confirmation letter
        if(Tender::where('id',$tenderId)->where('user_id',$userId)->where('confirmation_letter',0)->exists()){
            // dd('Owner Found');
        }
        else{
            $request->session()->flash('danger','Tender already has Confirmation Letter.');
            $tender = Tender::where('id',$tenderId)->with('tender_responses')->first();
            return redirect(route('buyer.tenders.show',[
                'tender'  => $tender
            ]));
        }
        // Check if Response Exists
        if(TenderResponse::where('user_id',$toUserId)->where('tender_id',$tenderId)->exists()){
            try{
                $file_name = null;
                if($request->input('confirmation_link') == null){ 
                    $file_name = time(). '-' . $request->input('tender_id') . $userId. '.' . $request->confirmation_letter->extension();
                    $request->confirmation_letter->move(public_path('confirmation-letters'),$file_name);
                }
                    // Update Response Record To Update Seller about Confirmation
                $confirmationLetter = TenderResponse::where('user_id',$toUserId)->where('tender_id',$tenderId)->update([
                    'confirmation_letter' => 1,
                    'letter_pdf'  => $file_name,
                    'confirmation_link'        => $request->input('confirmation_link')
                ]);
                    // To put Tender in Pending State
                $tender = Tender::where('id',$tenderId)->update([
                    'confirmation_letter' => 1
                ]);
            }
            catch(\Illuminate\Database\QueryException $e){
                $request->session()->flash('danger','Letter Did not Submit.');
                $tender = Tender::where('id',$tenderId)->with('tender_responses')->first();
                return redirect(route('buyer.tenders.show',[
                    'tender'  => $tender
                ]));
            }
            $request->session()->flash("success","Letter Submitted Successfully. Wait for Seller's Confirmation.");
            $tender = Tender::where('id',$tenderId)->with('tender_responses')->first();
            return redirect(route('buyer.tenders.show',[
                'tender'  => $tender
            ])); 
        }
        else{       // Response Doesn't Exist
            $request->session()->flash('danger','Response Does not exists.');
            $tender = Tender::where('id',$tenderId)->with('tender_responses')->first();
            return redirect(route('buyer.tenders.show',[
                'tender'  => $tender
            ]));
        }
    }
    public function cancelLetter(Request $request, $toUserId,$tenderId){

       
        $userId = Auth::user()->id;
        if(Gate::allows('child-buyer')){
            $userId = Auth::user()->parent_id;
        }
        // First of all check if Seller has not confirmed this Project yet.
        if(Project::where('tender_id',$tenderId)->exists()){
            $request->session()->flash('danger','The Seller has confirmed this Project. It is started.');
            $tender = Tender::where('id',$tenderId)->with('tender_responses')->first();
            return redirect(route('buyer.tenders.show',[
                'tender'  => $tender
            ]));
        }

        // Check if He is the Owner of That Tender and This Tender does not have confirmation letter
        if(Tender::where('id',$tenderId)->where('user_id',$userId)->where('confirmation_letter',1)->exists()){
            // dd('Owner Found');
        }
        else{
            $request->session()->flash('danger','Tender does not have Confirmation Letter.');
            $tender = Tender::where('id',$tenderId)->with('tender_responses')->first();
            return redirect(route('buyer.tenders.show',[
                'tender'  => $tender
            ]));
        }
            // Check if Response Exists
        if(TenderResponse::where('user_id',$toUserId)->where('tender_id',$tenderId)->exists()){
            try{
                    // Update Response Record To Update Seller about Confirmation
                $confirmationLetter = TenderResponse::where('user_id',$toUserId)->where('tender_id',$tenderId)->update([
                    'confirmation_letter' => 0
                ]);
                    // To put Tender in Pending State
                $tender = Tender::where('id',$tenderId)->update([
                    'confirmation_letter' => 0
                ]);
            }
            catch(\Illuminate\Database\QueryException $e){
                $request->session()->flash('danger','Confirmation did not Cancel.');
                $tender = Tender::where('id',$tenderId)->with('tender_responses')->first();
                return redirect(route('buyer.tenders.show',[
                    'tender'  => $tender
                ]));
            }
            $request->session()->flash("success","Confirmation Canceled Successfully.");
            $tender = Tender::where('id',$tenderId)->with('tender_responses')->first();
            return redirect(route('buyer.tenders.show',[
                'tender'  => $tender
            ])); 
        }
        else{       // Response Doesn't Exist
            $request->session()->flash('danger','Response Does not exists.');
            $tender = Tender::where('id',$tenderId)->with('tender_responses')->first();
            return redirect(route('buyer.tenders.show',[
                'tender'  => $tender
            ]));
        }
    }

    public function requestForRent($id,$proId)  // seller Id and Product Id
    {
        $product = Product::find($proId);
        return view('Buyer.tender.create',[
            'speacial'  => 'yes',
            'product'   => $product,
            'sellerId'  => $id
        ]);
    }




//------------------------------Projects Methods-----------------------------------

    public function projects(){
        $current_date = Date('Y-m-d');
        $projects = Project::all();    // If any Project have reached its Finished Date,
        foreach($projects as $project){ // then change its status to finished => 1.
            if($project->date_to == $current_date && $project->status == 0){
                $project->status = 1;
                $project->save();
            }
        }
        $userId = Auth::user()->id;
        if(Gate::allows('child-buyer')){
            $userId = Auth::user()->parent_id;
        }
        $serialNo = 1;
        $projects = Project::where('buyer',$userId)->with('user')->with('tender')->get();
        return view('Buyer.tender.projects',[
            'projects' => $projects,
            'serialNo' => $serialNo
        ]);
        
    }


  
}
