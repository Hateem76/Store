<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Tender;
use App\Models\Contact;
use App\Models\Project;

class BuyerController extends Controller
{
    public function index(){
        $userId = Auth::user()->id;
        if(Gate::allows('child-buyer')){
            $userId = Auth::user()->parent_id;
        }
        $users = User::where('parent_id',$userId)->get();
        $users = $users->count();
        $deals = Project::where('buyer_id',$userId)->get();
        $deals = $deals->count();
        $contacts = Contact::where('me',$userId)->get();
        $contacts = $contacts->count();
        $tenders = Tender::where('user_id',$userId)->with('tender_responses')->get();
        $tenders = $tenders->count();
        return view('Buyer.index',[
            'users' => $users,
            'contacts' => $contacts,
            'tenders' => $tenders,
            'deals'  => $deals
        ]);
    }
}
