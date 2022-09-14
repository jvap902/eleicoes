@extends('base.index')

<div class="mx-auto" style="width: 40%;" id="btns">
    <a href="/eleitores/create" style="text-decoration:none"><button class="btn d-grid gap-2 col-6 mx-auto" id="btn">Novo cadastro</button><a>
    <a href="/" style="text-decoration:none"><button class="btn d-grid gap-2 col-6 mx-auto" id="btn">Voltar</button><a>
</div>

@if (isset($erro))
        <div class="alert alert-danger mx-auto" style="width: 40%; margin-top:1%">
            {{ $erro }}
        </div>
    @endif

<div id="tableIndex">
<table class="table table-striped my-5">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Título</th>
            <th>Zona</th>
            <th>Seção</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eleitores as $eleitor)
            <tr>
                <td>{{$eleitor->nome}}</td>
                <td>{{$eleitor->titulo}}</td>
                <td>{{$eleitor->zona}}</td>
                <td>{{$eleitor->secao}}</td>
                <td>
                    <a class="btn btn-secondary" href="/eleitores/edit/{{$eleitor->id}}">Editar</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="/eleitores/destroy/{{$eleitor->id}}">Remover</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>


