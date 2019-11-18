<?php

use Illuminate\Http\Request;


Route::get('users/profile','UserController@profile')->middleware('auth:api');
Route::get('users/{id}','UserController@profileById')->middleware('auth:api');
Route::get('users','UserController@users');
Route::post('auth/register','AuthController@register');
Route::post('auth/login','AuthController@login');
Route::put('users/{users}','UserController@update')->middleware('auth:api');
Route::delete('users/{users}','UserController@delete')->middleware('auth:api');

Route::get('transaksi','TransaksiController@transaksi');
Route::get('transaksiById/{id}','TransaksiController@transaksiById');
Route::post('transaksi','TransaksiController@add')->middleware('auth:api');
Route::post('cariTransaksi','TransaksiController@cari');
Route::post('orderTransaksi','TransaksiController@order');
Route::put('transaksi/{transaksi}','TransaksiController@update')->middleware('auth:api');
Route::delete('transaksi/{transaksi}','TransaksiController@delete')->middleware('auth:api');

Route::get('akun','AkunController@akun');
Route::get('akunById/{id}','AkunController@akunById');
Route::post('akun','AkunController@add')->middleware('auth:api');
Route::put('akun/{akun}','AkunController@update')->middleware('auth:api');
Route::delete('akun/{akun}','AkunController@delete')->middleware('auth:api');

Route::get('kategori','KategoriController@kategori');
Route::get('kategoriById/{id}','KategoriController@kategoriById');
Route::post('kategori','KategoriController@add')->middleware('auth:api');
Route::put('kategori/{kategori}','KategoriController@update')->middleware('auth:api');
Route::delete('kategori/{kategori}','KategoriController@delete')->middleware('auth:api');

Route::get('subkategori','SubkategoriController@subkategori');
Route::get('subkategoriById/{id}','SubkategoriController@subkategoriById');
Route::post('subkategori','SubkategoriController@add')->middleware('auth:api');
Route::put('subkategori/{id}','SubkategoriController@update')->middleware('auth:api');
Route::delete('subkategori/{id}','SubkategoriController@delete')->middleware('auth:api');

Route::get('tag','TagController@tag');
Route::get('tagById/{id}','TagController@tagById');
Route::post('tag','TagController@add')->middleware('auth:api');
Route::put('tag/{id}','TagController@update')->middleware('auth:api');
Route::delete('tag/{id}','TagController@delete')->middleware('auth:api');
