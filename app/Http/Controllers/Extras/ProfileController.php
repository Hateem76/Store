<?php

namespace App\Http\Controllers\Extras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Contact;
use Exception;
Use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function displayProfile(){
        $sidebar = 'Seller.layouts.sidebar2';
        $header  = 'Seller.layouts.header';
        $logoutCode = 'Seller.layouts.logout-code';


        return view('mix-views.display-profile',[
            'sidebar'  => $sidebar,
            'header'   => $header,
            'logoutCode' => $logoutCode
        ]);
    }

    public function updateAbout(){
        $aboutUs = $_GET['aboutUs'];
        $user = User::where('id',Auth::user()->id)->first();
        $user->about = $aboutUs;
        $user->save();
        return;
    }

    public function updateDp(Request $request){
        $dataValidated = $request->validate([
            'image_path' => 'required|max:512|mimes:png,jpg,jpeg',
        ]);
        $image_name = 'not_found.jpg';
        if($request->hasFile('image_path')){ 
            $image_name = time(). '-' . Auth::user()->name . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('images/dp'),$image_name);
        }
        try{
            $user = User::where('id',Auth::user()->id)->update([
                'avatar' => $image_name,
            ]);
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function editProfile(){
        return view('mix-views.edit-profile');
    }

    public function updateProfile(Request $request){
        $dateValidated = $request->validate([
                'name' => [
                    'required', 
                    'string', 
                    'max:255',
                    'unique:users,name,'.Auth::user()->id,
                ],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:users,email,'.Auth::user()->id,
                ],
                'password' =>  'required|min:8|same:password_confirmation',
                'id_card'  => [
                    'max:20',
                ],
                'number'  => [
                    'max:20',
                ],
                'address'  => [
                    'max:30',
                ],
        ]);
        try{
            $user = User::where('id',Auth::user()->id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'id_card'  => $request->input('id_card'),
                'number'  => $request->input('number'),
                'address'  => $request->input('address'),
            ]);
        }
        catch(\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger','Could not Update Profile. Try later');
            return redirect()->back();
        }
            $request->session()->flash('success','Profile Updated Successfully');
            return redirect()->back();
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
