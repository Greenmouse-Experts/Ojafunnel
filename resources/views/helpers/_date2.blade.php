<div>
    <div class="input-icon-right">											
        <input {{ isset($disabled) && $disabled == true ? ' disabled="disabled"' : "" }} id="{{ $name }}" placeholder="{{ isset($placeholder) ? $placeholder : "" }}" value="{{ isset($value) ? $value : "" }}" type="text" name="{{ $name }}" class="control-with-mask pickadate-control form-control{{ $classes }} date-selector {{ isset($class) ? $class : "" }}">
        <span class="mask-control date-mask-control"></span>
        <span class=""><span class="material-icons-outlined">
event
</span></span>
    </div>
</div>
