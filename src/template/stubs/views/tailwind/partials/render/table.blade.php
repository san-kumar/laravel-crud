<table class="border-collapse w-full">
    <thead>
    <tr>
        @foreach($fields as $field)
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">{{ $field->name }}</th>
        @endforeach
        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Actions</th>
    </tr>
    </thead>
    <tbody>
    @@foreach ($_vars_ as $_var_)
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            @foreach($fields as $field)
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">{{ $field->name }}</span>
                    {!! $display($field) !!}
                </td>
            @endforeach

            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
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
