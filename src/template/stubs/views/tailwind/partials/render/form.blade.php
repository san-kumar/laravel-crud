@foreach($fields as $field)
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="{{$field->id}}">{{$field->name}}:</label>
            {!! $input($field) !!}
            {!! $err($field) !!}
        </div>
    </div>
@endforeach
