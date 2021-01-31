<select class='uppercase form-control' name="{{ $row->field }}"
    data-name="{{ $row->display_name }}"
    @if($row->required == 1) required @endif
    placeholder="{{ isset($options->placeholder)? old($row->field, $options->placeholder): $row->display_name }}">
    @foreach($states as $name => $val)
    <option value='{{$val}}' @if($value === $val) selected @endif>{{$name}}</option>
    @endforeach
</select>