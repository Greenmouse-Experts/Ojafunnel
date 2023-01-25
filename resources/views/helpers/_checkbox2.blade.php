@if (!isset($disabled) || $disabled === false)
    <input type="hidden" name="{{ $name }}" value="{{ $options[0] }}" />
@endif

<div class="checkbox inline text-semibold {{ isset($class) ? $class : "" }} {{ isset($disabled) && $disabled == true ? ' disabled' : "" }}">
    <label>
        <span class="d-flex align-items-center">
            <input {{ $value == $options[1] ? " checked" : "" }}
            style="
            width: 20px;
        "
                {{ !isset($value) && isset($default_value) && $default_value == $options[1] ? " checked" : "" }}
                {{ isset($disabled) && $disabled == true ? ' disabled="disabled"' : "" }}
                name="{{ $name }}" value="{{ $options[1] }}"
                class="styled me-2 {{ $classes }}  {{ isset($class) ? $class : "" }}"
                type="checkbox" class="styled">
            <p style="padding-top: 3px; color: initial; font-size: 15px;" class="ms-2">{!! $label !!}</p>
        </span>
    </label>
</div>
