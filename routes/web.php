<?php

use Illuminate\Support\Facades\Route;
use phpDocumentor\Reflection\Types\Resource_;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\BuyerTenderController;
use App\Http\Controllers\Extras\ExtraController;
use App\Http\Controllers\Seller\SellerUserController;
use App\Http\Controllers\Buyer\BuyerUserController;
use App\Http\Controllers\Extras\ProfileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\SellerTenderController;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    // Landing Page
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/foto', function (){

    $myFile = public_path("images/bg/c1.jpg");
    $headers = ['Content-Type: application/image'];
    $newName = 'nicesnippets-pdf-file-'.time().'.jpg';

        return response()->download($myFile, $newName, $headers);
    
    });

    // Extras (Login. Search,View Products. Search,View Vendors) => Both
Route::prefix('extras')->middleware('auth')->name('extras.')->group(function(){
    Route::get('login', [ExtraController::class, 'login'])->name('login');
    Route::post('/searchProducts', [ExtraController::class, 'searchProducts'])->name('searchProducts');
    Route::get('/viewProduct/{id}', [ExtraController::class, 'viewProduct'])->name('vewProduct');
    Route::post('/searchVendors', [ExtraController::class, 'searchVendors'])->name('searchVendors');
    Route::get('/vendorProfile/{id}', [ExtraController::class, 'vendorProfile'])->name('vendorProfile');
    Route::post('/downloadLetter', [ExtraController::class, 'downloadLetter'])->name('downloadLetter');
    Route::post('/downloadQuotation', [ExtraController::class, 'downloadQuotation'])->name('downloadQuotation');
});

    // Personal Profile for both Buyers and Vendors.    => Both
Route::prefix('profile')->middleware('auth')->name('profile.')->group(function(){
    Route::get('/show', [ProfileController::class, 'displayProfile'])->name('show');
    Route::get('/edit', [ProfileController::class, 'editProfile'])->name('edit');
    Route::post('/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/updateDp', [ProfileController::class, 'updateDp'])->name('updateDp');
    Route::get('/updateAbout', [ProfileController::class, 'updateAbout'])->name('updateAbout');
    Route::get('/myContacts', [ProfileController::class, 'myContacts'])->name('myContacts');
    Route::get('/addToContacts/{id}', [ProfileController::class, 'addToContacts'])->name('addToContacts');
    Route::get('/removeFromContacts/{id}', [ProfileController::class, 'removeFromContacts'])->name('removeFromContacts');
});


    //Seller Routes
Route::prefix('seller')->middleware(['auth','auth.seller'])->name('seller.')->group(function(){
    Route::get('index', [SellerController::class, 'index'])->name('index');
    Route::resource('/users', SellerUserController::class);
    Route::resource('/products', ProductController::class);
    Route::get('/tenders', [SellerTenderController::class, 'index'])->name('tenders');
    Route::post('/tendersResponse', [SellerTenderController::class, 'sendResponse'])->name('tendersResponse');
    Route::get('/stockInForm', [ProductController::class, 'stockInForm'])->name('stockInForm');
    Route::get('/stockOutForm', [ProductController::class, 'stockOutForm'])->name('stockOutForm');
    Route::post('/stockIn', [ProductController::class, 'stockIn'])->name('stockIn');
    Route::post('/stockOut', [ProductController::class, 'stockOut'])->name('stockOut');
    Route::get('/confirmationIndex', [SellerTenderController::class, 'confirmationIndex'])->name('confirmationIndex');
    Route::post('/confirmProject', [SellerTenderController::class, 'confirmProject'])->name('confirmProject');
    Route::get('/projects', [SellerTenderController::class, 'projects'])->name('projects');
});


    //Buyer Routes
Route::prefix('buyer')->middleware(['auth','auth.buyer'])->name('buyer.')->group(function(){
    Route::get('index', [BuyerController::class, 'index'])->name('index');
    Route::resource('/users', BuyerUserController::class);
    Route::resource('/tenders', BuyerTenderController::class);
    Route::post('/confirmationLetter', [BuyerTenderController::class, 'confirmationLetter'])->name('confirmationLetter');
    Route::get('/cancelLetter/{userId}/{tenderId}', [BuyerTenderController::class, 'cancelLetter'])->name('cancelLetter');
    Route::get('/projects', [BuyerTenderController::class, 'projects'])->name('projects');
    Route::get('/requestForRent/{id}/{proId}', [BuyerTenderController::class, 'requestForRent'])->name('requestForRent');
});


    //Admin Routes
Route::prefix('admin')->middleware(['auth','auth.isAdmin'])->name('admin.')->group(function () {
    Route::resource('/users', UserController::class);
});

