<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateTenderUserRelator extends Model
{
    use HasFactory;

    protected $table = 'private_tender_user_relator';

    protected $fillable = [
        'user_id',
        'tender_id',
    ];

    public $timestamps = false;

    
}
