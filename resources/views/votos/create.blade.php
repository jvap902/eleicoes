@extends('base.index')

<div class="mx-auto" style="width: 40%;" id="create">
    <form action='/votos/store' method='post'>
        @csrf
        @include ('components.select', [
            'name' => 'candidato_id', //nome do campo no banco
            'selected' => '',
            'label' => 'Presidente',
            'coisas' => $presidentes,
            'id' => 'presidente',
            'sincrono' => true,
        ])
        @include ('components.select', [
            'name' => 'candidato_id', //nome do campo no banco
            'selected' => '',
            'label' => 'Governador',
            'coisas' => $governadores,
            'id' => 'governador',
            'sincrono' => true,
        ])
        @include ('components.select', [
            'name' => 'candidato_id', //nome do campo no banco
            'selected' => '',
            'label' => 'Deputado Federal',
            'coisas' => $deputados_federais,
            'id' => 'deputado_federal',
            'sincrono' => true,
        ])
        @include ('components.select', [
            'name' => 'candidato_id', //nome do campo no banco
            'selected' => '',
            'label' => 'Deputado Estadual',
            'coisas' => $deputados_estaduais,
            'id' => 'deputado_estadual',
            'sincrono' => true,
        ])
        @include ('components.select', [
            'name' => 'candidato_id', //nome do campo no banco
            'selected' => '',
            'label' => 'Senador',
            'coisas' => $senadores,
            'id' => 'senador',
            'sincrono' => true,
        ])

        @include('components.button', ['type' => 'submit', 'color' => 'success', 'text' => 'Enviar'])
    </form>
    <a href="/votos" class="btn btn-danger">Voltar</a>
</div>
