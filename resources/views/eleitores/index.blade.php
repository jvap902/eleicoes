@extends('base.index')

@section('container')
<a class="btn btn-dark d-grid gap-2 col-6 mx-auto my-3" href="/eleitores/create">Entrar para votar</a>
<a class="btn btn-dark d-grid gap-2 col-6 mx-auto my-3" href="/">Voltar</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Título</th>
            <th>Zona</th>
            <th>Seção</th>
            <th>Ações</th>
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
                    <a class="btn btn-danger" href="/eleitores/destroy/{{$eleitor->id}}">Remover</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection