@extends ('base.index')

@section('container')
    <form action='/eleitores/store' method='POST'>
        <input type='hidden' name='_token' value='{{ csrf_token() }}' />

        @include('components.field', [
            'type' => 'hidden',
            'id' => 'id',
            'name' => 'id',
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
            'id' => 'titulo',
            'name' => 'titulo',
            'label' => 'Título',
            'class' => 'form-control',
            'value' => '',
            'onclick' => '',
        ])

        @include('components.field', [
            'type' => 'number',
            'id' => 'zona',
            'name' => 'zona',
            'label' => 'Zona',
            'class' => 'form-control',
            'value' => '',
            'onclick' => '',
        ])

        @include('components.field', [
            'type' => 'number',
            'id' => 'secao',
            'name' => 'secao',
            'label' => 'Seção',
            'class' => 'form-control',
            'value' => '',
            'onclick' => '',
        ])
        <a href="/votos" class="btn btn-danger">Voltar</a>
        @include('components.button', ['type' => 'submit', 'color' => 'success', 'text' => 'Continuar'])
        </form>
@endsection