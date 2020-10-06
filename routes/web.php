<?php

Route::redirect('/', '/login');
//Auth::routes();
Auth::routes(['register' => false]);

Route::group(["middleware" => "apikey.validate"], function () {

  //Rutas
  Route::post('portalCautivoRegistrar','PortalCautivoController@portalCautivoRegistrar');
  Route::post('portalZonaTameRegistrar','ZonaWifiTameController@portalZonaTameRegistrar');



});

//Route vue
Route::group(['prefix' => 'api', 'middleware' => ['auth']], function(){

  //Zona wifi
Route::get('informe', 'InformeController@listadoInforme');
Route::get('graficaRondon', 'GraficaRondonController@graficaRondon');
Route::get('datosRondon', 'GraficaRondonController@datosRondon');

Route::get('graficaGeneralTame', 'GraficaGeneralTameController@graficaGeneralTame');
Route::get('datosTameGeneral', 'GraficaGeneralTameController@datosTameGeneral');
Route::get('listadoConexiones', 'ListadoConexionTameController@listadoConexiones');
Route::get('filtroRondonGeneral', 'FiltroGeneralRondonController@filtroRondonGeneral');






//INICIO SUBSIDIO
	Route::get('usuario', 'UsuarioController@datos');
	Route::get('cuentaVue', 'UsuarioController@cuentavue');
	Route::get('rol', 'RolController@getvue');
	Route::get('barrio','BarrioController@datos');
    Route::POST('barrioImportar','BarrioController@barrioImportar');

	Route::get('listaBarrio','BarrioController@listabarrio');

    Route::get('buscarBeneficiario', 'BeneficiarioController@beneficiario');
    //Informes
    Route::get('informeExcel', 'informeExcelController@informeexcel');
    Route::get('sinAyuda', 'BeneficiarioSinAyudaController@sinayuda');
//FIN SUBSIDIO



Route::get('selectRol', 'UsuarioController@selectrol');

Route::get('selectUsuario','UsuarioController@selectusuario');

Route::get('rolCheckbox', 'RolController@rolcheckbox');
Route::get('rolPermisoCheck/{id}', 'RolController@permisocheck');

Route::get('empresa', 'EmpresaController@getvue');

// Policies vue
Route::get('policy', 'PolicyController@getpolicy');
});
//end
//End route vue
Route::group(['middleware' => 'auth'], function () {
Route::get('/home', 'HomeController@index')->name('home');
Route::get('homeGrafica', 'HomeController@graficanual');
Route::get('homeBeneficiario', 'HomeController@beneficiario');



//Empresa
Route::get('empresa', 'EmpresaController@index')->name('empresa.index');
Route::put('empresa/{id}', 'EmpresaController@update');
//Informe administrador turno tramitado


//Sistema subsidios alcaldía

Route::resource('usuario', 'UsuarioController');
Route::get('cuenta', 'UsuarioController@cuenta')->name('cuenta.index');
Route::resource('rol', 'RolController');
Route::resource('barrio', 'BarrioController');
Route::resource('beneficiario', 'BeneficiarioController');
Route::resource('ayuda', 'AyudaController');

//Informes
//Excel múltiple
Route::get('informeExcel','informeExcelController@index')->name('informeExcel.index');
Route::get('exportarExcel','informeExcelController@excel');
//Beneficiario sin ayuda
 Route::get('beneficiarioSinAyuda', 'BeneficiarioSinAyudaController@index')->name('beneficiarioSinAyuda.index');
 Route::get('exportarSinAyuda','BeneficiarioSinAyudaController@excel');

 //Zona wifi

  Route::get('informe','InformeController@index')->name('informe.index');
  Route::get('graficaRondon', 'GraficaRondonController@index')->name('graficaRondon.index');
    Route::get('graficaGeneralTame', 'GraficaGeneralTameController@index')->name('graficaGeneralTame.index');
    Route::get('listadoConexionTame', 'ListadoConexionTameController@index');
    Route::get('filtroRondonGeneral', 'FiltroGeneralRondonController@index')->name('filtroRondonGeneral.index');














});

