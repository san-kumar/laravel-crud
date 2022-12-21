<table class="table table-striped table-responsive table-hover">
    <thead role="rowgroup">
    <tr role="row">
        @foreach($fields as $field)
            <th role='columnheader'>{{ $field->name }}</th>
        @endforeach
        <th scope="col" data-label="Actions">Actions</th>
    </tr>
    </thead>
    <tbody>
    @@foreach ($_vars_ as $_var_)
        <tr>
            @foreach($fields as $field)
                <td data-label="{{ $field->name }}">{!! $display($field) !!}</td>
            @endforeach

            <td data-label="Actions:" class="text-nowrap">
                @if(!empty($hasSoftDelete))
                   {!! $render('buttons/actions-trash') !!}
                @else
                   {!! $render('buttons/actions') !!}
                @endif
            </td>
        </tr>
    @@endforeach
    </tbody>
</table>
