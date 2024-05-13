@php
    $class??=null;
    // $name??='';
    // $label??=Str::ucfirst($name);
    // $value??='';
@endphp

<div @class(['form-check form-switch',$class])>
    <input type="hidden" value="0" name="{{ $name }}">
    <input value="1" type="checkbox" @checked(old($name,$value ?? false )) class="form-check-input @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" role="switch">
    <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>
    @error($name)
    <div class= " invalid-feedback ">
        {{ $message }}
    </div>
    @enderror
</div>