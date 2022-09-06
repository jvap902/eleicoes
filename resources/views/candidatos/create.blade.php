@extends ('base.index')

@section('container')
    <form action='/eleitores/store' method='POST'>
        <input type='hidden' name='_token' value='{{ csrf_token() }}' />

        @include('components.select', [
            'name' => 'periodo_id',
            'label' => 'Período',
            'id' => 'periodo_id',
            'sincrono' => true,
            'coisas' => $periodos,
            'selected' => '',

        ])
        @include('components.field', [
            'type' => 'hidden',
            'id' => 'periodo_id',
            'name' => 'periodo_id',
            'label' => '',
            'class' => '',
            'value' => '',
            'onclick' => '',
        ])

        @include('components.field', [
            'type' => 'text',
            'id' => 'nome',
            'name' => 'nome',
            'label' => 'Nome',
            'class' => 'form-control',
            'value' => '',
            'onclick' => '',
        ])

        @include('components.field', [
            'type' => 'number',
            'id' => 'partido',
            'name' => 'partido',
            'label' => 'Partido',
            'class' => 'form-control',
            'value' => '',
            'onclick' => '',
        ])

        @include('components.field', [
            'type' => 'number',
            'id' => 'numero',
            'name' => 'numero',
            'label' => 'Número',
            'class' => 'form-control',
            'value' => '',
            'onclick' => '',
        ])

        @include('components.select', [
            'id' => 'cargo',
            'name' => 'cargo',
            'label' => 'Cargo',
            'sincrono' => true,
            'coisas' => $cargos,
            'array' => true,
            'selected' => '',
        ]) {{--Fazer include com as várias options--}}
        <a href="/eleitores" class="btn btn-danger">Voltar</a>
        @include('components.button', ['type' => 'submit', 'color' => 'success', 'text' => 'Continuar'])
        </form>
@endsection
