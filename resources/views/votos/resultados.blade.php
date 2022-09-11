@extends('base.index')



@foreach($periodos as $p)
    <div class="mx-auto" style="width: 40%;" id="create">
        <p>{{$p->nome}}</p>
        <table class="table table-striped">
            <thead>
                <tr>
                <th>Presidente</th>
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
                            <th>{{$pz->zona}}</th>
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
                            <th>{{$ps->secao}}</th>
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
@endforeach


<!-- <a href="/votos" class="btn btn-danger">Voltar</a> -->
