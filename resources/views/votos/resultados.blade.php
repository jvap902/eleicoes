@extends('base.index')

<div  class="mx-auto" style="width: 40%;">
    <a href="/" style="text-decoration:none" class="btn d-grid gap-2 col-6 mx-auto" id="btn">Voltar<a>
</div>

@foreach($periodos as $k => $p)
    <div class="mx-auto" style="width: 40%;" id="resultados">
        <p>{{$p->nome}}</p>

        <div class="accordion" id="accordionResultados{{$k}}">
            <!-- PRESIDENTE  -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingPresidente{{$k}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePresidente{{$k}}" aria-expanded="true" aria-controls="collapsePresidente{{$k}}">
                        Presidente
                    </button>
                </h2>
                <div id="collapsePresidente{{$k}}" class="accordion-collapse collapse" aria-labelledby="headingPresidente{{$k}}" data-bs-parent="#accordionPresidente{{$k}}">
                <div class="accordion-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>Presidente</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Resultados gerais<th>
                            </tr>
                        @foreach($pgeral[$p->id] as $pg)
                            <tr>
                                <td>{{$pg->nome}}</td>
                                <td>{{$pg->votos}}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <th>Resultados por zona<th>
                                @foreach($pzonas[$p->id] as $pz)
                                    <tr>
                                        <th>Zona {{$pz->zona}}</th><th></th>
                                    </tr>
                                    @foreach($pzvotos[$p->id] as $pzv)
                                        @if($pzv->zona == $pz->zona)
                                            <tr>
                                                <td>{{$pzv->nome}}</td>
                                                <td>{{$pzv->votos}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tr>
                            <tr>
                                <th>Resultados por seção<th>
                                @foreach($psecoes[$p->id] as $ps)
                                    <tr>
                                        <th>Seção {{$ps->secao}}</th><th></th>
                                    </tr>
                                    @foreach($psvotos[$p->id] as $psv)
                                        @if($psv->secao == $ps->secao)
                                            <tr>
                                                <td>{{$psv->nome}}</td>
                                                <td>{{$psv->votos}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            <!-- GOVERNADOR  -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingGovernador{{$k}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGovernador{{$k}}" aria-expanded="true" aria-controls="collapseGovernador{{$k}}">
                        Governador
                    </button>
                </h2>
                <div id="collapseGovernador{{$k}}" class="accordion-collapse collapse" aria-labelledby="headingGovernador{{$k}}" data-bs-parent="#accordionGovernador{{$k}}">
                <div class="accordion-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>Governador</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Resultados gerais<th>
                            </tr>
                        @foreach($ggeral[$p->id] as $gg)
                            <tr>
                                <td>{{$gg->nome}}</td>
                                <td>{{$gg->votos}}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <th>Resultados por zona<th>
                                @foreach($gzonas[$p->id] as $gz)
                                    <tr>
                                        <th>Zona {{$gz->zona}}</th><th></th>
                                    </tr>
                                    @foreach($gzvotos[$p->id] as $gzv)
                                        @if($gzv->zona == $gz->zona)
                                            <tr>
                                                <td>{{$gzv->nome}}</td>
                                                <td>{{$gzv->votos}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tr>
                            <tr>
                                <th>Resultados por seção<th>
                                @foreach($gsecoes[$p->id] as $gs)
                                    <tr>
                                        <th>Seção {{$gs->secao}}</th><th></th>
                                    </tr>
                                    @foreach($gsvotos[$p->id] as $gsv)
                                        @if($gsv->secao == $gs->secao)
                                            <tr>
                                                <td>{{$gsv->nome}}</td>
                                                <td>{{$gsv->votos}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            <!-- SENADOR  -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSenador{{$k}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSenador{{$k}}" aria-expanded="true" aria-controls="collapseSenador{{$k}}">
                        Senador
                    </button>
                </h2>
                <div id="collapseSenador{{$k}}" class="accordion-collapse collapse" aria-labelledby="headingSenador{{$k}}" data-bs-parent="#accordionSenador{{$k}}">
                <div class="accordion-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>Senador</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Resultados gerais<th>
                            </tr>
                        @foreach($sgeral[$p->id] as $sg)
                            <tr>
                                <td>{{$sg->nome}}</td>
                                <td>{{$sg->votos}}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <th>Resultados por zona<th>
                                @foreach($szonas[$p->id] as $sz)
                                    <tr>
                                        <th>Zona {{$sz->zona}}</th><th></th>
                                    </tr>
                                    @foreach($szvotos[$p->id] as $szv)
                                        @if($szv->zona == $sz->zona)
                                            <tr>
                                                <td>{{$szv->nome}}</td>
                                                <td>{{$szv->votos}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tr>
                            <tr>
                                <th>Resultados por seção<th>
                                @foreach($ssecoes[$p->id] as $ss)
                                    <tr>
                                        <th>Seção {{$ss->secao}}</th><th></th>
                                    </tr>
                                    @foreach($ssvotos[$p->id] as $ssv)
                                        @if($ssv->secao == $ss->secao)
                                            <tr>
                                                <td>{{$ssv->nome}}</td>
                                                <td>{{$ssv->votos}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>

            <!-- DEPUTADO FEDERAL  -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingDeputadoF{{$k}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDeputadoF{{$k}}" aria-expanded="true" aria-controls="collapseDeputadoF{{$k}}">
                        Deputado Federal
                    </button>
                </h2>
                <div id="collapseDeputadoF{{$k}}" class="accordion-collapse collapse" aria-labelledby="headingDeputadoF{{$k}}" data-bs-parent="#accordionDeputadoF{{$k}}">
                <div class="accordion-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>Deputado Federal</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Resultados gerais<th>
                            </tr>
                        @foreach($dfgeral[$p->id] as $dfg)
                            <tr>
                                <td>{{$dfg->nome}}</td>
                                <td>{{$dfg->votos}}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <th>Resultados por zona<th>
                                @foreach($dfzonas[$p->id] as $dfz)
                                    <tr>
                                        <th>Zona {{$dfz->zona}}</th><th></th>
                                    </tr>
                                    @foreach($dfzvotos[$p->id] as $dfzv)
                                        @if($dfzv->zona == $dfz->zona)
                                            <tr>
                                                <td>{{$dfzv->nome}}</td>
                                                <td>{{$dfzv->votos}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tr>
                            <tr>
                                <th>Resultados por seção<th>
                                @foreach($dfsecoes[$p->id] as $dfs)
                                    <tr>
                                        <th>Seção {{$dfs->secao}}</th><th></th>
                                    </tr>
                                    @foreach($dfsvotos[$p->id] as $dfsv)
                                        @if($dfsv->secao == $dfs->secao)
                                            <tr>
                                                <td>{{$dfsv->nome}}</td>
                                                <td>{{$dfsv->votos}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            <!-- DEPUTADO ESTADUAL  -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingDeputadoE{{$k}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDeputadoE{{$k}}" aria-expanded="true" aria-controls="collapseDeputadoE{{$k}}">
                        Deputado Estadual
                    </button>
                </h2>
                <div id="collapseDeputadoE{{$k}}" class="accordion-collapse collapse" aria-labelledby="headingDeputadoE{{$k}}" data-bs-parent="#accordionDeputadoE{{$k}}">
                <div class="accordion-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>Deputado Estadual</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Resultados gerais<th>
                            </tr>
                        @foreach($degeral[$p->id] as $deg)
                            <tr>
                                <td>{{$deg->nome}}</td>
                                <td>{{$deg->votos}}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <th>Resultados por zona<th>
                                @foreach($dezonas[$p->id] as $dez)
                                    <tr>
                                        <th>Zona {{$dez->zona}}</th><th></th>
                                    </tr>
                                    @foreach($dezvotos[$p->id] as $dezv)
                                        @if($dezv->zona == $dez->zona)
                                            <tr>
                                                <td>{{$dezv->nome}}</td>
                                                <td>{{$dezv->votos}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tr>
                            <tr>
                                <th>Resultados por seção<th>
                                @foreach($desecoes[$p->id] as $des)
                                    <tr>
                                        <th>Seção {{$des->secao}}</th><th></th>
                                    </tr>
                                    @foreach($desvotos[$p->id] as $desv)
                                        @if($desv->secao == $des->secao)
                                            <tr>
                                                <td>{{$desv->nome}}</td>
                                                <td>{{$desv->votos}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>


        </div>
    </div>
@endforeach

