@@if($_var_->trashed())
    <form action="@{{ route('_route_.restore', /*_routevars_*/) }}" method="POST" class="d-inline-block me-2">
        @@csrf
        @@method('PUT')
        <input type="submit" name="restore" value="@@lang('Restore')" class="btn btn-success btn-sm"/>
    </form>
    <form action="@{{ route('_route_.purge', /*_routevars_*/) }}" method="POST" class="d-inline-block">
        @@csrf
        @@method('DELETE')
        <input type="submit" name="purge" value="@@lang('Purge')" class="btn btn-danger btn-sm"/>
    </form>
@@else
    {!! $render('buttons/actions')  !!}
@@endif
