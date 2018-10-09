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

Route::get('/home', 'HomeController@index');
Route::get('/add', 'HomeController@add');
Route::post('/add/post', 'HomeController@add_post');
Route::get('/requests', 'HomeController@requests');
Route::get('/report', 'HomeController@reports');
Route::get('/requests/follow-up/32789{id}43789721', 'HomeController@follow');
Route::get('/requests/follow-up/32789{id}43789721/edit', 'HomeController@edit_budget');
Route::post('/requests/follow-up/32789{id}43789721/edit/post', 'HomeController@update_budget');
Route::get('/requests/follow-up/32789{id}43789721/settle', 'HomeController@settle');
Route::post('/requests/follow-up/32789{id}43789721/settle/post', 'HomeController@settle_post');
Route::post('/requests/follow-up/32789{id}43789721/remarks/post', 'HomeController@remarks_post');
Route::post('/requests/follow-up/32789{id}43789721/push/post', 'HomeController@forward_post');

Route::get('/approve/329382329383293823983238{id}874393239328923982378923782739237', 'HomeController@approve');
Route::post('/approve/329382329383293823983238{id}874393239328923982378923782739237/go', 'HomeController@approve_post');
Route::post('/approve/329382329383293823983238{id}874393239328923982378923782739237/reject', 'HomeController@reject_post');
Route::post('/approve/329382329383293823983238{id}874393239328923982378923782739237/return', 'HomeController@return_post');


Route::get('/approved/',function () {
    return view('approved');
});


//Approver
Route::get('/approver', 'ApproversController@home');
Route::get('/approver/requests', 'ApproversController@budget_requests');
Route::get('/approver/settle', 'ApproversController@settle');

Route::get('/approver/remarks/approve/83921283{id}83930293', 'ApproversController@settle_post');

Route::get('approver/requests/follow-up/32789{id}43789721/edit', 'ApproversController@edit_budget');
Route::post('approver/32789{id}43789721/edit/post', 'ApproversController@edit_budget_post');
Route::get('/approver/view/32789{id}43789721', 'ApproversController@view');
Route::get('approver/reports', 'ApproversController@report');



//Admin
Route::get('/admin', 'AdminController@home');
//Route::resource('/create-user-post', 'AdminController@store');

Route::get('/admin/register-user', 'AdminController@create_user');
Route::resource('admin/users', 'AdminController@users');
Route::get('/admin/limits', 'LimitsController@index');
Route::get('/admin/reports', 'AdminController@reports');
Route::get('/admin/reports', 'AdminController@reports');
Route::get('/admin/upload', 'AdminController@upload');
Route::get('/admin/requests', 'AdminController@requests');
Route::get('/admin/branches', 'AdminController@branches');
Route::get('/admin/limit/{id}/edit', 'LimitsController@edit');
Route::post('/admin/limit/{id}/edit/post', 'LimitsController@update');
Route::get('/admin/limit/{id}/reset', 'LimitsController@reset');


Route::get('/view-file-738283873764671737{id}93624163535261', 'HomeController@download_file');


Route::get('/change-password', 'AdminController@change_password');



Route::get('/mail',function () {
    
        Mail::to("luis@gmail.com")->send(new ApprovedMail());
});
