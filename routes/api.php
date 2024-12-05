<?php

use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/va', 'APIController@listVa'); // GET: Menampilkan semua data VA
Route::get('/va/{no_va}', 'APIController@detailVa'); // GET: Menampilkan detail data VA berdasarkan nomor VA
Route::get('/tagihan', 'APIController@getTagihan');       // GET: Menampilkan data tagihan
Route::post('/tagihan', 'APIController@createTagihan');   // POST: Membuat tagihan baru
Route::put('/tagihan/{id}', 'APIController@updateTagihan'); // PUT: Mengupdate tagihan
Route::delete("/tagihan/{id}", "APIController@deleteTagihan"); // DELETE: Delete tagihan


