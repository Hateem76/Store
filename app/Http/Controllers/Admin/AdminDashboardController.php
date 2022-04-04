<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index(){
        $users = User::all();
        $users = $users->count();
        $categories = Category::all();
        $categories = $categories->count();
        return view('Admin.dashboard',[
            'users'  =>  $users,
            'categories' => $categories,
        ]);
    }
}
