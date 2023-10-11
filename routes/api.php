<?php

use Illuminate\Http\Request;

Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

Route::group(['middleware' => ['jwt.verify']], function ()
{
    Route::group(['middleware' => ['api.superadmin']], function ()
    {

        Route::delete('/kelas/{id_kelas}', 'KelasController@destroy');
        Route::delete('/siswa/{id}', 'SiswaController@destroy');
        Route::delete('/pembayaran/{id_pembayaran}', 'PembayaranController@destroy');
        Route::delete('/petugas/{id_petugas}', 'PetugasController@destroy');
        Route::delete('/spp/{id_spp}', 'SppController@destroy');
    });

    Route::group(['middleware' => ['api.admin']], function ()
    {

    Route::post('/kelas', 'KelasController@store');
    Route::put('/kelas/{id_kelas}', 'KelasController@update');

    Route::post('/siswa', 'SiswaController@store');
    Route::put('/siswa/{id}', 'SiswaController@update');

    Route::post('/pembayaran', 'PembayaranController@store');
    Route::put('/pembayaran/{id_pembayaran}', 'PembayaranController@update');

    Route::post('/petugas', 'PetugasController@store');
    Route::put('/petugas/{id_petugas}', 'PetugasController@update');

    Route::post('/spp', 'SppController@store');
    Route::put('/spp/{id_spp}', 'SppController@update');
    });    
    Route::get('/kelas', 'KelasController@show');
    Route::get('/siswa', 'SiswaController@show');
    Route::get('/siswa/{id}', 'SiswaController@detail');
    Route::get('/pembayaran', 'PembayaranController@show');
    Route::get('/pembayaran/{id_pembayaran}', 'PembayaranController@detail');

    Route::get('/petugas', 'PetugasController@show');

    Route::get('/spp', 'SppController@show');
    });



