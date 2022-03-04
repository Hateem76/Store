<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;
use App\Models\TenderResponse;
use App\Models\ProductReview;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'category_id',
        'image_path',
        'brand_name',
        'weight',
        'unit',
        'description',
        'rent_day',
        'rent_week',
        'rent_month',
        'user_id',
        'stock',
        'rating',
        'numberOfReviews',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tender_responses()
    {
        return $this->hasMany(TenderResponse::class);
    }

    public function product_reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}
