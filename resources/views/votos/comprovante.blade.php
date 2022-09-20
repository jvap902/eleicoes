@extends('base.index_comprovante')

<div class="mx-auto" style="width: 40%;" id="create">
    @if (isset($confirma))
        <div id ="recado" class="alert alert-success">
            {{ $confirma }}
        </div>
    @elseif(isset($erro))
        <div id="recado" class="alert alert-danger">
            {{ $erro }}
        </div>
    @endif
<div>
