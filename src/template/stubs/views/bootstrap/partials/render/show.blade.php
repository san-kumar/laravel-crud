<table class="table table-striped">
    <tbody>
    <tr>
        <th scope="row">ID:</th>
        <td>@{{$_var_->id}}</td>
    </tr>
    @foreach ($fields as $field)
        <tr>
            <th scope="row">{{ $field->name }}:</th>
            <td>{!! $display($field) !!}</td>
        </tr>
    @endforeach
    @if($hasTimestamps)
        <tr>
            <th scope="row">Created at</th>
            <td>@{{Carbon\Carbon::parse($_var_->created_at)->format('d/m/Y H:i:s')}}</td>
        </tr>
        <tr>
            <th scope="row">Updated at</th>
            <td>@{{Carbon\Carbon::parse($_var_->updated_at)->format('d/m/Y H:i:s')}}</td>
        </tr>
    @endif
    </tbody>
</table>
