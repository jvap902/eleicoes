@extends('base.index')

<div class="mx-auto" style="width: 40%;" id="create">
    @if(isset($erro))
        <div class="alert alert-danger">
            {{$erro}}
        </div>
    @endif
    <form action='/votos/validar' method='post'>
    <input type='hidden' name='_token' value='{{ csrf_token() }}' />
        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'number',
            'id' => 'titulo',
            'name' => 'titulo',
            'label' => 'Título',
            'class' => 'form-control',
            'value' => '',
            'onclick' => '',
            'disabled' => ''
        ])
        @include('components.button', ['type' => 'submit', 'color' => 'success', 'value' => '', 'text' => 'Continuar'])
    </form>
    <a href="/votos" class="btn btn-danger">Voltar</a>
</div>