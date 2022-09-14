@extends('base.index')

<div class="mx-auto" style="width: 40%;" id="create">

    @if (isset($confirma))
        <div class="alert alert-success">
            {{ $confirma }}
        </div>
    @elseif(isset($erro))
        <div class="alert alert-danger">
            {{ $erro }}
        </div>
    @endif

    @if (isset($presidente->nome))
        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'text',
            'id' => 'presidente',
            'name' => 'presidente',
            'label' => 'Presidente',
            'class' => 'form-control',
            'value' => $presidente->nome,
            'onclick' => '',
            'disabled' => 'disabled',
        ])
    @else
        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'text',
            'id' => 'presidente',
            'name' => 'presidente',
            'label' => 'Presidente',
            'class' => 'form-control',
            'value' => 'nulo',
            'onclick' => '',
            'disabled' => 'disabled',
        ])
    @endif

    @if (isset($governador->nome))
        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'text',
            'id' => 'governador',
            'name' => 'governador',
            'label' => 'Governador',
            'class' => 'form-control',
            'value' => $governador->nome,
            'onclick' => '',
            'disabled' => 'disabled',
        ])
    @else
        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'text',
            'id' => 'governador',
            'name' => 'governador',
            'label' => 'Governador',
            'class' => 'form-control',
            'value' => 'nulo',
            'onclick' => '',
            'disabled' => 'disabled',
        ])
    @endif

    @if (isset($senador->nome))
        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'text',
            'id' => 'senador',
            'name' => 'senador',
            'label' => 'Senador',
            'class' => 'form-control',
            'value' => $senador->nome,
            'onclick' => '',
            'disabled' => 'disabled',
        ])
    @else
        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'text',
            'id' => 'senador',
            'name' => 'senador',
            'label' => 'Senador',
            'class' => 'form-control',
            'value' => 'nulo',
            'onclick' => '',
            'disabled' => 'disabled',
        ])
    @endif

    @if (isset($deputado_federal->nome))
        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'text',
            'id' => 'deputado_federal',
            'name' => 'deputado_federal',
            'label' => 'Deputado Federal',
            'class' => 'form-control',
            'value' => $deputado_federal->nome,
            'onclick' => '',
            'disabled' => 'disabled',
        ])
    @else
        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'text',
            'id' => 'deputado_federal',
            'name' => 'deputado_federal',
            'label' => 'Deputado Federal',
            'class' => 'form-control',
            'value' => 'nulo',
            'onclick' => '',
            'disabled' => 'disabled',
        ])
    @endif

    @if (isset($deputado_estadual->nome))
        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'text',
            'id' => 'deputado_estadual',
            'name' => 'deputado_estadual',
            'label' => 'Deputado Estadual',
            'class' => 'form-control',
            'value' => $deputado_estadual->nome,
            'onclick' => '',
            'disabled' => 'disabled',
        ])
    @else
        @include('components.field', [
            'classe' => 'mb-3',
            'type' => 'text',
            'id' => 'deputado_estadual',
            'name' => 'deputado_estadual',
            'label' => 'Deputado Estadual',
            'class' => 'form-control',
            'value' => 'nulo',
            'onclick' => '',
            'disabled' => 'disabled',
        ])
    @endif

    <form action='/votos/store' method='post'>
        @csrf

        @if (isset($presidente->id))
            @include('components.field', [
                'classe' => '',
                'type' => 'hidden',
                'id' => 'presidente_id',
                'name' => 'presidente_id',
                'label' => '',
                'class' => '',
                'value' => $presidente->id,
                'onclick' => '',
                'disabled' => '',
            ])
        @endif

        @if (isset($governador->id))
            @include('components.field', [
                'classe' => '',
                'type' => 'hidden',
                'id' => 'governador_id',
                'name' => 'governador_id',
                'label' => '',
                'class' => '',
                'value' => $governador->id,
                'onclick' => '',
                'disabled' => '',
            ])
        @endif

        @if (isset($senador->id))
            @include('components.field', [
                'classe' => '',
                'type' => 'hidden',
                'id' => 'senador_id',
                'name' => 'senador_id',
                'label' => '',
                'class' => '',
                'value' => $senador->id,
                'onclick' => '',
                'disabled' => '',
            ])
        @endif

        @if (isset($deputado_federal->id))
            @include('components.field', [
                'classe' => '',
                'type' => 'hidden',
                'id' => 'deputado_federal_id',
                'name' => 'deputado_federal_id',
                'label' => '',
                'class' => '',
                'value' => $deputado_federal->id,
                'onclick' => '',
                'disabled' => '',
            ])
        @endif

        @if (isset($deputado_estadual->id))
            @include('components.field', [
                'classe' => '',
                'type' => 'hidden',
                'id' => 'deputado_estadual_id',
                'name' => 'deputado_estadual_id',
                'label' => '',
                'class' => '',
                'value' => $deputado_estadual->id,
                'onclick' => '',
                'disabled' => '',
            ])
        @endif

        @include('components.button', [
            'type' => 'submit',
            'value' => '',
            'color' => 'success',
            'text' => 'Confirmar',
        ])
    </form>

    <button class="btn btn-danger" onclick="history.back()">Voltar</button>
</div>
