<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select name="{{ $name }}" class="form-control" id="{{ $id }}">
        <option value="" disabled selected> Selecione a opção desejada </option>
        @if ($sincrono == true)
            @foreach ($coisas as $coisa)
                @if ($coisa->id == $selected)
                    <option value="{{ $coisa->id }}" selected="selected">{{ $coisa->nome }}</option>
                @else
                    <option value="{{ $coisa->id }}">{{ $coisa->nome }}</option>
                @endif
            @endforeach
        @endif
    </select>
</div>
