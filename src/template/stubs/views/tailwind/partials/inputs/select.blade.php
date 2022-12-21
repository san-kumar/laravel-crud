<select name="_id_" id="_id_" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" _required_>
    <option value="">Select _name_</option>
    @foreach(_enums_ as $value => $label )
        <option value="{{ $value }}" {{ _val_ == $value ? "selected" : "" }}>{{ $label }}</option>
    @endforeach
</select>
