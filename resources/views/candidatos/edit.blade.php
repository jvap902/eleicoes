@extends ('base.index')

@section('container')
    <form action='/candidatos/update' method='POST'>
        <input type='hidden' name='_token' value='{{ csrf_token() }}' />

        @include('components.field', [
            'type' => 'hidden',
            'id' => 'id',
            'name' => 'id',
            'label' => '',
            'class' => 'form-control',
            'value' => $candidato->id,
            'onclick' => '',
        ])

        @include('components.select', [
            'name' => 'periodo_id',
            'label' => 'Período',
            'id' => 'periodo_id',
            'sincrono' => true,
            'coisas' => $periodos,
            'selected' => $candidato->periodo_id,

        ])
        
        @include('components.field', [
            'type' => 'text',
            'id' => 'nome',
            'name' => 'nome',
            'label' => 'Nome',
            'class' => 'form-control',
            'value' => $candidato->nome,
            'onclick' => '',
        ])

        @include('components.field', [
            'type' => 'text',
            'id' => 'partido',
            'name' => 'partido',
            'label' => 'Partido',
            'class' => 'form-control',
            'value' => $candidato->partido,
            'onclick' => '',
        ])

        @include('components.field', [
            'type' => 'number',
            'id' => 'numero',
            'name' => 'numero',
            'label' => 'Número',
            'class' => 'form-control',
            'value' => $candidato->numero,
            'onclick' => '',
        ])

        @include('components.select', [
            'id' => 'cargo',
            'name' => 'cargo',
            'label' => 'Cargo',
            'sincrono' => true,
            'coisas' => $cargos,
            'array' => true,
            'selected' => $candidato->cargo,
        ])
        <a href="/candidatos" class="btn btn-danger">Voltar</a>
        @include('components.button', ['type' => 'submit', 'color' => 'success', 'text' => 'Continuar'])
        </form>
@endsection