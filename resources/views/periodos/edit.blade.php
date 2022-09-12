@extends ('base.index')

@section('container')
    <form action='/periodos/update' method='POST'>
        @csrf
        <input type="hidden" value="{{ $periodo->id }}" name="id" />


        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'text',
            'id' => 'nome',
            'name' => 'nome',
            'label' => 'Nome',
            'class' => 'form-control',
            'value' => $periodo->nome,
            'onclick' => '',
            'disabled' => ''
        ])

        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'datetime-local',
            'id' => 'data_inicio',
            'name' => 'data_inicio',
            'label' => 'Data de início',
            'class' => 'form-control',
            'value' => $periodo->data_inicio,
            'onclick' => '',
            'disabled' => ''
        ])

        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'datetime-local',
            'id' => 'data_fim',
            'name' => 'data_fim',
            'label' => 'Data de término',
            'class' => 'form-control',
            'value' => $periodo->data_fim,
            'onclick' => '',
            'disabled' => ''
        ])
        <a href="/periodos" class="btn btn-danger">Voltar</a>
        @include('components.button', ['type' => 'submit', 'color' => 'success', 'value' => '', 'text' => 'Continuar'])
    </form>
@endsection
