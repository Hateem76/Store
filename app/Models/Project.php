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
        'tender_id',
        'user_id',
        'buyer',
        'date_from',
        'date_to',
        'status',
    ];

    public $timestamps = false;

    public function tender(){
        return $this->belongsTo(Tender::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
