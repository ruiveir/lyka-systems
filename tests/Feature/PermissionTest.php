<?php

namespace Tests\Feature;

use App\User;
use App\Fase;
use App\Conta;
use App\Agente;
use App\Agenda;
use App\Produto;
use App\Cliente;
use App\Contacto;
use App\DocStock;
use App\FaseStock;
use App\Fornecedor;
use App\Biblioteca;
use App\DocPessoal;
use App\RelFornResp;
use App\DocAcademico;
use App\ProdutoStock;
use App\DocTransacao;
use App\Universidade;
use App\Administrador;
use App\DocNecessario;
use App\Responsabilidade;
use App\RelatorioProblema;
use App\PagoResponsabilidade;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function redirecionar_de_dashboard_para_login()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_administrador_para_login()
    {
        $response = $this->get('/administradores')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_administrador_para_login()
    {

        $user = factory(User::class)->make();

        $response = $this->get('/administradores'.'/'.$user->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_administrador_para_login()
    {

        $response = $this->get('/administradores/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_administrador_para_login()
    {

        $user = factory(User::class)->make();
        
        $response = $this->get('/administradores'.'/'.$user->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_agente_para_login()
    {
        $response = $this->get('/agentes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_agentes_para_login()
    {
        $agente = factory(Agente::class)->make();

        $response = $this->get('/agentes'.'/'.$agente->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_agentes_para_login()
    {

        $response = $this->get('/agentes/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_agentes_para_login()
    {
        $agente = factory(Agente::class)->make();

        $response = $this->get('/agentes'.'/'.$agente->slug.'/editar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_print_agentes_para_login()
    {
        $agente = factory(Agente::class)->make();

        $response = $this->get('/agentes/print'.'/'.$agente->slug)->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_biblioteca_para_login()
    {
        $response = $this->get('/biblioteca')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_biblioteca_para_login()
    {

        $response = $this->get('/biblioteca/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_biblioteca_para_login()
    {
        $biblioteca = factory(Biblioteca::class)->make();

        $response = $this->get('/biblioteca'.'/'.$biblioteca->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cliente_para_login()
    {
        $response = $this->get('/clientes')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cliente_para_login()
    {
        $cliente = factory(Cliente::class)->make();

        $response = $this->get('/clientes'.'/'.$cliente->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_cliente_para_login()
    {

        $response = $this->get('/clientes/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cliente_para_login()
    {
        $cliente = factory(Cliente::class)->make();

        $response = $this->get('/clientes'.'/'.$cliente->slug.'/editar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_pesquisa_cliente_para_login()
    {

        $response = $this->get('/clientes/pesquisa')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_print_cliente_para_login()
    {
        $cliente = factory(Cliente::class)->make();

        $response = $this->get('/clientes/print'.'/'.$cliente->slug)->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_conta_para_login()
    {
        $response = $this->get('/conta-bancaria')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_conta_para_login()
    {
        $conta = factory(Conta::class)->make();

        $response = $this->get('/conta-bancaria'.'/'.$conta->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_conta_para_login()
    {
        $response = $this->get('/conta-bancaria/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_conta_para_login()
    {
        $conta = factory(Conta::class)->make();

        $response = $this->get('/conta-bancaria'.'/'.$conta->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_fornecedor_para_login()
    {
        $response = $this->get('/fornecedores')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_fornecedor_para_login()
    {
        $fornecedor = factory(Fornecedor::class)->make();

        $response = $this->get('/fornecedores'.'/'.$fornecedor->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_fornecedor_para_login()
    {

        $response = $this->get('/fornecedores/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_fornecedor_para_login()
    {
        $fornecedor = factory(Fornecedor::class)->make();

        $response = $this->get('/fornecedores'.'/'.$fornecedor->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_produto_stock_para_login()
    {
        $response = $this->get('/produtostock')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_produto_stock_para_login()
    {
        $produtoStock = factory(ProdutoStock::class)->make();

        $response = $this->get('/produtostock'.'/'.$produtoStock->idProdutoStock)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_produto_stock_para_login()
    {

        $response = $this->get('/produtostock/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_produto_stock_para_login()
    {
        $produtoStock = factory(ProdutoStock::class)->make();

        $response = $this->get('/produtostock'.'/'.$produtoStock->idProdutoStock.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */
    
    /** @test */
    public function redirecionar_de_show_fase_stock_para_login()
    {
        $faseStock = factory(FaseStock::class)->make();

        $response = $this->get('/fasestock'.'/'.$faseStock->idFaseStock)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_fase_stock_para_login()
    {
        $response = $this->get('/fasestock/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_fase_stock_para_login()
    {
        $faseStock = factory(FaseStock::class)->make();

        $response = $this->get('/fasestock'.'/'.$faseStock->idFaseStock.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_doc_stock_para_login()
    {
        $response = $this->get('/documentostock')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_doc_stock_para_login()
    {
        $docStock = factory(DocStock::class)->make();

        $response = $this->get('/documentostock'.'/'.$docStock->idDocStock)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_doc_stock_para_login()
    {
        $response = $this->get('/documentostock/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_doc_stock_para_login()
    {
        $docStock = factory(DocStock::class)->make();

        $response = $this->get('/documentostock'.'/'.$docStock->idDocStock.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_universidade_para_login()
    {
        $response = $this->get('/universidades')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_universidade_para_login()
    {
        $universidade = factory(Universidade::class)->make();

        $response = $this->get('/universidades'.'/'.$universidade->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_universidade_para_login()
    {

        $response = $this->get('/universidades/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_universidade_para_login()
    {
        $universidade = factory(Universidade::class)->make();

        $response = $this->get('/universidades'.'/'.$universidade->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_contacto_para_login()
    {
        $response = $this->get('/contactos')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_contacto_para_login()
    {
        $contacto = factory(Contacto::class)->make();

        $response = $this->get('/contactos/show/'.$contacto->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_contacto_para_login()
    {

        $response = $this->get('/contactos/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_contacto_para_login()
    {
        $contacto = factory(Contacto::class)->make();

        $response = $this->get('/contactos/editar/'.$contacto->slug)->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_agenda_para_login()
    {
        $response = $this->get('/agenda')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_agenda_para_login()
    {
        $agenda = factory(Agenda::class)->make();

        $response = $this->get('/agenda'.'/'.$agenda->idAgenda)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_agenda_para_login()
    {
        $response = $this->get('/agenda/criar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_agenda_para_login()
    {
        $agenda = factory(Agenda::class)->make();

        $response = $this->get('/agenda'.'/'.$agenda->idAgenda.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */
    
    /** @test */
    public function redirecionar_de_show_produto_para_login()
    {
        $produto = factory(Produto::class)->make();

        $response = $this->get('/produtos'.'/'.$produto->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_create_produto_para_login()
    {
        $produto = factory(Produto::class)->make();

        $response = $this->get('/produtos/criar/'.$produto->cliente->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_produto_para_login()
    {
        $produto = factory(Produto::class)->make();

        $response = $this->get('/produtos'.'/'.$produto->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */
    
    /** @test */
    public function redirecionar_de_create_doc_academico_para_login()
    {
        $docNecessario = factory(DocNecessario::class)->make();

        $response = $this->get('/documento-academico/criar/'.$docNecessario->fase->slug.'/'.$docNecessario->idDocNecessario)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_doc_academico_para_login()
    {
        $docAcademico = factory(DocAcademico::class)->make();

        $response = $this->get('/documento-academico'.'/'.$docAcademico->slug.'/editar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_verifica_doc_academico_para_login()
    {
        $docAcademico = factory(DocAcademico::class)->make();

        $response = $this->get('/documento-academico'.'/'.$docAcademico->slug.'/verifica')->assertRedirect('/login');
    }

    /********************************************************************************************************** */
    
    /** @test */
    public function redirecionar_de_create_doc_pessoal_para_login()
    {
        $docNecessario = factory(DocNecessario::class)->make();

        $response = $this->get('/documento-pessoal/criar/'.$docNecessario->fase->slug.'/'.$docNecessario->idDocNecessario)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_doc_pessoal_para_login()
    {
        $docPessoal = factory(DocPessoal::class)->make();

        $response = $this->get('/documento-pessoal'.'/'.$docPessoal->slug.'/editar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_verifica_doc_pessoal_para_login()
    {
        $docPessoal = factory(DocPessoal::class)->make();

        $response = $this->get('/documento-pessoal'.'/'.$docPessoal->slug.'/verifica')->assertRedirect('/login');
    }

    /********************************************************************************************************** */
    
    /** @test */
    public function redirecionar_de_create_doc_transacao_para_login()
    {
        $fase = factory(Fase::class)->make();

        $response = $this->get('/documento-transacao/criar/'.$fase->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_doc_transacao_para_login()
    {
        $docTransacao = factory(DocTransacao::class)->make();

        $response = $this->get('/documento-transacao'.'/'.$docTransacao->slug.'/editar')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_pago_responsabilidade_para_login()
    {
        $response = $this->get('/pagamentos')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_pago_responsabilidade_para_login()
    {
        $pagoResponsabilidade = factory(PagoResponsabilidade::class)->make();

        $response = $this->get('/pagamentos'.'/'.$pagoResponsabilidade->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_agente_pago_responsabilidade_para_login()
    {
        $responsabilidade = factory(Responsabilidade::class)->make();

        $response = $this->get('/pagamentos/agente/'.$responsabilidade->agente->slug.'/fase'.'/'.$responsabilidade->fase->slug.'/'.$responsabilidade->idResponsabilidade)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_cliente_pago_responsabilidade_para_login()
    {
        $responsabilidade = factory(Responsabilidade::class)->make();

        $response = $this->get('/pagamentos/cliente/'.$responsabilidade->cliente->slug.'/fase'.'/'.$responsabilidade->fase->slug.'/'.$responsabilidade->idResponsabilidade)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_fornecedor_pago_responsabilidade_para_login()
    {
        $relFornResp = factory(RelFornResp::class)->make();

        $response = $this->get('/pagamentos/fornecedor/'.$relFornResp->fornecedor->slug.'/fase'.'/'.$relFornResp->responsabilidade->fase->slug.'/'.$relFornResp->idRelacao)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_download_pago_responsabilidade_para_login()
    {
        $pagoResponsabilidade = factory(PagoResponsabilidade::class)->make();

        $response = $this->get('/pagamentos/nota-pagamento/'.$pagoResponsabilidade->idPagoResp.'/transferir')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_subagente_pago_responsabilidade_para_login()
    {
        $responsabilidade = factory(Responsabilidade::class)->make();
        $responsabilidade->subagente->tipo = 'Subagente';
        $responsabilidade->subagente->idAgenteAssociado = $responsabilidade->agente->idAgente;

        $response = $this->get('/pagamentos/subagente/'.$responsabilidade->subagente->slug.'/fase'.'/'.$responsabilidade->fase->slug.'/'.$responsabilidade->idResponsabilidade)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_universidade_principal_pago_responsabilidade_para_login()
    {
        $responsabilidade = factory(Responsabilidade::class)->make();

        $response = $this->get('/pagamentos/universidade-principal/'.$responsabilidade->universidade1->slug.'/fase'.'/'.$responsabilidade->fase->slug.'/'.$responsabilidade->idResponsabilidade)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_universidade_secundaria_pago_responsabilidade_para_login()
    {
        $responsabilidade = factory(Responsabilidade::class)->make();

        $response = $this->get('/pagamentos/universidade-secundaria/'.$responsabilidade->universidade2->slug.'/fase'.'/'.$responsabilidade->fase->slug.'/'.$responsabilidade->idResponsabilidade)->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_relatorio_problema_para_login()
    {
        $response = $this->get('/reportar-problema')->assertRedirect('/login');
    }

    /********************************************************************************************************** */

    /** @test */
    public function redirecionar_de_lista_cobrancas_para_login()
    {
        $response = $this->get('/cobrancas')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_cobrancas_para_login()
    {
        $produto = factory(Produto::class)->make();

        $response = $this->get('/cobrancas'.'/'.$produto->slug)->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_edit_cobrancas_para_login()
    {
        $docTransacao = factory(DocTransacao::class)->make();

        $response = $this->get('/cobrancas'.'/'.$docTransacao->fase->produto->slug.'/'.$docTransacao->fase->slug.'/'.$docTransacao->slug.'/editar')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_download_cobrancas_para_login()
    {
        $docTransacao = factory(DocTransacao::class)->make();

        $response = $this->get('/cobrancas'.'/'.$docTransacao->slug.'/download')->assertRedirect('/login');
    }
    
    /** @test */
    public function redirecionar_de_show_charge_cobrancas_para_login()
    {
        $fase = factory(Fase::class)->make();

        $response = $this->get('/cobrancas'.'/'.$fase->produto->slug.'/'.$fase->slug)->assertRedirect('/login');
    }
}
