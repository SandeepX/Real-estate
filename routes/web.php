<?php

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


#backend routes

Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
});


Route::group(['middleware'=>['auth','role:Super Admin'],'prefix' => 'admin'], function () {


    Route::get('/', function () {
       return view('admin.pages.dashboard');
    })->name('admin.dashboard');

    //roles routes
    Route::resource('roles','Admin\RoleController');

    //manage,create users routes
    Route::delete('/user/image/delete/{id}','Admin\UserController@deleteImage')->name('user.images.destroy');
    Route::resource('users','Admin\UserController');

    //edit profile routes
    Route::get('/edit-profile','Admin\ProfileController@editProfile')->name('admin.editProfile');
    Route::put('/edit-profile','Admin\ProfileController@updateProfile')->name('admin.updateProfile');

    //change password routes
    Route::get('/password','Admin\ProfileController@changePassword')->name('admin.changePassword');
    Route::put('/password','Admin\ProfileController@updatePassword')->name('admin.updatePassword');

    //check password ajax
    Route::get('/check/password/{password}','Admin\ProfileController@checkPasswordByAjax')->name('check.password');

    //manager routes
    Route::get('manager/requests','Admin\ManagersController@getAllManagerRequests')->name('admin.manager.request');

    Route::get('manager/requests/{userId}','Admin\ManagersController@assignManager')->name('admin.manager.request.single');

    //property Feature routes
    Route::resource('/property/features','Admin\Property\PropertyFeatureController');

    //property Category routes
    Route::resource('/property/categories','Admin\Property\PropertyCategoryController');

    //property subCategory routes
    Route::resource('/property/subcategories','Admin\Property\PropertySubCategoryController');

    //property status(sale type) routes
    Route::resource('/property/status','Admin\Property\PropertyStatusController');

    //property floor plan routes
    Route::resource('/manage/property/{propertyId}/floors','Admin\Property\PropertyFloorPlanController');

    //property information routes
    Route::post('/manage/property/{propertyId}/info','Admin\Property\PropertyInformationController@updatePropertyInformation')->name('property.info.store');

    //property document  routes
    Route::delete('/documents/file/delete/{id}/{column}','Admin\Property\PropertyDocumentController@deleteDocument')->name('property.files.destroy');

    Route::resource('/manage/property/{propertyId}/documents','Admin\Property\PropertyDocumentController');

    //property routes
    Route::delete('/property/featured/image/delete/{id}','Admin\Property\PropertyController@deleteFeaturedImage')->name('property.single.images.destroy');
    Route::delete('/property/image/delete/{id}','Admin\Property\PropertyController@deleteImages')->name('property.images.destroy');
    Route::resource('/manage/property','Admin\Property\PropertyController');

    //property manager Request Controller
    Route::get('requests/managers','Admin\ManagerRequestController@getAllManagerRequest')->name('admin.request.index');
    Route::get('requests/managers/{id}','Admin\ManagerRequestController@getSingleRequest')->name('admin.request.single');
    Route::put('requests/managers/{id}','Admin\ManagerRequestController@updateRequest')->name('admin.request.update');

    //verified properties
    Route::get('verified/properties','Admin\Property\PropertyListingController@getVerifiedProperties')->name('admin.properties.verified');
    Route::get('unverified/properties','Admin\Property\PropertyListingController@getUnverifiedProperties')->name('admin.properties.unverified');

    //featured properties
    Route::get('featured/properties/{id}','Admin\Property\PropertyListingController@toggleFeature')->name('property.featured.status');
    Route::get('featured/properties','Admin\Property\PropertyListingController@getFeaturedProperties')->name('admin.properties.featured');

    //property verification requests route
    Route::get('requests/verification','Admin\Property\PropertyVerificationRequestController@getAllVerificationRequests')->name('admin.request.verification');
    //verfiy property toggle
    Route::get('requests/verification/{id}','Admin\Property\PropertyVerificationRequestController@verifyProperty')->name('admin.request.verification.single');

    //property featured requests route
    Route::get('requests/featured','Admin\Property\PropertyVerificationRequestController@getAllFeaturedRequests')->name('admin.request.featured');
    Route::get('requests/featured/{id}','Admin\Property\PropertyVerificationRequestController@markPropertyFeatured')->name('admin.request.featured.single');

    //faq routes
    Route::resource('faqs','Admin\FaqController');

    //testimonial routes
    Route::delete('/testimonial/image/delete/{id}','Admin\TestimonialController@deleteImage')->name('testimonial.images.destroy');
    Route::resource('testimonials','Admin\TestimonialController');

    //sponsers routes
    Route::delete('/sponsers/image/delete/{id}','Admin\SponserController@deleteImage')->name('sponsers.images.destroy');
    Route::resource('sponsers','Admin\SponserController');

    //site-settings route
    Route::get('/settings','Admin\SiteSettingController@editSiteSetting')->name('admin.siteSetting');
    Route::put('/settings','Admin\SiteSettingController@updateSiteSetting')->name('admin.updateSetting');

    //about-us route
    Route::delete('/about/image/delete/{column}','Admin\AboutUsController@deleteImage')->name('about.images.destroy');
    Route::get('/about-us','Admin\AboutUsController@editAbout')->name('admin.editAbout');
    Route::put('/about-us','Admin\AboutUsController@updateAbout')->name('admin.updateAbout');

    //team designation routes
    Route::resource('team/designations','Admin\Team\DesignationController');

    //team member route
    Route::delete('/member/image/delete/{id}','Admin\Team\TeamMemberController@deleteImage')->name('member.images.destroy');
    Route::resource('team/members','Admin\Team\TeamMemberController');

    //blog category routes
    Route::resource('blogs-category','Admin\Blogs\BlogCategoryController');

    //blog tags
    Route::resource('blogs-tag','Admin\Blogs\BlogTagController');

    //blogs route
    Route::delete('/blog/image/delete/{id}','Admin\Blogs\BlogController@deleteImage')->name('blog.images.destroy');
    Route::resource('blogs','Admin\Blogs\BlogController');

    //contact message routes
   Route::get('contact-messages','Admin\ContactMessageController@getAllContactMessages')->name('admin.messages');
   Route::get('contact-messages/{id}','Admin\ContactMessageController@viewSingleMessage')->name('admin.messages.single');

   //pricing plan routes
    Route::resource('plans/pricing','Admin\PricingPlanController');

    //privacy-policy routes
    Route::resource('privacy-policy','Admin\PrivacyPolicyController', [
        'names' => [
            'index' => 'policy.index',
            'create' => 'policy.create',
            'store' => 'policy.store',
            'edit' => 'policy.edit',
            'update' => 'policy.update',
            'destroy' => 'policy.destroy',

    ]]);

    //terms-conditions routes
    Route::resource('terms-conditions','Admin\TermConditionController', [
        'names' => [
            'index' => 'conditions.index',
            'create' => 'conditions.create',
            'store' => 'conditions.store',
            'edit' => 'conditions.edit',
            'update' => 'conditions.update',
            'destroy' => 'conditions.destroy',

        ]]);

    //subscribers
    Route::get('/subscribers','Admin\SubscriberController@getSubscribers')->name('admin.subscribers');
    Route::delete('/subscribers/{email}','Admin\SubscriberController@deleteSubscriber')->name('admin.removeSubscriber');

    //notifications routes
    Route::get('/notifications','Admin\NotificationController@getAllNotifications')->name('admin.notifications');
    Route::get('/notifications/markAllRead','Admin\NotificationController@markAllRead')->name('admin.notifications.markAllRead');
    Route::get('/notifications/markRead/{id}','Admin\NotificationController@markAsRead')->name('admin.notifications.markAllRead.single');

    //newsletter routes
    Route::get('newsletter/publish/{id}','Admin\NewsLetterController@publish')->name('admin.newsletter.publish');
    Route::resource('newsletter','Admin\NewsLetterController');
});


