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

Route::view('/', 'welcome')->name('/');

Auth::routes();

Route::middleware(['auth','BanUser'])->group(function(){
    Route::get('/home', 'UniversityViewController@index')->name('home');

    Route::middleware('AdminOnly')->group(function(){
        Route::view('/admin-dashboard','dashboard.dashboard')->name('dashboard');
        Route::get('/user-manager', 'UserManagerController@index')->name('userManager.index');
        Route::post('/ban-user', 'UserManagerController@banUser')->name('userManager.banUser');
        Route::post('/restore-user', 'UserManagerController@restoreUser')->name('userManager.restoreUser');
        Route::get('/user-detail/{id}','UserManagerController@userDetail')->name('userManager.userDetail');
        Route::resource('announcement','AnnouncementController');

    });

        Route::resource('university','UniversityController');
        Route::get('/user-university',"userManagerController@userUniversity")->name('userManager.userUniversity');
        Route::resource('post','PostController');
        Route::resource('comment','CommentController');


    Route::prefix('profile')->group(function(){
            // Main Frame Route
            Route::get('/','ProfileController@profile')->name('profile');
            Route::get('/edit-photo','ProfileController@editPhoto')->name('profile.edit.photo');
            Route::get('/edit-password','ProfileController@editPassword')->name('profile.edit.password');
            Route::get('/edit-info','ProfileController@editInfo')->name('profile.edit.info');

            Route::post('/change-password','ProfileController@changePassword')->name('profile.changePassword');
            Route::post('/change-photo','ProfileController@changePhoto')->name('profile.changePhoto');
            Route::post('/update-info','ProfileController@updateInfo')->name('profile.updateInfo');
            Route::post('/change-info','ProfileController@changeInfo')->name('profile.changeInfo');

        });


    Route::prefix('user-profile')->group(function(){
        Route::get('/profile','UniversityViewController@profileHome')->name('uniView.profile');
        Route::get('/edit','UniversityViewController@profileEdit')->name('uniView.profile-edit');
//        Route::post('/update-info','UniversityViewController@profileUpdate')->name('uniView.profile-update');
        Route::post('/update','UniversityViewController@profileUpdate')->name('uniView.profile-update');
    });

    Route::prefix('user-post')->group(function(){
        Route::post('/create','UserPostController@store')->name('userPost.create');
        Route::get('/edit/{id}','UserPostController@edit')->name('userPost.edit');
        Route::post('/update/{id}','UserPostController@update')->name('userPost.update');
        Route::delete('/delete/{id}','UserPostController@destroy')->name('userPost.destroy');
        Route::get('/detail/{id}','UserPostController@detail')->name('userPost.detail');
        Route::post('/comment-add','UserPostController@addComment')->name('userPost.addComment');
        Route::get('/post-feed','UserPostController@feedIndex')->name('userPost.feedIndex');
        Route::get('/user-profile/{id}','UserPostController@userProfile')->name('userPost.userProfile');
        Route::get('/feed-detail/{id}','UserPostController@feedDetail')->name('userPost.feedDetail');

    });
    Route::resource('chat','StudentMessageController');
    Route::get('/message/{id}','MessageController@getMessage')->name('message');
    Route::post('/messages','MessageController@sendMessage');

});


Route::prefix('universities')->group(function(){
    Route::get('/all','UniversityViewController@index')->name('uniView.index');
    Route::get('/uni-by-current-place','UniversityViewController@currentPlace')->name('uniView.currentPlace');
    Route::get('/detail/{id}','UniversityViewController@show')->name('uniView.detail');
    Route::get('/announcement','UniversityViewController@annView')->name('uniView.announcement.index');
});

Route::get('forget-password', 'Auth\ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
Route::post('forget-password', 'Auth\ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post');
Route::get('reset-password/{token}', 'Auth\ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
Route::post('reset-password', 'Auth\ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');






