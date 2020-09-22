<?php
Route::prefix('v1')->group(function () {
	//dominio/api/v1/departamentos
Route::get('departamentos','DepartamentoController@index');

});
