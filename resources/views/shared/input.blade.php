@php
    $type??='text';
    $label??=Str::ucfirst($name);
    $name??='';
    $value??='';
    $class??=null;
@endphp

<div @class(['form-group',$class])>
    <label for="{{ $name }}">{{ $label }}</label>
    @if ($type=='textarea')
    <textarea type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control @error($name) is-invalid  @enderror">{{ old($name,$value) }}</textarea>
    @error($name)
    <div class="invalide-feedback">
        {{ $message }}
    </div>
     @enderror
   @else
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control @error($name) is-invalid  @enderror" value="{{ old($name,$value) }}">
        @error($name)
        <div class="invalide-feedback">
            {{ $message }}
        </div>
         @enderror  
    @endif
</div>