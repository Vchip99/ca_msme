<?php

//admin
Route::get('admin/login', 'AdminAuth\LoginController@showLoginForm');
Route::post('admin/login', 'AdminAuth\LoginController@login');
Route::post('admin/logout', 'AdminAuth\LoginController@logout');

Route::get('admin/home', 'Admin\AdminController@home');
Route::get('admin/enquiry/{orderId}', 'Admin\AdminController@enquiry');
Route::post('admin/msme-update', 'Admin\AdminController@msmeUpdate');

Route::delete('admin/deleteOrder', 'Admin\AdminController@deleteOrder');
Route::post('admin/changeOrderStatus', 'Admin\AdminController@changeOrderStatus');
Route::post('admin/changePaymentStatus', 'Admin\AdminController@changePaymentStatus');
Route::post('admin/searchByArr', 'Admin\AdminController@searchByArr');
Route::post('admin/searchByOrderId', 'Admin\AdminController@searchByOrderId');
Route::get('admin/all-payments', 'Admin\AdminController@allPayments');
Route::get('admin/update-admin', 'Admin\AdminController@showAdmin');
Route::put('admin/update-admin', 'Admin\AdminController@updateAdmin');
Route::post('admin/assign-subadmin', 'Admin\AdminController@assignSubAdmin');
Route::get('admin/download-excel-records', 'Admin\AdminController@downloadExcelRecords');


Route::get('admin/sub-admin', 'Admin\SubAdminController@show');
Route::get('admin/createSubAdmin', 'Admin\SubAdminController@create');
Route::post('admin/createSubAdmin', 'Admin\SubAdminController@store');
Route::get('admin/sub-admin/{id}/edit', 'Admin\SubAdminController@edit');
Route::put('admin/updateSubAdmin', 'Admin\SubAdminController@update');
Route::delete('admin/deleteSubadmin', 'Admin\SubAdminController@delete');

//user login
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
Route::post('register', 'Auth\RegisterController@register');
Route::get('forgotPassword', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('track-order', 'HomeController@trackStatus');
Route::post('track-order', 'HomeController@showStatus');
Route::get('track-order/{orderId}', 'HomeController@showTrackOrder');
Route::get('faq', 'HomeController@showFaq');
Route::get('contact-us', 'HomeController@contactUs');
Route::post('contact-us', 'HomeController@sendContactUsEmail');
Route::get('career', 'HomeController@career');
Route::post('send-resume', 'HomeController@sendResume');
Route::get('terms-and-conditions', 'HomeController@termsAndConditions');
Route::get('privacy-policy', 'HomeController@privacyPolicy');
Route::get('disclaimer-policy', 'HomeController@disclaimerPolicy');
Route::get('refund-policy', 'HomeController@refundPolicy');
Route::get('about-us', 'HomeController@aboutUs');
Route::post('enquiry', 'HomeController@enquiryEmail');

Route::get('/', 'MsmeController@create');
Route::get('home', 'MsmeController@create');
Route::get('registration', 'MsmeController@create');
Route::post('registration', 'MsmeController@store');
Route::get('thankyouMsmeRegistration', 'MsmeController@thankyouMsmeRegistration');
Route::post('webhookMsmeRegistration', 'MsmeController@webhookMsmeRegistration');

Route::get('dashboard', 'AccountController@home');
Route::get('enquiry/{orderId}', 'AccountController@enquiry');