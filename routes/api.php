<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('login', 'AuthController@login');


Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'superadmin', 'middleware' => [ 'role:SuperAdmin'], 'namespace' => 'SuperAdmin'], function ()  {
        //Access By SuperAdmin Only
        //Manage Admin
        //Add New Admin
        Route::post('admin', 'AdminController@createAdmin');
        //Get All Admins
        Route::get('admin', 'AdminController@getAllAdmin');
        //Get All Admin With Here Agency
        Route::get('admin/withagency', 'AdminController@getAllAdminAgency');
        //Get Admin By Id
        Route::get('admin/{id}', 'AdminController@getAdminById');
        //Update Admin
        Route::put('admin/{id}', 'AdminController@updateAdmin');
        //Hard Delete Admin
        Route::delete('admin/{id}', 'AdminController@deleteAdmin');
    });

    Route::group(['prefix' => 'admin', 'middleware' => [ 'role:Admin'], 'namespace' => 'admin'], function ()  {
        //Access By SuperAdmin Only
        //Manage Agency
        //Create New Agency
        Route::post('agency', 'AgencyController@createAgency');
        //Get All Authenticated User Agencies
        Route::get('agency', 'AgencyController@getAllAgency');
        //Get Agency By Id
        Route::get('agency/{id}', 'AgencyController@getAgencyById');
        //Update Agency
        Route::put('agency/{id}', 'AgencyController@updateAgency');
        //Delete Agency
        Route::delete('agency/{id}', 'AgencyController@deleteAgency');
        //Get An Agency Tours
        Route::get('agency/{id}/tour', 'AgencyController@getAgencyTourById');
        //Mange Tour
        //Create New Tour
        Route::post('tour', 'TourController@createTour');
        //Get Tour By Id
        Route::get('tour/{id}', 'TourController@getTourById');
        //Manage Traveler
        //Create New Traveler
        Route::post('traveler', 'TravelerController@createTraveler');
        //Get All Travelers
        Route::get('traveler', 'TravelerController@getAllTraveler');
        //Get A Traveler By Id
        Route::get('traveler/{id}', 'TravelerController@getTravelerById');
        //Update Traveler
        Route::put('traveler/{id}', 'TravelerController@updateTraveler');
        Route::delete('agency/{id}', 'AgencyController@deleteAgency');
        Route::get('agency/{id}/tour', 'AgencyController@getAgencyTourById');
    });
//    Route::get('logout', 'ApiController@logout');
//
//    Route::get('user', 'ApiController@getAuthUser');
//
//    Route::get('products', 'ProductController@index');
//    Route::get('products/{id}', 'ProductController@show');
//    Route::post('products', 'ProductController@store');
//    Route::put('products/{id}', 'ProductController@update');
//    Route::delete('products/{id}', 'ProductController@destroy');
});
