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
            'type' => 'number',
            'id' => 'presidente',
            'name' => 'preseidente',
            'label' => 'Presidente',
            'class' => 'form-control',
            'value' => $voto->presidente,
            'onclick' => '',
            'disabled' => ''
        ])
        @include('components.button', ['type' => 'submit', 'color' => 'success', 'text' => 'Continuar'])
    </form>
    <a href="/votos" class="btn btn-danger">Voltar</a>
</div>