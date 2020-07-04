@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ajuda')

{{-- CSS Style Link --}}
@section('styleLinks')
    <link href="{{asset('/css/help.css')}}" rel="stylesheet">
    <link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
    <link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')
    <div class="container mt-2">
        <div class="float-left buttons">
            <a href="javascript:history.go(-1)" title="Voltar">
                <ion-icon name="arrow-back-outline" class="button-back"></ion-icon>
            </a>
            <a href="javascript:window.history.forward();" title="Avançar">
                <ion-icon name="arrow-forward-outline" class="button-foward"></ion-icon>
            </a>
        </div>



        <br><br>

        <div class="cards-navigation">
            <div class="title">
                <h6>Ajuda e Perguntas Frequentes</h6>
            </div>

            <br>

            <div class="report-card shadow-sm">

                <div class="row justify-content-md-center">

                    <br>

                    <div class="col-md-12 text-center font-weight-bold">
                        <div class="mt-2 mb-2 text-secondary">Qual é a sua dúvida?</div>
                        <div class="mx-auto p-1" style="width: 60%; border-radius:10px;">
                            <input type="text" class="shadow-sm" id="customSearchBox"
                                placeholder="Procurar Palavras-chaves..." aria-label="Procurar" value="" onkeyup="this.setAttribute('value', this.value);">

                        </div>
                    </div>
                </div>


                <div class="row mt-4">

                    <div class="panel-group report-card" id="accordion" role="tablist" aria-multiselectable="true">

                        <div class="panel" id="collapseA_container">  <!-- NOVA CATEGORIA -->
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <div class="panel-heading" role="tab" id="headingA">
                                        <h5 class="panel-title mb-0 ">
                                            <a class="btn-link" role="button" data-toggle="collapse"
                                               data-parent="#accordion" href="#collapseA"
                                               aria-expanded="false" aria-controls="collapseA">
                                                <i class="fas fa-angle-right pb-2"></i> Sobre os Estudantes
                                            </a></h5> <!-- CATEGORIA -->
                                    </div>
                                </div>
                            </div>

                            <div id="collapseA" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingA">
                                <div class="panel-body">
                                    <div class="panel-group" id="accordionA">

                                        <div class="panel">
                                            <a data-toggle="collapse" data-parent="#accordionA" href="#accordionA1"
                                               class="collapsed" aria-expanded="false">Como adicionar um
                                                Estudante</a>
                                            <div id="accordionA1" class="panel-collapse collapse"
                                                 aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    <p> A adição de um Estudante deverá ser feita de acordo com os
                                                        seguintes
                                                        passos: </p>
                                                    <br>
                                                    <p style="padding-bottom:4px">- Escolher a opção "
                                                        <ion-icon name="person-circle-outline"
                                                                  style="font-size: 16pt; --ionicon-stroke-width: 40px; position: relative; top: 5px;"></ion-icon>
                                                        Estudante" através do menu de navegação lateral
                                                    </p>
                                                    <br>
                                                    <p>- Pressionar o botão "Adicionar Estudante"</p>
                                                    <br>
                                                    <p>- Preencher os campos obrigatórios, que estão devidamente
                                                        assinalados com uma
                                                        <ion-icon name="close"
                                                                  style="font-size: 16pt; --ionicon-stroke-width: 40px; position: relative; top: 5px"></ion-icon>
                                                    </p>
                                                    <br>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel">
                                            <a data-toggle="collapse" data-parent="#accordionA" href="#accordionA2"
                                               class="collapsed" aria-expanded="false">Como editar/remover um
                                                Estudante</a>
                                            <div id="accordionA2" class="panel-collapse collapse"
                                                 aria-expanded="false">
                                                <div class="panel-body">
                                                    <p> bla bla bla</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div><!-- FIM DA CATEGORIA-->

                        <div class="panel" id="collapseB_container">  <!-- NOVA CATEGORIA -->
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <div class="panel-heading" role="tab" id="headingB">
                                        <h5 class="panel-title mb-0 ">
                                            <a class="btn-link" role="button" data-toggle="collapse"
                                               data-parent="#accordion" href="#collapseB"
                                               aria-expanded="false" aria-controls="collapseB">
                                                <i class="fas fa-angle-right pb-2"></i> Sobre os Agentes
                                            </a></h5> <!-- CATEGORIA -->
                                    </div>
                                </div>
                            </div>

                            <div id="collapseB" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingB">
                                <div class="panel-body">
                                    <div class="panel-group" id="accordionB">

                                        <div class="panel">
                                            <a data-toggle="collapse" data-parent="#accordionB" href="#accordionB1"
                                               class="collapsed" aria-expanded="false">Como adicionar um Agente</a>
                                            <div id="accordionB1" class="panel-collapse collapse"
                                                 aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    <p> A adição de um Agente deverá ser feita de acordo com os
                                                        seguintes
                                                        passos: </p>
                                                    <br>
                                                    <p style="padding-bottom:4px">- Escolher a opção "<i
                                                            class="fas fa-user-tie mr-1"></i>
                                                        Agente" através do menu de navegação lateral
                                                    </p>
                                                    <br>
                                                    <p>- Pressionar o botão "Adicionar Agente"</p>
                                                    <br>
                                                    <p>- Preencher os campos obrigatórios, que estão devidamente
                                                        assinalados com uma
                                                        <ion-icon name="close"
                                                                  style="font-size: 16pt; --ionicon-stroke-width: 40px; position: relative; top: 5px"></ion-icon>
                                                    </p>
                                                    <br>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel">
                                            <a data-toggle="collapse" data-parent="#accordionB" href="#accordionB2"
                                               class="collapsed" aria-expanded="false">Como editar/remover um
                                                Agente</a>
                                            <div id="accordionB2" class="panel-collapse collapse"
                                                 aria-expanded="false">
                                                <div class="panel-body">
                                                    <p> bla bla bla</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div><!-- FIM DA CATEGORIA-->

                        <div class="panel" id="collapseC_container">  <!-- NOVA CATEGORIA -->
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <div class="panel-heading" role="tab" id="headingC">
                                        <h5 class="panel-title mb-0 ">
                                            <a class="btn-link" role="button" data-toggle="collapse"
                                               data-parent="#accordion" href="#collapseC"
                                               aria-expanded="false" aria-controls="collapseC">
                                                <i class="fas fa-angle-right pb-2"></i> Sobre os Produtos
                                            </a></h5> <!-- CATEGORIA -->
                                    </div>
                                </div>
                            </div>

                            <div id="collapseC" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingC">
                                <div class="panel-body">
                                    <div class="panel-group" id="accordionC">

                                        <div class="panel">
                                            <a data-toggle="collapse" data-parent="#accordionC" href="#accordionC1"
                                               class="collapsed" aria-expanded="false">Como criar um Produto?</a>
                                            <div id="accordionC1" class="panel-collapse collapse"
                                                 aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body">
                                                    <p> A criação de um Produto deverá ser feita de acordo com os
                                                        seguintes
                                                        passos: </p>
                                                    <br>
                                                    <p>- Escolher a opção " <i class="fas fa-tools"></i> Diversos "
                                                        através do menu
                                                        de navegação lateral</p>
                                                    <br>
                                                    <p>- Escolher a opção "Produtos de Stock"</p>
                                                    <br>
                                                    <p>- Pressionar o botão "Adicionar Produtos de Stock"</p>
                                                    <br>
                                                    <p>- Preencher os campos obrigatórios, que estão devidamente
                                                        assinalados com uma
                                                        <ion-icon name="close"
                                                                  style="font-size: 16pt; --ionicon-stroke-width: 40px; position: relative; top: 5px"></ion-icon>
                                                    </p>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel">
                                            <a data-toggle="collapse" data-parent="#accordionC" href="#accordionC2"
                                               class="collapsed" aria-expanded="false">Como editar/remover um
                                                Estudante</a>
                                            <div id="accordionC2" class="panel-collapse collapse"
                                                 aria-expanded="false">
                                                <div class="panel-body">
                                                    <p> bla bla bla</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div><!-- FIM DA CATEGORIA-->


                        <div class="panel" id="collapseE_container">  <!-- NOVA CATEGORIA -->
                            <div class="card">
                                <div class="card-header" id="headingFive">
                                    <div class="panel-heading" role="tab" id="headingE">
                                        <h5 class="panel-title mb-0 ">
                                            <a class="btn-link" role="button" data-toggle="collapse"
                                               data-parent="#accordion" href="#collapseE"
                                               aria-expanded="false" aria-controls="collapseE">
                                                <i class="fas fa-angle-right pb-2"></i> Reportar Problema
                                            </a></h5> <!-- CATEGORIA -->
                                    </div>
                                </div>
                            </div>

                            <div id="collapseE" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingE">
                                <div class="panel-body">
                                    <div class="panel-group" id="accordionE">

                                        <div class="panel">

                                            <div data-toggle="collapse" data-parent="#accordionE"
                                                 href="#accordionE1"
                                                 class="collapsed" aria-expanded="false">
                                                <div class="panel-body">
                                                    <p> A criação de um Produto deverá ser feita de acordo com os
                                                        seguintes
                                                        passos: </p>
                                                    <br>
                                                    <p>- Escolher a opção " <i class="fas fa-tools"></i> Diversos "
                                                        através do menu
                                                        de navegação lateral</p>
                                                    <br>
                                                    <p>- Escolher a opção "Produtos de Stock"</p>
                                                    <br>
                                                    <p>- Pressionar o botão "Adicionar Produtos de Stock"</p>
                                                    <br>
                                                    <p>- Preencher os campos obrigatórios, que estão devidamente
                                                        assinalados com uma
                                                        <ion-icon name="close"
                                                                  style="font-size: 16pt; --ionicon-stroke-width: 40px; position: relative; top: 5px"></ion-icon>
                                                    </p>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- FIM DA CATEGORIA-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')
    <script src="{{asset('/js/help.js')}}"></script>
@endsection
