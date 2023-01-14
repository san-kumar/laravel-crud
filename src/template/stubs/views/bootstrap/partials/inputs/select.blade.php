<select name="_id_" id="_id_" _required_ @class(["form-control", 'is-invalid'=> $errors->has('_id_')])>
    <option value="">Select _name_</option>
    @foreach(_enums_ as $value => $label )
        <option value="{{ $value }}" {{ _val_ == $value ? "selected" : "" }}>{{ $label }}</option>
    @endforeach
</select>
