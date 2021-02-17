<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::group(['middleware' => ['auth', 'PreventBackHistory']], function () {
    /* Logout */
    Route::get('/logout', 'Auth\LoginController@logout');

    /* Dashboard */
    Route::get('/', 'DashboardController@index')->name('dashboard');

    /* Reportar Problema */
    Route::get('/reportar-problema', 'ExtraFunctionsController@report')->name('report');
    Route::post('/reportar-problema/email', 'ExtraFunctionsController@reportmail')->name('report.send');
    Route::resource('/relatorio-problema', 'BugReportController')->parameters([
        'relatorio-problema' => 'bugreport'
    ])->only([
        'index',
        'show',
        'update',
        'destroy'
    ])->names([
        'index' => 'bugreport.index',
        'show' => 'bugreport.show',
        'update' => 'bugreport.update',
        'destroy' => 'bugreport.destroy'
    ]);
    Route::get('/relatorio-problema/{bugreport}/download', 'BugReportController@download')->name('bugreport.download');

    /* Procura de contactos */
    Route::post('/procurar-contacto', 'ExtraFunctionsController@searchcontact')->name('search.contact');

    /* Contacts */
    Route::get('/contactos', 'ContactoController@index')->name('contacts.index');
    Route::get('/contactos/favoritos', 'ContactoController@favoritos')->name('contacts.favoritos');
    Route::delete('/contactos/{contact}', 'ContactoController@destroy')->name('contacts.destroy');
    Route::put('/contactos/{contact}', 'ContactoController@update')->name('contacts.update');
    Route::get('/contactos/criar/{university?}', 'ContactoController@create')->name('contacts.create');
    Route::get('/contactos/show/{contact}/{university?}', 'ContactoController@show')->name('contacts.show');
    Route::get('/contactos/editar/{contact}/{university?}', 'ContactoController@edit')->name('contacts.edit');
    Route::post('/contactos', 'ContactoController@store')->name('contacts.store');

    /* Universidades */
    Route::resource('/universidades', 'UniversityController')->parameters([
        'universidades' => 'university'
    ])->names([
        'index' => 'universities.index',
        'store' => 'universities.store',
        'create' => 'universities.create',
        'show' => 'universities.show',
        'update' => 'universities.update',
        'destroy' => 'universities.destroy',
        'edit' => 'universities.edit',
    ]);

    /* Estudantes */
    Route::get('/clientes/pesquisa', 'ClientController@searchIndex')->name('clients.searchIndex');
    Route::post('/clientes/resultados','ClientController@searchResults')->name('clients.searchResults');
    Route::get('/clientes/print/{client}', 'ClientController@print')->name('clients.print');
    Route::get('/clientes/sendActivationEmail/{client}', 'ClientController@sendActivationEmail')->name('clients.sendActivationEmail');
    Route::resource('/clientes', 'ClientController')->parameters([
        'clientes' => 'client'
    ])->names([
        'index' => 'clients.index',
        'store' => 'clients.store',
        'create' => 'clients.create',
        'show' => 'clients.show',
        'update' => 'clients.update',
        'destroy' => 'clients.destroy',
        'edit' => 'clients.edit',
    ]);

    /* Agentes */
    Route::get('/agentes/print/{agent}', 'AgenteController@print')->name('agents.print');
    Route::resource('/agentes', 'AgenteController')->parameters([
        'agentes' => 'agent'
    ])->names([
        'index' => 'agents.index',
        'store' => 'agents.store',
        'create' => 'agents.create',
        'show' => 'agents.show',
        'update' => 'agents.update',
        'destroy' => 'agents.destroy',
        'edit' => 'agents.edit',
    ]);

    /* Biblioteca */
    Route::resource('/biblioteca', 'LibraryController')->parameters([
        'biblioteca' => 'library'
    ])->names([
        'index' => 'libraries.index',
        'store' => 'libraries.store',
        'create' => 'libraries.create',
        'show' => 'libraries.show',
        'update' => 'libraries.update',
        'destroy' => 'libraries.destroy',
        'edit' => 'libraries.edit',
    ]);

    /* Agenda */
    Route::resource('/agenda', 'AgendaController')->only(['index', 'store', 'update', 'destroy']);

    /* Pagamentos */
    Route::get('/pagamentos', 'PaymentController@index')->name('payments.index');
    Route::post('/pagamentos/pesquisa', 'PaymentController@search')->name('payments.search');

        // Registar/Editar/Visualizar pagamento CLIENTE
        Route::get('/pagamentos/cliente/{cliente}/fase/{fase}/{responsabilidade}', 'PaymentController@createcliente')->name('payments.cliente');
        Route::get('/pagamentos/cliente/{cliente}/fase/{fase}/{responsabilidade}/{pagoResponsabilidade}/editar', 'PaymentController@editcliente')->name('payments.editcliente');
        Route::get('/pagamentos/cliente/{cliente}/fase/{fase}/{responsabilidade}/{pagoResponsabilidade}', 'PaymentController@showcliente')->name('payments.showcliente');

        // Registar/Editar/Visualizar pagamento AGENTE
        Route::get('/pagamentos/agente/{agente}/fase/{fase}/{responsabilidade}', 'PaymentController@createagente')->name('payments.agente');
        Route::get('/pagamentos/agente/{agente}/fase/{fase}/{responsabilidade}/{pagoResponsabilidade}/editar', 'PaymentController@editagente')->name('payments.editagente');
        Route::get('/pagamentos/agente/{agente}/fase/{fase}/{responsabilidade}/{pagoResponsabilidade}', 'PaymentController@showagente')->name('payments.showagente');

        // Registar/Editar/Visualizar pagamento SUBAGENTE
        Route::get('/pagamentos/subagente/{subagente}/fase/{fase}/{responsabilidade}', 'PaymentController@createsubagente')->name('payments.subagente');
        Route::get('/pagamentos/subagente/{subagente}/fase/{fase}/{responsabilidade}/{pagoResponsabilidade}/editar', 'PaymentController@editsubagente')->name('payments.editsubagente');
        Route::get('/pagamentos/subagente/{subagente}/fase/{fase}/{responsabilidade}/{pagoResponsabilidade}', 'PaymentController@showsubagente')->name('payments.showsubagente');

        // Registar/Editar/Visualizar pagamento UNIVERSIDADE PRINCIPAL
        Route::get('/pagamentos/universidade-principal/{universidade1}/fase/{fase}/{responsabilidade}', 'PaymentController@createuni1')->name('payments.uni1');
        Route::get('/pagamentos/universidade-principal/{universidade1}/fase/{fase}/{responsabilidade}/{pagoResponsabilidade}/editar', 'PaymentController@edituni1')->name('payments.edituni1');
        Route::get('/pagamentos/universidade-principal/{universidade1}/fase/{fase}/{responsabilidade}/{pagoResponsabilidade}', 'PaymentController@showuni1')->name('payments.showuni1');

        // Registar/Editar/Visualizar pagamento UNIVERSIDADE SECUNDÁRIA
        Route::get('/pagamentos/universidade-secundaria/{universidade2}/fase/{fase}/{responsabilidade}', 'PaymentController@createuni2')->name('payments.uni2');
        Route::get('/pagamentos/universidade-secundaria/{universidade2}/fase/{fase}/{responsabilidade}/{pagoResponsabilidade}/editar', 'PaymentController@edituni2')->name('payments.edituni2');
        Route::get('/pagamentos/universidade-secundaria/{universidade2}/fase/{fase}/{responsabilidade}/{pagoResponsabilidade}', 'PaymentController@showuni2')->name('payments.showuni2');

        // Registar/Editar/Visualizar pagamento FORNECEDOR
        Route::get('/pagamentos/fornecedor/{fornecedor}/fase/{fase}/{relacao}', 'PaymentController@createfornecedor')->name('payments.fornecedor');
        Route::get('/pagamentos/fornecedor/{fornecedor}/fase/{fase}/{relacao}/{pagoResponsabilidade}/editar', 'PaymentController@editfornecedor')->name('payments.editfornecedor');
        Route::get('/pagamentos/fornecedor/{fornecedor}/fase/{fase}/{relacao}/{pagoResponsabilidade}', 'PaymentController@showfornecedor')->name('payments.showfornecedor');

    Route::delete('/pagamentos/{pagoResponsabilidade}/anular', 'PaymentController@destroy')->name('payments.destroy');
    Route::post('/pagamentos/{responsabilidade}/registar', 'PaymentController@store')->name('payments.store');
    Route::post('/pagamentos/{responsabilidade}/{pagoResponsabilidade}/atualizar', 'PaymentController@update')->name('payments.update');
    Route::get('/pagamentos/nota-pagamento/{pagoresponsabilidade}/transferir', 'PaymentController@download')->name('payments.download');
    Route::get('/pagamentos/comprovativo-pagamento/{pagoresponsabilidade}/transferir', 'PaymentController@downloadComprovativo')->name('payments.downloadComprovativo');

    /* Cobranças */
    Route::get('/cobrancas', 'ChargesController@listProducts')->name('charges.listproducts');
      // Transferir comprovativo de pagamento
      Route::get('/cobrancas/{docTransacao}/download', 'ChargesController@download')->name('charges.download');
      // Visualizar listagens de cobranças
      Route::get('/cobrancas/{product}', 'ChargesController@listFases')->name('charges.listfases');
      Route::get('/cobrancas/{product}/{fase}', 'ChargesController@create')->name('charges.create');
      // Visualizar cobrança
      Route::get('/cobrancas/{product}/{fase}/{docTransacao}', 'ChargesController@show')->name('charges.show');
      // Adicionar cobrança
      Route::post('/cobrancas/{product}/{fase}', 'ChargesController@store')->name('charges.store');
      // Editar cobrança
      Route::get('/cobrancas/{product}/{fase}/{docTransacao}/editar', 'ChargesController@edit')->name('charges.edit');
      Route::put('/cobrancas/{product}/{docTransacao}', 'ChargesController@update')->name('charges.update');

    /* Utilizadores */
    Route::resource('/administradores', 'AdminController')->parameters([
      'administradores' => 'admin'
    ])->names([
      'index' => 'admin.index',
      'store' => 'admin.store',
      'create' => 'admin.create',
      'show' => 'admin.show',
      'update' => 'admin.update',
      'destroy' => 'admin.destroy',
      'edit' => 'admin.edit',
    ]);

    /* Produto Stock*/
    Route::resource('/produtostock', 'ProdutosstockController');
    Route::get('/produtostock/{fasestock}', 'ProdutosstockController@show')->name('produtostock.show');

    /* Fase Stock */
    Route::resource('/fasestock', 'FasestockController')->only(["store", "show", "update", "destroy"]);
    Route::post('/produtostock/{produtostock}', 'FasestockController@store')->name('fasestock.store');
    Route::get('/fasestock/{fasestock}', 'FasestockController@show')->name('fasestock.show');

    /* Documentos Stock*/
    Route::resource('/documentostock', 'DocumentostockController')->only(["store", "show", "update", "destroy"]);
    Route::post('/fasestock/{fasestock}', 'DocumentostockController@store')->name('documentostock.store');
    Route::get('/documentostock/{docstock}', 'DocumentostockController@show')->name('documentostock.show');

    /* Produtos */
    Route::get('/produtos/escolher-stock/{client}', 'ProdutoController@list')->name('produtos.list');
    Route::get('/produtos/criar/{client}/{produtoStock}', 'ProdutoController@create')->name('produtos.create');
    Route::post('/produtos/store/{produtoStock}', 'ProdutoController@store')->name('produtos.store');
    Route::resource('/produtos', 'ProdutoController')->only(['destroy','update','show','edit']);

    /* Documentos Pessoais */
    Route::post('/documento-pessoal/criar/{client}', 'DocPessoalController@createFromClient')->name('documento-pessoal.createFromClient');
    Route::post('/documento-pessoal/store/{client}/{docnome}', 'DocPessoalController@storeFromClient')->name('documento-pessoal.storeFromClient');

    Route::get('/documento-pessoal/criar-na-fase/{fase}/{docnecessario}', 'DocPessoalController@create')->name('documento-pessoal.create');
    Route::post('/documento-pessoal/store-na-fase/{fase}/{docnecessario}', 'DocPessoalController@store')->name('documento-pessoal.store');
    Route::get('/documento-pessoal/{documento}/show', 'DocPessoalController@show')->name('documento-pessoal.show');
    Route::get('/documento-pessoal/{documento}/editar', 'DocPessoalController@edit')->name('documento-pessoal.edit');
    Route::put('/documento-pessoal/{documento}/update', 'DocPessoalController@update')->name('documento-pessoal.update');
    Route::get('/documento-pessoal/{documento}/verifica', 'DocPessoalController@verify')->name('documento-pessoal.verify');
    Route::put('/documento-pessoal/{documento}/verify', 'DocPessoalController@verifica')->name('documento-pessoal.verifica');
    Route::resource('/documento-pessoal', 'DocPessoalController')->only(['destroy']);

    /* Documentos Academicos */
    Route::post('/documento-academico/criar/{client}', 'DocAcademicoController@createFromClient')->name('documento-academico.createFromClient');
    Route::post('/documento-academico/store/{client}/{docnome}', 'DocAcademicoController@storeFromClient')->name('documento-academico.storeFromClient');

    Route::get('/documento-academico/criar-na-fase/{fase}/{docnecessario}', 'DocAcademicoController@create')->name('documento-academico.create');
    Route::post('/documento-academico/store-na-fase/{fase}/{docnecessario}', 'DocAcademicoController@store')->name('documento-academico.store');
    Route::get('/documento-academico/{documento}/show', 'DocAcademicoController@show')->name('documento-academico.show');
    Route::get('/documento-academico/{documento}/editar', 'DocAcademicoController@edit')->name('documento-academico.edit');
    Route::put('/documento-academico/{documento}/update', 'DocAcademicoController@update')->name('documento-academico.update');
    Route::get('/documento-academico/{documento}/verifica', 'DocAcademicoController@verify')->name('documento-academico.verify');
    Route::put('/documento-academico/{documento}/verify', 'DocAcademicoController@verifica')->name('documento-academico.verifica');
    Route::resource('/documento-academico', 'DocAcademicoController')->only(['destroy']);

    /* Listagem */
    Route::resource('/listagem', 'ListagemController')->only(['index']);

    /* Conta */
    Route::resource('/conta-bancaria', 'ContaController')->parameters([
      'conta-bancaria' => 'conta'
    ])->names([
      'index' => 'conta.index',
      'store' => 'conta.store',
      'create' => 'conta.create',
      'show' => 'conta.show',
      'update' => 'conta.update',
      'destroy' => 'conta.destroy',
      'edit' => 'conta.edit',
    ]);

    /* Fonecedores */
    Route::resource('/fornecedores', 'ProviderController')->parameters([
      'fornecedores' => 'provider'
    ])->names([
      'index' => 'provider.index',
      'store' => 'provider.store',
      'create' => 'provider.create',
      'show' => 'provider.show',
      'update' => 'provider.update',
      'destroy' => 'provider.destroy',
      'edit' => 'provider.edit',
    ]);

    /* Relatório e Contas */
    Route::get('/relatorio-e-contas', 'ExtraFunctionsController@relatoriocontas')->name('relatorio.contas');

    /* Listagens */
    Route::resource('/listagens', 'ListagemController');

    /* Notificações */
    Route::get('/notificacoes', 'NotificationController@index')->name('notification.index');
    Route::get('/notificacao/{notif_id}', 'NotificationController@show')->name('notification.show');
});

