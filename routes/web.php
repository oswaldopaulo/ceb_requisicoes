<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();







Route::get('/', 'RequisicoesController@index');
Route::get('/home', 'RequisicoesController@index');

Route::get('/test', 'OpenController@getItens');
Route::get('/getitem/{id}', 'OpenController@getItem');
Route::get('/getestrutura', 'OpenController@getEstrutura');
Route::get('/getestoque', 'OpenController@getEstoque');
Route::get('/getid', 'RequisicoesController@getId');

Route::any('/dashboard', 'RequisicoesController@index');

Route::get('usuarios', 'UsuariosController@index');
Route::get('usuarios/novo', 'UsuariosController@novo');
Route::post('usuarios/novo', 'UsuariosController@insert');
Route::get('usuarios/editar/{id}', 'UsuariosController@editar');
Route::post('usuarios/editar', 'UsuariosController@update');
Route::get('usuarios/remove/{id}', 'UsuariosController@remove')->where('id','[0-9]+');



Route::get('requisicoes', 'RequisicoesController@index');
Route::get('requisicoes/novo', 'RequisicoesController@novo');
Route::post('requisicoes/novo', 'RequisicoesController@insert');
Route::get('requisicoes/novomanual', 'RequisicoesController@novomanual');
Route::post('requisicoes/novomanual', 'RequisicoesController@insertmanual');
Route::get('requisicoes/print/{id}', 'RequisicoesController@print');
Route::get('requisicoes/printtools/{id}', 'RequisicoesController@printtools');
Route::get('requisicoes/editar/{id}', 'RequisicoesController@editar');
Route::post('requisicoes/editar', 'RequisicoesController@update');
Route::get('requisicoes/remove/{id}', 'RequisicoesController@remove')->where('id','[0-9]+');
Route::get('requisicoes/tools/{id}', 'RequisicoesController@tools');
Route::post('requisicoes/tools/', 'RequisicoesController@toolsInsert');
Route::get('requisicoes/tools/remove/{id}', 'RequisicoesController@toolsRemove')->where('id','[0-9]+');


Route::get('apontamentos', 'ApontamentosController@index');





