<?php

namespace Tests\Unit;


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

class FactoryTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function Factory_Administrador_Test()
    {
        $this->withoutExceptionHandling();
        
        $administrador = factory(Administrador::class)->make();

        $this->assertNotEmpty($administrador);
    }


    /** @test */
    public function Factory_Agente_Test()
    {
        $this->withoutExceptionHandling();
        
        $agente = factory(Agente::class)->make();

        $this->assertNotEmpty($agente);
    }


    /** @test */
    public function Factory_Biblioteca_Test()
    {
        $this->withoutExceptionHandling();
        
        $biblioteca = factory(Biblioteca::class)->make();

        $this->assertNotEmpty($biblioteca);
    }


    /** @test */
    public function Factory_Cliente_Test()
    {
        $this->withoutExceptionHandling();
        
        $cliente = factory(Cliente::class)->make();

        $this->assertNotEmpty($cliente);
    }


    /** @test */
    public function Factory_Conta_Test()
    {
        $this->withoutExceptionHandling();
        
        $conta = factory(Conta::class)->make();

        $this->assertNotEmpty($conta);
    }


    /** @test */
    public function Factory_Fornecedor_Test()
    {
        $this->withoutExceptionHandling();
        
        $fornecedor = factory(Fornecedor::class)->make();

        $this->assertNotEmpty($fornecedor);
    }


    /** @test */
    public function Factory_Produto_Stock_Test()
    {
        $this->withoutExceptionHandling();
        
        $produtoStock = factory(ProdutoStock::class)->make();

        $this->assertNotEmpty($produtoStock);
    }


    /** @test */
    public function Factory_Fase_Stock_Test()
    {
        $this->withoutExceptionHandling();

        $faseStock = factory(FaseStock::class)->make();

        $this->assertNotEmpty($faseStock);
    }


    /** @test */
    public function Factory_Doc_Stock_Test()
    {
        $this->withoutExceptionHandling();

        $docStock = factory(DocStock::class)->make();

        $this->assertNotEmpty($docStock);
    }


    /** @test */
    public function Factory_Universidade_Test()
    {
        $this->withoutExceptionHandling();
        
        $universidade = factory(Universidade::class)->make();

        $this->assertNotEmpty($universidade);
    }


    /** @test */
    public function Factory_User_Test()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make([
            'tipo' => 'admin',
            'idAdmin' => factory(Administrador::class),
        ]);
        $user->email = $user->admin->email;

        $this->assertNotEmpty($user);
    }


    /** @test */
    public function Factory_Contacto_Test()
    {
        $this->withoutExceptionHandling();
        
        $contacto = factory(Contacto::class)->make();

        $this->assertNotEmpty($contacto);
    }


    /** @test */
    public function Factory_Agenda_Test()
    {
        $this->withoutExceptionHandling();

        $agenda = factory(Agenda::class)->make();

        $this->assertNotEmpty($agenda);
    }


    /** @test *//*
    public function Factory_Notificacao_Test()
    {
        $this->withoutExceptionHandling();
        
        $notificacao = factory(Notificacao::class)->make();

        $this->assertNotEmpty($notificacao);
    }/**/


    /** @test */
    public function Factory_Produto_Test()
    {
        $this->withoutExceptionHandling();

        $produto = factory(Produto::class)->make();

        $this->assertNotEmpty($produto);
    }


    /** @test */
    public function Factory_Responsabilidade_Test()
    {
        $this->withoutExceptionHandling();
        
        $responsabilidade = factory(Responsabilidade::class)->make();
        $responsabilidade->subagente->tipo = 'Subagente';
        $responsabilidade->subagente->idAgenteAssociado = $responsabilidade->agente->idAgente;

        $this->assertNotEmpty($responsabilidade);
    }


    /** @test */
    public function Factory_Fase_Test()
    {
        $this->withoutExceptionHandling();

        $fase = factory(Fase::class)->make();

        $this->assertNotEmpty($fase);
    }


    /** @test */
    public function Factory_Doc_Necessario_Test()
    {
        $this->withoutExceptionHandling();

        $docNecessario = factory(DocNecessario::class)->make();

        $this->assertNotEmpty($docNecessario);
    }


    /** @test */
    public function Factory_Doc_Academico_Test()
    {
        $this->withoutExceptionHandling();

        $docAcademico = factory(DocAcademico::class)->make();

        $this->assertNotEmpty($docAcademico);
    }


    /** @test */
    public function Factory_Doc_Pessoal_Test()
    {
        $this->withoutExceptionHandling();

        $docPessoal = factory(DocPessoal::class)->make();

        $this->assertNotEmpty($docPessoal);
    }


    /** @test */
    public function Factory_Doc_Transacao_Test()
    {
        $this->withoutExceptionHandling();

        $docTransacao = factory(DocTransacao::class)->make();

        $this->assertNotEmpty($docTransacao);
    }


    /** @test */
    public function Factory_Pago_Responsabilidade_Test()
    {
        $this->withoutExceptionHandling();

        $pagoResponsabilidade = factory(PagoResponsabilidade::class)->make();

        $this->assertNotEmpty($pagoResponsabilidade);
    }


    /** @test */
    public function Factory_Relacao_Fornecedor_Responsabilidade_Test()
    {
        $this->withoutExceptionHandling();

        $relFornResp = factory(RelFornResp::class)->make();

        $this->assertNotEmpty($relFornResp);
    }


    /** @test */
    public function Factory_Relatorio_Problema_Test()
    {
        $this->withoutExceptionHandling();
        
        $relatorioProblema = factory(RelatorioProblema::class)->make();

        $this->assertNotEmpty($relatorioProblema);
    }


    /** @test *//*
    public function Factory_Create_Jobs_Test()
    {
        $this->withoutExceptionHandling();
        
        $createJobs = factory(CreateJobs::class)->make();

        $this->assertNotEmpty($createJobs);
    }/**/
}
