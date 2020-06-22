<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/home', 'HomeController@index');

//Route::group(['prefix' => 'restrito', 'middleware' => [], 'web'], function() {
Route::group(['prefix' => 'restrito', 'middleware' => ['web', 'auth']], function () {

    /* ÁREAS (INSTITUCIONAL CIMADSETA) ***************************************** */
    Route::get('institucional', 'Restrito\InstitucionalController@index');
    Route::get('institucional/cadastrar', 'Restrito\InstitucionalController@cadastrar');
    Route::post('institucional/cadastrar', 'Restrito\InstitucionalController@cadastrarDB');
    Route::get('institucional/editar/{id}', 'Restrito\InstitucionalController@editar');
    Route::post('institucional/editar/{id}', 'Restrito\InstitucionalController@editarDB');
    Route::post('institucional/deletar/{id}', 'Restrito\InstitucionalController@deletar');

    /* ÁREAS (CAMPOS CIMADSETA) ***************************************** */
    Route::get('areas', 'Restrito\AreasController@index');
    Route::get('areas/cadastrar', 'Restrito\AreasController@cadastrar');
    Route::post('areas/cadastrar', 'Restrito\AreasController@cadastrarDB');
    Route::get('areas/editar/{id}', 'Restrito\AreasController@editar');
    Route::post('areas/editar/{id}', 'Restrito\AreasController@editarDB');
    Route::post('areas/deletar/{id}', 'Restrito\AreasController@deletar');

    /* PATRIMONIOS (CIMADSETA) ***************************************** */
    Route::get('patrimonios', 'Restrito\PatrimoniosController@index');
    Route::get('patrimonios/cadastrar', 'Restrito\PatrimoniosController@cadastrar');
    Route::post('patrimonios/cadastrar', 'Restrito\PatrimoniosController@cadastrarDB');
    Route::get('patrimonios/editar/{id}', 'Restrito\PatrimoniosController@editar');
    Route::post('patrimonios/editar/{id}', 'Restrito\PatrimoniosController@editarDB');
    Route::post('patrimonios/deletar/{id}', 'Restrito\PatrimoniosController@deletar');
    Route::get('patrimonios/view/{id}', 'Restrito\PatrimoniosController@view');

    /* IGREJAS (CIMADSETA) ***************************************** */
    Route::get('igrejas', 'Restrito\IgrejasController@index');
    Route::get('igrejas/cadastrar', 'Restrito\IgrejasController@cadastrar');
    Route::post('igrejas/cadastrar', 'Restrito\IgrejasController@cadastrarDB');
    Route::get('igrejas/editar/{id}', 'Restrito\IgrejasController@editar');
    Route::post('igrejas/editar/{id}', 'Restrito\IgrejasController@editarDB');
    Route::post('igrejas/deletar/{id}', 'Restrito\IgrejasController@deletar');
    Route::get('igrejas/view/{id}', 'Restrito\IgrejasController@view');









    /* GESTÃO DE USUÁRIOS (MINISTROS) - SOMENTE ADMIN ***************************************** */
    Route::get('ministros', 'Restrito\MinistrosController@index');
    Route::get('ministros/cadastrar', 'Restrito\MinistrosController@cadastrar');
    Route::post('ministros/cadastrar', 'Restrito\MinistrosController@cadastrarDB');
    Route::get('ministros/editar/{id}', 'Restrito\MinistrosController@editar');
    Route::post('ministros/editar/{id}', 'Restrito\MinistrosController@editarDB');
    Route::post('ministros/deletar/{id}', 'Restrito\MinistrosController@deletar');
    Route::get('ministros/view/{id}', 'Restrito\MinistrosController@view');

    /* GESTÃO DE MISSIONÁRIAS - SOMENTE ADMIN ***************************************** */
    Route::get('missionarias', 'Restrito\MissionariasController@index');
    Route::get('missionarias/cadastrar', 'Restrito\MissionariasController@cadastrar');
    Route::post('missionarias/cadastrar', 'Restrito\MissionariasController@cadastrarDB');
    Route::get('missionarias/editar/{id}', 'Restrito\MissionariasController@editar');
    Route::post('missionarias/editar/{id}', 'Restrito\MissionariasController@editarDB');
    Route::post('missionarias/deletar/{id}', 'Restrito\MissionariasController@deletar');
    Route::get('missionarias/view/{id}', 'Restrito\MissionariasController@view');






    /* ENDEREÇOS DE MINISTROS - SOMENTE ADMIN ***************************************** */
    Route::get('ministros/endereco/cadastrar/{id}', 'Restrito\EnderecosController@enderecoMinistroCadastrar');
    Route::post('ministros/endereco/cadastrar/{id}', 'Restrito\EnderecosController@enderecoMinistroCadastrarDB');
    Route::get('ministros/endereco/editar/{id}', 'Restrito\EnderecosController@enderecoMinistroEditar');
    Route::post('ministros/endereco/editar/{id}', 'Restrito\EnderecosController@enderecoMinistroEditarDB');
    /* ENDEREÇOS DE MISSIONÁRIAS - SOMENTE ADMIN ***************************************** */
    Route::get('missionarias/endereco/cadastrar/{id}', 'Restrito\EnderecosController@enderecoMissionariaCadastrar');
    Route::post('missionarias/endereco/cadastrar/{id}', 'Restrito\EnderecosController@enderecoMissionariaCadastrarDB');
    Route::get('missionarias/endereco/editar/{id}', 'Restrito\EnderecosController@enderecoMissionariaEditar');
    Route::post('missionarias/endereco/editar/{id}', 'Restrito\EnderecosController@enderecoMissionariaEditarDB');
    /* ENDEREÇOS DE IGREJAS - SOMENTE ADMIN ***************************************** */
    Route::get('igrejas/endereco/cadastrar/{id}', 'Restrito\EnderecosController@enderecoIgrejaCadastrar');
    Route::post('igrejas/endereco/cadastrar/{id}', 'Restrito\EnderecosController@enderecoIgrejaCadastrarDB');
    Route::get('igrejas/endereco/editar/{id}', 'Restrito\EnderecosController@enderecoIgrejaEditar');
    Route::post('igrejas/endereco/editar/{id}', 'Restrito\EnderecosController@enderecoIgrejaEditarDB');




    /* DADOS BANCÁRIOS DE MINISTROS - SOMENTE ADMIN ***************************************** */
    Route::get('ministros/dados-bancarios/cadastrar/{id}', 'Restrito\DadosBancariosController@bankMinistroCadastrar');
    Route::post('ministros/dados-bancarios/cadastrar/{id}', 'Restrito\DadosBancariosController@bankMinistroCadastrarDB');
    Route::get('ministros/dados-bancarios/editar/{id}', 'Restrito\DadosBancariosController@bankMinistroEditar');
    Route::post('ministros/dados-bancarios/editar/{id}', 'Restrito\DadosBancariosController@bankMinistroEditarDB');
    /* DADOS BANCÁRIOS DE MISSIONÁRIAS - SOMENTE ADMIN ***************************************** */
    Route::get('missionarias/dados-bancarios/cadastrar/{id}', 'Restrito\DadosBancariosController@bankMissionariaCadastrar');
    Route::post('missionarias/dados-bancarios/cadastrar/{id}', 'Restrito\DadosBancariosController@bankMissionariaCadastrarDB');
    Route::get('missionarias/dados-bancarios/editar/{id}', 'Restrito\DadosBancariosController@bankMissionariaEditar');
    Route::post('missionarias/dados-bancarios/editar/{id}', 'Restrito\DadosBancariosController@bankMissionariaEditarDB');




    /* DADOS ECLESIÁSTICOS DE MINISTROS - SOMENTE ADMIN ***************************************** */
    Route::get('ministros/dados-eclesiasticos/cadastrar/{id}', 'Restrito\DadosEclesiasticosController@DeMinistroCadastrar');
    Route::post('ministros/dados-eclesiasticos/cadastrar/{id}', 'Restrito\DadosEclesiasticosController@DeMinistroCadastrarDB');
    Route::get('ministros/dados-eclesiasticos/editar/{id}', 'Restrito\DadosEclesiasticosController@DeMinistroEditar');
    Route::post('ministros/dados-eclesiasticos/editar/{id}', 'Restrito\DadosEclesiasticosController@DeMinistroEditarDB');
    /* DADOS ECLESIÁSTICOS DE MISSIONÁRIAS - SOMENTE ADMIN ***************************************** */
    Route::get('missionarias/dados-eclesiasticos/cadastrar/{id}', 'Restrito\DadosEclesiasticosController@DeMissionariaCadastrar');
    Route::post('missionarias/dados-eclesiasticos/cadastrar/{id}', 'Restrito\DadosEclesiasticosController@DeMissionariaCadastrarDB');
    Route::get('missionarias/dados-eclesiasticos/editar/{id}', 'Restrito\DadosEclesiasticosController@DeMissionariaEditar');
    Route::post('missionarias/dados-eclesiasticos/editar/{id}', 'Restrito\DadosEclesiasticosController@DeMissionariaEditarDB');


    /* DEPENDENTES DE MINISTROS - SOMENTE ADMIN ***************************************** */
    Route::get('ministros/dependentes/{id}', 'Restrito\DependentesController@dependentesMinistro');
    Route::get('ministros/dependentes/cadastrar/{id}', 'Restrito\DependentesController@DependentesMinistroCadastrar');
    Route::post('ministros/dependentes/cadastrar/{id}', 'Restrito\DependentesController@DependentesMinistroCadastrarDB');
    Route::get('ministros/dependentes/editar/{id}', 'Restrito\DependentesController@DependentesMinistroEditar');
    Route::post('ministros/dependentes/editar/{id}', 'Restrito\DependentesController@DependentesMinistroEditarDB');
    Route::post('ministros/dependentes/deletar/{id}', 'Restrito\DependentesController@deletar');
    /* DEPENDENTES MISSIONÁRIAS - SOMENTE ADMIN ***************************************** */
    Route::get('missionarias/dependentes/{id}', 'Restrito\DependentesController@dependentesMissionaria');
    Route::get('missionarias/dependentes/cadastrar/{id}', 'Restrito\DependentesController@DependentesMissionariaCadastrar');
    Route::post('missionarias/dependentes/cadastrar/{id}', 'Restrito\DependentesController@DependentesMissionariaCadastrarDB');
    Route::get('missionarias/dependentes/editar/{id}', 'Restrito\DependentesController@DependentesMissionariaEditar');
    Route::post('missionarias/dependentes/editar/{id}', 'Restrito\DependentesController@DependentesMissionariaEditarDB');
    Route::post('missionarias/dependentes/deletar/{id}', 'Restrito\DependentesController@deletar');










    /* MINHA ÁREA ***************************************** */
    Route::get('minha-area/ministros-missionarias', 'Restrito\MinhaAreaController@ministrosMissionarias');
    /* cadastro/edição de endereços dos usuários de minha área *********************************** */
    Route::get('minha-area/usuarios/enderecos/cadastrar/{id}', 'Restrito\MinhaAreaController@enderecoUsuarioCadastrar');
    Route::post('minha-area/usuarios/enderecos/cadastrar/{id}', 'Restrito\MinhaAreaController@enderecoUsuarioCadastrarDB');
    Route::get('minha-area/usuarios/enderecos/editar/{id}', 'Restrito\MinhaAreaController@enderecoUsuarioEditar');
    Route::post('minha-area/usuarios/enderecos/editar/{id}', 'Restrito\MinhaAreaController@enderecoUsuarioEditarDB');




    Route::get('minha-area/igrejas', 'Restrito\MinhaAreaController@igrejas');
    /* cadastro/edição de endereços das igrejas de minha área *********************************** */
    Route::get('minha-area/igrejas/editar/{id}', 'Restrito\MinhaAreaController@igrejaEditar');
    Route::post('minha-area/igrejas/editar/{id}', 'Restrito\MinhaAreaController@igrejaEditarDB');
    /* cadastro/edição de endereços das igrejas de minha área *********************************** */
    Route::get('minha-area/igrejas/enderecos/cadastrar/{id}', 'Restrito\MinhaAreaController@enderecoIgrejaCadastrar');
    Route::post('minha-area/igrejas/enderecos/cadastrar/{id}', 'Restrito\MinhaAreaController@enderecoIgrejaCadastrarDB');
    Route::get('minha-area/igrejas/enderecos/editar/{id}', 'Restrito\MinhaAreaController@enderecoIgrejaEditar');
    Route::post('minha-area/igrejas/enderecos/editar/{id}', 'Restrito\MinhaAreaController@enderecoIgrejaEditarDB');









    /* ALTERAR/INSERIR FOTO USER ***************************************** */
    Route::get('users/foto/{id}', 'Restrito\FotoController@foto');
    Route::post('users/foto', 'Restrito\FotoController@fotoDB');


    //
    // Route::get('usuario', 'Restrito\UserController@index');
    // Route::get('usuario/cadastrar', 'Restrito\UserController@cadastrar');
    // Route::post('usuario/cadastrar', 'Restrito\UserController@cadastrarDB');
    // Route::get('usuario/editar/{id}', 'Restrito\UserController@editar');
    // Route::post('usuario/editar/{id}', 'Restrito\UserController@editarDB');
    // Route::post('usuario/deletar/{id}', 'Restrito\UserController@deletar');
    // Route::get('usuario/view/{id}', 'Restrito\UserController@view');
    // Route::get('usuario/endereco/{id}', 'Restrito\UserController@endereco');
    // Route::post('usuario/endereco/{id}', 'Restrito\UserController@enderecoDB');
    // Route::get('usuario/endereco-editar/{id}', 'Restrito\UserController@editarEndereco');
    // Route::post('usuario/endereco-editar/{id}', 'Restrito\UserController@editarEnderecoDB');
    //
    // Route::get('usuario/bank/{id}', 'Restrito\UserController@bank');
    // Route::post('usuario/bank/{id}', 'Restrito\UserController@bankDB');
    // Route::get('usuario/bank-editar/{id}', 'Restrito\UserController@editarBank');
    // Route::post('usuario/bank-editar/{id}', 'Restrito\UserController@editarBankDB');
    //
    // Route::get('usuario/dependente/{id}', 'Restrito\UserController@dependente');
    // Route::post('usuario/dependente/{id}', 'Restrito\UserController@dependenteDB');
    // Route::get('usuario/dependente-editar/{id}', 'Restrito\UserController@editarDependente');
    // Route::post('usuario/dependente-editar/{id}', 'Restrito\UserController@editarDependenteDB');
    //
    // Route::get('usuario/dadoseclesiasticos/{id}', 'Restrito\UserController@dadosEclesiasticos');
    // Route::post('usuario/dadoseclesiasticos/{id}', 'Restrito\UserController@dadosEclesiasticosDB');
    // Route::get('usuario/dadoseclesiasticos-editar/{id}', 'Restrito\UserController@editarDadosMinistro');
    // Route::post('usuario/dadoseclesiasticos-editar/{id}', 'Restrito\UserController@editarDdadosEclesiasticosDB');













    Route::get('credencial/ministros', 'Restrito\CredenciaisController@ministros');
    Route::get('credencial/uemads', 'Restrito\CredenciaisController@missionarias');

    Route::get('credenciais/carteira/{id}', 'Restrito\CredenciaisController@carteira');

    Route::get('credenciais/editar/{id}', 'Restrito\CredenciaisController@editar');
    Route::post('credenciais/editar/{id}', 'Restrito\CredenciaisController@editarDB');
















    /* GESTÃO DE USUÁRIOS (PERFIS) - SOMENTE ADMIN ***************************************** */
    Route::get('perfil', 'Restrito\UserRoleController@index');
    Route::get('perfil/cadastrar', 'Restrito\UserRoleController@cadastrar');
    Route::post('perfil/cadastrar', 'Restrito\UserRoleController@cadastrarDB');
    Route::get('perfil/editar/{id}', 'Restrito\UserRoleController@editar');
    Route::post('perfil/editar/{id}', 'Restrito\UserRoleController@editarDB');
    Route::post('perfil/deletar/{id}', 'Restrito\UserRoleController@deletar');

    /* GESTÃO DE USUÁRIOS (PERMISSÕES) - SOMENTE ADMIN ***************************************** */
    Route::get('permissao', 'Restrito\UserPermissionController@index');
    Route::get('permissao/cadastrar', 'Restrito\UserPermissionController@cadastrar');
    Route::post('permissao/cadastrar', 'Restrito\UserPermissionController@cadastrarDB');
    Route::get('permissao/editar/{id}', 'Restrito\UserPermissionController@editar');
    Route::post('permissao/editar/{id}', 'Restrito\UserPermissionController@editarDB');
    Route::post('permissao/deletar/{id}', 'Restrito\UserPermissionController@deletar');

    /* GESTÃO DE USUÁRIOS (ATRIBUIR PERMISSÕES) - SOMENTE ADMIN ***************************************** */
    Route::get('permissao-perfil', 'Restrito\UserPermissaoPerfilController@index');
    Route::get('permissao-perfil/cadastrar/{id}', 'Restrito\UserPermissaoPerfilController@cadastrarPr');
    Route::post('permissao-perfil/cadastrar/{id}', 'Restrito\UserPermissaoPerfilController@cadastrarPrDB');
    Route::get('permissao-perfil/editar/{id}', 'Restrito\UserPermissaoPerfilController@editar');
    Route::post('permissao-perfil/editar/{id}', 'Restrito\UserPermissaoPerfilController@editarDB');
    Route::post('permissao-perfil/deletar/{id}', 'Restrito\UserPermissaoPerfilController@deletar');

    /* GESTÃO DE USUÁRIOS (ATRIBUIR PERFIL) - SOMENTE ADMIN ***************************************** */
    Route::get('perfil-usuario', 'Restrito\UserPerfilUsuarioController@index');
    Route::get('perfil-usuario/cadastrar/{id}', 'Restrito\UserPerfilUsuarioController@cadastrarPr');
    Route::post('perfil-usuario/cadastrar/{id}', 'Restrito\UserPerfilUsuarioController@cadastrarPrDB');
    Route::get('perfil-usuario/editar/{id}', 'Restrito\UserPerfilUsuarioController@editar');
    Route::post('perfil-usuario/editar/{id}', 'Restrito\UserPerfilUsuarioController@editarDB');
    Route::post('perfil-usuario/deletar/{id}', 'Restrito\UserPerfilUsuarioController@deletar');

    /* GESTÃO DE USUÁRIOS (ATRIBUIR PERFIL) - SOMENTE INFO-ORGAO ***************************************** */
    // Route::get('perfil-usuario-orgao', 'Restrito\UserPerfilOrgaoController@index');
    // Route::get('perfil-usuario-orgao/cadastrar/{id}', 'Restrito\UserPerfilOrgaoController@cadastrarPr');
    // Route::post('perfil-usuario-orgao/cadastrar/{id}', 'Restrito\UserPerfilOrgaoController@cadastrarPrDB');
    // Route::get('perfil-usuario-orgao/editar/{id}', 'Restrito\UserPerfilOrgaoController@editar');
    // Route::post('perfil-usuario-orgao/editar/{id}', 'Restrito\UserPerfilOrgaoController@editarDB');
    // Route::post('perfil-usuario-orgao/deletar/{id}', 'Restrito\UserPerfilOrgaoController@deletar');








    /* GESTÃO DE USUÁRIOS DELETADOS - SOMENTE ADMIN ***************************************** */
    Route::get('usuarios-deletados', 'Restrito\LixeiraController@usuarios');
    Route::get('usuarios-deletados/restaurar/{id}', 'Restrito\LixeiraController@restaurarUsuario');
    Route::post('usuarios-deletados/deletar/{id}', 'Restrito\LixeiraController@deletarUsuario');

    // Route::get('ministros/cadastrar', 'Restrito\MinistrosController@cadastrar');
    // Route::post('ministros/cadastrar', 'Restrito\MinistrosController@cadastrarDB');
    // Route::get('ministros/view/{id}', 'Restrito\MinistrosController@view');







    /* ==================== MEU FINANCEIRO ================================= */
    Route::get('meus-boletos', 'Restrito\MeuFinanceiroController@index');
    Route::get('meus-boletos/{id}', 'Restrito\MeuFinanceiroController@viewBoleto');

    Route::get('meus-recibos', 'Restrito\MeuFinanceiroController@recibos');
    Route::get('meus-recibos/{id}', 'Restrito\MeuFinanceiroController@viewRecibo');

    Route::get('minhas-contribuicoes', 'Restrito\MeuFinanceiroController@contribuicoes');
    Route::get('minhas-contribuicoes-cadastrar', 'Restrito\MeuFinanceiroController@contribuicoesCadastrar');
    Route::post('minhas-contribuicoes-cadastrar', 'Restrito\MeuFinanceiroController@contribuicoesCadastrarDB');
    Route::get('minhas-contribuicoes-editar/{id}', 'Restrito\MeuFinanceiroController@contribuicoesEditar');
    Route::post('minhas-contribuicoes-editar/{id}', 'Restrito\MeuFinanceiroController@contribuicoesEditarDB');
    Route::post('minhas-contribuicoes-deletar/{id}', 'Restrito\MeuFinanceiroController@contribuicoesExcluir');





    Route::get('meu-perfil', 'Restrito\MeuPerfilController@perfil');









    /* ==================== FINANCEIRO ================================= */

    /* TIPOS DE SAÍDA ***************************************** */
    Route::get('debitos-tipo', 'Restrito\DebitosTipoController@index');
    Route::get('debitos-tipo/cadastrar', 'Restrito\DebitosTipoController@cadastrar');
    Route::post('debitos-tipo/cadastrar', 'Restrito\DebitosTipoController@cadastrarDB');
    Route::get('debitos-tipo/editar/{id}', 'Restrito\DebitosTipoController@editar');
    Route::post('debitos-tipo/editar/{id}', 'Restrito\DebitosTipoController@editarDB');
    Route::post('debitos-tipo/deletar/{id}', 'Restrito\DebitosTipoController@deletar');

    /* DÉBITOS ***************************************** */
    Route::get('debitos', 'Restrito\DebitosController@index');
    Route::get('debitos/cadastrar', 'Restrito\DebitosController@cadastrar');
    Route::post('debitos/cadastrar', 'Restrito\DebitosController@cadastrarDB');
    Route::get('debitos/editar/{id}', 'Restrito\DebitosController@editar');
    Route::post('debitos/editar/{id}', 'Restrito\DebitosController@editarDB');
    Route::post('debitos/deletar/{id}', 'Restrito\DebitosController@deletar');

    /* TIPOS DE RECEITAS ***************************************** */
    Route::get('receitas-tipo', 'Restrito\ReceitasTipoController@index');
    Route::get('receitas-tipo/cadastrar', 'Restrito\ReceitasTipoController@cadastrar');
    Route::post('receitas-tipo/cadastrar', 'Restrito\ReceitasTipoController@cadastrarDB');
    Route::get('receitas-tipo/editar/{id}', 'Restrito\ReceitasTipoController@editar');
    Route::post('receitas-tipo/editar/{id}', 'Restrito\ReceitasTipoController@editarDB');
    Route::post('receitas-tipo/deletar/{id}', 'Restrito\ReceitasTipoController@deletar');

    /* RECEITAS ***************************************** */
    Route::get('receitas', 'Restrito\ReceitasController@index');
    // Route::get('receitas-consolidadas', 'Restrito\ReceitasController@geral');
    Route::get('receitas/cadastrar', 'Restrito\ReceitasController@cadastrar');
    Route::post('receitas/cadastrar', 'Restrito\ReceitasController@cadastrarDB');
    Route::get('receitas/editar/{id}', 'Restrito\ReceitasController@editar');
    Route::post('receitas/editar/{id}', 'Restrito\ReceitasController@editarDB');
    Route::post('receitas/deletar/{id}', 'Restrito\ReceitasController@deletar');

    /* BOLETOS - FATURAMENTO ***************************************** */
    Route::get('receitas/boletos', 'Restrito\ReceitasController@listarBoletos');
    Route::get('receitas/boletos/{id}', 'Restrito\ReceitasController@viewBoleto');
    Route::get('receitas/gerar-boletos', 'Restrito\ReceitasController@gerarBoleto');
    Route::get('receitas/boletos/email/{id}', 'Restrito\ReceitasController@enviarEmail');

    Route::post('receitas/gerar-boletos-mensalidade', 'Restrito\ReceitasController@gerarBoletoMensalidade');
    Route::post('receitas/gerar-boletos-unico', 'Restrito\ReceitasController@gerarBoletoUnico');


    /* PORTAL TRANSPARÊNCIA ***************************************** */
    Route::get('transparencia', 'Restrito\TransparenciaController@index');
    Route::get('transparencia/{ano}', 'Restrito\TransparenciaController@ano');
    Route::get('transparencia/{ano}/{mes}', 'Restrito\TransparenciaController@anoMes');

    /* EVENTOS ***************************************** */
    Route::get('eventos/age', 'Restrito\EventosController@age');
    Route::get('eventos/ago', 'Restrito\EventosController@ago');
    Route::get('eventos/cadastrar/{tipo}', 'Restrito\EventosController@cadastrarEvento');
    Route::post('eventos/cadastrar', 'Restrito\EventosController@cadastrarDB');
    Route::get('eventos/editar/{id}', 'Restrito\EventosController@editar');
    Route::post('eventos/editar/{id}', 'Restrito\EventosController@editarDB');
    Route::post('eventos/deletar/{id}', 'Restrito\EventosController@deletar');

    /* SOLICITAÇÕES ***************************************** */
    Route::get('solicitacao', 'Restrito\SolicitacaoController@index');
    Route::get('solicitacao/cadastrar', 'Restrito\SolicitacaoController@cadastrar');
    Route::post('solicitacao/cadastrar', 'Restrito\SolicitacaoController@cadastrarDB');
    Route::get('solicitacao/responder', 'Restrito\SolicitacaoController@viewSolicitacoes');
    Route::get('solicitacao/responder/{id}', 'Restrito\SolicitacaoController@responder');
    Route::post('solicitacao/responder/{id}', 'Restrito\SolicitacaoController@responderDB');
    Route::post('solicitacao/deletar/{id}', 'Restrito\SolicitacaoController@deletar');
    Route::post('solicitacao/deletar-resposta/{id}', 'Restrito\SolicitacaoController@deletarResposta');






    //Route::get('/boleto', 'HomeController@boleto');
    //Rota Inical do Dashboard
    Route::get('/', 'Restrito\RestritoController@index');
});






/* CONTROLES DO ACESSO PÚBLICO */
Route::group(['prefix' => 'site'], function () {
    Route::get('boletos/{id}', 'Site\PublicReceitasController@index');

    /* é aconselhável deixar a rota pasta raiz por último */
    Route::get('/', 'Site\SiteController@index');
});





Route::get('/', function () {
    return view('auth.login');
});


Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index');
