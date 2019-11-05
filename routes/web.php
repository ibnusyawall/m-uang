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

Route::group(['middleware'=>'auth'], function(){
	
	// Home Dashboard
	Route::get('/', 'Sumber_controller@home');
	
	// sumber pemasukan 
	Route::get('sumber-pemasukan', 'Sumber_controller@index');
	Route::get('sumber-pemasukan/add', 'Sumber_controller@add');
	Route::post('sumber-pemasukan/add', 'Sumber_controller@store');
	Route::get('sumber-pemasukan/{id}', 'Sumber_controller@edit');
	Route::put('sumber-pemasukan/{id}', 'Sumber_controller@update');
	Route::delete('sumber-pemasukan/{id}', 'Sumber_controller@delete');

	// pemasukan 
	Route::get('pemasukan', 'Pemasukan_controller@index');
	Route::get('pemasukan/yajra', 'Pemasukan_controller@yajra');
	Route::get('pemasukan/tambah', 'Pemasukan_controller@tambah');
	Route::post('pemasukan/tambah', 'Pemasukan_controller@store');
	Route::get('pemasukan/{id}', 'Pemasukan_controller@edit');
	Route::put('pemasukan/{id}', 'Pemasukan_controller@update');
	Route::delete('pemasukan/{id}','Pemasukan_controller@delete');
	
	// pengeluaran
	Route::get('pengeluaran', 'Pengeluaran_controller@index');
	Route::get('pengeluaran/tambah', 'Pengeluaran_controller@tambah');
	Route::post('pengeluaran/tambah', 'Pengeluaran_controller@store');
	Route::get('pengeluaran/{id}', 'Pengeluaran_controller@edit');
	Route::put('pengeluaran/{id}', 'Pengeluaran_controller@update');
	Route::delete('pengeluaran/{id}', 'Pengeluaran_controller@delete');

	//  Laporan
	Route::get('laporan-keuangan', 'Laporan_controller@index');
	Route::get('cari-laporan', 'Laporan_controller@cari');
	Route::get('export-pemasukan/{dari}/{sampai}', 'Laporan_controller@export_pemasukan');
	Route::get('export-pengeluaran/{dari}/{sampai}', 'Laporan_controller@export_pengeluaran');

	});

Route::get('/setup', function(){
	\DB::table('users')->insert([
		// set username
		'name'=>'admin',
		// set email
		'email'=>'admin@localhost.com',
		// set password
		'password'=>bcrypt('admin'),
		'created_at'=>date('Y-m-d H-i-s'),
		'updated_at'=>date('Y-m-d H-i-s')
	]); return redirect('/');
});

Auth::routes();

Route::get('/home', function(){
	return redirect('/');
});

Route::get('/keluar', function(){
	\Auth::logout();
	return redirect('login');
});
