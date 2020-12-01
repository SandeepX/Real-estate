<?php

use Illuminate\Http\Request;

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

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@registerUser');
Route::post('provider', 'AuthController@providerLogin');
Route::get('address', 'AddressController@getAddressDetails');
Route::get('address/municipality', 'AddressController@getMunicipality');

Route::get('dashboard', 'PropertyController@getDashboardProperties');
Route::get('properties', 'PropertyController@getAllProperties');
Route::get('property/{property_id}', 'PropertyController@getPropertyDetail');
Route::post('filter', 'PropertyController@filterProperty');
Route::get('propertydetail', 'PropertyController@getPropertyDetails');

Route::get('aboutus', 'SiteHelperController@getAboutUs');
Route::get('termsandcondition', 'SiteHelperController@getTermsAndConditions');
Route::get('privacypolicy', 'SiteHelperController@getPrivacyPolicy');
Route::post('contactus', 'SiteHelperController@contactUs');
Route::get('faq', 'SiteHelperController@getFaqs');

Route::post('forgetpassword', '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');

Route::middleware('auth:api')->group(function () {
    Route::get('notifications', 'UserController@getNotifications');
    Route::get('logout', 'AuthController@logout');
    Route::get('user', 'UserController@getUserDetails');
    Route::get('user/manager_request', 'UserController@sendRequest');
    Route::match(['patch', 'put'], 'user', 'UserController@updateUser');
    Route::match(['patch', 'put'], 'user/contact', 'UserController@updateUserContact');
    Route::match(['patch', 'put'], 'user/social', 'UserController@updateSocialLinks');
    Route::post('user/updatepassword', 'UserController@changePassword');
    Route::get('user/properties', 'UserController@getUserProperties');
    Route::post('property', 'PropertyController@postProperty');
    Route::get('property/documents/{property_id}', 'PropertyController@getPropertyDocuments');
    Route::post('property/documents', 'PropertyController@uploadPropertyDocuments');
    Route::match(['put', 'patch'], 'property', 'PropertyController@postProperty');
    Route::get('property/rate/{property_id}', 'PropertyController@getUserRating');
    Route::post('property/rate', 'PropertyController@rateProperty');
    Route::delete('property/image/{image_id}', 'PropertyController@deleteGalleryImage');
    Route::match(['put', 'patch'], 'property/moreinfo', 'PropertyController@updatePropertyInformation');

    Route::get('property/floor/{property_id}/{floor_id}', 'PropertyController@getFloor');
    Route::post('property/floor', 'PropertyController@addNewFloor');
    Route::match(['patch', 'put'], 'property/floor', 'PropertyController@updateFloor');
    Route::delete('property/floor/{property_id}/{floor_id}', 'PropertyController@deleteFloor');

    Route::post('user/requestmanager', 'UserController@requestManager');
    Route::delete('user/requestmanager/{property_id}', 'UserController@deleteManager');
    Route::match(['put', 'patch'], 'user/requestmanager', 'UserController@editManager');
    Route::get('user/managers', 'UserController@listManagersWithProperties');
    Route::get('property/verify/{property_id}', 'UserController@requestVerification');
    Route::get('property/feature/{property_id}', 'UserController@requestFeaturing');

    Route::post('property/requestus', 'PropertyController@requestPropertyDetails');
    Route::get('property/requests/{property_id}', 'PropertyController@getPropertyRequests');
    Route::get('user/propertieswithoutmanager', 'UserController@getPropertiesWithoutManager');

    Route::get('manager/managedproperties', 'UserController@managedProperties');
    Route::get('user/favourite', 'UserController@getAllFavProperties');
    Route::get('likeunlike/{property_id}', 'UserController@toggleFavourite');
});
