<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SellerReview extends Model
{
    use HasFactory;

    protected $table = 'seller_reviews';

    protected $fillable = [
        'buyer',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
