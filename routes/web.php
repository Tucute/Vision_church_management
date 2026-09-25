<?php

use App\Http\Controllers\PublicSiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Site Routes (Phase 1)
|--------------------------------------------------------------------------
| Toàn bộ route dưới đây là public, không cần đăng nhập.
| Route /admin do Filament tự đăng ký riêng, không cần khai báo ở đây.
*/

Route::get('/', [PublicSiteController::class, 'home'])->name('home');
Route::get('/about', [PublicSiteController::class, 'about'])->name('about');
Route::get('/about/vision-mission', [PublicSiteController::class, 'aboutVision'])->name('about.vision');
Route::get('/about/beliefs', [PublicSiteController::class, 'aboutBeliefs'])->name('about.beliefs');
Route::get('/about/story', [PublicSiteController::class, 'aboutStory'])->name('about.story');
Route::get('/about/team', [PublicSiteController::class, 'aboutTeam'])->name('about.team');
Route::get('/about/promise', [PublicSiteController::class, 'aboutPromise'])->name('about.promise');
Route::get('/about/friends', [PublicSiteController::class, 'aboutFriends'])->name('about.friends');
Route::get('/about/friends/{friend}', [PublicSiteController::class, 'aboutFriend'])->name('about.friends.show');

Route::get('/im-new', [PublicSiteController::class, 'imNewShow'])->name('im-new');
Route::post('/im-new', [PublicSiteController::class, 'imNewStore'])->name('im-new.store');

Route::get('/contact', [PublicSiteController::class, 'contactShow'])->name('contact');
Route::post('/contact', [PublicSiteController::class, 'contactStore'])->name('contact.store');

Route::get('/events', [PublicSiteController::class, 'events'])->name('events.index');
Route::get('/events/{event}', [PublicSiteController::class, 'eventShow'])->name('events.show');
Route::post('/events/{event}/register', [PublicSiteController::class, 'eventRegister'])->name('events.register');

Route::get('/ministries', [PublicSiteController::class, 'ministries'])->name('ministries.index');
Route::get('/ministries/{ministry}', [PublicSiteController::class, 'ministryShow'])->name('ministries.show');

// Sermons/Media và Gallery thuộc Phase 2 (chưa có domain) - tạm thời placeholder
Route::get('/sermons', fn () => app(PublicSiteController::class)->comingSoon('sermons'))->name('sermons.index');
Route::get('/gallery', fn () => app(PublicSiteController::class)->comingSoon('gallery'))->name('gallery.index');
