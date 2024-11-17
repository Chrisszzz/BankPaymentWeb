<?php

Route::get("/instansi", "PageController@daftarinstansi"); // Menampilkan daftar instansi
Route::get("/instansi/create", "PageController@tambahinstansi"); // Menampilkan form tambah instansi
Route::post("/instansi/store", "PageController@store"); // Menambah dan Menyimpan data instansi
Route::get("/instansi/edit/{id}", "PageController@editinstansi"); // Menampilkan form edit
Route::put("/instansi/edit/{id}", "PageController@edit"); // Proses update data
Route::delete("/instansi/delete/{id}", "PageController@delete");
