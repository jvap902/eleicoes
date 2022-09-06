@extends('base.index')

<div class="mx-auto" style="width: 40%;" id="btns">
<a class="btn btn-dark d-grid gap-2 col-6 mx-auto my-3" href="/candidatos/create">Novo cadastro</a>
<a class="btn btn-dark d-grid gap-2 col-6 mx-auto my-3" href="/">Voltar</a>
</div>

<table class="table table-striped my-5">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Partido</th>
            <th>Número</th>
            <th>Cargo</th>
            <th>Período</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($candidatos as $candidato)
            <tr>
                <td>{{$candidato->nome}}</td>
                <td>{{$candidato->partido}}</td>
                <td>{{$candidato->numero}}</td>
                <td>{{$candidato->cargo}}</td>
                <td>{{$candidato->periodo_id}}</td>
                <td>
                    <a class="btn btn-secondary" href="/candidatos/edit/{{$candidato->id}}">Editar</a>
                    <a class="btn btn-danger" href="/candidatos/destroy/{{$candidato->id}}">Remover</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
