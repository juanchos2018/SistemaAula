<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\VsBankerController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VsEmploxController;
use App\Http\Controllers\VsSecmatController;
use App\Http\Controllers\VsStudentController;
use App\Http\Controllers\VsAbsentController;
use App\Http\Controllers\VsNotifyController;
use App\Http\Controllers\VsChedulController;
use App\Http\Controllers\VsLibstdController;
use App\Http\Controllers\VsLibsecController;
use App\Http\Controllers\VsActsavController;
use App\Http\Controllers\VsAcmatController;
use App\Http\Controllers\VsTablesController;
use App\Http\Controllers\VsEctionController;
use App\Http\Controllers\VsDefaultController;


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


Route::post('/authenticates', [AuthController::class, 'authenticate']);

Route::get('/objeto', [AuthController::class, 'Message']);

Route::get('/bankers',[VsBankerController::class, 'index']);
Route::get('/session',[AuthController::class, 'verifiqueSession']);

Route::group(['prefix' => 'vsemblox'], function()
{
    
    Route::get('/records/{search}',[VsEmploxController::class, 'index']);    
    Route::get('/record/{EMP_NO}',[VsEmploxController::class, 'record']);    
    Route::post('/store',[VsEmploxController::class, 'store']);    
    Route::get('/excel', [VsEmploxController::class, 'exportExcel']);
    Route::get('/pdf', [VsEmploxController::class, 'exportPdf']);
});


Route::group(['prefix' => 'vssecmat'], function(){
  
    Route::get('/records/{search?}',[VsSecmatController::class, 'index']);
    Route::get('/excel', [VsSecmatController::class, 'exportExcel']);
    Route::get('/pdf',   [VsSecmatController::class, 'exportPdf']);
    Route::post('/store',[VsSecmatController::class, 'store']);    
    Route::post('/vsdupmat',[VsSecmatController::class, 'vsdupmat']);    
});


Route::group(['prefix' => 'vsstudent'], function()
{
    Route::get('/records/{search}',[VsStudentController::class, 'index']);
    Route::get('/excel', [VsStudentController::class, 'exportExcel']);
    Route::get('/pdf',   [VsStudentController::class, 'exportPdf']);
   
});

Route::group(['prefix' => 'vsabsent'], function()
{
    Route::get('/records/{search}',[VsAbsentController::class, 'index']);
    Route::get('/excel', [VsAbsentController::class, 'exportExcel']);
    Route::get('/pdf',   [VsAbsentController::class, 'exportPdf']);
   
});

Route::group(['prefix' => 'vsnotify'], function()
{
    Route::get('/records/{search}',[VsNotifyController::class, 'index']); 
   
});

Route::group(['prefix' => 'vschedul'], function()
{
    Route::get('/records/{search}',[VsChedulController::class, 'index']); 
    Route::get('/excel', [VsChedulController::class, 'exportExcel']);
    Route::get('/pdf',   [VsChedulController::class, 'exportPdf']);
   
});

Route::group(['prefix' => 'vslibstd'], function()
{
    Route::get('/records/{search}',[VsLibstdController::class, 'index']); 
   
});

Route::group(['prefix' => 'vslibsec'], function()
{
    Route::get('/records/{search}',[VsLibsecController::class, 'index']); 
   
});

Route::group(['prefix' => 'vsactsav'], function()
{
    Route::get('/records/{search}',[VsActsavController::class, 'index']); 
    Route::get('/excel', [VsActsavController::class, 'exportExcel']);
    Route::get('/pdf',   [VsActsavController::class, 'exportPdf']);
   
});


Route::group(['prefix' => 'vsacmat'], function()
{
    Route::get('/records/{search}',[VsAcmatController::class, 'index']); 
   
});

Route::group(['prefix' => 'vstables'], function()
{
    Route::get('/records/{tabla}',[VsTablesController::class, 'selectTable']); 
   
});

Route::group(['prefix' => 'vsdefault'], function()
{
    Route::get('/default',[VsDefaultController::class, 'default']); 
   
});

Route::group(['prefix' => 'vsection'], function()
{
    Route::get('/selectVsection',[VsEctionController::class, 'selectVsection']); 
    Route::get('/selectVsmatter',[VsEctionController::class, 'selectVsmatter']); 
    Route::get('/selectVsemplox',[VsEctionController::class, 'selectVsemplox']); 
    Route::get('/oneVssecmat/{SEC_ID}',[VsEctionController::class, 'oneVssecmat']); 
   
});


Route::get('/{any}', [ApplicationController::class, 'index'])->where('any', '.*');


//Route::get('/bankers', 'VsBankerController@Index');