/* Account Confirmation */
Route::get('/ativacao-conta/{user}', 'AccountConfirmationController@index')->name('confirmation.index');
Route::post('/ativacao-conta/{user}/confirmar-chave', 'AccountConfirmationController@keyconfirmation')->name('confirmation.key');
Route::put('/ativacao-conta/{user}/confirmar-password', 'AccountConfirmationController@password')->name('confirmation.password');
Route::get('/ativacao-conta/{user}/restaurar-conta', 'AccountConfirmationController@restore')->name('confirmation.restore');
Route::get('/login-verification/{user}', 'AccountConfirmationController@loginVerificationView')->name('confirmation.loginVerificationView');
Route::get('/verify/{user}', 'AccountConfirmationController@loginVerification')->name('confirmation.loginVerification');

/* Restore password */
Route::get('/restaurar-password', 'AccountConfirmationController@mailrestorepassword')->name('mailrestore.password');
Route::post('/restaurar-passwords/confirmacao-email', 'AccountConfirmationController@checkemail')->name('check.email');
Route::get('/restaurar-password/{user}', 'AccountConfirmationController@restorepassword');
Route::post('/restaurar-password/{user}/check-key', 'AccountConfirmationController@checkkey')->name('check.key');
Route::put('/restaurar-password/{user}/nova-password', 'AccountConfirmationController@newpassword')->name('new.password');

Route::get('/data', 'DataController@createdata');
