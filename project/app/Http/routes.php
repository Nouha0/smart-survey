<?php
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

//group of projets
Route::group(['prefix'=>'projets','middleware' => ['web']], function () {
    Route::get('/affiche-projet',['as'=>'affiche-projet','uses'=>'ProjetsController@index'] );
    Route::post('/add-projet',['as'=>'add-projet','uses'=>'ProjetsController@store'] );
    Route::put('/update-projet/{id}',['as'=>'update-projet','uses'=>'ProjetsController@update']);
    Route::post('/delete-projet',['as'=>'delete-projet','uses'=>'ProjetsController@destroy']);
    Route::get('/edit-projet/{id}',['as'=>'edit-projet','uses'=>'ProjetsController@edit'] );
    Route::get('/formulaire/{id}',['as'=>'formulaire','uses'=>'ProjetsController@show']);
    Route::put('/put-formulaire',['as'=>'put-formulaire','uses'=>'ProjetsController@put']);
    Route::get('/select-formulaire',['as'=>'select-formulaire','uses'=>'ProjetsController@show']);
    Route::get('/all-projet',['as'=>'all-projet','uses'=>'ProjetsController@affiche']);
    Route::get('delete-liaisonP/{id}/{id2}',['as'=>'delete-liaisonP','uses'=>'ProjetsController@deleteLiaison']);


});
//group of clients
Route::group(['prefix'=>'clients','middleware'=>['web']],  function (){
    Route::get('/affiche-client',['as'=>'affiche-client','uses'=>'ClientsController@index']);
    Route::post('/add-client',['as'=>'add-client','uses'=>'ClientsController@store']);
    Route::put('/update-client/{id}',['as'=>'update-client','uses'=>'ClientsController@update']);
    Route::post('/delete-client',['as'=>'delete-client','uses'=>'ClientsController@destroy']);
    Route::get('/edit-client/{id}',['as'=>'edit-client','uses'=>'ClientsController@edit'] );
    Route::get('delete-liaisonC/{id}/{id2}',['as'=>'delete-liaisonC','uses'=>'ClientsController@deleteLiaison']);
    Route::get('/all-client',['as'=>'all-client','uses'=>'ClientsController@affiche']);
});
//group of enqueteurs
Route::group(['prefix'=>'enqueteurs','middleware'=>['web']],function(){
    Route::get('/affiche-enqueteur',['as'=>'affiche-enqueteur','uses'=>'EnqueteursController@index']);
    Route::post('/add-enqueteur',['as'=>'add-enqueteur','uses'=>'EnqueteursController@store']);
    Route::put('/update-enqueteur/{id}',['as'=>'update-enqueteur','uses'=>'EnqueteursController@update']);
    Route::post('/delete-enqueteur',['as'=>'delete-enqueteur','uses'=>'EnqueteursController@destroy']);
    Route::get('/edit-enqueteur/{id}',['as'=>'edit-enqueteur','uses'=>'EnqueteursController@edit'] );
    Route::get('/html/{id}',['as'=>'html','uses'=>'EnqueteursController@html']);
    Route::get('delete-liaisonE/{id}/{id2}',['as'=>'delete-liaisonE','uses'=>'EnqueteursController@deleteLiaison']);
    Route::get('/all-enqueteur',['as'=>'all-enqueteur','uses'=>'EnqueteursController@affiche']);
    Route::get('liste-projet/{id}',['as'=>'liste-projet','uses'=>'EnqueteursController@liste_projet']);
});
//group of administrateur
Route::group(['prefix'=>'administrateur','middleware'=>['web']],function(){
    Route::get('/affiche-administrateur',['as'=>'affiche-administrateur','uses'=>'AdministrateursController@index']);
    Route::post('/add-administrateur',['as'=>'add-administrateur','uses'=>'AdministrateursController@store']);
    Route::put('/update-administrateur/{id}',['as'=>'update-administrateur','uses'=>'AdministrateursController@update']);
    Route::post('/delete-administrateur',['as'=>'delete-administrateur','uses'=>'AdministrateursController@destroy']);
    Route::get('/edit-administrateur/{id}',['as'=>'edit-administrateur','uses'=>'AdministrateursController@edit'] );
    Route::get('delete-liaisonA/{id}/{id2}',['as'=>'delete-liaisonA','uses'=>'AdministrateursController@deleteLiaison']);
    Route::get('/all-admin',['as'=>'all-admin','uses'=>'AdministrateursController@affiche']);
});