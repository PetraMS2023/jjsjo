<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\JopsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Site\HomeContactController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\SlidersController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TextController;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/news/show/{id}', [HomeController::class, 'showNews'])->name('news.show');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/clients', [HomeController::class, 'clients'])->name('clients');
//client.get.images
Route::get('/client/get/images/{id}', [HomeController::class, 'clientGetImages'])->name('client.get.images');

//category
Route::get('/category', [HomeController::class, 'category'])->name('category');
//subCategory
Route::get('/sub-category/{id}', [HomeController::class, 'subCategory'])->name('sub-category');
Route::get('/products/category/{id}', [HomeController::class, 'products'])->name('products');
///client/get/images/
Route::get('/client/get/images/{id}', [HomeController::class, 'clientGetImages'])->name('client.get.images');
//products_images
Route::get('/products/images/{id}', [HomeController::class, 'productsImages'])->name('products.images');

Route::get('/contact', [HomeContactController::class, 'index'])->name('contact');
Route::post('/contact/store', [HomeContactController::class, 'store'])->name('contact.store');

Route::get('/jobs', [HomeContactController::class, 'jobs'])->name('jobs');
Route::post('/jobs/store', [HomeContactController::class, 'storeJobs'])->name('jobs.store');


Route::get('/search/index', [SearchController::class, 'index'])->name('search');
Route::get('/search', [SearchController::class, 'search'])->name('search.search');
Route::get('/search/images/{id}', [SearchController::class, 'productsImages'])->name('search.images');


Route::get('/lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'ar'])) {
        session()->put('lang', $lang);
    } else {
        session()->put('lang', 'en');
    }
    return back();
})->name('lang');


Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login')->middleware('guest:admin');
Route::post('/admin/doLogin', [AdminController::class, 'doLogin'])->name('admin.doLogin')->middleware('guest:admin');


Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/home', function () {
        //عدد العملاء
        $clients = \App\Models\Client::count();
        //عدد البريد الوارد
        $emails = \App\Models\Contact::count();
        //عدد طلبات الوظائف
        $jops = \App\Models\Jops::count();
        return view('admin/parts/home', compact(   'clients', 'emails', 'jops'));
    })->name('admin.home');

    //categories
    Route::group(['as' => 'admin.'], function () {
        Route::resource('categories', CategoryController::class)->except(['show', 'destroy']);
        Route::get('/categories/delete/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        //subcategories
        Route::resource('sub-categories', SubCategoryController::class)->except(['show', 'destroy']);
        Route::get('/sub-categories/delete/{category}', [SubCategoryController::class, 'destroy'])->name('sub-categories.destroy');

        //products
        Route::resource('products', ProductController::class)->except(['show', 'destroy']);
        Route::get('/products/delete/{category}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/getSubCategory/{id}', [ProductController::class, 'getSubCategory'])->name('getSubCategory');
        Route::get('/product/delete/image', [ProductController::class, 'deleteImage'])->name('products.delete.image');
        Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');

        //clients
        Route::resource('clients', ClientController::class)->except(['show', 'destroy']);
        Route::get('/clients/delete/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
        Route::get('/client/delete/image', [ClientController::class, 'deleteImage'])->name('clients.delete.image');

        //sliders
        Route::get('/sliders', [SlidersController::class, 'index'])->name('sliders.index');
        Route::post('/sliders/update', [SlidersController::class, 'update'])->name('sliders.update');
        Route::get('/slider/delete/image', [SlidersController::class, 'deleteImage'])->name('sliders.delete.image');

        Route::get('/address', [TextController::class, 'address'])->name('address.index');
        Route::post('/address/update', [TextController::class, 'addressUpdate'])->name('address.update');

        //email
        Route::get('/emails', [EmailController::class, 'index'])->name('emails.index');
        //show
        Route::get('/emails/show/{id}', [EmailController::class, 'show'])->name('emails.show');
        //delete
        Route::get('/emails/delete/{id}', [EmailController::class, 'destroy'])->name('emails.destroy');

        //news
        Route::get('/news',                    [NewsController::class, 'index'])->name('news.index');
        Route::get('/news/create',             [NewsController::class, 'create'])->name('news.create');
        Route::post('/news/store',             [NewsController::class, 'store'])->name('news.store');
        Route::get('/news/edit/{id}',          [NewsController::class, 'edit'])->name('news.edit');
        Route::put('/news/update/{id}',        [NewsController::class, 'update'])->name('news.update');
        Route::get('/news/delete/{id}',        [NewsController::class, 'destroy'])->name('news.destroy');

        //jops
        Route::get('/jops',                    [JopsController::class, 'index'])->name('jops.index');
        Route::get('/jops/show/{id}',          [JopsController::class, 'show'])->name('jops.show');
        Route::get('/jops/delete/{id}',        [JopsController::class, 'destroy'])->name('jops.destroy');
    });



    //about

    Route::get('/about-us', [TextController::class, 'aboutUs'])->name('admin.about.index');
    Route::post('/about-us/update', [TextController::class, 'aboutUpdate'])->name('admin.about.update');


    Route::get('/terms-conditions', [TextController::class, 'conditions'])->name('admin.conditions.index');
    Route::post('/terms-conditions/update', [TextController::class, 'conditionsUpdate'])->name('admin.conditions.update');


    Route::get('/privacy-policy', [TextController::class, 'privacy'])->name('admin.privacy.index');
    Route::post('/privacy-policy/update', [TextController::class, 'privacyUpdate'])->name('admin.privacy.update');

    //contacts
    Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/contacts/show/{id}', [ContactController::class, 'show'])->name('admin.contacts.show');
    Route::get('/contacts/delete/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');

    //settings
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings/update', [SettingController::class, 'update'])->name('admin.settings.update');


    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

});
