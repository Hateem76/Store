<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    use HasFactory;

    protected $table = 'extras';

    protected $fillable = [
        'cat1',
        'cat2',
        'cat3',
        'cat4',
        'cat5',
        'cat6',
        'pro1',
        'pro2',
        'pro3',
        'pro4',
        'pro5',
        'pro6',
        'pro7',
        'pro8',
    ];

    public $timestamps = false;
}
