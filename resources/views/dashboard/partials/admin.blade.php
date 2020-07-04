<div class="row cards-group">
    <div class="col-md-3">
        <a href="{{route('clients.index')}}">
            <div class="card-navigation">
                <div class="help-button" id="tooltipClient" data-toggle="tooltip" data-placement="top"
                     title="O número apresentado neste cartão representa o número total de clientes registados no sistema.">
                    <span>
                        ?
                    </span>
                </div>
                <div class="info">
                    <p class="number">{{count($clientes)}}</p>
                    <p class="word">clientes</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{route('universities.index')}}">
            <div class="card-navigation">
                <div class="help-button" id="tooltipUni" data-toggle="tooltip" data-placement="top"
                     title="O número apresentado neste cartão representa o número total de universidades registadas no sistema.">
                    <span>
                        ?
                    </span>
                </div>
                <div class="info">
                    <p class="number">{{count($universidades)}}</p>
                    <p class="word">universidades</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{route('agents.index')}}">
            <div class="card-navigation">
                <div class="help-button" id="tooltipAgent" data-toggle="tooltip" data-placement="top"
                     title="O número apresentado neste cartão representa o número total de agentes registados no sistema.">
                    <span>
                        ?
                    </span>
                </div>
                <div class="info">
                    <p class="number">{{count($agentes)}}</p>
                    <p class="word">agentes</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{route('agents.index')}}">
            <div class="card-navigation">
                <div class="help-button" id="tooltipAgent" data-toggle="tooltip" data-placement="top"
                     title="O número apresentado neste cartão representa o número total de agentes registados no sistema.">
                    <span>
                        ?
                    </span>
                </div>
                <div class="info">
                    <p class="number">{{count($agentes)}}</p>
                    <p class="word">agentes</p>
                </div>
            </div>
        </a>
    </div>
</div>
