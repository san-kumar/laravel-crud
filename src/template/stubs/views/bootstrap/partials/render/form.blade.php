@foreach($fields as $field)
    <div class="mb-3">
        <label for="{{$field->id}}" class="form-label">{{$field->name}}:</label>
        {!! $input($field) !!}
        {!! $err($field) !!}
    </div>
@endforeach
