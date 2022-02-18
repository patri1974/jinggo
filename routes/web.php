<?php

use Illuminate\Support\Facades\Route;

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
//Auth::routes();
Auth::routes(['register' => false]);



Route::get('/privacy-policy', [App\Http\Controllers\WebviewController::class, 'policy'])->name('privacy-policy');
Route::get('/dmca', [App\Http\Controllers\WebviewController::class, 'dmca'])->name('dmca');
Route::get('/contact', [App\Http\Controllers\WebviewController::class, 'contact'])->name('contact');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/data_seo', [App\Http\Controllers\HomeController::class, 'create'])->name('home');
Route::get('/database', [App\Http\Controllers\HomeController::class, 'data'])->name('database');

Route::get('/storage_link', function () {
    Artisan::call('storage:link');
});

Route::any('/sitemap.xml', [App\Http\Controllers\WebviewController::class, 'sitemap'])->name('sitemap');
Route::any('/sitemap/{url:slug}', [App\Http\Controllers\WebviewController::class, 'subsitemap'])->name('subsitemap');

Route::get('/', [App\Http\Controllers\WebviewController::class, 'home'])->name('home');
Route::get('/new', [App\Http\Controllers\WebviewController::class, 'new'])->name('new');
Route::get('/schedule', [App\Http\Controllers\WebviewController::class, 'schedule'])->name('schedule');
Route::post('/post_schedule', [App\Http\Controllers\WebviewController::class, 'post_schedule'])->name('post_schedule');
Route::any('/news/{url:slug}/{url1:slug}', [App\Http\Controllers\WebviewController::class, 'news'])->name('scraper');

Route::any('/games/{url:slug}', [App\Http\Controllers\WebviewController::class, 'games'])->name('games1');
Route::any('/games/{url:slug}/{url1:slug}', [App\Http\Controllers\WebviewController::class, 'games'])->name('games2');
Route::any('/games/{url:slug}/{url1:slug}/{url2:slug}', [App\Http\Controllers\WebviewController::class, 'games'])->name('games3');
Route::any('/games/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}', [App\Http\Controllers\WebviewController::class, 'games'])->name('games4');
Route::any('/games/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}', [App\Http\Controllers\WebviewController::class, 'games'])->name('games5');
Route::any('/games/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}', [App\Http\Controllers\WebviewController::class, 'games'])->name('games6');
Route::any('/games/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}/{url6:slug}', [App\Http\Controllers\WebviewController::class, 'games'])->name('games7');

Route::any('/page/{url:slug}', [App\Http\Controllers\WebviewController::class, 'page'])->name('page1');
Route::any('/page/{url:slug}/{url1:slug}', [App\Http\Controllers\WebviewController::class, 'page'])->name('page2');
Route::any('/page/{url:slug}/{url1:slug}/{url2:slug}', [App\Http\Controllers\WebviewController::class, 'page'])->name('page3');
Route::any('/page/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}', [App\Http\Controllers\WebviewController::class, 'page'])->name('page4');
Route::any('/page/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}', [App\Http\Controllers\WebviewController::class, 'page'])->name('page5');
Route::any('/page/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}', [App\Http\Controllers\WebviewController::class, 'page'])->name('page6');
Route::any('/page/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}/{url6:slug}', [App\Http\Controllers\WebviewController::class, 'page'])->name('page7');
Route::any('/page/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}/{url6:slug}/{url7:slug}', [App\Http\Controllers\WebviewController::class, 'page'])->name('page8');
Route::any('/page/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}/{url6:slug}/{url7:slug}/{url8:slug}', [App\Http\Controllers\WebviewController::class, 'page'])->name('page9');
Route::any('/page/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}/{url6:slug}/{url7:slug}/{url8:slug}/{url9:slug}', [App\Http\Controllers\WebviewController::class, 'page'])->name('page10');
Route::any('/page/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}/{url6:slug}/{url7:slug}/{url8:slug}/{url9:slug}/{url10:slug}', [App\Http\Controllers\WebviewController::class, 'page'])->name('page11');
Route::any('/page/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}/{url6:slug}/{url7:slug}/{url8:slug}/{url9:slug}/{url10:slug}/{url11:slug}', [App\Http\Controllers\WebviewController::class, 'page'])->name('page12');

Route::any('/{url:slug}', [App\Http\Controllers\WebviewController::class, 'bing'])->name('scraper1');
Route::any('/{url:slug}/{url1:slug}', [App\Http\Controllers\WebviewController::class, 'bing'])->name('scraper2');
Route::any('/{url:slug}/{url1:slug}/{url2:slug}', [App\Http\Controllers\WebviewController::class, 'bing'])->name('scraper3');
Route::any('/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}', [App\Http\Controllers\WebviewController::class, 'bing'])->name('scraper4');
Route::any('/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}', [App\Http\Controllers\WebviewController::class, 'bing'])->name('scraper5');
Route::any('/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}', [App\Http\Controllers\WebviewController::class, 'bing'])->name('scraper6');
Route::any('/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}/{url6:slug}', [App\Http\Controllers\WebviewController::class, 'bing'])->name('scraper7');
Route::any('/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}/{url6:slug}/{url7:slug}', [App\Http\Controllers\WebviewController::class, 'bing'])->name('scraper8');
Route::any('/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}/{url6:slug}/{url7:slug}/{url8:slug}', [App\Http\Controllers\WebviewController::class, 'bing'])->name('scraper9');
Route::any('/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}/{url6:slug}/{url7:slug}/{url8:slug}/{url9:slug}', [App\Http\Controllers\WebviewController::class, 'bing'])->name('scraper10');
Route::any('/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}/{url6:slug}/{url7:slug}/{url8:slug}/{url9:slug}/{url10:slug}', [App\Http\Controllers\WebviewController::class, 'bing'])->name('scraper11');
Route::any('/{url:slug}/{url1:slug}/{url2:slug}/{url3:slug}/{url4:slug}/{url5:slug}/{url6:slug}/{url7:slug}/{url8:slug}/{url9:slug}/{url10:slug}/{url11:slug}', [App\Http\Controllers\WebviewController::class, 'bing'])->name('scraper12');
