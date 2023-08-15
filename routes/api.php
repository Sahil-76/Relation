<?php

use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;
use App\Http\Controllers\dummyApi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("data",[dummyApi::class,'getData']);

Route::get("list/{id}",[DeviceController::class,'list']);
Route::get("list",[DeviceController::class,'list']);
Route::post("add",[DeviceController::class,'add']);
Route::put("update",[DeviceController::class,'update']);
Route::delete("delete/{id}",[DeviceController::class,'delete']);

Route::post("save",[DeviceController::class,'testData']);

Route::get("students",[StudentController::class,'index']);
Route::post("students",[StudentController::class,'store']);
Route::get("students/{id}",[StudentController::class,'show']);
Route::get("students/{id}/edit",[StudentController::class,'edit']);
Route::put("students/{id}/edit",[StudentController::class,'update']);
Route::delete("students/{id}/delete",[StudentController::class,'destroy']);