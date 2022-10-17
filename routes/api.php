<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResellerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\RegularUser;
use App\Http\Controllers\RegularUserController;
use App\Http\Controllers\UserSocialController;
use App\Http\Controllers\CustomLinkController;
use App\Http\Controllers\CardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/signup', [AuthController::class, 'sign_up']);
Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    // protected routes go here
Route::post('/logout', [AuthController::class, 'logout']);
});




Route::controller(RegularUserController::class)->group(function () { 

Route::post('/createReguarUser', 'createRegularUsers');
Route::post('/loginReguarUser', 'loginReguarUser');
Route::post('/updateUser', 'updateUser');
Route::get('/deleteUser', 'deleteUser');


    });

Route::controller(cardController::class)->group(function () { 

Route::post('/createCard', 'createCard');
Route::post('/updateCard', 'updateCard');
Route::get('/deleteCard', 'deleteCard');
Route::get('/getUserAllCards', 'getUserAllCards');
Route::get('/userSpecificCard', 'userSpecificCard');


  });

Route::controller(UserSocialController::class)->group(function () { 

Route::post('/addSocialLink', 'addUpdateSocialLink');
Route::get('/deleteSocialLink', 'deleteSocialLink');

  });

Route::controller(CustomLinkController::class)->group(function () { 

Route::post('/addCustomLink', 'addCustomLink');
Route::post('/updateCustomLink', 'updateCustomLink');
Route::get('/deleteCustomLink', 'deleteCustomLink');
  });
