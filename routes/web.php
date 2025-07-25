<?php

use App\Http\Controllers\AgendamentoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RecuperacaoSenhaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\RelatorioController;

/*
|--------------------------------------------------------------------------
| Rotas públicas (sem autenticação)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Login e cadastro
    Route::view('/login', 'pages.login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('loginPost');

    Route::prefix('cadastro')->controller(AuthController::class)->group(function () {
        Route::view('/', 'pages.cadastro')->name('cadastro.form');
        Route::post('/', 'register')->name('cadastro.store');
    });
    Route::get('/dashboard', [ServicoController::class, 'dashboardGuest'])->name('dashboard.guest');
});

// Informações públicas
Route::view('/avaliacoes', 'pages.lista-avaliacao-servicos')->name('lista-avaliacoes');
Route::view('/sobre-nos', 'pages.sobre-nos')->name('sobre.nos');
Route::view('/termos', 'pages.termos-uso-privacidade')->name('termos');
Route::prefix('PasswordReset')->controller(RecuperacaoSenhaController::class)->group(function () {
    Route::get('', 'mostrarFormularioSolicitacao')->name('recuperacao.senha');
    Route::post('', 'enviarLinkRecuperacao')->name('post.recuperacao.senha');
    Route::get('/recuperar-senha/redefinir/{token}', 'mostrarFormularioRedefinicao')->name('redefinir.senha.form');
    Route::post('/recuperar-senha/redefinir', 'redefinirSenha')->name('post.redefinir.senha');
});


/*
|--------------------------------------------------------------------------
| Rotas protegidas (usuário autenticado)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard e perfil
    // Route::view('/dashboard', 'pages.dashboard')->name('dashboard');


    Route::prefix('agendamento')->controller(AgendamentoController::class)->group(function () {
        Route::get('cliente', 'index')->name('agendamento.cliente');
        Route::post('agendar', 'store')->name('agendar');
        Route::get('solicitacoes', 'indexSolicitacoes')->name('agendamento.solicitacoes');
        Route::put('/aceitar', 'acceptSolicitacao')->name('aceitacao.solicitacao');
        Route::delete('/negar', 'destroySolicitacao')->name('negacao.solicitacao');  // ✅ Corrigido
        Route::put('/sucesso', 'closeSuccess')->name('fechar.sucesso');         // ✅ Corrigido
        Route::put('/falha', 'closeFail')->name('fechar.falha');               // ✅ Corrigido
        Route::delete('/agendamento/{agendamento}', [AgendamentoController::class, 'destroy'])->name('agendamento.destroy');
        Route::put('/confirmar-pagamento', [AgendamentoController::class, 'confirmarPagamento'])->name('confirmar.pagamento');
    });

    // Perfil do usuário
    Route::prefix('perfil')->controller(UsuarioController::class)->group(function () {
        Route::get('/lista', 'index')->name('lista');
        Route::get('/visualizacao', 'showPerfil')->name('visualizacao.perfil');

        Route::get('/edicao/{id}', 'show')->name('mostrar.edicao');
        Route::get('/formacoes/{id}', 'listFormations')->name('listar.formacoes');
        Route::put('/editar/{id}', 'edit')->name('editar.usuario');
        Route::delete('/excluir/{id}', 'destroy')->name('excluir.usuario');
    });

    // Serviços
    Route::prefix('avaliacao')->controller(AvaliacaoController::class)->group(function () {
        Route::post('/registrar', 'store')->name('registrar.avaliacao');
    });

    Route::prefix('servico')->controller(ServicoController::class)->group(function () {
        Route::get('/cadastrados', 'indexPrestador')->name('servicos.cadastrados');
        Route::get('/dashboard', 'dashboard')->name('dashboard');

        Route::get('/{id}/show', 'show')->name('servico');
        Route::get('/prestador/{id}', 'showPrestador')->name('show.perfil.prestador');

        Route::get('/create', 'create')->name('servico.create');
        Route::post('/', 'store')->name('servico.store');
        Route::get('/{servico}/edit', 'edit')->name('servico.edit');
        Route::put('/{servico}', 'update')->name('servico.update');
        Route::delete('/{servico}', 'destroy')->name('servico.destroy');

    });

    Route::prefix('denuncia')->controller(DenunciaController::class)->group(function () {
        Route::get('/lista-motivos', 'indexMotivos')->name('listar.motivos');
        Route::post('prestador/{id}', 'reportPrestador')->name('denunciar.prestador');
        Route::post('/servico/{id}', 'reportServico')->name('denunciar.servico');
    });

    Route::controller(UsuarioController::class)->group(function () {
        Route::get('/teste-minio', 'showMinioTest');
        Route::post('/teste-minio', 'testeMinio')->name('enviar.imagem');
    });

    Route::prefix('relatorio')->controller(RelatorioController::class)->group(function () {
        Route::get('/servicos', 'servicos')->name('relatorio.servicos.pdf');
    });

    Route::middleware('can:is_admin')->prefix('admin')->controller(UsuarioController::class)->group(function () {
        Route::get('/usuarios', 'index')->name('admin.lista.usuarios');
        Route::get('/edicao/{id}', 'adminShowUserAccount')->name('admin.mostrar.edicao');
        Route::put('/editar/{id}', 'adminUsuarioEdit')->name('admin.usuario.edit');
        Route::delete('/excluir/{id}', 'adminUserDestroy')->name('admin.excluir.usuario');


        Route::put('/bloqueio/{id}', 'blockAdmin')->name('bloqueio.usuario');
        Route::put('/desbloqueio/{id}', 'unblockAdmin')->name('desbloqueio.usuario');

    });

    Route::get('/fake-payment/boleto/{id}', [AgendamentoController::class, 'showBoleto'])
    ->name('fake.payment.boleto');
    Route::post('/fake-payment/boleto/{id}', [AgendamentoController::class, 'pagarBoletoFake'])
    ->name('fake.payment.boleto.pagar');
});
