<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Contact;
use App\Models\Product;
use App\Models\TenderResponse;
use App\Models\Tender;
use App\Models\Project;
use App\Models\SellerReview;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Hash;
use PDO;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_card',
        'number',
        'address',
        'account_type',
        'parent_id',
        'parent_child',
        'rating',
        'numberOfReviews',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function hasAnyRole($role)
    {
        return null !== $this->roles()->where('name',$role)->first();
    }

    public function hasAnyRoles($role)
    {
        return null !== $this->roles()->whereIn('name',$role)->first();
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }


    public function tender_responses()
    {
        return $this->hasMany(TenderResponse::class);
    }

    public function tenders()
    {
        return $this->hasMany(Tender::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function seller_reviews()
    {
        return $this->hasMany(SellerReview::class);
    }

    public function product_reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

}