#frontend routes
Route::get('/', 'Frontend\PageController@getHome')->name('fe.home');

// About Us page
Route::get('/about', 'Frontend\PageController@getAbout')->name('fe.about');

// faq page
Route::get('/faqs', 'Frontend\PageController@getFaqs')->name('fe.faq');

// contact page
Route::get('/contact-us', 'Frontend\PageController@getContactPage')->name('fe.contact');
Route::post('/contact-us', 'Frontend\PageController@postContactMessage')->name('fe.contact.store');

//property routes
//single property
Route::get('show-property/{slug}','Frontend\Property\PropertyListingController@getSingleProperty')->name('fe.singleProperty');

//request property by guest
Route::post('guest/request/{property}','Frontend\Property\PropertyRequestController@requestProperty')->name('fe.guest.request.property');

Route::get('all/properties','Frontend\Property\PropertyListingController@getAllProperties')->name('fe.properties');
Route::get('featured-properties','Frontend\Property\PropertyListingController@getFeaturedProperties')->name('fe.featuredProperty');
Route::get('new-properties','Frontend\Property\PropertyListingController@getNewProperties')->name('fe.newProperty');
Route::get('trending-properties','Frontend\Property\PropertyListingController@getTrendingProperties')->name('fe.trendingProperty');

Route::get('category/{category}/properties','Frontend\Property\PropertyListingController@getPropertiesByCategory')->name('fe.cat.properties');
Route::get('subcategory/{subcategory}/properties','Frontend\Property\PropertyListingController@getPropertiesBySubCategory')->name('fe.subcat.properties');

