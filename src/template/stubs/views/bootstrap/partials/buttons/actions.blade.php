<a href="@{{route('_route_.show', /*_callvars_*/)}}" type="button" class="btn btn-primary btn-sm me-1">@@lang('Show')</a>
<div class="btn-group btn-group-sm">
    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="@{{route('_route_.edit', /*_callvars_*/)}}">@@lang('Edit')</a></li>
        <li>
            <form action="@{{route('_route_.destroy', /*_callvars_*/)}}" method="POST" style="display: inline;" class="m-0 p-0">
                @@csrf
                @@method('DELETE')
                <button type="submit" class="dropdown-item">@@lang('Delete')</button>
            </form>
        </li>
    </ul>
</div>
