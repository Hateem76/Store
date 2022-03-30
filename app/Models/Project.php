<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tender;
use App\Models\User;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'buyer_id',
        'seller_id',
        'buyer_remarks',
        'seller_remarks',
        'quotation',
        'seller_link',
        'confirmation_letter',
        'buyer_link',
        'date_from',
    ];

    public $timestamps = false;

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function tender(){
        return $this->belongsTo(Tender::class);
    }
}
