<?php

namespace App\Http\Controllers\Extras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Contact;

class ProfileController extends Controller
{
    public function displayProfile(){
        $check = 'Seller.layouts.app';
        return view('mix-views.display-profile',[
            'check'  => $check
        ]);
    }

    public function editProfile(){
        $check = 'Seller.layouts.app';
        $user = User::find(Auth::user()->id);
        return view('mix-views.edit-profile',[
            'user'  => $user,
            'check'  => $check
        ]);
    }

    public function myContacts(){
        $userId = Auth::user()->id;
        if(Gate::allows('child-seller')){
            $userId = Auth::user()->parent_id;
        }
        $serialNo = 1;
        $check = 'Seller.layouts.app';
        $contacts = Contact::where('me',$userId)->with('user')->get();
        return view('mix-views.my-contacts',[
                    'contacts'  => $contacts,
                    'check'     => $check,
                    'serialNo'  => $serialNo
                ]);
        // if(Auth::user()->account_type == 'seller'){
        //     return view('Seller.profile.mycontacts',[
        //         'contacts'  => $contacts
        //     ]);
        // }
        // else if(Auth::user()->account_type == 'buyer'){
        //     return view('Buyer.profile.mycontacts',[
        //         'contacts'  => $contacts
        //     ]);
        // }
        
    }

    public function addToContacts($id){
        if(User::where('id',$id)->exists()){ 
            $contact = Contact::create([
                'me' => Auth::user()->id,
                'user_id'  => $id
            ]);
            return redirect()->back();
        }
    }

    public function removeFromContacts($id){
    
        $contact =  User::find($id);
        if(Gate::allows('is-contact',$contact)){
            Contact::where('user_id',$id)->where('me',Auth::user()->id)->delete();
        }
        return redirect()->back();
    }
}
