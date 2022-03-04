<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class ContactPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function check(User $contact)
    {
        $contact = Contact::where('user_id',$contact->id)->where('me',Auth::user()->id)->get();
        if($contact == Null){
            return null;
        }
        else{
            return $contact;
        }
    }
}
