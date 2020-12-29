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



Route::group(['middleware' => ['auth', 'web']], function () {
    Route::get('danh-sach-tai-khoan-nha-truong', 'AccountController@index')->name('account.index');
    Route::get('danh-sach-tai-khoan-giao-vien', 'AccountController@index')->name('account.ds-gv');
    Route::get('danh-sach-tai-khoan-hoc-sinh', 'AccountController@index')->name('account.ds-hs');
    Route::post('thay-doi-trang-thai', 'AccountController@editStatus')->name('account.editStatus');
    Route::post('gop-tai-khoan', 'AccountController@gopTaiKhoan')->name('account-gop-tai-khoan');
    Route::get('them-tai-khoan-giao-vien', 'AccountController@createTeacher')->name('account.create-teacher');
    Route::get('them-tai-khoan-nha-truong', 'AccountController@createSchool')->name('account.create-school');
    Route::post('them-tai-khoan-nha-truong', 'AccountController@storeSchool')->name('account.store-school');

    Route::get('edit-admin/{id}','AccountController@getEditAdmin')->name('edit-admin');
    Route::post('update-admin/{id}','AccountController@editAdmin')->name('update-admin');
    Route::get('edit-giao-vien/{id}','AccountController@getEditTeacher')->name('edit-giao-vien');
    Route::post('update-giao-vien/{id}','AccountController@editTeacher')->name('update-giao-vien');
    Route::get('edit-hoc-sinh/{id}','AccountController@getEditHocSinh')->name('edit-hoc-sinh');
    Route::post('update-hoc-sinh/{id}','AccountController@editHocSinh')->name('update-hoc-sinh');
    Route::get('danh-sach-hoc-sinh-gop-tai-khoan/{id}','AccountController@listHocSinh')->name('danh-sach-hoc-sinh-gop-tai-khoan');
    Route::get('edit-tk-hoc-sinh/{id}','AccountController@editTkHocSinh')->name('edit-tk-hoc-sinh');
    Route::post('edit-tk-hoc-sinh/{id}','AccountController@updateTkHocSinh')->name('update-tk-hoc-sinh');
});
