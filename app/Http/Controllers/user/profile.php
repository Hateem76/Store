<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class profile extends Controller
{
    public function __invoke()
    {
        return view('User.edit-profile');
    }
}
