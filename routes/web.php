<?php
use App\graph;
use Carbon\Carbon; 

use App\Mail\ApprovedMail;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'staff'], function () {
Route::get('/home', 'HomeController@index');
Route::post('/add', 'HomeController@add_validate');
Route::get('/add-view', 'HomeController@add');
Route::post('/add/post', 'HomeController@add_post');
Route::get('/requests', 'HomeController@requests');
Route::get('/report', 'HomeController@reports');
Route::get('/requests/follow-up/32789{id}43789721', 'HomeController@follow');
Route::get('/requests/follow-up/32789{id}43789721/edit', 'HomeController@edit_budget');
Route::post('/requests/follow-up/32789{id}43789721/edit/post', 'HomeController@update_budget');
Route::get('/requests/follow-up/32789{id}43789721/settle', 'HomeController@settle');
Route::post('/requests/follow-up/32789{id}43789721/settle/post', 'HomeController@settle_post');
Route::post('/requests/follow-up/32789{id}43789721/remarks/post', 'HomeController@remarks_post');
Route::post('/requests/follow-up/32789{id}43789721/push/post', 'HomeController@push_forward_post');
Route::get('/requests/follow-up/32789{id}43789721/feedback', 'HomeController@implementation');
Route::post('/requests/follow-up/32789{id}43789721/feedback-post', 'HomeController@implementation_post');
});



//Approver
Route::group(['middleware' => 'approver'], function () {

Route::get('/approved/',function () {
    return view('approved');
});
Route::get('/approver', 'ApproversController@home');
Route::get('/approver/requests', 'ApproversController@budget_requests');
Route::get('/approver/settle', 'ApproversController@settle');
Route::get('/approver/settle/view9273829{id}22938292', 'ApproversController@settle_view');
Route::get('/approver/remarks/approve/83921283{id}83930293', 'ApproversController@settle_post');
Route::get('approver/requests/follow-up/32789{id}43789721/edit', 'ApproversController@edit_budget');
Route::post('approver/32789{id}43789721/edit/post', 'ApproversController@edit_budget_post');
Route::get('/approver/view/32789{id}43789721', 'ApproversController@view');
Route::get('approver/reports', 'ApproversController@report');
Route::get('/approve/329382329383293823983238{id}874393239328923982378923782739237', 'ApproversController@approve');
Route::post('/approve/329382329383293823983238{id}874393239328923982378923782739237/go', 'ApproversController@approve_post');
Route::post('/approve/329382329383293823983238{id}874393239328923982378923782739237/reject', 'ApproversController@reject_post');
Route::post('/approve/329382329383293823983238{id}874393239328923982378923782739237/return', 'ApproversController@return_post');

});



//Admin
Route::group(['middleware' => 'admin'], function () {
Route::get('/admin', 'AdminController@home');
//Route::resource('/create-user-post', 'AdminController@store');
Route::get('/admin/register-user', 'AdminController@create_user');
Route::get('admin/users', 'AdminController@users');
Route::get('admin/{id}/edit', 'AdminController@edit');
Route::post('admin/{id}/edit/post', 'AdminController@update');
Route::post('admin/{id}/user/delete', 'AdminController@destroy');
Route::get('/admin/limits', 'LimitsController@index');
Route::get('/admin/reports', 'AdminController@reports');
Route::get('/admin/reports', 'AdminController@reports');
Route::get('/admin/upload', 'AdminController@upload');
Route::get('/admin/requests', 'AdminController@requests');
Route::get('/admin/branches', 'AdminController@branches');
Route::get('/admin/limit/{id}/edit', 'LimitsController@edit');
Route::post('/admin/limit/{id}/edit/post', 'LimitsController@update');
Route::get('/admin/limit/{id}/reset', 'LimitsController@reset');
});




//Auditor
Route::group(['middleware' => 'auditor'], function () {

Route::get('/auditor', 'AuditorController@home');
Route::get('/auditor/requests', 'AuditorController@budget_requests');
Route::get('/auditor/report', 'AuditorController@report');
Route::get('/auditor/settle', 'AuditorController@settle');
Route::get('/auditor/balance', 'AuditorController@balance');
Route::get('/auditor/settle/view9273829{id}22938292', 'AuditorController@settle_view');
Route::get('/auditor/view/32789{id}43789721', 'AuditorController@view');
});

Route::get('/view-file-738283873764671737{id}93624163535261', 'HomeController@download_file');

Route::get('/change-password', 'AdminController@change_password');
Route::post('/change-password/go', 'AdminController@change_password_post');

Route::get('/error',function () {
    return view('errors.blocked');
});

Route::get('/exception',function () {
    return view('errors.exception');
});

Route::get('/page-not-found',function () {
    return view('errors.page_not_found');
});




//testing
Route::get('/mail',function () {
    
        Mail::to("luis@gmail.com")->send(new ApprovedMail());
});

Route::get('file/',function () {
    
        return view('file');

})->name('index');

Route::post('import', 'HomeController@import')->name('import');
