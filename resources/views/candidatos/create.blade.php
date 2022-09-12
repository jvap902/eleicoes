@extends ('base.index')

@section('container')
    <form action='/candidatos/store' method='POST'>
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
            'classe' => 'mb-3',
            'type' => 'text',
            'id' => 'nome',
            'name' => 'nome',
            'label' => 'Nome',
            'class' => 'form-control',
            'value' => '',
            'onclick' => '',
            'disabled' => ''
        ])

        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'text',
            'id' => 'partido',
            'name' => 'partido',
            'label' => 'Partido',
            'class' => 'form-control',
            'value' => '',
            'onclick' => '',
            'disabled' => ''
        ])

        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'number',
            'id' => 'numero',
            'name' => 'numero',
            'label' => 'Número',
            'class' => 'form-control',
            'value' => '',
            'onclick' => '',
            'disabled' => ''
        ])

        @include('components.select', [
            'id' => 'cargo',
            'name' => 'cargo',
            'label' => 'Cargo',
            'sincrono' => true,
            'coisas' => $cargos,
            'array' => true,
            'selected' => '',
        ])
        <a href="/candidatos" class="btn btn-danger">Voltar</a>
        @include('components.button', ['type' => 'submit', 'color' => 'success', 'value => '', 'text' => 'Continuar'])
        </form>
@endsection
