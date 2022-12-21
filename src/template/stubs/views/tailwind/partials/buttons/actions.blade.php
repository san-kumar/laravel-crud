<div class="flex items-center">
    <a href="@{{route('_route_.show', /*_callvars_*/)}}" type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-blue-600 text-white hover:bg-blue-600 py-1 px-2 leading-tight text-xs  me-1">@@lang('Show')</a>
    <a href="@{{route('_route_.edit', /*_callvars_*/)}}" type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-teal-500 text-white hover:bg-teal-600 py-1 px-2 leading-tight text-xs  me-1">@@lang('Edit')</a>
    <form action="@{{route('_route_.destroy', /*_callvars_*/)}}" method="POST" style="display: inline;" class="m-0 p-0 ms-auto">
        @@csrf
        @@method('DELETE')
        <button type="submit" class="inline-block cursor-pointer align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-red-600 text-white hover:bg-red-700 py-1 px-2 leading-tight text-xs  me-1">@@lang('Delete')</button>
    </form>
</div>