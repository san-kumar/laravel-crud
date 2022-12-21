<div class="d-flex flex-column flex-md-row align-items-center">
    <a href="@{{route('_route_.show', /*_callvars_*/)}}" type="button" class="btn btn-primary btn-sm me-1">@@lang('Show')</a>
    <a href="@{{route('_route_.edit', /*_callvars_*/)}}" type="button" class="btn btn-info btn-sm me-1">@@lang('Edit')</a>
    <form action="@{{route('_route_.destroy', /*_callvars_*/)}}" method="POST" style="display: inline;" class="m-0 p-0 ms-auto">
        @@csrf
        @@method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm me-1">@@lang('Delete')</button>
    </form>
</div>