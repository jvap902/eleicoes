@extends('base.index')

<div class="mx-auto" style="width: 40%;" id="btns">
    <a href="/periodos/create"><button class="btn" id="btn">Novo cadastro</button><a>
    <a href="/"><button class="btn" id="btn">Voltar</button><a>
</div>
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
                    <a class="btn btn-danger" href="/periodos/destroy/{{$periodo->id}}">Remover</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
