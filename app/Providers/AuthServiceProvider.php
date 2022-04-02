<?php

namespace App\Providers;

use App\Models\ChFavorite;
use App\Models\Contact;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use PhpParser\Node\Expr\FuncCall;
use App\Models\User;
use App\Policies\ContactPolicy;
use Illuminate\Support\Facades\Auth;
use App\Models\Tender;
use App\Models\TenderResponse;
use App\Models\SellerReview;
use App\Models\ProductReview;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('logged-in',function($user){
            return $user;
        });
        Gate::define('is-admin',function ($user)
        {
            return $user->hasAnyRole('admin');
        });
        Gate::define('is-mod',function($user){
            return $user->hasAnyRole('moderator');
        });
        Gate::define('is-contact', function ($user, $contact) {
            return null !== ChFavorite::where('favorite_id',$contact->id)->where('user_id',$user->id)->first();
        });
        Gate::define('parent-seller', function ($user) {
            if($user->account_type == 'seller' && $user->parent_child == 1){
                return true;
            }
            else{
                return false;
            }
        });
        Gate::define('parent-buyer', function ($user) {
            if($user->account_type == 'buyer' && $user->parent_child == 1){
                return true;
            }
            else{
                return false;
            }
        });
        Gate::define('child-seller', function ($user) {
            if($user->account_type == 'buyer' && $user->parent_child == 0){
                return true;
            }
            else{
                return false;
            }
        });
        Gate::define('child-buyer', function ($user) {
            if($user->account_type == 'buyer' && $user->parent_child == 0){
                return true;
            }
            else{
                return false;
            }
        });
        
        Gate::define('seller', function ($user) {
            if($user->account_type == 'seller'){
                return true;
            }
            else{
                return false;
            }
        });
        Gate::define('buyer', function ($user) {
            if($user->account_type == 'buyer'){
                return true;
            }
            else{
                return false;
            }
        });
        Gate::define('parent', function ($user) {
            if($user->parent_child == 1){
                return true;
            }
            else{
                return false;
            }
        });
        Gate::define('confirmation-letter', function ($user,$tender) {
            if($tender->confirmation_letter == 1){
                return true;
            }
            else{
                return false;
            }
        });
        Gate::define('response-confirmation-letter', function ($user,$response) {
            if($response->confirmation_letter == 1){
                return true;
            }
            else{
                return false;
            }
        });
        Gate::define('seller-review', function ($user,$seller) {
            if(SellerReview::where('user_id',$seller->id)->where('buyer',$user->id)->exists()){
                return true;
            }
            else{
                return false;
            }
        });
        Gate::define('product-review', function ($user,$product) {
            if(ProductReview::where('user_id',$user->id)->where('product_id',$product->id)->exists()){
                return true;
            }
            else{
                return false;
            }
        });
    }
}
