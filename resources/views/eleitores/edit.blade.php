@extends ('base.index')

<div class="mx-auto" style="width: 40%;" id="create">
    <form action='/eleitores/update' method='POST'>
    @csrf
        <input type="hidden" value="{{ $eleitor->id }}" name="id" />


        @include('components.field', [
            'type' => 'text',
            'id' => 'nome',
            'name' => 'nome',
            'label' => 'Nome',
            'class' => 'form-control',
            'value' => $eleitor->nome,
            'onclick' => '',
        ])

        @include('components.field', [
            'type' => 'number',
            'id' => 'titulo',
            'name' => 'titulo',
            'label' => 'Título',
            'class' => 'form-control',
            'value' => $eleitor->titulo,
            'onclick' => '',
        ])

        @include('components.field', [
            'type' => 'number',
            'id' => 'zona',
            'name' => 'zona',
            'label' => 'Zona',
            'class' => 'form-control',
            'value' => $eleitor->zona,
            'onclick' => '',
        ])

        @include('components.field', [
            'type' => 'number',
            'id' => 'secao',
            'name' => 'secao',
            'label' => 'Seção',
            'class' => 'form-control',
            'value' => $eleitor->secao,
            'onclick' => '',
        ])
        <a href="/eleitores" class="btn btn-danger">Voltar</a>
        @include('components.button', ['type' => 'submit', 'color' => 'success', 'text' => 'Continuar'])
        </form>
        </div>