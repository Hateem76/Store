<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TenderResponse;
use App\Models\User;
use App\Models\Project;

class Tender extends Model
{
    use HasFactory;

    protected $table = 'tenders';

    protected $fillable = [
        'user_id',
        'product_name',
        'duration',
        'description',
        'unit',
        'public_private',
        'quantity',
        'confirmation_letter',
    ];

    public $timestamps = false;


    public function tender_responses()
    {
        return $this->hasMany(TenderResponse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

}
