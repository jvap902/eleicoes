@extends('base.index')

<div class="mx-auto" style="width: 40%;" id="create">
    <form action='/votos/store' method='post'>
        @csrf
        @include ('components.select', [
            'name' => 'candidato_id', //nome do campo no banco
            'selected' => '',
            'label' => 'Candidato',
            'coisas' => $candidatos,
            'id' => 'CURSO',
            'sincrono' => true,
        ])
        @include('components.button', ['type' => 'submit', 'color' => 'success', 'text' => 'Enviar'])
    </form>
    <a href="/votos" class="btn btn-danger">Voltar</a>
</div>
