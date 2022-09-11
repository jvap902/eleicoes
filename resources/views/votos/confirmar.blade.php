@extends('base.index')

<div class="mx-auto" style="width: 40%;" id="create">
    <form action='/votos/store' method='post'>
        @csrf
        @include('components.field', [
            'type' => 'text',
            'id' => 'presidente',
            'name' => 'presidente',
            'label' => 'Presidente',
            'class' => 'form-control',
            'value' => $presidente,
            'onclick' => '',
            'disabled' => 'disabled'
        ])

        @include('components.field', [
            'type' => 'text',
            'id' => 'governador',
            'name' => 'governador',
            'label' => 'Governador',
            'class' => 'form-control',
            'value' => $governador,
            'onclick' => '',
            'disabled' => 'disabled'
        ])

        @include('components.field', [
            'type' => 'text',
            'id' => 'senador',
            'name' => 'senador',
            'label' => 'Senador',
            'class' => 'form-control',
            'value' => $senador,
            'onclick' => '',
            'disabled' => 'disabled'
        ])

        @include('components.field', [
            'type' => 'text',
            'id' => 'deputado_federal',
            'name' => 'deputado_federal',
            'label' => 'Deputado Federal',
            'class' => 'form-control',
            'value' => $deputado_federal,
            'onclick' => '',
            'disabled' => 'disabled'
        ])

        @include('components.field', [
            'type' => 'text',
            'id' => 'deputado_estadual',
            'name' => 'deputado_estadual',
            'label' => 'Deputado Estadual',
            'class' => 'form-control',
            'value' => $deputado_estadual,
            'onclick' => '',
            'disabled' => 'disabled'
        ])

        @include('components.button', ['type' => 'submit', 'color' => 'success', 'text' => 'Confirmar'])
    </form>
    <a href="/votos/create" class="btn btn-danger">Voltar</a>
</div>