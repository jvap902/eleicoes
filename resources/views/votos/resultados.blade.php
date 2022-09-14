@extends('base.index')



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
        </div>

        
    </div>
@endforeach


<!-- <a href="/votos" class="btn btn-danger">Voltar</a> -->
