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
//Route::get('/', function () {
//    return view('welcome');
//});
//mysql事务测试
Route::get('test', 'TestController@test');

Auth::routes();

Route::group(['middleware'=>['auth','show_count']],function (){

//      首页设置
    Route::get('/', 'HistroyController@index'); //首页
    Route::get('/home', 'HistroyController@index');  //auth自动导入的home

//      用户:私人审批表
    Route::get('/selfs/destroyAll','SelfController@destroyAll')->name('self.destroyAll'); //todo 删除临时审批表下本用户的文件信息
    Route::resource('/selfs', 'SelfController');
    Route::post('/inputFile', 'SelfController@inputFile')->name('self.input')->middleware('throttle:5,1'); //用户选择文件并加入临时审批表, 1分钟只能选择提交5次

//      历史表
    Route::get('/histroy/download/{path}', 'HistroyController@download')->name('histroy.download');
    Route::resource('/histroy', 'HistroyController');

//      人力资源
    Route::get('/humans/download/{path}', 'HumansController@download')->middleware('throttle:5,1');  //维护员等下载文件
    Route::post('/humans/delete', 'HumansController@deleteFile');  //对已上传文件的删除行为
    Route::resource('humans', 'HumansController');

//      资质
    Route::group(['namespace'=>'Credentials'], function (){
        Route::group(['middleware'=>'credentials_basic'],function (){
            Route::get('/credentials_basic/download/{path}', 'CredentialBasicController@download')->middleware('throttle:5,1');
            Route::post('/credentials_basic/delete', 'CredentialBasicController@deleteFile');
            Route::resource('credentials_basic', 'CredentialBasicController');
        });
        Route::group(['middleware'=>'credentials_1'],function (){
            Route::get('/credentials_1/download/{path}', 'Credential1sController@download')->middleware('throttle:5,1');
            Route::post('/credentials_1/delete', 'Credential1sController@deleteFile');
            Route::resource('credentials_1', 'Credential1sController');
        });
        Route::group(['middleware'=>'credentials_2'],function (){
            Route::get('/credentials_2/download/{path}', 'Credential2sController@download')->middleware('throttle:5,1');
            Route::post('/credentials_2/delete', 'Credential2sController@deleteFile');
            Route::resource('credentials_2', 'Credential2sController');
        });
        Route::group(['middleware'=>'credentials_3'],function (){
            Route::get('/credentials_3/download/{path}', 'Credential3sController@download')->middleware('throttle:5,1');
            Route::post('/credentials_3/delete', 'Credential3sController@deleteFile');
            Route::resource('credentials_3', 'Credential3sController');
        });
        Route::group(['middleware'=>'credentials_4'],function (){
            Route::get('/credentials_4/download/{path}', 'Credential4sController@download')->middleware('throttle:5,1');
            Route::post('/credentials_4/delete', 'Credential4sController@deleteFile');
            Route::resource('credentials_4', 'Credential4sController');
        });
        Route::group(['middleware'=>'credentials_5'],function (){
            Route::get('/credentials_5/download/{path}', 'Credential5sController@download')->middleware('throttle:5,1');
            Route::post('/credentials_5/delete', 'Credential5sController@deleteFile');
            Route::resource('credentials_5', 'Credential5sController');
        });
        Route::group(['middleware'=>'credentials_6'],function (){
            Route::get('/credentials_6/download/{path}', 'Credential6sController@download')->middleware('throttle:5,1');
            Route::post('/credentials_6/delete', 'Credential6sController@deleteFile');
            Route::resource('credentials_6', 'Credential6sController');
        });
    });
//      专利&软件著作权
    Route::group(['middleware'=>'patent'],function () {
        Route::get('/patents/download/{path}', 'PatentsController@download')->middleware('throttle:5,1');
        Route::post('/patents/delete', 'PatentsController@deleteFile');
        Route::resource('patents', 'PatentsController');
    });
    Route::group(['middleware'=>'soft'],function () {
        Route::get('/softs/download/{path}', 'SoftCertificatesController@download')->middleware('throttle:5,1');
        Route::post('/softs/delete', 'SoftCertificatesController@deleteFile');
        Route::resource('softs', 'SoftCertificatesController');
    });

//      审批
    Route::post('manage/pass', 'ManageController@pass')->name('manage.pass');
    Route::post('manage/reject', 'ManageController@reject')->name('manage.reject');
    Route::resource('manage', 'ManageController');

//      文件检索
    Route::any('/search', 'SearchController@search')->name('search.search')->middleware('throttle:5,1'); //每分钟只允许搜索5次

//      系统/用户/权限
    Route::get('users/reset/{id}', 'UserController@reset')->name('users.reset');  //重置密码
    Route::post('users/editpassword', 'UserController@editPassword')->name('users.editpassword'); //修改面膜
    Route::post('users/selectusers', 'UserController@selectUsers')->name('users.selectusers');  //搜索/筛选用户

    Route::resource('users','UserController');
    Route::resource('roles', 'RolesController');
    Route::resource('perms', 'PermissionsController');
});


