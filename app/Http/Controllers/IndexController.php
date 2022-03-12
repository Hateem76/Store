<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class IndexController extends Controller
{
    public function index(){
        // $countries = new CountryList();
        // $countries = $countries->getlist('en', 'json');
        // $object = json_decode($countries, TRUE);
        // $a = 1;
        // // foreach($object as $country => $name){
        // //     Country::create([
        // //         'name' => $name
        // //     ]);
        // //     $a++;
        // // }
        // dd($object);
        return view('index');
    }
}
