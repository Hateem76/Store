<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;
use App\Models\Tender;

class TenderResponse extends Model
{
    use HasFactory;

    protected $table = 'tender_responses';

    protected $fillable = [
        'user_id',
        'product_id',
        'tender_id',
        'quotation',
        'attachments_link',
        'price',
        'description',
        'buyer_remakrs',
        'confirmation_letter',
        'confirmation_link',
        'letter_pdf',
        'deleted',
    ];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function tender(){
        return $this->belongsTo(Tender::class);
    }

}
