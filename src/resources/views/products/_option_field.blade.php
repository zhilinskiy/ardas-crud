<div class="form-group">
    <label for="options[{{ $option->id }}]">Product option: <em class="text-uppercase">{{ $option->name }}</em> </label>
    <div class="input-group">
        <input type="text" name="options[{{ $option->id }}]" id="options[{{ $option->id }}]"
               @if ($new) disabled @endif
               value="{{ $option->pivot->value ?? '' }}"
               class="form-control @error('options['.$option->id.']') is-invalid @enderror">
        <div class="input-group-append">
            <button class="btn @if ($new) btn-outline-primary @else btn-outline-danger @endif" type="button">
                @if ($new) Add @else Remove @endif
            </button>
        </div>
    </div>
    @error('options['.$option->id.']')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
