<?php

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('/', 'SiteController@index');
Route::get('/search', 'SiteController@search');
Route::get('/increment/{id}', 'SiteController@increment');
Route::get('/cidade/{id}/json','CidadeController@json');
Route::post('/sendMail','SiteController@sendMail');
Route::get('/novaempresa','SiteController@addEmpresa');
Route::get('/sugerir','SiteController@sugerir');
Route::post('/sendsugerir','SiteController@sendSugerir');

Route::get('/atualizar','SiteController@atualizar');

Route::post('/sendatualizar','SiteController@sendAtualizar');

/* ***********************************************
*       ROTAS DE ACESSO DO APLICATIVO MOBILE  
*********************************************** */
Route::get('/cidades/json/all','MobileController@allCity');
Route::get('/telefones/json/{cidade}/{tag}','MobileController@searchPhones');
Route::get('/telefones/all/json/{cidade}','MobileController@allPhones');


Route::resource('contato', 'ContatoController', array('except' => ['index', 'update', 'destroy']));

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin', 'DashboardController@index');


    Route::resource('contato', 'ContatoController', array('except' => ['create', 'store']));
    Route::resource('categoria', 'CategoriaController');
    Route::resource('subcategoria', 'SubcategoriaController');
    Route::get('subcategoria/list/{id}','SubcategoriaController@getList');

    Route::get('estado/active/{id}','EstadoController@active');
    Route::resource('estado', 'EstadoController');

    Route::resource('cidade', 'CidadeController');
    Route::get('/cidade/active/{id}','CidadeController@active');
    Route::get('/cidade/lista/{id}','CidadeController@lista');
    Route::get('/cidade/filtro/uf','CidadeController@filtro');
    Route::get('/cidade/load_citys/{estado}','CidadeController@load_citys');


    Route::resource('bairro', 'BairroController');
    Route::get('/bairro/lista/{id}','BairroController@lista');
    Route::get('/bairro/filtro/cidade','BairroController@filtro');
    Route::get('/bairro/listacidades/{id}','BairroController@listacidades');

    Route::resource('cep', 'CepController');
    Route::get('/cep/lista/{id}','CepController@lista');
    Route::get('/cep/filtro/cidade','CepController@filtro');
    Route::get('/cep/listacidades/{id}','CepController@listacidades');
    
    Route::resource('logradouro', 'LogradouroController');
    Route::get('/logradouro/lista/{id}','LogradouroController@lista');
    Route::get('/logradouro/filtro/cidade','LogradouroController@filtro');
    Route::get('/logradouro/listacidades/{id}','LogradouroController@listacidades');

    Route::resource('plano', 'PlanoController');
    Route::get('/plano/active/{id}','PlanoController@active');

    Route::resource('empresa', 'EmpresaController');
    Route::get('/empresa/ceps/{id}','EmpresaController@ceps');
    Route::get('/empresa/logradouros/{id}','EmpresaController@logradouros');
    Route::get('/empresa/bairros/{id}','EmpresaController@bairros');
    Route::get('/empresa/{id}/assets','EmpresaController@assets');
    Route::post('/empresa/{id}/upload','EmpresaController@uploadGaleria');
    Route::get('/empresa/assets/{id}/del','EmpresaController@assetsDel');
    Route::get('/empresa/banner/{id}/del','EmpresaController@bannerDel');
    Route::get('/empresa/active/{id}','EmpresaController@active');

    Route::resource('banners', 'BannersController');


    Route::resource('usuarios', 'UsersController', array('except' => 'show'));
    Route::get('usuarios/active/{id}/{active}', 'UsersController@active');

    Route::get('/createAux/{controller}/{field}/{value}/{parentfield?}/{parentvalue?}', 'GenericController@store');

});

