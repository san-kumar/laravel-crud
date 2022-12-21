@@if($_var_->trashed())
    <div class="flex">
        <form action="@{{ route('_route_.restore', /*_routevars_*/) }}" method="POST">
            @@csrf
            @@method('PUT')
            <input type="submit" name="restore" value="@@lang('Restore')" class="inline-block cursor-pointer align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-green-500 text-white hover:bg-green-600 py-1 px-2 leading-tight text-xs "/>
        </form>
        <form action="@{{ route('_route_.purge', /*_routevars_*/) }}" method="POST">
            @@csrf
            @@method('DELETE')
            <input type="submit" name="purge" value="@@lang('Purge')" class="inline-block cursor-pointer align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-red-600 text-white hover:bg-red-700 py-1 px-2 leading-tight text-xs "/>
        </form>
     </div>
@@else
    {!! $render('buttons/actions')  !!}
@@endif
