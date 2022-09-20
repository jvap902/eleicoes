@extends ('base.index')

<div class="mx-auto" style="width: 40%;" id="edit">
@if (isset($erro))
        <div class="alert alert-danger">
            {{ $erro }}
        </div>
    @endif
    <form action='/eleitores/update' method='POST'>
    @csrf
        <input type="hidden" value="{{ $eleitor->id }}" name="id" />


        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'text',
            'id' => 'nome',
            'name' => 'nome',
            'label' => 'Nome',
            'class' => 'form-control',
            'value' => $eleitor->nome,
            'onclick' => '',
            'disabled' => ''
        ])

        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'number',
            'id' => 'titulo',
            'name' => 'titulo',
            'label' => 'Título',
            'class' => 'form-control',
            'value' => $eleitor->titulo,
            'onclick' => '',
            'disabled' => ''
        ])

        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'number',
            'id' => 'zona',
            'name' => 'zona',
            'label' => 'Zona',
            'class' => 'form-control',
            'value' => $eleitor->zona,
            'onclick' => '',
            'disabled' => ''
        ])

        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'number',
            'id' => 'secao',
            'name' => 'secao',
            'label' => 'Seção',
            'class' => 'form-control',
            'value' => $eleitor->secao,
            'onclick' => '',
            'disabled' => ''
        ])
        <a href="/eleitores" class="btn btn-danger">Voltar</a>
        @include('components.button', ['type' => 'submit', 'color' => 'success', 'value' => '', 'text' => 'Continuar'])
        </form>
        </div>