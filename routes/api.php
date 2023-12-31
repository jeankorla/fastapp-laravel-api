<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentsController;


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

Route::get('/database-check', function (Request $request) {
    try {
        DB::connection()->getPdo();
        return response()->json(['message' => 'Database connection successful'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Database connection failed', 'error' => $e->getMessage()], 500);
    }
});

Route::resource('transaction', 'App\Http\Controllers\TransactionController');



Route::prefix('documents')->group(function () {
    Route::post('/create', [DocumentsController::class, 'create']);
    Route::get('/list/{page?}', [DocumentsController::class, 'listAll']);
    Route::get('/{documentId}', [DocumentsController::class, 'getById']);
    Route::post('/sign/{documentId}', [DocumentsController::class, 'signById']);
    Route::delete('/{documentId}', [DocumentsController::class, 'deleteById']);
});

Route::prefix('folders')->group(function () {
    Route::post('/create', [FoldersController::class, 'create']);
    Route::get('/list/{page?}', [FoldersController::class, 'listAll']);
    Route::get('/{folderId}', [FoldersController::class, 'getById']);
    Route::get('/contents/{folderId}/{page?}', [FoldersController::class, 'listContentsById']);
    Route::delete('/{folderId}', [FoldersController::class, 'deleteById']);
});
