<?php

use App\Models\Monitoring;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RealtimeController;
use App\Http\Controllers\WorkorderController;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\Operator\ScheduleController;
use App\Http\Controllers\Operator\ProductionController;
use App\Http\Controllers\Supervisor\SpvProductionController;

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

//
// Realtime Controller Route
//
Route::middleware(['verified'])->group(function(){
    Route::get('/', [RealtimeController::class,'index'])->name('home');
    Route::get('/ajaxRequest',[RealtimeController::class,'ajaxRequest'])->name('realtime.ajaxRequest');
    Route::get('/ajaxRequestAll', [RealtimeController::class,'ajaxRequestAll'])->name('realtime.ajaxRequestAll');
    Route::get('/workorderOnProcess', [RealtimeController::class,'workorderOnProcess'])->name('realtime.workorderOnProcess');
    Route::post('/searchSpeed',[RealtimeController::class,'searchSpeed'])->name('realtime.searchSpeed');
});

//
// Daily Report Controller Route
//
Route::middleware(['verified'])->group(function(){
    Route::get('/dailyReport',[DailyReportController::class,'index'])->name('dailyReport.index');
    Route::get('/dailyReport/ajaxRequestAll',[DailyReportController::class,'ajaxRequestAll'])->name('dailyReport.ajaxRequestAll');
    Route::get('/dailyReport/getCustomFilterData',[DailyReportController::class,'getCustomFilterData'])->name('dailyReport.getCustomFilterData');
    Route::post('/dailyReport/calculateSearchResult',[DailyReportController::class,'calculateSearchResult'])->name('dailyReport.calculateSearchResult');
});

//
// Workorder Controller Route
//
Route::middleware(['verified'])->group(function(){
    Route::get('/workorder',[WorkorderController::class,'index'])->name('workorder.index');
    Route::get('/workorder/ajaxRequestWorkorder',[WorkorderController::class,'ajaxRequestAll'])->name('workorder.ajaxRequestAll');
    Route::get('/workorder/details',[WorkorderController::class,'show'])->name('workorder.details');
    Route::post('/workorder/getDowntime',[WorkorderController::class,'getDowntime'])->name('workorder.getDowntime');
    Route::post('/workorder/getOee',[WorkorderController::class,'getOee'])->name('workorder.getOee');
    Route::get('/workorder/dataonprocess',[DataController::class,'workordersOnProcess'])->name('workorder.dataonprocess');
    Route::get('/workorder/dataclosed',[DataController::class,'workordersClosed'])->name('workorder.dataclosed');
});

//
// Report Controller Route
//
Route::middleware(['verified'])->group(function(){
    Route::get('/report/{wo_id}/printToPdf',[ReportController::class,'displayToPdf']);
    Route::get('/report/{wo_id}/printPage',[ReportController::class,'printPage']);
});

//
// Schedule Controller Route
//
Route::middleware(['verified'])->group(function(){
    Route::get('/operator/schedule',[ScheduleController::class,'index'])->name('schedule.index');
    Route::post('/operator/schedule/{id}/process',[ScheduleController::class,'process']);
	Route::post('/operator/schedule/{id}/check',[ScheduleController::class,'check']);
    Route::get('/operator/showWaiting',[ScheduleController::class,'showWaiting'])->name('workorder.showWaiting');
    //Route::get('/operator/showOnProcess',[ScheduleController::class,'showOnProcess'])->name('workorder.showOnProcess');
	Route::get('/operator/showOnProcess',[ScheduleController::class,'showOnProcess_2'])->name('workorder.showOnProcess');
	Route::get('/operator/showOnCheck',[ScheduleController::class,'showOnCheck'])->name('workorder.showOnCheck');
});

//
// Production Controller Route
//
Route::middleware(['verified'])->group(function(){
    Route::get('/operator/production',[ProductionController::class,'index'])->name('production.index');
    Route::post('/operator/production/store',[ProductionController::class,'store'])->name('production.store');
    Route::post('/operator/production/getSmeltingNum',[ProductionController::class,'getSmeltingNum'])->name('production.getSmeltingNum');
    Route::post('/operator/production/storeOee',[ProductionController::class,'storeOee'])->name('production.storeOee');
    Route::post('/operator/production/getProductionInfo',[ProductionController::class,'getProductionInfo'])->name('production.getProductionInfo');
});

 

//
// Production Controller Route
//
Route::middleware(['verified'])->group(function(){
    Route::get('/supervisor/production',[ProductionController::class,'spvindex'])->name('spvproduction.index');
	Route::get('/supervisor/production/{id}/show',[ProductionController::class,'spvshow'])->name('spvproduction.show');
 	Route::get('/operator/production/{id}/spvshow',[ProductionController::class,'spvshow'])->name('spvshow.show');
   Route::post('/supervisor/production/{id}/finish',[ProductionController::class,'finish'])->name('spvproduction.finish');
	Route::post('/supervisor/schedule/{id}/finish',[ScheduleController::class,'finish'])->name('spvschedule.finish');
	Route::get('/supervisor/production/show_details',[ProductionController::class,'spvshow'])->name('supervisor.production.show_details');
	Route::get('/operator/production/show_details',[ProductionController::class,'oprshow'])->name('operator.production.show_details');
	Route::post('/operator/schedule/{id}/check',[ScheduleController::class,'check'])->name('oprschedule.check');
});



//
// Help Controller Route
//
Route::middleware(['verified'])->controller(HelpController::class)->group(function(){
    route::get('/help','index')->name('help.index');
});

//
// Reset Password Controller
//
Route::middleware(['verified'])->controller(ChangePasswordController::class)->group(function(){
    Route::get('/change-password','index')->name('change.password.index');
    route::post('/change-password','store')->name('change.password');
});


//
// Downtime Controller
//
Route::middleware(['verified'])->controller(DowntimeController::class)->group(function(){
    Route::post('/update-downtime','updateDataDowntime')->name('downtime.updateDowntime');
});

//
// Downtime Remarks Controller
//
Route::middleware(['verified'])->controller(DowntimeRemarkController::class)->group(function(){
    Route::post('/submit-downtime-remark','submitDowntimeRemark')->name('downtimeRemark.submit');
});





