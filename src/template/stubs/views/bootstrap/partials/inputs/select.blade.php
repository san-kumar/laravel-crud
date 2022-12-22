<select name="_id_" id="_id_" class="form-control form-select" _required_>
    <option value="">Select _name_</option>
    @foreach(_enums_ as $value => $label )
        <option value="{{ $value }}" {{ _val_ == $value ? "selected" : "" }}>{{ $label }}</option>
    @endforeach
</select>
