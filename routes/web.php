<?php
Route::get('/', "PageController@login")->name('login');
Route::post('request_login', 'AuthController@authenticate')->name('authenticate.login');
Route::get('auth_logout', 'AuthController@logout')->name('logout');
Route::middleware('auth')->group(function() {

Route::get('/home', "pageController@home")->name('index.home');
Route::post('myprofil/update',"PageController@update_profil")->name('update_profil');

Route::get("/instansi", "PageController@daftarinstansi"); // Menampilkan daftar instansi
Route::get("/instansi/create", "PageController@tambahinstansi"); // Menampilkan form tambah instansi
Route::post("/instansi/store", "PageController@store"); // Menambah dan Menyimpan data instansi
Route::get("/instansi/edit/{id}", "PageController@editinstansi"); // Menampilkan form edit
Route::put("/instansi/edit/{id}", "PageController@edit"); // Proses update data
Route::delete("/instansi/delete/{id}", "PageController@delete");

Route::get('/pembayaran', 'PageController@daftarpembayaran'); // Menampilkan daftar data pembayaran
Route::get('/pembayaran/create', 'PageController@formtambahpembayaran'); // Menampilkan form tambah data pembayaran
Route::post("/pembayaran/store", "PageController@storepembayaran"); // Menambah dan Menyimpan data instansi
Route::get("/pembayaran/edit/{id}", "PageController@formeditpembayaran"); // Menampilkan form edit
Route::put("/pembayaran/edit/{id}", "PageController@editpembayaran"); // Proses update data
Route::delete("/pembayaran/delete/{id}", "PageController@deletepembayaran");
Route::get("/manajemenpembayaran", "PageController@manajemenpembayaran");

Route::get("/tambahmahasiswa", "PageController@tambahmahasiswa");
Route::get("/formtambahmahasiswa", "PageController@formtambahmahasiswa");

Route::get('/va', 'PageController@daftarVA'); // Menampilkan daftar va berdasarkan instansi
Route::get("/va/detailva", "PageController@detailva"); //Menampilkan detail va mahasiswa suatu instansi
Route::post('/va/generate/{id}', 'PageController@generateVa')->name('va.generate'); //generate va mahasiswa

Route::get('/transaksi', 'PageController@daftarTransaksi'); // Menampilkan daftar va berdasarkan instansi
Route::post('/transaksi/verifikasi/{id}', 'PageController@verifikasiTransaksi')->name('transaksi.verifikasi');
Route::get("/logtransaksi", "PageController@logtransaksi")->name('logtransaksi');

Route::get('/logtransaksi/exportpdf', 'PdfController@exportPdf')->name('logtransaksi.exportpdf');

Route::get("/manajemen_pembayaran", "PageController@komponen_pembayaran")->name('index.komponen_pembayaran'); // Menampilkan komp pemb
Route::post("/manajemen_pembayaran/save", "PageController@save_komponen_pembayaran")->name('save_komponen_pembayaran');
Route::get("/manajemen_pembayaran/get_edit/{id_komponen_pembayaran}", "PageController@get_edit_komponen_pembayaran"); // Menampilkan komp pemb
Route::post("/manajemen_pembayaran/update", "PageController@update_komponen_pembayaran")->name('update_komponen_pembayaran');
Route::get("/manajemen_pembayaran/delete/{id_komponen_pembayaran}", "PageController@hapus_komponen_pembayaran");
});




