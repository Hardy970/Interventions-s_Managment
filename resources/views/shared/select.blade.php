@php
    $label??=Str::ucfirst($name);
    $name??='';
    $value??='';
    $class??=null;
@endphp

<div @class(['form-group',$class])>
    <label for="{{ $name }}">{{ $label }}</label>
    <select name="{{ $name }}[]" id="{{ $name }}"  multiple>
        @foreach ($options as $option)
            <option value="{{ $option->id }}" @selected($value->contains($option->id)) >{{ $option->name }}</option>
        @endforeach
    </select>
        @error($name)
        <div class="invalide-feedback">
            {{ $message }}
        </div>
         @enderror  
</div>