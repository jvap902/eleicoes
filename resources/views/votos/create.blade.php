@extends('base.index')

@section('container')
    <form action='/periodos/store' method='post'>
        @include ('components.field', [
            'name' => 'candidato_id', //nome do campo no banco
            'selected' => '',
            'label' => 'Candidato',
            'coisas' => $candidatos,
            'id' => 'CURSO',
            'sincrono' => true,
        ])
        <a href="/votos" class="btn btn-danger">Voltar</a>
        @include('components.button', ['type' => 'submit', 'color' => 'success', 'text' => 'Enviar'])
    </form>
@endsection
