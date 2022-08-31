@extends('base.index')

<div class="mx-auto" style="width: 40%;" id="create">
    <form action='/periodos/store' method='post'>
        @csrf
        @include ('components.field', [
            'id' => 'periodo_nome',
            'name' => 'nome', //nome do campo no banco
            'type' => 'text',
            'value' => '',
            'label' => 'Nome do Período',
            'class' => '',
            'onclick' => '',
        ])
        @include ('components.field', [
            'id' => 'data_inicio',
            'name' => 'data_inicio', //nome do campo no banco
            'type' => 'datetime-local',
            'value' => '',
            'label' => 'Data de início',
            'class' => '',
            'onclick' => '',
        ])
        @include ('components.field', [
            'id' => 'data_fim',
            'name' => 'data_fim', //nome do campo no banco
            'type' => 'datetime-local',
            'value' => '',
            'label' => 'Data de término',
            'class' => '',
            'onclick' => '',
        ])
        @include('components.button', ['type' => 'submit', 'color' => 'success', 'text' => 'Enviar'])
    </form>
    <a href="/periodos" class="btn btn-danger">Voltar</a>
</div>