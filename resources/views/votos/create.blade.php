@extends('base.index')

@section('container')
    <form action='/turmas/store' method='post'>
        @include ('components.select', [
            'name' => 'candidato_id', //nome do campo no banco
            'selected' => '',
            'label' => 'Candidato',
            'coisas' => $candidatos,
            'id' => 'CURSO',
            'sincrono' => true,
        ])
        <a href="/votos" class="btn btn-danger">Voltar</a>
    </form>
@endsection