//property by sale type
Route::get('status/{status}/properties','Frontend\Property\PropertyListingController@getPropertiesByStatus')->name('fe.status.properties');

//property search routes
Route::get('search/properties','Frontend\Property\PropertySearchController@searchAtHome')->name('fe.search');
Route::get('search/nav/properties','Frontend\Property\PropertySearchController@searchAtNav')->name('fe.nav.search');
Route::get('search/advanced/properties','Frontend\Property\PropertySearchController@advanceSearch')->name('fe.advance.search');

//district municipal routes
Route::get('/province/{provinceId}/districts','Common\ProvinceDistrictController@getProvinceDistricts')->name('province.districts');
Route::get('/district/municipals/{districtId}','Common\ProvinceDistrictController@getDistrictMunicipals')->name('district.municipals');

//user register routes
Route::get('/register','Frontend\Auth\RegisterController@showRegistrationForm')->name('fe.getRegisterForm');
Route::post('/register','Frontend\Auth\RegisterController@registerUser')->name('fe.registerUser');

//register confirmation routes
Route::get('register/confirmation/{userId}/{token}','Frontend\Auth\RegisterController@confirmRegister')->name('fe.confirmRegister');

//login routes
Route::get('/login','Frontend\Auth\LoginController@showLoginForm')->name('fe.getLoginForm');

Route::post('/login','Frontend\Auth\LoginController@login')->name('fe.login');

Route::post('/logout', 'Frontend\Auth\LoginController@logout')->name('fe.logout');

//user password reset routes
Route::get('/password/reset', 'Frontend\Auth\UserForgotPasswordController@showLinkRequestForm')->name('user.password.request');
Route::post('/password/email', 'Frontend\Auth\UserForgotPasswordController@sendResetLinkEmail')->name('user.password.email');

Route::get('/password/reset/{token}', 'Frontend\Auth\UserResetPasswordController@showResetForm')->name('user.password.reset');
Route::post('/password/reset', 'Frontend\Auth\UserResetPasswordController@reset')->name('user.password.update');

//social controller routes
Route::get('auth/redirect/{provider}', 'Frontend\Auth\SocialController@handleRedirect')->name('social.redirect');
Route::get('auth/callback/{provider}', 'Frontend\Auth\SocialController@handleCallback');

//blogs routes
Route::get('blogs','Frontend\BlogListingController@getAllBlogs')->name('fe.blogs');
Route::get('blogs/single/{slug}','Frontend\BlogListingController@getSingleBlog')->name('fe.blogs.single');
Route::get('blogs/category/{slug}','Frontend\BlogListingController@getBlogsByCategory')->name('fe.category.blogs');
Route::get('blogs/tags/{slug}','Frontend\BlogListingController@getBlogsByTag')->name('fe.tag.blogs');

//price detail routes
Route::get('price-detail','Frontend\PageController@getPricingPage')->name('fe.pricingDetail');

//privacy policy routes
Route::get('privacy-policy','Frontend\PageController@getPrivacyPolicyPage')->name('fe.policy');

//price detail routes
Route::get('terms-conditions','Frontend\PageController@getTermsAndConditiosPage')->name('fe.conditions');

//store subscribers
Route::post('subscribe','Frontend\PageController@storeSubscriber')->name('fe.storeSubscriber');
Route::get('subscribe/confirmation/{token}','Frontend\PageController@confirmSubscription')->name('fe.confirmSubscription');

//emi calculator
Route::get('calculate-emi','Frontend\PageController@calculateEmi')->name('fe.emi');

// property maps
Route::get('property-map','Frontend\PageController@showPropertyMap')->name('fe.property.map');

//only user
Route::group(['middleware'=>['user-manager']], function () {

    //user profile controller
    Route::get('profile','Frontend\UserProfileController@getProfile')->name('user.profile');
    Route::put('profile','Frontend\UserProfileController@updateBasicInfo')->name('user.updateProfile');
    Route::post('profile/contact','Frontend\UserProfileController@updateContact')->name('user.updateContact');
    Route::put('/password','Frontend\UserProfileController@updatePassword')->name('user.updatePassword');
    Route::put('/social','Frontend\UserProfileController@udpateSocialLinks')->name('user.updateSocial');

    //property floor plan routes
    Route::post('/property/{propertyId}/floors/store','Frontend\Property\PropertyFloorPlanController@storeFloor')->name('users.floors.store');
    Route::get('/property/{propertyId}/floors/{floorId}/Edit','Frontend\Property\PropertyFloorPlanController@editFloor')->name('users.floors.edit');
    Route::put('/property/{propertyId}/floors/{floorId}','Frontend\Property\PropertyFloorPlanController@updateFloor')->name('users.floors.update');
    Route::delete('/property/{propertyId}/floors/{floorId}','Frontend\Property\PropertyFloorPlanController@deleteFloor')->name('users.floors.delete');

    //property information routes
    Route::post('/property/{propertyId}/info','Frontend\Property\PropertyInformationController@updatePropertyInformation')->name('users.property.info.store');

    //property document  routes
    Route::delete('/documents/file/delete/{id}/{column}','Frontend\Property\PropertyDocumentController@deleteDocument')->name('user.property.files.destroy');

    Route::post('/property/{propertyId}/documents','Frontend\Property\PropertyDocumentController@storeDocument')->name('user.property.files.store');

    //property request Manager Routes
    Route::get('/property/managers','Frontend\Property\PropertyManagerController@listManagers')->name('user.property.manager.index');
    Route::post('/property/managers/request','Frontend\Property\PropertyManagerController@requestManager')->name('user.property.manager.request');
    Route::get('/property/{propertySlug}/managers','Frontend\Property\PropertyManagerController@editManager')->name('user.property.manager.edit');
    Route::put('/property/{propertySlug}/managers','Frontend\Property\PropertyManagerController@updateManager')->name('user.property.manager.update');
    Route::delete('/property/{propertySlug}/managers','Frontend\Property\PropertyManagerController@deleteManager')->name('user.property.manager.delete');

    //property review route
    Route::post('property/{id}/reviews','Frontend\Property\PropertyReviewController@storePropertyReview')->name('fe.store.property.review');

    //property routes
    Route::delete('/property/featured/image/delete/{id}','Frontend\Property\PropertyController@deleteFeaturedImage')->name('user.property.single.images.destroy');
    Route::delete('/property/image/delete/{id}','Frontend\Property\PropertyController@deleteImages')->name('user.property.images.destroy');
    Route::get('property','Frontend\Property\PropertyController@index')->name('user.property.index');
    Route::get('property/create','Frontend\Property\PropertyController@createProperty')->name('user.property.create');
    Route::post('property','Frontend\Property\PropertyController@storeProperty')->name('user.property.store');
    Route::get('property/{slug}/edit','Frontend\Property\PropertyController@editProperty')->name('user.property.edit');
    Route::put('property/{slug}/update','Frontend\Property\PropertyController@updateProperty')->name('user.property.update');
    Route::delete('property/{slug}/delete','Frontend\Property\PropertyController@deleteProperty')->name('user.property.delete');

    //get requests property by guest
    Route::get('property/requests/{property}','Frontend\Property\PropertyRequestController@getAllRequests')->name('fe.user.property.requests');
    Route::get('property/requests/{property}/{requestId}','Frontend\Property\PropertyRequestController@getSingleRequest')->name('fe.user.property.requests.single');

    //mark property as favourite
    Route::get('property/mark-favourite/{property}','Frontend\Property\FavouritePropertyController@toggleFavourite')->name('fe.user.property.markFavourite');

    //list fav properties
    Route::get('favourite-properties','Frontend\Property\FavouritePropertyController@getAllFavProperties')->name('fe.user.property.favourites');

    //remove fav property
    Route::delete('favourite-property/remove/{property}','Frontend\Property\FavouritePropertyController@removeFavProperty')->name('fe.user.property.favourites.remove');


    //request property verification routes
    Route::get('request/{property}/verification','Frontend\Property\PropertyVerificationRequestController@requestVerification')->name('request.property.verification');

    //request property featured routes
    Route::get('request/{property}/featured','Frontend\Property\PropertyVerificationRequestController@requestFeaturing')->name('request.property.featuring');

    //request to be manager route
    Route::get('request/to-be/manager','Frontend\RequestToBeManagerController@sendRequest')->name('user.request.manager');

    //notifications routes
    Route::get('/notifications','Frontend\UserNotificationController@getAllNotifications')->name('user.notifications');
    Route::get('/notifications/markAllRead','Frontend\UserNotificationController@markAllRead')->name('user.notifications.markAllRead');
    Route::get('/notifications/markRead/{id}','Frontend\UserNotificationController@markAsRead')->name('user.notifications.markAllRead.single');

    //blog review
    Route::post('blogs/reviews/{slug}','Frontend\BlogListingController@storeBlogReview')->name('fe.blog.review.store');

});

Route::group(['middleware'=>['isOnlyManager']], function () {
    //show managers property route
    Route::get('managed/properties','Frontend\Property\ManagersPropertyController@managedProperties')->name('manager.property.index');

});


/*Route::get('test-mail','Frontend\Auth\RegisterController@testMail')->name('fe.testMail');*/

Route::get('map',function (){

    return view('frontend.mapcluster-test');
});
Route::get('error-page',function (){

    return view('frontend.pages.errors.error');
});
