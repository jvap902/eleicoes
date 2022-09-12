@extends('base.index')

<div class="mx-auto" style="width: 40%;" id="create">
    <form action='/votos/confirmar' method='post'>
        @csrf
        @include('components.field', [
            'classe' => '',
            'type' => 'hidden',
            'id' => 'zona',
            'name' => 'zona',
            'label' => '',
            'class' => '',
            'value' => $zona,
            'onclick' => '',
            'disabled' => ''
        ])

        @include('components.field', [
            'classe' => '',
            'type' => 'hidden',
            'id' => 'secao',
            'name' => 'secao',
            'label' => '',
            'class' => '',
            'value' => $secao,
            'onclick' => '',
            'disabled' => ''
        ])

        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'number',
            'id' => 'presidente',
            'name' => 'presidente',
            'label' => 'Presidente',
            'class' => 'form-control',
            'value' => '',
            'onclick' => '',
            'disabled' => ''
        ])

        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'number',
            'id' => 'governador',
            'name' => 'governador',
            'label' => 'Governador',
            'class' => 'form-control',
            'value' => '',
            'onclick' => '',
            'disabled' => ''
        ])

        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'number',
            'id' => 'senador',
            'name' => 'senador',
            'label' => 'Senador',
            'class' => 'form-control',
            'value' => '',
            'onclick' => '',
            'disabled' => ''
        ])

        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'number',
            'id' => 'deputado_federal',
            'name' => 'deputado_federal',
            'label' => 'Deputado Federal',
            'class' => 'form-control',
            'value' => '',
            'onclick' => '',
            'disabled' => ''
        ])

        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'number',
            'id' => 'deputado_estadual',
            'name' => 'deputado_estadual',
            'label' => 'Deputado Estadual',
            'class' => 'form-control',
            'value' => '',
            'onclick' => '',
            'disabled' => ''
        ])

        @include('components.button', ['type' => 'submit', 'color' => 'success', 'value' => '', 'text' => 'Enviar'])
    </form>
    <a href="/votos" class="btn btn-danger">Voltar</a>
</div>
