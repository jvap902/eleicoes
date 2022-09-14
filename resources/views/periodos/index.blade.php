@extends('base.index')

<div class="mx-auto" style="width: 40%;" id="btns">
    <a href="/periodos/create" style="text-decoration:none" class="btn d-grid gap-2 col-6 mx-auto" id="btn">Novo cadastro<a>
    <a href="/" style="text-decoration:none" class="btn d-grid gap-2 col-6 mx-auto" id="btn">Voltar<a>
</div>

    @if (isset($erro))
        <div class="alert alert-danger mx-auto" style="width: 40%; margin-top:1%">
            {{ $erro }}
        </div>
    @endif

<div id="tableIndex">
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Data de início</th>
            <th>Data de término</th>
        </tr>
    </thead>
    <tbody>
        @foreach($periodos as $periodo)
            <tr>
                <td>{{$periodo->nome}}</td>
                <td>{{$periodo->data_inicio}}</td>
                <td>{{$periodo->data_fim}}</td>
                <td>
                    <a class="btn btn-secondary" href="/periodos/edit/{{$periodo->id}}">Editar</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="/periodos/destroy/{{$periodo->id}}">Remover</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
