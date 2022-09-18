@extends('base.index_comprovante')

@if (isset($confirma))
        <div id ="recado" class="alert alert-success">
            {{ $confirma }}
        </div>
    @elseif(isset($erro))
        <div id="recado" class="alert alert-danger">
            {{ $erro }}
        </div>
        @endif